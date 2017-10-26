/*
    * File Name: player.js
    * Authors: Timothy Roush
    * Date Created: 10/25/17
    * Assignment: Behind The Knife: The Surgery Podcast
    * Description:  Custom Podcast Player Functionality
*/

var player = document.getElementById('new-player');     // Audio Player
var $playButton = $('#play-button');                    // Actual Play Button
var $progress = $('#progress-actual');                  // Progress Indicator
var pauseClass = 'fa fa-pause';                         // Class For Pause Button
var playClass = 'fa fa-play';                           // Class For Play Button


$('document').ready(function() {

    $('#play').on('click', togglePlay);
    $(player).on('timeupdate', updateProgressBar);

});

// Toggle media between play and pause states
function togglePlay() {
    if(isPlaying(player)) {
        player.pause();
        togglePlayButton(true);
    }
    else  {
        player.play();
        togglePlayButton(false);
    }
}

// Toggle play/pause button icon: true = play
function togglePlayButton(b) {
    if(b) {
        $playButton.removeClass(pauseClass).addClass(playClass);
    } else {
        $playButton.removeClass(playClass).addClass(pauseClass);
    }
}

// Update the progress bar width based on player's current time-total
function updateProgressBar() {
    var current = player.currentTime;
    var duration = player.duration;
    var width = 0;

    if(current > 0) {
        width = Math.floor((100 / duration) * current);
    }

    $progress.css('width', width + '%');
    console.log('WIDTH: ' + width + '%');
}


// Determine if audio player is currently playing
function isPlaying(audio) {
    return audio
            && audio.currentTime > 0
            && !audio.paused
            && !audio.ended
            && audio.readyState > 2;
}

// Debugging - Display status of audio player
function playerStatus() {
    console.log('PLAYING?: ' + isPlaying(player));
}
