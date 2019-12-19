<?php


/*
 * Copyright 2010, Daniel Watrous, All rights reserved
 * By using this software you agree to be bound by the terms
 * outlined in the License.txt file included with the software.
 *
 * If you still have questions please send them to helpdesk@danielwatrous.com
 *
 */

function rollbackReturn($message, $user_id = null, $transaction_id = null, $user_subscription_id = null) {
	global $wpdb, $subscription, $claim, $postname, $amount, $article_id, $recurring, $log;
	global $authnet_user_subscription_table_name, $authnet_payment_table_name;
	global $newuser;
	$log->LogInfo ("rollbackReturn called");
	// if $user_id is passed in then do cleanup in database
	if ($user_id) {
		// remove all related database records (if any)
		if ($user_subscription_id != null) {
			$delete_user_subscription = "DELETE FROM $authnet_user_subscription_table_name WHERE ID = $user_subscription_id";
			$log->LogDebug ($delete_user_subscription);
			$wpdb->query($delete_user_subscription);

			$delete_payment = "DELETE FROM $authnet_payment_table_name WHERE user_subscription_id = $user_subscription_id";
			$log->LogDebug ($delete_payment);
			$wpdb->query($delete_payment);
		}
		if ($transaction_id != null) {
			voidAIM ($transaction_id);
		}
		// remove the WordPress user to avoid duplicates
		// The magic 1 here assumes that user_id=1 is admin and we don't want to delete him
		// We also reassign any posts to user_id=1 (admin) so that we don't lose them
		if ($user_id != 1 && $newuser) {
			$log->LogDebug ('Delete user: '.$user_id);
			wp_delete_user($user_id, 1);
		} else $log->LogDebug ('User either is admin or already existed: '.$user_id.' (not deleting)');
	}

	// build return values as a user helper
	$return_values_array = array(
							'billingFirstName' => isset($_POST['billingFirstName']) ? $_POST['billingFirstName']:'',
							'billingLastName' => isset($_POST['billingLastName']) ? $_POST['billingLastName']:'',
							'email' => isset($_POST['email']) ? $_POST['email']:'',
							'billingAddress' => isset($_POST['billingAddress']) ? $_POST['billingAddress']:'',
							'billingCity' => isset($_POST['billingCity']) ? $_POST['billingCity']:'',
							'billingState' => isset($_POST['billingState']) ? $_POST['billingState']:'',
							'billingZip' => isset($_POST['billingZip']) ? $_POST['billingZip']:'',
							'billingCountry' => isset($_POST['billingCountry']) ? $_POST['billingCountry']:'',
							'billingPhone' => isset($_POST['billingPhone']) ? $_POST['billingPhone']:'',
							'subscriptionNotes' => isset($_POST['subscriptionNotes']) ? $_POST['subscriptionNotes']:'',
							'desiredUsername' => isset($_POST['desiredUsername']) ? $_POST['desiredUsername']:'',
							'desiredPassword' => isset($_POST['desiredPassword']) ? $_POST['desiredPassword']:'');

	$get_string = "";
	foreach($return_values_array as $key => $value ) { $get_string .= "$key=" . urlencode( $value ) . "&"; }
	$get_string = rtrim( $get_string, "& " );

	// finally ensure that the claim and request are built out correctly
	if (is_numeric($subscription)) {
		$return_value = get_bloginfo('url').'/'.get_option('authnet_checkoutpage').'?subscription='.$subscription.'&claim='.createCheckoutClaim($subscription, get_option('authnet_securityseed')).'&'.$get_string;
	} else if ($postname == 'donation') {
		$return_value = get_bloginfo('url').'/'.get_option('authnet_checkoutpage').'?subscription='.$subscription.'&claim='.md5($amount.$postname).'&amount='.$amount.'&postname='.$postname.'&recurring='.$recurring.'&article_id='.$article_id.'&'.$get_string;
	} else {
		$return_value = get_bloginfo('url').'/'.get_option('authnet_checkoutpage').'?subscription='.$subscription.'&claim='.createCheckoutClaim($amount.$postname, get_option('authnet_securityseed')).'&amount='.$amount.'&postname='.$postname.'&article_id='.$article_id.'&'.$get_string;
	}
	header("Location: ".$return_value.'&message='.$message);
	exit;
}

class AuthNetOrder {
	public $x_type = "AUTH_CAPTURE";
	public $x_method = "CC";
	public $x_card_num;
	public $x_exp_date;
	public $x_card_code;
	public $x_amount;
	public $x_description;
	public $x_invoice_num;
	public $x_first_name;
	public $x_last_name;
	public $x_address;
	public $x_state;
	public $x_city;
	public $x_zip;
	public $x_email;
	public $x_phone;
	public $x_country;
}

