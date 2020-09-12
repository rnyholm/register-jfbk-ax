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
		<title>Jomala FBK - Utbildning - Visa utbildningshistorik</title>
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
				<h2>Visa utbildningshistorik för medlemmar i alarmavdelningen <?php echo date("Y"); ?></h2>
				<p>Nedan visas utbildningshistorik för varje aktiv medlem i alarmavdelningen.<br />
				För att se personlig information om medlemmen klickar du på knappen nedan eller går in via menyn<br />
				uppe på sidan, likaså ifall du vill redigera information om någon medlem.<br />
				Om du vill skriva ut tabellen, trycker du på knappen nedan så öppnas en ny sida med enbart tabellen,<br />
				tänk på att skriva ut som landskap(liggande) annars blir inte hela tabellen utskriven.</p>
				
				<p>
					<input type="submit" name="editMemberButton" id="editMemberButton" value="Redigera medlemmar" onclick="location.href='edit-member.php'" />
					<input type="submit" name="listMemberButton" id="listMemberButton" value="Lista medlemmar" onclick="location.href='list-members.php'" />
					<input type="submit" name="getMembersEduPfriendly" id="getMembersEduPfriendly" value="Utskriftsvänlig version" onclick="window.open('get-members-education-pfriendly.php','_blank','toolbar=yes,scrollbars=yes,width=1000,height=900')" />
				</p>
				
				<p><u>Kursförkortningar</u><br />
				<b>SM</b>-Släckningsman | <b>RM</b>-Räddningsman | <b>RD</b>-Rökdykare | <b>BFF</b>-Basic Fire Fighting | <b>APHH</b>-Arbete på hög höjd | 
				<b>YLR</b>-Ytlivräddning | <b>BFHJ</b>-Brandkårens första hjälp<br />
				<b>SD</b>-Syredelegering | <b>KC</b>-Kårchef | <b>EC</b>-Enhetschef | <b>ÖU</b>-Övrig utbildning | <b>JU</b>-Utbildningar som junior</p>
				
				<table id="jfbk_table">
					<tr>
						<th>Nr</th>
						<th>Namn</th>
						<th>SM</th>
						<th>RM</th>
						<th>RD</th>
						<th>BFF</th>
						<th>APHH</th>
						<th>YLR</th>
						<th>BFHJ</th>
						<th>SD</th>
						<th>KC</th>
						<th>EC</th>
						<th>ÖU</th>
						<th>JU</th>
					</tr>
					
					<?php
						//Get information about junior members
						$result = get_allnfo_member();
						
						//Variable to keep track if we should have alternating colors on table row or not
						$i = 0;
						
						//Loop through each row fetched from db query and populate table
						while($row = mysql_fetch_array($result)) {
							echo ("<tr"); if($i % 2){ echo(" class=\"alt\""); } echo("><td>");
							echo ($row['nr']);
							echo ("</td><td>");
							echo ($row['firstname'].' '.$row['lastname']);
							echo ("</td><td>");
							
							//If statements to print correct data in table
							if($row['extman'] == 'not_done') {
								echo ("");
							} else {
								echo ($row['extman']);
							}
							echo ("</td><td>");
							
							if($row['rescman'] == 'not_done') {
								echo ("");
							} else {
								echo ($row['rescman']);
							}
							echo ("</td><td>");
							
							if($row['smokediver'] == 'not_done') {
								echo ("");
							} else {
								echo ($row['smokediver']);
							}
							echo ("</td><td>");
							
							if($row['basicff'] == 'not_done') {
								echo ("");
							} else {
								echo ($row['basicff']);
							}
							echo ("</td><td>");							
							
							if($row['highwork'] == 'not_done') {
								echo ("");
							} else {
								echo ($row['highwork']);
							}
							echo ("</td><td>");
							
							if($row['surfacerescue'] == 'not_done') {
								echo ("");
							} else {
								echo ($row['surfacerescue']);
							}
							echo ("</td><td>");
							
							if($row['firstaid'] == 'not_done') {
								echo ("");
							} else {
								echo ($row['firstaid']);
							}
							echo ("</td><td>");
							
							if($row['oxygen'] == 'not_done') {
								echo ("");
							} else {
								echo ($row['oxygen']);
							}
							echo ("</td><td>");
							
							if($row['chiefedu'] == 'not_done') {
								echo ("");
							} else {
								echo ($row['chiefedu']);
							}
							echo ("</td><td>");							
							
							if($row['unitcommander'] == 'not_done') {
								echo ("");
							} else {
								echo ($row['unitcommander']);
							}
							
							echo ("</td><td>");
							
							echo ($row['othereducation']);
							
							echo ("</td><td>");
							
							echo ($row['junioredusummary']);
							
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