<?php
	//Run the authentication script
	require_once('auth.php');

	//To handle output buffer
	ob_start();
	
	//Start session
	session_start(); 

	//Include database connection details
	require_once('config.php');

	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Indicator to store if user has given account password
	$missing_pswd = false;
	
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
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}

	//Sanitize the POST values
	$password = clean($_POST['password']); 
	$npassword = clean($_POST['npassword']); 
	$cpassword = clean($_POST['cpassword']); 
	$login = clean($_SESSION['SESS_LOGIN']);
  
	//Input Validations
	if($password == '') {
		$errmsg_arr[] = 'Lösenord saknas';
		$errflag = true;	
		$missing_pswd = true;
	}
	if($npassword == '') {
		$errmsg_arr[] = 'Nytt lösenord saknas';
		$errflag = true;	
	}
	if($cpassword == '') {
		$errmsg_arr[] = 'Bekräftelse av lösenord saknas';
		$errflag = true;	
	}
	
	if($cpassword != '') {
		//Check if the new passwords are the same
		if(strcmp($npassword, $cpassword) != 0) { 
			$errmsg_arr[] = 'De nya lösenorden matchar inte varandra';
			$errflag = true;
		}
	}

	//Create query
	$qry="SELECT * FROM members WHERE login='$login' AND passwd='".md5($_POST['password'])."'";
	$result=mysql_query($qry);
	
	//Check whether the query was successful or not
	if(!$missing_pswd) {
		if($result) {
			if(mysql_num_rows($result) == 0) {
				$errmsg_arr[] = 'Fel lösenord för ditt konto har angetts';
				$errflag = true;
			}
		}else {
			die(mysql_error());
		} 
	}
	
	//If no error exist do the update
	if(!$errflag) {
		$qry = "UPDATE members SET passwd='".md5($_POST['npassword'])."' WHERE login='$login'";
		$result = @mysql_query($qry);
		
		//Check whether the query was successful or not
		if($result) {
			//Set session variable, catch it in calling file to decide wether this script is successfull or not
			$_SESSION['SUBMIT_SUCCESS'] = true;
			session_write_close();
			ob_clean();
			header("location: change-pswd.php");
			exit();
		} else {
			die(mysql_error());
		}		
	} else {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		ob_clean();
		header("location: change-pswd.php");
		exit();
	}
?>