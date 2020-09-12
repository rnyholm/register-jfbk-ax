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
	$member_data['selected_member'] = $_POST['boardMemberSelect'];

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
			
				//Get first letter of crew_id to decide from which table we shall retreive data from
				$fl = substr($_POST['boardMemberSelect'], 0, 1);
				
				//Switch through alternatives and select the correct sql query
				switch($fl) {
					case('C'):
						$qry = "UPDATE crew SET board='no',boardrole='' WHERE crew_id='".clean(substr($_POST['boardMemberSelect'],1))."'";
						break;
					case('E'):
						$qry = "DELETE FROM extboardmembers WHERE board_id='".clean(substr($_POST['boardMemberSelect'],1))."'";
						break;
					default:
						//DO NOTHING!
				}

				$result=mysql_query($qry) or die(mysql_error());
				//Set session variable, catch it in calling file to decide wether this script is successfull or not
				$_SESSION['SUBMIT_SUCCESS'] = true;
				unset($_SESSION['MEMBER_DATA']);
				session_write_close();
				ob_clean();
				header("location: remove-board-member.php");
				exit();
			}else { //<--This case shouldn't be able to happen
				$errmsg_arr[] = 'Fel lösenord för ditt användarkonto har angetts';
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				ob_clean();
				header("location:  remove-board-member.php");
				exit();
			}
		}else {
			die(mysql_error());
		}
	} else {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		ob_clean();
		header("location: remove-board-member.php");
		exit();		
	}
?>