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
	$qry = "SELECT * FROM crew WHERE crew_id='".clean($_POST['activeMemberSelect'])."'";
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
		$member_data['driver_license'] = $member['driverslicense'];
		$member_data['nr'] = $member['nr'];
		$member_data['started'] = $member['started'];
		$member_data['board'] = $member['board'];
		$member_data['boardrole'] = $member['boardrole'];
		$member_data['chief'] = $member['chief'];
		$member_data['assistant_chief'] = $member['assistantchief'];
		$member_data['assignment_in_trust'] = $member['assignmentintrust'];
		$member_data['other_firedept'] = $member['otherfiredept'];
		$member_data['ext_man'] = $member['extman'];
		$member_data['resc_man'] = $member['rescman'];
		$member_data['smoke_diver'] = $member['smokediver'];
		$member_data['active_smoke_diver'] = $member['activesmokediver'];
		$member_data['basic_ff'] = $member['basicff'];		
		$member_data['high_work'] = $member['highwork'];
		$member_data['surface_rescue'] = $member['surfacerescue'];
		$member_data['first_aid'] = $member['firstaid'];
		$member_data['oxygen'] = $member['oxygen'];
		$member_data['chief_edu'] = $member['chiefedu'];		
		$member_data['unit_commander'] = $member['unitcommander'];
		$member_data['other_education'] = $member['othereducation'];
		$member_data['junior_education'] = $member['junioredusummary'];
		$member_data['uleborg_test'] = $member['uleborgtest'];
		$member_data['uleborg_test_result'] = $member['uleborgresult'];
		$member_data['belastn_ekg'] = $member['belastnekg'];	
		$member_data['belastn_ekg_result'] = $member['belastnekgresult'];	
		$member_data['five_year_pin'] = $member['fiveyearpin'];
		$member_data['ten_year_pin'] = $member['tenyearpin'];
		$member_data['twenty_year_pin'] = $member['twentyyearpin'];
		$member_data['thirty_year_pin'] = $member['thirtyyearpin'];		
		$member_data['special_pin'] = $member['specialpin'];
		$member_data['other_award'] = $member['otheraward'];
		$member_data['selected_member'] = $_POST['activeMemberSelect'];

		//Store new member data array as Session
		$_SESSION['MEMBER_DATA'] = $member_data;
		
		session_write_close();
		ob_clean();
		header("location: edit-member.php");
		exit();
	} else {
		die(mysql_error());
	}
?>