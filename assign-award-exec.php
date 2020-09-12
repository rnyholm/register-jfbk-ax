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
	
	//Array to store new member form data in
	$member_data['five_year_pin'] = $_POST['5_year'];
	$member_data['ten_year_pin'] = $_POST['10_year'];
	$member_data['twenty_year_pin'] = $_POST['20_year'];
	$member_data['thirty_year_pin'] = $_POST['30_year'];	
	$member_data['special_pin'] = $_POST['special_pin'];
	$member_data['other_award'] = $_POST['other_awards'];	
	$member_data['selected_member'] = $_SESSION['MEMBER_DATA']['selected_member'];

	//Store edited member data array as Session
	$_SESSION['MEMBER_DATA'] = $member_data;
	
	//If there are input validations, redirect back to the edit-member site
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		ob_clean();	
		header("location: edit-member.php");
		exit();
	}
	
	//Create UPDATE query
	$qry = "UPDATE crew SET fiveyearpin='".clean($member_data['five_year_pin'])."',tenyearpin='".clean($member_data['ten_year_pin'])."',twentyyearpin='".clean($member_data['twenty_year_pin'])."',thirtyyearpin='".clean($member_data['thirty_year_pin'])."',specialpin='".clean($member_data['special_pin'])."',otheraward='".clean($member_data['other_award'])."' WHERE crew_id='".clean($_SESSION['MEMBER_DATA']['selected_member'])."'";
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		//Set session variable, catch it in calling file to decide wether this script is successfull or not
		$_SESSION['SUBMIT_SUCCESS'] = true;
		unset($_SESSION['MEMBER_DATA']);
		session_write_close();
		ob_clean();
		header("location: assign-award.php");
		exit();
	}else {
		die(mysql_error());
	}
?>