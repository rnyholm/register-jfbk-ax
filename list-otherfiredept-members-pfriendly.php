<?php
	require_once('auth.php');
	require_once('functions.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Jomala FBK - Alarmavdelningen - Tidigare Brandkårer</title>
		<!--Hack to force internet explorer to show page as ie7 browser-->
		<meta http-equiv="X-UA-Compatible" content="IE=7"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/main.css" rel="stylesheet" type="text/css" />
		<link rel="icon" type="image/x-icon" href="css/images/icon.ico" />
	</head>
	
	<body>
		<h2>Manskap i Alarmavdelningen med tidigare brandkår <?php echo date("Y"); ?></h2>
		
		<p>
			Det finns <b><u><?php echo(get_no_of_otherfiredept()); ?></u></b> medlemmar i alarmavdelningen som tidigare varit medlem i annan kår.<br />
		</p>				
		
		<table id="jfbk_table" style="width: auto;">
			<tr>
				<th>Nr</th>
				<th>Namn</th>
				<th>Tidigare kår</th>
			</tr>
			
			<?php	
				//Get info from database
				$result = get_nfo_of_otherfiredept();
				
				//Variable to keep track if we should have alternating colors on table row or not
				$i = 0;
				
				//Loop through each row fetched from db query and populate table
				while($row = mysql_fetch_array($result)) {
					echo ("<tr"); if($i % 2){ echo(" class=\"alt\""); } echo("><td>");
					echo ($row['nr']);
					echo ("</td><td>");
					echo ($row['firstname'].' '.$row['lastname']);
					echo ("</td><td>");
					echo ($row['otherfiredept']);						
					echo ("</td></tr>");							
					$i++;
				}
			?>
		</table>
		<?php include('print-page-footer.php'); ?>
	</body>
</html>
