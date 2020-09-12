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
		<title>Jomala FBK - Ungdomsavdelningen - Redigera Medlem</title>
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
				<h2>Redigera medlem i ungdomsavdelningen</h2>
				<p>För att redigera befintlig medlems information så väljer du helt enkelt bara medlem<br />
				ur listan nedan så fylls formuläret med personens information. Sedan är det bara att redigera<br />
				personens information och när du är klar klickar du bara på "Uppdatera medlem" så sparas den nya<br />
				informationen till registret.<br />
				<b>Endast aktiva medlemmar listas nedan!</b></p>
				<p class="red">Obligatoriska fält är märkta med *<br />Kom ihåg att ange korrekt födelsedatum samt korrekt inskrivningsår!</p> 
	
				<form id="getMemberInfoForm" name="getMemberInfoForm" method="post" action="get-jun-member-info-exec.php">
					<table id="form_table">
						<tr>
							<th>Välj medlem</th>
							<!--Calling php function from script to populate dropdown list with admins-->
							<td><?php populate_with_active_jun_members($_SESSION['MEMBER_DATA']['selected_member']);?></td>
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
							<form id="editJunCrewForm" name="addJunCrewForm" method="post" action="edit-jun-member-exec.php">
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
										<th>Storlek på tröja</th>
										<?php
											echo '<td><input name="size" type="text" class="textfield" id="size" value="'.$_SESSION['MEMBER_DATA']['size'].'" /></td>';
										?>
									</tr>
									<tr>
										<th>Förälders namn*</th>
										<?php
											echo '<td><input name="nameice" type="text" class="textfield" id="nameice" value="'.$_SESSION['MEMBER_DATA']['nameice'].'" /></td>';
										?>
									</tr>
									<tr>
										<th>Förälders telefonnummer*</th>
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
										<td><?php populate_with_junior_start_years($_SESSION['MEMBER_DATA']['started']);?></td>
									</tr>
	
									<tr><td><br /></td></tr>
									<tr>
										<th class="heading">Utbildning</th>
									</tr>
									<tr>
										<th>Nybörjarkurs</th>
										<td><?php populate_with_education_years("begYearSelect", $_SESSION['MEMBER_DATA']['beginners_course']);?></td>
									</tr>
									<tr>
										<th>Nivåkurs 1</th>
										<td><?php populate_with_education_years("lvlOneYearSelect", $_SESSION['MEMBER_DATA']['lvl_one']);?></td>
									</tr>
									<tr>
										<th>Nivåkurs 2</th>
										<td><?php populate_with_education_years("lvlTwoYearSelect", $_SESSION['MEMBER_DATA']['lvl_two']);?></td>
									</tr>
									<tr>
										<th>Nivåkurs 3</th>
										<td><?php populate_with_education_years("lvlThreeYearSelect", $_SESSION['MEMBER_DATA']['lvl_three']);?></td>
									</tr>
									<tr>
										<th>Nivåkurs 4</th>
										<td><?php populate_with_education_years("lvlFourYearSelect", $_SESSION['MEMBER_DATA']['lvl_four']);?></td>
									</tr>
									<tr>
										<th>Gruppchef</th>							
										<td><?php populate_with_education_years("junUnitCommanderYearSelect", $_SESSION['MEMBER_DATA']['jun_unit_commander']);?></td>
									</tr>
									<tr>
										<th>Utbildarkurs</th>
										<td><?php populate_with_education_years("educationYearSelect", $_SESSION['MEMBER_DATA']['education']);?></td>
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
									//echo '<p class="result_paragraph">Du kan när som helst redigera medlemmars information genom <br /> menyn uppe på sidan.</p>';
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