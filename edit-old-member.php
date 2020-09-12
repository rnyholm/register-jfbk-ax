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
		<title>Jomala FBK - Oldboysavdelningen - Redigera Medlem</title>
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
				<h2>Redigera medlem i oldboysavdelningen</h2>
				<p>För att redigera befintlig medlems information så väljer du helt enkelt bara medlem<br />
				ur listan nedan så fylls formuläret med personens information. Sedan är det bara att redigera<br />
				personens information och när du är klar klickar du bara på "Uppdatera medlem" så sparas den nya<br />
				informationen till registret.<br />
				<b>Endast aktiva medlemmar listas nedan!</b></p>
				<p class="red">Obligatoriska fält är märkta med *<br />Kom ihåg att ange korrekt födelsedatum samt korrekt inskrivningsår!<br />
				Tänk också på att med inskrivningsår menas det året som medlemmen blev skriven i kåren oberoende avdelning,<br />
				d.v.s. om medlemmen började i ungdomsavdelningen eller alarmavdelningen är det detta årtal som ändras. Det är även detta årtal som <br />
				totala antalet år en medlem varit aktiv inom kåren räknas!</p> 
	
				<form id="getMemberInfoForm" name="getMemberInfoForm" method="post" action="get-old-member-info-exec.php">
					<table id="form_table">
						<tr>
							<th>Välj medlem</th>
							<!--Calling php function from script to populate dropdown list with admins-->
							<td><?php populate_with_active_old_members($_SESSION['MEMBER_DATA']['selected_member']);?></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" name="Submit" value="Hämta information" /></td>
						</tr>
					</table>
				</form>
	
				<table id="form_table">
					<tr>
						<td>
							<form id="editOldCrewForm" name="editOldCrewForm" method="post" action="edit-old-member-exec.php">
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
										<td valign="top"><b><font class="th_txtarea">Födelsedatum*</font></b><br /><font class="hint">(Dag - Månad - År)</font></td>
										<td><?php populate_with_days($_SESSION['MEMBER_DATA']['day']); echo'-'; populate_with_months($_SESSION['MEMBER_DATA']['month']); echo'-'; populate_with_years($_SESSION['MEMBER_DATA']['year']);?></td>
									</tr>
									<tr>
										<td valign="top"><b><font class="th_txtarea">Telefonnummer*</font></b><br /><font class="hint">(i format 1234 1234 567 eller 12 345)</font></td>
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
										<th>Närmsta anhörig*</th>
										<?php
											echo '<td><input name="nameice" type="text" class="textfield" id="nameice" value="'.$_SESSION['MEMBER_DATA']['nameice'].'" /></td>';
										?>
									</tr>
									<tr>
										<th>Närmsta anhörigs telefonnummer*</th>
										<?php
											echo '<td><input name="ice" type="text" class="textfield" id="ice" value="'.$_SESSION['MEMBER_DATA']['ice'].'" /></td>';
										?>
									</tr>										
	
									<tr><td><br /></td></tr>
									<tr>
										<th class="heading">Uppgifter för brandkåren</th>
									</tr>
									<tr>
										<th>Inskrivningsår*</th>
										<td><?php populate_with_senior_start_years($_SESSION['MEMBER_DATA']['started']);?></td>
									</tr>
									<tr>
										<th>Styrelse medlem(nuvarande)</th>
										<?php
											if($_SESSION['MEMBER_DATA']['board'] == 'yes') {
												echo '<td><input type="radio" name="boardradio" value="no">Nej
													  <input type="radio" name="boardradio" value="yes" checked>Ja</td>';
											} else {
												echo '<td><input type="radio" name="boardradio" value="no" checked>Nej
													  <input type="radio" name="boardradio" value="yes">Ja</td>';
											}
										?>
									</tr>
									<tr>
										<td valign="top"><b><font class="th_txtarea">Styrelse uppdrag</font></b><br /><font class="hint">(ex. ledamot, ordförande etc.)</font></td>
										<?php
											echo '<td><input name="boardrole" type="text" class="textfield" id="boardrole" value="'.$_SESSION['MEMBER_DATA']['boardrole'].'" /></td>';
										?>
									</tr>
									<tr>
										<th valign="top">Förtroende uppdrag</th>
										<?php
											echo '<td><textarea name="trustassignment" type="text" class="textfield" id="trustassignment" cols="30" rows="5">'.$_SESSION['MEMBER_DATA']['assignment_in_trust'].'</textarea></td>';
										?>
									</tr>
									<tr>
										<td valign="top"><b><font class="th_txtarea">Tidigare brandkårer</font></b><br /><font class="hint">(enl. format kår(startår-slutår))</font></td>
								
										<?php
											echo '<td><textarea name="other_firedept" type="text" class="textfield" id="other_firedept" cols="30" rows="5">'.$_SESSION['MEMBER_DATA']['other_firedept'].'</textarea></td>';
										?>
									</tr>								
	
									<tr><td><br /></td></tr>
									<tr>
										<th class="heading">Utbildning</th>
									</tr>
									<tr>
										<td valign="top"><b><font class="th_txtarea">Senior utbildning</font></b><br /><font class="hint">(enl. format kursens_namn(årtal))</font></td>
								
										<?php
											echo '<td><textarea name="senior_education" type="text" class="textfield" id="senior_education" cols="45" rows="10">'.$_SESSION['MEMBER_DATA']['senior_education'].'</textarea></td>';
										?>
									</tr>
									<tr>
										<td valign="top"><b><font class="th_txtarea">Övrig utbildning</font></b><br /><font class="hint">(enl. format kursens_namn(årtal))</font></td>
								
										<?php
											echo '<td><textarea name="other_educationt" type="text" class="textfield" id="other_educationt" cols="45" rows="10">'.$_SESSION['MEMBER_DATA']['other_education'].'</textarea></td>';
										?>
									</tr>
									<tr>
										<td valign="top"><b><font class="th_txtarea">Junior utbildningar</font></b><br /><font class="hint">(enl. format kursens_namn(årtal))</font></td>	
										<?php
											echo '<td><textarea name="junior_education" type="text" class="textfield" id="junior_education" cols="45" rows="10">'.$_SESSION['MEMBER_DATA']['junior_education'].'</textarea></td>';
										?>
									</tr>
	
									<tr><td><br /></td></tr>
									<tr>
										<th class="heading">Utmärkelser</th>
									</tr>
									<tr>
										<th>JFBK's förtjänstetecken 5 år, nål</th>
										<td><?php populate_with_award_years("5_year", $_SESSION['MEMBER_DATA']['five_year_pin']);?></td>
									</tr>
									<tr>
										<th>FSB's förtjänstetecken 10 år, medalj(brons)</th>
										<td><?php populate_with_award_years("10_year", $_SESSION['MEMBER_DATA']['ten_year_pin']);?></td>
									</tr>
									<tr>
										<th>FSB's förtjänstetecken 20 år, medalj(silver)</th>
										<td><?php populate_with_award_years("20_year" ,$_SESSION['MEMBER_DATA']['twenty_year_pin']);?></td>
									</tr>
									<tr>
										<th>FSB's förtjänstetecken 30 år, medalj(guld)</th>
										<td><?php populate_with_award_years("30_year" ,$_SESSION['MEMBER_DATA']['thirty_year_pin']);?></td>
									</tr>									
									<tr>
										<th>JFBK's förtjänstetecken, special medalj</th>
										<td><?php populate_with_award_years("special_pin", $_SESSION['MEMBER_DATA']['special_pin']);?></td>
									</tr>
									<tr>
										<td valign="top"> <b><font class="th_txtarea">Övriga utmärkelser</font></b><br /><font class="hint">(enl. format utmärkelse(årtal), om jubilar enl. följande<br /> 50-års Jubilar(gåva,årtal) så exempelvis <br />70-års Jubilar(Guldfat,2013))</font></td>
										<?php
											echo '<td><textarea name="other_awards" type="text" class="textfield" id="other_awards" cols="45" rows="10">'.$_SESSION['MEMBER_DATA']['other_award'].'</textarea></td>';
										?>
									</tr>
									
									<tr>
										<td></td>
										<td><input type="submit" name="Submit" value="Uppdatera medlem" /></td>
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
									echo '<font class="result_heading">Medlemmens information har uppdaterats!</font><br />';
									//echo '<p class="result_paragraph">Ändringarna har sparats till registret.</p>';
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
