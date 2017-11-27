/*
    * File Name: menu.js
    * Authors: Marlene Leano
    * Date Created: 11/25/2017
    * Assignment: Behind The Knife: The Surgery Podcast
    * Description:  Toggle between showing and hiding menu items and
    *               keyword(s) search bar.
    * Credit: https:www.w3schools.com/howto/howto_js_dropdown.asp
*/


var menu = $('div#menu');
//var searchBar = $('div#header-search-bar');
var menuHeading = $('menu-heading');
var menuItems = $('div#menu-items');
var searchIcon = $('i#keyword-search-icon');
var topicsMenuItem = $('#topics-menu-item');
var episodeByTopicHeading = $('h3#episode-by-topic');

/*
 * When 'Menu' is tapped, toggle showing search bar, showing
 * menu items, and removing hamburger icon.
 */
menu.on('click', function (e) {
    //alert("menu click - outside if");
    
    //Prevents document.onclick function below from running
    e.stopPropagation();
    
    if (/*searchBar.is(':visible') && */menuItems.is(':visible')) {
        //searchBar.slideUp('fast');
        searchIcon.show();
        menuItems.slideUp('fast');
        
        //alert("menu click - IF");
    } else {
        //searchBar.slideDown('fast');
        //searchBar.css('display', 'inline-block');
        searchIcon.hide();
        menuItems.slideDown('fast');
        menuItems.css('display', 'inline-block');
        
        //alert("menu click - ELSE");
    }

});



/*
 * When 'Topic' menu item is clicked, make sure the 'Episodes
 * by Topic' heading clears/offsets the nav bar
 */
//TODO: Get offset to work!
/*topicsMenuItem.on('click', function () {
    episodeByTopicHeading.addClass('offset');
    $('.other-headings').addClass('.offset');
    
    event.preventDefault();
    
    $('.anchor').css('display', 'block');
    
    topicsMenuItem.attr('href', 'home#episode-by-topic');
    
    topicsMenuItem.trigger('click');
});*/


/*
 * If user taps window (anywhere NOT menu), close menu items
 * and hide search bar if they are shown
 */
//TODO: Get this working correctly! It's closing menu right away.
$(document).on('click', function (e) {
    //alert("document - BEFORE IF " + e.target.id);

    //Close menu
    searchIcon.show();
    menuItems.slideUp('fast');
});


