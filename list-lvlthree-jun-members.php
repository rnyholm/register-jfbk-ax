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
		<title>Jomala FBK - Ungdomsavdelningen - Lista Nivåkurs 3</title>
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
				<h2>Medlemmar som genomfört Nivåkurs 3</h2>
				<p>Denna sida listar alla aktiva medlemmar i ungdomsavdelningen som genomfört Nivåkurs 3. <br />
				Om något är fel kan du ändra medlemmars information genom att klicka på "Redigera medlem".<br />
				För att se all utbildningshistorik över ungdomsavdelningen klickar du bara på "Visa utbildningshistorik".<br />
				Om du vill se information om alla medlemmar i ungdomsavdelningen klickar du på "Lista medlemmar" nedan. <br />
				Du kommer även åt alla dessa sidor genom menyn uppe på sidan också. Om du vill skriva ut denna sida, <br />
				klickar du bara på "Utskriftsvänlig version" så öppnas ett fönster med enbart tabellen.</p>
				
				<p>
					<input type="submit" name="editJunMemberButton" id="editJunMemberButton" value="Redigera medlemmar" onclick="location.href='edit-jun-member.php'" />
					<input type="submit" name="listJunMembersEduButton" id="listJunMembersEduButton" value="Visa utbildningshistorik" onclick="location.href='get-jun-members-education.php'" />
					<input type="submit" name="listJunMembersButton" id="listJunMembersButton" value="Lista medlemmar" onclick="location.href='list-jun-members.php'" />
					<input type="submit" name="listLvlthreeJunMembersPfriendly" id="listLvlthreeJunMembersPfriendly" value="Utskriftsvänlig version" onclick="window.open('list-lvlthree-jun-members-pfriendly.php','_blank','toolbar=yes,scrollbars=yes,width=650,height=900')" />
				</p>
				<h2>Jomala FBK's Ungdomar som genomfört Nivåkurs 3 - <?php echo date("Y"); ?></h2>
				
				<p>
					Det finns <b><u><?php echo(get_no_of_lvlthree('ALL')); ?></u></b> medlemmar i ungdomsavdelningen som genomfört Nivåkurs 3.<br />
				</p>
				
				<table id="jfbk_table" style="width: auto;">
					<col width="350"></col>
					<tr>
						<th>Namn</th>
						<th>År</th>
					</tr>
					
					<?php	
						//Get info from database
						$result = get_nfo_lvlthree_jmembers();
						
						//Variable to keep track if we should have alternating colors on table row or not
						$i = 0;
						
						//Loop through each row fetched from db query and populate table
						while($row = mysql_fetch_array($result)) {
							echo ("<tr"); if($i % 2){ echo(" class=\"alt\""); } echo("><td>");							
							echo ($row['firstname'].' '.$row['lastname']);
							echo ("</td><td>");
							echo ($row['lvlthree']);						
							echo ("</td></tr>");							
							
							$i++;
						}
					?>
				</table>
				<p style="margin-top: 0px;">*År, årtal då utbildningen genomfördes.</p>				
			</div>
		</div>
		<?php include('footer.php'); ?>
	</body>
</html>

