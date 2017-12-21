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
 * @author Marlene Leano
 * @author Nathan Strand
 * @author Timothy Roush
 * @copyright 2017
 * @version 1.0
 * @see Podcast.java
 * @see PodcastHost.java
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
        //require_once '../../credentials/credentials_surgerypodcast.inc.php';

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


// METHODS - MAIN SITE OPERATIONS


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
                
                //Create new Podcast object and add to array
                $newPodcast = new Podcast($title, $publishDate, $url, $image, $description, $duration);
                $podcasts[] = $newPodcast;
            }
            return  $podcasts;
        }
        return null;
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
                
                //Create new Podcast object and add to array
                $newPodcast = new Podcast($title, $publishDate, $url, $image, $description, $duration);
                $podcasts[] = $newPodcast;
            }

            return  $podcasts;
        }
        return null;
    }

    /**
     * Return a list of all available podcast topics/tags
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
     * @return array|null
     */
    public function getPriorityTopics() {
        $topics = $this->getPriorities();
        return $topics;
    }


// METHODS - PODCAST HOST OPERATIONS (Team Members)


    /**
     * Retrieves all podcast host. Returns results in an array of
     * Podcast Host objects.
     *
     * @access public
     *
     * @return array Array of Podcast Host object results
     */
    public function getPodcastHosts()
    {
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
        return null;
    }

    /**
     * Retrieves the image filename for the specified podcast host
     *
     * @access public
     *
     * @param int $hostId the host id for the specified podcast host
     * @return string image file name for the specified podcast host, "image
     * does not exist" otherwise
     */
    public function getPodcastHostById($hostId)
    {
        $stmt = $this->_conn->prepare("
            SELECT * FROM podcasthost
            WHERE host_id = :host_id
            ");

        $stmt->bindParam(':host_id', $hostId, PDO::PARAM_INT);
        $stmt->execute();

        //Initialize podcast host object
        $podcastHost = null;

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $hostId = $row['host_id'];
            $firstName = $row['first_name'];
            $lastName = $row['last_name'];
            $image = $row['image'];
            $bio = $row['bio'];

            //Create new Podcast Host object and add to array
            $podcastHost = new PodcastHost($hostId, $firstName, $lastName, $image, $bio);

            return $podcastHost;
        }
        return null;
    }

    /**
     * Deletes the specified host from the database
     *
     * @access public
     * @param int $hostId the host id
     */
    public function deletePodcastHost($hostId)
    {
        $stmt = $this->_conn->prepare("
            DELETE FROM podcasthost
            WHERE host_id=:hostId
            ");

        $stmt->bindParam(':hostId', $hostId, PDO::PARAM_INT);

        $stmt->execute();
    }

    /**
     * Adds a new podcast host to the database'
     *
     * @access public
     *
     * @param String $firstName the podcast host's first name
     * @param String $lastName the podcast host's last name
     * @param String $bio the podcast host's biography
     * @param String $image the podcast host's photo
     */
    public function addPodcastHost($firstName, $lastName, $bio, $image)
    {
        $stmt = $this->_conn->prepare("
            INSERT INTO podcasthost (first_name, last_name, bio, image)
            VALUES (:first_name, :last_name, :bio, :image)
            ");

        $stmt->bindParam(':first_name', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':bio', $bio, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);

        $stmt->execute();
    }

    /**
     * Updates podcast host info in the database'
     *
     * @access public
     *
     * @param int $hostId record number for this host
     * @param String $firstName the podcast host's first name
     * @param String $lastName the podcast host's last name
     * @param String $bio the podcast host's biography
     * @param String $image the podcast host's photo
     * @return int the host id of the last inserted podcast host
     */
    public function updatePodcastHost($hostId, $firstName, $lastName, $bio, $image)
    {
        $stmt = $this->_conn->prepare("
            UPDATE podcasthost
            SET first_name = :first_name,
                last_name = :last_name,
                bio = :bio,
                image = :image
            WHERE host_id = :host_id
            ");

        $stmt->bindParam(':host_id', $hostId, PDO::PARAM_INT);
        $stmt->bindParam(':first_name', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':bio', $bio, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);

        $stmt->execute();
        return null;
    }


// METHODS - ADMIN: VALIDATION / LOGON


    //TODO: Clean up this portion and make use of verify subroutine
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

            $input = hash('sha256', $enteredPassword);

            return $input === $passwordFromDB;
            //return passwordVerify($enteredPassword, $passwordFromDB);
        }

        //User not found
        return false;
    }


// METHODS - ADMIN: RSS / DB UPDATE


    /**
     * Returns the number of podcast records currently stored in the database.
     * @return string Count of all records in podcast table
     */
    public function getPodcastCount() {
        $stmt = $this->_conn->prepare('SELECT COUNT(*) as count FROM podcasts');
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        return $record['count'];
    }


// METHODS - ADMIN: TOPIC PRIORITIES


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

    /**
     * Resets the priorities table by removing all current data and saves the
     * new topic priority settings to match the users input.  Updates the
     * database to reflect each topic row with the appropriate topic value.
     */
    public function writePriorities() {
        $this->resetPriorities();

        $stmt = $this->_conn->prepare('INSERT INTO tag_priority VALUES 
                                       (:priority, :topic)');

        for($i = 1; $i <= $_POST['count']; $i++) {
            $stmt->bindParam(':priority', $i, PDO::PARAM_INT);
            $stmt->bindParam(':topic', $_POST['priority-' . $i], PDO::PARAM_STR);
            $stmt->execute();
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

    /**
     * Compares a supplied password input to a stored password hash and returns
     * the results.  Input is hashed using Sha256 before comparison.
     * @param $input string Password entered as input
     * @param $stored string Password hash stored in database
     * @return bool true if match, false otherwise
     */
    public function passwordVerify($input, $stored) {
        $input = hash('sha256', $input);
        return ($input == $stored);
    }

}