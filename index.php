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
$f3->set('iframe', false);                         // Set Initial IFrame Toggle Value
$f3->set('fontAwesome', true);                     // Initialize FontAwesome Toggle
$controller = new Controller();                    // MVC Controller object


/* ====== BEGIN ROUTE DEFINITIONS ====== */


//Default route
// TODO: Route needs controller functionality
$f3->route('GET /', function($f3) use ($controller) {
    $controller->iframe($f3);
    echo Template::instance()->render('view/iframe.html');
});

// Home page route
$f3->route('GET /home', function($f3) use ($controller) {
    $f3->set('fontAwesome', true);
    $controller->home($f3);
    echo Template::instance()->render('view/home.html');
});

//
$f3->route('GET /topic/@tag', function($f3, $params) use ($controller) {
    $f3->set('fontAwesome', true);
    $controller->topic($f3, $params);
    echo Template::instance()->render('view/podcastresults.html');
});

////
//$f3->route('GET /topic', function($f3, $params) use ($controller) {
//    //$controller->topic($f3, $params);
//    echo Template::instance()->render('view/topic.html');
//});
//
//// Podcast player route
//$f3->route('GET /play', function($f3) use ($controller) {
//    echo Template::instance()->render('view/player.html');
//});
//
//// Alternate Topics Page
//$f3->route('GET /newtopic', function($f3) use ($controller) {
//    $f3->set('fontAwesome', true);
//    echo Template::instance()->render('view/newtopic.html');
//});

// Route to the About Us page
$f3->route('GET /about', function($f3) use ($controller) {
    $controller->about($f3);
    echo Template::instance()->render('view/about.html');
});

// Route to admin login or to admin portal
$f3->route('GET /admin', function($f3) use ($controller) {
    //If user is already logged in
    if(isset($_SESSION['user'])) {
        $f3->set('fontAwesome', true);
        $controller->admin($f3);
        echo Template::instance()->render('view/admin.html');
    } else { //user is not logged in
        $controller->login($f3);
        echo Template::instance()->render('view/login.html'); 
    }
});

// Validate login info then route to appropriate page
$f3->route('POST /admin', function($f3) use ($controller) {
    //Verify login info
    $controller->verifyLogin($f3);
    
    //If verified, route to admin page
    if(isset($_SESSION['user'])) { 
        $controller->adminSubmit($f3);
        echo Template::instance()->render('view/admin.html');
    } else { //Login failed, return to login page
        $controller->login($f3);
        echo Template::instance()->render('view/login.html'); 
    }
});

// Route to add a new podcast host to the About Us
$f3->route('POST /addPodcastHost', function($f3) use ($controller) {
    $controller->addPodcastHost($f3);
    echo Template::instance()->render('view/admin.html');
});

// Route to edit podcast host for About Us 
$f3->route('GET /editHost/@hostId',
           function($f3, $params) use ($controller) {
    $controller->getHostInfo($f3, $params);
    echo Template::instance()->render('view/edit.html');
});

$f3->route('POST /editHost', function($f3) use ($controller) {
    $controller->updateHostInfo($f3);
    echo Template::instance()->render('view/admin.html');
});

// Delete podcast host from the About Us 
$f3->route('GET /deleteHost/@hostId',
           function($f3, $params) use ($controller) {
    $controller->deleteHost($f3, $params);
    echo Template::instance()->render('view/admin.html');
});

// Log out admin
$f3->route('GET /logout', function($f3) {
    
        //Delete previous session variables
        unset($_SESSION);
        session_destroy();
        
        //load a template
        echo Template::instance()->render('view/login.html');
});

//Run fat free
$f3->run();
