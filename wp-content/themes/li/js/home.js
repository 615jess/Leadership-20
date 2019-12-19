jQuery(document).ready(function() {         

    "use strict";

    // top images functions
    jQuery('.top-images .item .item-image').each(function(){
        var imageSRC = jQuery(this).attr('data-image');
        jQuery(this).css('background-image', 'url('+imageSRC+')');
    });
    var isDesktop = (function() {
        return !('ontouchstart' in window) 
        || !('onmsgesturechange' in window);
    })();
    window.isDesktop = isDesktop;
    if( isDesktop ) {   
        jQuery('.top-images .item').hover(
            function(){
                jQuery(this).find('.item-overlay').fadeIn(300);
                jQuery(this).find('.item-overlay .caption').animate({
                    'bottom': 0+'px'
                }, 300, function() {
                    // Animation complete.
                });
            },
            function(){
                jQuery(this).find('.item-overlay').fadeOut(300);
                jQuery(this).find('.item-overlay .caption').animate({
                    'bottom': '-100%'
                }, 300, function() {
                    // Animation complete.
                });
            }
        );
    } 
    jQuery('.top-images .item').click(function(){
        if ( jQuery(this).hasClass('active') ) {           
            jQuery(this).find('.item-overlay').fadeOut(300);
            jQuery(this).find('.item-overlay .caption').animate({
                'bottom': '-100%'
            }, 300, function() {
                // Animation complete.
            });
            jQuery(this).removeClass('active');  
        } else {            
            jQuery('.top-images .item').removeClass('active');
            jQuery(this).find('.item-overlay').fadeIn(300);
            jQuery(this).find('.item-overlay .caption').animate({
                'bottom': 0+'px'
            }, 300, function() {
                // Animation complete.
            });
            jQuery(this).addClass('active');
        }
    });

});