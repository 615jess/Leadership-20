<?php

/*
 * Copyright 2010, Daniel Watrous, All rights reserved
 * By using this software you agree to be bound by the terms
 * outlined in the License.txt file included with the software.
 *
 * If you still have questions please send them to helpdesk@danielwatrous.com
 *
 */

if ('authnet_checkout_form.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('<h2>Direct File Access Prohibited</h2>');

// build checkout process action url
$post_url_process = get_bloginfo ('wpurl') . preg_replace ('#^.*[/\\\\](.*?)[/\\\\].*?$#', "/wp-content/plugins/$1/authnet_process.php", __FILE__);
// update to use https based on option setting
if (get_option('authnet_usessl'))
	$post_url_process = preg_replace('|^http://|', 'https://', $post_url_process);
$ccv_image = get_bloginfo ('wpurl') . preg_replace ('#^.*[/\\\\](.*?)[/\\\\].*?$#', "/wp-content/plugins/$1/images/cvv.jpg", __FILE__);

$stylesheet = file_get_contents (dirname(__FILE__).'/style.css');

// determine whether phone is required
$phone_required = (get_option('authnet_require_phone')) ? ' class="required"':'';

$cc_select = <<<AUTHNETCO
<select name="cc_name" id="cc_name" tabindex="20">
	<option value=''>-- Select Card Type --</option>
	<option value="Visa">Visa</option>
	<option value="MasterCard">MasterCard</option>
	<option value="Discover">Discover</option>
	<option value="American Express">American Express</option>
</select>
AUTHNETCO;

$exp_month_select = <<<AUTHNETCO
<select name="exp_month" id="exp_month" tabindex="22">
	<option value=''>- Month -</option>
	<option value='01'>01</option>
	<option value='02'>02</option>
	<option value='03'>03</option>
	<option value='04'>04</option>
	<option value='05'>05</option>
	<option value='06'>06</option>
	<option value='07'>07</option>
	<option value='08'>08</option>
	<option value='09'>09</option>
	<option value='10'>10</option>
	<option value='11'>11</option>
	<option value='12'>12</option>
</select>
AUTHNETCO;

// get drop down of expiration years
$current_year = date ('Y');
$latest_year = $current_year+15;
$ccexp_years = range ($current_year, $latest_year);
$exp_year_select = '<select name="exp_year" id="exp_month" tabindex="23"><option value="">- Year -</option>';
foreach ($ccexp_years as $year) {
	$exp_year_select .= "\n	".'<option value="'.$year.'">'.$year.'</option>';
}
$exp_year_select .= "\n</select>";


$countryselect = <<<AUTHNETCO
<select name="billingCountry" id="billingCountry" tabindex="8">
	<option value='AD'>Andorra</option>
	<option value='AE'>United Arab Emirates</option>
	<option value='AG'>Antigua and Barbuda</option>
	<option value='AI'>Anguilla</option>
	<option value='AL'>Albania</option>
	<option value='AM'>Armenia</option>
	<option value='AN'>Netherlands Antilles</option>
	<option value='AO'>Angola</option>
	<option value='AR'>Argentina</option>
	<option value='AT'>Austria</option>
	<option value='AU'>Australia</option>
	<option value='AW'>Aruba</option>
	<option value='AZ'>Azerbaijan Republic</option>
	<option value='BA'>Bosnia and Herzegovina</option>
	<option value='BB'>Barbados</option>
	<option value='BE'>Belgium</option>
	<option value='BF'>Burkina Faso</option>
	<option value='BG'>Bulgaria</option>
	<option value='BH'>Bahrain</option>
	<option value='BI'>Burundi</option>
	<option value='BJ'>Benin</option>
	<option value='BM'>Bermuda</option>
	<option value='BN'>Brunei</option>
	<option value='BO'>Bolivia</option>
	<option value='BR'>Brazil</option>
	<option value='BS'>Bahamas</option>
	<option value='BT'>Bhutan</option>
	<option value='BW'>Botswana</option>
	<option value='BZ'>Belize</option>
	<option value='CA'>Canada</option>
	<option value='CD'>Democratic Republic of the Congo</option>
	<option value='CG'>Republic of the Congo</option>
	<option value='CH'>Switzerland</option>
	<option value='CK'>Cook Islands</option>
	<option value='CL'>Chile</option>
	<option value='CN'>China</option>
	<option value='CO'>Colombia</option>
	<option value='CR'>Costa Rica</option>
	<option value='CV'>Cape Verde</option>
	<option value='CY'>Cyprus</option>
	<option value='CZ'>Czech Republic</option>
	<option value='DE'>Germany</option>
	<option value='DJ'>Djibouti</option>
	<option value='DK'>Denmark</option>
	<option value='DM'>Dominica</option>
	<option value='DO'>Dominican Republic</option>
	<option value='DZ'>Algeria</option>
	<option value='EC'>Ecuador</option>
	<option value='EE'>Estonia</option>
	<option value='ER'>Eritrea</option>
	<option value='ES'>Spain</option>
	<option value='ET'>Ethiopia</option>
	<option value='FI'>Finland</option>
	<option value='FJ'>Fiji</option>
	<option value='FK'>Falkland Islands</option>
	<option value='FM'>Federated States of Micronesia</option>
	<option value='FO'>Faroe Islands</option>
	<option value='FR'>France</option>
	<option value='GA'>Gabon Republic</option>
	<option value='GB'>United Kingdom</option>
	<option value='GD'>Grenada</option>
	<option value='GF'>French Guiana</option>
	<option value='GI'>Gibraltar</option>
	<option value='GL'>Greenland</option>
	<option value='GM'>Gambia</option>
	<option value='GN'>Guinea</option>
	<option value='GP'>Guadeloupe</option>
	<option value='GR'>Greece</option>
	<option value='GT'>Guatemala</option>
	<option value='GW'>Guinea Bissau</option>
	<option value='GY'>Guyana</option>
	<option value='HK'>Hong Kong</option>
	<option value='HN'>Honduras</option>
	<option value='HR'>Croatia</option>
	<option value='HU'>Hungary</option>
	<option value='ID'>Indonesia</option>
	<option value='IE'>Ireland</option>
	<option value='IL'>Israel</option>
	<option value='IN'>India</option>
	<option value='IS'>Iceland</option>
	<option value='IT'>Italy</option>
	<option value='JM'>Jamaica</option>
	<option value='JO'>Jordan</option>
	<option value='JP'>Japan</option>
	<option value='KE'>Kenya</option>
	<option value='KG'>Kyrgyzstan</option>
	<option value='KH'>Cambodia</option>
	<option value='KI'>Kiribati</option>
	<option value='KM'>Comoros</option>
	<option value='KN'>St. Kitts and Nevis</option>
	<option value='KR'>South Korea</option>
	<option value='KW'>Kuwait</option>
	<option value='KY'>Cayman Islands</option>
	<option value='KZ'>Kazakhstan</option>
	<option value='LA'>Laos</option>
	<option value='LC'>St. Lucia</option>
	<option value='LI'>Liechtenstein</option>
	<option value='LK'>Sri Lanka</option>
	<option value='LS'>Lesotho</option>
	<option value='LT'>Lithuania</option>
	<option value='LU'>Luxembourg</option>
	<option value='LV'>Latvia</option>
	<option value='MA'>Morocco</option>
	<option value='MG'>Madagascar</option>
	<option value='MH'>Marshall Islands</option>
	<option value='ML'>Mali</option>
	<option value='MN'>Mongolia</option>
	<option value='MQ'>Martinique</option>
	<option value='MR'>Mauritania</option>
	<option value='MS'>Montserrat</option>
	<option value='MT'>Malta</option>
	<option value='MU'>Mauritius</option>
	<option value='MV'>Maldives</option>
	<option value='MW'>Malawi</option>
	<option value='MX'>Mexico</option>
	<option value='MY'>Malaysia</option>
	<option value='MZ'>Mozambique</option>
	<option value='NA'>Namibia</option>
	<option value='NC'>New Caledonia</option>
	<option value='NE'>Niger</option>
	<option value='NF'>Norfolk Island</option>
	<option value='NI'>Nicaragua</option>
	<option value='NL'>Netherlands</option>
	<option value='NO'>Norway</option>
	<option value='NP'>Nepal</option>
	<option value='NR'>Nauru</option>
	<option value='NU'>Niue</option>
	<option value='NZ'>New Zealand</option>
	<option value='OM'>Oman</option>
	<option value='PA'>Panama</option>
	<option value='PE'>Peru</option>
	<option value='PF'>French Polynesia</option>
	<option value='PG'>Papua New Guinea</option>
	<option value='PH'>Philippines</option>
	<option value='PL'>Poland</option>
	<option value='PM'>St. Pierre and Miquelon</option>
	<option value='PN'>Pitcairn Islands</option>
	<option value='PT'>Portugal</option>
	<option value='PW'>Palau</option>
	<option value='QA'>Qatar</option>
	<option value='RE'>Reunion</option>
	<option value='RO'>Romania</option>
	<option value='RU'>Russia</option>
	<option value='RW'>Rwanda</option>
	<option value='SA'>Saudi Arabia</option>
	<option value='SB'>Solomon Islands</option>
	<option value='SC'>Seychelles</option>
	<option value='SE'>Sweden</option>
	<option value='SG'>Singapore</option>
	<option value='SH'>St. Helena</option>
	<option value='SI'>Slovenia</option>
	<option value='SJ'>Svalbard and Jan Mayen Islands</option>
	<option value='SK'>Slovakia</option>
	<option value='SL'>Sierra Leone</option>
	<option value='SM'>San Marino</option>
	<option value='SN'>Senegal</option>
	<option value='SO'>Somalia</option>
	<option value='SR'>Suriname</option>
	<option value='ST'>Sao Tome and Principe</option>
	<option value='SV'>El Salvador</option>
	<option value='SZ'>Swaziland</option>
	<option value='TC'>Turks and Caicos Islands</option>
	<option value='TD'>Chad</option>
	<option value='TG'>Togo</option>
	<option value='TH'>Thailand</option>
	<option value='TJ'>Tajikistan</option>
	<option value='TM'>Turkmenistan</option>
	<option value='TN'>Tunisia</option>
	<option value='TO'>Tonga</option>
	<option value='TR'>Turkey</option>
	<option value='TT'>Trinidad and Tobago</option>
	<option value='TV'>Tuvalu</option>
	<option value='TW'>Taiwan</option>
	<option value='TZ'>Tanzania</option>
	<option value='UA'>Ukraine</option>
	<option value='UG'>Uganda</option>
	<option value='US'>United States</option>
	<option value='UY'>Uruguay</option>
	<option value='VA'>Vatican City State</option>
	<option value='VC'>Saint Vincent and the Grenadines</option>
	<option value='VE'>Venezuela</option>
	<option value='VG'>British Virgin Islands</option>
	<option value='VN'>Vietnam</option>
	<option value='VU'>Vanuatu</option>
	<option value='WF'>Wallis and Futuna Islands</option>
	<option value='WS'>Samoa</option>
	<option value='YE'>Yemen</option>
	<option value='YT'>Mayotte</option>
	<option value='ZA'>South Africa</option>
	<option value='ZM'>Zambia</option>
</select>
AUTHNETCO;
if ($billingCountry == '') $billingCountry = 'US';
$countryselect = str_replace ($billingCountry."'", $billingCountry."' selected", $countryselect);

$checkoutform = <<<AUTHNETCO
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=256,height=435');");
}
// End -->
</script>

