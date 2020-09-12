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
		<title>Jomala FBK - Rökdykare - Redigera Rökdykare</title>
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
				<h2>Redigera rökdykare</h2>
				<p>På denna sida redigerar du rökdykar information. Listan nedan fylls med medlemmar som är utbildade rökdykare och för att <br />
				redigera rökdykares information så väljer du helt enkelt rökdykare ur listan och klickar på "Hämta information".<br />
				När rökdykare är vald så fylls fälten nedan i med medlemmens rökdykar information, därefter gör du nödvändiga ändringar och<br />
				klickar på "Uppdatera rökdykare" så sparas informationen till registret.</p>
				
				<form id="getSmokediverInfoForm" name="getSmokediverInfoForm" method="post" action="get-smokediver-info-exec.php">
					<table id="form_table">
						<tr>
							<th>Välj rökdykare</th>
							<!--Calling php function from script to populate dropdown list with admins-->
							<td><?php populate_with_all_smokedivers($_SESSION['MEMBER_DATA']['selected_member']);?></td>
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
							<form id="editSmokediverForm" name="editSmokediverForm" method="post" action="edit-smokediver-exec.php">
								<table border="0" cellpadding="2" cellspacing="0">
									<tr>
										<th class="heading">Rökdykare</th>
									</tr>
									<tr>
										<th>Manskaps nummer</th>
										<td><?php echo $_SESSION['MEMBER_DATA']['nr']; ?></td>
									</tr>									
									<tr>
										<th>Namn</th>
										<td><?php echo $_SESSION['MEMBER_DATA']['name']; ?></td>
									</tr>
	
									<tr><td><br /></td></tr>
									<tr>
										<th class="heading">Rökdykar information</th>
									</tr>
									<tr>
										<th>Aktiv rökdykare</th>
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
									<tr>
										<th>Rökdykare</th>
										<td><?php populate_with_education_years("smokeDiveYearSelect", $_SESSION['MEMBER_DATA']['smoke_diver']);?></td>
									</tr>
									<tr>
										<th>Basic Fire Fighting</th>
										<td><?php populate_with_education_years("basicffYearSelect", $_SESSION['MEMBER_DATA']['basic_ff']);?></td>
									</tr>	
									<tr>
										<th>Uleåborgstestet(senast genomförd)</th>
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
													  <input type="radio" name="uleborg_result_radio" value="passed" >Godkänd</td>';										
											}
										?>
									</tr>
									<tr>
										<th>Belastnings EKG(senast genomförd)</th>
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
									
									<tr>
										<td></td>
										<td><input type="submit" name="Submit" value="Uppdatera rökdykare" /></td>
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
									echo '<font class="result_heading">Rökdykare har uppdaterats!</font><br />';
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