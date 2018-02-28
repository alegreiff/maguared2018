/*
jQuery(function($) {
    $(window).scroll(function() {
        var yPos = ($(window).scrollTop());
        if (yPos > 200) { // show sticky menu after screen has scrolled down 200px from the top
            $(".nav-secondary").fadeIn(0); // change value to display sticky menu more or less faster
            console.log('menor a 200');
        } else {
            $(".nav-secondary").fadeOut(0);
            console.log('mayor a 200');
        }
    });
});
*/
jQuery(function( $ ){
 
    $(".site-header").after('<div class="bumper"></div>');
    $(window).scroll(function () {
    if ($(document).scrollTop() > 30 ) {
        $('.site-header').addClass('fija');
        console.log("Biko Abajo")
    }else {
        $('.site-header').removeClass('fija');
        console.log("Lupe ARRIBA")
    }
        
    });
     
});