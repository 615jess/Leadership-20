<?php
/***
* 
* Options group name - northstar_theme_settings
* 
*/


//This constant will replace the specific name of the theme throughout this file
define("NS_THEME", "Leadership International");


add_action("admin_menu", "northstar_theme_menu");
function northstar_theme_menu() {
    add_theme_page(
        "Theme Settings",   //The title of the page displayed
        NS_THEME . " Theme Settings", //The Title of the menu item displayed
        "administrator",    //Type of use that can see the menu
        "northstar_theme_menu", //Unique ID for menu item - it ends up being the 'slug' or address of the page
        "northstar_theme_menu_display"  //The callback function for content of this theme page
    );
}

function northstar_theme_menu_display() {
    //class='wrap' is a default Wordress container - important for consistent styling
?>

    <div class="wrap">
    
        <!-- Get the default themes icon -->
        <div id="icon-themes" class="icon32"></div> 
        <h2><?php echo NS_THEME; ?> Settings</h2>
        
        <?php
        //Wordpress function for rendering settings save errors 
        settings_errors(); 
        ?>
        
        <form method="post" action="options.php"> 
            <?php settings_fields( 'northstar_theme_settings' ); //Render the settings fields for this options group ?> 
            <?php do_settings_sections( 'northstar_theme_settings' ); //Render the sections and their fields for this options group ?> 
            <?php submit_button(); ?> 
        </form>
        
    </div>
    
<?php
}

