<?php 
/* Template Name: Blog/News */
get_header(); 
$settings = get_option("northstar_theme_settings");
?>

    <!-- start .site-main -->
    <div class="site-main interior">         
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
                <!-- start .item-disolve -->
                <div class="item-dissolve">
                    <img src="<?php bloginfo("template_directory"); ?>/images/top-image-dissolve-bg.png" alt="">
                </div>                
                <!-- end .item-disolve -->                
                <!-- start .item-overlay -->
                <div class="item-overlay">
                </div>
                <!-- end .item-overlay -->
            </div>
            <!-- end .image-item -->      
            <?php $counter++;  endforeach; wp_reset_query(); ?>                  
            
            <div class="clear"></div>            
        </div>
        <!-- end .top-images -->
        <!-- start .main-top -->
        <div class="main-top">
            <div class="container">
                <!-- start .breadcrumps -->
                <div class="breadcrumps">
                    <div class="container">
                        <ul>
                            <?php the_breadcrumb(); ?>
                        </ul> 
                        <div class="clear"></div>
                    </div>              
                </div>
                <!-- end .breadcrumps -->
                <!-- start .social -->
                <div class="social">
                    
                    <?php include(get_template_directory() . "/_social.php"); ?>
                    
                </div>
                <!-- end .social -->
                <div class="clear"></div>
            </div>
        </div>
        <!-- end .main-top -->   
        <!-- start .main-content -->
        <div class="main-content gradient">
            <div class="container">  
                <!-- start .right-ct -->
                <div class="right-ct">
                    <?php $custom = get_post_custom(get_blog_page()->ID); ?>  
                    <!-- start .page-title -->
                    <?php if ($custom['page_quote'][0]): ?>
                    <div class="page-title with-quote">
                        <div class="page-heading">
                            <h1>
                                <?php /* If this is a category archive */ if (is_category()) { ?>
                                Posts in <?php single_cat_title(); ?>
                                <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
                                Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;
                                <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
                                Archive for <?php the_time('F jS, Y'); ?>
                                <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
                                Archive for <?php the_time('F, Y'); ?>
                                <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
                                Archive for <?php the_time('Y'); ?>
                                <?php /* If this is an author archive */ } elseif (is_author()) { ?>
                                Author Archive
                                <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                                Blog Archives
                                <?php } ?>
                            </h1>
                        </div>                        
                        <div class="page-quote">
                            <?php echo apply_filters('the_content', $custom['page_quote'][0]); ?>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="page-title">
                        <h1><?php the_title(); ?></h1>
                    </div>
                    <?php endif; ?>
                    <!-- end .page-title -->                   
                    <!-- start .archives -->
                    <div class="archives">
                        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); global $more; $more = 0; ?>
                        <!-- start .entry-small -->
                        <div class="entry-small">
                            <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                            <?php the_content(''); ?>
                        </div>
                        <!-- end .entry-small -->
                        <?php endwhile;  ?>
                        
                    </div>
                    <!-- end .archives -->
                    
                    <!-- start .pager -->
                    <?php wp_pagenavi(); wp_reset_query(); ?>
                    <!-- end .pager -->
                </div>
                <!-- end .right-ct -->

                <?php get_sidebar('blog'); ?>
                                
                <div class="clear"></div>
               
                <?php include(get_template_directory() . "/_buttons.php"); ?>
                
            </div>
        </div>
        <!-- end .main-content -->
    </div>
    <!-- end .site-main -->
    
<?php get_footer(); ?>