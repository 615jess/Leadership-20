<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9 lt-ie10"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10 ie9"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="author" content="<?php bloginfo("name"); ?>">
    <meta name="viewport" content="initial-scale=1, width=device-width, user-scalable=false;">
    <meta name="google-translate-customization" content="bb647619290f62ca-155aa1444fd86ff2-g414bc956cc792fda-17"></meta>
    
    <title><?php wp_title('|',true,'right'); ?> <?php bloginfo("name"); ?></title>

    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/styles.css" />
    <!-- CSS fancyBox -->
    <link href="<?php bloginfo( 'template_directory' ); ?>/css/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" />
    <!-- Font awesome -->
    <link href="<?php bloginfo( 'template_directory' ); ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    
    <!--[if lt IE 9]>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_directory' ); ?>/css/ie.css" />
    <![endif]-->

    <!--[if lt IE 9]>
    <script src="<?php bloginfo( 'template_directory' ); ?>/js/html5shiv.js"></script>
    <![endif]-->

    <!--[if gte IE 9]>
      <style type="text/css">
        .gradient {
           filter: none;
        }
      </style>
    <![endif]-->
    
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    
    <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
    <?php wp_head(); ?>
    
    <script src="<?php bloginfo( 'template_directory' ); ?>/js/modernizr-2.6.2.min.js"></script>
    <script src="<?php bloginfo( 'template_directory' ); ?>/js/main.js"></script>
    
     <?php if (is_front_page()) : ?>
     
    <script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/home.js" ></script> 
    
    <?php elseif (is_page() || is_archive()) : ?>
   
    <script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/page.js" ></script> 
    
    <?php endif; ?>
    
    <link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/ammap/ammap/ammap.css" type="text/css">  
    
    <script type="text/javascript">
    //Add IE10 class to html tag if IE10
    if(Function('/*@cc_on return document.documentMode===10@*/')()){
        document.documentElement.className+=' ie10';
    }
    </script>
</head>
<?php
    $settings = get_option("northstar_theme_settings");
?>

<body>
    
<!-- start div #page -->
<div id="page">

    <!-- start #mobile menu -->
    <div id="mobile-menu" class="mobile-menu hidden-desktop">
        <h3 class="title">MAIN MENU</h3>
        <div class="search hidden-tablet">
            <form role="search" action="/">                            
                <input type="text" placeholder="SEARCH" name="s" />
                <button type="submit"><i class="fa fa-search"></i></button>                            
            </form>
        </div>
        <nav class="mobile-menu-container" role="navigation">             
            <ul> 
                <li class=""><a href="/">Home</a></li>       
                <?php 
      
                $args = array(
                    'depth'        => 2,
                    'child_of'     => 0,
                    'include'      => '',
                    'title_li'     => '',
                    'echo'         => 1,
                    'link_before'  => '',
                    'link_after'   => '',
                    'walker' => new WalkerMainMobileNav() );

                wp_list_pages( $args ); 
          
                ?>            
            </ul>
        </nav>
    </div>
    <!-- end #mobile menu -->
    
    <!-- start header -->
    <header class="site-header" role="banner">  
        <!-- start .top-bar -->
        <div class="top-bar">
            <div class="container">
                <!-- start .lang -->
                <div class="lang">
                    <a class="change-lang" href="javascript:void(0);">CHANGE LANGUAGE</a>
                    <div id="google_translate_element" style="display:none;"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                </div>
                <!-- end .lang -->
                <div class="clear"></div>
            </div>
        </div>
        <!-- end .top-bar -->
        <!-- start .container -->
        <div class="container">
            <!-- start .main-menu -->
            <div class="main-menu">
                <!-- start .left-ct -->
                <div class="left-ct">
                    <!-- start .show-mobile-menu -->
                    <a href="javascript:void(0)" class="show-mobile-menu hidden-desktop"><i class="fa fa-bars"></i></a>
                    <!-- end .show-mobile-menu -->
                    <!-- start nav -->
                    <nav role="navigation" class="visible-desktop">
                        <ul>
                            <?php 
      
                            $args = array(
                                'depth'        => 2,
                                'child_of'     => 0,
                                'include'      => '',
                                'title_li'     => '',
                                'echo'         => 1,
                                'link_before'  => '',
                                'link_after'   => '',
                                'walker' => new WalkerMainNav() );

                            wp_list_pages( $args ); 
                      
                            ?>                                           
                        </ul>
                    </nav>
                    <!-- end nav -->
                    <div class="clear"></div>
                </div>
                <!-- end .left-ct -->
                <!-- start .right-ct -->
                <div class="right-ct">
                    <!-- start .search-form -->
                    <div class="search-form hidden-phone">
                        <a id="show-search" class="show-search" href="javascript:void(0)">Search<i class="fa fa-search"></i></a>
                        <form action="/" role="search">
                            <span class="indicator"></span>
                            <input class="field" type="text" name="s" value="" placeholder="SEARCH">
                            <input class="submit" type="submit" name="" value="SEARCH">
                        </form>
                    </div>
                    <!-- end .search-form -->
                    <!-- start nav -->
                    <nav role="navigation" class="visible-desktop main-nav2">
                        <ul>
                                                                        
                        </ul>
                    </nav>
                    <!-- end nav -->
                    <div class="clear"></div>
                </div>
                <!-- end .right-ct -->
            </div>
            <!-- end .main-menu -->  
            <!-- start .logo -->
            <div class="logo">
                <a href="/"><img src="<?php bloginfo("template_directory"); ?>/images/logo.png" alt=""></a>                
            </div>
            <!-- end .logo -->
            <!-- start .logo-shaddow -->
            <div class="logo-shaddow"></div>
            <!-- end .logo-shaddow -->             
        </div>
        <!-- end .container -->
        <!-- start .bottom-gradient -->
        <div class="bottom-gradient">
        </div>
        <!-- end .bottom-gradient -->
        <!-- start .bottom-bg -->
        <div class="bottom-bg">
        </div>
        <!-- end .bottom-bg -->        
    </header>
    <!-- end header -->