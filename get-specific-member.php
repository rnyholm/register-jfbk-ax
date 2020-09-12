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
		<title>Jomala FBK - Alarmavdelningen - Visa Information Om Medlem</title>
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
				<h2>Visa information om specifik medlem i alarmavdelningen</h2>
				<p>Välj medlem ur listan nedan och klicka sedan på "Hämta information" så visas all<br />
				information om vald medlem nedan.<br />
				Genom att klicka på knappen "Utskriftsvänlig version" öppnas all information om medlemmen<br />
				i ett nytt fönster, för att få en version som går bra att skriva ut.<br />
				<b>Endast aktiva medlemmar listas nedan!</b></p>
	
				
				<table id="form_table">
					<form id="getMemberInfoForm" name="getMemberInfoForm" method="post" action="get-specific-member-exec.php" style="display: inline;">
						<tr>
							<th>Välj medlem</th>
							<td><?php populate_with_active_members($_SESSION['MEMBER_DATA']['selected_member']);?></td>
						</tr>
						<tr>
							<td></td>
						<td>
							<input type="submit" name="Submit" value="Hämta information">
					</form>
							<input type="submit" name="getMemberPfriendly" id="getMemberPfriendly" value="Utskriftsvänlig version" onclick="window.open('get-specific-member-pfriendly.php','_blank','toolbar=yes,scrollbars=no,width=650,height=900')" />
							<input type="submit" name="editButton" id="editButton" value="Redigera medlemmar" onclick="location.href='edit-member.php'" />
						</td>
					</tr>
				</table>
	
				<?php
					if($_SESSION['MEMBER_DATA']['name'] != '') {?>
						<table id="form_table">
							<tr>
								<td>
									<table width="640" border="0" cellpadding="2" cellspacing="0">
										<col width="240" />
										<tr>
											<th class="heading" style="white-space:nowrap;">Information om medlem</th>
										</tr>
										<tr>
											<th>Manskaps nummer</th>
											<td><?php echo $_SESSION['MEMBER_DATA']['nr']; ?></td>
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
										<tr>
											<th>Telefonnummer</th>
											<td><?php echo $_SESSION['MEMBER_DATA']['phone']; ?></td>
										</tr>
										<tr>
											<th>E-post</th>
											<td><?php echo $_SESSION['MEMBER_DATA']['email']; ?></td>
										</tr>
										<tr>
											<th>Körkort</th>
											<td><?php echo $_SESSION['MEMBER_DATA']['driverslicense']; ?></td>
										</tr>
										<tr>
											<th>Närmsta anhörig</th>
											<td><?php echo $_SESSION['MEMBER_DATA']['nameice']; ?></td>
										</tr>	
										<tr>
											<th>Närmsta anhörigs telefonnummer</th>
											<td><?php echo $_SESSION['MEMBER_DATA']['ice']; ?></td>
										</tr>										
										<tr>
											<th>Inskrivningsår(Ungdomsavd.)</th>
											<td><?php echo $_SESSION['MEMBER_DATA']['juniorstarted']; ?></td>
										</tr>
										<tr>
											<th>Inskrivningsår(Alarmavd.)</th>
											<td><?php echo $_SESSION['MEMBER_DATA']['seniorstarted']; ?></td>
										</tr>
										<tr>
											<th>Medlem i styrelsen(nuvarande)</th>
											<td><?php echo $_SESSION['MEMBER_DATA']['board']; ?></td>
										</tr>
										<tr>
											<th>Kårchef</th>
											<td><?php echo $_SESSION['MEMBER_DATA']['chief']; ?></td>
										</tr>
										<tr>
											<th>Biträdande kårchef</th>
											<td><?php echo $_SESSION['MEMBER_DATA']['assistantchief']; ?></td>
										</tr>
										<tr>
											<th>Förtroende uppdrag</th>
											<td><?php echo $_SESSION['MEMBER_DATA']['assignmentintrust']; ?></td>
										</tr>
										<tr>
											<th>Tidigare brandkårer</th>
											<td><?php echo $_SESSION['MEMBER_DATA']['other_firedept']; ?></td>
										</tr>						
										<tr>
											<th valign="top">Utbildningar</th>
											<td><?php echo $_SESSION['MEMBER_DATA']['education']; ?></td>
										</tr>
										<tr>
											<th valign="top">Övriga utbildningar</th>
											<td><?php echo $_SESSION['MEMBER_DATA']['othereducation']; ?></td>
										</tr>
										<tr>
											<th valign="top">Junior utbildningar</th>
											<td><?php echo $_SESSION['MEMBER_DATA']['junioreducation']; ?></td>
										</tr>
										<tr>
											<th>Aktiv rökdykare</th>
											<td><?php echo $_SESSION['MEMBER_DATA']['active_smoke_diver']; ?></td>
										</tr>										
										<tr>
											<th>Uleåborgstest</th>
											<td><?php echo $_SESSION['MEMBER_DATA']['uleborg']; ?></td>
										</tr>
										<tr>
											<th>Belastnings EKG</th>
											<td><?php echo $_SESSION['MEMBER_DATA']['belastnekg']; ?></td>
										</tr>
										<tr>
											<th valign="top">Utmärkelser</th>
											<td><?php echo $_SESSION['MEMBER_DATA']['awards']; ?></td>
										</tr>
										<tr>
											<th valign="top">Övriga utmärkelser</th>
											<td><?php echo $_SESSION['MEMBER_DATA']['otheraward']; ?></td>
										</tr>
										<tr><td></td></tr>
	
									</table>
								</td>
							</tr>
						</table>
				<?php } ?>
			</div>
		</div>
		<?php include('footer.php'); ?>
	</body>
</html>