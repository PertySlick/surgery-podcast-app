<?php
/*
 * File Name: index.php
 * Author: Marlene Leano & Timothy Roush
 * Date Created: 10/10/17
 * Assignment: Behind The Knife: The Surgery Podcast
 * Description:  Main Routing Component Of MVC Architecture
 */

/**
 * Defines all routes and makes all calls to the Controller object to complete
 * them.
 *
 * @author Marlene Leano
 * @author Timothy Roush
 * @copyright 2017
 * @version 1.0
 */

// Dependancy And Session Initialization
require_once ('vendor/autoload.php');
session_start();

// File Path Constants
define('INCLUDES', 'includes/');
define('IMAGE_PATH', '/img/');
define('CSS_PATH', '/css/');
define('JS_PATH', '/js/');

// Initiate fat-free, and Controller objects and set defaults
$f3 = Base::instance();                            // Instance of Fat Free object
$f3->set('DEBUG', 3);                              // Set Fat Free debug level
$f3->set('INC', INCLUDES);                         // Set Includes File Path
$f3->set('IMG', $f3->get('BASE') . IMAGE_PATH);    // Set Image File Path
$f3->set('CSS', $f3->get('BASE') . CSS_PATH);      // Set CSS File Path
$f3->set('JS', $f3->get('BASE') . JS_PATH);        // Set JavaScript File Path
$f3->set('fontAwesome', false);                    // Initialize FontAwesome Toggle
$controller = new Controller();                    // MVC Controller object

//Instantiate the ? class
//   $DB = new DB();


/* ====== BEGIN ROUTE DEFINITIONS ====== */


//Default route
// TODO: Route needs controller functionality
$f3->route('GET /', function($f3) {
    echo Template::instance()->render('view/landing.html');
});

// Home page route
$f3->route('GET /home', function($f3) use ($controller) {
    $controller->home($f3);
    echo Template::instance()->render('view/home.html');
});

//
$f3->route('GET /topic/@tag', function($f3, $params) use ($controller) {
    $controller->topic($f3, $params);
    echo Template::instance()->render('view/topic.html');
});

//
$f3->route('GET /topic', function($f3, $params) use ($controller) {
    //$controller->topic($f3, $params);
    echo Template::instance()->render('view/topic.html');
});

// Podcast player route
// TODO: Route needs to be completed with functionality
$f3->route('GET /play', function($f3) use ($controller) {
    echo Template::instance()->render('view/player.html');
});

// Alternate Topics Page
$f3->route('GET /newtopic', function($f3) use ($controller) {
    $f3->set('fontAwesome', true);
    echo Template::instance()->render('view/newtopic.html');
});

// Results by topic selected
$f3->route('GET /resultsbytopic', function($f3) use ($controller) {
    $f3->set('fontAwesome', true);
    echo Template::instance()->render('view/resultsbytopic.html');
});

//Run fat free
$f3->run();
