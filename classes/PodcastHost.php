<?php

/*
 * File Name: PodcastHost.php
 * Author: Marlene Leano
 * Date Created: 12/09/2017
 * Assignment: The Surgery Podcast
 * Description: Creates an object that represents a podcast host.
 */

/**
 * This class creates an object that represents a podcast host.
 *
 * @author CodeWorks - Marlene Leano
 * @copyright 2017
 * @version 1.0
 */
class PodcastHost
{


// FIELDS

    private $host_id;
    private $first_name;
    private $last_name;
    private $image;
    private $bio;


// CONSTRUCTORS


    /**
     * Creates an instance of a podcast host storing the id, name,
     * image, and bio.
     * 
     * @param int $host_id Podcast title
     * @param String $first_name Date podcast was published
     * @param String $last_name URL to access podcast
     * @param String $image_link URL to the image for this podcast
     * @param String $bio Podcast description
     */
    public function __construct($host_id, $first_name, $last_name,
                                $image, $bio)
    {
        // Set fields values
        $this->setHostId($host_id);
        $this->setFirstName($first_name);
        $this->setLastName($last_name);
        $this->setImage($image);
        $this->setBio($bio);
    }


// METHODS - GETTERS


    /**
     * Returns host ID 
     * @return int host ID
     */
    public function getHostId()
    {
        return $this->host_id;
    }   
     
    /**
     * Returns the podcast host's first name
     * @return String the podcast host's first name
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Returns the podcast host's last name
     * @return String the podcast host's last name
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Returns the file name for the podcast host's image
     * @return String the file name for the podcast host's image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Returns the podcast host's biography
     * @return String the podcast host's biography
     */
    public function getBio()
    {
        return $this->bio;
    }



// METHODS - SETTERS


    /**
     * Sets the podcast host's id
     * @param int $hostId the podcast host's id
     */
    private function setHostId($hostId)
    {
        $this->host_id = $hostId;
    }
    
    /**
     * Sets the podcast host's first name
     * @param String $firstName the podcast host's first name
     */
    private function setFirstName($firstName)
    {
        $this->first_name = $firstName;
    }

    /**
     * Sets the podcast host's last name
     * @param String $lastName the podcast host's last name
     */
    private function setLastName($lastName)
    {
        $this->last_name = $lastName;
    }

    /**
     * Sets the image file name for the podcast host's pic
     * @param String image filename to access podcast host's pic
     */
    private function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Sets the podcast host's bio
     * @param String $bio the podcast host's bio
     */
    private function setBio($bio)
    {
        $this->bio = $bio;
    }
}