function makeSecuritySeed($lenth = 64) {
    // makes a random alpha numeric string of a given lenth
    $aZ09 = array_merge(range('A', 'Z'), range('a', 'z'),range(0, 9));
    $out ='';
    for($c=0;$c < $lenth;$c++) {
       $out .= $aZ09[mt_rand(0,count($aZ09)-1)];
    }
    return $out;
}

function createCheckoutClaim ($valuestosecure, $securityseed) {
	// $valuestosecure may be a subscription_id or a buy it now price
	$len = strlen($securityseed);
	$saltedpass = substr($securityseed, 0, round($len/2)) . $valuestosecure . substr($securityseed, round($len/2), $len);
	return md5($saltedpass);
}

/**
Validate an email address.
Provide email address (raw input)
Returns true if the email address has the email
http://snippets.dzone.com/posts/show/1504
*/
function validEmail($email) {
  $result = TRUE;
  if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)) {
    $result = FALSE;
  }
  return $result;
}

function processAIM ($orderDetails) {

	global $log;
	global $authnet_transactionkey, $authnet_apikey, $authnet_aimposturl;

	$post_values = array(
		"x_login"				=> $authnet_apikey,
		"x_tran_key"			=> $authnet_transactionkey,

		"x_version" 			=> "3.1",
		"x_delim_data"			=> "TRUE",
		"x_delim_char"			=> "|",
		"x_relay_response"		=> "FALSE",

		"x_type"				=> "AUTH_CAPTURE",
		"x_method"				=> "CC",
		"x_card_num"			=> $orderDetails->x_card_num,
		"x_exp_date"			=> $orderDetails->x_exp_date,
		"x_card_code"			=> $orderDetails->x_card_code,

		"x_amount"				=> $orderDetails->x_amount,
		"x_description"			=> $orderDetails->x_description,
		"x_invoice_num"			=> $orderDetails->x_invoice_num,

		"x_first_name"			=> $orderDetails->x_first_name,
		"x_last_name"			=> $orderDetails->x_last_name,
		"x_address"				=> $orderDetails->x_address,
		"x_city"				=> $orderDetails->x_city,
		"x_state"				=> $orderDetails->x_state,
		"x_zip"					=> $orderDetails->x_zip,
		"x_email"				=> $orderDetails->x_email,
		"x_phone"				=> $orderDetails->x_phone,
		"x_country"				=> $orderDetails->x_country
		// Additional fields can be added here as outlined in the AIM integration
		// guide at: http://developer.authorize.net
	);

	// This section takes the input fields and converts them to the proper format
	// for an http post.  For example: "x_login=username&x_tran_key=a1B2c3D4"
	$post_string = "";
	foreach( $post_values as $key => $value )
			{ $post_string .= "$key=" . urlencode( $value ) . "&"; }
	$post_string = rtrim( $post_string, "& " );

	//$log->LogDebug ($post_string);

	$request = curl_init($authnet_aimposturl); // initiate curl object
	curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
	curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
	curl_setopt($request, CURLOPT_POSTFIELDS, $post_string); // use HTTP POST to send form data
	curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response.
	$post_response = curl_exec($request); // execute curl post and store results in $post_response

	// additional options may be required depending upon your server configuration
	// you can find documentation on curl options at http://www.php.net/curl_setopt
	curl_close ($request); // close curl object

	// This line takes the response and breaks it into an array using the specified delimiting character
	$response_array = explode($post_values["x_delim_char"],$post_response);

	// map response values to associative array for easier processing
	$transactionResults = array(
		"resp_code" => $response_array[0],
		"resp_subcode" => $response_array[1],
		"resp_reason_code" => $response_array[2],
		"resp_reason_text" => $response_array[3],
		"resp_auth_code" => $response_array[4],
		"resp_avs_response" => $response_array[5],
		"resp_transaction_id" => $response_array[6],
		"resp_invoice_number" => $response_array[7],
		"resp_description" => $response_array[8],
		"resp_amount" => $response_array[9],
		"resp_method" => $response_array[10],
		"resp_transaction_type" => $response_array[11],
		"resp_customer_id" => $response_array[12],
		"resp_first_name" => $response_array[13],
		"resp_last_name" => $response_array[14],
		"resp_company" => $response_array[15],
		"resp_address" => $response_array[16],
		"resp_city" => $response_array[17],
		"resp_state" => $response_array[18],
		"resp_zip_code" => $response_array[19],
		"resp_country" => $response_array[20],
		"resp_phone" => $response_array[21],
		"resp_fax" => $response_array[22],
		"resp_email" => $response_array[23],
		"resp_ship_first_name" => $response_array[24],
		"resp_ship_last_name" => $response_array[25],
		"resp_ship_company" => $response_array[26],
		"resp_ship_address" => $response_array[27],
		"resp_ship_city" => $response_array[28],
		"resp_ship_state" => $response_array[29],
		"resp_ship_zip_code" => $response_array[30],
		"resp_ship_country" => $response_array[31],
		"resp_tax" => $response_array[32],
		"resp_duty" => $response_array[33],
		"resp_freight" => $response_array[34],
		"resp_tax_exempt" => $response_array[35],
		"resp_po_number" => $response_array[36],
		"resp_md5_hash" => $response_array[37],
		"resp_card_code_result" => $response_array[38],
		"resp_cardholder_verify_response" => $response_array[39]);

	// return result
	return $transactionResults;

}

