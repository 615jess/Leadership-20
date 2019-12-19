<?php

/*
 * Copyright 2010, Daniel Watrous, All rights reserved
 * By using this software you agree to be bound by the terms
 * outlined in the License.txt file included with the software.
 *
 * If you still have questions please send them to helpdesk@danielwatrous.com
 *
 */

require('../../../wp-blog-header.php');
require_once('../../../wp-includes/registration.php');
require_once('../../../wp-admin/includes/user.php');
require('authnet_globals.php');
include("authnet_wishlist.php");

// get access to database object
global $wpdb;

require_once('KLogger.php');
$logging_level = KLogger::DEBUG;
$logging_filename = dirname(__FILE__)."/authnet_log.php";
$log = new KLogger ($logging_filename , $logging_level);

// x_type: void, auth_capture, 
// x_auth_code
// x_email
// x_MD5_Hash (requires authnet_silentposthash, authnet_apikey, x_trans_id, (x_auth_code != void) ? x_amount:0.00)
// x_subscription_id
// x_subscription_paynum

$log->LogDebug("SILENT POST: \$_POST contains -- ".print_r($_POST, true));

if (!isset($_POST['x_subscription_id']) || $_POST['x_subscription_id'] == "") {
	$log->LogDebug("SILENT POST: Nothing to do. Not a recurring billing post");
	exit;
}

// log key values for this request
$x_type 				= isset($_POST['x_type']) ? $wpdb->escape($_POST['x_type']):"";
$x_auth_code 			= isset($_POST['x_auth_code']) ? $wpdb->escape($_POST['x_auth_code']):"";
$x_email 				= isset($_POST['x_email']) ? $wpdb->escape($_POST['x_email']):"";
$x_MD5_Hash 			= isset($_POST['x_MD5_Hash']) ? $wpdb->escape($_POST['x_MD5_Hash']):"";
$x_subscription_id 		= isset($_POST['x_subscription_id']) ? $wpdb->escape($_POST['x_subscription_id']):"";
$x_subscription_paynum 	= isset($_POST['x_subscription_paynum']) ? $wpdb->escape($_POST['x_subscription_paynum']):"";
$x_trans_id 			= isset($_POST['x_trans_id']) ? $wpdb->escape($_POST['x_trans_id']):"";
$x_amount			 	= isset($_POST['x_amount']) ? $wpdb->escape($_POST['x_amount']):"0.00";
$x_method			 	= isset($_POST['x_method']) ? $wpdb->escape($_POST['x_method']):"";
$x_first_name			= isset($_POST['x_first_name']) ? $wpdb->escape($_POST['x_first_name']):"";
$x_last_name		 	= isset($_POST['x_last_name']) ? $wpdb->escape($_POST['x_last_name']):"";

// load authnet values from options
global $authnet_apikey;
$authnet_md5hashvalue = get_option('authnet_silentposthash');	// corresponds to MD5_hash_value for MD5 hash

// validate request by producing hash and comparing
$verifyhash = md5 ($authnet_md5hashvalue.$x_trans_id.$x_amount);
if (strtoupper($verifyhash) != strtoupper($x_MD5_Hash)) {
	$log->LogError ("SILENT POST: MD5 hash value=".$authnet_md5hashvalue);
	$log->LogError ("SILENT POST: Failed to verify MD5 hash with: ".$verifyhash);
	die();
}

