<?php

//Register Rotator custom post type
function rotator_register() {
    $args = array(
        'label' => __('Rotators'),
        'labels' => array(
            'singular_name' => "Rotator",
            'add_new' => "Add New Rotator",
            'add_new_item' => "Add New Rotator",
            'edit_item' => "Edit Rotator",
            'new_item' => "New Rotator",
            'view_item' => "View Rotator",
            'search_items' => "Search Rotators"
        ),
        'description' => "Rotating content usually on the homepage.",
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
    
    register_post_type("rotator", $args);
}
add_action('init', 'rotator_register');

//Define the meta box with extra fields for the rotator post type
function rotator_admin_init() {
    add_meta_box("rotator-meta", "Rotator Information", "rotator_meta_options", "rotator", "normal", "high");
} 
add_action("admin_init", "rotator_admin_init");

function rotator_meta_options() {
    if ( !has_action( 'admin_footer', 'wp_print_media_templates' ) ) {
        wp_enqueue_media();
    }
    global $post;
    $custom = get_post_custom($post->ID);
    
    $rotator_image = $custom["rotator_image"][0];
    $rotator_link = $custom["rotator_link"][0];
    $rotator_new_window = $custom["rotator_new_window"][0];

?> 
     <h4>General Rotator Information</h4>
     <p><label>Rotator Image: </label><br />
     <a href="#" class="custom_media_upload">Choose/Upload</a> or <a href="#" class="custom_media_remove">Remove</a><br />
     <img style="max-width:500px;" class="custom_media_image" src="<?php echo $rotator_image; ?>" /><br />
     <input type="text" size="100" name="rotator_image" class="custom_media_url" value="<?php echo $rotator_image; ?>" readonly="readonly" />
     </p>
     <p><label>Link (used for rotator types that allow links) - Copy full link that this rotator should link to: </label><br />
     <input type="text" size="100" name="rotator_link" value="<?php echo $rotator_link; ?>" /></p>
     <p><label>New Window? - Should the link open a new window: </label><br />
     <input type="checkbox" name="rotator_new_window" value="true" <?php if ($rotator_new_window == "true") : ?>checked<?php endif; ?> /> Yes, open in new window</p>

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
function save_rotator() {
    global $post;
    
    if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || !$_POST['page_save'] || $post->post_type != "rotator") {
        return $post->ID;
    }

    $rotator_new_window = "false";
    if ($_POST['rotator_new_window'] == "true") {
        $rotator_new_window = "true";
    }
    
    update_post_meta($post->ID, "rotator_image", $_POST["rotator_image"]);
    update_post_meta($post->ID, "rotator_link", $_POST["rotator_link"]);
    update_post_meta($post->ID, "rotator_new_window", $rotator_new_window);
}
add_action("save_post", "save_rotator");


//Setup the admin columns for managing the rotator post type
function rotator_edit_columns($columns) {
    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => "Rotator Title",
        "rotator-thumbnail" => "Image"
    );
    
    return $columns;
}
add_filter("manage_edit-rotator_columns", "rotator_edit_columns");

function rotator_custom_columns($columns) {
    global $post;
    
    switch($columns) {
        case "rotator-thumbnail" :
            $image = get_post_meta($post->ID, "rotator_image", true);
            $image_width = 300;
            $image_height = 200;
                
            $src = "/scripts/timthumb.php?src=" . $image. "&w=$image_width&h=$image_height&zc=1";

            echo '<img src="' . $src . '" />';
            break;
    }
}
add_action("manage_posts_custom_column", "rotator_custom_columns");