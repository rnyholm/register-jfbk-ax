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
		<title>Jomala FBK - Utbildning - Kökortssammanställning</title>
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
				<h2>Sammanställning av medlemmars körkort</h2>
				<p>Denna sida sammanställer alla aktiva medlemmars körkorts-klasser, de listas i olika tabeller nedan från a till de.<br />
				Om något är fel kan du ändra medlemmars information genom att klicka på "Redigera medlem".<br />
				Om du vill se information om alla medlemmar klickar du på "Lista medlemmar" nedan. <br />
				Du kommer även åt alla dessa sidor genom menyn uppe på sidan också. Om du vill skriva ut denna sida, <br />
				klickar du bara på "Utskriftsvänlig version" så öppnas ett fönster med enbart tabellen.</p>
				
				<p>
					<input type="submit" name="editMemberButton" id="editMemberButton" value="Redigera medlemmar" onclick="location.href='edit-member.php'" />
					<input type="submit" name="listMembersButton" id="listMembersButton" value="Lista medlemmar" onclick="location.href='list-members.php'" />
					<input type="submit" name="listDriverlicenseMembersPfriendly" id="listDriverlicenseMembersPfriendly" value="Utskriftsvänlig version" onclick="window.open('list-driverlicense-members-pfriendly.php','_blank','toolbar=yes,scrollbars=yes,width=650,height=900')" />
				</p>
				<h2>Jomala FBK's manskaps körkortssammanställning <?php echo date("Y"); ?></h2>
				
				<p>
					Det finns <b><u><?php echo(get_no_of_license('ALL')); ?></u></b> medlemmar i alarmavdelningen som innehar någon form av körkort.<br />
				</p>
				
				<h3>Manskap som innehar körkort av klass A</h3>
				<p>
					Det finns <b><u><?php echo(get_no_of_license('a')); ?></u></b> medlemmar i alarmavdelningen som innehar körkort med fordonsklass <u><b>A</b></u>.<br />
				</p>				
				
				<table id="jfbk_table" style="width: auto;">
					<col width="25"></col>
					<col width="350"></col>
					<tr>
						<th>Nr</th>
						<th>Namn</th>
						<th>Körkort</th>
					</tr>
					
					<?php	
						//Get info from database
						$result = get_nfo_of_license('a');
						
						//Variable to keep track if we should have alternating colors on table row or not
						$i = 0;
						
						//Loop through each row fetched from db query and populate table
						while($row = mysql_fetch_array($result)) {
							echo ("<tr"); if($i % 2){ echo(" class=\"alt\""); } echo("><td>");
							echo ($row['nr']);
							echo ("</td><td>");							
							echo ($row['firstname'].' '.$row['lastname']);
							echo ("</td><td>");
							echo ($row['driverslicense']);						
							echo ("</td></tr>");							
							
							$i++;
						}
					?>
				</table>
				
				<br />
				<h3>Manskap som innehar körkort av klass B</h3>
				<p>
					Det finns <b><u><?php echo(get_no_of_license('b')); ?></u></b> medlemmar i alarmavdelningen som innehar körkort med fordonsklass <u><b>B</b></u>.<br />
				</p>				
				
				<table id="jfbk_table" style="width: auto;">
					<col width="25"></col>
					<col width="350"></col>
					<tr>
						<th>Nr</th>
						<th>Namn</th>
						<th>Körkort</th>
					</tr>
					
					<?php	
						//Get info from database
						$result = get_nfo_of_license('b');
						
						//Variable to keep track if we should have alternating colors on table row or not
						$i = 0;
						
						//Loop through each row fetched from db query and populate table
						while($row = mysql_fetch_array($result)) {
							echo ("<tr"); if($i % 2){ echo(" class=\"alt\""); } echo("><td>");
							echo ($row['nr']);
							echo ("</td><td>");							
							echo ($row['firstname'].' '.$row['lastname']);
							echo ("</td><td>");
							echo ($row['driverslicense']);						
							echo ("</td></tr>");							
							
							$i++;
						}
					?>
				</table>
				
				<br />
				<h3>Manskap som innehar körkort av klass BE</h3>
				<p>
					Det finns <b><u><?php echo(get_no_of_license('be')); ?></u></b> medlemmar i alarmavdelningen som innehar körkort med fordonsklass <u><b>BE</b></u>.<br />
				</p>				
				
				<table id="jfbk_table" style="width: auto;">
					<col width="25"></col>
					<col width="350"></col>
					<tr>
						<th>Nr</th>
						<th>Namn</th>
						<th>Körkort</th>
					</tr>
					
					<?php	
						//Get info from database
						$result = get_nfo_of_license('be');
						
						//Variable to keep track if we should have alternating colors on table row or not
						$i = 0;
						
						//Loop through each row fetched from db query and populate table
						while($row = mysql_fetch_array($result)) {
							echo ("<tr"); if($i % 2){ echo(" class=\"alt\""); } echo("><td>");
							echo ($row['nr']);
							echo ("</td><td>");							
							echo ($row['firstname'].' '.$row['lastname']);
							echo ("</td><td>");
							echo ($row['driverslicense']);						
							echo ("</td></tr>");							
							
							$i++;
						}
					?>
				</table>	
				
				<br />
				<h3>Manskap som innehar körkort av klass C</h3>
				<p>
					Det finns <b><u><?php echo(get_no_of_license('c')); ?></u></b> medlemmar i alarmavdelningen som innehar körkort med fordonsklass <u><b>C</b></u>.<br />
				</p>				
				
				<table id="jfbk_table" style="width: auto;">
					<col width="25"></col>
					<col width="350"></col>
					<tr>
						<th>Nr</th>
						<th>Namn</th>
						<th>Körkort</th>
					</tr>
					
					<?php	
						//Get info from database
						$result = get_nfo_of_license('c');
						
						//Variable to keep track if we should have alternating colors on table row or not
						$i = 0;
						
						//Loop through each row fetched from db query and populate table
						while($row = mysql_fetch_array($result)) {
							echo ("<tr"); if($i % 2){ echo(" class=\"alt\""); } echo("><td>");
							echo ($row['nr']);
							echo ("</td><td>");							
							echo ($row['firstname'].' '.$row['lastname']);
							echo ("</td><td>");
							echo ($row['driverslicense']);						
							echo ("</td></tr>");							
							
							$i++;
						}
					?>
				</table>
				
				<br />
				<h3>Manskap som innehar körkort av klass CE</h3>
				<p>
					Det finns <b><u><?php echo(get_no_of_license('ce')); ?></u></b> medlemmar i alarmavdelningen som innehar körkort med fordonsklass <u><b>CE</b></u>.<br />
				</p>				
				
				<table id="jfbk_table" style="width: auto;">
					<col width="25"></col>
					<col width="350"></col>
					<tr>
						<th>Nr</th>
						<th>Namn</th>
						<th>Körkort</th>
					</tr>
					
					<?php	
						//Get info from database
						$result = get_nfo_of_license('ce');
						
						//Variable to keep track if we should have alternating colors on table row or not
						$i = 0;
						
						//Loop through each row fetched from db query and populate table
						while($row = mysql_fetch_array($result)) {
							echo ("<tr"); if($i % 2){ echo(" class=\"alt\""); } echo("><td>");
							echo ($row['nr']);
							echo ("</td><td>");							
							echo ($row['firstname'].' '.$row['lastname']);
							echo ("</td><td>");
							echo ($row['driverslicense']);						
							echo ("</td></tr>");							
							
							$i++;
						}
					?>
				</table>
				
				<br />
				<h3>Manskap som innehar körkort av klass D</h3>
				<p>
					Det finns <b><u><?php echo(get_no_of_license('d')); ?></u></b> medlemmar i alarmavdelningen som innehar körkort med fordonsklass <u><b>D</b></u>.<br />
				</p>				
				
				<table id="jfbk_table" style="width: auto;">
					<col width="25"></col>
					<col width="350"></col>
					<tr>
						<th>Nr</th>
						<th>Namn</th>
						<th>Körkort</th>
					</tr>
					
					<?php	
						//Get info from database
						$result = get_nfo_of_license('d');
						
						//Variable to keep track if we should have alternating colors on table row or not
						$i = 0;
						
						//Loop through each row fetched from db query and populate table
						while($row = mysql_fetch_array($result)) {
							echo ("<tr"); if($i % 2){ echo(" class=\"alt\""); } echo("><td>");
							echo ($row['nr']);
							echo ("</td><td>");							
							echo ($row['firstname'].' '.$row['lastname']);
							echo ("</td><td>");
							echo ($row['driverslicense']);						
							echo ("</td></tr>");							
							
							$i++;
						}
					?>
				</table>
				
				<br />
				<h3>Manskap som innehar körkort av klass DE</h3>
				<p>
					Det finns <b><u><?php echo(get_no_of_license('de')); ?></u></b> medlemmar i alarmavdelningen som innehar körkort med fordonsklass <u><b>DE</b></u>.<br />
				</p>				
				
				<table id="jfbk_table" style="width: auto;">
					<col width="25"></col>
					<col width="350"></col>
					<tr>
						<th>Nr</th>
						<th>Namn</th>
						<th>Körkort</th>
					</tr>
					
					<?php	
						//Get info from database
						$result = get_nfo_of_license('de');
						
						//Variable to keep track if we should have alternating colors on table row or not
						$i = 0;
						
						//Loop through each row fetched from db query and populate table
						while($row = mysql_fetch_array($result)) {
							echo ("<tr"); if($i % 2){ echo(" class=\"alt\""); } echo("><td>");
							echo ($row['nr']);
							echo ("</td><td>");							
							echo ($row['firstname'].' '.$row['lastname']);
							echo ("</td><td>");
							echo ($row['driverslicense']);						
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

