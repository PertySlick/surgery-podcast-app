<!--
 * File Name: player.html
 * Author: Timothy Roush
 * Date Created: 10/07/17
 * Assignment: Behind The Knife: The Surgery App
 * Description:  Player for streaming podcasts content
-->

<?php echo $this->render($INC . 'header.inc.html',NULL,get_defined_vars(),0); ?>

<div class="wrapper">

<img class="player-image" src="<?= ($IMG . 'santa.png') ?>" />
<div class="player-description">
    Information here about the episode and if they want to learn more click...
</div>

<div class="player-controls">
    <span class="player-author">John Cameron</span>
    <span class="player-title">Trauma</span>
    <div class="player-progress-full">
        <div class="player-progress"></div>
    </div>
    <div class="player-time">
        <div class="time-remaining">2:30</div>
        <div class="time-total">32:36</div>
    </div>
</div>


</div>

<?php echo $this->render($INC . 'footer.inc.html',NULL,get_defined_vars(),0); ?>
