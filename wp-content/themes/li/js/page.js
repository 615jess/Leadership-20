jQuery(document).ready(function() {         

    "use strict";

    // top images functions
    jQuery('.top-images .item .item-image').each(function(){
        var imageSRC = jQuery(this).attr('data-image');
        jQuery(this).css('background-image', 'url('+imageSRC+')');
    });
});