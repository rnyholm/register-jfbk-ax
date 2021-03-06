<?php
	require_once('auth.php');
	require_once('functions.php');
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
		<h2>Visa utbildningshistorik för medlemmar i oldboysavdelningen <?php echo date("Y"); ?></h2>
				
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
		<?php include('print-page-footer.php'); ?>
	</body>
</html>