function voidAIM ($transaction_id) {

	global $log;
	global $authnet_transactionkey, $authnet_apikey, $authnet_aimposturl;

	$post_values = array(
		// the API Login ID and Transaction Key must be replaced with valid values
		"x_login"				=> $authnet_apikey,
		"x_tran_key"			=> $authnet_transactionkey,

		"x_version" 			=> "3.1",
		"x_delim_data"			=> "TRUE",
		"x_delim_char"			=> "|",
		"x_relay_response"		=> "FALSE",

		"x_type"				=> "VOID",
		"x_trans_id"			=> $transaction_id
		// Additional fields can be added here as outlined in the AIM integration
		// guide at: http://developer.authorize.net
	);

	// This section takes the input fields and converts them to the proper format
	// for an http post.  For example: "x_login=username&x_tran_key=a1B2c3D4"
	$post_string = "";
	foreach( $post_values as $key => $value )
			{ $post_string .= "$key=" . urlencode( $value ) . "&"; }
	$post_string = rtrim( $post_string, "& " );

	$log->LogDebug ($post_string);

	$request = curl_init($authnet_aimposturl); // initiate curl object
	curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
	curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
	curl_setopt($request, CURLOPT_POSTFIELDS, $post_string); // use HTTP POST to send form data
	curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response.
	$post_response = curl_exec($request); // execute curl post and store results in $post_response

	// additional options may be required depending upon your server configuration
	// you can find documentation on curl options at http://www.php.net/curl_setopt
	curl_close ($request); // close curl object

	// This line takes the response and breaks it into an array using the specified delimiting character
	$response_array = explode($post_values["x_delim_char"],$post_response);

	// map response values to associative array for easier processing
	$transactionResults = array(
		"resp_code" => $response_array[0],
		"resp_subcode" => $response_array[1],
		"resp_reason_code" => $response_array[2],
		"resp_reason_text" => $response_array[3],
		"resp_auth_code" => $response_array[4],
		"resp_avs_response" => $response_array[5],
		"resp_transaction_id" => $response_array[6],
		"resp_invoice_number" => $response_array[7],
		"resp_description" => $response_array[8],
		"resp_amount" => $response_array[9],
		"resp_method" => $response_array[10],
		"resp_transaction_type" => $response_array[11],
		"resp_customer_id" => $response_array[12],
		"resp_first_name" => $response_array[13],
		"resp_last_name" => $response_array[14],
		"resp_company" => $response_array[15],
		"resp_address" => $response_array[16],
		"resp_city" => $response_array[17],
		"resp_state" => $response_array[18],
		"resp_zip_code" => $response_array[19],
		"resp_country" => $response_array[20],
		"resp_phone" => $response_array[21],
		"resp_fax" => $response_array[22],
		"resp_email" => $response_array[23],
		"resp_ship_first_name" => $response_array[24],
		"resp_ship_last_name" => $response_array[25],
		"resp_ship_company" => $response_array[26],
		"resp_ship_address" => $response_array[27],
		"resp_ship_city" => $response_array[28],
		"resp_ship_state" => $response_array[29],
		"resp_ship_zip_code" => $response_array[30],
		"resp_ship_country" => $response_array[31],
		"resp_tax" => $response_array[32],
		"resp_duty" => $response_array[33],
		"resp_freight" => $response_array[34],
		"resp_tax_exempt" => $response_array[35],
		"resp_po_number" => $response_array[36],
		"resp_md5_hash" => $response_array[37],
		"resp_card_code_result" => $response_array[38],
		"resp_cardholder_verify_response" => $response_array[39]);

	// return result
	$log->LogDebug (serialize($transactionResults));
	return $transactionResults;

}

