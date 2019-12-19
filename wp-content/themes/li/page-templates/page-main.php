<?php 
/* Template Name: Home Page*/
get_header(); 
$settings = get_option("northstar_theme_settings");

$video_image_src =  "/scripts/timthumb.php?src=" . $settings["video_screen"] . "&h=240&w=380&zc=1";
?>

    <!-- start .site-main -->
    <div class="site-main"> 
        <!-- start .top-images -->
        <div class="top-images">  
             <?php
            $rotator_args = array(
                "numberposts" => -1,
                "orderby" => "menu_order",
                "order" => "ASC",
                "post_type" => "rotator"
            );
            $rotator_posts_array = get_posts($rotator_args);
            $counter = 1;
            foreach ($rotator_posts_array as $post) : setup_postdata($post);
                $image = get_post_meta($post->ID, "rotator_image", true);
                $link = get_post_meta($post->ID, "rotator_link", true); 
                $new_window = get_post_meta($post->ID, "rotator_new_window", true);
                if ($new_window == "true") {
                    $new_window = true;
                } else {
                    $new_window = false;
                }
                
                $image_width = 482;
                $image_height = 635;
                
                $image_src =  "/scripts/timthumb.php?src=" . $image . "&h=$image_height&w=$image_width&zc=1";
            ?>
            
            <!-- start .item -->
            <div class="item <?php if ($counter == 1): ?>blue<?php elseif ($counter == 2): ?>orange<?php elseif ($counter == 3): ?>brown<?php else: ?>yellow<?php endif; ?>">
                <!-- start .item-image -->
                <div class="item-image" data-image="<?php echo $image_src; ?>">
                </div>
                <!-- end .item-image -->
                <!--<div class="<?php if ($counter == 1): ?>blue<?php elseif ($counter == 2): ?>orange<?php elseif ($counter == 3): ?>brown<?php else: ?>yellow<?php endif; ?>"></div>-->
                <!-- start .item-disolve -->
                <div class="item-dissolve">
                    <img src="<?php bloginfo("template_directory"); ?>/images/top-image-dissolve-bg.png" alt="">
                </div>                
                <!-- end .item-disolve -->                
                <!-- start .item-title -->
                <div class="item-title">
                    <h3><?php the_title(); ?></h3>
                </div>
                <!-- end .item-title -->  
                <!-- start .item-overlay -->
                <div class="item-overlay">
                    <div class="caption">
                        <div class="caption-top">
                            <?php if ($counter == 1): ?>
                            <img src="<?php bloginfo("template_directory"); ?>/images/top-images-caption-blue-top-bg.png" alt="">
                            <?php elseif ($counter == 2): ?>
                            <img src="<?php bloginfo("template_directory"); ?>/images/top-images-caption-orange-top-bg.png" alt="">
                            <?php elseif ($counter == 3): ?>
                            <img src="<?php bloginfo("template_directory"); ?>/images/top-images-caption-brown-top-bg.png" alt="">
                            <?php else: ?>
                            <img src="<?php bloginfo("template_directory"); ?>/images/top-images-caption-yellow-top-bg.png" alt="">
                            <?php endif; ?>
                        </div>
                        <?php the_content(); ?>
                        <!--<a class="more" href="<?php echo $link; ?>" <?php if ($new_window): ?>target="_blank"<?php endif; ?>>Learn More <i class="fa fa-angle-double-right"></i></a>-->
                    </div>
                </div>
                <!-- end .item-overlay -->
            </div>
            <!-- end .image-item -->      
            <?php $counter++;  endforeach; wp_reset_query(); ?>                  
            
            <div class="clear"></div>            
        </div>
        <!-- end .top-images -->
        <!-- start .home-content -->
        <div class="home-content">
            <!-- start .home-top -->
            <div class="home-top">
                <div class="container">
                    <!-- start .video-wrapper -->
                    <div class="video-wrapper">
                        <!-- start .video -->
                        <div class="video">
                            <div class="left-shaddow"></div>
                            <div class="right-shaddow"></div>
                            <img src="<?php echo $video_image_src; ?>" />
                            <div class="overlay">
                                <a class="play video-cbox cboxElement" href="<?php echo $settings["video_embed"]; ?>"></a>
                            </div>   
                        </div>
                        <!-- end .video -->
                    </div>
                    <!-- end .video-wrapper -->
                    <!-- start .introduction -->
                    <div class="introduction">
                        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                                <h1><?php the_title(); ?></h1>
                                <?php the_content(''); ?>
                        <?php endwhile; wp_reset_query(); ?>
                      <!--  <a href="#">Learn More <i class="fa fa-angle-double-right"></i></a>-->
                    </div>
                    <!-- end .introduction -->
                    <div class="clear"></div>
                </div>   
            </div>
            <!-- end .home-top -->
            <!-- start .home-bottom -->
            <div class="home-bottom">
                <div class="container">
                    <!-- start .left-ct -->
                    <div class="left-ct">
                        <!-- start .social -->
                        <div class="social">
                        
                            <?php include(get_template_directory() . "/_social.php"); ?> 

                        </div>
                        <!-- end .social -->
                        <!-- start .buttons -->
                        <div class="buttons">
                            <ul>
                                <li>
                                    <a href="<?php echo $settings["partner_link"]; ?>">
                                        <img class="inactive" src="<?php bloginfo("template_directory"); ?>/images/home-partner-int.jpg" alt="">
                                        <img class="active" src="<?php bloginfo("template_directory"); ?>/images/home-partner-int-active.jpg" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $settings["serve_link"]; ?>">
                                        <img class="inactive" src="<?php bloginfo("template_directory"); ?>/images/home-serve-int.jpg" alt="">
                                        <img class="active" src="<?php bloginfo("template_directory"); ?>/images/home-serve-int-active.jpg" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $settings["give_link"]; ?>">
                                        <img class="inactive" src="<?php bloginfo("template_directory"); ?>/images/home-give-int.jpg" alt="">
                                        <img class="active" src="<?php bloginfo("template_directory"); ?>/images/home-give-int-active.jpg" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $settings["pray_link"]; ?>">
                                        <img class="inactive" src="<?php bloginfo("template_directory"); ?>/images/home-pray-int.jpg" alt="">
                                        <img class="active" src="<?php bloginfo("template_directory"); ?>/images/home-pray-int-active.jpg" alt="">
                                    </a>
                                </li>   
                            </ul>
                            <div class="clear"></div>
                        </div>
                        <!-- end .buttons -->
                        <div class="clear"></div>
                        <!-- start .featured-items -->
                        <div class="featured-items"> 
                        
                            <?php
                            $connected_features = new WP_Query(array(
                                'connected_type' => 'pages_to_features',
                                'connected_items' => get_queried_object(),
                                'nopaging' => true
                            ));
                            if ( $connected_features->have_posts() ) :  $connected_features_iterator = 0; while ( $connected_features->have_posts() ) : $connected_features->the_post(); global $post; 
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
                                <a href="<?php echo $link; ?>" <?php if ($new_window): ?>target="_blank"<?php endif; ?> title="<?php the_title_attribute(); ?>"><img src="<?php echo $src; ?>" alt="<?php the_title_attribute(); ?>"></a> 
                                <h3><?php the_title(); ?></h3>
                                <?php the_content(); ?>
                                <a class="more" href="<?php echo $link; ?>" <?php if ($new_window): ?>target="_blank"<?php endif; ?> title="<?php the_title_attribute(); ?>">Learn More <i class="fa fa-angle-double-right"></i></a>
                            </div>
                            <!-- end .item -->
                            <?php endwhile; endif; wp_reset_query(); ?>

                            <div class="clear"></div>
                        </div>
                        <!-- end .featured-items -->
                    </div> 
                    <!-- end .left-ct --> 
                    <!-- start .right-ct -->
                    <div class="right-ct">
                      
                        <div class="africa-bg">                         
                        <?php if ( is_active_sidebar( 'email-sub' ) ) : ?>
                        	<div id="emailsub" class="mailsub" role="complementary">
                        		<?php dynamic_sidebar( 'email-sub' ); ?>
                        	</div><!-- #primary-sidebar -->
                        <?php endif; ?>
                        </div>
  
                    </div> 
                    <!-- end .right-ct -->  
                    <div class="clear"></div>
                </div>  
            </div>
            <!-- end .home-bottom -->
            <div id="waybottom">
             	<div class="container">
            		<?php if ( is_active_sidebar( 'waybottom1' ) ) : ?>
            		<div id="wayb" role="complementary">
            		<?php dynamic_sidebar( 'waybottom1' ); ?>
            		</div>
           		 <?php endif; ?>
            	</div>
            </div>
            <!-- end .waybottom -->
        </div>
        <!-- end .home-content -->
    </div>
    <!-- end .site-main -->

<?php get_footer(); ?>