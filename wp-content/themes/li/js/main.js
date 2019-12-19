jQuery(document).ready(function() {         

    "use strict";

    // buttons function
    jQuery('.buttons a').hover(
        function(){
            jQuery(this).find('.active').fadeIn(300);
        },
        function(){
            jQuery(this).find('.active').fadeOut(300);
        }
    );
    
    jQuery(".video-cbox").colorbox({iframe:true, innerWidth:640, innerHeight:390});
    
    jQuery('.change-lang').click(function(e) {
        jQuery(this).hide();
        jQuery("#google_translate_element").show(); 
    });

    // video functions
    /*jQuery('.video .play').click(function(){
        jQuery(this).parents('.video').find('.overlay').fadeOut(300);
        jQuery(this).parents('.video').find('video').get(0).play();
    });
    jQuery('.video video').bind('ended',function(){
        jQuery(this).parents('.video').find('.overlay').fadeIn(300);
    });*/
    
    // developer logo functions
    jQuery('.developer').hover(
        function() {
            jQuery(this).find('.active').fadeIn(300);
            jQuery(this).find('.inactive').fadeOut(300);
        },
        function() {
            jQuery(this).find('.inactive').fadeIn(300);
            jQuery(this).find('.active').fadeOut(300);
        }
    );

    // menu fader 
    jQuery('.main-menu ul li').hover(
        function(){
            jQuery(this).find('ul').fadeIn(300);
            jQuery(this).find('.indicator').fadeIn(300);
        },
        function(){
            jQuery(this).find('ul').fadeOut(0);
            jQuery(this).find('.indicator').fadeOut(0);
        }
    );
    
    jQuery('.main-menu .left-ct .visible-desktop > ul > li').each(function(i) {
        console.log(i);
        if (i >= 3) {
            jQuery('.right-ct .main-nav2 ul').append(jQuery(this));
        }
    })

    // search functions
    jQuery('#show-search').click(function(){        
        if ( jQuery(this).hasClass('active')) {
            jQuery(this).removeClass('active');
            jQuery(this).parents('.search-form').find('form').fadeOut(0);
        } else {
            jQuery(this).addClass('active');
            jQuery(this).parents('.search-form').find('form').fadeIn(300);
            jQuery(this).parents('.search-form').find('.field').focus();
            jQuery(this).parents('.search-form').find('.field').focusout(function(){
                jQuery('.show-search').removeClass('active');
                jQuery(this).parents('.search-form').find('form').fadeOut(0);    
            });
        }   
    });

    // mobile-menu
    jQuery('.mobile-menu-container > ul li').each(function() {
        if (jQuery(this).find('ul').length > 0) {
            jQuery(this).addClass('parent');
            jQuery(this).find('a').first().after('<a href="javascript:void(0)" class="expand"></a>');  
        }
    });
    
    jQuery('.show-mobile-menu').click(function(){ 
        if ( jQuery(this).hasClass('active') ) {
            jQuery('#page').animate({
                'margin-left': 0+'px'
              }, 500, function() {
                // Animation complete.
            });
            jQuery('.show-mobile-menu').removeClass('active');
        } else {
            jQuery('#page').animate({
                'margin-left': 240+'px'
              }, 500, function() {
                // Animation complete.
            });
            jQuery('.show-mobile-menu').addClass('active');
        }
    });
    jQuery('.mobile-menu .expand').click(function(){
        if ( jQuery(this).hasClass('active') ) {
            jQuery(this).parents('.parent').find('ul').fadeOut(300);
            jQuery(this).removeClass('active');
        } else {
            jQuery(this).parents('.parent').find('ul').fadeIn(300);
            jQuery(this).addClass('active');
        }        
    });

    // back to top 
    jQuery('.back-to-top').click(function(){
        jQuery('html,body').animate({scrollTop:0}, 300);
    }); 

});