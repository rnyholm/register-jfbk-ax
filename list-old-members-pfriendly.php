<?php
	require_once('auth.php');
	require_once('functions.php');
	
	$members = get_no_of_active_omembers();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Jomala FBK - Oldboysavdelningen - Lista Medlemmar</title>
		<!--Hack to force internet explorer to show page as ie7 browser-->
		<meta http-equiv="X-UA-Compatible" content="IE=7"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/main.css" rel="stylesheet" type="text/css" />
		<link rel="icon" type="image/x-icon" href="css/images/icon.ico" />
	</head>
	
	<body>
		<h2>Medlemmar i Oldboysavdelningen <?php echo date("Y"); ?></h2>
		
		<p>
			Det finns <b><u><?php echo($members); ?></u></b> aktiva medlemmar i oldboysavdelningen.<br />
			Antal år(i medel) som oldboysavdelningens medlemmar varit aktiva i kåren är <b><u><?php echo(number_format(avg_years_as_members_ocrew())); ?></u></b> år.<br />
			Medelåldern för medlemmarna i oldboysavdelningen är <b><u><?php echo(number_format(avg_age_members_ocrew())); ?></u></b> år.
		</p>
		
		<table id="jfbk_table">
			<tr>
				<th>Namn</th>
				<th>Födelsedatum</th>
				<th>Ålder</th>
				<th>Telefonnummer</th>
				<th>E-post</th>
				<th>Inskrivningsår</th>
				<th>Närmsta anhörig</th>
				<th>Närmsta anhörigs tel. nummer</th>				
			</tr>
			
			<?php	
				//Get info from database
				$result = get_allnfo_omember();
				
				//Variable to keep track if we should have alternating colors on table row or not
				$i = 0;
				
				//Loop through each row fetched from db query and populate table
				while($row = mysql_fetch_array($result)) {
					echo ("<tr"); if($i % 2){ echo(" class=\"alt\""); } echo("><td>");
					echo ($row['firstname'].' '.$row['lastname']);
					echo ("</td><td>");
					echo substr($row['dob'],-2,2).'.'.substr($row['dob'],-5,2).'-'.substr($row['dob'],-10,4);
					echo ("</td><td>");
					echo (calculate_age($row['dob']));
					echo ("</td><td>");
					echo ($row['phone']);
					echo ("</td><td>");
					echo ($row['email']);
					echo ("</td><td>");
					echo ($row['started']);
					echo ("</td><td>");
					echo ($row['nameice']);
					echo ("</td><td>");
					echo ($row['ice']);					
					echo ("</td></tr>");
					
					$i++;
				}
			?>
		</table>
		<?php include('print-page-footer.php'); ?>
	</body>
</html>