function processARB ($orderDetails, $ARBHost, $ARBPath, $subscription) {

	global $authnet_transactionkey, $authnet_apikey, $log;

	//build xml to post
	$content =	"<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
				"<ARBCreateSubscriptionRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
				"<merchantAuthentication>".
				"<name>" . $authnet_apikey. "</name>".
				"<transactionKey>" . $authnet_transactionkey . "</transactionKey>".
				"</merchantAuthentication>".
				"<refId>" . $orderDetails->x_invoice_num . "</refId>".
				"<subscription>".
				"<name>" . $subscription->name . "</name>".
				"<paymentSchedule>".
				"<interval>".
				"<length>". $subscription->recurringIntervalLength ."</length>".
				"<unit>". $subscription->recurringIntervalUnit ."</unit>".
				"</interval>".
				"<startDate>" . date('Y-m-d') . "</startDate>".
				"<totalOccurrences>". $subscription->recurringTotalOccurrences . "</totalOccurrences>".
				"<trialOccurrences>". $subscription->recurringTrialOccurrences . "</trialOccurrences>".
				"</paymentSchedule>".
				"<amount>". $subscription->recurringAmount ."</amount>".
				"<trialAmount>" . $subscription->recurringTrialAmount . "</trialAmount>".
				"<payment>".
				"<creditCard>".
				"<cardNumber>" . $orderDetails->x_card_num . "</cardNumber>".
				"<expirationDate>" . $orderDetails->x_exp_date . "</expirationDate>".
				"</creditCard>".
				"</payment>".
				"<customer>".
				"<email>". $orderDetails->x_email . "</email>".
				"<phoneNumber>" . $orderDetails->x_phone . "</phoneNumber>".
				"</customer>".
				"<billTo>".
				"<firstName>". $orderDetails->x_first_name . "</firstName>".
				"<lastName>" . $orderDetails->x_last_name . "</lastName>".
				"<address>" . $orderDetails->x_address . "</address>".
				"<city>" . $orderDetails->x_city . "</city>".
				"<state>" . $orderDetails->x_state . "</state>".
				"<zip>" . $orderDetails->x_zip . "</zip>".
				"<country>" . $orderDetails->x_country . "</country>".
				"</billTo>".
				"</subscription>".
				"</ARBCreateSubscriptionRequest>";

	//$log->LogDebug($content);
	$posturl = "https://" . $ARBHost . $ARBPath;
	$response = send_request_via_curl($posturl, $content);
	$log->LogDebug($response);
	if ($response) {
		return parse_return($response);
	} else return false;

}

// function to send xml request via curl
function send_request_via_curl($posturl,$content) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $posturl);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$response = curl_exec($ch);
	return $response;
}

// function to parse Authorize.net response
function parse_return($content) {
	$refId = substring_between($content,'<refId>','</refId>');
	$resultCode = substring_between($content,'<resultCode>','</resultCode>');
	$code = substring_between($content,'<code>','</code>');
	$text = substring_between($content,'<text>','</text>');
	$subscriptionId = substring_between($content,'<subscriptionId>','</subscriptionId>');
	return array ($refId, $resultCode, $code, $text, $subscriptionId);
}

// helper function for parsing response
function substring_between($haystack,$start,$end) {
	if (strpos($haystack,$start) === false || strpos($haystack,$end) === false)	{
		return false;
	} else {
		$start_position = strpos($haystack,$start)+strlen($start);
		$end_position = strpos($haystack,$end);
		return substr($haystack,$start_position,$end_position-$start_position);
	}
}

// TODO this is unfinished
function subscribe($list, $email, $name_first, $name_last, $software_1, $software_2='') {

	$fullname = $name_first." ".$name_last;

	$req = "unit=$list";

	$referer = "http://www.example.com/";

	$formvars["meta_split_id"] = "";
	$formvars["redirect"] = "http://www.aweber.com/form/thankyou_vo.html";
	$formvars["meta_redirect_onlist"] = "";
	$formvars["meta_adtracking"] = "autosub-cart";
	$formvars["meta_message"] = "1";
	$formvars["meta_required"] = "from";
	$formvars["meta_forward_vars"] = "0";
	$formvars["name"] = $fullname;
	$formvars["from"] = $email;
	$formvars["custom Software Title 1"] = $software_1;
	$formvars["custom Software Title 2"] = $software_2;


	foreach ($formvars as $key => $value) {
		$req .= "&" . $key . "=" . urlencode($value);
	}

	// post info to Profollow to subscribe
	$post_header = "POST /scripts/addlead.pl HTTP/1.0\r\n";
	$post_header .= "Host: www.aweber.com\r\n";
	$post_header .= "Referer: $referer\r\n";
	$post_header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$post_header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

	$fp = fsockopen ('www.aweber.com', 80, $errno, $errstr, 30);

	if (!$fp) {
		return false;
	} else {
		fputs ($fp, $post_header . $req);
		while (!feof($fp)) {
			$res = fgets ($fp, 1024);
		}
		fclose ($fp);
		return true;
	}
}

