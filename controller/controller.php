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


    private $db;


// CONSTRUCTOR


    /**
     * Creates an instance of the Constructor object by initiating a DbOperator
     * object.
     */
    public function __construct() {
        $db = new DbOperator();
    }


// METHODS - MAIN ROUTE OPERATIONS


/**
     * Handles all logic for the main home page.
     * @param $f3 Fat Free object
     */
    public function home($f3)
    {
        // Set environment tokens
        $f3->mSet(array(
            'title' => 'BTK Surgery Podcast',
            'description' => 'Behind The Knife:  The Surgery Podcast'
        ));
    }
}