//Step 2 - Initialize the options group(s).  Create and register the sections and fields for the options group
add_action('admin_init', 'northstar_initialize_theme_settings');
function northstar_initialize_theme_settings() {
    
    //If the theme options don't exist, create them
    if (!get_option('northstar_theme_settings')) {
        add_option('northstar_theme_settings');
    }   
    
    //Create a section for each group of options - visually aids the user
    
    /*** Links Section ***/   
     
    add_settings_section(
        'northstar_theme_links_section', // ID used to identify this section and with which to register options
        'Site Links',   //Display title of the section
        'northstar_theme_links_section_callback',    //Callback for the section - usually used to show a description
        'northstar_theme_settings' //Options group that this section is associated with
    );    
        add_settings_field(
            "facebook_link",    //Id used to identify the field and retrieve value for this option
            "<label for='facebook_link'><em>Facebook</em> Link</label>",  //Label of the field
            "northstar_theme_facebook_link_callback",  //Callback function to render the actual field
            "northstar_theme_settings", //Options group that this field is associated with
            "northstar_theme_links_section" //The section that this field is associated with
        );
        
        add_settings_field(
            "twitter_link",    //Id used to identify the field and retrieve value for this option
            "<label for='twitter_link'><em>Twitter</em> Link</label>",  //Label of the field
            "northstar_theme_twitter_link_callback",  //Callback function to render the actual field
            "northstar_theme_settings", //Options group that this field is associated with
            "northstar_theme_links_section" //The section that this field is associated with
        );
        
        add_settings_field(
            "youtube_link",    //Id used to identify the field and retrieve value for this option
            "<label for='youtube_link'><em>Youtube</em> Link</label>",  //Label of the field
            "northstar_theme_youtube_link_callback",  //Callback function to render the actual field
            "northstar_theme_settings", //Options group that this field is associated with
            "northstar_theme_links_section" //The section that this field is associated with
        );
        
        add_settings_field(
            "partner_link",    //Id used to identify the field and retrieve value for this option
            "<label for='partner_link'><em>Partner</em> Link</label>",  //Label of the field
            "northstar_theme_partner_link_callback",  //Callback function to render the actual field
            "northstar_theme_settings", //Options group that this field is associated with
            "northstar_theme_links_section" //The section that this field is associated with
        );
        
        add_settings_field(
            "give_link",    //Id used to identify the field and retrieve value for this option
            "<label for='give_link'><em>Give</em> Link</label>",  //Label of the field
            "northstar_theme_give_link_callback",  //Callback function to render the actual field
            "northstar_theme_settings", //Options group that this field is associated with
            "northstar_theme_links_section" //The section that this field is associated with
        );
        
        add_settings_field(
            "serve_link",    //Id used to identify the field and retrieve value for this option
            "<label for='serve_link'><em>Serve</em> Link</label>",  //Label of the field
            "northstar_theme_serve_link_callback",  //Callback function to render the actual field
            "northstar_theme_settings", //Options group that this field is associated with
            "northstar_theme_links_section" //The section that this field is associated with
        );
        
        add_settings_field(
            "pray_link",    //Id used to identify the field and retrieve value for this option
            "<label for='pray_link'><em>Pray</em> Link</label>",  //Label of the field
            "northstar_theme_pray_link_callback",  //Callback function to render the actual field
            "northstar_theme_settings", //Options group that this field is associated with
            "northstar_theme_links_section" //The section that this field is associated with
        );
        
     /*** Home Page Section ***/   
     
    add_settings_section(
        'northstar_theme_homepage_section', // ID used to identify this section and with which to register options
        'Home Page',   //Display title of the section
        'northstar_theme_homepage_section_callback',    //Callback for the section - usually used to show a description
        'northstar_theme_settings' //Options group that this section is associated with
    );  
        
        add_settings_field(
            "learnmore_link",    //Id used to identify the field and retrieve value for this option
            "<label for='pray_link'><em>Learn More</em> Link</label>",  //Label of the field
            "northstar_theme_learnmore_link_callback",  //Callback function to render the actual field
            "northstar_theme_settings", //Options group that this field is associated with
            "northstar_theme_homepage_section" //The section that this field is associated with
        );
        
        add_settings_field(
            "video_screen",    //Id used to identify the field and retrieve value for this option
            "<label for='video_screen'><em>Video Screenshot</label>",  //Label of the field
            "northstar_theme_video_screen_callback",  //Callback function to render the actual field
            "northstar_theme_settings", //Options group that this field is associated with
            "northstar_theme_homepage_section" //The section that this field is associated with
        );
        
        add_settings_field(
            "video_embed",    //Id used to identify the field and retrieve value for this option
            "<label for='pray_link'>Video Embed Code</label>",  //Label of the field
            "northstar_theme_video_embed_callback",  //Callback function to render the actual field
            "northstar_theme_settings", //Options group that this field is associated with
            "northstar_theme_homepage_section" //The section that this field is associated with
        );
        
    /*** Header/Footer Section ***/   
     
    add_settings_section(
        'northstar_theme_header_footer_section', // ID used to identify this section and with which to register options
        'Footer Settings',   //Display title of the section
        'northstar_theme_header_footer_section_callback',    //Callback for the section - usually used to show a description
        'northstar_theme_settings' //Options group that this section is associated with
    );    
        
        
        add_settings_field(
            "contact_section1",    //Id used to identify the field and retrieve value for this option
            "<label for='contact_section1'>Contact Section 1</label>",  //Label of the field
            "northstar_theme_contact_section1_callback",  //Callback function to render the actual field
            "northstar_theme_settings", //Options group that this field is associated with
            "northstar_theme_header_footer_section" //The section that this field is associated with
        );
        
        add_settings_field(
            "contact_section2",    //Id used to identify the field and retrieve value for this option
            "<label for='contact_section2'>Contact Section 2</label>",  //Label of the field
            "northstar_theme_contact_section2_callback",  //Callback function to render the actual field
            "northstar_theme_settings", //Options group that this field is associated with
            "northstar_theme_header_footer_section" //The section that this field is associated with
        );
        
        add_settings_field(
            "contact_section3",    //Id used to identify the field and retrieve value for this option
            "<label for='contact_section3'>Contact Section 3</label>",  //Label of the field
            "northstar_theme_contact_section3_callback",  //Callback function to render the actual field
            "northstar_theme_settings", //Options group that this field is associated with
            "northstar_theme_header_footer_section" //The section that this field is associated with
        );
    
    
    
    //Register the option group with Wordpress - the second argument is the name to reference it by - usually best to keep it the same
    register_setting( 
        'northstar_theme_settings', 
        'northstar_theme_settings',
        'northstar_theme_validation'    //Callback function to filter the submitted values.  Useful to check if certain values were entered correctly.
    ); 
}

