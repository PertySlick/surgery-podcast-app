<?php

/*
 * File Name: podcast.php
 * Author: Timothy Roush
 * Date Created: 10/28/17
 * Assignment: The Surgery Podcast
 * Description: An object taht represents all the relevant data related to a
 *              podcast object.
 */

/**
 * Provides an instanciatiable class object for storing and retrieving all data
 * relevant to a single podcast.
 *
 * @author CodeWorks - Timothy Roush
 * @copyright 2017
 * @version 1.0
 */
abstract class Podcast {


// FIELDS


    private $title;
    private $publishDate;
    private $url;
    private $description;
    private $duration;
    private $keywords;


// CONSTRUCTORS


    /**
    * Creates an instance of a podcast storing all relevant data to a single
    * podcast.  All supplied data is assigned before initializing the array for
    * keywords.
    * @param String title Podcast title
    * @param String publishDate Date podcast was published
    * @param String url URL to access podcast
    * @param String description Podcast description
    * @param String duration Length of podcast
    */
    public function __construct($title, $publishDate,  $url,
                                $description, $duration) {
        $this->keywords = array();
    }


// METHODS - GETTERS


    /**
    * Returns the title for this podcast
    * @return String title
    */
    public function getTitle() {
        return $this->title;
    }

    /**
    * Returns the publish date for this podcast
    * @return String publishDate
    */
    public function getPublishDate() {
        return $this->publishDate;
    }

    /**
    * Returns the access url for this podcast
    * @return String url
    */
    public function getUrl() {
        return $this->url;
    }

    /**
    * Returns the description for this podcast
    * @return String description
    */
    public function getDescription() {
        return $this->description;
    }

    /**
    * Returns the duration for this podcast
    * @return String duration
    */
    public function getDuration() {
        return $this->duration;
    }

    /**
    * Returns the keywords for this podcast in an array of strings.  If no
    * keywords exist, null is returned.
    * @return String[] keywords or null
    */
    public function getKeywords() {
        return $this->keywords;
    }


// METHODS - SETTERS


    /**
    * Sets the title for this podcast
    * @param String title Podcast title
    */
    private function setTitle($title) {
        $this->title = $title;
    }

    /**
    * Sets the published date for this podcast
    * @param String publishDate Date podcast was published
    */
    private function setPublishDate($publishDate) {
        $this->publishDate = $publishDate;
    }

    /**
    * Sets the url for this podcast
    * @param String url URL to access podcast
    */
    private function setUrl($url) {
        $this->url = $url;
    }

    /**
    * Sets the description for this podcast
    * @param String description Podcast description
    */
    private function setDescription($description) {
        $this->description = $description;
    }

    /**
    * Sets the duration for this podcast
    * @param String duration Length of podcast
    */
    private function setDuration($duration) {
        $this->duration = $duration;
    }

    /**
    * Adds a single keyword to this podcast
    * @param String keyword Keyword to add to podcast
    */
    public function addKeyword($keyword) {
        $keywords[] = $keyword;
    }
