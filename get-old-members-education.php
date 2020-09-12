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
		<title>Jomala FBK - Oldboysavdelningen - Visa utbildningshistorik</title>
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
				<h2>Visa utbildningshistorik för medlemmar i oldboysavdelningen <?php echo date("Y"); ?></h2>
				<p>Nedan visas utbildningshistorik för varje aktiv medlem i oldboysavdelningen.<br />
				För att se personlig information om medlemmen klickar du på knappen nedan eller går in via menyn<br />
				uppe på sidan, likaså ifall du vill redigera information om någon medlem.<br />
				Om du vill skriva ut tabellen, trycker du på knappen nedan så öppnas en ny sida med enbart tabellen,<br />
				tänk på att skriva ut som landskap(liggande) annars blir inte hela tabellen utskriven.</p>
				
				<p>
					<input type="submit" name="editOldMemberButton" id="editOldMemberButton" value="Redigera medlemmar" onclick="location.href='edit-old-member.php'" />
					<input type="submit" name="listOldMemberButton" id="listOldMemberButton" value="Lista medlemmar" onclick="location.href='list-old-members.php'" />
					<input type="submit" name="getOldMembersEduPfriendly" id="getOldMembersEduPfriendly" value="Utskriftsvänlig version" onclick="window.open('get-old-members-education-pfriendly.php','_blank','toolbar=yes,scrollbars=yes,width=1000,height=900')" />
				</p>
				
				<table id="jfbk_table" style="width: auto;">
					<tr>
						<th>Namn</th>
						<th>Juniorutbildningar</th>
						<th>Seniorutbildningar</th>
						<th>Övriga utbildningar</th>
					</tr>
					
					<?php
						//Get information about oldboy members
						$result = get_allnfo_omember();
						
						//Variable to keep track if we should have alternating colors on table row or not
						$i = 0;
						
						//Loop through each row fetched from db query and populate table
						while($row = mysql_fetch_array($result)) {
							echo ("<tr"); if($i % 2){ echo(" class=\"alt\""); } echo("><td>");
							echo ($row['firstname'].' '.$row['lastname']);
							echo ("</td><td>");				
							echo ($row['junioredusummary']);							
							echo ("</td><td>");							
							echo ($row['senioredusummary']);														
							echo ("</td><td>");							
							echo ($row['othereducation']);							
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