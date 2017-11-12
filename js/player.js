/*
    * File Name: player.js
    * Authors: Timothy Roush
    * Date Created: 10/25/17
    * Assignment: Behind The Knife: The Surgery Podcast
    * Description:  Custom Podcast Player Functionality
*/

var player = parent.document.getElementById('player');              // Audio Player
var $player = $('#player', parent.document);
var $playerContainer = $('.player-container', parent.document);     // Container For Entire Player
var $playButton = $('#play-button');                                // Actual Play Button
var $closeButton = $('#close');                                     // Actual Close Button
var $downloadButton = $('#download', parent.document);              // Actual Download Button
var $forwardButton = $('#forward');                                 // Actual Forward Button
var $backwardButton = $('#backward');                               // Actual Backward Button
var $duration = $('#progress-total');                               // Total Duration Bar
var $progress = $('#progress-actual');                              // Progress Indicator
var $durationTime = $('#current-duration');                         // Duration Time Display
var $progressTime = $('#current-position');                         // Progress Time Display
var $podcastRow = $('.pc-title');                                   // Podcast Row Toggling Player
var pauseClass = 'fa fa-pause';                                     // Class For Pause Button
var playClass = 'fa fa-play';                                       // Class For Play Button
var t = 30;                                                         // Time Interval For Skipping


$('document').ready(function() {

    $player.on('loadeddata', setDuration);                          // Set Initial Duration Value
    $playButton.on('click', togglePlay);                            // Play Button Functionality
    $closeButton.on('click', closePlayer);                          // Close PodCast Player
    $forwardButton.on('click', { time: t }, jumpProgress);           // Jump Ahead 10 Seconds
    $backwardButton.on('click', { time: (t * -1) }, jumpProgress);  // Jump Back 10 Seconds
    $duration.on('click', seekFunction);                            // Seek Bar Functionality
    $player.on('timeupdate', updateProgress);                       // Progress Timer Functionality
    $player.on('play', { play: false }, togglePlayButton);          // Play/PAUSE Button Toggle
    $player.on('pause', { play: true }, togglePlayButton);          // PLAY/Pause Button Toggle
    $podcastRow.on('click', loadPlayer);                            // Load Podcast From Clicked Row

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
    }

    $progress.css('width', width + '%');
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

// Load podcast from clicked row
function loadPlayer(e) {
    var url = $(e.target).data('url');

    $player.slideUp();
    player.src = url;                       // Set source of player
    $downloadButton.prop("href", url);
    player.load();
    openPlayer();
}

// Lift player into the screen
function openPlayer() {
    if ($playerContainer.css('bottom') == '-90px') {
        $playerContainer.css('bottom', 0);
    }
}

// Remove the player from the screen
function closePlayer() {
    player.pause();
    $playerContainer.css('bottom', '-90px');
}

// Provide skip forward/backward functionality
function jumpProgress(e) {
    var t = e.data.time;
    player.currentTime = player.currentTime + t;
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
