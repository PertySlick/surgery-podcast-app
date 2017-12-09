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
    }

    public function adminSubmit($f3)
    {
        $db = new DbOperator();

        if ($_POST['action'] === 'priority') {
            $db->writePriorities();
        }

        $this->admin($f3);
    }


// METHODS - SUB-ROUTINES

    // TODO: Separate out title and description settings for flexibility

}