// create WordPress user record or load existing user record
// for silent post creation should never happen. The only case is if the administrator had deleted the user for some reason
global $newuser;
$newuser = false;
$user_id = email_exists ($x_email);
if ( !$user_id ) {
	// set global newuser flag
	$newuser = true;
	// sort out password
	if (isset($_POST['desiredPassword']) && $_POST['desiredPassword'] != '') $password = $wpdb->escape($_POST['desiredPassword']);
	else $password = wp_generate_password( 8, false );
	// sort out username
	$i=1;
	if (isset($_POST['desiredUsername']) && $_POST['desiredUsername'] != '') {
		$username = $_POST['desiredUsername'];
	} else $username = $x_email;
	// make sure username is unique
	while (username_exists($username))
		$username = $username . $i++;
	$log->LogInfo ("SILENT POST: Created user with username: [".$username."] password: [".$password."] email: [".$x_email."]");
	$user_id = wp_create_user($username, $password, $x_email );
	update_user_meta( $user_id, 'first_name', $_POST['billingFirstName']);
	update_user_meta( $user_id, 'last_name', $_POST['billingLastName']);
} else $log->LogInfo ("Found user with user_id: ".$user_id);

if (!is_numeric($user_id)) {
	$log->LogError ("SILENT POST: user_id contains: ".$user_id->get_error_message());
	die();
}

