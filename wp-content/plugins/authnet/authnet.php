<?php

/*
 * Plugin Name:   Authorize.net plugin for WordPress
 * Version:       1.3.0
 * Plugin URI:    http://www.danielwatrous.com/authorizenet-for-wordpress
 * Description:   Authorize.net processing integration for WordPress to be used with membership site plugins and as an online donation mechanism. Supports both one time and recurring billing and combinations of the two.
 * Author:        Daniel Watrous
 * Author URI:    http://www.danielwatrous.com
 */

/*
 * Copyright 2010, Daniel Watrous, All rights reserved
 * By using this software you agree to be bound by the terms
 * outlined in the License.txt file included with the software.
 *
 * If you still have questions please send them to helpdesk@danielwatrous.com
 *
 */


require_once('KLogger.php');
global $log, $logging_level, $logging_filename;
$logging_level = KLogger::DEBUG;
$logging_filename = dirname(__FILE__)."/authnet_log.php";
$log = new KLogger ($logging_filename , $logging_level);

// get access to database object
global $wpdb;

require_once('authnet_admin_pages.php');
require_once('authnet_form_functions.php');
require_once('authnet_functions.php');
require_once('authnet_globals.php');

// Make it work with WordPress before version 2.6
if (!defined('WP_CONTENT_URL')) {
   define('WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
}

// Add the link to the settings page in the settings sub-header
function authnet_menu_setup() {
   global $wpdb, $authnet_table;

   add_options_page('Authorize.net for WordPress Settings', 'Authorize.net', 10, __FILE__, 'authnet_menu');

   // Handle database and post updates here
}

//===========================================================================
function authnet_admin_menu () {
	//add_meta_box('authnet_singlepost_link', 'Authorize.net Post Buy Now Link', "authnet_singlepost_link", "post", "normal", "high");
	add_menu_page    (
		'Authorize.net for WordPress Settings',		// Page Title
		'<div align="center" style="font-size:90%;">Authorize.net</div>',	// Menu Title - lower corner of admin menu
		'administrator',							// Capability
		'authnet_settings.php',						// handle
		'authnet_render_settings',					// Function
		get_bloginfo ('wpurl') . preg_replace ('#^.*[/\\\\](.*?)[/\\\\].*?$#', "/wp-content/plugins/$1/images/authnet-admin-icon.png", __FILE__)	// Icon URL
	);
	add_submenu_page (
		'authnet_settings.php',						// Parent
		'Authorize.net for WordPress Settings',		// Page Title
		'General Settings',							// Menu Title
		'administrator',							// Capability
		basename('authnet_settings.php'),			// Handle - First submenu's handle must be equal to parent's handle to avoid duplicate menu entry.
		'authnet_render_settings'					// Function
	);
	add_submenu_page (
		'authnet_settings.php',						// Parent
		'Authorize.net Subscription Management',	// Page Title
		'Subscriptions',							// Menu Title
		'administrator',							// Capability
		basename('authnet_subscriptions.php'),		// Handle - Second submenu's handle must be equal to parent's handle to avoid duplicate menu entry.
		'authnet_render_subscriptions'				// Function
	);
	add_submenu_page (
		'authnet_settings.php',						// Parent
		'Authorize.net User Subscription Management',	// Page Title
		'User Subscriptions',						// Menu Title
		'administrator',							// Capability
		basename('authnet_render_usersubscriptions'),	// Handle - Third submenu's handle must be equal to parent's handle to avoid duplicate menu entry.
		'authnet_render_usersubscriptions'			// Function
	);
	add_submenu_page (
		'authnet_settings.php',				// Parent
		'Authorize.net Survey Builder',				// Page Title
		'Survey Builder',							// Menu Title
		'administrator',							// Capability
		basename('authnet_render_surveybuilder'),	// Handle - Fourth submenu's handle must be equal to parent's handle to avoid duplicate menu entry.
		'authnet_render_surveybuilder'			// Function
	);
}

// Add hooks

// Add the settings page
add_action('admin_menu', 'authnet_admin_menu');

////////////////////////////////////////////
/* INSTALL UNINSTALL */
/* activations */
register_activation_hook(__FILE__,'authnet_install');
/*deactivation*/
register_deactivation_hook( __FILE__, 'authnet_deactivate' );

if (!function_exists('authnet_install')) {
    /**
     * installation routine to set up tables
     */
    function authnet_install() {
        global $wpdb, $user_level, $wp_rewrite, $wp_version, $log;
		global $authnet_user_subscription_table_name, $authnet_subscription_table_name, $authnet_payment_table_name, $authnet_cancellation_table_name;
		$log->LogInfo("Activating/Installing plugin");
        include 'authnet_install.php';
    }
}

if (!function_exists('authnet_deactivate')) {
	/**
	 * mostly handled by uninstall - this just resets the cron
	 */
	function authnet_deactivate() {
        global $wpdb, $log;
		$log->LogInfo("Deactivating plugin");
	}
}

// Display a meta box when people try to edit a single post...
/*function authnet_singlepost_link() {
   global $post;

   $variable = get_post_meta($post->ID, 'myplugin_variable', true);
   ?>
   <a href="<?php echo getSubscriptionLink (1); ?>"><?php echo getSubscriptionLink (1); ?></a>

   <?php
}*/


//////////////////////////////////////////
/*  Short Code for checkout page */

function authnetcheckoout_filter($atts) {
	global $wpdb, $log, $authnet_subscription_table_name;
	// validate and process request for checkout form
	$claim_valid = false;
	if (isset($_GET['subscription']) && isset($_GET['claim'])) {
		$subscription = $_GET['subscription'];
		$claim = $_GET['claim'];

		// check for return values
		$billingFirstName = isset($_GET['billingFirstName']) ? $_GET['billingFirstName']:'';
		$billingLastName = isset($_GET['billingLastName']) ? $_GET['billingLastName']:'';
		$email = isset($_GET['email']) ? $_GET['email']:'';
		$billingAddress = isset($_GET['billingAddress']) ? $_GET['billingAddress']:'';
		$billingCity = isset($_GET['billingCity']) ? $_GET['billingCity']:'';
		$billingState = isset($_GET['billingState']) ? $_GET['billingState']:'';
		$billingZip = isset($_GET['billingZip']) ? $_GET['billingZip']:'';
		$billingCountry = isset($_GET['billingCountry']) ? $_GET['billingCountry']:'';
		$billingPhone = isset($_GET['billingPhone']) ? $_GET['billingPhone']:'';
		$desiredUsername = isset($_GET['desiredUsername']) ? $_GET['desiredUsername']:'';
		$desiredPassword = isset($_GET['desiredPassword']) ? $_GET['desiredPassword']:'';
		$subscriptionNotes = isset($_GET['subscriptionNotes']) ? $_GET['subscriptionNotes']:'';

		// first case is an integer subscription_id
		if (is_numeric($_GET['subscription'])) {
			// validate the subscription claim
			$claim_valid = createCheckoutClaim($_GET['subscription'], get_option('authnet_securityseed')) == $_GET['claim'];
			// prepare values needed for form to render
			$amount = "";
			$postname = "";
			$subscription_details = $wpdb->get_row("SELECT * FROM $authnet_subscription_table_name WHERE ID = ".intval($_GET['subscription']));

		// second case is a donation
		} else if (isset($_GET['amount']) && isset($_GET['postname']) && $_GET['postname']=='donation') {
			// validate the single post purchase claim
			$claim_valid =  md5($_GET['amount'].$_GET['postname']) == $_GET['claim'];
			// prepare values needed for form to render
			$amount = $_GET['amount'];
			$article_id = $_GET['article_id'];
			$postname = $_GET['postname'];
			$recurring = (isset($_GET['recurring'])) ? $_GET['recurring']:null;
			// manually set recurring details
			if ($recurring) {
				$subscription_details = $wpdb->get_row("SELECT * FROM $authnet_subscription_table_name WHERE ID = 1");
				// change processing parameters to recurring
				$subscription_details->processSinglePayment = 0;
				$subscription_details->processRecurringPayment = 1;
				// manually set recurring values
				$subscription_details->name = "Recurring ".get_option('authnet_donationterm');
				$subscription_details->initialDescription = "";
				if ($_GET['recurring_period'] == "monthly") $subscription_details->recurringIntervalLength = '1';
				elseif ($_GET['recurring_period'] == "quarterly") $subscription_details->recurringIntervalLength = '3';
				$subscription_details->recurringIntervalUnit = 'months';
				$subscription_details->recurringTotalOccurrences = '9999';
				$subscription_details->recurringTrialOccurrences = '0';
				$subscription_details->recurringAmount = $amount;
				$subscription_details->recurringTrialAmount = '0';
			} else {
				$subscription_details = null;
			}

		// third case is a single post purchase
		} else if (isset($_GET['amount']) && isset($_GET['postname'])) {
			// validate the single post purchase claim
			$claim_valid = createCheckoutClaim($_GET['amount'].$_GET['postname'], get_option('authnet_securityseed')) == $_GET['claim'];
			// prepare values needed for form to render
			$amount = $_GET['amount'];
			$article_id = $_GET['article_id'];
			$postname = $_GET['postname'];
			$subscription_details = null;
		}

		// finally, if I have a valid claim then display the checkout form, else error message
		if ($claim_valid) {
			// show message if available
			if (isset($_GET['message'])) $error_message = $_GET['message'];
			else $error_message = "";
			include_once('authnet_checkout_form.php');
			// customize checkout form
			if ($subscription_details != null) {
				$checkoutform = str_replace ("SUBSCRIPTION_NAME", $subscription_details->name, $checkoutform);
				$checkoutform = str_replace ("SUBSCRIPTION_DESC", $wpdb->escape($subscription_details->initialDescription), $checkoutform);
				$duration = ((intval($subscription_details->recurringTotalOccurrences)==9999) ? 'ongoing':'for '.intval($subscription_details->recurringTotalOccurrences).' payments');
				$recurring = ($subscription_details->recurringAmount == 0) ? "":"$".$subscription_details->recurringAmount." every ".$subscription_details->recurringIntervalLength." ".$subscription_details->recurringIntervalUnit." ".$duration;
				if ($subscription_details->recurringAmount == 0) {
					$pricing = "One time payment of $".$subscription_details->initialAmount;
				} else {
					if ($subscription_details->initialAmount == 0) $pricing = $recurring;
					else $pricing .= "Initial payment of $".$subscription_details->initialAmount.' and recurring payments of '.$recurring;
				}
				if ($subscription_details->recurringTrialOccurrences > 0 && $subscription_details->recurringConcealTrial != 1) {
					$trial_pricing = "<br />Including ".$subscription_details->recurringTrialOccurrences." trial payments of $".$subscription_details->recurringTrialAmount." up front";
					$pricing .= $trial_pricing;
				}
				$checkoutform = str_replace ("SUBSCRIPTION_PRICING", $pricing, $checkoutform);
			} else {
				if ($postname == 'donation') $checkoutform = str_replace ("SUBSCRIPTION_NAME", get_option('authnet_donationterm'), $checkoutform);
				else  $checkoutform = str_replace ("SUBSCRIPTION_NAME", $postname, $checkoutform);
				$checkoutform = str_replace ("SUBSCRIPTION_DESC", "", $checkoutform);
				$checkoutform = str_replace ("SUBSCRIPTION_PRICING", "One time payment of $".$amount, $checkoutform);
			}
			if (get_option('authnet_include_userinfo') == 'on') $checkoutform = str_replace ("USERINFORMATION", $userinfo_form, $checkoutform);
			else $checkoutform = str_replace ("USERINFORMATION", '', $checkoutform);
			if (get_option('authnet_include_usernotes') == 'on') $checkoutform = str_replace ("USERNOTES", $usernotes_form, $checkoutform);
			else $checkoutform = str_replace ("USERNOTES", '', $checkoutform);
			if ($subscription_details->survey != '') $checkoutform = str_replace ("SURVEY", renderSurvey($subscription_details->survey), $checkoutform);
			elseif (get_option('authnet_donationsurvey') != '') $checkoutform = str_replace ("SURVEY", renderSurvey(get_option('authnet_donationsurvey')), $checkoutform);
			else $checkoutform = str_replace ("SURVEY", '', $checkoutform);
			// return checkout form
			return $stylesheet.$checkoutform;
		} else return '<b>Invalid checkout details.  Please press your back button and try again.</b>';
	} else return '<b>Insufficient checkout details.  Please press your back button and try again.</b>';
}

add_shortcode('authnetco', 'authnetcheckoout_filter');

function authnet_donation_filter ($atts) {
	global $wpdb, $log;
	// get base values
	include_once('authnet_donation_form.php');
	
	return $donationform;
}

add_shortcode('authnetdonation', 'authnet_donation_filter');

?>