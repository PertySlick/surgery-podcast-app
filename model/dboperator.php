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
        require_once '../../secure/credentials_surgerypodcast.inc.php';

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
            SELECT podcast_id, title, description, url, duration, publish_date 
            FROM podcasts
            NATURAL JOIN podcast_tags
            NATURAL JOIN podcast_tag_join
            WHERE tag_name = :tag
            ");
        $stmt->bindParam(":tag", $tag);

        if($stmt->execute()) {
            $podcasts = array();

            while ($record = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $title = $record['title'];
                $publishDate = $record['publishDate'];
                $url = $record['url'];
                $description = $record['description'];
                $duration = $record['duration'];
                $newPodcast = new Podcast($title, $publishDate, $url, $description, $duration);
                $podcasts[] = $newPodcast;
            }

            return  $podcasts;
        }


    }
    
    public function searchByKeyword($tag_name,$title,$description)
    {
        
    }
    
    /**
 * Checks the top 3 recent podcasts and displays them in descending order
 * LIMIT 3 - The top 3 recent podcast rows
 * GROUP BY podcast_id - the auto incremented number each time a podcast is added
 */
    public function checkTopThreePodcasts($id)
    {
        $stmt = $this->_conn->prepare("SELECT * FROM podcasts GROUP BY podcast_id ORDER BY podcast_id DESC LIMIT 3");
        $stmt->bindParam(":pod_castid", $id);
        $stmt-execute();
    
    
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
     * @param $email String email used in login attempt
     * @param $password String hashed value of password used in login attempt
     * @return array of user data if validated, null otherwise
     */
    public function checkAdminCredentials($user, $password)
    {
        $stmt = $this->_conn->prepare("SELECT * FROM users WHERE username=:username");
        $stmt->bindParam(":username", $user);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($password === $result['password']) {
                return array(
                'username' => $result['username'],
                'user_id' => $result['user_id'],
                'email' => $result['email']
                );
            }
        }
        return null;
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


    public function getTopics() {
        $topics = array();

        $stmt = $this->_conn->prepare('
            SELECT tag_name as topic
            FROM podcast_tags 
            NATURAL JOIN podcast_tag_join 
            WHERE tag_name <> \'\'
            GROUP BY tag_id 
            ORDER BY COUNT(tag_name) DESC
        ');

        try {
            $stmt->execute();
        } catch (PDOException $error) {
            die ("(!) There was an retrieving topics from the database... " . $error);
        }

        if ($stmt->rowCount() > 0) {
            while ($record = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $topics[] = $record['topic'];
            }
            return $topics;
        }
        return null;
    }

}
