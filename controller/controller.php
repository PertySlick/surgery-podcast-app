<?php

/*
 * File Name: controller.php
 * Author: Timothy Roush
 * Date Created: 10/11/17
 * Assignment: Behind The Knife: The Surgery Podcast
 * Description: Controller Component Of MVC Architecture
 */

/**
 * Provides a separation of logic and output for the Surgery Podcast app.
 * Processes and prepares all data required to produce each view in the routing
 * document
 *
 * @author Timothy Roush
 * @copyright 2017
 * @version 1.0
 * @see index.php
 */
class Controller {


// FIELDS, CONSTANTS, OBJECTS





// CONSTRUCTOR


    /**
     * Creates an instance of the Constructor object by initiating a DbOperator
     * object.
     */
    public function __construct() {
        // Empty Operator
    }


// METHODS - MAIN ROUTE OPERATIONS


    /**
     * Handles all logic for the initial IFrame display page.
     * @param $f3 Object Fat Free object
     */
    public function iframe($f3)
    {
        // Set environment tokens
        $f3->mSet(array(
            'title' => 'BTK Surgery Podcast',
            'description' => 'Behind The Knife:  The Surgery Podcast',
            'iframe' => true
        ));
    }

    /**
     * Handles all logic for the main home page.
     * @param $f3 Object Fat Free object
     */
    public function home($f3)
    {
        // Set environment tokens
        $f3->mSet(array(
            'title' => 'BTK Surgery Podcast',
            'description' => 'Behind The Knife:  The Surgery Podcast'
        ));

        // Connect to database
        $db = new DbOperator();
        
        // Store the 3 most recent podcasts
        $f3->set('podcasts', $db->retrieveRecentPodcasts());
        
        // Store topics for building links
        $f3->set('topics', $db->getPriorityTopics());
    }

    /**
     * Fetches all podcast records that match the supplied tag and assigns the
     * results to an F3 variable.
     * @param $f3 Object F3 object
     * @param $params array Tokens received by F3 object
     */
    public function topic($f3, $params)
    {
        $f3->mSet(array(
            'title' => 'BTK Podcasts By Topic',
            'description' => 'Behind The Knife:  Browse podcasts by topic',
            'keyword' => $params['tag']
        ));

        $db = new DbOperator();
        $f3->set('podcasts', $db->getPodcastByTag($params['tag']));
    }
    
    public function about($f3)
    {
        $f3->mSet(array(
            'title' => 'BTK Podcasts By Topic',
            'description' => 'Behind The Knife:  Browse podcasts by topic'
        ));
        
        $db = new DbOperator();
        
        // Get and store list of podcast hosts
        $f3->set('hosts', $db->getPodcastHosts());
    }
    
    public function login($f3)
    {
        $f3->mSet(array(
            'title' => 'BTK Podcasts By Topic',
            'description' => 'Behind The Knife:  Browse podcasts by topic'
        ));
    }
    
