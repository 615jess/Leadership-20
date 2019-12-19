<?php

/*
 * Copyright 2010, Daniel Watrous, All rights reserved
 * By using this software you agree to be bound by the terms
 * outlined in the License.txt file included with the software.
 *
 * If you still have questions please send them to helpdesk@danielwatrous.com
 *
 */

if ('authnet_install.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('<h2>Direct File Access Prohibited</h2>');

if (file_exists(ABSPATH . 'wp-admin/includes/upgrade.php')) {
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
} else {
	require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
}

$authnet_user_subscription_table = <<<TABLEDEF
CREATE TABLE  `TABLENAME` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `user_id` bigint unsigned NOT NULL,
  `subscription_id` int(10) unsigned NULL,
  `billingFirstName` varchar(255) NOT NULL,
  `billingLastName` varchar(255) NOT NULL,
  `billingCompany` varchar(255) NOT NULL,
  `billingAddress` varchar(255) NOT NULL,
  `billingCity` varchar(255) NOT NULL,
  `billingState` varchar(255) NOT NULL,
  `billingZip` varchar(45) NOT NULL,
  `billingCountry` varchar(255) NOT NULL default 'United States',
  `billingPhone` varchar(45) NOT NULL,
  `shippingFirstName` varchar(255) NULL,
  `shippingLastName` varchar(255) NULL,
  `shippingCompany` varchar(255) NULL,
  `shippingAddress` varchar(255) NULL,
  `shippingCity` varchar(255) NULL,
  `shippingState` varchar(255) NULL,
  `shippingZip` varchar(45) NULL,
  `shippingCountry` varchar(255) NULL default 'United States',
  `shippingPhone` varchar(45) NULL,
  `emailAddress` varchar(255) NOT NULL,
  `xSubscriptionId` varchar(255) NULL,
  `lastFourDigitsOfCreditCard` char(4) NULL,
  `startDate` datetime NULL,
  `MWXAccountLinked` datetime NULL,
  `isRecurring` int(10) NULL,
  `endRecurringDate` datetime NULL,
  `subscriptionNotes` TEXT NULL,
  PRIMARY KEY  USING BTREE (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 COMMENT='this table corresponds to user in wordpress';
TABLEDEF;

$authnet_payment_table = <<<TABLEDEF
CREATE TABLE  `TABLENAME` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `user_subscription_id` bigint unsigned NOT NULL,
  `xAuthCode` varchar(255) NOT NULL,
  `xTransId` varchar(255) NOT NULL,
  `xAmount` decimal(10,2) NOT NULL,
  `xMethod` varchar(255) NOT NULL,
  `xType` varchar(255) NOT NULL,
  `xSubscriptionId` varchar(255) NULL,
  `xSubscriptionPaynum` int(10) NULL,
  `paymentDate` datetime NOT NULL,
  `fullAuthorizeNetResponse` blob NULL,
  PRIMARY KEY  USING BTREE (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 COMMENT='payment table is child to user_subscription';
TABLEDEF;

$authnet_cancellation_table = <<<TABLEDEF
CREATE TABLE  `TABLENAME` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `user_subscription_id` bigint unsigned NOT NULL,
  `refId` varchar(255) NOT NULL,
  `reason` blob NULL,
  `xSubscriptionId` int(10) NOT NULL,
  `cancellationDate` datetime NOT NULL,
  `fullAuthorizeNetResponse` blob NOT NULL,
  PRIMARY KEY  USING BTREE (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 COMMENT='cancellation table is child to user_subscription';
TABLEDEF;

$authnet_subscription_table = <<<TABLEDEF
CREATE TABLE  `TABLENAME` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `processSinglePayment` int(10) unsigned NOT NULL ,
  `processRecurringPayment` int(10) unsigned NOT NULL ,
  `name` varchar(255) NOT NULL,
  `initialAmount` decimal(10,2) NULL,
  `initialDescription` varchar(255) NULL,
  `initialInvoiceNum` varchar(255) NULL,
  `recurringRefId` varchar(255) NULL,
  `recurringIntervalLength` int(10) unsigned NULL ,
  `recurringIntervalUnit` varchar(255) NULL,
  `recurringTotalOccurrences` int(10) unsigned NULL ,
  `recurringTrialOccurrences` int(10) unsigned NULL ,
  `recurringConcealTrial` int(10) unsigned NULL ,
  `recurringAmount` decimal(10,2) NULL,
  `recurringTrialAmount` decimal(10,2) NULL,
  `wishlistLevel` varchar(255) NOT NULL,
  PRIMARY KEY  USING BTREE (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 COMMENT='this table defines a template for subscription processing';
TABLEDEF;

$tables_creation_array = array($authnet_user_subscription_table_name => $authnet_user_subscription_table,
$authnet_subscription_table_name => $authnet_subscription_table,
$authnet_payment_table_name => $authnet_payment_table,
$authnet_cancellation_table_name => $authnet_cancellation_table);

// create all tables
foreach ($tables_creation_array as $table_name => $table_create_definition) {
	// First check to see if the table is already here...
	$log->LogInfo("Creating table: " . $table_name);
	if ($wpdb->get_var("SHOW TABLES LIKE '" . $table_name . "'") != $table_name) {
		$sql = str_replace ("TABLENAME", $table_name, $table_create_definition);
		$log->LogDebug($sql);
		dbDelta($sql);

		if ($table_name == $authnet_subscription_table_name) {
			// create template in subscription for single post purchase functionality
			$log->LogInfo("Creating initial subscription record for single purchases in " . $table_name);
			$safeProcessSinglePayment = intval(1);	// true
			$safeProcessRecurringPayment = intval(0);	// false
			$safeName = $wpdb->escape("Single Post Purchase Template");
			$safeInitialAmount = "0.00";
			$safeInitialDescription = $wpdb->escape("DO NOT EDIT: Single Post Purchase Template");

			$insert = "INSERT INTO " . $authnet_subscription_table_name . " SET ID = 1, processSinglePayment = $safeProcessSinglePayment, processRecurringPayment = $safeProcessRecurringPayment, name = '$safeName', initialAmount = '$safeInitialAmount', initialDescription = '$safeInitialDescription'";
			$results = $wpdb->query($insert);
		}
	} else $log->LogInfo("Table: " . $table_name . " already exists");
}
// check for subscriptionNotes field
$subscription_notes_col_present = "SHOW COLUMNS FROM `" . $authnet_user_subscription_table_name . "` LIKE 'subscriptionNotes'";
$subscription_notes_alter = 'ALTER TABLE `'.$authnet_user_subscription_table_name.'` ADD subscriptionNotes TEXT NULL';
if ($wpdb->get_var($subscription_notes_col_present) == null) {
	// add the field to the database
	$results = $wpdb->query($subscription_notes_alter);
	if ($results !== false) $log->LogInfo("added subscriptionNotes field to ".$authnet_user_subscription_table_name);
	else $log->LogError("Failed to add subscriptionNotes field to ".$authnet_user_subscription_table_name);
}
// check for recurringConcealTrial field
$recurring_conceal_trial_col_present = "SHOW COLUMNS FROM `" . $authnet_subscription_table_name . "` LIKE 'recurringConcealTrial'";
$recurring_conceal_trial_alter = 'ALTER TABLE `'.$authnet_subscription_table_name.'` ADD recurringConcealTrial int(10) unsigned NULL';
if ($wpdb->get_var($recurring_conceal_trial_col_present) == null) {
	// add the field to the database
	$results = $wpdb->query($recurring_conceal_trial_alter);
	if ($results !== false) $log->LogInfo("added recurringConcealTrial field to ".$authnet_subscription_table_name);
	else $log->LogError("Failed to add recurringConcealTrial field to ".$authnet_subscription_table_name);
}
// check for phone fields and add if necessary
$billing_phone_col_present = "SHOW COLUMNS FROM `" . $authnet_user_subscription_table_name . "` LIKE 'billingPhone'";
$billing_phone_alter = 'ALTER TABLE `'.$authnet_user_subscription_table_name.'` ADD billingPhone varchar(45) NULL';
if ($wpdb->get_var($billing_phone_col_present) == null) {
	// add the field to the database
	$results = $wpdb->query($billing_phone_alter);
	if ($results !== false) $log->LogInfo("added billingPhone field to ".$authnet_user_subscription_table_name);
	else $log->LogError("Failed to add billingPhone field to ".$authnet_user_subscription_table_name);
}
$shipping_phone_col_present = "SHOW COLUMNS FROM `" . $authnet_user_subscription_table_name . "` LIKE 'shippingPhone'";
$shipping_phone_alter = 'ALTER TABLE `'.$authnet_user_subscription_table_name.'` ADD shippingPhone varchar(45) NULL';
if ($wpdb->get_var($shipping_phone_col_present) == null) {
	// add the field to the database
	$results = $wpdb->query($shipping_phone_alter);
	if ($results !== false) $log->LogInfo("added shippingPhone field to ".$authnet_user_subscription_table_name);
	else $log->LogError("Failed to add shippingPhone field to ".$authnet_user_subscription_table_name);
}
// check for wlm fields in subscription table and add if necessary
$wishlist_level_col_present = "SHOW COLUMNS FROM `" . $authnet_subscription_table_name . "` LIKE 'wishlistLevel'";
$wishlist_level_alter = 'ALTER TABLE `'.$authnet_subscription_table_name.'` ADD wishlistLevel varchar(255) NULL default ""';
if ($wpdb->get_var($wishlist_level_col_present) == null) {
	// add the field to the database
	$results = $wpdb->query($wishlist_level_alter);
	if ($results !== false) $log->LogInfo("added wishlistLevel field to ".$authnet_subscription_table_name);
	else $log->LogError("Failed to add wishlistLevel field to ".$authnet_subscription_table_name);
}
// check for survey field in subscription table and add if necessary
$wishlist_level_col_present = "SHOW COLUMNS FROM `" . $authnet_subscription_table_name . "` LIKE 'survey'";
$wishlist_level_alter = 'ALTER TABLE `'.$authnet_subscription_table_name.'` ADD survey varchar(255) NULL default ""';
if ($wpdb->get_var($wishlist_level_col_present) == null) {
	// add the field to the database
	$results = $wpdb->query($wishlist_level_alter);
	if ($results !== false) $log->LogInfo("added survey field to ".$authnet_subscription_table_name);
	else $log->LogError("Failed to add survey field to ".$authnet_subscription_table_name);
}

// create security seed
if (!get_option('authnet_securityseed')) add_option('authnet_securityseed', makeSecuritySeed(), '');
if (!get_option('authnet_usessl')) add_option('authnet_usessl', 'on', '');

// create new page for checkout
$checkoutpage_name = "checkout";
add_option('authnet_checkoutpage', $checkoutpage_name, '');
$log->LogDebug ("Page: " . $checkoutpage_name . " ready for creation/update");
$the_page = get_page_by_title( $checkoutpage_name );

if ( ! $the_page ) {
	$log->LogInfo ("Creating Page: " . $checkoutpage_name);
	// Create post object
	$_p = array();
	$_p['post_title'] = $checkoutpage_name;
	$_p['post_content'] = "[authnetco]";
	$_p['post_status'] = 'publish';
	$_p['post_type'] = 'page';
	$_p['comment_status'] = 'closed';
	$_p['ping_status'] = 'closed';
	$_p['post_category'] = array(1); // the default 'Uncatrgorised'

	// Insert the post into the database
	$the_page_id = wp_insert_post( $_p );

	// create the option indicating page name
	if (!get_option('authnet_checkoutpage')) add_option('authnet_checkoutpage', $checkoutpage_name, '');
} else {
	$log->LogInfo ("Updating Page: " . $checkoutpage_name);

	// the plugin may have been previously active and the page may just be trashed...
	$the_page_id = $the_page->ID;

	//make sure the page is not trashed...
	$the_page->post_status = 'publish';
	$the_page_id = wp_update_post( $the_page );

}


?>