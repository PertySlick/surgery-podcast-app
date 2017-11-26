<!DOCTYPE html>
<html>
<head>
    <!--
    * File Name: header.inc.html
    * Authors: Timothy Roush
    * Date Created: 10/02/17
    * Assignment: Behind The Knife: The Surgery Podcast
    * Description:  Header to be placed at beginning of each page.
    -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <title><?= ($title) ?></title>
    <meta name="description" content="<?= ($description) ?>" />
    <meta name="author" content="Timothy Roush" />
    <meta name="author" content="Marlene Leano" />
    <meta name="author" content="Brent Taylor" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- CSS STYLES -->
    <link rel="stylesheet" href="<?= ($CSS . 'styles.css') ?>" />
    <link rel="stylesheet" href="<?= ($CSS . 'player.css') ?>" />
    <link rel="stylesheet" href="<?= ($CSS . 'home.css') ?>" /> <!--temporary. will merge all styles later-->

    <!-- FONTAWESOME IF REQUIRED -->
    <?php if ($fontAwesome): ?>
        <script src="https://use.fontawesome.com/a5cce48296.js"></script>
    <?php endif; ?>
</head>
<body>

    <?php if ($iframe): ?>
        
            <div class="iframe-wrapper">
        
        <?php else: ?>
            <div class="wrapper">
        
    <?php endif; ?>