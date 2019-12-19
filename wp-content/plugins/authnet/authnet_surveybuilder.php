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

$surveys = array();
$surveys = json_decode(get_option("authnet_surveys"));

$plugindir   = dirname(plugin_basename(__FILE__));
$authnet_basedir =  get_settings('siteurl') . '/wp-content/plugins/'.$plugindir;

if($_GET['cmd'] == 'DeleteSurvey'){
	$surveyName = trim(mysql_real_escape_string($_GET['surveyName']));
	$newsurveys = array();
	if($surveyName != ''){
		foreach($surveys as $survey){
			if($survey->surveyName != $surveyName){
				$newsurveys[] = $survey;
			}
		}
		update_option("authnet_surveys", json_encode($newsurveys));
	}
}
if($_GET['cmd'] == 'DeleteItem'){
	$surveyName = trim(mysql_real_escape_string($_GET['surveyName']));
	$itemName = trim(mysql_real_escape_string($_GET['itemName']));
	$newitems = array();
	if($surveyName != '' && $itemName != '' ){
		$survey = get_survey($surveyName, $surveys);
		$surveyItems = $survey->surveyItems;
		foreach($surveyItems as $surveyItem){
			if($surveyItem->itemName != $itemName){
				$newitems[] = $surveyItem;
			}
		}
		
		$survey->surveyItems = $newitems;
		
		$surveys = update_survey($survey, $surveys);
		update_option("authnet_surveys", json_encode($surveys));
	}
}
elseif($_POST['cmd'] == 'UpdateSurvey'){
	$surveyName = trim(mysql_real_escape_string($_POST['surveyName']));
	$oldsurveyName = trim(mysql_real_escape_string($_POST['oldsurveyName']));
	if($surveyName == ''){
		$error1 = "Survey Name cannot be left blank.";
	}
	else{
		if(check_surveyName($oldsurveyName, $surveys)){
			$survey = get_survey($oldsurveyName, $surveys);
			$survey->surveyName = $surveyName;
			update_option("authnet_surveys", json_encode($surveys));
		}
	}
}
elseif($_POST['cmd'] == 'AddSurvey'){
	$surveyName = trim(mysql_real_escape_string($_POST['surveyName']));
	if($surveyName == ''){
		$error1 = "Survey Name cannot be left blank.";
	}
	elseif(check_surveyName($surveyName, $surveys)){
		$error1 = "Survey Name already exists.";
	}
	else{
		$survey['surveyName'] = $surveyName;
		$survey['surveyItems'] = Array();
		$surveys[] = $survey;
		update_option("authnet_surveys", json_encode($surveys));
	}
}
elseif($_POST['cmdItem'] == "posted"){
	$surveyName = trim(mysql_real_escape_string($_POST['surveyName']));
	$itemName = trim(mysql_real_escape_string($_POST['itemName']));
	$itemValueType = trim(mysql_real_escape_string($_POST['itemValueType']));	
	$itemRequired = trim(mysql_real_escape_string($_POST['itemRequired']));
	
	if($surveyName == '') {
			$error = 'Please select a Survey.';
	}
	elseif($itemName == '') {
			$error = 'Item name should not be left blank.';
	}
	else{		
		$itemValueType = $_POST['itemValueType'];	
		
		if($itemValueType == 'select'){
			$options1 = $_POST['txt'];
		}
		elseif($itemValueType == 'radio'){
			$options1 = $_POST['txt'];
		}
		

		for($i = 0; $i < count($options1)+1; $i++){
			if($options1[$i] != '' ){
				$itemOptions[] = $options1[$i];
			}
		}

		$survey_item['itemName'] = $itemName;
		$survey_item['itemValueType'] = $itemValueType;
		$survey_item['itemRequired'] = $itemRequired;
		$survey_item['itemOptions'] = $itemOptions;
		
		$survey = get_survey($surveyName, $surveys);
		
		$surveyItems = $survey->surveyItems;
		
		$surveyItems = update_surveyItem($survey_item, $surveyItems);
		
		$survey->surveyItems = $surveyItems;
		
		$surveys = update_survey($survey, $surveys);
		
		update_option("authnet_surveys", json_encode($surveys));

		$success = true;
	}
}





$surveys = json_decode(get_option("authnet_surveys"));

if($_GET['cmd'] == 'EditSurvey'){
	$savemode = 'UpdateSurvey';
	$msurveyName = trim(mysql_real_escape_string($_GET['surveyName']));
}
else{
	$savemode = 'AddSurvey';
}


?>

	<div class="wrap" style="width: 700px;">
		<h2>Survey Builder</h2>
		<p></p>
		
    <form name="frmsurveys" method="post" action="?page=authnet_render_surveybuilder">
		<fieldset>
		<legend>Add/Edit Survey</legend>
    <input type="hidden" name="cmd" value="<?php echo $savemode; ?>" />
    <input type="hidden" name="oldsurveyName" value="<?php echo $msurveyName; ?>" />
