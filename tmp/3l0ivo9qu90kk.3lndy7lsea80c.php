
<!--
 * File Name: home.html
 * Author: Timothy Roush
 * Date Created: 10/07/17
 * Assignment: Behind The Knife: The Surgery App
 * Description:  Landing page for a podcast app
-->

<?php echo $this->render($INC . 'header.inc.html',NULL,get_defined_vars(),0); ?>

<!-- TOP NAVIGATION -->

<nav class="nav-header">
    <div class="nav-button">
        <!--Link to homepage-->
        <a href="/home">
            <i class="fa fa-home" aria-hidden="true"></i>
        </a>
    </div>
    <!--Dropdown list here-->
    <div class="nav-button">
        <a>
            <i class="fa fa-th-list" aria-hidden="true"></i>
        </a>
    </div>
    <div class="nav-button">
        <!--Search feature to be added here-->
        <a>
            <i class="fa fa-search" aria-hidden="true"></i>
        </a>
    </div>
</nav>

<!-- MAIN IFRAME PORTAL -->

<iframe src="home" height="400" width="800" align="left" frameBorder="0">
    <p>Your browser does not support iframes.</p>
</iframe>

<!-- PODCAST PLAYER INTERFACE -->

<footer>
 <div class="player">
     <div class="player-controls">
         <div id="current-position" class="timing">
             00:00:00
         </div>
         <div id="progress" class="progress-bar">
             <div id="progress-total">
                 <div id="progress-actual"></div>
             </div>
         </div>
         <div id="current-duration" class="timing">
             00:00:00
         </div>

     </div>
     <audio id="player" class="podcast-player">
         <source src="<?= ($IMG . 'eagles-take-it-to-the-limit.mp3') ?>" type="audio/mpeg">
     </audio>
 </div>
 <nav class="nav-footer">
     <div class="nav-button" id="download">
         <i class="fa fa-download" aria-hidden="true"></i>
     </div>
     <div class="nav-button" id="backward">
         <i class="fa fa-backward" aria-hidden="true"></i>
     </div>
     <div class="nav-button" id="play">
         <i class="fa fa-play" id="play-button" aria-hidden="true"></i>
     </div>
     <div class="nav-button" id="forward">
         <i class="fa fa-forward" aria-hidden="true"></i>
     </div>
     <div class="nav-button" id="close">
         <i class="fa fa-times" aria-hidden="true"></i>
     </div>
 </nav>
</footer>

    <?php echo $this->render($INC . 'footer.inc.html',NULL,get_defined_vars(),0); ?>

