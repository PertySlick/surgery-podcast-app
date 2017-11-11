/*
    * File Name: results.js
    * Authors: Marlene Leano
    * Date Created: 11/07/2017
    * Assignment: Behind The Knife: The Surgery Podcast
    * Description:  Slide up and down functionality for the results list
*/

// Store reference to podcast title and description
var title = $('.pc-title');
var description = $('.pc-description');

$('document').ready(function() {
    // Add click listener to podcast title dive
    title.on('click', function() {
        // If description of clicked title is already visible, slide up
        // and hide overflow of title
        if ($(this).next('.pc-description').is(':visible')) {
            $(this).next('.pc-description').slideUp("fast");
            title.toggleClass('hide-title');
            //title.css('overflow', 'hidden').css('white-space', 'nowrap');
        } else {   
            // Hide all descriptions in case one is open
            description.hide('fast');
            
            // Show only the desc for the clicked title
            $(this).next('.pc-description').slideDown("fast");
            
            // Toggle title overflow, wrap, and font-size (make larger)
            $(this).css('overflow', 'visible').css('white-space', 'normal');
        }
    });
});
