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
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- BOOTSTRAP STYLES -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <!--[if lt IE 9]>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- FONTAWESOME IF REQUIRED -->
    <?php if ($fontAwesome): ?>
        <script src="https://use.fontawesome.com/a5cce48296.js"></script>
    <?php endif; ?>
</head>
<body>
<div class="wrapper">

    <nav class="nav-header">
        <div class="nav-button">
            <!--Link to homepage-->
            <a href="/home">
            <i class="fa fa-home" aria-hidden="true"></i>
            </a>
        </div>
        <!--Dropdown list here-->
        <div class="nav-button">
            <a>
            <i class="fa fa-th-list" aria-hidden="true"></i>
            </a>
        </div>
        <div class="nav-button">
            <!--Search feature to be added here-->
            <a>
            <i class="fa fa-search" aria-hidden="true"></i>
            </a>
        </div>
    </nav>

    <div class="nav-header-buffer"></div>
