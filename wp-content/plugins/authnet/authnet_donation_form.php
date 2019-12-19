<?php

/*
 * Copyright 2010, Daniel Watrous, All rights reserved
 * By using this software you agree to be bound by the terms
 * outlined in the License.txt file included with the software.
 *
 * If you still have questions please send them to helpdesk@danielwatrous.com
 *
 */

if ('authnet_donation_form.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('<h2>Direct File Access Prohibited</h2>');

// build checkout process action url
$url_checkout = get_bloginfo ('wpurl').'/'.get_option('authnet_checkoutpage');
// update to use https based on option setting
if (get_option('authnet_usessl'))
	$url_checkout = preg_replace('|^http://|', 'https://', $url_checkout);

$donation_term = get_option('authnet_donationterm');

$jshash = get_bloginfo ('wpurl') . preg_replace ('#^.*[/\\\\](.*?)[/\\\\].*?$#', "/wp-content/plugins/$1/javascript/md5-min.js", __FILE__);
$donationjs = get_bloginfo ('wpurl') . preg_replace ('#^.*[/\\\\](.*?)[/\\\\].*?$#', "/wp-content/plugins/$1/javascript/donation.js", __FILE__);
$stylesheet = get_bloginfo ('wpurl') . preg_replace ('#^.*[/\\\\](.*?)[/\\\\].*?$#', "/wp-content/plugins/$1/style.css", __FILE__);

$donationform = <<<AUTHNETDONATION
<script type="text/javascript" src="{$jshash}"></script>
<script type="text/javascript" src="{$donationjs}"></script> 

<link rel="stylesheet" type="text/css" media="all" href="{$stylesheet}" /> 

<form id="donationform" onsubmit="gotocheckout(); return false;">
<fieldset>
	<legend>Please enter a {$donation_term} amount</legend>
	<label>amount $</label>	<input name="amount" type="text"><br />
	<label>Make recurring</label>	<input type="checkbox" name="recurring"><br />
	<label>Recurring period</label>	<select name="recurring_period"><option value="monthly">Monthly</option><option value="quarterly">Quarterly</option></select> *only applies if you check recurring above
	<input type="hidden" name="posturl" value="{$url_checkout}">
	<input type="hidden" name="subscription" value="single">
	<input type="hidden" name="article_id" value="0">
	<input type="hidden" name="postname" value="donation"><br />
	<label>&nbsp;</label>		<input value="Complete {$donation_term}" type="submit"><br />
</fieldset>
</form>
AUTHNETDONATION;


?>
