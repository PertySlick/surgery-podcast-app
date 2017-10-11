<?php
    /*
    
    */
    
    //Require autoload
    error_reporting('E_ALL');
    require_once('vendor/autoload.php');
    
    //Start session
    session_start();    
      
    //Create an instance of the Base class
    $f3 = Base::instance();
    
    //Instantiate the ? class
 //   $DB = new DB();
    
    //Define a default route
    $f3->route('GET /', function($f3) {               
        //load a template
        echo Template::instance()->render('pages/home.html');
    });
    

    //Run fat free
    $f3->run();