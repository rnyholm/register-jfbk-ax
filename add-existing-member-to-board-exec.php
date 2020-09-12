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
	$fl = substr($_POST['noBoardMemberSelect'], 0, 1);
	
	//Switch through alternatives and select the correct sql query
	switch($fl) {
		case('S'):
			$qry = "UPDATE crew SET board='yes',boardrole='".clean($_POST['boardrole'])."' WHERE crew_id='".clean(substr($_POST['noBoardMemberSelect'],1))."'";
			break;
		default:
			//DO NOTHING!
	}
	
	//Run query
	$result = @mysql_query($qry);

	//Check whether the query was successful or not
	if($result) {
		//Set session variable, catch it in calling file to decide wether this script is successfull or not
		$_SESSION['SUBMIT_SUCCESS'] = true;
		unset($_SESSION['MEMBER_DATA']);
		session_write_close();
		ob_clean();
		header("location: add-existing-member-to-board.php");
		exit();
	}else {
		die(mysql_error());
	}
?>