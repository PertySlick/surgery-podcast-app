<!--
 * File Name: home.html
 * Author: Timothy Roush
 * Date Created: 10/07/17
 * Assignment: Behind The Knife: The Surgery App
 * Description:  Landing page for a podcast app
-->

<?php echo $this->render('includes/header.inc.html',NULL,get_defined_vars(),0); ?>

<div class="wrapper">

<h1 class="title">BTK Podcast App</h1>

<a href="play">
    <div class="newest-button">
        <p>Listen to Newest Episode Here</p>
        <div class="play"></div>
    </div>
</a>
<p class="headline">Episodes by Topic:</p>
<div class="topic-wrapper">
    <a href="topic"><div class="topic">Legends of Surgery</div></a>
    <a href="topic"><div class="topic">Mock Oral Boards</div></a>
    <a href="topic"><div class="topic">Colorectal</div></a>
    <a href="topic"><div class="topic">Trauma</div></a>
    <a href="topic"><div class="topic">Oncology</div></a>
    <a href="topic"><div class="topic">Endocrine</div></a>
    <a href="topic"><div class="topic">Thoracic</div></a>
    <a href="topic"><div class="topic">Fellowships</div></a>
    <a href="topic"><div class="topic">Vascular</div></a>
    <a href="topic"><div class="topic">Finances</div></a>
    <a href="topic"><div class="topic">Breast</div></a>
    <a href="topic"><div class="topic">Video Series</div></a>
</div>


</div>
