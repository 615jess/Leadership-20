<?php $settings = get_option("northstar_theme_settings"); ?>
                <!-- start .buttons -->
                <div class="buttons">
                    <ul>
                        <li>
                            <a href="<?php echo $settings["partner_link"]; ?>">
                                <img class="inactive" src="<?php bloginfo("template_directory"); ?>/images/partner-int.jpg" alt="">
                                <img class="active" src="<?php bloginfo("template_directory"); ?>/images/partner-int-active.jpg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $settings["serve_link"]; ?>">
                                <img class="inactive" src="<?php bloginfo("template_directory"); ?>/images/serve-int.jpg" alt="">
                                <img class="active" src="<?php bloginfo("template_directory"); ?>/images/serve-int-active.jpg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $settings["give_link"]; ?>">
                                <img class="inactive" src="<?php bloginfo("template_directory"); ?>/images/give-int.jpg" alt="">
                                <img class="active" src="<?php bloginfo("template_directory"); ?>/images/give-int-active.jpg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $settings["pray_link"]; ?>">
                                <img class="inactive" src="<?php bloginfo("template_directory"); ?>/images/pray-int.jpg" alt="">
                                <img class="active" src="<?php bloginfo("template_directory"); ?>/images/pray-int-active.jpg" alt="">
                            </a>
                        </li>   
                    </ul>
                </div>
                <!-- end .buttons -->