<?php $settings = get_option("northstar_theme_settings"); ?>
    <!-- start footer -->
    <footer class="site-footer" role="contentinfo">    
        <!-- div .footer-top -->
        <div class="footer-top">
            <div class="container">
                <!--start .affiliate -->
                <div class="affiliate">
                    
                    <ul>
                        <!--<li><a href="#"><img src="<?php bloginfo("template_directory"); ?>/images/logo-storysong.png" alt=""></a></li>
                        <li><a href="#"><img src="<?php bloginfo("template_directory"); ?>/images/logo-storysong.png" alt=""></a></li>-->
                        <!--<li><a href="http://www.ourstorysong.org/" target="_blank"><img src="<?php bloginfo("template_directory"); ?>/images/logo-storysong.png" alt=""></a></li>-->
                    </ul>
   
                </div>
                <!-- end .affiliate -->
            </div>            
        </div>
        <!-- div .footer-top -->
        <!-- start .footer-bottom -->
        <div class="footer-bottom">
            <!-- start.top-bg -->
            <div class="top-bg"></div>
            <!-- start.top-bg -->
            <!-- start .container -->
            <div class="container">
                <!-- start .logo -->
                <div class="logo">
                    <a href="/"><img src="<?php bloginfo("template_directory"); ?>/images/logo-footer.png" alt=""></a>
                </div>
                <!-- end .logo -->
                <!-- start .directions -->
                <div class="directions">
                    <aside class="direction">
                        <h3 class="direction-title">United States</h3>
                        <?php echo apply_filters('the_content', $settings['contact_section1']); ?>
                    </aside>
                    <aside class="direction">
                        <h3 class="direction-title">Africa</h3>
                        <?php echo apply_filters('the_content', $settings['contact_section2']); ?>
                    </aside>
                    <aside class="direction">
                        <h3 class="direction-title">Contact Us</h3>
                        <?php echo apply_filters('the_content', $settings['contact_section3']); ?>
                    </aside>
                </div>
                <!-- end .directions -->
                <!-- start .developer -->
                <div class="developer">
                    <a class="inactive" href="http://www.northstarmarketing.com/" target="_blank"><img src="<?php bloginfo("template_directory"); ?>/images/developer-logo.png" alt=""></a>
                    <a class="active" href="http://www.northstarmarketing.com/" target="_blank"><img src="<?php bloginfo("template_directory"); ?>/images/developer-logo-active.png" alt=""></a>
                </div>
                <!-- end .developer -->
                <div class="clear"></div>
                <!-- start .footer-info -->
                <div class="footer-info">                    
                    <ul>
                        <li>Leadership International is a tax-exempt charity under the IRS code section 501c3</li>
                        <li>|</li>
                        <li>&copy; <a href="javascript:void(0);"><?php echo date("Y"); ?> Leadership International</a></li>
                    </ul>
                </div>
                <!-- end .footer-info -->                 
            </div>
            <!-- end .container -->
        </div>
        <!-- end .footer-bottom -->
    </footer>
    <!-- end footer -->
    
</div>
<!-- end div #page -->         


<?php wp_footer(); ?>        
</body>
</html>