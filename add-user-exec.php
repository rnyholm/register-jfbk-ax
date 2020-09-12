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
	
	/*
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	*/
	
	//Sanitize the POST values
	$fname = clean($_POST['fname']);
	$lname = clean($_POST['lname']);
	$login = clean($_POST['login']);
	$class = clean($_POST['classSelect']);
	$password = clean($_POST['password']);
	$cpassword = clean($_POST['cpassword']);
	
	//Array to store new member form data in
	$member_data['fname'] = $fname;
	$member_data['lname'] = $lname;
	$member_data['login'] = $login;
	$member_data['class'] = $class;
	
	//Store new member data array as Session
	$_SESSION['MEMBER_DATA'] = $member_data;
	
	//Input Validations
	if($fname == '') {
		$errmsg_arr[] = 'Förnamn saknas';
		$errflag = true;
	}
	if($lname == '') {
		$errmsg_arr[] = 'Efternamn saknas';
		$errflag = true;
	}
	if($login == '') {
		$errmsg_arr[] = 'Användarnamn saknas';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Lösenord saknas';
		$errflag = true;
	}
	if($cpassword == '') {
		$errmsg_arr[] = 'Bekräftelse av lösenord saknas';
		$errflag = true;
	}
	if( strcmp($password, $cpassword) != 0 ) {
		$errmsg_arr[] = 'Lösenorden matchar inte varandra';
		$errflag = true;
	}
	
	//Check for duplicate login ID
	if($login != '') {
		$qry = "SELECT * FROM members WHERE login='$login'";
		$result = mysql_query($qry);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr[] = 'Användarnamnet existerar redan';
				$errflag = true;
			}
			@mysql_free_result($result);
		}
		else {
			die("Query failed");
		}
	}
	
	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		ob_clean();
		header("location: add-user.php");
		exit();
	}

	//Create INSERT query
	$qry = "INSERT INTO members(firstname, lastname, login, passwd,class) VALUES('$fname','$lname','$login','".md5($_POST['password'])."','$class')";
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		//Set session variable, catch it in calling file to decide wether this script is successfull or not
		$_SESSION['SUBMIT_SUCCESS'] = true;
		unset($_SESSION['MEMBER_DATA']);
		session_write_close();
		ob_clean();
		header("location: add-user.php");
		exit();
	}else {
		die("Query failed");
	}
?>