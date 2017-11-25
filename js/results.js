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
var publishDate = $('.pc-publish-date');
var podcastImage = $('.pc-image');
var downloadInfo = $('.open-podcast-info');

$('document').ready(function() {
    // Add click listener to podcast title dive
    title.on('click', function() {
        // If description of clicked title is already visible, slide up
        // and hide overflow of title
        if ($(this).next('.pc-description').is(':visible')) {
            $(this).next('.pc-description').slideUp('fast');
            $(this).toggleClass('hide-title');
            $(this).children('.title-itself').children('.date-image-switch').children('.pc-publish-date').toggle();
            $(this).children('.title-itself').children('.date-image-switch').children('.true-title').children('.pc-image').toggle();
            $(this).children('.title-itself').children('.open-podcast-info').toggle();
            
        } else {   
            // Hide all descriptions in case one is open
            description.hide('fast');
            podcastImage.hide('fast');
            publishDate.show('fast');
            downloadInfo.hide('fast');
            
            // Reset all titles so that overflow is hidden
            title.addClass('hide-title');
            
            // Show only the description for the clicked title
            $(this).next('.pc-description').slideDown('fast');
            
            // Toggle title overflow, wrap, and font-size (make larger)
            $(this).toggleClass('hide-title');
            
            // Show Image in place of Published Date
            $(this).children('.title-itself').children('.date-image-switch').children('.pc-publish-date').toggle();
            $(this).children('.title-itself').children('.date-image-switch').children('.true-title').children('.pc-image').toggle();
            $(this).children('.title-itself').children('.open-podcast-info').toggle();
            
        }
    });
});
