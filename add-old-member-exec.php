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
	
	/*Radio button group for board choices*/
	if($_POST['boardradio'] == 'yes') {
		$member_data['board'] = 'yes';
	} else {
		$member_data['board'] = 'no';
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
	$member_data['started'] = $_POST['startYearSelect'];
	$member_data['boardrole'] = $_POST['boardrole'];
	$member_data['assignment_in_trust'] = $_POST['trustassignment'];
	$member_data['other_firedept'] = $_POST['other_firedept'];
	$member_data['other_education'] = $_POST['other_educationt'];
	$member_data['senior_education'] = $_POST['senior_education'];
	$member_data['junior_education'] = $_POST['junior_education'];
	//$member_data['awards'] = $_POST['awards'];	
	$member_data['five_year_pin'] = $_POST['5_year'];
	$member_data['ten_year_pin'] = $_POST['10_year'];
	$member_data['twenty_year_pin'] = $_POST['20_year'];
	$member_data['thirty_year_pin'] = $_POST['30_year'];
	$member_data['special_pin'] = $_POST['special_pin'];
	$member_data['other_award'] = $_POST['other_awards'];

	//Store edited member data array as Session
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
	if($member_data['phone'] == '') {
		$errmsg_arr[] = 'Telefonnummer saknas';
		$errflag = true;
	}
	if($member_data['nameice'] == '') {
		$errmsg_arr[] = 'Närmsta anhörig saknas';
		$errflag = true;
	}
	if($member_data['ice'] == '') {
		$errmsg_arr[] = 'Närmsta anhörigs telefonnummer saknas';
		$errflag = true;
	}							
	
	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		ob_clean();	
		header("location: add-old-member.php");
		exit();
	}
	
	//Create INSERT query
	$qry = "INSERT INTO crew(type,firstname,lastname,dob,phone,nameice,ice,email,started,oldboystarted,board,boardrole,assignmentintrust,senioredusummary,junioredusummary,othereducation,otherfiredept,fiveyearpin,tenyearpin,twentyyearpin,thirtyyearpin,specialpin,otheraward) VALUES('oldboy','".clean($member_data['fname'])."','".clean($member_data['lname'])."','".clean($member_data['dob'])."','".clean($member_data['phone'])."','".clean($member_data['nameice'])."','".clean($member_data['ice'])."','".clean($member_data['email'])."','".clean($member_data['started'])."','".clean($member_data['started'])."','".clean($member_data['board'])."','".clean($member_data['boardrole'])."','".clean($member_data['assignment_in_trust'])."','".clean($member_data['senior_education'])."','".clean($member_data['junior_education'])."','".clean($member_data['other_education'])."','".clean($member_data['other_firedept'])."','".clean($member_data['five_year_pin'])."','".clean($member_data['ten_year_pin'])."','".clean($member_data['twenty_year_pin'])."','".clean($member_data['thirty_year_pin'])."','".clean($member_data['special_pin'])."','".clean($member_data['other_award'])."')";
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		//Set session variable, catch it in calling file to decide wether this script is successfull or not
		$_SESSION['SUBMIT_SUCCESS'] = true;
		unset($_SESSION['MEMBER_DATA']);
		session_write_close();
		ob_clean();
		header("location: add-old-member.php");
		exit();
	}else {
		die(mysql_error());
	}
?>