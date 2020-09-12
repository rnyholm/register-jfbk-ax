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
	$qry = "SELECT * FROM crew WHERE crew_id='".clean($_POST['smokediverSelect'])."'";
	$result = @mysql_query($qry);
	
	if($result) {
		$member = mysql_fetch_assoc($result);
		
		//Array to store new member form data in
		$member_data['nr'] = $member['nr'];
		$member_data['name'] = $member['firstname'].' '.$member['lastname'];
		$member_data['smoke_diver'] = $member['smokediver'];
		$member_data['active_smoke_diver'] = $member['activesmokediver'];
		$member_data['basic_ff'] = $member['basicff'];
		$member_data['uleborg_test'] = $member['uleborgtest'];
		$member_data['uleborg_test_result'] = $member['uleborgresult'];
		$member_data['belastn_ekg'] = $member['belastnekg'];
		$member_data['belastn_ekg_result'] = $member['belastnekgresult'];		
		$member_data['selected_member'] = $_POST['smokediverSelect'];

		//Store new member data array as Session
		$_SESSION['MEMBER_DATA'] = $member_data;
		
		session_write_close();
		ob_clean();
		header("location: edit-smokediver.php");
		exit();
	} else {
		die(mysql_error());
	}
?>