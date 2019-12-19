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

?>

	<div class="wrap">
		<h2>Authorize.net for WordPress User Subscriptions</h2>

		<p>The table below contains all subscriptions on this website.</p>
	  
		<table class="widefat post fixed" cellspacing="0">
			<thead>
			<tr>
			<!--<th scope="col" id="cb" class="manage-column column-cb check-column" style=""><input type="checkbox" /></th> -->
			<th scope="col" id="firstname" class="manage-column column-firstname" style="width: 120px;">First Name</th> 
			<th scope="col" id="lastname" class="manage-column column-lastname" style="width: 120px;">Last Name</th> 
			<th scope="col" id="emailaddress" class="manage-column column-emailaddress" style="">Email address</th> 
			<th scope="col" id="address" class="manage-column column-address" style="">Address</th> 
			<th scope="col" id="phone" class="manage-column column-phone" style="">Phone</th> 
			<th scope="col" id="subscriptionnotes" class="manage-column column-subscriptionnotes" style="">Subscription Notes</th> 
			<th scope="col" id="startdate" class="manage-column column-startdate" style="width: 150px;">Start Date</th> 
			</tr>
			</thead>

			<tfoot>
			<tr>
			<!--<th scope="col" class="manage-column column-cb check-column" style=""><input type="checkbox" /></th> -->
			<th scope="col" class="manage-column column-firstname" style="">First Name</th> 
			<th scope="col" class="manage-column column-lastname" style="">Last Name</th> 
			<th scope="col" class="manage-column column-emailaddress" style="">Email address</th> 
			<th scope="col" class="manage-column column-address" style="">Address</th> 
			<th scope="col" class="manage-column column-phont" style="">Phone</th> 
			<th scope="col" class="manage-column column-subscriptionnotes" style="">Subscription Notes</th> 
			<th scope="col" class="manage-column column-startdate" style="">Start Date</th> 
			</tr>
			</tfoot>

			<tbody>
				<?php 
				// query user subscription record
				$user_sub_query = "SELECT * FROM " . $authnet_user_subscription_table_name . ";";
				$usersubscriptions = $wpdb->get_results($user_sub_query);
				if ($usersubscriptions) {
				foreach ($usersubscriptions as $subscription) { 
				?>
				<tr id='user_<?= $subscription->user_id; ?>' class='alternate author-self status-publish iedit' valign="top"> 
					<!--<th scope="row" class="check-column"><input type="checkbox" name="post[]" value="89" /></th> -->
					<td class="firstname column-firstname">
						<strong><a class="row-title" href="<?= get_bloginfo ('wpurl') . preg_replace ('#^.*[/\\\\](.*?)[/\\\\].*?$#', "/wp-admin/user-edit.php?user_id=".$subscription->user_id."&wp_http_referer=/wp-admin/admin.php?page=authnet_render_usersubscriptions", __FILE__)	?>" title="View &#8220;<?= $subscription->billingFirstName; ?>&#8221;"><?= $subscription->billingFirstName; ?></a></strong> 
					</td> 
					<td class="lastname column-lastname"><strong><?= $subscription->billingLastName; ?></strong></td> 
					<td class="emailaddress column-emailaddress"><a href='mailto:<?= $subscription->emailAddress; ?>'><?= $subscription->emailAddress; ?></a></td> 
					<td class="address column-address"><strong><?= $subscription->billingAddress; ?></strong>, <?= $subscription->billingCity; ?> <?= $subscription->billingState; ?>, <?= $subscription->billingZip; ?>, <em><?= $subscription->billingCountry; ?></em></td> 
					<td class="phone column-phone"><?= $subscription->billingPhone; ?></td> 
					<td class="subscriptionnotes column-subscriptionnotes"><?= $subscription->subscriptionNotes; ?></td> 
					<td class="startdate column-startdate"><?= $subscription->startDate; ?></td> 
				</tr> 
				<tr>
					<td colspan="7">
						<?php 
						// query user subscription record
						$user_payment_query = "SELECT * FROM " . $authnet_payment_table_name . " where user_subscription_id = ".$subscription->ID.";";
						$subscriptionpayments = $wpdb->get_results($user_payment_query);
						if ($subscriptionpayments) {
						foreach ($subscriptionpayments as $payment) { 
						?>
						<b>Auth code:</b><?= $payment->xAuthCode; ?> &nbsp;|&nbsp;
						<b>Transaction ID:</b><?= $payment->xTransId; ?> &nbsp;|&nbsp;
						<b>Amount:</b><?= $payment->xAmount; ?> &nbsp;|&nbsp;
						<b>Sub ID:</b><?= $payment->xSubscriptionId; ?> - <?= $payment->xSubscriptionPaynum; ?> &nbsp;|&nbsp;
						<b>Date:</b><?= $payment->paymentDate; ?> &nbsp;|&nbsp;
						<hr>
						<? }} ?>
					</td>
				</tr>
				<?php }} ?>
			</tbody>
		</table>

	</div>
