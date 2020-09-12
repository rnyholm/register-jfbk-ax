<?php
	require_once('auth.php');
	require_once('functions.php');
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
		<title>Jomala FBK - Ungdomsavdelningen - Kontaktlista</title>
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
				<h2>Ungdomsavdelningens kontaktlista</h2>
				<p>På denna sida listas kontaktuppgifter för medlemmar i ungdomsavdelningen. Även kontaktuppgifter till<br />
				föräldrar listas här. Om något är fel kan du ändra medlemmars information genom att klicka på "Redigera medlem".<br />
				Om du vill skriva ut denna sida klickar du bara på "Utskriftsvänlig version" så öppnas ett fönster med enbart tabellen,<br />
				tänk på att skriva ut som landskap(liggande) annars blir kanske inte hela tabellen utskriven.
				</p>
				
				
				<p>
					<input type="submit" name="editJunMemberButton" id="editJunMemberButton" value="Redigera medlemmar" onclick="location.href='edit-jun-member.php'" />
					<input type="submit" name="listContaclistJunMembersPfriendly" id="listContactlistJunMembersPfriendly" value="Utskriftsvänlig version" onclick="window.open('contact-list-jun-members-pfriendly.php','_blank','toolbar=yes,scrollbars=yes,width=1000,height=900')" />
				</p>
				<h2>Kontaktlista Ungdomsavdelningen <?php echo date("Y"); ?></h2>				
				
				<table id="jfbk_table" style="width: auto;">
					<tr>
						<th>Namn</th>
						<th>Telefonnummer</th>
						<th>Epost</th>
						<th>Förälder</th>
						<th>Förälders telefonnummer</th>
					</tr>
					
					<?php	
						//Get info from database
						$result = get_allnfo_jmember();
						
						//Variable to keep track if we should have alternating colors on table row or not
						$i = 0;
						
						//Loop through each row fetched from db query and populate table
						while($row = mysql_fetch_array($result)) {
							echo ("<tr"); if($i % 2){ echo(" class=\"alt\""); } echo("><td>");
							echo ($row['firstname'].' '.$row['lastname']);
							echo ("</td><td>");
							echo ($row['phone']);
							echo ("</td><td>");
							echo ($row['email']);
							echo ("</td><td>");
							echo ($row['nameice']);
							echo ("</td><td>");
							echo ($row['ice']);							
							echo ("</td></tr>");							
							$i++;
						}
					?>
				</table>
				<br />			
			</div>
		</div>
		<?php include('footer.php'); ?>
	</body>
</html>

