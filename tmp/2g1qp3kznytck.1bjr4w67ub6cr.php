<!--
 * File Name: resultsbytopic.html
 * Author: Marlene Leano
 * Date Created: 11/07/2017
 * Assignment: Behind The Knife: The Surgery App
 * Description: List of podcasts related to selected topic
-->

<?php echo $this->render($INC . 'header.inc.html',NULL,get_defined_vars(),0); ?>

<h1 class="title"><?= ($keyword) ?></h1>
<div class="subtitle">click to play</div>

<?php foreach (($podcasts?:[]) as $podcast): ?>
    <div class="pc-row">
        <div class="pc-title hide-title" data-url="<?= ($podcast->getUrl()) ?>">
            
            <div class="title-itself pc-title-itself">
                <div class="date-image-switch">
                    <div class="pc-publish-date"><?= ($podcast->getPublishDateShort()) ?></div>
                    <p class="true-title"><img src="<?= ($podcast->getImage()) ?>" class="pc-image"><?= ($podcast->getTitle()) ?></p>
                </div>
                
                <div class="open-podcast-info">
                    <p>Published Date: <br /><?= ($podcast->getPublishDateLong()) ?></p>
                </div>
                <div class="open-podcast-info">
                    <i class="fa fa-download pc-download-button" aria-hidden="true"></i>
                </div>
                <div class="open-podcast-info" data-toggle="player">
                    <i class="fa fa-play pc-play-button" aria-hidden="true"></i>
                </div>
            </div>
            
        </div>
        <div class="pc-description">
            <div class="pc-desc">
                <?= ($podcast->getDescription())."
" ?>
            </div>
            <div class="pc-duration">
                <?= ($podcast->getDuration())."
" ?>
            </div>
        </div>
    </div>        
<?php endforeach; ?>

<?php echo $this->render($INC . 'footer.inc.html',NULL,get_defined_vars(),0); ?>
    