/***
* SECTION CALLBACKS
* 
*/
function northstar_theme_links_section_callback() {
?>
   
<?php
}

function northstar_theme_homepage_section_callback() {
    wp_enqueue_script('post');
    wp_enqueue_media();
?>
    
    <script type="text/javascript">
    jQuery(document).ready(function() {
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
    });
     </script> 
<?php
}

function northstar_theme_header_footer_section_callback() {
?>
    
<?php
}

/***
* FIELD CALLBACKS
* 
*/

function northstar_theme_facebook_link_callback() {
    
    //Get current values for the option group
    $settings = get_option("northstar_theme_settings");
    
    //ID should be same as field name in add_settings_field and the name should be the options group array
    //class="regular-text" and <span class="description"> is a Wordpress standard styling
?>
    <input type="text" id="facebook_link" value="<?php echo $settings["facebook_link"]; ?>" name="northstar_theme_settings[facebook_link]" class="regular-text" />
    <span class="description"> Link for Facebook.</span>
<?php
}

function northstar_theme_twitter_link_callback() {
    
    //Get current values for the option group
    $settings = get_option("northstar_theme_settings");
    
    //ID should be same as field name in add_settings_field and the name should be the options group array
    //class="regular-text" and <span class="description"> is a Wordpress standard styling
?>
    <input type="text" id="twitter_link" value="<?php echo $settings["twitter_link"]; ?>" name="northstar_theme_settings[twitter_link]" class="regular-text" />
    <span class="description"> Link for Twitter.</span>
<?php
}

function northstar_theme_youtube_link_callback() {
    
    //Get current values for the option group
    $settings = get_option("northstar_theme_settings");
    
    //ID should be same as field name in add_settings_field and the name should be the options group array
    //class="regular-text" and <span class="description"> is a Wordpress standard styling
?>
    <input type="text" id="youtube_link" value="<?php echo $settings["youtube_link"]; ?>" name="northstar_theme_settings[youtube_link]" class="regular-text" />
    <span class="description"> Link for Youtube.</span>
<?php
}

function northstar_theme_partner_link_callback() {
    
    //Get current values for the option group
    $settings = get_option("northstar_theme_settings");
    
    //ID should be same as field name in add_settings_field and the name should be the options group array
    //class="regular-text" and <span class="description"> is a Wordpress standard styling
?>
    <input type="text" id="partner_link" value="<?php echo $settings["partner_link"]; ?>" name="northstar_theme_settings[partner_link]" class="regular-text" />
    <span class="description"> Link for <em>Partner</em> button.</span>
<?php
}

function northstar_theme_give_link_callback() {
    
    //Get current values for the option group
    $settings = get_option("northstar_theme_settings");
    
    //ID should be same as field name in add_settings_field and the name should be the options group array
    //class="regular-text" and <span class="description"> is a Wordpress standard styling
?>
    <input type="text" id="give_link" value="<?php echo $settings["give_link"]; ?>" name="northstar_theme_settings[give_link]" class="regular-text" />
    <span class="description"> Link for <em>Give</em> button.</span>
<?php
}

function northstar_theme_serve_link_callback() {
    
    //Get current values for the option group
    $settings = get_option("northstar_theme_settings");
    
    //ID should be same as field name in add_settings_field and the name should be the options group array
    //class="regular-text" and <span class="description"> is a Wordpress standard styling
?>
    <input type="text" id="serve_link" value="<?php echo $settings["serve_link"]; ?>" name="northstar_theme_settings[serve_link]" class="regular-text" />
    <span class="description"> Link for <em>Serve</em> button.</span>
<?php
}

