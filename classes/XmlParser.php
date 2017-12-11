<?php

  /*
   * File Name: XmlParser
   * Author: Nathan Strand
   * Date Created: 10/31/17
   * Assignment: The Surgery Podcast
   * Description: A class that on construction will reach for the rss feed read it, grab the relevant information and print this as a string
   */
  
  require_once '/home/nstrand/SurgeryPodcast/config.php';
  
  class XmlParser{
    
    private $_conn;
    private $_podcastCount;
    private $_xml;
    
    
    /**
     * Creates an instance of a XML Parsed and ready to add Data
     */
    function __construct()
    {
      
      //Establish it can reach the Database
      try {
          //Establish database connection
          $this->_conn = new PDO( DB_DSN, DB_USER, DB_PASSWORD );
          
          //Keep the connection open for reuse to improve performance
          $this->_conn->setAttribute( PDO::ATTR_PERSISTENT, true);
          
          //Throw an exception whenever a database error occurs
          $this->_conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      }
      catch (PDOException $e) {
          die( "Error!: " . $e->getMessage());
      }
      
      //Pull the Data in 
      $this->_xml = $this->pullData();
      
      // Finds the count of the number of Childen that are items (podcasts) 
      $this->_podcastCount = $this->_xml->channel->item->count();
    }
    
    /**
     * Function to take XML and complete the following
     * clearTables(); Empty the tables relevant to podcasts
     * For each Podcast grab the title, url, publish date,
     * description (Strip html tags), duration, and keywords and then
     * addToPodcastTable() adds the podcasts to the main table
     * addKeywords adds keywords to keyword table and creates join table
     */
    function addData()
    {
      
      $this->clearTables();

      try {
          // For the number of items record Title, link, Published Date, Description, Duration and Keywords.
          for($i = 0; $i < $this->_podcastCount; $i++) {

              $title = $this->_xml->channel->item[$i]->title;
              $url = $this->_xml->channel->item[$i]->enclosure['url'];
              $publish_date = $this->_xml->channel->item[$i]->pubDate;
              $description = $this->_xml->channel->item[$i]->description;

              //Grab Publish Date and reformat to a way the Database can take date
              $publish_date = strtotime($publish_date);
              $publish_date = gmdate("Y-m-d H:i:s", $publish_date);

              // Descriptions includes HTML. Removed these for storing in database
              $description = strip_tags($description);

              // To reach the SimpleXMl of the SimpeXML Tree the tree must be reset on Itunes XML and then grabbed
              $newtree = $this->_xml->channel->item[$i]->children('http://www.itunes.com/dtds/podcast-1.0.dtd');

              $duration = $newtree->duration;

              $durationStringLength = strlen($duration);

              if ($durationStringLength < 6) {

                  if ($durationStringLength == 5) {
                      $duration = "00:" . $duration;
                  }

              }
              $keyWords = $newtree->keywords;

              $splitKeyWords = explode(",", $keyWords);

              //Hard coded information until These might change or be useful
              $image = "http://static.libsyn.com/p/assets/e/3/f/8/e3f81ea492e04af3/LOGO_BIG_1.jpg";
              $author = "Kevin Kniery, Jason Bingham, John McClellan, Scott Steele";

              //Add the Podcast to the Podcast table with the broken apart information above
              $this->addToPodcastTable($title, $description, $image, $author, $url, $duration, $publish_date);

              //Add the keywords of the current Title and then add them to join table
              $this->addKeywords($splitKeyWords, $title);
          }
          return true;
      } catch (Exception $e) {
          return false;
        }
    }
    
    /**
     * Returns the total podcasts xml parsed
     * @return int podcastCount
     */
    function getPodcastCount(){
      return $this->_podcastCount;
    }
    
     /**
     * Returns SimpleXML array that has all XML data inside
     * @return array $xml
     */
    function pullData()
    {
      // The following takes in the feed from the hosted site and will then parse this into a
      // readable string for the SimpleXML object to take
     
      $url = "http://behindtheknife.libsyn.com/rss";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $xmlresponse = curl_exec($ch);
      $xml=simplexml_load_string($xmlresponse);
      
      //Uncomment the following code to see the structure of the SimpleXML Array
      // echo '<pre>';
      //var_dump($xml);
      //echo '</pre>';
      
      return $xml;
    }
    
     /**
     * Takes in Strings to represent all parts of each Podcast and
     * adds them to the podcast table
     * @param String title Podcast title
     * @param String description Podcast description
     * @param String image URL to the image for this podcast
     * @param String author Hard coded authors
     * @param String url URL to access podcast
     * @param String duration Length of podcast
     * @param String publishDate Date podcast was published
     */
    function addToPodcastTable($title, $description, $image, $author, $url, $duration, $publish_date)
    {
      $insert = 'INSERT INTO podcasts (title, description, image, author, url, duration, publish_date) VALUES (:title, :description, :image, :author, :url, :duration, :publish_date) ';
      
      $stmt = $this->_conn->prepare($insert);
      $stmt->bindParam(':title', $title, PDO::PARAM_STR);
      $stmt->bindParam(':description', $description, PDO::PARAM_STR);
      $stmt->bindParam(':image', $image, PDO::PARAM_STR);
      $stmt->bindParam(':author', $author, PDO::PARAM_STR);
      $stmt->bindParam(':url', $url, PDO::PARAM_STR);
      $stmt->bindParam(':duration', $duration, PDO::PARAM_STR);
      $stmt->bindParam(':publish_date', $publish_date, PDO::PARAM_STR);
      
      
      try {
         $stmt->execute();
      } catch (PDOException $error) {
          die ("(!) There was an error adding " . $title . " to the database... " . $error);
      }
      
      // Uncomment the following code to see the structure of the new SimpleXML Array
      //echo '<pre>';
      //var_dump($newtree);
      //echo '</pre>';
    }
    
     /**
     * Empties the relevant podcast tables
     */
    function clearTables(){
      //Tables
      $podcasts = "podcasts";
      $podcast_tags = "podcast_tags";
      $podcast_tag_join = "podcast_tag_join";
      $users = "users";
      
      $tables = array(podcasts, podcast_tags, podcast_tag_join, users);
      
      foreach ($tables as $tableName)
      {
        
        $insert = 'TRUNCATE ' . $tableName;
        
        $stmt = $this->_conn->prepare($insert);     
        
        try {
           $stmt->execute();
        } catch (PDOException $error) {
            die ("(!) There was an error removing " . $tableName . $error);
        }
        
      }
    }
    
    /**
     * For each keyword adds it to the database. The database
     * only accepts unique values and duplicates are dropped on
     * database side. After keyword is added it adds to the join
     * table using the title and the keyword to find the ids
     * @param array splitKeyWords Array of keywords
     * @param String title Title of the Podcast they belong to
     */
    function addKeywords($splitKeyWords, $title)
    {
      //For each of the given keywords attempt to add them to the database
      foreach ($splitKeyWords as $value)
      {
        $insert = 'INSERT INTO podcast_tags (tag_name) VALUES ( :value ) ';
        
        $stmt = $this->_conn->prepare($insert);
        $stmt->bindParam(':value', $value, PDO::PARAM_STR);
        
        try {
           $stmt->execute();
        } catch (PDOException $error) {
            //You do not want the action to die as the databse will handle all uniques
        }
        
        //Now that the keyword is added it must be joined to the correct Podcast
        //Find the tag_id of the given to keyword
        $select = 'SELECT tag_id ,tag_name FROM `podcast_tags` WHERE tag_name = :value';
        $statement = $this->_conn->prepare($select);
        $statement->bindValue(':value', $value, PDO::PARAM_STR);
        $statement->execute();
        
        
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
             
             $results[$row['tag_id']] = $row;
        }
        
        
        //Now that we have the correct tag_id we need the corresponding podcast_id
        foreach($results as $key => $valueSelected)
        {
          if($valueSelected['tag_name'] == $value)
          {
            
            $select = 'SELECT podcast_id ,title FROM `podcasts` WHERE title = :title';
            $statement = $this->_conn->prepare($select);
            $statement->bindValue(':title', $title, PDO::PARAM_STR);
            $statement->execute();
            
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                 
                 $resultsTitleId[$row['podcast_id']] = $row;
            }
            
            $tag_id = $key;
            
            foreach ($resultsTitleId as $keyTemp => $valueTemp){
              $podcast_id = $keyTemp;
            }
            
            $insert = 'INSERT INTO podcast_tag_join (podcast_id, tag_id) VALUES ( :podcast_id, :tag_id ) ';
            
            $stmt = $this->_conn->prepare($insert);
            $stmt->bindParam(':podcast_id', $podcast_id, PDO::PARAM_STR);
            $stmt->bindParam(':tag_id', $tag_id, PDO::PARAM_STR);
            
            try {
               $stmt->execute();
            } catch (PDOException $error) {
              
            }
            
          }
        }
      }
    }
  }