// given a subscription return a subscription link
function getSubscriptionLink ($subscription) {
	$urlbase = get_bloginfo('url').'/'.get_option('authnet_checkoutpage');
	if (get_option('authnet_usessl')) $urlbase = str_replace ("http:", "https:", $urlbase);
	if ($subscription->ID == 1) {
		$sublink = "Single post buy now links are automatically generated";
	} else {
		$sublink = $urlbase.'?subscription='.$subscription->ID.'&claim='.createCheckoutClaim($subscription->ID, get_option('authnet_securityseed'));
	}
	return $sublink;
}

// survey related functions and values
// form field templates
global $surveyfield_text, $surveyfield_textarea, $surveyfield_select, $surveyfield_option, $survey_fieldset;
$surveyfield_text = <<<AUTHNETSURVEY
	<label for="FIELDNAME" REQUIRED>FIELDNAME: </label>
		<input type="text" id="FIELDNAME" name="survey_FIELDNAME"><br />
		<small>DESCRIPTION</small>
AUTHNETSURVEY;
$surveyfield_textarea =  <<<AUTHNETSURVEY
	<label for="FIELDNAME" REQUIRED>FIELDNAME: </label>
		<textarea id="FIELDNAME" name="survey_FIELDNAME" cols="40" rows="2"></textarea><br />
		<small>DESCRIPTION</small>
AUTHNETSURVEY;
$surveyfield_select =  <<<AUTHNETSURVEY
	<label for="FIELDNAME" REQUIRED>FIELDNAME: </label>
		<select id="FIELDNAME" name="survey_FIELDNAME">OPTIONS</select><br />
		<small>DESCRIPTION</small>
AUTHNETSURVEY;
$surveyfield_option =  '<option value="OPTIONKEY">OPTIONKEY</option>';
$survey_fieldset = <<<AUTHNETSURVEY
<fieldset>
<legend>SURVEYNAME</legend>
	FIELDS
</fieldset>
AUTHNETSURVEY;

function renderSurvey ($whichSurvey) {
	global $surveyfield_text, $surveyfield_textarea, $surveyfield_select, $surveyfield_option, $survey_fieldset;
	$surveyForm = "";
	$surveys = json_decode(get_option("authnet_surveys"));
	if ($surveys != NULL && count($surveys) > 0) {
		foreach ($surveys as $survey) {
			if ($survey->surveyName == $whichSurvey) {
				$surveyForm = $survey_fieldset;
				$surveyForm = str_replace ("SURVEYNAME", $survey->surveyName, $surveyForm);
				$allFields = "";
				foreach ($survey->surveyItems as $item) {
					$options = "";
					if ($item->itemValueType == "text") {
						$currentField = $surveyfield_text;
					} elseif ($item->itemValueType == "textarea") {
						$currentField = $surveyfield_textarea;
					} elseif ($item->itemValueType == "select") {
						$currentField = $surveyfield_select;
						// build options
						foreach ($item->itemOptions as $option) {
							$options .= str_replace ("OPTIONKEY", $option, $surveyfield_option);
						}
						$currentField = str_replace ("OPTIONS", $options, $currentField);
					}
					$currentField = str_replace ("FIELDNAME", $item->itemName, $currentField);
					if($item->itemRequired == 'Yes'){
						$currentField = str_replace ("REQUIRED", 'class="required"', $currentField);
					}
					else{
						$currentField = str_replace ("REQUIRED", '', $currentField);
					}
					
					$currentField = str_replace ("DESCRIPTION", "", $currentField);
					$allFields .= $currentField;
				}
				$surveyForm = str_replace ("FIELDS", $allFields, $surveyForm);
			}
		}
	}
	
	return $surveyForm;
}

function compileSurvey () {
	global $wpdb;
	$surveyResult = "";
	foreach ($_POST as $key => $value) { 
		if (strpos($key, "survey_") !== false) {
			$surveyResult .= str_replace ("survey_", '', $key) . " : " . $wpdb->escape($value) . "\n";
		}
	}
	return ($surveyResult=="") ? "":"SURVEY ANSWERS:\n".$surveyResult;
}

?>