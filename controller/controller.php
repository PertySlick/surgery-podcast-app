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
        //TODO:  Empty Operator?
    }


// METHODS - MAIN ROUTE OPERATIONS


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
    }
    
        public function iframe($f3)
    {
        // Set environment tokens
        $f3->mSet(array(
            'title' => 'BTK Surgery Podcast',
            'description' => 'Behind The Knife:  The Surgery Podcast'
        ));
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
            'description' => 'Behind The Knife:  Browse podcasts by topic'
        ));

        $db = new DbOperator();
        $f3->set('podcasts', $db->getPodcastByTag($params['tag']));
    }
    
    /* Handles all logic for the results by topic page.
     * @param $f3 Object Fat Free object
     */
    public function resultsByTopic($f3)
    {
        // Set environment tokens
        $f3->mSet(array(
            'title' => 'BTK Surgery Podcast',
            'description' => 'Behind The Knife:  The Surgery Podcast'
        ));
    }


// METHODS - SUB-ROUTINES

    // TODO: Separate out title and description settings for flexibility

}
