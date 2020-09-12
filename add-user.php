<?php
	require_once('auth.php');	
	require_once('populate-list.php');
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
		<title>Jomala FBK - Administrera - Ny Användare</title>
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
					<h2>Lägg till ny användare</h2>
					<p>För att lägga till nya användare fyll i förmuläret nedan.<br />
					Observera också att man kan lägga till användare i olika klasser, administratör och användare.<br />
					Skillnaden mellan dessa är att administratören har lite mer rättigheter och kan lägga till nya<br />
					användare, ta bort befintliga användare samt byta användares lösenord.<br />
					Alla fält är obligatoriska!</p>
					
					<!--Table holding content for adding new admin and show error message-->
					<table id="form_table">
						<tr>
							<td>
								<form id="registerUSerForm" name="registerUSerForm" method="post" action="add-user-exec.php">
									<table width="300" border="0" cellpadding="2" cellspacing="0">
										<tr>
											<th>Förnamn </th>
											<?php
												echo'<td><input name="fname" type="text" class="textfield" id="fname" value="'.$_SESSION['MEMBER_DATA']['fname'].'" /></td>';
											?>
										</tr>
										<tr>
											<th>Efternamn </th>
											<?php
												echo'<td><input name="lname" type="text" class="textfield" id="lname" value="'.$_SESSION['MEMBER_DATA']['lname'].'" /></td>';
											?>
										</tr>
										<tr>
											<th>Användarnamn</th>
											<?php
												echo'<td><input name="login" type="text" class="textfield" id="login" value="'.$_SESSION['MEMBER_DATA']['login'].'" /></td>';
											?>
										</tr>
										<tr>
											<th>Användarklass</th>
											<td><?php populate_with_classes($_SESSION['MEMBER_DATA']['class']);?></td>										
										</tr>
										<tr>
											<th>Lösenord</th>
											<td><input name="password" type="password" class="textfield" id="password" /></td>
										</tr>
										<tr>
											<th>Bekräfta lösenord </th>
											<td><input name="cpassword" type="password" class="textfield" id="cpassword" /></td>
										</tr>
										<tr>
											<td></td>
											<td><input type="submit" name="Submit" value="Registrera användare" /></td>
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
										echo '<font class="result_heading">Registreringen lyckades!</font><br />';
										echo '<p class="result_paragraph">Ny användare har lagts till i registret.</p>';
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