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

	//If there are input validations, redirect back to add-jun-member
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		ob_clean();	
		header("location: add-jun-member.php");
		exit();
	}
	
	//Create INSERT query
	$qry = "INSERT INTO crew(type,firstname,lastname,dob,phone,email,started,juniorstarted,nameice,ice,size,beginner,lvlone,lvltwo,lvlthree,lvlfour,jununitcommander,education) VALUES('junior','".clean($member_data['fname'])."','".clean($member_data['lname'])."','".clean($member_data['dob'])."','".clean($member_data['phone'])."','".clean($member_data['email'])."','".clean($member_data['started'])."','".clean($member_data['started'])."','".clean($member_data['nameice'])."','".clean($member_data['ice'])."','".clean($member_data['size'])."','".clean($member_data['beginners_course'])."','".clean($member_data['lvl_one'])."','".clean($member_data['lvl_two'])."','".clean($member_data['lvl_three'])."','".clean($member_data['lvl_four'])."','".clean($member_data['jun_unit_commander'])."','".clean($member_data['education'])."')";
	$result = @mysql_query($qry);

	//Check whether the query was successful or not
	if($result) {
		//Set session variable, catch it in calling file to decide wether this script is successfull or not
		$_SESSION['SUBMIT_SUCCESS'] = true;
		unset($_SESSION['MEMBER_DATA']);
		session_write_close();
		ob_clean();
		header("location: add-jun-member.php");
		exit();
	}else {
		die(mysql_error());
	}
?>