<?php
	if($error1) echo $error1;
?>    
			<label for="authnet_surveyname">Survey Name: </label>
				<input id="authnet_surveyname" type="text" name="surveyName" value="<?php echo $msurveyName; ?>" size="30" /><br />
			<label>&nbsp;</label>
				<input type="submit" value="Save" /></td>
	</fieldset>
	<br />
		<legend>Surveys</legend>
    <table style="width:600px;">
    	<tr>
      	<th>Surveys &amp; Survey Items</th>
        <th>Actions</th>
      </tr>
<?php
	if ($surveys) {
		foreach($surveys as $survey){
?>
      <tr>
				<td><b><?php echo $survey->surveyName; ?></b></td>
				<td><a href="?page=authnet_render_surveybuilder&cmd=EditSurvey&surveyName=<?php echo $survey->surveyName; ?>"><img src="<?php echo $authnet_basedir; ?>/images/b_edit.png" width="16" height="16" title="Edit Survey" /></a>        
        <img src="<?php echo $authnet_basedir; ?>/images/b_drop.png" width="16" height="16" title="Delete Survey" style="cursor:pointer"
        			onclick="javascript:delsurvey('<?php echo $survey->surveyName; ?>');" />
        </td>
      </tr>
      
<?php
			if(is_array($survey->surveyItems)){
				foreach($survey->surveyItems as $survey_item){
?>
      <tr>
				<td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;<?php echo $survey_item->itemName; ?></td>
				<td>
        
        <a href="?page=authnet_render_surveybuilder&cmd=EditItem&surveyName=<?php echo $survey->surveyName; ?>&itemName=<?php echo $survey_item->itemName; ?>"><img src="<?php echo $authnet_basedir; ?>/images/b_edit.png" width="16" height="16" title="Edit Survey Item" /></a>
        <img src="<?php echo $authnet_basedir; ?>/images/b_drop.png" width="16" height="16" title="Delete Survey Item" style="cursor:pointer"
        			onclick="javascript:delsurveyitem('<?php echo $survey->surveyName; ?>','<?php echo $survey_item->itemName; ?>');" />
      </tr>
<?php			
				}
			}
		}
	}
?>
    </table>
    </form>
<br />

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
<script language="javascript">
	$(document).ready(function(){
		if($('#itemValueType').val() == 'select') {
			$('#attr').show();
		}
		else{
			$('#attr').hide();
		}
		$('#dflt').show();
		$('#itemValueType').change(function() {
			$('#attr').hide();
			$('#dflt').show();
			if($(this).val() == 'select' ) {
				$('#attr').show();
			}
		});
	});

var func = {
    validate:function (el) {
        if (el.itemName.value=='') {
            alert ('Item name required.');
            el.itemName.focus();
            return false;
        }
    }
}
function addRow(tableID) {

	var table = document.getElementById(tableID);

	var rowCount = table.rows.length;
	var row = table.insertRow(rowCount);

	var cell1 = row.insertCell(0);
	var element1 = document.createElement("input");
	element1.type = "checkbox";
	cell1.appendChild(element1);

	var cell1 = row.insertCell(1);
	var element2 = document.createElement("input");
	element2.type = "text";
	element2.id = "txt";
	element2.name = "txt[]";
	cell1.appendChild(element2);

}

function deleteRow(tableID) {
	try {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;

	for(var i=0; i<rowCount; i++) {
		var row = table.rows[i];
		var chkbox = row.cells[0].childNodes[0];
		if(null != chkbox && true == chkbox.checked) {
			table.deleteRow(i);
			rowCount--;
			i--;
		}

	}
	}catch(e) {
		alert(e);
	}
}


function delsurvey(surveyname){
	cf = confirm("Are you sure you want to delete this survey and its items?");
	if(cf){
		window.location.href= "?page=authnet_render_surveybuilder&cmd=DeleteSurvey&surveyName="+surveyname;
	}
	return false;
}
function delsurveyitem(surveyname, itemname){
	cf = confirm("Are you sure you want to delete this survey item?");
	if(cf){
		window.location.href= "?page=authnet_render_surveybuilder&cmd=DeleteItem&surveyName="+surveyname+"&itemName="+itemname;
	}
	return false;
}


</script>


<?php
	if($_GET['cmd'] == 'EditItem') {
		$ItemToEdit = $_GET['itemName'];
		$surveyName = $_GET['surveyName'];
		if($surveyName && $ItemToEdit){
			$thesurvey = get_survey($surveyName, $surveys);
			$surveyItems = $thesurvey->surveyItems;
			$thesurveyItem = get_surveyItem($ItemToEdit, $surveyItems);
			
			$itemName = $thesurveyItem->itemName;
			$itemValueType = $thesurveyItem->itemValueType;
			$itemRequired = $thesurveyItem->itemRequired;
			$itemOptions = $thesurveyItem->itemOptions;
		}
	}

