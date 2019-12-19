<?php
include( get_template_directory() . '/functions-themeoptions.php');
include( get_template_directory() . '/functions-shortcodes.php');
include( get_template_directory() . '/functions-utility.php');
include( get_template_directory() . '/cpt-initialize.php');

// This theme styles the visual editor with editor-style.css to match the theme style.
add_editor_style();

// This theme uses post thumbnails
add_theme_support( 'post-thumbnails' );

// Add default posts and comments RSS feed links to head
add_theme_support( 'automatic-feed-links' );

// This theme uses wp_nav_menu() in 3 location.
register_nav_menus( array(
    'quicklinks' => __('Quick Links', 'li'),
    'footer-links' => __('Footer Links', 'li'),
) );

register_sidebar( array(
    'name' => __( 'Primary Sidebar', 'li' ),
    'id' => 'primary-sidebar',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
) );


register_sidebar( array(
    'name' => __( 'emailsub', 'li' ),
    'id' => 'email-sub',
    'before_widget' => '<div id="email_sub">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
) );

register_sidebar( array(
    'name' => 'Way Bottom',
    'id' => 'waybottom1',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
) );



function the_breadcrumb() {
        $delimiter = "<li>/</li>";
        $current_before = "<li class='active'>";
        $current_after = "</li>";
        
        //Find blog if there is one
        $blog = get_blog_page();
              
        $calendar = get_calendar_page();
        
        global $post;
        
        if (!is_home()) {
            
                echo '<li><a href="';
                echo get_option('home');
                echo '">';
                echo 'Home';
                echo "</a></li>";
                echo $delimiter;
        }
                
                if (is_single()) {
                        
                    
                    if (get_post_type() == "product") {
                        $product_listing = get_product_listing_page();
                        if ($product_listing) {
                            echo "<li><a href='" . get_page_link($product_listing->ID) . "'>" . $product_listing->post_title . "</a></li>";
                        }
                    }  else {  
                        if ($blog) {
                            echo "<li><a href='" . get_page_link($blog->ID) . "'>" . $blog->post_title . "</a></li>";
                        }
                    }
                    
                    echo $delimiter;
                    echo $current_before;
                    the_title();
                    echo $current_after;
                
                } elseif (is_page() && get_post_type() == "events") {
                        echo '<li><a href="';
                        echo get_permalink($calendar->ID); 
                        echo '">';
                        echo $calendar->post_title;
                        echo "</a></li>";
                        
                        echo $delimiter;
                        echo $current_before;
                        the_title();
                        echo $current_after;
                        
                } elseif (is_page() && !$post->post_parent && !is_404()) {
                        echo $current_before;
                        echo the_title();
                        echo $current_after;
                } elseif ( is_page() && $post->post_parent ) {
                    $parent_id  = $post->post_parent;
                    $breadcrumbs = array();
                    while ($parent_id) {
                        $page = get_page($parent_id);
                        $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
                        $parent_id  = $page->post_parent;
                    }
                    $breadcrumbs = array_reverse($breadcrumbs);
                    foreach ($breadcrumbs as $crumb) {
                        echo $crumb . $delimiter ;    
                    } 
                    echo $current_before . get_the_title() . $current_after;
                
        }
        elseif (is_tag()) {single_tag_title();}
       elseif (is_day()) {echo $current_before . "Archive for "; the_time('F jS, Y'); echo $current_after;}
        elseif (is_month()) {
            if ($blog) {
                echo "<li><a href='" . get_page_link($blog->ID) . "'>" . $blog->post_title . "</a></li>";
            }
            echo $delimiter;
            echo $current_before;
            echo "Archive for "; the_time('F Y');
            echo $current_after;
        }
        elseif (is_year()) {echo $current_before . "Archive for "; the_time('Y'); echo $current_after;}
        elseif (is_author()) {echo $current_before . "Author Archive"; echo $current_after;}
        elseif (is_category()) {
            if ($blog) {
                echo "<li><a href='" . get_page_link($blog->ID) . "'>" . $blog->post_title . "</a></li>";
                echo $delimiter;
                $categories = get_the_category();
                foreach($categories as $category) {
                    $output .= '<li><a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a></li>';
                }
                echo $output;
            }
        }
        elseif (is_archive()) {
            if ($blog) {
                echo "<li><a href='" . get_page_link($blog->ID) . "'>" . $blog->post_title . "</a></li>";
                echo $delimiter;
                $categories = get_the_category();
                foreach($categories as $category) {
                    $output .= '<li><a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a></li>';
                }
                echo $output;
            }
        }
        elseif (is_search()) {echo $current_before . "Search Results"; echo $current_after;}
        elseif (is_404()) {echo $current_before . "Page not Found"; echo $current_after;}
}


