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
	$member_data['fname'] = $_POST['firstname'];
	$member_data['lname'] = $_POST['lastname'];
	$member_data['phone'] = $_POST['phone'];
	$member_data['email'] = $_POST['email'];
	$member_data['boardrole'] = $_POST['boardrole'];
	$member_data['selected_member'] = $_SESSION['MEMBER_DATA']['selected_member'];
	$member_data['boardmember_type'] = $_SESSION['MEMBER_DATA']['boardmember_type'];

	//Store new member data array as Session
	$_SESSION['MEMBER_DATA'] = $member_data;
	
	//Check for input Validations
	if($member_data['fname'] == '') {
		$errmsg_arr[] = 'Förnamn saknas';
		$errflag = true;
	}
	if($member_data['lname'] == '') {
		$errmsg_arr[] = 'Efternamn saknas';
		$errflag = true;
	}	

	//If there are input validations, redirect back to add-jun-member
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		ob_clean();	
		header("location: edit-board-member.php");
		exit();
	}
	
	//Create UPDATE query
	if($member_data['boardmember_type'] == 'E') {
		$qry = "UPDATE extboardmembers SET firstname='".clean($member_data['fname'])."',lastname='".clean($member_data['lname'])."',phone='".clean($member_data['phone'])."',email='".clean($member_data['email'])."',boardrole='".clean($member_data['boardrole'])."' WHERE board_id='".clean(substr($member_data['selected_member'],1))."'";
	} else if($member_data['boardmember_type'] == 'C') {
		$qry = "UPDATE crew SET firstname='".clean($member_data['fname'])."',lastname='".clean($member_data['lname'])."',phone='".clean($member_data['phone'])."',email='".clean($member_data['email'])."',boardrole='".clean($member_data['boardrole'])."' WHERE crew_id='".clean(substr($member_data['selected_member'],1))."'";
	} 

	$result = @mysql_query($qry) or die(mysql_error());

	//Check whether the query was successful or not
	if($result) {
		//Set session variable, catch it in calling file to decide wether this script is successfull or not
		$_SESSION['SUBMIT_SUCCESS'] = true;
		unset($_SESSION['MEMBER_DATA']);
		session_write_close();
		ob_clean();
		header("location: edit-board-member.php");
		exit();
	}else {
		die(mysql_error());
	}
?>