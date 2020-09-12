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
		<title>Jomala FBK - Utmärkelser - Tilldela Utmärkelse</title>
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
				<h2>Tilldela utmärkelse</h2>
				<p>På denna sida tilldelar du utmärkelser till medlemmar i alarm- och oldboysavdelningen. För att tilldela en utmärkelse väljer<br />
				du först personen som ska tilldelas utmärkelsen ur listan nedan och klickar på "Hämta information".<br /> När
				personen är vald så fylls fälten nedan i med utmärkelser som personen redan erhållit. Sedan tilldelar du utmärkelsen och när du<br />
				är nöjd så klickar du bara på "Tilldela utmärkelse" så sparas informationen till registret.</p>
				<p class="red">Observera! För att ange att jubilar har uppvaktats, så fylls denna information i fältet "Övriga utmärkelser", enligt följande<br />
				format, 50-års Jubilar(gåva,årtal) så exempelvis 70-års Jubilar(Guldfat,2013). Det är ganska viktigt att denna information fylls i på detta vis<br />
				då vissa funktioner på sidan är beroende av detta upplägg.</p>
				
				<form id="getAwardInfoForm" name="getAwardInfoForm" method="post" action="get-assign-award-info-exec.php">
					<table id="form_table">
						<tr>
							<th>Välj medlem</th>
							<!--Calling php function from script to populate dropdown list with admins-->
							<td><?php populate_with_members_old_members($_SESSION['MEMBER_DATA']['selected_member']);?></td>
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
							<form id="assignAwardForm" name="assignAwardForm" method="post" action="assign-award-exec.php">
								<table border="0" cellpadding="2" cellspacing="0">
									<tr>
										<th class="heading">Medlem att tilldelas utmärkelse</th>
									</tr>
									<tr>
										<th>Namn</th>
										<td><?php echo $_SESSION['MEMBER_DATA']['name']; ?></td>
									</tr>
									<tr>
										<th>Födelsedatum</th>
										<td><?php echo $_SESSION['MEMBER_DATA']['dob']; ?></td>
									</tr>
									<tr>
										<th>Ålder</th>
										<td><?php echo $_SESSION['MEMBER_DATA']['age']; ?></td>
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
										<td><input type="submit" name="Submit" value="Tilldela utmärkelse" /></td>
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
									echo '<font class="result_heading">Utmärkelse har tilldelats!</font><br />';
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