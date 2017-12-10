/*
    * File Name: admin-about-us.js
    * Authors: Marlene Leano
    * Date Created: 12/09/2017
    * Assignment: Behind The Knife: The Surgery Podcast
    * Description:  Used for updating, deleting, and adding a
    * new podcast host in the admin page
*/

$(document).ready(function() {
    $('a.delete-host').on('click', confirmDeletion);
});

//Function that asks user for confirmation before proceeding with deletion
function confirmDeletion()
{
    return confirm('Continuing will remove the podcast host from the About Us page.');
}