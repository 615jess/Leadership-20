<?php
function li_callout( $atts, $content = null ) {
    if (!$atts['align']) {
        $atts['align'] = 'left';
    }
    return '<div class="callout-quote ' . $atts['align'] . '">' . apply_filters('the_content', do_shortcode($content)) . '</div>';
}
add_shortcode('callout', 'li_callout');

function li_map( $atts, $content = null ) {
     
    $map_areas = "";
    $map_areas_content = "";

    $args = array(
        "numberposts" => 11,
        "orderby" => "menu_order",
        "order" => "ASC",
        "post_type" => "country"
    );
    $countries = get_posts($args);
    
    foreach($countries as $country) {
        $custom = get_post_custom($country->ID);
        
        global $wpdb;
        $country_db = $wpdb->get_row("SELECT country FROM iso_countries WHERE code='" . $custom['country_country'][0] . "'"); 
        
        $content =   "<h3>" .apply_filters("the_title", $country_db->country) . "</h3>" . str_replace(array("\n", "\t", "\r"), '', apply_filters('the_content', $country->post_content));
        
        $map_areas .= "{ id: '" . $custom['country_country'][0] . "', color: '#BC722B', autoZoom:true },"; 
        
        $map_areas_content .= '<div id="map_area_' . $custom['country_country'][0] . '" class="map_area_content">' . $content . '</div>';
    }
    $map_areas = rtrim($map_areas, ",");
    

    return '
        <div id="mapdiv" style="width:100%; height: 700px;position:relative;"></div>
        <div id="map_areas_content" style="display:none;">
            <div class="wysiwyg">' .
                $map_areas_content .
            '</div>
        </div>
        
        <script src="' . get_bloginfo("template_directory") . '/ammap/ammap/ammap.js" type="text/javascript"></script>
        <script src="' . get_bloginfo("template_directory") . '/ammap/ammap/maps/js/worldHigh.js" type="text/javascript"></script>
        
        <script type="text/javascript">
                    
            // add all your code to this method, as this will ensure that page is loaded
            AmCharts.ready(function() {
                // create AmMap object
                var map = new AmCharts.AmMap();
                // set path to images
                map.pathToImages =  "' . get_bloginfo("template_directory") . '/ammap/ammap/images/";
                
                var dataProvider = {
                    mapVar: AmCharts.maps.worldHigh,
                    getAreasFromMap:true,
                     areas: [' . $map_areas . ']                 
                }; 
                // pass data provider to the map object
                map.dataProvider = dataProvider;
            
                /* create areas settings
                 * autoZoom set to true means that the map will zoom-in when clicked on the area
                 * selectedColor indicates color of the clicked area.
                 */
                map.areasSettings = {
                    autoZoom: false,
                    color: "#CDCDCD",
                    colorSolid: "#BC722B",
                    selectedColor: "#83AED1",
                    outlineColor: "#666666",
                    rollOverColor: "#83AED1",
                    rollOverOutlineColor: "#FFFFFF"
                };
                
                map.zoomControl.buttonFillColor = "#3C3316";
                map.zoomControl.buttonRollOverColor= "#544A26";
                
                jQuery("#mapdiv").on("click", ".close_current_description", function() {
                    jQuery("#map_current_description").animate({ top: "100%"}, 1000, function() {
                        jQuery("#map_current_description").remove();
                        map.validateNow();
                    });
                    
                });
                
                map.addListener("clickMapObject", function (event) {
                    if (jQuery("#map_area_" + event.mapObject.id).length > 0) {
                        var currentDescription = jQuery("#mapdiv").append("<div id=\'map_current_description\' style=\'width:100%;height:100%;top:100%;left:0;position:absolute;z-index:1000;\'><div style=\'background-color:#F5F5E0; opacity:0.9;height:100%;\'><div style=\'padding:5% 10%;\' class=\'wysiwyg\'><p style=\'float:right;\'><a class=\'close_current_description\' href=\'javascript:void(0);\'>Close [x]</a>" + jQuery("#map_area_" + event.mapObject.id).html() + "</div></div></div>"); 
                        
                       jQuery("#map_current_description").animate({ top: "0"}, 1000);
                    }
                });  
            
                // write the map to container div
                map.write("mapdiv");  
                
            });
            
        </script>
   '; 
    
}
add_shortcode('map', 'li_map');