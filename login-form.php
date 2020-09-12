<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Jomala FBK - Logga in!</title>
		<!--Hack to force internet explorer to show page as ie7 browser-->
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/login.css" rel="stylesheet" type="text/css" />
		<link rel="icon" type="image/x-icon" href="css/images/icon.ico" />
	</head>
	
	<body>
		<div id="login_outer">
			<div id="login_middle">
				<div id="login_inner_logo">
					<div id="login_inner_layout">
						<div id="login_inner_form">
							<b class="login_heading">Logga in för att fortsätta!</b>
							<form id="loginForm" name="loginForm" method="post" action="login-exec.php">
								<table border="0">
									<tr>
										<td>Användarnamn</td>
										<td><input type="text" name="login" id="login" /></td>
									</tr>
									<tr>
										<td>Lösenord</td>
										<td><input type="password" name="password" id="password" /></td>
									</tr>
									<tr>
										<td></td>
										<td><input name="Submit" type="submit" value="Logga in" /></td>
									</tr>
								</table>					
							</form>
							<br />						
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="footer">
			&copy; Robert Nyholm - Jomala FBK - <?php echo date("Y");?>
		</div>
	</body>
</html>