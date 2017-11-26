<!--
 * File Name: home.html
 * Author: Timothy Roush
 * Date Created: 10/07/17
 * Assignment: Behind The Knife: The Surgery App
 * Description:  Landing page for a podcast app
-->

<?php echo $this->render('includes/header.inc.html',NULL,get_defined_vars(),0); ?>

<!--<h1 class="title">BTK Podcast App</h1>

<a href="play">
    <div class="newest-button">
        <p>Listen to Newest Episode Here</p>
        <div class="play"></div>
    </div>
</a>-->

<!--Image of the logo-->
<img id="btk-logo" src="<?= ($IMG . 'BTK_logo_large.jpg') ?>" alt="Behind the Knife Logo" />

<!--Welcome Message-->
<h2 id="welcome-title">Welcome to Behind the Knife</h2>

<p id="welcome-message">These surgery podcasts are aimed for everyone interested in an in-depth look at the broad range of
    surgical topics. Come take a "behind the scenes" look at the interesting, controversial, and humanistic side of surgery
    from some of the giants in the field.
</p>

<!--Most Recent Episodes-->
<h3 class="other-headings">Most Recent Episodes</h3>

<?php foreach (($podcasts?:[]) as $podcast): ?>
    <div class="recent-pc-row">
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

<!--Episodes by Topic-->
<h3 class="other-headings">Episodes by Topic</h3>

<!--Search bar-->
<div class="search-bar">
    <input type="search" id="topic-search-bar" name="search-term" placeholder="Search for Topic">
    <button type="submit">
        <i class="fa fa-search fa-2x" aria-hidden="true"></i>
    </button>  
</div>


<!--Topic Buttons-->
<div class="topic-wrapper">
    <?php foreach (($topics?:[]) as $topic): ?>
        <a href="<?= ($BASE . '/topic/' . $topic) ?>">
            <div class="topic">
                <?= ($topic)."
" ?>
            </div>
        </a>
    <?php endforeach; ?>
</div>


<!-- Begin MailChimp Signup Form -->
<link href="//cdn-images.mailchimp.com/embedcode/slim-10_7.css" rel="stylesheet" type="text/css">
<style type="text/css">
	#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
	/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="mc_embed_signup">
<form action="https://greenrivertech.us17.list-manage.com/subscribe/post?u=5f127826b33735e960540fc04&amp;id=61ad1d819a" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
    <div id="mc_embed_signup_scroll">
	<label for="mce-EMAIL">Subscribe to our mailing list</label>
	<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_5f127826b33735e960540fc04_61ad1d819a" tabindex="-1" value=""></div>
    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
    </div>
</form>
</div>


<?php echo $this->render($INC . 'footer.inc.html',NULL,get_defined_vars(),0); ?>