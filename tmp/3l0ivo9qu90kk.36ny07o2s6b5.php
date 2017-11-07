<!--
 * File Name: topic.html
 * Author: Timothy Roush
 * Date Created: 10/07/17
 * Assignment: Behind The Knife: The Surgery App
 * Description:  Page that lists podcasts related to selected topic
-->

<?php echo $this->render($INC . 'header.inc.html',NULL,get_defined_vars(),0); ?>

<div class="wrapper">

<h1 class="title">Surgery Legends</h1>
<div class="subtitle">click to play</div>


<div class="pc-row">
    <div class="pc-title">John Cameron</div>
    <audio class="pc-content" controls>
        <source src="<?= ($IMG . 'eagles-take-it-to-the-limit.mp3') ?>" type="audio/mpeg">
    </audio>
</div>


<a href="play">
    <div class="pc-row">
        <div class="pc-title">John Cameron</div>
        <div class="pc-content">
            <div class="pc-progress-bar"></div>
        </div>
    </div>
</a>
<div class="pc-row">
    <div class="pc-title">John Cameron</div>
    <audio class="pc-content" controls>
        <source src="<?= ($IMG . 'eagles-take-it-to-the-limit.mp3') ?>" type="audio/mpeg">
    </audio>
</div>
<div class="pc-row">
    <div class="pc-title">John Cameron</div>
    <audio class="pc-content" controls>
        <source src="<?= ($IMG . 'eagles-take-it-to-the-limit.mp3') ?>" type="audio/mpeg">
    </audio>
</div>
<div class="pc-row">
    <div class="pc-title">John Cameron</div>
    <audio class="pc-content" controls>
        <source src="<?= ($IMG . 'eagles-take-it-to-the-limit.mp3') ?>" type="audio/mpeg">
    </audio>
</div>
<div class="pc-row">
    <div class="pc-title">John Cameron</div>
    <audio class="pc-content" controls>
        <source src="<?= ($IMG . 'eagles-take-it-to-the-limit.mp3') ?>" type="audio/mpeg">
    </audio>
</div>
<div class="pc-row">
    <div class="pc-title">John Cameron</div>
    <audio class="pc-content" controls>
        <source src="<?= ($IMG . 'eagles-take-it-to-the-limit.mp3') ?>" type="audio/mpeg">
    </audio>
</div>
<div class="pc-row">
    <div class="pc-title">John Cameron</div>
    <audio class="pc-content" controls>
        <source src="<?= ($IMG . 'eagles-take-it-to-the-limit.mp3') ?>" type="audio/mpeg">
    </audio>
</div>

<?php echo $this->render($INC . 'footer.inc.html',NULL,get_defined_vars(),0); ?>
