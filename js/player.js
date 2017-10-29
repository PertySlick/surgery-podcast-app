/*
    * File Name: player.js
    * Authors: Timothy Roush
    * Date Created: 10/25/17
    * Assignment: Behind The Knife: The Surgery Podcast
    * Description:  Custom Podcast Player Functionality
*/

var player = document.getElementById('new-player');     // Audio Player
var $playButton = $('#play-button');                    // Actual Play Button
var $duration = $('#progress-total');                   // Total Duration Bar
var $progress = $('#progress-actual');                  // Progress Indicator
var pauseClass = 'fa fa-pause';                         // Class For Pause Button
var playClass = 'fa fa-play';                           // Class For Play Button


$('document').ready(function() {

    $('#play').on('click', togglePlay);
    $duration.on('click', seekFunction);
    $(player).on('timeupdate', updateProgressBar);
    $(player).on('play', { play: false }, togglePlayButton);
    $(player).on('pause', { play: true }, togglePlayButton);

    $('#close').on('click', function() {
        $('nav.nav-footer').css('height', 'initial');
    });

    $('nav.nav-footer').on('click', function() {
        $('nav.nav-footer').css('height', '0');
    });



});

// Toggle media between play and pause states
function togglePlay() {
    if (isPlaying(player)) { player.pause(); }
    else  { player.play(); }
}

// Toggle play/pause button icon: true = play
function togglePlayButton(e) {
    var b = e.data.play;
    if (b) {
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

    if (current > 0) {
        width = Math.round(((100 / duration) * current) * 10) / 10;
        console.log('HEIGHT: ' + $('nav.nav-footer').height());
    }

    $progress.css('width', width + '%');
    console.log('WIDTH: ' + width + '%');
}

// Seek functionality for skipping around via progress bar clicks
function seekFunction(e) {
    var offset = $(this).offset();
    var left = (e.pageX - offset.left);
    var totalWidth = $duration.width();
    var percentage = ( left / totalWidth );
    var playerTime = player.duration * percentage;
    player.currentTime = playerTime;

    // If seeking while stopped, play from clicked point
    if (!isPlaying(player)) { player.play(); }
}


// Determine if audio player is currently playing
function isPlaying(audio) {
    return audio
            && audio.currentTime > 0
            && !audio.paused
            && !audio.ended
            && audio.readyState > 2;
}
