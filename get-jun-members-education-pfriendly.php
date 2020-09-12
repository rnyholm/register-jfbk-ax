<?php
	require_once('auth.php');
	require_once('functions.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Jomala FBK - Ungdomsavdelningen - Utbildningshistorik</title>
		<!--Hack to force internet explorer to show page as ie7 browser-->
		<meta http-equiv="X-UA-Compatible" content="IE=7"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/main.css" rel="stylesheet" type="text/css" />
		<link rel="icon" type="image/x-icon" href="css/images/icon.ico" />
	</head>
	
	<body>
		<h2>Utbildningshistorik för medlemmar i ungdomsavdelningen <?php echo date("Y"); ?></h2>
		
		<table id="jfbk_table">
			<tr>
				<th>Namn</th>
				<th>Nybörjarkurs</th>
				<th>Nivåkurs 1</th>
				<th>Nivåkurs 2</th>
				<th>Nivåkurs 3</th>
				<th>Nivåkurs 4</th>
				<th>Gruppchef</th>
				<th>Utbildarkurs</th>
			</tr>
			
			<?php
				//Get information about junior members
				$result = get_allnfo_jmember();
				
				//Variable to keep track if we should have alternating colors on table row or not
				$i = 0;
				
				//Loop through each row fetched from db query and populate table
				while($row = mysql_fetch_array($result)) {
					echo ("<tr"); if($i % 2){ echo(" class=\"alt\""); } echo("><td>");
					echo ($row['firstname'].' '.$row['lastname']);
					echo ("</td><td>");
					
					//If statements to print correct data in table
					if($row['beginner'] == 'not_done') {
						echo ("");
					} else {
						echo ($row['beginner']);
					}
					echo ("</td><td>");
					
					if($row['lvlone'] == 'not_done') {
						echo ("");
					} else {
						echo ($row['lvlone']);
					}
					echo ("</td><td>");
					
					if($row['lvltwo'] == 'not_done') {
						echo ("");
					} else {
						echo ($row['lvltwo']);
					}
					echo ("</td><td>");
					
					if($row['lvlthree'] == 'not_done') {
						echo ("");
					} else {
						echo ($row['lvlthree']);
					}
					echo ("</td><td>");
					
					if($row['lvlfour'] == 'not_done') {
						echo ("");
					} else {
						echo ($row['lvlfour']);
					}
					echo ("</td><td>");
					
					if($row['jununitcommander'] == 'not_done') {
						echo ("");
					} else {
						echo ($row['jununitcommander']);
					}
					echo ("</td><td>");
					
					if($row['education'] == 'not_done') {
						echo ("");
					} else {
						echo ($row['education']);
					}
					echo ("</td></tr>");
					
					$i++;
				}
			?>
		</table>
		<?php include('print-page-footer.php'); ?>
	</body>
</html>