function northstar_theme_pray_link_callback() {
    
    //Get current values for the option group
    $settings = get_option("northstar_theme_settings");
    
    //ID should be same as field name in add_settings_field and the name should be the options group array
    //class="regular-text" and <span class="description"> is a Wordpress standard styling
?>
    <input type="text" id="pray_link" value="<?php echo $settings["pray_link"]; ?>" name="northstar_theme_settings[pray_link]" class="regular-text" />
    <span class="description"> Link for <em>Pray</em> button.</span>
<?php
}

function northstar_theme_learnmore_link_callback() {
    
    //Get current values for the option group
    $settings = get_option("northstar_theme_settings");
    
    //ID should be same as field name in add_settings_field and the name should be the options group array
    //class="regular-text" and <span class="description"> is a Wordpress standard styling
?>
    <input type="text" id="learnmore_link" value="<?php echo $settings["learnmore_link"]; ?>" name="northstar_theme_settings[learnmore_link]" class="regular-text" />
    <span class="description"> Link for <em>Learn More</em> link on home page.</span>
<?php
}

function northstar_theme_video_screen_callback() {
    
    //Get current values for the option group
    $settings = get_option("northstar_theme_settings");
    
    //ID should be same as field name in add_settings_field and the name should be the options group array
    //class="regular-text" and <span class="description"> is a Wordpress standard styling
?>

     <a href="#" class="custom_media_upload">Choose/Upload</a> or <a href="#" class="custom_media_remove">Remove</a><br />
     <img style="max-width:500px;" class="custom_media_image" src="<?php echo $settings['video_screen']; ?>" /><br />
     <input type="text" id='video_screen' name="northstar_theme_settings[video_screen]" class="custom_media_url" value="<?php echo $settings['video_screen']; ?>" class="regular-text" readonly="readonly" />
     
<?php
}

function northstar_theme_video_embed_callback() {
    
    //Get current values for the option group
    $settings = get_option("northstar_theme_settings");
    
    //ID should be same as field name in add_settings_field and the name should be the options group array
    //class="regular-text" and <span class="description"> is a Wordpress standard styling
?>
    <textarea rows='5' cols='60' id="video_embed" name="northstar_theme_settings[video_embed]" class="regular-text"><?php echo $settings["video_embed"]; ?></textarea>
    <span class="description"> Video embed code for the home page.</span>
<?php
}

function northstar_theme_contact_section1_callback() {
    
    //Get current values for the option group
    $settings = get_option("northstar_theme_settings");
    
    //ID should be same as field name in add_settings_field and the name should be the options group array
    //class="regular-text" and <span class="description"> is a Wordpress standard styling

    the_editor($settings["contact_section1"], "northstar_theme_settings[contact_section1]");
}

function northstar_theme_contact_section2_callback() {
    
    //Get current values for the option group
    $settings = get_option("northstar_theme_settings");
    
    //ID should be same as field name in add_settings_field and the name should be the options group array
    //class="regular-text" and <span class="description"> is a Wordpress standard styling
    
    the_editor($settings["contact_section2"], "northstar_theme_settings[contact_section2]");
}

function northstar_theme_contact_section3_callback() {
    
    //Get current values for the option group
    $settings = get_option("northstar_theme_settings");
    
    //ID should be same as field name in add_settings_field and the name should be the options group array
    //class="regular-text" and <span class="description"> is a Wordpress standard styling
    
    the_editor($settings["contact_section3"], "northstar_theme_settings[contact_section3]");
}


/***
* 
* VALIDATION CALLBACKS
*/

//Cleanup fields.  Argument is the options group with posted values
function northstar_theme_validation($settings) {
    return $settings;
}