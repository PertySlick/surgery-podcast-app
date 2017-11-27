
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
    <!-- Keyword Search bar -->
    <div id="header-search-bar">
        <input type="search" id="keyword-search-bar" name="search-keyword" placeholder=" Search by Keyword(s)">
        <button type="submit" id="search-keyword-btn">
            <i class="fa fa-search fa-2x" aria-hidden="true"></i>
        </button>
    </div>
    
    <!-- Menu Button: 
         Adapted from https://www.w3schools.com/howto/howto_js_dropdown.asp
    -->
    <div id="menu">
        <h3>Menu <span><i id="keyword-search-icon" class="fa fa-bars" aria-hidden="true"></i></span></h3>
        <div id="menu-items">
            <a href="home" target="iframe">Home</a>
            <a href="home#episode-by-topic" target="iframe">Topics</a>
            <a href="">About Us</a>
            <a href="home#mc_embed_signup" target="iframe">Mailing List</a>
        </div>
    </div>
        
</nav>

<!-- MAIN IFRAME PORTAL -->


<iframe src="home" name="iframe" scrolling="no">
    <p>Your browser does not support iframes.</p>
</iframe>


<!-- PODCAST PLAYER INTERFACE -->

    <!-- TODO - Temporary to avoid git work conflicts -->
    <!-- TODO - Replace with actual code during deployment -->
    <?php echo $this->render($INC . 'player.inc.html',NULL,get_defined_vars(),0); ?>
    <?php echo $this->render($INC . 'footer.inc.html',NULL,get_defined_vars(),0); ?>