function the_title_trim($title) {
    $title = attribute_escape($title);
    $findthese = array(
        '#Protected:#',
        '#Private:#'
    );
    $replacewith = array(
        '', // What to replace "Protected:" with
        '' // What to replace "Private:" with
    );
    $title = preg_replace($findthese, $replacewith, $title);
    return $title;
}
add_filter('the_title', 'the_title_trim');

function unregister_default_wp_widgets() {
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    //unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Search');
    //unregister_widget('WP_Widget_Text');
    //unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Tag_Cloud');
}
add_action('widgets_init', 'unregister_default_wp_widgets', 1);

function unregister_default_wp_dashboard_widgets() {
    
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_browser_nag', 'dashboard', 'high' );
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
//    remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
    
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
    
}
add_action('wp_dashboard_setup', 'unregister_default_wp_dashboard_widgets' );


class  WalkerMainNav extends Walker_Page {
    /**
     * @see Walker::$tree_type
     * @since 2.1.0
     * @var string
     */
    var $tree_type = 'page';

    /**
     * @see Walker::$db_fields
     * @since 2.1.0
     * @todo Decouple this.
     * @var array
     */
    var $db_fields = array ('parent' => 'post_parent', 'id' => 'ID');

    /**
     * @see Walker::start_lvl()
     * @since 2.1.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
     */
    function start_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<span class=\"indicator\"></span><ul class=\"gradient\">\n";
    }

    /**
     * @see Walker::end_lvl()
     * @since 2.1.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
     */
    function end_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>";
    }

    /**
     * @see Walker::start_el()
     * @since 2.1.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $page Page data object.
     * @param int $depth Depth of page. Used for padding.
     * @param int $current_page Page ID.
     * @param array $args
     */
    function start_el(&$output, $page, $depth, $args, $current_page) {
        if ( $depth )
            $indent = str_repeat("\t", $depth);
        else
            $indent = '';

        extract($args, EXTR_SKIP);
        $css_class = array('page_item', 'page-item-'.$page->ID);
        if ( !empty($current_page) ) {
            $_current_page = get_page( $current_page );
            if ( isset($_current_page->ancestors) && in_array($page->ID, (array) $_current_page->ancestors) )
                $css_class[] = 'current_page_ancestor';
            if ( $page->ID == $current_page )
                $css_class[] = 'current_page_item';
            elseif ( $_current_page && $page->ID == $_current_page->post_parent )
                $css_class[] = 'current_page_parent';
        } elseif ( $page->ID == get_option('page_for_posts') ) {
            $css_class[] = 'current_page_parent';
        }

        $css_class = implode(' ', apply_filters('page_css_class', $css_class, $page));

        $page_navlabel = get_post_meta($page->ID, "page_navlabel", true);
        
        if (!$page_navlabel) {
            $page_navlabel = $page->post_title;
        }
        
        
        /*** Remove title attribute - they didn't like it displaying on hover ***/
        //$output .= $indent . '<li class="' . $css_class . '"><a href="' . get_page_link($page->ID) . '" title="' . esc_attr( wp_strip_all_tags( apply_filters( 'the_title', $page_navlabel, $page->ID ) ) ) . '">' . $link_before . apply_filters( 'the_title', $page->post_title, $page->ID ) . $link_after . '</a>';
        $output .= $indent . '<li class="' . $css_class . '"><a href="' . get_page_link($page->ID) . '">' . $link_before . apply_filters( 'the_title', $page_navlabel, $page->ID ) . $link_after . '</a>';


        if ( !empty($show_date) ) {
            if ( 'modified' == $show_date )
                $time = $page->post_modified;
            else
                $time = $page->post_date;

            $output .= " " . mysql2date($date_format, $time);
        }
    }

    /**
     * @see Walker::end_el()
     * @since 2.1.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $page Page data object. Not used.
     * @param int $depth Depth of page. Not Used.
     */
    function end_el(&$output, $page, $depth, $args) {
        $output .= "</li>\n";
    }

}

class  WalkerMainMobileNav extends Walker_Page {
    /**
     * @see Walker::$tree_type
     * @since 2.1.0
     * @var string
     */
    var $tree_type = 'page';

    /**
     * @see Walker::$db_fields
     * @since 2.1.0
     * @todo Decouple this.
     * @var array
     */
    var $db_fields = array ('parent' => 'post_parent', 'id' => 'ID');

