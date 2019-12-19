<?php

//Register Country custom post type
function country_register() {
    $args = array(
        'label' => __('Countries'),
        'labels' => array(
            'singular_name' => "Country",
            'add_new' => "Add New Country",
            'add_new_item' => "Add New Country",
            'edit_item' => "Edit Country",
            'new_item' => "New Country",
            'view_item' => "View Country",
            'search_items' => "Search Countries"
        ),
        'description' => "Country data for map",
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
            'editor'
        )
    );
    
    register_post_type("country", $args);
}
add_action('init', 'country_register');

//Define the meta box with extra fields for the country post type
function country_admin_init() {
    add_meta_box("country-meta", "Country Information", "country_meta_options", "country", "normal", "high");
} 
add_action("admin_init", "country_admin_init");

function country_meta_options() {
    if ( !has_action( 'admin_footer', 'wp_print_media_templates' ) ) {
        wp_enqueue_media();
    }
	
    global $post;
    $custom = get_post_custom($post->ID);
    
    $country_country = $custom["country_country"][0];

    global $wpdb;
    
    $countries = $wpdb->get_results("SELECT * FROM iso_countries ORDER BY country ASC");
?> 
     <h4>General Country Information</h4>
     <p>
        <label>Country: </label><br />
        <select name="country_country">
            <?php foreach ($countries as $country): ?>
            <option value="<?php echo $country->code; ?>" <?php if ($country->code == $country_country): ?>selected<?php endif; ?>><?php echo $country->country; ?></option>
            <?php endforeach; ?>
        </select>
     </p>

     <input type="hidden" name="page_save" value="1" />

<?php
}

//Define the ability to save the custom fields in the database
function save_country() {
    global $post;
    
    if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || !$_POST['page_save'] || $post->post_type != "country") {
        return $post->ID;
    }

    
    update_post_meta($post->ID, "country_country", $_POST["country_country"]);
}
add_action("save_post", "save_country");


//Setup the admin columns for managing the country post type
function country_edit_columns($columns) {
    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "country_country" => "Country"
    );
    
    return $columns;
}
add_filter("manage_edit-country_columns", "country_edit_columns");

function country_custom_columns($columns) {
    global $post;
    
    
    
    switch($columns) {
        case "country_country":
            global $wpdb;
            
            $post_type_object = get_post_type_object( $post->post_type );
            $can_edit_post = current_user_can( $post_type_object->cap->edit_post, $post->ID );
            
            $custom = get_post_custom($post->ID);
            
            $country = $wpdb->get_row("SELECT country FROM iso_countries WHERE code='" . $custom['country_country'][0] . "'"); 
            echo '<a href="' . get_edit_post_link( $post->ID, true ) . '" title="' . esc_attr( __( 'Edit this country' ) ) . '">' . $country->country . '</a>';
            
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


            break;
    }
}
add_action("manage_country_posts_custom_column", "country_custom_columns");