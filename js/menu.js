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
var menuItems = $('div#menu-items');
var searchIcon = $('i#keyword-search-icon');
var topicsMenuItem = $('#topics-menu-item');
var episodeByTopicHeading = $('h3#episode-by-topic');

/*
 * When 'Menu' is tapped, toggle showing search bar, showing
 * menu items, and removing hamburger icon.
 */
menu.on('click', function () {
    if (/*searchBar.is(':visible') && */menuItems.is(':visible')) {
        //searchBar.slideUp('fast');
        searchIcon.show();
        menuItems.slideUp('fast');
    } else {
        //searchBar.slideDown('fast');
        //searchBar.css('display', 'inline-block');
        searchIcon.hide();
        menuItems.slideDown('fast');
        menuItems.css('display', 'inline-block');
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
/*$(window).on('click', function (event) {
    if (!event.target.matches('#menu') ||
        !event.target.matches('#menu-heading') ||
        !event.target.matches('#keyword-search-icon') &&
        searchBar.is(':visible') &&
        menuItems.is(':visible')) {

        searchBar.slideUp('fast');
        searchIcon.show();
        menuItems.slideUp('fast'); 
    }
    alert(event.target.id);
});*/

/*
$(this).on('click', function() {
    
    alert("target id: " + event.target.id);
       
    if (!event.target.matches('#menu') &&
       !event.target.matches('#menu-heading') &&
       !event.target.matches('#keyword-search-icon') &&
       searchBar.is(':visible') &&
       menuItems.is(':visible')) {

       searchBar.slideUp('fast');
       searchIcon.show();
       menuItems.slideUp('fast');
       
       alert("got inside if statement!");
       
   } else {
        alert("got in else");
   }
});*/


/*
$(window).on('click', function (event) {
    alert(event.target.id);
    
    if (!event.target.matches('#menu') &&
        !event.target.matches('#menu-heading') &&
        !event.target.matches('#keyword-search-icon') &&
        searchBar.is(':visible') &&
        menuItems.is(':visible')) {

        searchBar.slideUp('fast');
        searchIcon.show();
        menuItems.slideUp('fast');
        
        alert("if: " + event.target.id);
    } else if (event.target.matches('#menu') ||
        event.target.matches('#menu-heading') ||
        event.target.matches('#keyword-search-icon')) {
        
        if (searchBar.is(':visible') && menuItems.is(':visible')) {
            searchBar.slideUp('fast');
            searchIcon.show();
            menuItems.slideUp('fast');
        } else {
            searchBar.slideDown('fast');
            searchBar.css('display', 'inline-block');
            searchIcon.hide();
            menuItems.slideDown('fast');
            menuItems.css('display', 'inline-block');
        }
        
        alert("else if: " + event.target.id);
    }
        else { 
            alert("else: " + event.target.id);
    }
});
*/

/*
$(window).on('click', function (event) {
    alert(event.target.id);
    
    if (event.target.matches('#menu') ||
        event.target.matches('#menu-heading') ||
        event.target.matches('#keyword-search-icon')) {
        
        if (searchBar.is(':visible') && menuItems.is(':visible')) {
            searchBar.slideUp('fast');
            searchIcon.show();
            menuItems.slideUp('fast');
        } else {
            searchBar.slideDown('fast');
            searchBar.css('display', 'inline-block');
            searchIcon.hide();
            menuItems.slideDown('fast');
            menuItems.css('display', 'inline-block');
        }
        
        alert("if: " + event.target.id);
    } else { 
        alert("else: " + event.target.id);
            
        if (searchBar.is(':visible')) {
            searchBar.slideUp('fast');
        }
        
        if (menuItems.is(':visible')) {
            menuItems.slideUp('fast');
        }
        
        if (searchIcon.is(':hidden')) {
            searchIcon.show();
        }
        
        searchBar.slideUp('fast');
        searchIcon.show();
        menuItems.slideUp('fast');
        if (searchBar.is(':visible') && menuItems.is(':visible')) {
            searchBar.hide();
            searchIcon.show();
            menuItems.hide();  
        }
        
        alert("searchBar " + $('div#header-search-bar'));
        alert("searchIcon " + $('i#keyword-search-icon'));
        alert("menuItems " + $('#topics-menu-item')); 
        
        alert("OTHER else: " + event.target.id);
    }
});
*/