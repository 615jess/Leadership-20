                <!-- start .left-ct -->
                <div class="left-ct gradient">                    
                    <!-- start .sidebar -->
                    <div class="sidebar">
                        <!-- start .widget -->
                        <aside class="widget">
                            <h3 class="widget-title">Topics</h3>
                            <ul>
                                <?php
                                    $categories = get_categories(array(
                                        
                                    ));
                                    foreach ($categories as $category) :
                                ?>
                                <li><a href="<?php echo get_category_link($category->term_id); ?>" class="gradient"><?php echo $category->name; ?> (<?php echo $category->category_count; ?>)</a></li>
                                <?php endforeach ; ?>
                            </ul>
                        </aside>
                        <!-- end .widget -->
                        <!-- start .widget -->
                        <aside class="widget">
                            <h3 class="widget-title">Archive</h3>
                            <ul>
                                <?php
                                $how_many = 36;
                                $archive = $wpdb->get_results("SELECT YEAR(post_date) AS 'year', MONTH(post_date) AS 'month', count(ID) as posts FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC LIMIT $how_many");
                                global $wp_locale;
                                foreach($archive as $month) :
                                ?>
                                <li><a href="<?php echo get_month_link($month->year, $month->month); ?>" class="gradient"><?php echo sprintf(__('%1$s %2$d'), $wp_locale->get_month($month->month), $month->year); ?> (<?php echo $month->posts; ?>)</a></li>
                                <?php endforeach; ?>
                            </ul>
                        </aside>
                        <!-- end .widget -->
                    </div>
                    <!-- end .sidebar -->
                </div>
                <!-- end .left-ct -->