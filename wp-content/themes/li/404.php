<?php 
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
                <!-- start .full-ct -->
                <div class="full-ct">
                    <div class="page-title">
                        <h1>Page not Found</h1>
                    </div>
                    <!-- end .page-title -->
                    <!-- start .full-page -->
                    <div class="full-page">
                        <div class="wysiwyg">
                            <p>We're sorry, but the page you requested could not be found. Try searching or use the main links above.</p>
                        </div>
                    </div>
                    <!-- end .full-page -->
                </div>
                 <!-- end .full-ct -->
                
                <div class="clear"></div>
                
                 <?php include(get_template_directory() . "/_buttons.php"); ?>
                
            </div>
        </div>
        <!-- end .main-content -->
    </div>
    <!-- end .site-main -->

<?php get_footer(); ?>