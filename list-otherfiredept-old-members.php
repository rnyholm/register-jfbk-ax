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
		<title>Jomala FBK - Oldboysavdelningen - Tidigare Brandkårer</title>
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
				<h2>Medlemmar i oldboysavdelningen som tidigare varit medlem i annan brandkår</h2>
				<p>På denna sida listas medlemmar i oldboysavdelningen som tidigare varit medlem i annan brandkår.<br />
				Om något är fel kan du ändra medlemmars information genom att klicka på "Redigera medlemmar".<br />
				Om du vill skriva ut denna sida klickar du bara på "Utskriftsvänlig version" så öppnas ett fönster med enbart tabellen.
				</p>
				
				
				<p>
					<input type="submit" name="editOldMemberButton" id="editOldMemberButton" value="Redigera medlemmar" onclick="location.href='edit-old-member.php'" />
					<input type="submit" name="listOtherfiredeptOldMembersPfriendly" id="listOtherfiredeptOldMembersPfriendly" value="Utskriftsvänlig version" onclick="window.open('list-otherfiredept-old-members-pfriendly.php','_blank','toolbar=yes,scrollbars=yes,width=700,height=900')" />
				</p>
				<h2>Medlemmar i Oldboysavdelningen med tidigare brandkår <?php echo date("Y"); ?></h2>
				
				<p>
					Det finns <b><u><?php echo(get_no_of_old_otherfiredept()); ?></u></b> medlemmar i oldboysavdelningen som tidigare varit medlem i annan kår.<br />
				</p>				
				
				<table id="jfbk_table" style="width: auto;">
					<tr>
						<th>Namn</th>
						<th>Tidigare kår</th>
					</tr>
					
					<?php	
						//Get info from database
						$result = get_nfo_of_old_otherfiredept();
						
						//Variable to keep track if we should have alternating colors on table row or not
						$i = 0;
						
						//Loop through each row fetched from db query and populate table
						while($row = mysql_fetch_array($result)) {
							echo ("<tr"); if($i % 2){ echo(" class=\"alt\""); } echo("><td>");
							echo ($row['firstname'].' '.$row['lastname']);
							echo ("</td><td>");
							echo ($row['otherfiredept']);						
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
