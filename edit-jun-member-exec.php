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
	$member_data['year'] = $_POST['year'];
	$member_data['month'] = $_POST['month'];
	$member_data['day'] = $_POST['day'];
	$member_data['dob'] = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
	$member_data['phone'] = $_POST['phone'];
	$member_data['nameice'] = $_POST['nameice'];
	$member_data['ice'] = $_POST['ice'];
	$member_data['email'] = $_POST['email'];
	$member_data['size'] = $_POST['size'];
	$member_data['started'] = $_POST['startYearSelect'];
	$member_data['beginners_course'] = $_POST['begYearSelect'];
	$member_data['lvl_one'] = $_POST['lvlOneYearSelect'];
	$member_data['lvl_two'] = $_POST['lvlTwoYearSelect'];
	$member_data['lvl_three'] = $_POST['lvlThreeYearSelect'];
	$member_data['lvl_four'] = $_POST['lvlFourYearSelect'];
	$member_data['jun_unit_commander'] = $_POST['junUnitCommanderYearSelect'];
	$member_data['education'] = $_POST['educationYearSelect'];
	$member_data['selected_member'] = $_SESSION['MEMBER_DATA']['selected_member'];

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
	if($member_data['nameice'] == '') {
		$errmsg_arr[] = 'Förälders namn saknas';
		$errflag = true;
	}	
	if($member_data['ice'] == '') {
		$errmsg_arr[] = 'Förälders telefonnummer saknas';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to tedit-jun-member
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		ob_clean();	
		header("location: edit-jun-member.php");
		exit();
	}
	
	//Create UPDATE query
	$qry = "UPDATE crew SET firstname='".clean($member_data['fname'])."',lastname='".clean($member_data['lname'])."',dob='".clean($member_data['dob'])."',phone='".clean($member_data['phone'])."',email='".clean($member_data['email'])."',started='".clean($member_data['started'])."',juniorstarted='".clean($member_data['started'])."',nameice='".clean($member_data['nameice'])."',ice='".clean($member_data['ice'])."',size='".clean($member_data['size'])."',beginner='".clean($member_data['beginners_course'])."',lvlone='".clean($member_data['lvl_one'])."',lvltwo='".clean($member_data['lvl_two'])."',lvlthree='".clean($member_data['lvl_three'])."',lvlfour='".clean($member_data['lvl_four'])."',jununitcommander='".clean($member_data['jun_unit_commander'])."',education='".clean($member_data['education'])."' WHERE crew_id='".clean($_SESSION['MEMBER_DATA']['selected_member'])."'";
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		//Set session variable, catch it in calling file to decide wether this script is successfull or not
		$_SESSION['SUBMIT_SUCCESS'] = true;
		unset($_SESSION['MEMBER_DATA']);
		session_write_close();
		ob_clean();
		header("location: edit-jun-member.php");
		exit();
	}else {
		die(mysql_error());
	}
?>