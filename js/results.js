/*
    * File Name: results.js
    * Authors: Marlene Leano
    * Date Created: 11/07/2017
    * Assignment: Behind The Knife: The Surgery Podcast
    * Description:  Slide up and down functionality for the results list
*/

// Store reference to podcast title and description
var titleDiv = $('.pc-title');
var titleItself = $('.new-pc-title');
var description = $('.pc-description');

$('document').ready(function() {
    // Add click listener to podcast titles
    titleDiv.on('click', function() {
        // Toggle visibility of description
        description.slideToggle("fast");
        
        // Toggle title overflow
        titleItself.css('overflow', function(_, val) {
            return val == "hidden" ? "visible" : "hidden";
        });
        
        // Toddle title wrap
        titleItself.css('white-space', function(_, val) {
            return val == "nowrap" ? "normal" : "nowrap";
        });
    });

});