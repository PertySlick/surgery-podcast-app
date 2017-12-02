/*
    * File Name: player.js
    * Authors: Timothy Roush
    * Date Created: 10/25/17
    * Assignment: Behind The Knife: The Surgery Podcast
    * Description:  Custom Podcast Player Functionality
*/

var player = parent.document.getElementById('player');              // Audio Player
var $player = $('#player', parent.document);                        // Audio Player jQuery
var $playerContainer = $('.player-wrapper', parent.document);       // Container For Entire Player
var $miniContainer = $('.mini-player');                             // Container For Mini Player
var $miniContainerRemote = $('.mini-player', parent.document);      // Container For Mini Player
var $mainPlayerRestore = $('#main-player-restore');                 // Click Area To Restore Main Player
var $playButton = $('#button-play');                                // Actual Play Button
var $playButton2 = $('#button-play-2');                             // Actual Play Button (Mini)
var $shrinkButton = $('#button-shrink');                            // Actual Shrink Button
var $closeButton = $('#button-close');                              // Actual Close Button
var $downloadButton = $('#button-download', parent.document);              // Actual Download Button
var $forwardButton = $('#button-forward');                          // Actual Forward Button
var $backwardButton = $('#button-backward');                        // Actual Backward Button
var $playerTitle = $('.player-title', parent.document);             // Player Title Area
var $playerImage = $('.player-image img', parent.document);         // Player Display Image Area
var $duration = $('#progress-total');                               // Total Duration Bar
var $progress = $('#progress-actual');                              // Progress Indicator
var $durationTime = $('#current-duration');                         // Duration Time Display
var $progressTime = $('#current-position');                         // Progress Time Display
var $podcastLoad = $('*').find('[data-toggle=player]');             // Podcast Row Toggling Player
var pauseClass = 'fa fa-pause';                                     // Class For Pause Button
var playClass = 'fa fa-play';                                       // Class For Play Button
var miniPlayerHeight = 50;                                          // Height setting for mini player
var t = 30;                                                         // Time Interval For Skipping


$('document').ready(function() {

    $player.on('loadeddata', setDuration);                          // Set Initial Duration Value
    $playButton.on('click', togglePlay);                            // Play Button Functionality
    $playButton2.on('click', togglePlay);                           // Play Button (Mini) Functionality
    $shrinkButton.on('click', shrinkPlayer);                        // Shrink To Mini Player
    $mainPlayerRestore.on('click', openPlayer);                     // Grow To Full Player
    $closeButton.on('click', closePlayer);                          // Close PodCast Player
    $forwardButton.on('click', { time: t }, jumpProgress);          // Jump Ahead 10 Seconds
    $backwardButton.on('click', { time: (t*-1) }, jumpProgress);    // Jump Back 10 Seconds
    $duration.on('click', seekFunction);                            // Seek Bar Functionality
    $player.on('timeupdate', updateProgress);                       // Progress Timer Functionality
    $player.on('play', { play: false }, togglePlayButton);          // Play/PAUSE Button Toggle
    $player.on('pause', { play: true }, togglePlayButton);          // PLAY/Pause Button Toggle
    $podcastLoad.on('click', loadPlayer);                           // Load Podcast From Clicked Row

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
        $playButton.children('i').removeClass(pauseClass).addClass(playClass);
        $playButton2.children('i').removeClass(pauseClass).addClass(playClass);
    } else {
        $playButton.children('i').removeClass(playClass).addClass(pauseClass);
        $playButton2.children('i').removeClass(playClass).addClass(pauseClass);
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
function loadPlayer() {
    var url = $(this).parents('[data-url]').data('url');
    var title = $(this).parents('[data-title]').data('title');
    var image = $(this).parents('[data-image]').data('image');

    $miniContainer.css('display', 'none');
    player.src = url;                       // Set source of player
    $downloadButton.prop('href', url);      // Set Download URL
    $playerImage.attr('src', image);        // Set Player Display Image
    $playerTitle.html(title);               // Set Main Player Title
    player.load();
    openPlayer();
    player.play();
}

// Lift player into the screen
function openPlayer() {
    $miniContainer.css('display', 'none');
    $miniContainerRemote.css('display', 'none');
    $playerContainer.css('bottom', 0);
}

// Shrink the player to the mini version
function shrinkPlayer() {
    var value = -($(document).height()) + miniPlayerHeight;
    $miniContainer.css('display', 'flex');
    $playerContainer.css('bottom', value + 'px')
}

// Remove the player from the screen
function closePlayer() {
    player.pause();
    $miniContainer.css('display', 'none');
    $playerContainer.css('bottom', '-' + $(document).height() + 'px');
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
