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
		<title>Jomala FBK - Alarmavdelningen - Lista Kårchef, Biträdande Kårchef och Enhetschefer</title>
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
				<h2>Lista Kårchef, Biträdande Kårchef och Enhetschefer</h2>
				<p>På denna sida listas kårchef, biträdande kårchef och enhetschefer(enhetschefsutbildade) samt deras kontaktuppgifter.<br />
				Om något är fel kan du ändra medlemmars information genom att klicka på "Redigera medlemmar".<br />
				Om du vill skriva ut denna sida klickar du bara på "Utskriftsvänlig version" så öppnas ett fönster med enbart tabellen.
				</p>
				
				
				<p>
					<input type="submit" name="editMemberButton" id="editMemberButton" value="Redigera medlemmar" onclick="location.href='edit-member.php'" />
					<input type="submit" name="listChiefAndAssistantChiefMembersPfriendly" id="listChiefAndAssistantChiefMembersPfriendly" value="Utskriftsvänlig version" onclick="window.open('list-chief-assistantchief-members-pfriendly.php','_blank','toolbar=yes,scrollbars=yes,width=700,height=900')" />
				</p>
				<h2>Jomala FBK's Kårchef & Biträdande Kårchef  <?php echo date("Y"); ?></h2>				
				
				<table id="jfbk_table" style="width: auto;">
					<tr>
						<th>Nr</th>
						<th>Namn</th>
						<th>Telefonnummer</th>
						<th>Epost</th>
						<th>Position</th>
					</tr>
					
					<?php	
						//Get info from database
						$result = get_nfo_chief_assistantchief_omembers();
						
						//Variable to keep track if we should have alternating colors on table row or not
						$i = 0;
						
						//Loop through each row fetched from db query and populate table
						while($row = mysql_fetch_array($result)) {
							echo ("<tr"); if($i % 2){ echo(" class=\"alt\""); } echo("><td>");
							echo ($row['nr']);
							echo ("</td><td>");
							echo ($row['firstname'].' '.$row['lastname']);
							echo ("</td><td>");
							echo ($row['phone']);
							echo ("</td><td>");
							echo ($row['email']);
							echo ("</td><td>");
							
							if($row['chief'] == 'yes') {
								echo ('Kårchef');
							} elseif ($row['assistantchief'] == 'yes') {
								echo ('Biträdande kårchef');
							}					
							echo ("</td></tr>");							
							$i++;
						}
					?>
				</table>
				<br />
				<h2>Jomala FBK's Enhetschefer <?php echo date("Y"); ?></h2>
				
				<table id="jfbk_table" style="width: auto;">
					<tr>
						<th>Nr</th>
						<th>Namn</th>
						<th>Telefonnummer</th>
						<th>Epost</th>
					</tr>
					
					<?php	
						//Get info from database
						$result = get_nfo_unitcommander_members();
						
						//Variable to keep track if we should have alternating colors on table row or not
						$i = 0;
						
						//Loop through each row fetched from db query and populate table
						while($row = mysql_fetch_array($result)) {
							echo ("<tr"); if($i % 2){ echo(" class=\"alt\""); } echo("><td>");
							echo ($row['nr']);
							echo ("</td><td>");							
							echo ($row['firstname'].' '.$row['lastname']);
							echo ("</td><td>");
							echo ($row['phone']);
							echo ("</td><td>");
							echo ($row['email']);				
							echo ("</td></tr>");							
							
							$i++;
						}
					?>
				</table>						
			</div>
		</div>
		<?php include('footer.php'); ?>
	</body>
</html>