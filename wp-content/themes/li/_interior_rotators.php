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