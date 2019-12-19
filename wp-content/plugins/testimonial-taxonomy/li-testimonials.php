<?php
/**
 * @package LItestimonials
 * @version 0.01
 */
/*
Plugin Name: LItestimonials
Plugin URI: leadershipintl.org
Description: This adds Testimonials Taxonomy to Site.
Author: Jess Erickson
Version: 0.01
Author URI: http://spirographics.com
*/



/* Custom Post Type Start */

function create_posttype() {
register_post_type( 'Testimonial',
// CPT Options

array(
  'labels' => array(
   'name' => __( 'testimonial' ),
   'singular_name' => __( 'testimonial' )
  ),
  'public' => true,
  'has_archive' => false,
  'rewrite' => array('slug' => 'testimonial'),
 )
);
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

/* Custom Post Type End */

/*Custom Post type start*/

function cw_post_type_testimonial() {

$supports = array(
'title', // post title
'editor', // post content
'author', // post author
'thumbnail', // featured images
'excerpt', // post excerpt
'custom-fields', // custom fields
'comments', // post comments
'revisions', // post revisions
'post-formats', // post formats
);

$labels = array(
'name' => _x('testimonials', 'plural'),
'singular_name' => _x('testimonial', 'singular'),
'menu_name' => _x('Testimonials', 'admin menu'),
'name_admin_bar' => _x('testimonial', 'admin bar'),
'add_new' => _x('Add New', 'add new'),
'add_new_item' => __('Add New news'),
'new_item' => __('New testimonial'),
'edit_item' => __('Edit testimonial'),
'view_item' => __('View testimonial'),
'all_items' => __('All testimonials'),
'search_items' => __('Search testimonials'),
'not_found' => __('No testimonial found.'),
);

$args = array(
'supports' => $supports,
'labels' => $labels,
'public' => true,
'query_var' => true,
'rewrite' => array('slug' => 'testimonial'),
'has_archive' => true,
'hierarchical' => false,
);
register_post_type('testimonial', $args);
}
add_action('init', 'cw_post_type_testimonial');

/*Custom Post type end*/
