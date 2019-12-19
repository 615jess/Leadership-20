<?php

//Register Feature custom post type
function feature_register() {
    $args = array(
        'label' => __('Features'),
        'labels' => array(
            'singular_name' => "Feature",
            'add_new' => "Add New Feature",
            'add_new_item' => "Add New Feature",
            'edit_item' => "Edit Feature",
            'new_item' => "New Feature",
            'view_item' => "View Feature",
            'search_items' => "Search Features"
        ),
        'description' => "Small block of content usually associated with an image.",
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
    
    register_post_type("feature", $args);
}
add_action('init', 'feature_register');

//Define the meta box with extra fields for the feature post type
function feature_admin_init() {
    add_meta_box("feature-meta", "Feature Information", "feature_meta_options", "feature", "normal", "high");
} 
add_action("admin_init", "feature_admin_init");

function feature_meta_options() {
    if ( !has_action( 'admin_footer', 'wp_print_media_templates' ) ) {
        wp_enqueue_media();
    }
    
    global $post;
    $custom = get_post_custom($post->ID);
    
    //Get current values, if any and set
    $feature_image = $custom["feature_image"][0];
    $feature_link = $custom["feature_link"][0];
    $feature_new_window = $custom["feature_new_window"][0]; 
    
?>
      <p><label>Feature Image: </label><br />
     <a href="#" class="custom_media_upload">Choose/Upload</a> or <a href="#" class="custom_media_remove">Remove</a><br />
     <img style="max-width:500px;" class="custom_media_image" src="<?php echo $feature_image; ?>" /><br />
     <input type="text" size="100" name="feature_image" class="custom_media_url" value="<?php echo $feature_image; ?>" readonly="readonly" />
     </p>
     <p><label>Link - Copy full link that this featured content should link to: </label><br />
     <input type="text" size="100" name="feature_link" value="<?php echo $feature_link; ?>" /></p>
     <p><label>New Window? - Should the link open a new window: </label><br />
     <input type="checkbox" name="feature_new_window" value="true" <?php if ($feature_new_window == "true") : ?>checked<?php endif; ?> /> Yes, open in new window</p>
   
     <input type="hidden" name="page_save" value="1" />
     
     <script type="text/javascript">
        jQuery('.custom_media_upload').click(function() {
            
            var button = jQuery(this);
            var send_attachment_bkp = wp.media.editor.send.attachment;

            wp.media.editor.send.attachment = function(props, attachment) {
                button.parent().find('.custom_media_image').attr('src', attachment.url);
                button.parent().find('.custom_media_url').val(attachment.url);
                button.parent().find('.custom_media_image').show();

                wp.media.editor.send.attachment = send_attachment_bkp;
            }

            wp.media.editor.open( button );

            return false;       
        });
        
         jQuery('.custom_media_remove').click(function() {
             var button = jQuery(this);
             button.parent().find('.custom_media_image').hide();
             button.parent().find('.custom_media_url').val('');
             
             return false;
         });
     </script>
     
<?php
}

//Define the ability to save the custom fields in the database
function save_feature() {
    global $post;
    
    if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || !$_POST['page_save'] || $post->post_type != "feature") {
        return $post->ID;
    }
    
    $feature_location = implode("|", $_POST['feature_location']);
    $feature_new_window = "false";
    if ($_POST['feature_new_window'] == "true") {
        $feature_new_window = "true";
    }
    $feature_is_default = "false";
    if ($_POST['feature_is_default'] == "true") {
        $feature_is_default = "true";
    }
    
    update_post_meta($post->ID, "feature_image", $_POST["feature_image"]);
    update_post_meta($post->ID, "feature_link", $_POST["feature_link"]);
    update_post_meta($post->ID, "feature_new_window", $feature_new_window); 
}
add_action("save_post", "save_feature");


//Setup the admin columns for managing the car post type
function feature_edit_columns($columns) {
    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => "Feature Title",
        "feature-thumbnail" => "Image"
    );
    
    return $columns;
}
add_filter("manage_edit-feature_columns", "feature_edit_columns");

function feature_custom_columns($columns) {
    global $post;
    
    switch($columns) {
        case "feature-thumbnail" :
            $image = get_post_meta($post->ID, "feature_image", true);
            $image_width = 300;
            $image_height = 200;
                
            $src = "/scripts/timthumb.php?src=" . $image. "&w=$image_width&h=$image_height&zc=1";

            echo '<img src="' . $src . '" />';
            break;
    }
}
add_action("manage_posts_custom_column", "feature_custom_columns");