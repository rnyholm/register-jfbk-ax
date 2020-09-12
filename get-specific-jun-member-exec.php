<?php
	//Run the authentication script
	require_once('auth.php');

	//To handle output buffer
	ob_start();
	
	//Start session
	session_start();

	//Include database connection details
	require_once('config.php');
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
		$member_data['selected_member'] = $_POST['activeJunMemberSelect'];
		$member_data['name'] = $member['firstname'].' '.$member['lastname'];
		$member_data['dob'] = substr($member['dob'],-2,2).'.'.substr($member['dob'],-5,2).'-'.substr($member['dob'],-10,4);
		$member_data['age'] = calculate_age($member['dob']);
		$member_data['nameice'] = $member['nameice'];
		$member_data['ice'] = $member['ice'];
		$member_data['juniorstarted'] = $member['juniorstarted'];
		
		//Check if member has an phone number
		if($member['phone'] != '') {
			$member_data['phone'] = $member['phone'];
		} else {
			$member_data['phone'] = '-';
		}
		
		//Check if member has an email
		if($member['email'] != '') {
			$member_data['email'] = $member['email'];
		} else {
			$member_data['email'] = '-';
		}
		
		//Check if member has any sweater size
		if($member['size'] != '') {
			$member_data['size'] = $member['size'];
		} else {
			$member_data['size'] = '-';
		}
		
		//Variable to store education as junior
		$junior_education = '';
		
		//Check if junior has done beginner education and concat result to education string
		if($member['beginner'] != 'not_done') {
			$junior_education = $junior_education.'Nybörjarkurs('.$member['beginner'].')';
		}
		
		//Check if junior has done level one education and concat result to education string
		if($member['lvlone'] != 'not_done') {
			if($junior_education == '') {
				$junior_education = $junior_education.'Nivåkurs 1('.$member['lvlone'].')';
			} else {
				$junior_education = $junior_education.', Nivåkurs 1('.$member['lvlone'].')';
			}
		}
		
		//Check if junior has done level two education and concat result to education string
		if($member['lvltwo'] != 'not_done') {
			if($junior_education == '') {
				$junior_education = $junior_education.'Nivåkurs 2('.$member['lvltwo'].')';
			} else {
				$junior_education = $junior_education.', Nivåkurs 2('.$member['lvltwo'].')';
			}
		}
		
		//Check if junior has done level three education and concat result to education string
		if($member['lvlthree'] != 'not_done') {
			if($junior_education == '') {
				$junior_education = $junior_education.'Nivåkurs 3('.$member['lvlthree'].')';
			} else {
				$junior_education = $junior_education.', Nivåkurs 3('.$member['lvlthree'].')';
			}
		}
		
		//Check if junior has done level four education and concat result to education string
		if($member['lvlfour'] != 'not_done') {
			if($junior_education == '') {
				$junior_education = $junior_education.'Nivåkurs 4('.$member['lvlfour'].')';
			} else {
				$junior_education = $junior_education.', Nivåkurs 4('.$member['lvlfour'].')';
			}
		}
		
		//Check if junior has done unit commander education and concat result to education string
		if($member['jununitcommander'] != 'not_done') {
			if($junior_education == '') {
				$junior_education = $junior_education.'Gruppchef('.$member['jununitcommander'].')';
			} else {
				$junior_education = $junior_education.', Gruppchef('.$member['jununitcommander'].')';
			}
		}
		
		//Check if junior has done education course and concat result to education string
		if($member['education'] != 'not_done') {
			if($junior_education == '') {
				$junior_education = $junior_education.'Utbildarkurs('.$member['education'].')';
			} else {
				$junior_education = $junior_education.', Utbildarkurs('.$member['education'].')';
			}
		}
		
		//If member hasn't done any courses
		if($junior_education == '') {
			//$junior_education = 'Har ej genomfört några utbildningar.';
			$junior_education = '-';
		}	
		
		$member_data['education'] = $junior_education;


		//Store new member data array as Session
		$_SESSION['MEMBER_DATA'] = $member_data;
		
		session_write_close();
		ob_clean();
		header("location: get-specific-jun-member.php");
		exit();
	} else {
		die(mysql_error());
	}
?>