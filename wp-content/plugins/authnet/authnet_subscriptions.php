<?php

/*
 * Copyright 2010, Daniel Watrous, All rights reserved
 * By using this software you agree to be bound by the terms
 * outlined in the License.txt file included with the software.
 *
 * If you still have questions please send them to helpdesk@danielwatrous.com
 *
 */

if ('authnet_subscriptions.php' == basename($_SERVER['SCRIPT_FILENAME']))
     die ('<h2>'.__('Direct File Access Prohibited','authnet').'</h2>');

include('style.css');
$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
?>

	<div class="wrap" style="width: 700px;">
		<?php
		$show_update_msg = false;
		if (isset($_POST['action'])) {
			if ($_POST['action'] == 'edit' && isset($_POST['ID']) && is_numeric($_POST['ID'])) {
				$details = $wpdb->get_row("SELECT * FROM $authnet_subscription_table_name WHERE ID = ".intval($_POST['ID']));
				$action = 'edit';
				$safeID = intval($details->ID);
				$safeprocessSinglePayment = intval($details->processSinglePayment);
				$safeprocessRecurringPayment = intval($details->processRecurringPayment);
				$safename = $wpdb->escape($details->name);
				$safeinitialAmount = floatval($details->initialAmount);
				$safeinitialDescription = $wpdb->escape($details->initialDescription);
				$safeinitialInvoiceNum = $wpdb->escape($details->initialInvoiceNum);
				$saferecurringRefId = $wpdb->escape($details->recurringRefId);
				$saferecurringIntervalLength = intval($details->recurringIntervalLength);
				$saferecurringIntervalUnit = $wpdb->escape($details->recurringIntervalUnit);
				$saferecurringTotalOccurrences = intval($details->recurringTotalOccurrences);
				$saferecurringConcealTrial = intval($details->recurringConcealTrial);
				$saferecurringTrialOccurrences = intval($details->recurringTrialOccurrences);
				$saferecurringAmount = floatval($details->recurringAmount);
				$saferecurringTrialAmount = floatval($details->recurringTrialAmount);
				$safewishlistLevel = $wpdb->escape($details->wishlistLevel);
				$safesurvey = $wpdb->escape($details->survey);
			} else if ($_POST['action'] == 'update' && isset($_POST['ID']) && is_numeric($_POST['ID'])) {
				$query = "UPDATE $authnet_subscription_table_name
							SET processSinglePayment = ".(($_POST['processSinglePayment'] == 'on') ? 1:0).",
							processRecurringPayment = ".(($_POST['processRecurringPayment'] == 'on') ? 1:0).",
							name = '".$wpdb->escape($_POST['name'])."',
							initialAmount = ".floatval($_POST['initialAmount']).",
							initialDescription = '".$wpdb->escape($_POST['initialDescription'])."',
							initialInvoiceNum = '".$wpdb->escape($_POST['initialInvoiceNum'])."',
							recurringRefId = '".$wpdb->escape($_POST['recurringRefId'])."',
							recurringIntervalLength = ".intval($_POST['recurringIntervalLength']).",
							recurringIntervalUnit = '".$wpdb->escape($_POST['recurringIntervalUnit'])."',
							recurringConcealTrial = ".(($_POST['recurringConcealTrial'] == 'on') ? 1:0).",
							recurringTotalOccurrences = ".intval($_POST['recurringTotalOccurrences']).",
							recurringTrialOccurrences = ".intval($_POST['recurringTrialOccurrences']).",
							recurringAmount = ".floatval($_POST['recurringAmount']).",
							recurringTrialAmount = ".floatval($_POST['recurringTrialAmount']).",
							wishlistLevel = '".$wpdb->escape($_POST['wishlistLevel'])."',
							survey = '".$wpdb->escape($_POST['survey'])."'
							WHERE ID = ".intval($_POST['ID']);
				$show_update_msg = $wpdb->query($query);
			} else if ($_POST['action'] == 'insert') {
				$query = "INSERT INTO $authnet_subscription_table_name
							SET processSinglePayment = ".(($_POST['processSinglePayment'] == 'on') ? 1:0).",
							processRecurringPayment = ".(($_POST['processRecurringPayment'] == 'on') ? 1:0).",
							name = '".$wpdb->escape($_POST['name'])."',
							initialAmount = ".floatval($_POST['initialAmount']).",
							initialDescription = '".$wpdb->escape($_POST['initialDescription'])."',
							initialInvoiceNum = '".$wpdb->escape($_POST['initialInvoiceNum'])."',
							recurringRefId = '".$wpdb->escape($_POST['recurringRefId'])."',
							recurringIntervalLength = ".intval($_POST['recurringIntervalLength']).",
							recurringIntervalUnit = '".$wpdb->escape($_POST['recurringIntervalUnit'])."',
							recurringConcealTrial = ".(($_POST['recurringConcealTrial'] == 'on') ? 1:0).",
							recurringTotalOccurrences = ".intval($_POST['recurringTotalOccurrences']).",
							recurringTrialOccurrences = ".intval($_POST['recurringTrialOccurrences']).",
							recurringAmount = ".floatval($_POST['recurringAmount']).",
							recurringTrialAmount = ".floatval($_POST['recurringTrialAmount']).",
							wishlistLevel = '".$wpdb->escape($_POST['wishlistLevel'])."',
							survey = '".$wpdb->escape($_POST['survey'])."'";
				$show_update_msg = $wpdb->query($query);
			} else if ($_POST['action'] == 'delete' && isset($_POST['ID']) && is_numeric($_POST['ID'])) {
				$query = "delete from $authnet_subscription_table_name
							WHERE ID = ".intval($_POST['ID']);
				$show_update_msg = $wpdb->query($query);
			}
		}
		?>
		<?php if ($show_update_msg !== false) { ?>
		<div id="message" class="updated" style="padding: 4px; font-weight: bold;">Subscription Settings Saved (scroll down to view)</div>
		<?php } ?>
		<h2>Authorize.net for WordPress Subscriptions</h2>

		<p>Subscriptions are templates that define how a transaction will process.  Use the form below to add/edit Subscription types for your site.</p>

		<h3>Subscription Management</h3>

		<form action="" method="post" name="f">
		<p><b>Bold</b> fields are required.</p>
		<fieldset>
		<legend>Subscription Details</legend>
			<label for="name" class="required">Subscription Name: </label>
				<input value="<?php echo ($action=='edit') ? $safename:'' ?>" type="text" id="name" name="name" tabindex="1" title="subscription name"><br>
				<small>This describes the subscription (e.g. Super Gold Membership).</small>
			
			<?php 
			$surveys = json_decode(get_option("authnet_surveys"));
			if ($surveys != NULL && count($surveys)>0){
			?>
			<label for="survey">Survey: </label>
				<select id="survey" name="survey" tabindex="3">
				<option value="">-- Choose Level --</option>
			<?php foreach ($surveys as $survey) { ?>
				<option value="<?php echo $survey->surveyName; ?>" <?php if ($safesurvey == $survey->surveyName) echo "selected"; ?>><?php echo $survey->surveyName; ?></option>
			<?php } // end foreach ?>
				</select><br />
			<?php }// end if ?>
			<?php if (is_plugin_active('wishlist-member/wpm.php')) { //plugin is activated ?>
			<label for="wishlistLevel">WishList Member Level: </label>
				<select id="wishlistLevel" name="wishlistLevel" tabindex="3">
				<option value="">-- Choose Level --</option>

				<?php foreach (WLMAPI::GetOption("wpm_levels") as $sku => $membership_level) {
				$wlm_level = (isset($membership_level["wpm_newid"])) ? $membership_level["wpm_newid"]:$sku; ?>
				<option value="<?php echo $wlm_level; ?>" <?php if ($safewishlistLevel == $wlm_level) echo "selected"; ?>><?php echo $membership_level["name"]; ?></option>
				<?php } ?>
				</select>
				<small>This is a membership level as defined in WishList Member.</small>
			<?php } ?>
			<label for="processSinglePayment">Process Single Payment: </label>
				<input <?php echo ($action=='edit' && $safeprocessSinglePayment>0) ? 'checked':'' ?> type="checkbox" id="processSinglePayment" name="processSinglePayment" tabindex="4" title="Process Single Payment"><br>
			<label for="processRecurringPayment">Process Recurring Payment: </label>
				<input <?php echo ($action=='edit' && $safeprocessRecurringPayment>0) ? 'checked':'' ?> type="checkbox" id="processRecurringPayment" name="processRecurringPayment" tabindex="5" title="Process Recurring Payment"><br>
		</fieldset>

		<fieldset>
		<legend>Initial Payment Details</legend>
			<label for="initialAmount">One-time Amount: </label>
				<input value="<?php echo ($action=='edit') ? $safeinitialAmount:'' ?>" type="text" id="initialAmount" name="initialAmount" tabindex="6" title="amount"><br>
				<small>Required if Process Single Payment above is checked.  Amount in USD.</small>
			<label for="initialDescription" accesskey="c">Description: </label>
				<textarea name="initialDescription" rows="2" cols="23" id="initialDescription" tabindex="7" title="description"><?php echo ($action=='edit') ? $safeinitialDescription:'' ?></textarea><br>
		</fieldset>

		<fieldset>
		<legend>Recurring Payment Details</legend>
			<label for="recurringAmount">Recurring Amount: </label>
				<input value="<?php echo ($action=='edit') ? $saferecurringAmount:'' ?>" type="text" id="recurringAmount" name="recurringAmount" tabindex="8" title="amount"><br>
				<small>Required if Process Recurring Payment above is checked.  Amount in USD.</small>
			<label for="recurringIntervalLength">Recurring interval length: </label>
				<input value="<?php echo ($action=='edit') ? $saferecurringIntervalLength:''; ?>" type="text" id="recurringIntervalLength" name="recurringIntervalLength" tabindex="9" title="Recurring interval length"><br>
				<small>Up to 3 digits.  If unit below is months, valid values are between 1 and 12.  If unit is days, valid values are between 7 and 365.</small>
			<label for="recurringIntervalUnit">Recurring interval unit: </label>
				<select  id="recurringIntervalUnit" name="recurringIntervalUnit" tabindex="10" title="Recurring interval length">
					<option value="">-- choose unit --</option>
					<option value="days" <?php echo ($action=='edit' && $saferecurringIntervalUnit=='days') ? 'selected':''; ?>>days</option>
					<option value="months" <?php echo ($action=='edit' && $saferecurringIntervalUnit=='months') ? 'selected':''; ?>>months</option>
				</select>
				<small>Use in association with length above to determine the interval between each billing occurrence.</small>
			<label for="recurringRefId">Reference ID (optional): </label>
				<input value="<?php echo ($action=='edit') ? $saferecurringRefId:''; ?>" type="text" id="recurringRefId" name="recurringRefId" tabindex="11" title="Reference ID"><br>
			<label for="recurringTotalOccurrences">Total occurrences: </label>
				<input value="<?php echo ($action=='edit') ? $saferecurringTotalOccurrences:''; ?>" type="text" id="recurringTotalOccurrences" name="recurringTotalOccurrences" tabindex="12" title="email"><br>
				<small>Number of billing occurrences.  9999 for ongoing subscriptions.</small>
			<label for="recurringConcealTrial">Conceal Trial At Checkout: </label>
				<input <?php echo ($action=='edit' && $saferecurringConcealTrial>0) ? 'checked':'' ?> type="checkbox" id="recurringConcealTrial" name="recurringConcealTrial" tabindex="13" title="Conceal Trial Details"><br>
				<small>When checked, this option will prevent details about trial payments from being displayed to the user at checkout.</small>
			<label for="recurringTrialAmount">Trial Amount: </label>
				<input value="<?php echo ($action=='edit') ? $saferecurringTrialAmount:''; ?>" type="text" id="recurringTrialAmount" name="recurringTrialAmount" tabindex="14" title="email"><br>
				<small>Required if trial occurrences below is set.  The amount to be charged for each payment during a trial period.</small>
			<label for="recurringTrialOccurrences">Trial occurrences: </label>
				<input value="<?php echo ($action=='edit') ? $saferecurringTrialOccurrences:''; ?>" type="text" id="recurringTrialOccurrences" name="recurringTrialOccurrences" tabindex="15" title="email"><br>
				<small>Number of billing occurrences in the trial period.</small>
			<label for="kludge"></label>
				<?php if ($action=='edit') { ?>
				<input type="hidden" name="ID" value="<?php echo $safeID; ?>">
				<?php } ?>
				<input type="hidden" name="action" value="<?php echo ($action=='edit') ? 'update':'insert'; ?>">
				<input type="submit" value="Submit" id="submit" tabindex="16"> <INPUT type="reset" id="reset" tabindex="17">
		</fieldset>
		</form>

		<h3>Available Subscriptions</h3>

		<table>
			<tr align="left" valign="middle">
				<th>Name</th>
				<th>Single</th>
				<th>Recurring</th>
				<th>S:Amount</th>
				<th>R:Amount</th>
				<th>Billing cycle</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			<!-- stdClass Object ( [ID] => 1 [processSinglePayment] => 1 [processRecurringPayment] => 0 [name] => Single Post Purchase Template [initialAmount] => 0.00 [initialDescription] => Single Post Purchase Template [initialInvoiceNum] => [recurringRefId] => [recurringIntervalLength] => [recurringIntervalUnit] => [recurringTotalOccurrences] => [recurringTrialOccurrences] => [recurringAmount] => [recurringTrialAmount] => ) -->
			<?php
			$query = "SELECT * FROM $authnet_subscription_table_name ORDER BY ID ASC";
			$log->LogDebug($query);
			$subscriptions = $wpdb->get_results($query);

			// Step through our list of subscriptions
			foreach ($subscriptions as $subscription) { ?>
			<tr align="left" valign="middle">
				<td><?php echo $subscription->name; ?></td>
				<td align="center"><?php echo ($subscription->processSinglePayment==1) ? 'Yes':'No'; ?></td>
				<td align="center"><?php echo ($subscription->processRecurringPayment) ? 'Yes':'No'; ?></td>
				<td>$<?php echo $subscription->initialAmount; ?></td>
				<td><?php echo ($subscription->processRecurringPayment==1) ? '$'.$subscription->recurringAmount:'--'; ?></td>
				<td><?php echo ($subscription->processRecurringPayment==1) ? 'every '.$subscription->recurringIntervalLength.' '.$subscription->recurringIntervalUnit:'--'; ?></td>
				<td>
					<?php if ($subscription->ID != 1) { ?>
					<form method="post" style="min-width: 60px; width: 60px;">
					<input type="hidden" name="ID" value = "<?php echo $subscription->ID; ?>">
					<input type="hidden" name="action" value = "edit">
					<input type="submit" value="Edit">
					</form>
					<?php } ?>
				</td>
				<td>
					<?php if ($subscription->ID != 1) { ?>
					<form method="post" style="min-width: 22px; width: 22px;">
					<input type="hidden" name="ID" value = "<?php echo $subscription->ID; ?>">
					<input type="hidden" name="action" value = "delete">
					<input type="image" src="<?php echo get_bloginfo ('wpurl') . preg_replace ('#^.*[/\\\\](.*?)[/\\\\].*?$#', "/wp-content/plugins/$1/images/delete.png", __FILE__); ?>">
					</form>
					<?php } ?>
				</td>
			</tr>
			<tr>
				<td colspan="8">
					Buy Now Link: <input type="text" value="<?php echo getSubscriptionLink($subscription); ?>" size="75" onClick="select()">
				</td>
			</tr>
			<?php } ?>
		</table>
		<p>&nbsp;</p>


	</div>
