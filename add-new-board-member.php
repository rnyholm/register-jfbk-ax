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
		<title>Jomala FBK - Styrelsen- Lägg Till Utomstående i Styrelsen</title>
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
				<h2>Lägg till utomstående i styrelsen</h2>
				<p>På denna sida lägger du till en utomstående styrelsemedlem. Fyll i fälten nedan<br />
				och klicka på "Lägg till styrelsemedlem" så sparas personen i registret.<br />
				<b>Observera</b> att denna sida är tänkt att användas om man vill lägga till en<br />
				person i styrelsen som <b>inte</b> är medlem i kåren annars. För att lägga till utomstående i<br />
				styrelsen så anger du bara informationen nedan och klickar på "Lägg till styrelsemedlem".<br />
				Om personen redan är medlem i alarm- eller oldboys avdelningen<br />
				så klickar du istället på "Lägg till befintlig medlem i styrelsen" nedan för att komma direkt till sidan.</p>
				<p class="red">Obligatoriska fält är märkta med *</p> 
				
				<p>
					<input type="submit" name="addExtBoardMemberButton" id="addExtBoardMemberButton" value="Lägg till befintlig medlem i styrelsen" onclick="location.href='add-existing-member-to-board.php'" />
				</p>
				
				<table id="form_table">
					<tr>
						<td>
							<form id="addBoardMemberForm" name="addBoardMemberForm" method="post" action="add-new-board-member-exec.php">
								<table border="0" cellpadding="2" cellspacing="0">
									<tr>
										<th class="heading">Personlig information</th>
									</tr>
									<tr>
										<th>Förnamn*</th>
										<?php
											echo '<td><input name="firstname" type="text" class="textfield" id="firstname" value="'.$_SESSION['MEMBER_DATA']['fname'].'" /></td>';
										?>
									</tr>
									<tr>
										<th>Efternamn*</th>
										<?php
											echo '<td><input name="lastname" type="text" class="textfield" id="lastname" value="'.$_SESSION['MEMBER_DATA']['lname'].'" /></td>';
										?>
									</tr>
									<tr>
									<td valign="top"> <b><font class="th_txtarea">Telefonnummer</font></b><br /><font class="hint">(i format 1234 1234 567 eller 12 345)</font></td>
										<?php
											echo '<td><input name="phone" type="text" class="textfield" id="phone" value="'.$_SESSION['MEMBER_DATA']['phone'].'" /></td>';
										?>
									</tr>
									<tr>
										<th>E-post</th>
										<?php
											echo '<td><input name="email" type="text" class="textfield" id="email" value="'.$_SESSION['MEMBER_DATA']['email'].'" /></td>';
										?>
									</tr>
									<tr>
										<td valign="top"> <b><font class="th_txtarea">Styrelse uppdrag</font></b><br /><font class="hint">(ex. ledamot, ordförande etc.)</font></td>
										<?php
											echo '<td><input name="boardrole" type="text" class="textfield" id="boardrole" value="'.$_SESSION['MEMBER_DATA']['boardrole'].'" /></td>';
										?>
									</tr>
	
									<tr>
										<td></td>
										<td><input type="submit" name="Submit" value="Lägg till styrelsemedlem" /></td>
									</tr>
								</table>
							</form>
						</td>
						<td align="left" valign="top">
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
									echo '<font class="result_heading">Ny medlem har lagts till i styrelsen!</font><br />';
									echo '<p class="result_paragraph">Du kan när som helst redigera styrelsemedlems information genom <br /> menyn uppe på sidan.</p>';
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