    public function verifyLogin($f3)
    {   
        //If form was submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //initialize errors array
            $errors = [];
                    
            //Make sure username and password were entered
            if(isset($_POST['username']) && isset($_POST['password'])) {
                //Get form data
                $enteredUsername = $_POST['username'];
                $enteredPassword = $_POST['password'];
                
                //Make for sticky
                $f3->mSet(array(
                    'username' => $enteredUsername,
                    'password' => $enteredPassword
                ));
                      
                //Validate login information
                
                if (strlen($enteredUsername) < 1) {
                    $errors[] = 'Please enter your username';
                }
                
                if (strlen($enteredPassword) < 1) {
                    $errors[] = 'Please enter your password';
                }
                                
                //If username and password were entered, verify
                if(count($errors) == 0) {
                    $db = new DbOperator();
                    
                    $loginSuccess =
                        $db->areCredentialsValidated
                            ($enteredUsername, $enteredPassword);  
                
                    if($loginSuccess == false) {
                        $errors[] = 'Incorrect username or password.';
                    }
                }
            } else {
                $errors[] = 'Username or password was not entered.';
            }
            
            //If no login errors, store session variable
            if(count($errors) == 0) {
                $_SESSION['user'] = $enteredUsername;
            } else { //login failed
                $f3->set('errors', $errors);
            }
        } 
    }

    /**
     * Handles all logic for the admin portal page.
     * @param $f3 Object Fat Free object
     */
    public function admin($f3)
    {
        // Set environment tokens
        $f3->mSet(array(
            'title' => 'BTK Surgery Podcast',
            'description' => 'The Surgery Podcast - Admin Portal',
            'iframe' => true
        ));

        $db = new DbOperator();

        // Get and store list of all topics
        $f3->set('topics', $db->getAllTopics());

        // Get and store list of tag priorities
        $f3->set('priorities', $db->getPriorities());
        
        // Get and store list of podcast hosts
        $f3->set('hosts', $db->getPodcastHosts());
    }

    public function adminSubmit($f3)
    {
        $db = new DbOperator();

        if ($_POST['action'] === 'priority') {
            $db->writePriorities();
        }

        $this->admin($f3);
    }
 
    
 /**
   * Deletes a podcast host from the database
   *
   * @access public
   * 
   * @param $f3 Object F3 object
   * @param $params host id for the host to be deleted
   */
    public function deleteHost($f3, $params)
    {
        $db = new DbOperator();
        
        //Get image file name from database
/*        $imageFileName = $db->getPodcastHostImageFileName($params['hostId']);
        
        if ($imageFileName != 'image does not exist') {   
            //Delete image from server (from img directory)
            unlink("./img/$imageFileName");
            
            //Delete podcast host info from database
            $db->deletePodcastHost($params['hostId']);
        } */
        
        //Delete podcast host info from database
        $db->deletePodcastHost($params['hostId']);
        
        //Refresh admin page
        $this->admin($f3);
    }
    
    
    /**
     * Adds a podcast cost into the database
     *
     * @access public
     * @param $f3 Object F3 object
     */
    public function addPodcastHost($f3)
    {
        //Check if form was submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if(isset($_POST['first-name']) && isset($_POST['last-name'])
               && isset($_POST['bio']) && isset($_FILES["photo"]["name"])) {
                
                //Store info from post
                $firstName = trim($_POST['first-name']);
                $lastName = trim($_POST['last-name']);
                $bio = trim($_POST['bio']);
                $imageFileName = basename($_FILES["photo"]["name"]);
                
                //Move image to img directory
                move_uploaded_file($_FILES["photo"]["tmp_name"],
                    "./img/" . basename($_FILES["photo"]["name"]));
                
                //Add to database
                $db = new DbOperator();
                
                $db->addPodcastHost($firstName, $lastName,
                                    $bio, $imageFileName);
                
                //Refresh admin page
                $this->admin($f3);
            }
        }
    }
    
       
 /**
   * Retrieves info for the specified podcast host
   *
   * @access public
   * 
   * @param $f3 Object F3 object
   * @param $params host id for the host to be deleted
   */
    public function getHostInfo($f3, $params)
    {
        //Store hostId in session
        $_SESSION['hostId'] = $params['hostId'];
        
        $db = new DbOperator();
        
        //Get podcast host info from database (used to make the
        //form sticky)
        $f3->set('podcastHost', $db->getPodcastHostById($params['hostId']));
    }
    
    
 /**
   * Updates podcast host info in database
   *
   * @access public
   * 
   * @param $f3 Object F3 object
   */
    public function updateHostInfo($f3)
    {
        //Initialize all variables
        $firstName = '';
        $lastName = '';
        $bio = '';
        $imageFileName = '';
        $hostId = $_SESSION['hostId'];
        
        if (isset($_FILES["photo"]["name"]) && $_FILES["photo"]["name"] != '') {
            $imageFileName = basename($_FILES["photo"]["name"]);
                
            //Move image to img directory
            move_uploaded_file($_FILES["photo"]["tmp_name"],
                "./img/" . basename($_FILES["photo"]["name"]));
        } else {
            $imageFileName = $_POST['orig-photo'];
        }
            
        if(isset($_POST['first-name']) && isset($_POST['last-name'])
           && isset($_POST['bio'])) {
            
            $firstName = trim($_POST['first-name']);
            $lastName = trim($_POST['last-name']);
            $bio = trim($_POST['bio']);
        }
        
        //echo '<pre>';
        //print_r($_POST);
        //print_r($_SESSION);
        //print_r($_FILES);
        //
        //var_dump($hostId);
        //
        //var_dump($firstName);
        //
        //var_dump($lastName);
        //var_dump($bio);
        //
        //var_dump($imageFileName);
        //echo '<pre>';
        
        if ($firstName != '' && $lastName != '' && $bio != ''
            && $imageFileName != '') {
            
            //Add to database
            $db = new DbOperator();
            
            $db->updatePodcastHost($hostId, $firstName, $lastName,
                                $bio, $imageFileName);
        } else {
            echo 'Error: Could not update podcast host.';
        }
             
        //Refresh admin page
        $this->admin($f3); 
    }


// METHODS - SUB-ROUTINES

    // TODO: Separate out title and description settings for flexibility

}