<!-- Script Size:  0.73 KB  -->
<u>Purchase details:</u><br />
<strong>SUBSCRIPTION_NAME</strong><br />
<strong>SUBSCRIPTION_DESC</strong><br />
<strong>SUBSCRIPTION_PRICING</strong><br />
<br />
<form action="{$post_url_process}" method="post">
<p><b>Bold</b> fields are required.</p>
<p style="color: red;">{$error_message}</p>
<fieldset>
<legend>Billing Details</legend>
	<label for="billingFirstName" class="required">First Name: </label>
		<input type="text" id="billingFirstName" name="billingFirstName" tabindex="1" title="first name" value="{$billingFirstName}"><br>
		<!--<small>This describes the subscription (e.g. Super Gold Membership).</small>-->
	<label for="billingLastName" class="required">Last Name: </label>
		<input type="text" id="billingLastName" name="billingLastName" tabindex="2" title="last name" value="{$billingLastName}"><br>
	<label for="email" class="required">E-mail address: </label>
		<input type="text" id="email" name="email" tabindex="2" title="email" value="{$email}"><br>
	<label for="billingAddress" class="required">Address: </label>
		<textarea name="billingAddress" rows="2" cols="40" id="billingAddress" tabindex="3" title="address">{$billingAddress}</textarea><br>
	<label for="billingCity" class="required">City: </label>
		<input type="text" id="billingCity" name="billingCity" tabindex="4" title="city" value="{$billingCity}"><br>
	<label for="billingState" class="required">State: </label>
		<input type="text" id="billingState" name="billingState" tabindex="5" title="state" value="{$billingState}"><br>
	<label for="billingZip" class="required">Zip code: </label>
		<input type="text" id="billingZip" name="billingZip" tabindex="6" title="zip" value="{$billingZip}"><br>
	<label for="billingPhone" {$phone_required}>Phone: </label>
		<input type="text" id="billingPhone" name="billingPhone" tabindex="7" title="phone" value="{$billingPhone}"><br>
	<label for="billingCountry" class="required">Country: </label>
		{$countryselect}
