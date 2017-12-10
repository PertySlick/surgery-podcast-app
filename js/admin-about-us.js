/*
    * File Name: admin-about-us.js
    * Authors: Marlene Leano
    * Date Created: 12/09/2017
    * Assignment: Behind The Knife: The Surgery Podcast
    * Description:  Used for updating, deleting, and adding a
    * new podcast host in the admin page
*/

$(document).ready(function() {
    //$('a.edit-host').on('click', editHost);
    $('a.delete-host').on('click', confirmDeletion);
    $('button#show-new-host-form-btn').on('click', toggleAddPodcastHostForm);
});

//Function that asks user for confirmation before proceeding with deletion
function confirmDeletion()
{
    return confirm('Continuing will remove the podcast host from the About Us page.');
}

//Function that toggles (shows/hides) the form to add a new podcast
//host to the About Us page
function toggleAddPodcastHostForm()
{
    var podcastHostForm = $('form#podcast-host-form');
    var showFormBtn = $('button#show-new-host-form-btn');
    
    podcastHostForm.toggle('fast');
    
    if (showFormBtn.text() == 'HIDE FORM' || showFormBtn.text() == 'CANCEL EDIT') {
        showFormBtn.text('CLICK TO ADD PODCAST HOST');
    } else {
        showFormBtn.text('HIDE FORM');
    }
    
    if (showFormBtn.text() != 'CANCEL EDIT') {
        $('input#firstname').val('');
        $('input#lastname').val('');
        $('input#biography').text('');
    }
}

//Function that changes the 'add new podcast host' form to an
//'edit podcast host info' form 
/*function editHost(event)
{
    event.preventDefault();
    //Show form
    var podcastHostForm = $('form#podcast-host-form');
    podcastHostForm.slideDown('fast');
    
    var showFormBtn = $('button#show-new-host-form-btn');
    showFormBtn.text('CANCEL EDIT');
}*/