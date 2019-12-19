<?php

/*
 * Copyright 2010, Daniel Watrous, All rights reserved
 * By using this software you agree to be bound by the terms
 * outlined in the License.txt file included with the software.
 *
 * If you still have questions please send them to helpdesk@danielwatrous.com
 *
 */

if ('authnet_settings.php' == basename($_SERVER['SCRIPT_FILENAME']))
     die ('<h2>'.__('Direct File Access Prohibited','authnet').'</h2>');

include('style.css');

$silentposturl = get_bloginfo ('wpurl') . preg_replace ('#^.*[/\\\\](.*?)[/\\\\].*?$#', "/wp-content/plugins/$1/authnet_silentpost.php", __FILE__);
$surveys = json_decode(get_option("authnet_surveys"));

?>

	<div class="wrap" style="width: 700px;">
		<h2>Authorize.net for WordPress Settings</h2>
		<?php
			if(isset($_GET['updated']) && $_GET['updated'] == 'true') {
				echo '<div class="updated"><p><strong>Settings Updated</strong></p></div>';
			}
		?>
		<p>This plugin provides integration with Authorize.net and can be used to process payments for membership software such as MemberWing. It can also be used as a donation engine for your website. The values required below can be found in your authorize.net account.</p>
		
		<p>This plugin was created by <a href="http://www.danielwatrous.com">Daniel Watrous</a>.</p>

		<p>AIM = Advanced Integration Method<br>ARB = Automated Recurring Billing</p>

		<form method="post" action="options.php">
		<?php wp_nonce_field('update-options'); ?>
		<input type="hidden" name="action" value="update" />

		<?php
		/* You need to add each field in this area (separated by commas) that you want to update
		   every time you click "Save"
		 */
		?>
		<input type="hidden" name="page_options" value="authnet_transactionkey,authnet_apikey,authnet_aimposturl,authnet_arbhost,authnet_arbpath,authnet_checkoutpage,authnet_securityseed,authnet_adminemail,authnet_memberwingcallback,authnet_thankyoupage,authnet_usessl,authnet_include_usernotes,authnet_include_userinfo,authnet_require_phone,authnet_processwishlist,authnet_silentposthash,authnet_donationterm,authnet_donationsurvey" />

		<!-- ****************************************************** -->
		<h3>General settings</h3>

		<fieldset>
		<legend>Authorize.net Details</legend>
			<label for="authnet_transactionkey">Transaction Key: </label>
				<?php authnet_textbox("authnet_transactionkey", '', 40); ?>

			<label for="authnet_apikey">API Key: </label>
				<?php authnet_textbox("authnet_apikey", '', 35); ?>

			<label for="authnet_aimposturl">AIM Post URL: </label>
				<?php authnet_textbox("authnet_aimposturl", 'https://secure.authorize.net/gateway/transact.dll', 50); ?>

			<label for="authnet_arbhost">ARB Host: </label>
				<?php authnet_textbox("authnet_arbhost", 'api.authorize.net', 40); ?>

			<label for="authnet_arbpath">ARB Path: </label>
				<?php authnet_textbox("authnet_arbpath", '/xml/v1/request.api', 40); ?>
			<label for="authnet_securityseed">Security seed: </label>
				<?php authnet_textbox("authnet_securityseed", '', 50); ?>
				<small>This is a random value that is used to secure the checkout process.  If you change this you must update all buy now links.</small>
			<label for="authnet_silentposturl">Silent Post URL: </label>
				<input type="text" id="authnet_silentposturl" size="50" value="<?php echo $silentposturl; ?>" onclick="select()" readonly />
				<small>Provide this value to Authorize.net for automatic updates of recurring transactions.</small>
			<label for="authnet_silentposthash">Silent Post MD5 Hash: </label>
				<?php authnet_textbox("authnet_silentposthash", '', 40); ?>
				<small>This corresponds to the MD5 value you set in your authorize.net account.</small>
		</fieldset>

		<fieldset>
		<legend>Checkout options</legend>
			<label for="authnet_usessl">USE SSL: </label>
				<?php authnet_checkbox("authnet_usessl", ''); ?>
				<small>This is for testing only.  If you uncheck this you assume all responsibility for lost or stolen financial data that results from orders on your site.</small>
			<label for="authnet_checkoutpage">Checkout Page: </label>
				<?php authnet_textbox("authnet_checkoutpage", ''); ?>
				<small>This must be an existing WordPress page that contains the shortcode "[authnetco]"</small>
			<label for="authnet_thankyoupage">Thank You Page: </label>
				<?php authnet_textbox("authnet_thankyoupage", 'thankyou'); ?>
				<small>This is a page in WordPress and contains a thank you message directing the customer to check email.</small>
			<label for="authnet_donationterm">Donation Term: </label>
				<?php authnet_textbox("authnet_donationterm", 'Donation'); ?>
				<small>This is shown on the donation form and checkout page. If you use the donation feature but for something other than donations (like payments) changing this can be more clear for your customers.</small>
			<label for="authnet_donationsurvey">Donation Survey: </label>
				<select id="authnet_donationsurvey" name="authnet_donationsurvey" tabindex="3">
				<option value="">-- Choose Level --</option>
			<?php 
			if ($surveys != NULL && count($surveys)>0){
			foreach ($surveys as $survey) { ?>
				<option value="<?php echo $survey->surveyName; ?>" <?php if (get_option('authnet_donationsurvey') == $survey->surveyName) echo "selected"; ?>><?php echo $survey->surveyName; ?></option>
			<?php }}?>
				</select><br />
				<small>This survey will be collected for all donations.</small>
			<label for="authnet_include_userinfo">Ask for username/password: </label>
				<?php authnet_checkbox("authnet_include_userinfo", ''); ?>
				<small>Enable this to ask the user for a username and password at checkout. Useful for integration with membership websites.</small>
			<label for="authnet_include_usernotes">Ask for comments: </label>
				<?php authnet_checkbox("authnet_include_usernotes", ''); ?>
				<small>Enable this to provide the user with a comment box at checkout. Helpful to gather donation designations.</small>
			<label for="authnet_require_phone">Require phone number: </label>
				<?php authnet_checkbox("authnet_require_phone", ''); ?>
				<small>Require the user to provide a phone number at checkout. If unchecked, this field will be optional.</small>
		</fieldset>

		<fieldset>
		<legend>Donation options</legend>
			<label for="authnet_usessl">Donation shortcode: </label>
				<input type="text" readonly value="[authnetdonation]" onclick="select()" />
				<small>Copy the shortcode from this field and place it in any WordPress page to display a donation form.</small>
		</fieldset>

		<fieldset>
		<legend>MemberWing options</legend>
			<label for="authnet_memberwingcallback">MemberWing callback URL: </label>
				<?php authnet_textbox("authnet_memberwingcallback", '', 45); ?>
				<small>Get this in your MemberWing settings to automate account mangement with payments.</small>
		</fieldset>

		<fieldset>
		<legend>WishList options</legend>
			<?php if (is_plugin_active('wishlist-member/wpm.php')) { //plugin is activated ?>
			<label for="authnet_processwishlist">Process WishList Transactions: </label>
				<?php authnet_checkbox("authnet_processwishlist", ''); ?>
				<small>Check this option to process memberships on each transaction.</small>
			<label >Generic Secret: </label>
				<input type="text" size="30" value="<?php echo WLMAPI::GetOption("genericsecret"); ?>" onclick="select()" readonly><br />
			<label >Generic Register/Thank you: </label>
				<input type="text" size="60" value="<?php echo $genericurl . WLMAPI::GetOption("genericthankyou"); ?>" onclick="select()" readonly><br />
			<p><strong>Membership Level names and SKUs</strong></p>
			<?php foreach (WLMAPI::GetOption("wpm_levels") as $sku => $membership_level) { ?>
			<label ><?php echo $membership_level["name"]; ?> <i>level</i>: </label>
				<input id="pwc_wishlist_callbackurl" type="text" size="20" value="<?php echo (isset($membership_level["wpm_newid"])) ? $membership_level["wpm_newid"]:$sku; ?>" onclick="select()" readonly><br />
			<?php } ?>
			<?php } else { ?>
			<b>WishList Member Not Installed</b>
			<?php } ?>
		</fieldset>

		<fieldset>
		<legend>Administrator options</legend>
			<label for="authnet_adminemail">Admin email address: </label>
				<?php authnet_textbox("authnet_adminemail", '', 45); ?>
				<small>This is for notifications about new sign ups, etc.</small>
		</fieldset>


		<p><input type="submit" class="button" value="Update Settings" style="font-weight: bold;" /></p>
		</form>

		<form method="post">
		<fieldset>
		<legend>Compatibility Test</legend>
      <ul>
          <li>
              <label>PHP Version:</label>
              <?php if (PHP_VERSION >= 5): ?>
              <code><?php echo PHP_VERSION; ?></code>
              <?php else: ?>
              <code style="color:red"><?php echo PHP_VERSION; ?></code>;
              <?php endif; ?>
              <span class="hint">(PHP5 is required)</span>
          </li>
  
          <li>
              <label>Web Server:</label>
              <?php if (stristr($_SERVER['SERVER_SOFTWARE'], 'apache') !== false): ?>
              <code>Apache</code>
              <?php elseif (stristr($_SERVER['SERVER_SOFTWARE'], 'LiteSpeed') !== false): ?>
              <code>Lite Speed</code>
              <?php elseif (stristr($_SERVER['SERVER_SOFTWARE'], 'nginx') !== false): ?>
              <code>nginx</code>
              <?php elseif (stristr($_SERVER['SERVER_SOFTWARE'], 'lighttpd') !== false): ?>
              <code>lighttpd</code>
              <?php elseif (stristr($_SERVER['SERVER_SOFTWARE'], 'iis') !== false): ?>
              <code>Microsoft IIS</code>
              <?php else: ?>
              <code>Not detected</code>
              <?php endif; ?>
          </li>
  
          <li>
              <label>cURL extension:</label>
              <?php if (function_exists('curl_init')): ?>
              <code>Installed</code>
              <?php else: ?>
              <code style="color:red">Not installed</code>
              <?php endif; ?>
              <span class="hint">(required)</span>
          </li>
          <li>
          		<a name="compatbility"></a>
          		<label>Mail function:</label>
              <?php
								if($_POST['emailtest'] == 'yes') {
									$to      = 'dwmaillist@gmail.com';
									$subject = 'Authorize.net Email Test';
									$message = 'Congratulations. Your email was successfully sent by the Authorize.Net for WordPress plugin.';
									$headers = 'From: ' . get_option( 'admin_email' ) . "\r\n" .
										'Reply-To: ' . get_option( 'admin_email' ) . "\r\n" .
										'X-Mailer: PHP/' . phpversion();

									if( mail($to, $subject, $message, $headers) ){
							?>
									<code>Test Successful</code>
							<?php
									}
									else{
							?>
									<code style="color:red">Test Unsuccessful</code>
							<?php
									}
								}
								else{
							?>
							<input type="hidden" name="emailtest" value="yes">
							<input type="text" name="emailaddress">
							<input type="submit" value="Test Email">
              <?php
								}
							?>
          </li>
      </ul>
    </fieldset>
	</form>

	</div>