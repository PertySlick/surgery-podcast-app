/*
    * File Name: admin-priorities.js
    * Authors: Timothy Roush
    * Date Created: 12/04/17
    * Assignment: Behind The Knife: The Surgery Podcast
    * Description:  Admin Portal - Priorities functionality
*/


// FIELDS


var $priorityContainer = $('.priority-container');                                  // Container For All Priority Rows
var $counter = $('input#priority-count');                                           // Stored Priority Counter For Submission
var $buttonAdd = $('#button-add');                                                  // Button For Adding A Priority

var allPriorityButtons = '.priority-button';                                    // All Priority Row Buttons
var buttonUp = '[data-toggle=button-up]';                                           // Button For Promoting A Priority
var buttonDown = '[data-toggle=button-down]';                                       // Button For Demoting A Priority
var buttonDelete = '[data-toggle=button-delete]';                                   // Button For Deleting A Priority

var optionTemplate = $('#priority-option-template').html();                         // HTML Template For Select Options
var count = parseInt($counter.val(), 10);                                           // Initial Priority Count


// INITIATORS


$('document').ready(function() {
    $buttonAdd.on('click', addNewPriority);
    $('body').on('click', buttonUp, promotePriority);
    $('body').on('click', buttonDown, demotePriority);
    $('body').on('click', buttonDelete, deletePriority);
    $('body').on('click', allPriorityButtons, buttonFeedback);
});


// METHODS - PRIMARY


function addNewPriority() {
    $priorityContainer.append(newPriorityRow(++count));
    //refreshSelectors();
    $counter.val(count);
}

function promotePriority() {
    var $currentRow = $(event.target).parents('[data-row]');

    if($currentRow.data('row') > 1) {
        var $targetRow = $currentRow.prev();
        $currentRow.find('select').fadeOut('fast', function() {
            var $currentValue = $currentRow.find('select');
            var $targetValue = $targetRow.find('select');
            var tempValue = $currentValue.val();

            $currentValue.val($targetValue.val());
            $targetValue.val(tempValue);
            $currentRow.find('select').fadeIn('fast');
        });

        $targetRow.find('select').fadeOut('fast', function() {
            $targetRow.find('select').fadeIn('fast');
        });

    }
}

function demotePriority() {
    var $currentRow = $(event.target).parents('[data-row]');

    if($currentRow.data('row') < count) {
        var $targetRow = $currentRow.next();
        var $currentValue = $currentRow.find('select');
        var $targetValue = $targetRow.find('select');
        var tempValue = $currentValue.val();

        $currentValue.fadeOut('fast', function() {
            $currentValue.val($targetValue.val());
            $targetValue.val(tempValue);

            $currentValue.fadeIn('fast');
        });

        $targetValue.fadeOut('fast', function() {
            $targetValue.fadeIn('fast');
        });


    }
}

function deletePriority() {
    var $currentRow = $(event.target).parents('[data-row]')
    var $targetValue = $currentRow.find('select');

    $currentRow.nextAll().each( function() {
        var $currentValue = $(this).find('select');
        $targetValue.val($currentValue.val());
        $targetValue = $currentValue;
    });

    $('[data-row]:last-child').remove();
    $counter.val(--count);
}


// METHODS - SUBROUTINES


function newPriorityRow(num) {
    var $newRow = $(
        '<div class="priority-row" data-row="' + num + '">\n' +
            '<div class="priority-number">' + num + '</div>\n' +
            '<div class="priority-topic">\n' +
                '<select name="priority-' + num + '" id="priority-' + num + '">\n' +
                    optionTemplate +
                '</select>\n' +
            '</div>\n' +
            '<div class="priority-button priority-up" data-toggle="button-up"><i class="fa fa-arrow-up"></i></div>\n' +
            '<div class="priority-button priority-down" data-toggle="button-down"><i class="fa fa-arrow-down"></i></div>\n' +
            '<div class="priority-button priority-remove" data-toggle="button-delete"><i class="fa fa-times"></i></div>\n' +
        '</div>');

    return $newRow;
}

function buttonFeedback() {
    var $button = $(event.target);

    $button.animate({fontSize:'2em'}, 'fast', 'swing', function() {
        $button.animate({fontSize:'1em'}, 'fast', 'swing');
    });
}