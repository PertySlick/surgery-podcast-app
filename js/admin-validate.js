/*
    * File Name: admin-validate.js
    * Authors: Marlene Leano
    * Date Created: 12/05/2017
    * Assignment: Behind The Knife: The Surgery Podcast
    * Description:  Validates admin login by JavaScript
*/

//Add click event to submit function
$(document).ready(function() {
    $('button#login-btn').on('click', validateLogin);
    $('button#submit-host-btn').on('click', validatePodcastHost);
    $('button#submit-edit-host-btn').on('click', validateUpdatedHost);
});

//Function that validates form inputs
function validateLogin(event)
{
    //Prevent the form from submitting
    event.preventDefault();
    
    //Remove old login error messages
    removeLoginErrors();
    
    //Track errors
    var isError = false;
    
    //Cache entered username and password
    var user = $('input[name="username"]').val();
    var inputPassword = $('input[name="password"]').val();
    
    //Validate username - check that a username was entered
    if (user.length < 1) {
        report("username-error", "Please enter username");
        isError = true;
    }
    
    //Validate password - make sure it was entered
    if (inputPassword.length < 1) {
        report("password-error", "Please enter password");
        isError = true;
    }
    
    //if username and password were entered, verify credentials
    //with database data
    if (!isError) {       
        $.ajax({
            url: 'model/ajaxoperator.php',
            method: 'POST',
            data: {
                action: 'validateLogin',
                username: user,
                password: inputPassword
            },
            success: function (result) {
                
                console.log('result: ' + result);
                
                if (result == false) {
                    report("login-error", "Incorrect username or password");
                    isError = true;
                } else {
                    $("form#login-form").submit();
                }
            },
            error: function () {
                console.log('No results from database.');
            },
            dataType: 'json'
        });
    }
}

function validatePodcastHost(event)
{
    //Prevent the form from submitting
    event.preventDefault();
       
    //Remove old podcast host error messages
    removeHostErrors();
    
    //Track errors
    var isError = false;
    
    //Cache entered podcast host info
    var firstName = $('input[name="first-name"]').val();
    var lastName = $('input[name="last-name"]').val();
    var bio = $('textarea#biography').val();
    var photo = $('input[type="file"]').val();
    
    //Validate first name - check that a first name was entered
    if (firstName.length < 1 || firstName == ' ') {
        report("firstname-error", "Please enter first name");
        isError = true;
    }
    
    //Validate last name - make sure last name was entered
    if (lastName.length < 1 || lastName == ' ') {
        report("lastname-error", "Please enter last name");
        isError = true;
    }
    
    //Validate bio - make sure bio was entered
    if (bio.length < 1 || bio == ' ') {
        report("bio-error", "Please enter a short biography");
        isError = true;
    }
    
    //Validate photo - make a photo was selected
    if (photo == '') {
        report("photo-error", "Please select a photo");
        isError = true;
    }

    if (!isError) {
        $("form#podcast-host-form").submit();
    }
}


//Function that validates the form for editing the podcast host
function validateUpdatedHost(event) {
    //Prevent the form from submitting
    event.preventDefault();
    
    //Remove old podcast host error messages
    removeEditErrors();
    
    //Track errors
    var isError = false;
    
    //Cache entered podcast host info
    var firstName = $('input[name="first-name"]').val();
    var lastName = $('input[name="last-name"]').val();
    var bio = $('textarea#editBiography').val();
    
    //Validate first name - check that a first name was entered
    if (firstName.length < 1 || firstName == ' ') {
        report("edit-firstname-error", "Please enter first name");
        isError = true;
    }
    
    //Validate last name - make sure last name was entered
    if (lastName.length < 1 || lastName == ' ') {
        report("edit-lastname-error", "Please enter last name");
        isError = true;
    }
    
    //Validate bio - make sure bio was entered
    if (bio.length < 1 || bio == ' ') {
        report("edit-bio-error", "Please enter a short biography");
        isError = true;
    }
       
    if (!isError) {
        console.log("error free!");
        $("form#podcast-host-edit-form").submit();
    }
}

//Update for to display error message
function report(id, message)
{
    //Set the html of the element
    $('#' + id).html(message);
    
    //Get the parent of the element and make element be shown
    $('#' + id).parent().show();
}

//Clear any previous login error messages
function removeLoginErrors()
{
    $("#username-error").parent().hide();
    $("#password-error").parent().hide();
    $("#login-error").parent().hide();
}

function removeHostErrors()
{
    $("#firstname-error").parent().hide();
    $("#lastname-error").parent().hide();
    $("#bio-error").parent().hide();
    $("#photo-error").parent().hide();
}

function removeEditErrors()
{
    $("#edit-firstname-error").parent().hide();
    $("#edit-lastname-error").parent().hide();
    $("#edit-bio-error").parent().hide();
    $("#edit-photo-error").parent().hide();    
}
