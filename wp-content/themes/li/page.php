<?php get_header(); ?>

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
                    <!-- end .page-title -->
                    <!-- start .entry -->
                    <div class="entry">
                        <div class="wysiwyg">
                            <?php the_content(''); ?>
                        </div>
                    </div>
                    <!-- end .entry -->
                    
                    <?php endwhile; wp_reset_query(); ?> 
                </div>
                <!-- end .right-ct -->
                
                <?php get_sidebar(); ?>
                
                <div class="clear"></div>
                
                <!-- start .buttons -->
                <div class="buttons">
                
                    <?php include(get_template_directory() . "/_buttons.php"); ?>
                    
                </div>
                <!-- end .buttons -->
                
            </div>
        </div>
        <!-- end .main-content -->
    </div>
    <!-- end .site-main -->
    
<?php get_footer(); ?>