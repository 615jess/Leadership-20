<?php

//Register Testimonial custom post type
function testimonial_register() {
    $args = array(
        'label' => __('Testimonials'),
        'labels' => array(
            'singular_name' => "Testimonial",
            'add_new' => "Add New Testimonial",
            'add_new_item' => "Add New Testimonial",
            'edit_item' => "Edit Testimonial",
            'new_item' => "New Testimonial",
            'view_item' => "View Testimonial",
            'search_items' => "Search Testimonials"
        ),
        'description' => "Testimonials from people",
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'show_in_nav_menus' => false,
        'menu_position' => 50,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => false,
        'supports' => array(
            'title',
            'editor'
        )
    );
    
    register_post_type("testimonial", $args);
}
add_action('init', 'testimonial_register');

//Define the meta box with extra fields for the testimonial post type
function testimonial_admin_init() {
    add_meta_box("testimonial-meta", "Testimonial Information", "testimonial_meta_options", "testimonial", "normal", "high");
} 
add_action("admin_init", "testimonial_admin_init");

function testimonial_meta_options() {
    if ( !has_action( 'admin_footer', 'wp_print_media_templates' ) ) {
        wp_enqueue_media();
    }
    global $post;
    $custom = get_post_custom($post->ID);
    
    $testimonial_attribution = $custom["testimonial_attribution"][0];

?> 
     <h4>General Testimonial Information</h4>
     <p>
            <label>Testimonial Attribution</label><br />
            <input type="text" size="100" name="testimonial_attribution" value="<?php echo $testimonial_attribution; ?>" />
        </p>

     <input type="hidden" name="page_save" value="1" />

<?php
}

//Define the ability to save the custom fields in the database
function save_testimonial() {
    global $post;
    
    if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || !$_POST['page_save'] || $post->post_type != "testimonial") {
        return $post->ID;
    }

    
    update_post_meta($post->ID, "testimonial_attribution", $_POST["testimonial_attribution"]);
}
add_action("save_post", "save_testimonial");


//Setup the admin columns for managing the testimonial post type
function testimonial_edit_columns($columns) {
    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "testimonial_attribution" => "Attribution",
        "testimonial_quote" => "Testimonial"
    );
    
    return $columns;
}
add_filter("manage_edit-testimonial_columns", "testimonial_edit_columns");

function testimonial_custom_columns($columns) {
    global $post;
    
    
    
    switch($columns) {
        case "testimonial_attribution":
            
            $post_type_object = get_post_type_object( $post->post_type );
            $can_edit_post = current_user_can( $post_type_object->cap->edit_post, $post->ID );
            
            $custom = get_post_custom($post->ID);
            
            echo '<a href="' . get_edit_post_link( $post->ID, true ) . '" title="' . esc_attr( __( 'Edit this testimonial' ) ) . '">' . $custom['testimonial_attribution'][0] . '</a>';
            
            //Actions to edit
            if ( $can_edit_post && 'trash' != $post->post_status ) {
                $actions['edit'] = '<a href="' . get_edit_post_link( $post->ID, true ) . '" title="' . esc_attr( __( 'Edit this item' ) ) . '">' . __( 'Edit' ) . '</a>';
            }

            //Actions to delete/trash
            if ( current_user_can( $post_type_object->cap->delete_post, $post->ID ) ) {
                if ( 'trash' == $post->post_status )
                    $actions['untrash'] = "<a title='" . esc_attr( __( 'Restore this item from the Trash' ) ) . "' href='" . wp_nonce_url( admin_url( sprintf( $post_type_object->_edit_link . '&amp;action=untrash', $post->ID ) ), 'untrash-' . $post->post_type . '_' . $post->ID ) . "'>" . __( 'Restore' ) . "</a>";

                elseif ( EMPTY_TRASH_DAYS )
                    $actions['trash'] = "<a class='submitdelete' title='" . esc_attr( __( 'Move this item to the Trash' ) ) . "' href='" . get_delete_post_link( $post->ID ) . "'>" . __( 'Trash' ) . "</a>";

                if ( 'trash' == $post->post_status || !EMPTY_TRASH_DAYS )
                    $actions['delete'] = "<a class='submitdelete' title='" . esc_attr( __( 'Delete this item permanently' ) ) . "' href='" . get_delete_post_link( $post->ID, '', true ) . "'>" . __( 'Delete Permanently' ) . "</a>";
            }

                //Echo the 'actions' HTML, let WP_List_Table do the hard work
                echo WP_List_Table::row_actions( $actions );
            break;
        case "testimonial_quote" :
            echo apply_filters('the_content', $post->post_content);
            
    }
}
add_action("manage_testimonial_posts_custom_column", "testimonial_custom_columns");