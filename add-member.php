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
		<title>Jomala FBK - Alarmavdelningen - Ny Medlem</title>
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
				<h2>Lägg till ny medlem i alarmavdelningen</h2>
				<p>För att lägga till en ny medlem alarmavdelningen fyller du helt enkelt i formuläret nedan<br />
				och klickar på "Lägg till medlem".<br />
				Information som angetts för en medlem kan ändras efteråt.</p>
				<p class="red">Obligatoriska fält är märkta med *<br />
				Kom ihåg att ange korrekt födelsedatum samt korrekt inskrivningsår!</p> 
				
				<table id="form_table">
					<tr>
						<td>
							<form id="addCrewForm" name="addCrewForm" method="post" action="add-member-exec.php">
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
										<td valign="top"><b><font class="th_txtarea">Körkort</font></b><br /><font class="hint">(ex. a, be, c)</font></td>
										<?php
											echo '<td><input name="driverlicense" type="text" class="textfield" id="driverlicense" value="'.$_SESSION['MEMBER_DATA']['driver_license'].'" /></td>';
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
										<th>Manskaps nummer</th>
										<?php
											echo '<td><input size="5" name="crewnumber" type="text" class="textfield" id="crewnumber" value="'.$_SESSION['MEMBER_DATA']['nr'].'" /></td>';
										?>
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
										<th>Kårchef</th>
										<?php
											if($_SESSION['MEMBER_DATA']['chief'] == 'yes') {
												echo '<td><input type="radio" name="chiefradio" value="no">Nej
													  <input type="radio" name="chiefradio" value="yes" checked>Ja</td>';
											} else {
												echo '<td><input type="radio" name="chiefradio" value="no" checked>Nej
													  <input type="radio" name="chiefradio" value="yes">Ja</td>';
											}
										?>
									</tr>
									<tr>
										<th>Biträdande kårchef</th>
										<?php
											if($_SESSION['MEMBER_DATA']['assistant_chief'] == 'yes') {
												echo '<td><input type="radio" name="assistantchiefradio" value="no">Nej
													  <input type="radio" name="assistantchiefradio" value="yes" checked>Ja</td>';
											} else {
												echo '<td><input type="radio" name="assistantchiefradio" value="no" checked>Nej
													  <input type="radio" name="assistantchiefradio" value="yes">Ja</td>';
											}
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
										<th>Släckningsman</th>
										<td><?php populate_with_education_years("extManYearSelect", $_SESSION['MEMBER_DATA']['ext_man']);?></td>
									</tr>
									<tr>
										<th>Räddningsman</th>
										<td><?php populate_with_education_years("rescManYearSelect", $_SESSION['MEMBER_DATA']['resc_man']);?></td>
									</tr>
									<tr>
										<th>Rökdykare</th>
										<td><?php populate_with_education_years("smokeDiveYearSelect", $_SESSION['MEMBER_DATA']['smoke_diver']);?></td>
									</tr>
									<tr>
										<th>Basic Fire Fighting</th>
										<td><?php populate_with_education_years("basicffYearSelect", $_SESSION['MEMBER_DATA']['basic_ff']);?></td>
									</tr>									
									<tr>
										<th>Arbete på hög höjd</th>
										<td><?php populate_with_education_years("highWorkYearSelect", $_SESSION['MEMBER_DATA']['high_work']);?></td>
									</tr>
									<tr>
										<th>Ytlivräddning</th>
										<td><?php populate_with_education_years("surfaceRescYearSelect", $_SESSION['MEMBER_DATA']['surface_rescue']);?></td>
									</tr>
									<tr>
										<th>Brandkårens första hjälp</th>							
										<td><?php populate_with_education_years("firstAidYearSelect", $_SESSION['MEMBER_DATA']['first_aid']);?></td>
									</tr>
									<tr>
										<th>Syredelegering</th>
										<td><?php populate_with_education_years("oxygenYearSelect", $_SESSION['MEMBER_DATA']['oxygen']);?></td>
									</tr>
									<tr>
										<th>Kårchef</th>
										<td><?php populate_with_education_years("chiefYearSelect", $_SESSION['MEMBER_DATA']['chief_edu']);?></td>
									</tr>								
									<tr>
										<th>Enhetschef</th>
										<td><?php populate_with_education_years("unitCmderYearSelect", $_SESSION['MEMBER_DATA']['unit_commander']);?></td>
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
										<th class="heading">Aktiv rökdykare</th>
									</tr>
									<tr>
										<th>Är medlemmen aktiv rökdykare</th>
										<?php
											if($_SESSION['MEMBER_DATA']['active_smoke_diver'] == 'yes') {
												echo '<td><input type="radio" name="activesmokediverradio" value="no">Nej
													  <input type="radio" name="activesmokediverradio" value="yes" checked>Ja</td>';
											} else {
												echo '<td><input type="radio" name="activesmokediverradio" value="no" checked>Nej
													  <input type="radio" name="activesmokediverradio" value="yes">Ja</td>';
											}
										?>
									</tr>
										
									<tr><td><br /></td></tr>								
									<tr>
										<th class="heading">Uleåborgstestet</th>
									</tr>
									<tr>
										<th>Senast genomförd</th>
										<td><?php populate_with_education_years("uleborgTest", $_SESSION['MEMBER_DATA']['uleborg_test']);?></td>
									</tr>
									<tr>
										<th>Resultat</th>
										<?php
											if($_SESSION['MEMBER_DATA']['uleborg_test_result'] == 'passed') {
												echo '<td><input type="radio" name="uleborg_result_radio" value="failed">Ej godkänd
													  <input type="radio" name="uleborg_result_radio" value="passed" checked>Godkänd</td>';
											} else {
												echo '<td><input type="radio" name="uleborg_result_radio" value="failed" checked>Ej godkänd
													  <input type="radio" name="uleborg_result_radio" value="passed">Godkänd</td>';										
											}
										?>
									</tr>
	
									<tr><td><br /></td></tr>
									<tr>
										<th class="heading">Belastnings EKG</th>
									</tr>
									<tr>
										<th>Senast genomförd</th>
										<td><?php populate_with_education_years("belastnEkg", $_SESSION['MEMBER_DATA']['belastn_ekg']);?></td>
									</tr>
									<tr>
										<th>Resultat</th>
										<?php
											if($_SESSION['MEMBER_DATA']['belastn_ekg_result'] == 'passed') {
												echo '<td><input type="radio" name="belastn_ekg_result_radio" value="failed">Ej godkänd
													  <input type="radio" name="belastn_ekg_result_radio" value="passed" checked>Godkänd</td>';
											} else {
												echo '<td><input type="radio" name="belastn_ekg_result_radio" value="failed" checked>Ej godkänd
													  <input type="radio" name="belastn_ekg_result_radio" value="passed">Godkänd</td>';										
											}
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
										<td><input type="submit" name="Submit" value="Lägg till medlem" /></td>
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
									echo '<font class="result_heading">Ny medlem har lagts till i alarmavdelningen!</font><br />';
									echo '<p class="result_paragraph">Du kan när som helst redigera medlemmars information genom <br /> menyn uppe på sidan.</p>';
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