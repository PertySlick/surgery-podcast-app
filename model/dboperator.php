<?php

/*
 * File Name: dboperator.php
 * Author: Timothy Roush
 * Date Created: 10/30/2017
 * Assignment: Behind the Knife: Surgery Podcast database operations
 * Description:  Model MVC Component - Handles Database Operations
 */

/**
 * DbOperator represents an instance of a "model" component of the MVC style
 * architecture.  This class handles any and all database interaction
 * operations at the request of the controller component.  Class employs PDO
 * SQL queries and statements to sanitize inputs as they are entered into the
 * database.
 *
 * @author Brent Taylor
 * @author Timothy Roush
 * @copyright 2017
 * @version 1.0
 * @see Podcast.java
 */
class DbOperator {


// FIELDS - CONSTANTS AND OBJECTS


    private $_conn;                 // Database Connection Object


// CONSTRUCTOR


    /**
     * Creates an instance of a database interaction object.  Requires access
     * to an externally stored credentials file for accessing the database.
     * @throws PDOException if error encountered while establishing connection
     */
    public function __construct()
    {
        // Require Configuration File
        // IMPORTANT: For this assignment store credentials in the following path:
        //      home/username/secure/credentials_budgetapp.inc.php
        require_once '/home/troush/secure/credentials_surgerypodcast.inc.php';
        //require_once '../secure/credentials_surgerypodcast.inc.php';

        // Establish Database Connection And Set Attributes
        try {
            $this->_conn = new PDO( DB_DSN, DB_USER, DB_PASSWORD );
            $this->_conn->setAttribute( PDO::ATTR_PERSISTENT, true );
            $this->_conn->setAttribute(
                PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION
            );
        } catch ( PDOException $e ) {
            die( "(!) Error - Connection Failed: " . $e->getMessage() );
        }
    }


// METHODS - USER OPERATIONS
/**
 *Checks the most recent podcast/record found within the database.
 *GROUPS DATA BY podcast id in a descending list
 *LIMIT 1 - the most recent record to be pulled.
 *
 */
    public function checkMostRecentUpload($id)
    {
        
        $stmt = $this->_conn->prepare("SELECT podcast_id, MAX(:title) AS most_recent_podcast FROM podcasts
                                  GROUP BY podcast_id ORDER BY podcast_id DESC LIMIT 1");
        $stmt->bindParam(":pod_castid", $id);
        $stmt-execute();
    
    
    }
    
    /*
     *This function searches the database and returns a list of podcast titles in order.
     *
     */
     public function checkAllPodcasts($id)
    {
        
        $stmt = $this->_conn->prepare("SELECT title AS list_of_titles FROM podcasts
                                  ORDER BY title ASC");
        $stmt->bindParam(":pod_castid", $id);
        $stmt-execute();
    
    }

    /**
     * Retrieves all podcast records that include the supplied tag word.
     * Returns results in an array of Podcast objects.
     * @param $tag String tag or keyword
     * @return array Array of Podcast object results
     */
    public function getPodcastByTag($tag) {
        $stmt = $this->_conn->prepare("
            SELECT podcast_id, title, description, url, image, duration, publish_date 
            FROM podcasts
            NATURAL JOIN podcast_tags
            NATURAL JOIN podcast_tag_join
            WHERE tag_name = :tag
            ORDER BY publish_date DESC
            ");
        $stmt->bindParam(":tag", $tag);

        if($stmt->execute()) {
            $podcasts = array();

            while ($record = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $title = $record['title'];
                $publishDate = $record['publish_date'];
                $url = $record['url'];
                $image = $record['image'];
                $description = $record['description'];
                $duration = $record['duration'];
                
                //Re-format publish date
                
                ////Get current year 
                //$currentYear = date("Y");
                //
                ////Convert string date to Date object
                //$publishDateAsDateTimeInterface = date_create($publishDate);
                //
                ////If the podcast was publish this current year, only show month and day.
                ////Otherwise, also show year of publication.
                //if (date_format($publishDateAsDateTimeInterface, "Y") == $currentYear) {
                //    $publishDate = date_format($publishDateAsDateTimeInterface, "M <\b\\r> j");
                //} else {
                //    $publishDate = date_format($publishDateAsDateTimeInterface, "M j <\b\\r> Y");
                //}
                
                //Create new Podcast object and add to array
                $newPodcast = new Podcast($title, $publishDate, $url, $image, $description, $duration);
                $podcasts[] = $newPodcast;
            }

            return  $podcasts;
        }


    }
    
    public function searchByKeyword($tag_name,$title,$description)
    {
        
    }
    
/**
 * Retrieves the 3 most recent podcasts.
 * Returns results in an array of Podcast objects.
 * @return array Array of Podcast object results
 */
    public function retrieveRecentPodcasts()
    {
        $stmt = $this->_conn->prepare("
                    SELECT podcast_id, title, description, url, image, duration, publish_date 
                    FROM podcasts
                    ORDER BY publish_date DESC LIMIT 3");
        
        if($stmt->execute()) {
            $podcasts = array();

            while ($record = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $title = $record['title'];
                $publishDate = $record['publish_date'];
                $url = $record['url'];
                $image = $record['image'];
                $description = $record['description'];
                $duration = $record['duration'];
                
                ////Re-format publish date
                //
                ////Get current year 
                //$currentYear = date("Y");
                //
                ////Convert string date to Date object
                //$publishDateAsDateTimeInterface = date_create($publishDate);
                //
                ////If the podcast was publish this current year, only show month and day.
                ////Otherwise, also show year of publication.
                //if (date_format($publishDateAsDateTimeInterface, "Y") == $currentYear) {
                //    $publishDate = date_format($publishDateAsDateTimeInterface, "M <\b\\r> j");
                //} else {
                //    $publishDate = date_format($publishDateAsDateTimeInterface, "M j <\b\\r> Y");
                //}
                
                //Create new Podcast object and add to array
                $newPodcast = new Podcast($title, $publishDate, $url, $image, $description, $duration);
                $podcasts[] = $newPodcast;
            }

            return  $podcasts;
        }
    }
    
    
    public function addPodcastTag($tag_name)
    {
        $stmt = $this->_conn->prepare('INSERT INTO podcast_tags ' .
                                      '(tag_name) ' .
                                      'VALUES (:tag_name) ');
        $stmt->bindParam(':tag_name', $tag_name, PDO::PARAM_STR);

        try {
            $stmt->execute();
        } catch (PDOException $error) {
            die ("(!) There was an error adding " . $tag_name . " to the database... " . $error);
        }

        return $this->_conn->lastInsertId();
    }


/**
 *Checks to see if podcast exists within the database.
 *@param $title, the title we are searching for in the db
 */
    public function checkPodcastExists($title)
    {
        $stmt = $this->_conn->prepare("SELECT COUNT(*) as count FROM podcasts WHERE title=:title");
        $stmt->bindParam("title", $title);
        $stmt-execute();
    
        $results = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($results['count'] > 0) {
        return true;
    }
    else {
        return false;
    }
    
}




    /**
     * Checks the supplied credential against the records stored in th users
     * database.  If a record is found with a matching username, the data
     * for that record is retrieved.  The password values are then compared. If
     * they match, an array of user data is then returned for Controller use.
     * @param $username String uername used in login attempt
     * @param $enteredPassword String password used in login attempt
     * @return true if credentials are validated, false otherwise
     */
    public function areCredentialsValidated($username, $enteredPassword)
    {
        $stmt = $this->_conn->prepare("SELECT password FROM users WHERE username=:username");
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        
        //User found
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $passwordFromDB = $result['password'];
            
            return password_verify($enteredPassword, $passwordFromDB); 
            
            //if ($password === $result['password']) {
            //    return array(
            //    'username' => $result['username'],
            //    'user_id' => $result['user_id'],
            //    'email' => $result['email']
            //    );
            //}
        }
        
        //User not found
        return false;
    }

    /**
     * Creates a new user record in the database with the supplied information.
     *///userName,email,password
    public function addPodcast($title, $description, $image,$author,$url,$duration,$publish_date)
    {
        $stmt = $this->_conn->prepare('INSERT INTO podcasts ' .
                                      '(title, description, image, author, url, duration, publish_date) ' .
                                      'VALUES (:title, :description, :image, :author, :url, :duration, :publish_date) ');
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->bindParam(':author', $author, PDO::PARAM_STR);
        $stmt->bindParam(':url', $url, PDO::PARAM_STR);
        $stmt->bindParam(':duration', $duration, PDO::PARAM_STR);
        $stmt->bindParam(':publish_date', $duration, PDO::PARAM_STR);


        try {
            $stmt->execute();
        } catch (PDOException $error) {
            die ("(!) There was an error adding " . $title . " to the database... " . $error);
        }

        return $this->_conn->lastInsertId();
    }


    /**
     * Return a list of all available podcast topics/tags
     * @param $limit
     * @return array|null
     */
    public function getAllTopics() {
        $topics = array();

        $sqlStatement = 'SELECT tag_name as topic
                         FROM podcast_tags
                         NATURAL JOIN podcast_tag_join
                         WHERE tag_name <> \'\'
                         GROUP BY tag_id
                         ORDER BY tag_name ASC';

        $stmt = $this->_conn->prepare($sqlStatement);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($record = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $topics[] = $record['topic'];
            }
            return $topics;
        }
        return null;
    }

    /**
     * Return a list of all available priority podcast topics/tags
     * @param $limit
     * @return array|null
     */
    public function getPriorityTopics() {
        $topics = $this->getPriorities();

        return $topics;
    }

    /**
     * Returns an array of all the current priority topic records
     * @return array Array of priorities
     */
    public function getPriorities() {
        $priorities = array();
        $stmt = $this->_conn->prepare('SELECT tag_string as tag
                                       FROM tag_priority');
        try {
            $stmt->execute();
        } catch (PDOException $error) {
            die ("(!) There was an retrieving topics from the database... " . $error);
        }

        if ($stmt->rowCount() > 0) {
            while ($record = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $priorities[] = $record['tag'];
            }
            return $priorities;
        }
        return null;
    }

    public function writePriorities() {
        $this->resetPriorities();

        $stmt = $this->_conn->prepare('INSERT INTO tag_priority VALUES 
                                       (:priority, :topic)');

        for($i = 1; $i <= $_POST['count']; $i++) {
//            echo 'Topic ' . $i . ': ' . $_POST['priority-' . $i];
            $stmt->bindParam(':priority', $i, PDO::PARAM_INT);
            $stmt->bindParam(':topic', $_POST['priority-' . $i], PDO::PARAM_STR);
            $stmt->execute();
        }
    }
    
    
    /**
     * Retrieves all podcast host. Returns results in an array of
     * Podcast Host objects.
     * 
     * @return array Array of Podcast Host object results
     */
    public function getPodcastHosts() {
        $stmt = $this->_conn->prepare("
            SELECT host_id, first_name, last_name, image, bio
            FROM podcasthost
            ORDER BY host_id
            ");

        if($stmt->execute()) {
            $podcastHosts = [];

            while ($record = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $hostId = $record['host_id'];
                $firstName = $record['first_name'];
                $lastName = $record['last_name'];
                $image = $record['image'];
                $bio = $record['bio'];
                                
                //Create new Podcast Host object and add to array
                $newPodcastHost = new PodcastHost($hostId, $firstName, $lastName, $image, $bio);
                $podcastHosts[] = $newPodcastHost;
            }

            return  $podcastHosts;
        }
    }


// METHODS - SUB-ROUTINES


    /**
     * Wipes all data from the tag_priority table.
     * @return bool true if successful, false otherwise
     */
    private function resetPriorities() {
        $stmt = $this->_conn->prepare('TRUNCATE TABLE tag_priority');
        try {
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}
