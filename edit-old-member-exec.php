<?php
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
	$member_data['five_year_pin'] = $_POST['5_year'];
	$member_data['ten_year_pin'] = $_POST['10_year'];
	$member_data['twenty_year_pin'] = $_POST['20_year'];
	$member_data['thirty_year_pin'] = $_POST['30_year'];
	$member_data['special_pin'] = $_POST['special_pin'];
	$member_data['other_award'] = $_POST['other_awards'];	
	//$member_data['awards'] = $_POST['awards'];	
	$member_data['selected_member'] = $_SESSION['MEMBER_DATA']['selected_member'];

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
		header("location: edit-old-member.php");
		exit();
	}
	
	//SELECT query to get the different start years, used later to update the startyear
	$qry = "SELECT started,juniorstarted,seniorstarted,oldboystarted FROM crew WHERE crew_id='".clean($_SESSION['MEMBER_DATA']['selected_member'])."'";
	$result = @mysql_query($qry) or die(mysql_error);
	
	$startyears = mysql_fetch_assoc($result);
	
	//Create appropriate query depending start years
	if($startyears['started'] == $startyears['juniorstarted']) {
		$qry = "UPDATE crew SET started='".clean($member_data['started'])."',juniorstarted='".clean($member_data['started'])."' WHERE crew_id='".clean($_SESSION['MEMBER_DATA']['selected_member'])."'";
	} else if ($startyears['started'] == $startyears['seniorstarted']) {
		$qry = "UPDATE crew SET started='".clean($member_data['started'])."',seniorstarted='".clean($member_data['started'])."' WHERE crew_id='".clean($_SESSION['MEMBER_DATA']['selected_member'])."'";
	} else {
		$qry = "UPDATE crew SET started='".clean($member_data['started'])."',oldboystarted='".clean($member_data['started'])."' WHERE crew_id='".clean($_SESSION['MEMBER_DATA']['selected_member'])."'";
	}
	
	//Do the query
	$result = @mysql_query($qry) or die(mysql_error);
	
	//Create UPDATE query
	$qry = "UPDATE crew SET firstname='".clean($member_data['fname'])."',lastname='".clean($member_data['lname'])."',dob='".clean($member_data['dob'])."',phone='".clean($member_data['phone'])."',email='".clean($member_data['email'])."',nameice='".clean($member_data['nameice'])."',ice='".clean($member_data['ice'])."',board='".clean($member_data['board'])."',boardrole='".clean($member_data['boardrole'])."',assignmentintrust='".clean($member_data['assignment_in_trust'])."',senioredusummary='".clean($member_data['senior_education'])."',junioredusummary='".clean($member_data['junior_education'])."',othereducation='".clean($member_data['other_education'])."',fiveyearpin='".clean($member_data['five_year_pin'])."',tenyearpin='".clean($member_data['ten_year_pin'])."',twentyyearpin='".clean($member_data['twenty_year_pin'])."',thirtyyearpin='".clean($member_data['thirty_year_pin'])."',specialpin='".clean($member_data['special_pin'])."',otheraward='".clean($member_data['other_award'])."',otherfiredept='".clean($member_data['other_firedept'])."' WHERE crew_id='".clean($_SESSION['MEMBER_DATA']['selected_member'])."'";
	$result = @mysql_query($qry) or die(mysql_error);

	//Set session variable, catch it in calling file to decide wether this script is successfull or not
	$_SESSION['SUBMIT_SUCCESS'] = true;
	unset($_SESSION['MEMBER_DATA']);
	session_write_close();
	ob_clean();
	header("location: edit-old-member.php");
	exit();
	
?>