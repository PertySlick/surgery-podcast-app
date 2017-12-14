<?php

/*
* File Name: ajaxoperator.php
* Author: Timothy Roush
* Date Created: 11/25/2017
* Assignment: Behind the Knife: Surgery Podcast database operations
* Description:  Model MVC Component - Handles AJAX Operations
*/

// Database connection object
$conn = constructPDO();

if (isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    $action($conn);
}

function constructPDO() {
    // Require Configuration File
    require_once '/home/troush/secure/credentials_surgerypodcast.inc.php';
    //require_once '../../../credentials/credentials_surgerypodcast.inc.php';

    // Establish Database Connection And Set Attributes
    try {
        $newConnection = new PDO( DB_DSN, DB_USER, DB_PASSWORD );
        $newConnection->setAttribute( PDO::ATTR_PERSISTENT, true );
        $newConnection->setAttribute(
            PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION
        );
    } catch ( PDOException $e ) {
        echo "(!) Error - Connection Failed: " . $e->getMessage();
    }

    return $newConnection;
}

/*
* Grabs all topics that start with the supplied query string
*/
function getTopicsByQuery($conn) {
    $query = $_POST['query'];

    $queryString = $query . '%';

    $stmt = $conn->prepare('SELECT tag_name AS topic ' .
                                  'FROM podcast_tags ' .
                                  'WHERE tag_name LIKE :queryString');
    $stmt->bindParam(':queryString', $queryString, PDO::PARAM_STR);

    try {
        $stmt->execute();
    } catch (PDOException $error) {
        echo ("(!) There was an retrieving topics from the database... " . $error);
    }

    if ($stmt->rowCount() > 0) {
        while ($record = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $topics[] = $record['topic'];
        }
        echo json_encode($topics);
        return;
    } else {
        echo json_encode('');
    }
}


/*
 * Validated login credientials (used in validation via JavaScript)
 */
function validateLogin($conn) {
    $user = $_POST['username'];
    $inputPassword = $_POST['password'];
    
    $stmt = $conn->prepare('SELECT username, password ' .
                            'FROM users ' .
                            'WHERE username = :user');
    $stmt->bindParam(':user', $user, PDO::PARAM_STR);
    
    try {
        $stmt->execute();
    } catch (PDOException $error) {
        echo ('Error connecting to the database: ' . $error);
    }
    
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $passwordInDb = $row['password'];
        
        $doPasswordsMatch = password_verify($inputPassword, $passwordInDb);
        
        echo json_encode($doPasswordsMatch);
    } else { //user not found
        echo json_encode(false);
    }
}


/*
 * Validated image (used in validation via JavaScript)
 */
function validateImage($conn) {
    $imageFileName = $_POST['imageFileName'];
    
    $stmt = $conn->prepare('SELECT * ' .
                            'FROM podcasthost ' .
                            'WHERE image = :image');
    $stmt->bindParam(':image', $imageFileName, PDO::PARAM_STR);
    
    try {
        $stmt->execute();
    } catch (PDOException $error) {
        echo ('Error connecting to the database: ' . $error);
    }
    
    if ($stmt->rowCount() > 0) {
        //$row = $stmt->fetch(PDO::FETCH_ASSOC);
        //
        //$passwordInDb = $row['password'];
        //
        //$doPasswordsMatch = password_verify($inputPassword, $passwordInDb);
        
        echo json_encode(true);
    } else { //user not found
        echo json_encode(false);
    }
}