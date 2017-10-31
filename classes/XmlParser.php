<?php

  /*
   * File Name: XmlParser
   * Author: Nathan Strand
   * Date Created: 10/31/17
   * Assignment: The Surgery Podcast
   * Description: A class that on construction will reach for the rss feed read it, grab the relevant information and print this as a string
   */
  
  class XmlParser{
    
    function __construct()
      {
        // The following takes in the feed from the hosted site and will then parse this into a
        // readable string for the SimpleXML onject to take
       
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
    
        // Finds the count of the number of Childen that are items (podcasts) 
        $itemCount = $xml->channel->item->count();
       
       
        // For the number of items record Title, link, Published Date, Description, Duration and Keywords.
        for($i = 0; $i < $itemCount; $i++) {
                          
        $title = $xml->channel->item[$i]->title;
        $link = $xml->channel->item[$i]->link;
        $pubDate = $xml->channel->item[$i]->pubDate;
        $description = $xml->channel->item[$i]->description;
        
        // Descriptions includes HTML. Removed these for storing in database
        $description = strip_tags($description);
        
        // To reach the SimpleXMl of the SimpeXML Tree the tree must be reset on Itunes XML and then grabbed
        $newtree = $xml->channel->item[$i]->children('http://www.itunes.com/dtds/podcast-1.0.dtd');
        
        $duration = $newtree->duration;
        $keyWords = $newtree->keywords;
        
        // Uncomment the following code to see the structure of the new SimpleXML Array
        //echo '<pre>';
        //var_dump($newtree);
        //echo '</pre>';
        
        // Currently being used to display the captured information in an easy to read structure and adding to a larger string $html
        $html .=  "\n" ."Title: $title \nPublished Date: $pubDate \nLink: $link \nDescription: $description \nDuration: $duration \nKeyWords: $keyWords" . "\n";
        }
        
        // Print the results
        echo $html;
        
      }
      
  }