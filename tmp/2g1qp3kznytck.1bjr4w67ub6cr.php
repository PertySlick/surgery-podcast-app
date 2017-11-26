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
            <div class="pc-publish-date"><?= ($podcast->getPublishDate()) ?></div>
            <span class="title-itself"><?= ($podcast->getTitle()) ?></span>
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
    