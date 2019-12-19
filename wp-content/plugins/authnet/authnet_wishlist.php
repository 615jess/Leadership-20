<?php

// function to send request and obtain response
function postCURLRequest ($postURL, $data) {
	global $log;
	// send data to post URL
	$log->LogDebug("\postURL = ".$postURL);	
	$ch = curl_init ($postURL);
	curl_setopt ($ch, CURLOPT_POST, true);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	$returnValue = curl_exec ($ch);
	$log->LogDebug("returnValue: ".$returnValue);
	return $returnValue;
}

// function to send GET request and obtain a response
function getCURLRequest ($getURL) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $getURL);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec($ch);
	curl_close($ch);
	return $response;
}

// function to prepare hash
function generateHash ($data, $secretKey) {
	global $log;
	// generate the hash
	$delimiteddata = strtoupper (implode ('|', $data));
	$log->LogDebug("delimiteddata: ".$delimiteddata);
	$log->LogDebug("hashstring: ".$data['cmd'] . '__' . $secretKey . '__' . $delimiteddata);
	$hash = md5 ($data['cmd'] . '__' . $secretKey . '__' . $delimiteddata);
	$log->LogDebug("hash: ".$hash);
	return $hash;
}
// WLMAPI helper functions
function executeWLMAPICall ($functionname, $params) {
	global $log, $secretKey;
	$log->LogDebug("params: ".print_r($params, true));
	$log->LogDebug("prehash: ".$functionname.'__'.$secretKey.'__'.implode('|', $params));
	$hash = md5 ($functionname.'__'.$secretKey.'__'.implode('|', $params));
	// example: http://wishlist.masteringwordpressmembership.com/?WLMAPI=GetUserLevels/bf8be0d9ac3607e03dbb8a98c3eb379b/23
	$baseurl = get_bloginfo ('wpurl').'/?WLMAPI=';
	$encodedfunctioncall = array_merge (array($functionname, $hash), $params);
	$urltocall = $baseurl.implode('/', $encodedfunctioncall);
	$log->LogDebug("urltocall: ".$urltocall);
	$response = getCURLRequest($urltocall);
	return $response;
}
function getLevels () {
	global $log, $secretKey;
	$functionname = "GetLevels";
	$params = array();
	$levels = executeWLMAPICall ($functionname, $params);
	list ($status, $return) = unserialize($levels);
	if ($status) {
		$log->LogInfo("Success GetLevels: ".print_r($return, true));
		return $return;
	} else {
		$log->LogInfo("Failed to GetLevels from WLMAPI: ".$return);
		return false;
	}
}

function getUserLevels ($userid) {
	global $log, $secretKey;
	$functionname = "GetUserLevels";
	$params = array($userid);
	$levels = executeWLMAPICall ($functionname, $params);
	list ($status, $return) = unserialize($levels);
	if ($status) {
		$log->LogInfo("Success GetUserLevels: ".print_r($return, true));
		return $return;
	} else {
		$log->LogInfo("Failed to GetUserLevels from WLMAPI: ".$return);
		return false;
	}
}

function addUserLevels ($userid, $levels, $txid) {
	global $log, $secretKey;
	$functionname = "AddUserLevels";
	$params = array($userid, implode(',', $levels), $txid);
	$levels = executeWLMAPICall ($functionname, $params);
	list ($status, $return) = unserialize($levels);
	if ($status) {
		$log->LogInfo("Success AddUserLevels: ".print_r($return, true));
		return $return;
	} else {
		$log->LogInfo("Failed to AddUserLevels from WLMAPI: ".$return);
		return false;
	}
}

function makeActive ($userid) {
	global $log, $secretKey;
	$functionname = "MakeActive";
	$params = array($userid);
	$levels = executeWLMAPICall ($functionname, $params);
	list ($status, $return) = unserialize($levels);
	if ($status) {
		$log->LogInfo("Success MakeActive: ".print_r($return, true));
		return $return;
	} else {
		$log->LogInfo("Failed to MakeActive from WLMAPI: ".$return);
		return false;
	}
}

// WLM PluginMethods duplicated to correct
$valid_transaction_types = array ("onetime", "recurring", "failed", "cancelled", "refund");

?>