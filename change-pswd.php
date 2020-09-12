<?php
	require_once('auth.php');	
	$currentFile = $_SERVER["PHP_SELF"];
	$parts = Explode('/', $currentFile);
	$current_page = $parts[count($parts) - 1];
	
	if($_SESSION['LAST_PAGE'] != $current_page) {
		//To unset some data specific to add/edit - member, just to clean them out
		unset($_SESSION['MEMBER_DATA']);
	}
	
	$_SESSION['LAST_PAGE'] = $current_page;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Jomala FBK - Administrera - Byt Lösenord</title>
		<!--Hack to force internet explorer to show page as ie7 browser-->
		<meta http-equiv="X-UA-Compatible" content="IE=7"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/main.css" rel="stylesheet" type="text/css" />
		<link rel="icon" type="image/x-icon" href="css/images/icon.ico" />
	</head>
	
	<body>
			<?php include('ublm.php'); ?>
			<div id="body_container">
				<div id="content_container">
					<h2>Byt lösenord för ditt konto</h2>
					<p>För att byta lösenord för ditt användarkonto fyller du i ditt nuvarande lösenord, ditt nya lösenord samt en bekräftelse på det.<br />
					Ditt nya lösenord blir giltigt nästa gång du loggar in.<br />
					Alla fält är obligatoriska!</p>
					
					<p>Tänk på att ett bra lösenord är minst 7 tecken långt samt innehåller<br />
					små och stora bokstäver, siffror och tecken!</p>
					
					<!--Table holding content for change password and error messages-->
					<table id="form_table">
						<tr>
							<td>
								<form id="changePasswordForm" name="changePasswordForm" method="post" action="change-pswd-exec.php">
									<table width="300" border="0" cellpadding="2" cellspacing="0">
										<tr>
											<th>Lösenord</th>
											<td><input name="password" type="password" class="textfield" id="password" /></td>
										</tr>
										<tr>
											<th>Nytt lösenord</th>
											<td><input name="npassword" type="password" class="textfield" id="npassword" /></td>
										</tr>
										<tr>
											<th>Bekräfta lösenord</th>
											<td><input name="cpassword" type="password" class="textfield" id="cpassword" /></td>
										</tr>
										<tr>
											<td></td>
											<td><input type="submit" name="Submit" value="Byt lösenord" /></td>
										</tr>
									</table>
								</form>
							</td>
							<td valign="top">
								<?php
									if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
										echo '<div id="error">';
										echo '<font class="result_heading">Följande fel har påträffats!</font><br />';
										echo '<font class="result_text">';
														foreach($_SESSION['ERRMSG_ARR'] as $msg) {
															echo '&bull;',$msg,'<br />'; 
														}
										echo '</font>';
										echo '</div>';
										
										unset($_SESSION['ERRMSG_ARR']);
									} else if($_SESSION['SUBMIT_SUCCESS'] == true) {									  
										echo '<div id="success">';
										echo '<font class="result_heading">Byte av lösenord lyckades!</font><br />';
										echo '<p class="result_paragraph">Kom ihåg att använda ditt nya lösenord nästa gång du loggar in!</p>';
										echo '</div>';
											  
										unset($_SESSION['SUBMIT_SUCCESS']);
									}
								?>	
							</td>
						</tr>
					</table>
				</div>
			</div>
			<?php include('footer.php'); ?>
	</body>
</html>