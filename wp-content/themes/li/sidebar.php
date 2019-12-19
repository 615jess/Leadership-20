                <!-- start .left-ct -->
                <div class="left-ct gradient">                    
                    <!-- start .sidebar -->
                    <div class="sidebar">
                    <?php
                    global $post;
                    $parent = get_page($post->post_parent);
                    $args = array(
                                'depth'        => 1,
                                'child_of'     => $post->ID,
                                'include'      => '',
                                'title_li'     => '',
                                'echo'         => 0,
                                'link_before'  => '',
                                'link_after'   => '',
                                'walker' => new WalkerSidebarNav() );
                    $args2 = $args;
                    $args2["child_of"] = $parent->ID;

                     if (wp_list_pages( $args ) != '' || wp_list_pages( $args2 ) != '') :
                    ?>
                    <!-- start .widget -->
                    <aside class="widget">
                        <nav>
                            <ul>
                                <?php
                                if (wp_list_pages( $args ) != '') {
                                  echo wp_list_pages($args);
                                } else {
                                  echo wp_list_pages($args2);
                                }
                                ?>
                            </ul>
                        </nav>
                    </aside>
                    <!-- end .widget -->
                    <?php endif; wp_reset_query();?>
                    </div>
                    <!-- end .sidebar -->
                    
                    <?php
                    $connected_features = new WP_Query(array(
                        'connected_type' => 'pages_to_features',
                        'connected_items' => get_queried_object(),
                        'nopaging' => true
                    ));
                    if ( $connected_features->have_posts() ) :  
                    ?>
                   <div class="featured-items"> 
                    <?php
                    $connected_features_iterator = 0; while ( $connected_features->have_posts() ) : $connected_features->the_post(); global $post; 
                        $image = get_post_meta($post->ID, "feature_image", true);   
                        $link = get_post_meta($post->ID, "feature_link", true); 
                        $new_window = get_post_meta($post->ID, "feature_new_window", true);
                        if ($new_window == "true") {
                            $new_window = true;
                        } else {
                            $new_window = false;
                        }
                        
                        $image_width = 209;
                        $image_height = 114;
                        $src = "/scripts/timthumb.php?src=" . $image . "&w=$image_width&h=$image_height&zc=1";
                    ?>
                        <!-- start .item -->
                        <div class="item">                        
                            <a href="<?php echo $link; ?>" <?php if ($new_window): ?>target="_blank"<?php endif; ?> title="<?php the_title_attribute(); ?>"><img src="<?php echo $src; ?>" alt=""></a> 
                            <h3><?php the_title(); ?></h3>
                            <?php the_content(); ?>
                            <a class="more" href="<?php echo $link; ?>" <?php if ($new_window): ?>target="_blank"<?php endif; ?> title="<?php the_title_attribute(); ?>">Learn More <i class="fa fa-angle-double-right"></i></a>
                        </div>
                        <!-- end .item -->
                    <?php endwhile;  ?>
                    </div>
                    <!-- end .featured-items -->
                    <?php endif; wp_reset_query();  ?>
                    
                </div>
                <!-- end .left-ct -->