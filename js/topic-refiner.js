/*
    * File Name: topic-refiner.js
    * Authors: Timothy Roush
    * Date Created: 11/25/17
    * Assignment: Behind The Knife: The Surgery Podcast
    * Description:  Allows user to refine list of topics
*/

var $topicWrapper = $('.topic-wrapper');                        // Wrapper for entire topic list
var $searchInput = $('input#topic-search-bar');                 // Query input field
var initialHTML = '';                                           // Initialize variable for initial HTML of wrapper
var noResultsMsg;
var topicList = new Array();                                    // Initialize array for storing topics

$('document').ready( function() {
    initialHTML = $topicWrapper.html();                         // Save initial topics list
    noResultsMsg = '<div class="no-results-msg">' +             // Store text HTML indicating no search results
                    'No topics match your search' +
                    '</div>';

    $searchInput.on('input', getTopics);
});


function getTopics() {
    var $searchQuery = $(this).val();

    if ($searchQuery.trim().length > 0) {

        $.ajax({
            url: 'model/ajaxoperator.php',
            method: 'POST',
            data: {
                action: 'getTopicsByQuery',
                query: $searchQuery
            },
            success: function (result) {
                topicList = result;
                populateTopics();
            },
            error: function (x, s, e) {
                console.log('ERROR' + x + ' // ' + s + '//' + e);
            },
            dataType: 'json'
        });
    } else {
        $topicWrapper.html(initialHTML);
    }
}

function populateTopics() {
    if (topicList.length > 0) {
        var newHtml = '';

        topicList.forEach( function(topic) {
            var htmlString = '<a href="topic/' + topic + '"><div class="topic">' + topic + '</div></a>';
            newHtml += htmlString;
        });

        $topicWrapper.html(newHtml);
    } else {
        $topicWrapper.html(noResultsMsg + initialHTML);
    }
}

// Save initial topic-wrapper HTML for empty query

//populate list of topics based on queries