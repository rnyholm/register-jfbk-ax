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

	//Query to get all information about a member
	$qry = "SELECT * FROM crew WHERE crew_id='".clean($_POST['activeJunMemberSelect'])."'";
	$result = @mysql_query($qry);
	
	if($result) {
		$member = mysql_fetch_assoc($result);
		
		//Array to store new member form data in
		$member_data['fname'] = $member['firstname'];
		$member_data['lname'] = $member['lastname'];
		$member_data['year'] = substr($member['dob'],-10,4);
		$member_data['month'] = substr($member['dob'],-5,2);
		$member_data['day'] = substr($member['dob'],-2,2);
		$member_data['phone'] = $member['phone'];
		$member_data['nameice'] = $member['nameice'];
		$member_data['ice'] = $member['ice'];
		$member_data['email'] = $member['email'];
		$member_data['size'] = $member['size'];
		$member_data['started'] = $member['started'];
		$member_data['beginners_course'] = $member['beginner'];
		$member_data['lvl_one'] = $member['lvlone'];
		$member_data['lvl_two'] = $member['lvltwo'];
		$member_data['lvl_three'] = $member['lvlthree'];
		$member_data['lvl_four'] = $member['lvlfour'];
		$member_data['jun_unit_commander'] = $member['jununitcommander'];
		$member_data['education'] = $member['education'];
		$member_data['selected_member'] = $_POST['activeJunMemberSelect'];

		//Store new member data array as Session
		$_SESSION['MEMBER_DATA'] = $member_data;
		
		session_write_close();
		ob_clean();
		header("location: edit-jun-member.php");
		exit();
	} else {
		die(mysql_error());
	}
?>