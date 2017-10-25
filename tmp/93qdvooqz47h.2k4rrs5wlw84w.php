<!--
 * File Name: home.html
 * Author: Timothy Roush
 * Date Created: 10/07/17
 * Assignment: Behind The Knife: The Surgery App
 * Description:  Landing page for a podcast app
-->

<?php echo $this->render($INC . 'header.inc.html',NULL,get_defined_vars(),0); ?>

<div class="wrapper">

<a href="home">
    <img class="logo" src="<?= ($IMG . 'logo.png') ?>" />
</a>


</div>

<?php echo $this->render($INC . 'footer.inc.html',NULL,get_defined_vars(),0); ?>
