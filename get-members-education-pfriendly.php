<?php
	require_once('auth.php');
	require_once('functions.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Jomala FBK - Utbildning - Utbildningshistorik Medlemmar i Alarmavdelningen</title>
		<!--Hack to force internet explorer to show page as ie7 browser-->
		<meta http-equiv="X-UA-Compatible" content="IE=7"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/main.css" rel="stylesheet" type="text/css" />
		<link rel="icon" type="image/x-icon" href="css/images/icon.ico" />
	</head>
	
	<body>
		<h2>Utbildningshistorik för medlemmar i alarmavdelningen <?php echo date("Y"); ?></h2>
		
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
		<?php include('print-page-footer.php'); ?>
	</body>
</html>