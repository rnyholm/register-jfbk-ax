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
		<title>Jomala FBK - Oldboysavdelningen - Inaktivera Medlem</title>
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
				<h2>Inaktivera medlem i oldboysavdelningen</h2>
				<p>Medlemmen som ska inaktiveras väljs ur listan (fylls bara med aktiva medlemmar) nedan, sedan anger du ditt lösenord<br />
				för att bekräfta att du har behörighet att utföra åtgärden. Till sist klickar du på "Inaktivera medlem", då flaggas<br />
				medlemmen som inaktiv och kommer inte räknas som aktivt manskap i oldboysavdelningen på dessa sidor.</p>
				<p class="red">OBS! Ingen information om medlemmen tas bort och du kan när som helst aktivera personen igen!</p>
				
				<!--Table holding content for change password and error messages-->
				<table id="form_table">
					<tr>
						<td>
							<form id="inactivateOldMemberForm" name="inactivateOldMemberForm" method="post" action="inactivate-old-member-exec.php">
								<table width="300" id="form_table">
									<tr>
										<th>Välj medlem</th>
										<!--Calling php function from script to populate dropdown list with admins-->
										<td><?php populate_with_active_old_members($_SESSION['MEMBER_DATA']['selected_member']);?></td>
									</tr>
									<tr>
										<th>Lösenord</th>
										<td><input name="password" type="password" class="textfield" id="password" /></td>
									</tr>
									<tr>
										<td></td>
										<td><input type="submit" name="Submit" value="Inaktivera medlem" /></td>
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
									echo '<font class="result_heading">Medlemmen har inaktiverats!</font><br />';
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
