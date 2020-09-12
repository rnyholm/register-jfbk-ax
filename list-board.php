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
		<title>Jomala FBK - Styrelsen - Lista Styrelsen</title>
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
				<h2>Lista medlemmar i styrelsen</h2>
				<p>Alla medlemmar i styrelsen och deras kontaktuppgifter samt styrelseuppdrag listas nedan. <br />
				Även kassören listas här, fast separat då denne inte hör till styrelsen. <br />
				För att ändra styrelsemedlems information kan du klicka på "Redigera styrelsemedlem"<br />
				Om du vill skriva ut tabellen, klickar du bara på "Utskriftsvänlig version" så öppnas ett<br />
				fönster med enbart tabellen.</p>
				
				<p>
					<input type="submit" name="editButton" id="editButton" value="Redigera styrelsemedlem" onclick="location.href='edit-board-member.php'" />
					<input type="submit" name="listMembersPfriendly" id="listMembersPfriendly" value="Utskriftsvänlig version" onclick="window.open('list-board-pfriendly.php','_blank','toolbar=yes,scrollbars=yes,width=700,height=900')" />
				</p>
				<h3>Jomala FBK's styrelse <?php echo date("Y"); ?></h3>
				<table id="jfbk_table">
					<tr>
						<th>Namn</th>
						<th>Telefonnummer</th>
						<th>E-post</th>
						<th>Styrelseuppdrag</th>
						<th>Avdelning</th>
					</tr>
					
					<?php	
						//Get info from database
						$result = get_nfo_board_members();
						
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
							echo ($row['boardrole']);
							echo ("</td><td>");
							
							//If cases for type of member
							if($row['type'] == 'senior') {
								echo ("Alarm");
							} else if($row['type'] == 'oldboy') {
								echo ("Oldboy");
							} else {
								echo ("Extern");
							}							
							echo ("</td></tr>");							
							
							$i++;
						}
					?>
				</table>
				
				<h3>Jomala FBK's kassör <?php echo date("Y"); ?></h3>
				<table id="jfbk_table">
					<tr>
						<th>Namn</th>
						<th>Telefonnummer</th>
						<th>E-post</th>
						<th>Uppdrag</th>
						<th>Avdelning</th>
					</tr>
					
					<?php	
						//Get info from database
						$result = get_nfo_kassor_members();
						
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
							echo ($row['boardrole']);
							echo ("</td><td>");
							
							//If cases for type of member
							if($row['type'] == 'senior') {
								echo ("Alarm");
							} else if($row['type'] == 'oldboy') {
								echo ("Oldboy");
							} else {
								echo ("Extern");
							}							
							echo ("</td></tr>");							
							
							$i++;
						}
					?>
				</table>
				*Extern, medlem som inte är med operativt i kåren utan bara sitter i styrelsen.				
			</div>
		</div>
		<?php include('footer.php'); ?>
	</body>
</html>