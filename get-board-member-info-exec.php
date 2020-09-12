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
	
	//Get first letter of crew_id to decide from which table we shall retreive data from
	$fl = substr($_POST['boardMemberSelect'], 0, 1);
	
	//Switch through alternatives and select the correct sql query
	switch($fl) {
		case('E'):
			$qry = "SELECT * FROM extboardmembers WHERE board_id='".clean(substr($_POST['boardMemberSelect'],1))."'";
			$member_data['boardmember_type'] = 'E';
			break;
		case('C'):
			$qry = "SELECT * FROM crew WHERE crew_id='".clean(substr($_POST['boardMemberSelect'],1))."'";
			$member_data['boardmember_type'] = 'C';
			break;
		default:
			//DO NOTHING!
	}
	
	//Run query
	$result = @mysql_query($qry);
	
	if($result) {
		$member = mysql_fetch_assoc($result);
		
		//Array to store new member form data in
		$member_data['fname'] = $member['firstname'];
		$member_data['lname'] = $member['lastname'];
		$member_data['phone'] = $member['phone'];
		$member_data['email'] = $member['email'];
		$member_data['boardrole'] = $member['boardrole'];
		$member_data['selected_member'] = $_POST['boardMemberSelect'];

		//Store new member data array as Session
		$_SESSION['MEMBER_DATA'] = $member_data;
		
		session_write_close();
		ob_clean();
		header("location: edit-board-member.php");
		exit();
	} else {
		die(mysql_error());
	}
?>