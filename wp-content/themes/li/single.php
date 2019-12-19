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
                    <ul>
                        <li class="fb"><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li class="tw"><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li class="yt"><a href="#"><i class="fa fa-youtube"></i></a></li>
                    </ul>
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
                
                <?php get_sidebar('blog'); ?>
                
                <div class="clear"></div>
                
<!--                <?php include(get_template_directory() . "/_interior_buttons.php"); ?>-->
                
            </div>
        </div>
        <!-- end .main-content -->
    </div>
    <!-- end .site-main -->
    
<?php get_footer(); ?>