/**
 * User: denis
 * Date: 6/23/13
 * Time: 1:05 PM
 */

$(document).ready(function(){
    resizeBody();

    $('#trigger').click(function(){
        $('.mobile_nav').toggle();
    });

    // Listen for orientation changes
    window.addEventListener("orientationchange", function(){
        resizeBody();
    }, false);
});

$(document).resize(resizeBody());

function resizeBody(){
    $('body').css({width: $(window).width()+'px'});
}