<?php

function get_states() {
    $state_array = array(
            'AL'=>"Alabama",
            'AK'=>"Alaska",
            'AZ'=>"Arizona",
            'AR'=>"Arkansas",
            'CA'=>"California",
            'CO'=>"Colorado",
            'CT'=>"Connecticut",
            'DE'=>"Delaware",
            'DC'=>"District Of Columbia",
            'FL'=>"Florida",
            'GA'=>"Georgia",
            'HI'=>"Hawaii",
            'ID'=>"Idaho",
            'IL'=>"Illinois",
            'IN'=>"Indiana",
            'IA'=>"Iowa",
            'KS'=>"Kansas",
            'KY'=>"Kentucky",
            'LA'=>"Louisiana",
            'ME'=>"Maine",
            'MD'=>"Maryland",
            'MA'=>"Massachusetts",
            'MI'=>"Michigan",
            'MN'=>"Minnesota",
            'MS'=>"Mississippi",
            'MO'=>"Missouri",
            'MT'=>"Montana",
            'NE'=>"Nebraska",
            'NV'=>"Nevada",
            'NH'=>"New Hampshire",
            'NJ'=>"New Jersey",
            'NM'=>"New Mexico",
            'NY'=>"New York",
            'NC'=>"North Carolina",
            'ND'=>"North Dakota",
            'OH'=>"Ohio",
            'OK'=>"Oklahoma",
            'OR'=>"Oregon",
            'PA'=>"Pennsylvania",
            'RI'=>"Rhode Island",
            'SC'=>"South Carolina",
            'SD'=>"South Dakota",
            'TN'=>"Tennessee",
            'TX'=>"Texas",
            'UT'=>"Utah",
            'VT'=>"Vermont",
            'VA'=>"Virginia",
            'WA'=>"Washington",
            'WV'=>"West Virginia",
            'WI'=>"Wisconsin",
            'WY'=>"Wyoming"
    );
    return $state_array;
}

function get_blog_page() {
    
    $blog = get_posts(array(
        "post_type" => "page",
        "meta_key" => "_wp_page_template",
        "meta_value" => "page-templates/page-blog.php"
    ));
    
    return $blog[0];
}

function get_calendar_page() {
    
    $calendar = get_posts(array(
        "post_type" => "page",
        "meta_key" => "_wp_page_template",
        "meta_value" => "page-templates/page-calendar.php"
    ));
    
    return $calendar[0];
}

function get_veneer_species_guide_page() {
    
    $veneer_guide = get_posts(array(
        "post_type" => "page",
        "meta_key" => "_wp_page_template",
        "meta_value" => "page-templates/page-veneer-species-guide.php"
    ));
    
    return $veneer_guide[0];
}

function get_gradedspecies_page() {
    
    $gradedspecies_guide = get_posts(array(
        "post_type" => "page",
        "meta_key" => "_wp_page_template",
        "meta_value" => "page-templates/page-graded-species.php"
    ));
    
    return $gradedspecies_guide[0];
}

function get_project_gallery_page() {
    
    $project_gallery = get_posts(array(
        "post_type" => "page",
        "meta_key" => "_wp_page_template",
        "meta_value" => "page-templates/page-project-gallery.php"
    ));
    
    return $project_gallery[0];
}

function get_profiles_in_quality_page() {
    
    $profile_gallery = get_posts(array(
        "post_type" => "page",
        "meta_key" => "_wp_page_template",
        "meta_value" => "page-templates/page-profiles-in-quality.php"
    ));
    
    return $profile_gallery[0];
}

function get_product_listing_page($product_category = null) {
    if ($product_category) { 
        $product_category_page = get_posts(array(
            'post_type' => 'page',
            'meta_query' => array(
                array(
                    'key' => 'page_product_category',
                    'value' => $product_category,
                    'compare' =>  '=',
                    'type' => 'NUMERIC'
                )
            )
        ));

        return $product_category_page[0];
    } else {
        $product_category_page = get_posts(array(
            'post_type' => 'page',   
            'meta_query' => array(
                array(
                    'key' => '_wp_page_template',
                    'value' => 'page-templates/page-product-all-categories.php',
                    'compare' =>  '='
                )
            ) 
        ));

        return $product_category_page[0];
    }
}

/** 
 * Add styles/classes to the "Styles" drop-down 
 */   
add_filter( 'tiny_mce_before_init', 'nsm_mce_before_init' );  
function nsm_mce_before_init( $settings ) {  
  
    $style_formats = array(  
        array(  
            'title' => 'Color - LI Blue',  
            'inline' => 'span',
            'classes' => 'LI-Blue'  
            ),  
        array(  
            'title' => 'Color - LI Orange',  
            'inline' => 'span',  
            'classes' => 'LI-Orange',  
        ),  
        array(
            'title' => 'Font - Fugu',  
            'inline' => 'span',  
            'classes' => 'LI-Fugu',  
        ),
        array(
            'title' => 'Font - Madurai Slab Normal Bold',  
            'inline' => 'span',  
            'classes' => 'LI-MaduraiSlabNormalBold',  
        ),
        array(
            'title' => 'Font - Novecento Sans Wide Book',  
            'inline' => 'span',  
            'classes' => 'LI-NovecentoSansWideBook',  
        ),
        array(
            'title' => 'Font - Novecento Sans Wide Medium',  
            'inline' => 'span',  
            'classes' => 'LI-NovecentoSansWideMedium',  
        ),
        array(
            'title' => 'Font - Novecento Sans Wide Normal',  
            'inline' => 'span',  
            'classes' => 'LI-NovecentoSansWideNormal',  
        )
    );  
  
    $settings['style_formats'] = json_encode( $style_formats );  
    $settings['theme_advanced_blockformats'] = 'p, h2, h3, h4';
  
    return $settings;  
  
}   