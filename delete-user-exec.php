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
	$admin_to_delete = clean($_POST['userSelect']);
	$class = $_SESSION['SESS_CLASS'];
	$member_data['selected_member'] = $admin_to_delete;
	
	//Store new member data array as Session
	$_SESSION['MEMBER_DATA'] = $member_data;

  
	//Input Validations
	if($password == '') {
		$errmsg_arr[] = 'Lösenord saknas';
		$errflag = true;	
	}
	
	//If webmaster is not logged in
	if(strcmp($class, 'admin') != 0) {
		$errmsg_arr[] = 'Behörighet saknas för att utföra denna åtgärd';
		$errflag = true;	
	}

	//Create query
	$qry="SELECT * FROM members WHERE login='".clean($_SESSION['SESS_LOGIN'])."' AND passwd='".md5($_POST['password'])."'";
	$result=mysql_query($qry);
	
	if(!$errflag) {
		//Check whether the query was successful or not
		if($result) {
			//Indeed webmaster are logged in
			if(mysql_num_rows($result) == 1) {
				//Delete selected admin from db with this query
				$qry="DELETE FROM members WHERE login='".clean($_POST['userSelect'])."'";
				$result=mysql_query($qry);
				//Set session variable, catch it in calling file to decide wether this script is successfull or not
				$_SESSION['SUBMIT_SUCCESS'] = true;
				unset($_SESSION['MEMBER_DATA']);
				session_write_close();
				ob_clean();
				header("location: delete-user.php");
				exit();
			}else { //<--This case shouldn't be able to happen
				$errmsg_arr[] = 'Fel lösenord har angetts';
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				ob_clean();
				header("location:  delete-user.php");
				exit();
			}
		}else {
			die(mysql_error());
		}
	} else {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		ob_clean();
		header("location: delete-user.php");
		exit();		
	}
?>