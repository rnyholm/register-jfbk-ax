<?php
	//Run the authentication script
	require_once('auth.php');
	
	//To handle output buffer
	ob_start();
	
	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');
	
	//Include functions
	require_once('functions.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	
	/*Radio button group for active smokediver choices*/
	if($_POST['activesmokediverradio'] == 'yes') {
		$member_data['active_smoke_diver'] = 'yes';
	} else {
		$member_data['active_smoke_diver'] = 'no';
	}
	
	/*Radio button group for uleborg test result*/
	if($_POST['uleborg_result_radio'] == 'passed') {
		$member_data['uleborg_test_result'] = 'passed';
	} else {
		$member_data['uleborg_test_result'] = 'failed';
	}
	
	/*Radio button group for belastn ekg result*/
	if($_POST['belastn_ekg_result_radio'] == 'passed') {
		$member_data['belastn_ekg_result'] = 'passed';
	} else {
		$member_data['belastn_ekg_result'] = 'failed';
	}
	
	//Array to store new member form data in
	$member_data['smoke_diver'] = $_POST['smokeDiveYearSelect'];
	$member_data['basic_ff'] = $_POST['basicffYearSelect'];	
	$member_data['uleborg_test'] = $_POST['uleborgTest'];
	$member_data['belastn_ekg'] = $_POST['belastnEkg'];		
	$member_data['selected_member'] = $_SESSION['MEMBER_DATA']['selected_member'];

	//Store edited member data array as Session
	$_SESSION['MEMBER_DATA'] = $member_data;						
	
	//If there are input validations, redirect back to the edit-member site
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		ob_clean();	
		header("location: edit-smokediver.php");
		exit();
	}
	
	//Create UPDATE query
	$qry = "UPDATE crew SET uleborgtest='".clean($member_data['uleborg_test'])."',uleborgresult='".clean($member_data['uleborg_test_result'])."',belastnekg='".clean($member_data['belastn_ekg'])."',belastnekgresult='".clean($member_data['belastn_ekg_result'])."',smokediver='".clean($member_data['smoke_diver'])."',activesmokediver='".clean($member_data['active_smoke_diver'])."',basicff='".clean($member_data['basic_ff'])."' WHERE crew_id='".clean($_SESSION['MEMBER_DATA']['selected_member'])."'";
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		//Set session variable, catch it in calling file to decide wether this script is successfull or not
		$_SESSION['SUBMIT_SUCCESS'] = true;
		unset($_SESSION['MEMBER_DATA']);
		session_write_close();
		ob_clean();
		header("location: edit-smokediver.php");
		exit();
	}else {
		die(mysql_error());
	}
?>