</fieldset>

SURVEY

USERINFORMATION

USERNOTES

<fieldset>
<legend>Credit Card Details</legend>
	<label for="creditCardType" class="required">Card type: </label>
		{$cc_select}<br/>
	<label for="creditCardNumber" class="required">Credit Card Number: </label>
		<input value="" type="text" id="creditCardNumber" name="creditCardNumber" tabindex="21" title="creditCardNumber" autocomplete="off"><br>
	<label for="creditCardNumber" class="required">Expiration Date: </label>
		{$exp_month_select} {$exp_year_select}<br>
	<label for="CreditCardCCV" accesskey="c" class="required">CCV Code: </label>
		<input type="text" name="CreditCardCCV" style="width: 70px;" tabindex="24" autocomplete="off">
		<small><a href="javascript:popUp('{$ccv_image}')" title="CVV2 codes location">What's this?</a></small>
	<label for="kludge"></label>
		<input type="hidden" name="subscription" value="{$subscription}">
		<input type="hidden" name="claim" value="{$claim}">
		<input type="hidden" name="recurring" value="{$recurring}">
		<input type="hidden" name="amount" value="{$amount}">
		<input type="hidden" name="postname" value="{$postname}">
		<input type="hidden" name="article_id" value="{$article_id}">
		<input type="hidden" name="action" value="checkout">
		<input type="submit" value="Complete Checkout" id="submit" tabindex="25">
</fieldset>
</form>
AUTHNETCO;

// additional information
$userinfo_form = <<<AUTHNETUSERINFO
<fieldset>
<legend>Access Details</legend>
	<label for="desiredUsername" class="required">Desired Username: </label>
		<input type="text" id="desiredUsername" name="desiredUsername" tabindex="12" title="desired username" value="{$desiredUsername}"><br>
	<label for="desiredPassword">Desired Password: </label>
		<input type="text" id="desiredPassword" name="desiredPassword" tabindex="13" title="desired password" value="{$desiredPassword}"><br>
		<small>If left blank, a password will be generated for you.</small>
</fieldset>
AUTHNETUSERINFO;

$usernotes_form = <<<AUTHNETUSERNOTES
<fieldset>
<legend>Additional Information</legend>
	<label for="subscriptionNotes" class="required">Comments: </label>
		<textarea id="subscriptionNotes" name="subscriptionNotes" tabindex="15" cols="40" rows="2">{$subscriptionNotes}</textarea><br>
		<small>Please provide any additional information for this order (such as designation for donations).</small>
</fieldset>
AUTHNETUSERNOTES;

?>

