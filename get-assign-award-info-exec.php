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
	$qry = "SELECT * FROM crew WHERE crew_id='".clean($_POST['memberOldMemberSelect'])."'";
	$result = @mysql_query($qry);
	
	if($result) {
		$member = mysql_fetch_assoc($result);
		
		//Array to store new member form data in
		$member_data['name'] = $member['firstname'].' '.$member['lastname'];
		$member_data['dob'] = substr($member['dob'],-2,2).'.'.substr($member['dob'],-5,2).'-'.substr($member['dob'],-10,4);
		$member_data['age'] = calculate_age($member['dob']);
		$member_data['five_year_pin'] = $member['fiveyearpin'];
		$member_data['ten_year_pin'] = $member['tenyearpin'];
		$member_data['twenty_year_pin'] = $member['twentyyearpin'];
		$member_data['thirty_year_pin'] = $member['thirtyyearpin'];		
		$member_data['special_pin'] = $member['specialpin'];
		$member_data['other_award'] = $member['otheraward'];
		$member_data['selected_member'] = $_POST['memberOldMemberSelect'];

		//Store new member data array as Session
		$_SESSION['MEMBER_DATA'] = $member_data;
		
		session_write_close();
		ob_clean();
		header("location: assign-award.php");
		exit();
	} else {
		die(mysql_error());
	}
?>