/*
    * File Name: menu.js
    * Authors: Marlene Leano
    * Date Created: 11/25/2017
    * Assignment: Behind The Knife: The Surgery Podcast
    * Description:  Toggle between showing and hiding menu items and
    *               keyword(s) search bar.
    * Credit: https://www.w3schools.com/howto/howto_js_dropdown.asp
*/


var menu = $('div#menu');
var searchBar = $('div#header-search-bar');
var menuItems = $('div#menu-items');
var searchIcon = $('i#keyword-search-icon');

/*
 * When 'Menu' is tapped, toggle showing search bar, showing
 * menu items, and removing hamburger icon.
 */
menu.on('click', function () {
    if (searchBar.is(':visible') && menuItems.is(':visible')) {
        //searchBar.css('display', 'none');
        searchBar.slideUp('fast');
        searchIcon.show();
        //menuItems.css('display', 'none');
        menuItems.slideUp('fast');
    } else {
        searchBar.slideDown('fast');
        searchBar.css('display', 'inline-block');
        searchIcon.hide();
        menuItems.slideDown('fast');
        menuItems.css('display', 'inline-block');
    }

});

/*
 * If user taps window (anywhere NOT menu), close menu items
 * and hide search bar if they are shown
 */
//TODO: Get this working correctly! It's closing menu right away.
//window.onclick = function () {
//    if (!event.target.matches('div#menu') ) {
//           //searchBar.css('display', 'none');
//        searchBar.slideUp('fast');
//        searchIcon.show();
//        //menuItems.css('display', 'none');
//        menuItems.slideUp('fast'); 
//    }
//};