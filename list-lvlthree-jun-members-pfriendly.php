<?php
	require_once('auth.php');
	require_once('functions.php');
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
		<?php include('print-page-footer.php'); ?>
	</body>
</html>

