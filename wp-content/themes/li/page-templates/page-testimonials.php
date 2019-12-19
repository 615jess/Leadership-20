<?php /* Template Name: Testimonials*/
get_header(); ?>

    <!-- start .site-main -->
    <div class="site-main interior">         
        
         <?php include(get_template_directory() . "/_interior_rotators.php"); ?>
        
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
                    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); global $post; $custom = get_post_custom($post->ID); ?>  
                    <!-- start .page-title -->
                    <?php if ($custom['page_quote'][0]): ?>
                    <div class="page-title with-quote">
                        <div class="page-heading">
                            <h1><?php the_title(); ?></h1>    
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
                     <?php endwhile; wp_reset_query(); ?> 
                    <!-- end .page-title -->
                    <?php
                        $args = array(
                            "numberposts" => -1,
                            "orderby" => "menu_order",
                            "order" => "ASC",
                            "post_type" => "testimonial"
                        );
                        $testimonials = get_posts($args);
                        $num_testimonials = count($testimonials);
                        $half_testimonials = ceil($num_testimonials  / 2);
                        $counter = 0;
                    ?>
                    <div class="testimonials">
                        <!-- start .left-ct -->
                        <div class="left-ct">
                            <?php for ($counter; $counter < $half_testimonials; $counter++): $custom = get_post_custom($testimonials[$counter]->ID);  ?>
                            <!-- start .testimonial -->
                            <div class="testimonial <?php if ($counter % 2 == 0): ?>brown<?php else: ?>orange<?php endif; ?>">
                                <h2><?php echo $testimonials[$counter]->post_content; ?></h2>
                                <p class="author"><?php echo strtoupper($custom['testimonial_attribution'][0]); ?></p>          
                            </div>
                            <!-- end .testimonial -->
                            <?php endfor; ?>
                            <!-- start .testimonial -->
                        </div>
                        <!-- end .left-ct -->
                        <!-- start .right-ct -->
                        <div class="right-ct">                            
                            <?php for ($counter; $counter < $num_testimonials; $counter++): $custom = get_post_custom($testimonials[$counter]->ID);  ?>
                            <!-- start .testimonial -->
                            <div class="testimonial <?php if ($counter % 2 == 0): ?>orange<?php else: ?>brown<?php endif; ?>">
                                <h2><?php echo $testimonials[$counter]->post_content; ?></h2>
                                <p class="author"><?php echo strtoupper($custom['testimonial_attribution'][0]); ?></p>          
                            </div>
                            <!-- end .testimonial -->
                            <?php endfor; ?>
                            <!-- start .testimonial -->
                        </div>
                        <!-- end .right-ct -->
                        <div class="clear"></div>
                    </div>
                    
                   
                </div>
                <!-- end .right-ct -->
                
                <?php get_sidebar(); ?>
                
                <div class="clear"></div>
                
                <?php include(get_template_directory() . "/_buttons.php"); ?>
                
            </div>
        </div>
        <!-- end .main-content -->
    </div>
    <!-- end .site-main -->
    
<?php get_footer(); ?>