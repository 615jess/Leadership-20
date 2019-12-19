function getCheckoutUrl () {
	// get handle for form elements
	var donationform = document.getElementById('donationform');

	// get plugin values
	checkouturl_base = donationform.elements["posturl"].value;
	
	// get transaction values
	amount = parseFloat(donationform.elements["amount"].value).toFixed(2);
	article_id = donationform.elements["article_id"].value;
	postname = donationform.elements["postname"].value;
	recurring = (donationform.elements["recurring"].checked) ? '1':'0';
	recurring_period = donationform.elements["recurring_period"].value;
	subscription = donationform.elements["subscription"].value;
	
	// generate claim
	claimtoken = amount+postname;
	claim = createCheckoutClaim (claimtoken);

	// build checkouturl
	checkouturl = checkouturl_base;
	checkouturl = checkouturl + '?subscription=' + subscription;
	checkouturl = checkouturl + '&amount=' + amount; 
	checkouturl = checkouturl + '&article_id=' + article_id;
	checkouturl = checkouturl + '&postname=' + postname;
	checkouturl = checkouturl + '&recurring=' + recurring;
	checkouturl = checkouturl + '&recurring_period=' + recurring_period;
	checkouturl = checkouturl + '&claim=' + claim;
	
	return checkouturl;
}

function createCheckoutClaim (valuestosecure) {
	// valuestosecure is amount+postname
	securitystring = valuestosecure;
	return hex_md5(securitystring);
}

function gotocheckout () {
	var donationform = document.getElementById('donationform');
	if (donationform.elements["amount"].value == '') {
		alert("Please enter a donation dollar value\nthen click Make Donation again.");
	} else window.location = getCheckoutUrl();
	return false;
}
