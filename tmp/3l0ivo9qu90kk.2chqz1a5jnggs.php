<!--
 * File Name: resultsbytopic.html
 * Author: Marlene Leano
 * Date Created: 11/07/2017
 * Assignment: Behind The Knife: The Surgery App
 * Description: List of podcasts related to selected topic
-->

<?php echo $this->render($INC . 'header.inc.html',NULL,get_defined_vars(),0); ?>

<h1 class="title">Surgery Legends</h1>
<div class="subtitle">click to play</div>


<?php foreach (($podcasts?:[]) as $podcast): ?>
    <div class="new-pc-row pc-title">
        <div class="new-pc-title"><?= ($podcast->getTitle()) ?></div>
    </div>
    <div class="new-pc-row pc-description">
        <div class="new-pc-desc">
            <?= ($podcast->getDescription())."
" ?>
        </div>
        <div class="new-pc-duration"><?= ($podcast->getDuration()) ?></div>
    </div>
<?php endforeach; ?>



<?php echo $this->render($INC . 'footer.inc.html',NULL,get_defined_vars(),0); ?>
