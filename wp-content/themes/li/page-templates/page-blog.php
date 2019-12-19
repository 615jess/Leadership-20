<?php 
/* Template Name: Blog/News */
get_header(); 
$settings = get_option("northstar_theme_settings");
?>

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
                    <?php endif; endwhile; wp_reset_query(); ?>
                    <!-- end .page-title -->                   
                    <!-- start .archives -->
                    <div class="archives">
                         <?php
                        global $wp_query;
                        //Get current page
                        $curr_page = 1;
                        if ($wp_query->query_vars['paged']) { 
                            $curr_page = $wp_query->query_vars['paged'];
                        }                                                            
                        
                        $args = array(
                            "posts_per_page" => 10,
                            "paged" => $curr_page        
                        );
                        query_posts($args); 
                        ?>    
                        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); global $more; $more = 0; ?>
                        <!-- start .entry-small -->
                        <div class="entry-small entry-blog">
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