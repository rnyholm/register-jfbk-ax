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
	
	//Store POST value, representing member
	$member_data['selected_member'] = $_POST['activeJunMemberSelect'];

	//Store new member data array as Session
	$_SESSION['MEMBER_DATA'] = $member_data;

	//Input Validations
	if($_POST['password'] == '') {
		$errmsg_arr[] = 'Lösenord saknas';
		$errflag = true;	
	}

	//Create query
	$qry="SELECT * FROM members WHERE login='".clean($_SESSION['SESS_LOGIN'])."' AND passwd='".clean(md5($_POST['password']))."'";
	$result=mysql_query($qry);
	
	if(!$errflag) {
		//Check whether the query was successful or not
		if($result) {
			//Indeed admin are logged in
			if(mysql_num_rows($result) == 1) {
				//Create query to get all information about junior
				$qry = "SELECT * FROM crew WHERE crew_id='".$_POST['activeJunMemberSelect']."'";
				$result = mysql_query($qry);
				$member = mysql_fetch_assoc($result);
				
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
				
				//Update member
				$qry = "UPDATE crew SET type='senior',seniorstarted='".clean(date("Y"))."',junioredusummary='".clean($junior_education)."' WHERE crew_id='".clean($_POST['activeJunMemberSelect'])."'";
				$result = @mysql_query($qry) or die(mysql_error());
				
				//Set session variable, catch it in calling file to decide wether this script is successfull or not
				$_SESSION['SUBMIT_SUCCESS'] = true;
				unset($_SESSION['MEMBER_DATA']);
				session_write_close();
				ob_clean();
				header("location: move-to-senior.php");
				exit();
			}else { //<--This case shouldn't be able to happen
				$errmsg_arr[] = 'Fel lösenord för ditt användarkonto har angetts';
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				ob_clean();
				header("location:  move-to-senior.php");
				exit();
			}
		}else {
			die(mysql_error());
		}
	} else {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		ob_clean();
		header("location: move-to-senior.php");
		exit();		
	}
?>