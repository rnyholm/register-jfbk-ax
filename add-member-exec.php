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
	
	/*Radio button group for chief choices*/
	if($_POST['chiefradio'] == 'yes') {
		$member_data['chief'] = 'yes';
	} else {
		$member_data['chief'] = 'no';
	}
	
	/*Radio button group for assistant chief choices*/
	if($_POST['assistantchiefradio'] == 'yes') {
		$member_data['assistant_chief'] = 'yes';
	} else {
		$member_data['assistant_chief'] = 'no';
	}
	
	/*Radio button group for active smokediver choices*/
	if($_POST['activesmokediverradio'] == 'yes') {
		$member_data['active_smoke_diver'] = 'yes';
	} else {
		$member_data['active_smoke_diver'] = 'no';
	}
	
	/*Radio button group for uleborg test result*/
	if($_POST['uleborg_result_radio'] == 'passed') {
		$member_data['uleborg_test_result'] = 'passed';
	} else {
		$member_data['uleborg_test_result'] = 'failed';
	}
	
	/*Radio button group for belastn ekg result*/
	if($_POST['belastn_ekg_result_radio'] == 'passed') {
		$member_data['belastn_ekg_result'] = 'passed';
	} else {
		$member_data['belastn_ekg_result'] = 'failed';
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
	$member_data['driver_license'] = $_POST['driverlicense'];
	$member_data['nr'] = $_POST['crewnumber'];
	$member_data['started'] = $_POST['startYearSelect'];
	$member_data['boardrole'] = $_POST['boardrole'];
	$member_data['assignment_in_trust'] = $_POST['trustassignment'];
	$member_data['other_firedept'] = $_POST['other_firedept'];
	$member_data['ext_man'] = $_POST['extManYearSelect'];
	$member_data['resc_man'] = $_POST['rescManYearSelect'];
	$member_data['smoke_diver'] = $_POST['smokeDiveYearSelect'];
	$member_data['basic_ff'] = $_POST['basicffYearSelect'];
	$member_data['high_work'] = $_POST['highWorkYearSelect'];
	$member_data['surface_rescue'] = $_POST['surfaceRescYearSelect'];
	$member_data['first_aid'] = $_POST['firstAidYearSelect'];
	$member_data['oxygen'] = $_POST['oxygenYearSelect'];
	$member_data['chief_edu'] = $_POST['chiefYearSelect'];
	$member_data['unit_commander'] = $_POST['unitCmderYearSelect'];
	$member_data['other_education'] = $_POST['other_educationt'];
	$member_data['junior_education'] = $_POST['junior_education'];
	$member_data['uleborg_test'] = $_POST['uleborgTest'];
	$member_data['belastn_ekg'] = $_POST['belastnEkg'];	
	$member_data['five_year_pin'] = $_POST['5_year'];
	$member_data['ten_year_pin'] = $_POST['10_year'];
	$member_data['twenty_year_pin'] = $_POST['20_year'];
	$member_data['thirty_year_pin'] = $_POST['30_year'];
	$member_data['special_pin'] = $_POST['special_pin'];
	$member_data['other_award'] = $_POST['other_awards'];	
	//$member_data['selected_member'] = $_SESSION['MEMBER_DATA']['selected_member'];

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
	if($member_data['smoke_diver'] == 'not_done' && $member_data['basic_ff'] == 'not_done' && $member_data['active_smoke_diver'] == 'yes') {
		$errmsg_arr[] = 'Medlemmen kan ej vara aktiv rökdykare - har varken gått Rökdykarkurs eller Basic Fire Fighting';
		$errflag = true;		
	}	
	if(($member_data['smoke_diver'] == 'not_done' && $member_data['basic_ff'] == 'not_done' && $member_data['uleborg_test'] != 'not_done')
			|| ($member_data['smoke_diver'] == 'not_done' && $member_data['basic_ff'] == 'not_done' && $member_data['uleborg_test_result'] == 'passed')) {
		$errmsg_arr[] = 'Medlemmen ska ej göra uleåborgstestet - har varken gått Rökdykarkurs eller Basic Fire Fighting';
		$errflag = true;
	}	
	if(($member_data['smoke_diver'] == 'not_done' && $member_data['basic_ff'] == 'not_done' && $member_data['belastn_ekg'] != 'not_done')
			|| ($member_data['smoke_diver'] == 'not_done' && $member_data['basic_ff'] == 'not_done' && $member_data['belastn_ekg_result'] == 'passed')) {
		$errmsg_arr[] = 'Medlemmen ska ej göra belastnings EKG - har varken gått Rökdykarkurs eller Basic Fire Fighting';
		$errflag = true;
	}			
	
	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		ob_clean();	
		header("location: add-member.php");
		exit();
	}
	
	//Create INSERT query
	$qry = "INSERT INTO crew(type,nr,firstname,lastname,dob,phone,nameice,ice,email,started,seniorstarted,driverslicense,board,boardrole,chief,assistantchief,assignmentintrust,uleborgtest,uleborgresult,belastnekg,belastnekgresult,extman,rescman,smokediver,activesmokediver,basicff,highwork,firstaid,oxygen,surfacerescue,chiefedu,unitcommander,othereducation,junioredusummary,fiveyearpin,tenyearpin,twentyyearpin,thirtyyearpin,specialpin,otheraward,otherfiredept) VALUES('senior','".clean($member_data['nr'])."','".clean($member_data['fname'])."','".clean($member_data['lname'])."','".clean($member_data['dob'])."','".clean($member_data['phone'])."','".clean($member_data['nameice'])."','".clean($member_data['ice'])."','".clean($member_data['email'])."','".clean($member_data['started'])."','".clean($member_data['started'])."','".clean($member_data['driver_license'])."','".clean($member_data['board'])."','".clean($member_data['boardrole'])."','".clean($member_data['chief'])."','".clean($member_data['assistant_chief'])."','".clean($member_data['assignment_in_trust'])."','".clean($member_data['uleborg_test'])."','".clean($member_data['uleborg_test_result'])."','".clean($member_data['belastn_ekg'])."','".clean($member_data['belastn_ekg_result'])."','".clean($member_data['ext_man'])."','".clean($member_data['resc_man'])."','".clean($member_data['smoke_diver'])."','".clean($member_data['active_smoke_diver'])."','".clean($member_data['basic_ff'])."','".clean($member_data['high_work'])."','".clean($member_data['first_aid'])."','".clean($member_data['oxygen'])."','".clean($member_data['surface_rescue'])."','".clean($member_data['chief_edu'])."','".clean($member_data['unit_commander'])."','".clean($member_data['other_education'])."','".clean($member_data['junior_education'])."','".clean($member_data['five_year_pin'])."','".clean($member_data['ten_year_pin'])."','".clean($member_data['twenty_year_pin'])."','".clean($member_data['thirty_year_pin'])."','".clean($member_data['special_pin'])."','".clean($member_data['other_award'])."','".clean($member_data['other_firedept'])."')";
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		//Set session variable, catch it in calling file to decide wether this script is successfull or not
		$_SESSION['SUBMIT_SUCCESS'] = true;
		unset($_SESSION['MEMBER_DATA']);
		session_write_close();
		ob_clean();
		header("location: add-member.php");
		exit();
	}else {
		die(mysql_error());
	}
?>