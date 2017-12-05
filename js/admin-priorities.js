/*
    * File Name: admin-priorities.js
    * Authors: Timothy Roush
    * Date Created: 12/04/17
    * Assignment: Behind The Knife: The Surgery Podcast
    * Description:  Admin Portal - Priorities functionality
*/


// FIELDS


var $priorityContainer = $('.priority-container');                                  // Container For All Priority Rows
var $priorityRow = $('.priority-row');                                              // Selector For Every Priority Row
var $lastPriorityRow = $('.priority-row:last-child');                               // Selector For Last Priority Row
var $prioritySelect = $('.priority-select');                                        // Selector For All Priority Select Elements
var $counter = $('input#priority-count');                                           // Stored Priority Counter For Submission
var $buttonUp = $('#button-up');                                                    // Button For Promoting A Priority
var $buttonDown = $('#button-down');                                                // Button For Demoting A Priority
var $buttonAdd = $('#button-add');                                                  // Button For Adding A Priority
var $buttonDelete = $('.button-delete');                                            // Button For Deleting A Priority

var optionTemplate = $('#priority-option-template').html();                         // HTML Template For Select Options
var count = $lastPriorityRow.data('row');                                           // Initial Priority Count


// INITIATORS


$('document').ready(function() {
    $buttonAdd.on('click', addNewPriority);
});


// METHODS - PRIMARY


function addNewPriority() {
    $priorityContainer.append(newPriorityRow(++count));
    $counter.val(parseInt($counter.val(), 10) + 1);
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
            '<div class="priority-up"><i class="fa fa-arrow-up"></i></div>\n' +
            '<div class="priority-down"><i class="fa fa-arrow-down"></i></div>\n' +
            '<div class="priority-remove"><i class="fa fa-times"></i></div>\n' +
        '</div>');

    return $newRow;
}