    /**
     * @see Walker::start_lvl()
     * @since 2.1.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
     */
    function start_lvl(&$output, $depth, $args) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul>\n";
    }

    /**
     * @see Walker::end_lvl()
     * @since 2.1.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
     */
    function end_lvl(&$output, $depth, $args) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>";
    }

    /**
     * @see Walker::start_el()
     * @since 2.1.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $page Page data object.
     * @param int $depth Depth of page. Used for padding.
     * @param int $current_page Page ID.
     * @param array $args
     */
    function start_el(&$output, $page, $depth, $args, $current_page) {
        if ( $depth )
            $indent = str_repeat("\t", $depth);
        else
            $indent = '';

        extract($args, EXTR_SKIP);
        $css_class = array('page_item', 'page-item-'.$page->ID);
        if ( !empty($current_page) ) {
            $_current_page = get_page( $current_page );
            if ( isset($_current_page->ancestors) && in_array($page->ID, (array) $_current_page->ancestors) )
                $css_class[] = 'current_page_ancestor';
            if ( $page->ID == $current_page )
                $css_class[] = 'current_page_item';
            elseif ( $_current_page && $page->ID == $_current_page->post_parent )
                $css_class[] = 'current_page_parent';
        } elseif ( $page->ID == get_option('page_for_posts') ) {
            $css_class[] = 'current_page_parent';
        }

        $css_class = implode(' ', apply_filters('page_css_class', $css_class, $page));

        $page_navlabel = get_post_meta($page->ID, "page_navlabel", true);
        
        if (!$page_navlabel) {
            $page_navlabel = $page->post_title;
        }
        
        
        /*** Remove title attribute - they didn't like it displaying on hover ***/
        //$output .= $indent . '<li class="' . $css_class . '"><a href="' . get_page_link($page->ID) . '" title="' . esc_attr( wp_strip_all_tags( apply_filters( 'the_title', $page_navlabel, $page->ID ) ) ) . '">' . $link_before . apply_filters( 'the_title', $page->post_title, $page->ID ) . $link_after . '</a>';
        $output .= $indent . '<li class="' . $css_class . '"><a href="' . get_page_link($page->ID) . '">' . $link_before . apply_filters( 'the_title', $page_navlabel, $page->ID ) . $link_after . '</a>';


        if ( !empty($show_date) ) {
            if ( 'modified' == $show_date )
                $time = $page->post_modified;
            else
                $time = $page->post_date;

            $output .= " " . mysql2date($date_format, $time);
        }
    }

    /**
     * @see Walker::end_el()
     * @since 2.1.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $page Page data object. Not used.
     * @param int $depth Depth of page. Not Used.
     */
    function end_el(&$output, $page, $depth, $args) {
        $output .= "</li>\n";
    }

}

class  WalkerSidebarNav extends Walker_Page {
    /**
     * @see Walker::$tree_type
     * @since 2.1.0
     * @var string
     */
    var $tree_type = 'page';

    /**
     * @see Walker::$db_fields
     * @since 2.1.0
     * @todo Decouple this.
     * @var array
     */
    var $db_fields = array ('parent' => 'post_parent', 'id' => 'ID');

    /**
     * @see Walker::start_lvl()
     * @since 2.1.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
     */
    function start_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul>\n";
    }

    /**
     * @see Walker::end_lvl()
     * @since 2.1.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
     */
    function end_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    /**
     * @see Walker::start_el()
     * @since 2.1.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $page Page data object.
     * @param int $depth Depth of page. Used for padding.
     * @param int $current_page Page ID.
     * @param array $args
     */
    function start_el(&$output, $page, $depth, $args, $current_page) {
        if ( $depth )
            $indent = str_repeat("\t", $depth);
        else
            $indent = '';

        extract($args, EXTR_SKIP);
        $css_class = array('page_item', 'page-item-'.$page->ID);
        if ( !empty($current_page) ) {
            $_current_page = get_page( $current_page );
            if ( isset($_current_page->ancestors) && in_array($page->ID, (array) $_current_page->ancestors) )
                $css_class[] = 'current_page_ancestor';
            if ( $page->ID == $current_page )
                $css_class[] = 'current_page_item';
            elseif ( $_current_page && $page->ID == $_current_page->post_parent )
                $css_class[] = 'current_page_parent';
        } elseif ( $page->ID == get_option('page_for_posts') ) {
            $css_class[] = 'current_page_parent';
        }

        $css_class = implode(' ', apply_filters('page_css_class', $css_class, $page));

        $page_navlabel = get_post_meta($page->ID, "page_navlabel", true);
        
        if (!$page_navlabel) {
            $page_navlabel = $page->post_title;
        }
        
        $ppr_newwin = get_post_meta($page->ID, '_pprredirect_newwindow', true);
        if ($ppr_newwin && $ppr_newwin == "_blank") {
            $ppr_newwin = 'target="_blank"';
        } else {
            $ppr_newwin = 'target="_self"'; 
        }
        
        /*** Remove title attribute - they didn't like it displaying on hover ***/
        //$output .= $indent . '<li class="' . $css_class . '"><a href="' . get_page_link($page->ID) . '" title="' . esc_attr( wp_strip_all_tags( apply_filters( 'the_title', $page_navlabel, $page->ID ) ) ) . '">' . $link_before . apply_filters( 'the_title', $page->post_title, $page->ID ) . $link_after . '</a>';
        $output .= $indent . '<li class="' . $css_class . '"><a class="gradient" href="' . get_page_link($page->ID) . '"' . $ppr_newwin . '>' . $link_before . apply_filters( 'the_title', $page_navlabel, $page->ID ) . $link_after . '</a>';
        

        if ( !empty($show_date) ) {
            if ( 'modified' == $show_date )
                $time = $page->post_modified;
            else
                $time = $page->post_date;

            $output .= " " . mysql2date($date_format, $time);
        }
    }

    /**
     * @see Walker::end_el()
     * @since 2.1.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $page Page data object. Not used.
     * @param int $depth Depth of page. Not Used.
     */
    function end_el(&$output, $page, $depth) {
        $output .= "</li>\n";
    }

}

