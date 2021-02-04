/*
Name: Shashwat Kumar
Student No.: 000790494
I certify that this is my original work.

This javascript file changes the active class of the navigation bar items as they are clicked
*/

$('div.navbar a').on('click', function(){
    $('div.navbar a.active').removeClass('active');
    $(this).addClass('active');
});