?>

    
    <form method="post" target="_self" action="?page=authnet_render_surveybuilder">

		<fieldset>
		<legend>Add / Edit Survey Items</legend>

		<input type="hidden" name="cmdItem" value="posted" />

			<label for="authnet_surveyname">Survey: </label>
				<select id="authnet_surveyname" name="surveyName">
<?php
	foreach($surveys as $survey){
?>
	<option value="<?php echo $survey->surveyName; ?>" <?php echo ($survey->surveyName == $surveyName)?"selected":""; ?> ><?php echo $survey->surveyName; ?></option>
<?php		
	}
?>
			</select><br />
			<label for="authnet_fieldname">Survey Item: </label>
				<input id="authnet_fieldname" type="text" value="<?php echo $itemName; ?>" name="itemName" /><br />

			<label for="authnet_required">Field Type: </label>
				<select name="itemValueType" id="itemValueType">
				  <option value="text" <?php echo ($itemValueType == 'text')?"selected":""; ?> >Text Field</option>
				  <option value="textarea" <?php echo ($itemValueType == 'textarea')?"selected":""; ?>>Text Area</option>
				  <option value="select" <?php echo ($itemValueType == 'select')?"selected":""; ?>>Select</option>
				</select><br />
				
		<div id="attr">
			<label for="authnet_required">Values: </label>
            <input type="button" value="Add" onClick="addRow('dataTable')" />
            <input type="button" value="Delete" onClick="deleteRow('dataTable')" /><br />
            
			<label for="authnet_required">&nbsp;</label>
			<table id="dataTable" border="0">
<?php
	if(count($itemOptions) > 0){
		for($i = 0; $i < count($itemOptions)+1; $i++){
?>            
              <tr>
                <td><input type="checkbox" name="chk"/></td>
                <td><input type="text" name="txt[<?php echo $i; ?>]" id="txt" value="<?php echo $itemOptions[$i]; ?>" /></td>
              </tr>
<?php
		}
	}
	else{
?>
              <tr>
                <td><input type="checkbox" name="chk"/></td>
                <td><input type="text" name="txt[]" id="txt" /></td>
              </tr>
<?php
	}
?>
            </table>
        </div>

			<label for="authnet_required">Required: </label>
<?php
	if($itemRequired == '') $itemRequired = 'No';
?>
				<input id="authnet_required" type="radio" name="itemRequired" value="Yes" <?php echo ($itemRequired == 'Yes')?'checked="checked"':""; ?> >Yes
				<input id="authnet_required" type="radio" name="itemRequired" value="No" <?php echo ($itemRequired == 'No')?'checked="checked"':""; ?> >No
				<br />

			<label>&nbsp;</label>
            <input type="hidden" value="add" name="action" />
            <input type="hidden" value="1" name="formid" />
            <input type="hidden" value="" name="id" />
            <input type="submit" value="Submit" name="submit" /><br />
	  </fieldset>
    </form>



	</div>


<?php
	function check_surveyName($surveyName, $surveys){
		$found = false;
		if ($surveys) {
			foreach($surveys as $survey){
				if($survey->surveyName == $surveyName){
					$found = true;
					break;
				}
			}
		}
		return $found;
	}

	function get_survey($surveyName, $surveys){
		$survey = '';
		foreach($surveys as $survey){
			if($survey->surveyName == $surveyName){
				$found = true;
				break;
			}
		}
		if($found){
			return $survey;
		}
		else{
			return '';
		}
	}

	function find_itemName($itemName, $surveyItems){
		$found = false;
		foreach($surveyItems as $surveyItem){
			if($surveyItem->itemName == $itemName){
				$found = true;
				break;
			}
		}
		return $found;
	}

	function update_survey($newsurvey, $surveys){
		$newsurveys = array();
		foreach($surveys as $survey){
			if($survey->surveyName == $newsurvey->surveyName){
				$newsurveys[] = $newsurvey;
				$updated = true;
			}
			else{
				$newsurveys[] = $survey;
			}
		}
		if(!$updated){
			$newsurveys[] = $newsurvey;
		}
		return $newsurveys;
	}


	function update_surveyItem($newitem, $surveyItems){
		$newsurveyItems = array();
		foreach($surveyItems as $survey_item){
			if($survey_item->itemName == $newitem['itemName']){
				$newsurveyItems[] = $newitem;
				$updated = true;
			}
			else{
				$newsurveyItems[] = $survey_item;
			}
		}
		if(!$updated){
			$newsurveyItems[] = $newitem;
		}
		return $newsurveyItems;
	}

	function get_surveyItem($itemName, $surveyItems){
		$found = false;
		foreach($surveyItems as $surveyItem){
			if($surveyItem->itemName == $itemName){
				$found = true;
				break;
			}
		}
		if($found){
			return $surveyItem;
		}
		else{
			return '';
		}
	}


?>