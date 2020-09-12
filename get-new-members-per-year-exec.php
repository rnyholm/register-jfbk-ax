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
	
	//Variable to store number of members
	$members = 0;
	
	//Query to get all information abour members that started a specific year
	$qry = "SELECT * FROM crew WHERE seniorstarted='".clean($_POST['startYearSelect'])."'";
	$result = @mysql_query($qry);
	
	if($result) {	
		//Loop through results from database to count members
		while($row = mysql_fetch_array($result)) {
			//Count members
			$members++;
		}
		
		//Store string containing information about new senior members per year
		$member_data['new_sen_members_per_year'] = "År ".$_POST['startYearSelect']." fick alarmavdelningen <b><u>".$members."</u></b> nya medlemmar.";

		//Store new member data array as Session
		$_SESSION['MEMBER_DATA'] = $member_data;
		
		session_write_close();
		ob_clean();
		header("location: get-new-members-per-year.php");
		exit();
	} else {
		die(mysql_error());
	}
?>