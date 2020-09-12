<?php
	require_once('auth.php');
	require_once('functions.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Jomala FBK - Utmärkelser - Lista utdelade utmärkelser</title>
		<!--Hack to force internet explorer to show page as ie7 browser-->
		<meta http-equiv="X-UA-Compatible" content="IE=7"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/main.css" rel="stylesheet" type="text/css" />
		<link rel="icon" type="image/x-icon" href="css/images/icon.ico" />
	</head>
	
	<body>
		<h2>Jomala FBK's utdelade utmärkelser <?php echo date("Y"); ?></h2>		
		<u>Förkortningar för utmärkelser</u><br />
		<table>
		<tr style="line-height: 15px;"><td><b>JFBK 5</b>-JFBK's förtjänstetecken 5 år, nål </td><td>| <b>FSB 10</b>-FSB's förtjänstetecken 10 år, medalj(brons)</td></tr>
		<tr style="line-height: 15px;"><td><b>FSB 20</b>-FSB's förtjänstetecken 20 år, medalj(silver) </td><td>| <b>FSB 30</b>-FSB's förtjänstetecken 30 år, medalj(guld)</td></tr>
		<tr style="line-height: 15px;"><td><b>JFBK special</b>-JFBK's förtjänstetecken, special medalj </td><td>| <b>ÖU</b>-Övriga utmärkelser</td></tr>
		</table>	
		
		<table id="jfbk_table" style="width: auto;">
			<tr>
				<th>Namn</th>
				<th>Avdelning</th>
				<th>JFBK 5</th>
				<th>FSB 10</th>
				<th>FSB 20</th>
				<th>FSB 30</th>
				<th>JFBK special</th>
				<th>ÖU</th>
			</tr>
			
			<?php	
				//Get info from database
				$result = get_allnfo_member_omember();
				
				//Variable to keep track if we should have alternating colors on table row or not
				$i = 0;
				
				//Loop through each row fetched from db query and populate table
				while($row = mysql_fetch_array($result)) {
					
					if($row['fiveyearpin'] != 'not_assigned' || $row['tenyearpin'] != 'not_assigned' || $row['twentyyearpin'] != 'not_assigned' || $row['thirtyyearpin'] != 'not_assigned' || $row['specialpin'] != 'not_assigned' || $row['otheraward'] != '') {
						echo ("<tr"); if($i % 2){ echo(" class=\"alt\""); } echo("><td>");
						echo ($row['firstname'].' '.$row['lastname']);
						echo ("</td><td>");
						
						if($row['type'] == 'senior') {
							echo ('Alarm');
						} else {
							echo ('Oldboy');
						}
						
						echo ("</td><td>");		

						if($row['fiveyearpin'] != 'not_assigned') {
							echo ($row['fiveyearpin']);
						} else {
							echo ("");
						}
						echo ("</td><td>");
						
						if($row['tenyearpin'] != 'not_assigned') {
							echo ($row['tenyearpin']);
						} else {
							echo ("");
						}
						echo ("</td><td>");
						
						if($row['twentyyearpin'] != 'not_assigned') {
							echo ($row['twentyyearpin']);
						} else {
							echo("");
						}
						echo ("</td><td>");
						
						if($row['thirtyyearpin'] != 'not_assigned') {
							echo ($row['thirtyyearpin']);
						} else {
							echo("");
						}
						echo ("</td><td>");

						if($row['specialpin'] != 'not_assigned') {
							echo ($row['specialpin']);
						} else {
							echo("");
						}
						echo ("</td><td>");
						
						echo ($row['otheraward']);						
						echo ("</td></tr>");							
						$i++;
					}
				}
			?>
		</table>
		<p style="margin-top: 0px;">*Årtalet anger det år som utmärkelsen erhållits.
		Tabellen ovan listar enbart medlemmar som erhållit någon utmärkelse</p>
		<br />			
		<?php include('print-page-footer.php'); ?>
	</body>
</html>