// query for ID of parent subscription record
$user_subscription_query = $wpdb->prepare("SELECT ID, subscription_id FROM " . $authnet_user_subscription_table_name . " where user_id = $user_id and xSubscriptionId = $x_subscription_id");
$log->LogDebug ("SILENT POST: user_subscription_query: ".$user_subscription_query);
$user_subscription = $wpdb->get_row($user_subscription_query);
// create payment record for this transaction
$user_payment_insert = $wpdb->prepare("INSERT INTO " . $authnet_payment_table_name . " SET user_subscription_id = ".$user_subscription->ID.",
		xAuthCode = '{$x_auth_code}',
		xTransId= '{$x_trans_id}',
		xAmount = {$x_amount},
		xMethod = '{$x_method}',
		xType = '{$x_type}',
		paymentDate = '".date('Y-m-d H:i:s')."',
		fullAuthorizeNetResponse = '".print_r($_POST, true)."',
		xSubscriptionId = '{$x_subscription_id}',
		xSubscriptionPaynum = '{$x_subscription_paynum}'");
$log->LogDebug ("SILENT POST: user_payment_insert: ".$user_payment_insert);
$results = $wpdb->query($user_payment_insert);
if ($results === false) {
	$log->LogError ("SILENT POST: wpdb query failed for payment record");
	die();
}
// query for ID of parent subscription record
$subscription_query = $wpdb->prepare("SELECT * FROM " . $authnet_subscription_table_name . " where ID = {$user_subscription->subscription_id}");
$subscription = $wpdb->get_row($subscription_query);

// if memberwing callback present, create/update member account in memberwing
$mw_payment_notify_url = get_option('authnet_memberwingcallback');
if ($mw_payment_notify_url && $mw_payment_notify_url != '') {
	// determine memberwing event type
	$event_type = "authnet";
	if ($x_subscription_id != '') $event_type .= "_recurring";

	$mw_payment_values = array(
							'event_type' => $event_type,
							'first_name' => $x_first_name,
							'last_name' => $x_last_name,
							'email' => $x_email,
							'payment_amount' => $x_amount,
							'xSubscriptionId' => $x_subscription_id,
							'xAuthCode' => $x_auth_code,
							'txn_id' => $x_trans_id,
							'payment_currency' => 'USD');
	// update item_name based on type of call
	$mw_payment_values['item_name'] = $subscription->name;

	$get_string = "";
	foreach( $mw_payment_values as $key => $value ) { $get_string .= "$key=" . urlencode( $value ) . "&"; }
	$get_string = rtrim( $get_string, "& " );
	// This call should look like: http://localhost/wordpress-2.8/wp-content/plugins/membership-site-memberwing/extensions/authorize.net/ipn.php?event_type=subscr_signup&item_name=choicesoftwarezone_com%20Gold%20Membership&customer_first_name=John&customer_last_name=Doe&customer_email=dwmaillist@gmail.com&payment_amount=0&payment_currency=USD&desired_username=dwmaillist@gmail.com&desired_password=c07dfbea&verify_hash=c077a44b9afedacc1ac1ceff4f90643c
	$mw_payment_notify_call = $mw_payment_notify_url."?".$get_string;
	$log->LogInfo ("SILENT POST: Called to setup memberwing account using ".$mw_payment_notify_call);
	$handle = fopen($mw_payment_notify_call, "r");
	fclose($handle);
}

// if memberwing callback present, create/update member account in memberwing
$authnet_processwishlist = get_option('authnet_processwishlist');
if ($authnet_processwishlist && $authnet_processwishlist == 'on') {
	$log->LogDebug("************ BEGIN PROCESSING ************");

	// get wishlist member level details
	$levels = WLMAPI::GetOption("wpm_levels");
	$wishlistLevelName = $levels[$subscription->wishlistLevel];
	
	// Expectation: input is POST request
	// extract and condition values
	$product_sku = $subscription->wishlistLevel;
	$log->LogDebug("product_sku=".$product_sku);
	$transaction_id = $x_trans_id;
	$subscription_id = $x_subscription_id;

	// build out generic URL and secret key values
	// the post URL
	$genericurl = get_bloginfo ('wpurl') . "/index.php/register/";
	$postURL = $genericurl . WLMAPI::GetOption("genericthankyou");
	$log->LogDebug("postURL = ".$postURL);

	// the Secret Key
	global $secretKey;
	$secretKey = WLMAPI::GetOption("genericsecret");

	// begin processing
	$log->LogDebug("preprocessing_success=".$processing_success);
	$log->LogDebug("***** process wishlist membership *****");
	// create WordPress user record or load existing user record
	$user_id = email_exists ($x_email);
	$data = array ();
	if ( $user_id ) {
		$log->LogInfo ("Found user with user_id: ".$user_id);
		// add user levels to existing user
		$data['transaction_id'] = $x_trans_id;
		$processing_success = addUserLevels ($user_id, array($product_sku), $data['transaction_id']);
	} else {
		// prepare the data
		$data['cmd'] = 'CREATE';
		$data['transaction_id'] = $x_trans_id;
		$data['lastname'] = $x_first_name;
		$data['firstname'] = $x_last_name;
		$data['email'] = $x_email;
		$data['level'] = $product_sku;

		// generate the hash
		$hash = generateHash ($data, $secretKey);

		// include the hash to the data to be sent
		$data['hash'] = $hash;
		$log->LogDebug("\$data array = ".implode("|",$data ));			

		// send data to post URL
		$returnValue = postCURLRequest ($postURL, $data);

		// process return value
		list ($cmd, $url) = explode ("\n", $returnValue);
		$log->LogDebug("cmd: ".$cmd);
		$log->LogDebug("url: ".$url);

		// check if the returned command is the same as what we passed
		if ($cmd != 'CREATE') {
			$log->LogError($x_type." transaction | failed to successfully use GENERIC integration with WishList");
			$processing_success = false;
		}
	}

	$log->LogDebug("processing_success=".$processing_success);

	// send email notification to user
	if ($processing_success) {
		$to = $x_email;
		$subject = "Transaction details for ".get_bloginfo('name')." ID: ".$transaction_id;
		$message = "A transaction has been successfully processed for your account.\n\n";
		$message .= "This was a ".$x_type." transaction.\n";
		if ($x_type == 'onetime') $message .= "In order to complete this transaction please visit this URL\n".$url."\n\n";
		$message .= "You may login to your account for further details:\n".get_bloginfo('url')."\n\n";
		$message .= "Sincerely,\nThe management";
		$headers = 'From: '.get_bloginfo('admin_email'). "\r\n" .
				   'Reply-To: '.get_bloginfo('admin_email'). "\r\n" .
				   'X-Mailer: PHP/' . phpversion();
		mail ($to, $subject, $message, $headers);
	}
	$log->LogDebug("************ END PROCESSING ************");
}

exit;

?>