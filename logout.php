<!--Php block to unset session variables-->
<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FIRST_NAME']);
	unset($_SESSION['SESS_LAST_NAME']);
	unset($_SESSION['SESS_LOGIN']);
	unset($_SESSION['SESS_CLASS']);
	unset($_SESSION['MEMBER_DATA']);
	unset($_SESSION['LAST_PAGE']);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Jomala FBK - Utloggad</title>
		<!--Hack to force internet explorer to show page as ie7 browser-->
		<meta http-equiv="X-UA-Compatible" content="IE=7"/>
		<link href="css/main.css" rel="stylesheet" type="text/css" />
		<link rel="icon" type="image/x-icon" href="css/images/icon.ico" />
	</head>
	<body>
		<h3 align="center" class="red">Du har loggats ut!</h3>
		<p align="center"><a class="user_nav" href="login-form.php">Klicka här för att Logga in på nytt!</a></p>
		<div id="footer_bottom">
			&copy; Robert Nyholm - Jomala FBK - <?php echo date("Y");?>
		</div>
	</body>
</html>
