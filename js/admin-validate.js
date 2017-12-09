/*
    * File Name: admin-validate.js
    * Authors: Marlene Leano
    * Date Created: 12/05/2017
    * Assignment: Behind The Knife: The Surgery Podcast
    * Description:  Validates admin login by JavaScript
*/

//Add click event to submit function
$(document).ready(function() {
    $('button#login-btn').on('click', validate);
});

//Function that validates form inputs
function validate(event)
{
    //Prevent the form from submitting
    event.preventDefault();
    
    //Remove old error messages
    removeErrors();
    
    //Track errors
    var isError = false;
    
    //Cache entered username and password
    var user = $('input[name="username"]').val();
    var inputPassword = $('input[name="password"]').val();
    
    //Validate username - check that a username was entered
    if (user.length < 1) {
        report("username-error", "Please enter your user name.");
        isError = true;
    }
    
    //Validate password - make sure it was entered
    if (inputPassword.length < 1) {
        report("password-error", "Please enter your password.");
        isError = true;
    }
    
    //if username and password were entered, verify credentials
    //with database data
    if (!isError) {
        //Validate username - check that it is not already in use
/*        $.post("model/ajaxoperator.php", { username : user }, function(result) {
            
            console.log("password result: " + result);
            
            if (result.trim() != inputPassword) {
                report("login-error", "The username or password is incorrect");
                isError = true;
            } 
        });
*/        
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
                    report("login-error", "The username or password is incorrect");
                    isError = true;
                }
            },
            error: function () {
                console.log('No results from database.');
            },
            dataType: 'json'
        });
    }
      
    //If no errors, submit data
    if (!isError) {
        $("form").submit();
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

//Clear any previous error messages
function removeErrors()
{
    $("#username-error").parent().hide();
    $("#password-error").parent().hide();
    $("#login-error").parent().hide();
}
