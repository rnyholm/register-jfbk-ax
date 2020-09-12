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
		<title>Jomala FBK - Styrelsen - Lägg Till Befintlig Medlem</title>
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
				<h2>Lägg till befintlig medlem i styrelsen</h2>
				<p>Här lägger du till medlem i styrelsen som redan är medlem i alarmavdelningen eller<br />
				oldboysavdelningen. För att lägga till en styrelsemedlem på detta vis så väljer du bara person ur listan<br />
				nedan(i listan finns bara personer från alarm- och oldboys avdelningen som inte är medlemmar i styrelsen). När<br />
				personen är vald så fyller du bara i om personen ska ha något uppdrag inom styrelsen(ledamot, sekreterare etc.) och<br />
				till sist klickar du på "Lägg till i styrelsen". Du behöver inte fylla i telefonnummer, epost och annan information<br />
				eftersom det hämtas direkt ur medlems registret.
				Vill du däremot lägga till en person i styrelsen som inte är medlem i alarm- eller oldboys avdelningen klicka på <br />
				"Lägg till utomstående i styrelsen" nedan.</p>
				
				<p>
					<input type="submit" name="addExtBoardMemberButton" id="addExtBoardMemberButton" value="Lägg till utomstående i styrelsen" onclick="location.href='add-new-board-member.php'" />
				</p>
	
				<form id="addExtMemberForm" name="addExtMemberForm" method="post" action="add-existing-member-to-board-exec.php">
					<table id="form_table">
						<tr>
							<td>
								<table>							
									<tr>
										<th>Välj medlem</th>
										<td><?php populate_with_noboard_members($_SESSION['MEMBER_DATA']['selected_member']);?></td>
									</tr>
									<tr>
										<td valign="top"> <b><font class="th_txtarea">Styrelse uppdrag</font></b><br /><font class="hint">(ex. ledamot, ordförande etc.)</font></td>
										<?php
											echo '<td><input name="boardrole" type="text" class="textfield" id="boardrole" value="" /></td>';
										?>
									</tr>
									<tr>
										<td></td>
										<td><input type="submit" name="Submit" value="Lägg till i styrelsen" /></td>
									</tr>
								</table>
					
							</td>
							<td align="left" valign="top">
								<?php
									if($_SESSION['SUBMIT_SUCCESS'] == true) {									  
										echo '<div id="success">';
										echo '<font class="result_heading">Medlemmen har lagts till i styrelsen!</font><br />';
										echo '<p class="result_paragraph">Du kan när som helst redigera styrelsemedlems information genom <br /> menyn uppe på sidan.</p>';
										echo '</div>';
											  
										unset($_SESSION['SUBMIT_SUCCESS']);
									}
								?>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		<?php include('footer.php'); ?>
	</body>
</html>