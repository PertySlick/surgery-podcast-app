/*
    * File Name: results.js
    * Authors: Marlene Leano
    * Date Created: 11/07/2017
    * Assignment: Behind The Knife: The Surgery Podcast
    * Description:  Slide up and down functionality for the results list
*/

var player = document.getElementById('new-player');     // Audio Player
var $player = $('#new-player');
var $playButton = $('#play-button');                    // Actual Play Button
var $duration = $('#progress-total');                   // Total Duration Bar
var $progress = $('#progress-actual');                  // Progress Indicator
var $durationTime = $('#current-duration');             // Duration Time Display
var $progressTime = $('#current-position');             // Progress Time Display
var pauseClass = 'fa fa-pause';                         // Class For Pause Button
var playClass = 'fa fa-play';                           // Class For Play Button


$('document').ready(function() {

    // Set initial duration value
    $player.on('loadeddata', setDuration);

    $('#play').on('click', togglePlay);
    $duration.on('click', seekFunction);
    $player.on('timeupdate', updateProgress);
    $player.on('play', { play: false }, togglePlayButton);
    $player.on('pause', { play: true }, togglePlayButton);

});