/*
    * File Name: player.js
    * Authors: Timothy Roush
    * Date Created: 10/25/17
    * Assignment: Behind The Knife: The Surgery Podcast
    * Description:  Custom Podcast Player Functionality
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

// Update the progress time display and the progress/seek bar
function updateProgress() {
    $progressTime.html(formatSeconds(player.currentTime));
    updateProgressBar();
}

// Update the progress bar width based on player's current time-total
function updateProgressBar() {
    var current = player.currentTime;
    var duration = player.duration;
    var width = 0;

    if (current > 0) {
        width = Math.round(((100 / duration) * current) * 10) / 10;
        //console.log('HEIGHT: ' + $('nav.nav-footer').height());
    }

    $progress.css('width', width + '%');
    //console.log('WIDTH: ' + width + '%');
}

// Seek functionality for skipping around via progress bar clicks
function seekFunction(e) {
    var offset = $(this).offset();
    var left = (e.pageX - offset.left);
    var totalWidth = $duration.width();
    var percentage = ( left / totalWidth );
    var playerTime = $player.prop('duration') * percentage;
    $player.prop('currentTime', playerTime);

    // If seeking while stopped, play from clicked point
    if (!isPlaying()) { $player.trigger('play'); }
}


// Determine if audio player is currently playing
function isPlaying() {
    return $player
            && $player.prop('currentTime') > 0
            && !$player.prop('paused')
            && !$player.prop('ended')
            && $player.prop('readyState') > 2;
}

// Sets the value of the audio duration to the duration display number
function setDuration() {
    $durationTime.html(formatSeconds($player.prop('duration')));
}

// Format times supplied by HTML audio to an hh:mm:ss format
function formatSeconds(time) {
    var hour = Math.floor(time / 3600);
    var minute = Math.floor((time - hour * 3600) / 60);
    var second = Math.floor(time - (hour * 3600) - (minute * 60));

    // Account for single digits
    if (hour < 10) hour = "0" + hour;
    if (minute < 10) minute = "0" + minute;
    if (second < 10) second = "0" + second;

    return hour + ':' + minute + ':' + second;
}