class Walker_Nav_Menu_Quick extends Walker_Nav_Menu {
    /**
     * @see Walker::$tree_type
     * @since 3.0.0
     * @var string
     */
    var $tree_type = array( 'post_type', 'taxonomy', 'custom' );

    /**
     * @see Walker::$db_fields
     * @since 3.0.0
     * @todo Decouple this.
     * @var array
     */
    var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

    /**
     * @see Walker::start_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
     */
    function start_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }

    /**
     * @see Walker::end_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
     */
    function end_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    /**
     * @see Walker::start_el()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param int $current_page Menu item ID.
     * @param object $args
     */
    function start_el(&$output, $item, $depth, $args) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a><span> | </span>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    /**
     * @see Walker::end_el()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Page data object. Not used.
     * @param int $depth Depth of page. Not Used.
     */
    function end_el(&$output, $item, $depth) {
        $output .= "</li>\n";
    }
}

function post_connections() {
    // Make sure the Posts 2 Posts plugin is active.
    if ( !function_exists( 'p2p_register_connection_type' ) )
        return;

    p2p_register_connection_type( array(
        'name' => 'pages_to_features',
        'from' => 'page',
        'to' => 'feature',
        'sortable' => 'to'
    ) );
    
    p2p_register_connection_type( array(
        'name' => 'pages_to_promos',
        'from' => 'page',
        'to' => 'promo',
        'sortable' => 'to'
    ) );

}
add_action( 'wp_loaded', 'post_connections' );

//Define the meta box with extra field for the navigation lavel
function page_admin_init() {
    add_meta_box("pageinfo-meta", "Page Options", "page_meta_options", "page", "normal");
    add_meta_box("pageinfo-meta", "Page Options", "page_meta_options", "post", "normal");
    add_meta_box("pageinfo-meta", "Page Options", "page_meta_options", "product", "normal");
} 
add_action("admin_init", "page_admin_init");

function page_meta_options() {
    if ( !has_action( 'admin_footer', 'wp_print_media_templates' ) ) {
        wp_enqueue_media();
    }
    
    global $post;
    $custom = get_post_custom($post->ID);
    
    $page_navlabel = $custom["page_navlabel"][0];
    $page_quote = $custom["page_quote"][0];
?>
    <p><label>Navigation Label: </label><br />
     <input name="page_navlabel" size="100" value="<?php echo $page_navlabel; ?>" /></p>
     
     <p><label>Page Quote (shows beside title - leave blank to hide): </label><br />
     <input name="page_quote" size="100" value="<?php echo $page_quote; ?>" /></p>
    
     <input type="hidden" name="page_save" value="1" />
    

<?php
}     

//Define the ability to save the custom fields in the database
function ns_save_page() {
    global $post;
    
    if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || !isset($_POST['page_save'])) {
        return $post->ID;
    }
    
    update_post_meta($post->ID, "page_navlabel", $_POST["page_navlabel"]);
    update_post_meta($post->ID, "page_banner", $_POST["page_banner"]);
    update_post_meta($post->ID, "page_quote", $_POST["page_quote"]);
}
add_action("save_post", "ns_save_page");


add_action( 'admin_menu', 'li_remove_menu_pages', 99 );
function li_remove_menu_pages() {
    $current_user = wp_get_current_user();
    if ($current_user->user_login != "encompass") {
        remove_menu_page('link-manager.php');
        remove_menu_page('tools.php'); 
//        remove_menu_page('plugins.php');     
        remove_menu_page('edit-comments.php');     
        remove_menu_page('wpseo_dashboard');
        remove_menu_page('wp-pagenavi-style/wp-pagenavi-style.php');
        remove_menu_page('redirect-options');
    }
}