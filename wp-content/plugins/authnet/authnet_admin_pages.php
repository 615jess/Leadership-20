<?php

/*
 * Copyright 2010, Daniel Watrous, All rights reserved
 * By using this software you agree to be bound by the terms
 * outlined in the License.txt file included with the software.
 *
 * If you still have questions please send them to helpdesk@danielwatrous.com
 *
 */

// render the admin menu(s)

if (!function_exists('authnet_render_settings')) {
    /**
     * display the general settings page.
     */
     function authnet_render_settings() {
        global $wpdb, $user_level, $wp_rewrite, $wp_version;
		global $authnet_user_subscription_table_name, $authnet_subscription_table_name, $authnet_payment_table_name, $authnet_cancellation_table_name;
		include 'authnet_settings.php';
     }
}

if (!function_exists('authnet_render_subscriptions')) {
    /**
     * display the general subscriptions page.
     */
     function authnet_render_subscriptions() {
        global $wpdb, $user_level, $wp_rewrite, $wp_version, $log;
		global $authnet_user_subscription_table_name, $authnet_subscription_table_name, $authnet_payment_table_name, $authnet_cancellation_table_name;
		include 'authnet_subscriptions.php';
     }
}

if (!function_exists('authnet_render_usersubscriptions')) {
    /**
     * display the general user subscriptions page.
     */
     function authnet_render_usersubscriptions() {
        global $wpdb, $user_level, $wp_rewrite, $wp_version;
		global $authnet_user_subscription_table_name, $authnet_subscription_table_name, $authnet_payment_table_name, $authnet_cancellation_table_name;
		include 'authnet_usersubscriptions.php';
     }
}

if (!function_exists('authnet_render_surveybuilder')) {
    /**
     * display the general user subscriptions page.
     */
     function authnet_render_surveybuilder() {
        global $wpdb, $user_level, $wp_rewrite, $wp_version;
		global $authnet_user_subscription_table_name, $authnet_subscription_table_name, $authnet_payment_table_name, $authnet_cancellation_table_name;
		include 'authnet_surveybuilder.php';
     }
}

?>