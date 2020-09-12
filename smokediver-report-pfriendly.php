<?php
	require_once('auth.php');
	require_once('functions.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Jomala FBK - Rökdykare - Sammanställning av Rökdykare</title>
		<!--Hack to force internet explorer to show page as ie7 browser-->
		<meta http-equiv="X-UA-Compatible" content="IE=7"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/main.css" rel="stylesheet" type="text/css" />
		<link rel="icon" type="image/x-icon" href="css/images/icon.ico" />
	</head>
	
	<body>
		<h2>Jomala FBK's Rökdykar sammanställning <?php echo date("Y"); ?></h2>
				
		<p>Godkända Rökdykare: <b><u><?php echo get_no_of_active_qualified_smokedivers(); ?></u></b> st <br />
		Rökdykare ej godkända pga. Uleåborgstestet: <b><u><?php echo get_no_of_smokedivers_need_uleborgtest(); ?></u></b> st<br />
		Rökdykare ej godkända pga. Belastnings EKG: <b><u><?php echo get_no_of_smokedivers_need_belastnekg(); ?></u></b> st</p>
		
		<h3>Godkända Rökdykare</h3>
		<p>Aktiva rökdykare som har utfört uleåborgstestet samt belastnings Ekg med godkänt resultat.</p>
		
		<table id="jfbk_table" style="width: auto;">
			<tr>
				<th>Nr</th>
				<th>Namn</th>
				<th>Uleåborgstest(utfört)</th>
				<th>Belastnings EKG(utfört)</th>
				<th>Utbildning</th>
			</tr>
			
			<?php	
				//Get info from database
				$result = get_nfo_all_active_smokemen_members();
				
				//Variable to keep track if we should have alternating colors on table row or not
				$i = 0;
				
				//Controller variables
				$valid = false;
				$education = '';
				
				//Loop through each row fetched from db query and populate table
				while($row = mysql_fetch_array($result)) {
					
					if($row['uleborgtest'] != 'not_done') {
						if($row['uleborgtest'] > (date('Y')-2)) {
							if($row['uleborgresult'] == 'passed') {
								if($row['belastnekg'] != 'not_done') {
									if($row['belastnekgresult'] == 'passed') {
										$valid = true;
										if($row['smokediver'] != 'not_done') {
											$education = $education."ÅBF's Rökdykarutbildning";
										}
										if($row['basicff'] != 'not_done') {
											if($education == '') {
												$education = $education."Basic Fire Fighting";
											} else {
												$education = $education.", Basic Fire Fighting";
											}
										}
									}
								}
							}
						}
					}
					
					if($valid) {
						echo ("<tr"); if($i % 2){ echo(" class=\"alt\""); } echo("><td>");
						echo ($row['nr']);
						echo ("</td><td>");							
						echo ($row['firstname'].' '.$row['lastname']);
						echo ("</td><td>");
						echo ($row['uleborgtest']);	
						echo ("</td><td>");	
						echo ($row['belastnekg']);
						echo ("</td><td>");	
						echo ($education);
						echo ("</td></tr>");							
						
						$i++;
					}
					
					$valid = false;
					$education = '';							
				}
			?>
		</table>
		<br />
		
		<h3>Rökdykare ej godkända pga. Uleåborgstestet</h3>
		<p>Aktiva rökdykare som har ett icke godkänt och/eller föråldrat uleåborgstest. Eller ej utfört uleåborgstest.</p>
		
		<table id="jfbk_table" style="width: auto;">
			<tr>
				<th>Nr</th>
				<th>Namn</th>
				<th>Uleåborgstest(utfört/resultat)</th>
				<th>Orsak</th>
			</tr>
			
			<?php	
				//Get info from database
				$result = get_nfo_all_active_smokemen_members();
				
				//Variable to keep track if we should have alternating colors on table row or not
				$i = 0;
				
				//Controller variables
				$notvalid = false;
				$cause = '';
				
				//Loop through each row fetched from db query and populate table
				while($row = mysql_fetch_array($result)) {
					
					if($row['uleborgtest'] == 'not_done') {
							$notvalid = true;
							$cause = $cause."Ej utfört uleåborgstest";
					}
					
					else {
						if($row['uleborgtest'] < (date('Y')-1)) {
							$notvalid = true;
							if($cause == '') {
								$cause = $cause."Uleåborgstestet är föråldrat";
							} else {
								$cause = $cause.", Uleåborgstestet är föråldrat";
							}
						}
						if($row['uleborgresult'] =='failed') {
							$notvalid = true;
							if($cause == '') {
								$cause = $cause."Ej godkänt resultat vid senaste uleåborgstestet";
							} else {
								$cause = $cause.", Ej godkänt resultat vid senaste uleåborgstestet";
							}
						}								
					}
					
					if($notvalid) {
						echo ("<tr"); if($i % 2){ echo(" class=\"alt\""); } echo("><td>");
						echo ($row['nr']);
						echo ("</td><td>");							
						echo ($row['firstname'].' '.$row['lastname']);
						echo ("</td><td>");
						
						if($row['uleborgtest'] == 'not_done') {
							echo ('-');
						} else {
							echo ($row['uleborgtest'].'/');
							if($row['uleborgresult'] == 'passed') {
								echo ('Godkänd');
							} else {
								echo ('Ej Godkänd');
							}
						}
						
						echo ("</td><td>");	
						echo ($cause);
						echo ("</td></tr>");							
						
						$i++;
						$j++;
					}
					
					$notvalid = false;
					$cause = '';							
				}
			?>
		</table>	
		<br />
		
		<h3>Rökdykare ej godkända pga. Belastnings EKG</h3>
		<p>Aktiva rökdykare som ej genomfört eller har ett icke godkänt belastnings EKG.</p>
		
		<table id="jfbk_table" style="width: auto;">
			<tr>
				<th>Nr</th>
				<th>Namn</th>
				<th>Belastnings EKG(utfört/resultat)</th>
				<th>Orsak</th>
			</tr>
			
			<?php	
				//Get info from database
				$result = get_nfo_all_active_smokemen_members();
				
				//Variable to keep track if we should have alternating colors on table row or not
				$i = 0;
				
				//Controller variables
				$notvalid = false;
				$cause = '';
				
				//Loop through each row fetched from db query and populate table
				while($row = mysql_fetch_array($result)) {
					
					if($row['belastnekg'] == 'not_done') {
							$notvalid = true;
							$cause = $cause."Ej utfört Belastnings EKG";
					}
					
					else {
						if($row['belastnekgresult'] =='failed') {
							$notvalid = true;
							if($cause == '') {
								$cause = $cause."Ej godkänt resultat vid utförande av Belastnings EKG";
							} else {
								$cause = $cause.", Ej godkänt resultat vid utförande av Belastnings EKG";
							}
						}								
					}
					
					if($notvalid) {
						echo ("<tr"); if($i % 2){ echo(" class=\"alt\""); } echo("><td>");
						echo ($row['nr']);
						echo ("</td><td>");							
						echo ($row['firstname'].' '.$row['lastname']);
						echo ("</td><td>");
						
						if($row['belastnekg'] == 'not_done') {
							echo ('-');
						} else {
							echo ($row['belastnekg'].'/');
							if($row['belastnekgresult'] == 'passed') {
								echo ('Godkänd');
							} else {
								echo ('Ej Godkänd');
							}
						}
						
						echo ("</td><td>");	
						echo ($cause);
						echo ("</td></tr>");							
						
						$i++;
						$k++;
					}
					
					$notvalid = false;
					$cause = '';							
				}
			?>
		</table>
	
		<br />			
		<?php include('print-page-footer.php'); ?>
	</body>
</html>
