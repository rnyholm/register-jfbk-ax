<?php
	require_once('auth.php');
	require_once('functions.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Jomala FBK - Utmärkelser - Medlemmar Som Ska Tilldelas Utmärkelse</title>
		<!--Hack to force internet explorer to show page as ie7 browser-->
		<meta http-equiv="X-UA-Compatible" content="IE=7"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/main.css" rel="stylesheet" type="text/css" />
		<link rel="icon" type="image/x-icon" href="css/images/icon.ico" />
	</head>
	
	<body>
		<h2>Jomala FBK's manskap i tur att erhålla förtjänstetecken <?php echo date("Y"); ?></h2>			
		
		<table id="jfbk_table" style="width: auto;">
			<tr>
				<th>Namn</th>
				<th>Avdelning</th>
				<th>Utmärkelse att delas ut</th>
				<th>Motivering</th>
			</tr>
			
			<?php	
				//Get info from database
				$result = get_allnfo_member_omember();
				
				//Variable to keep track if we should have alternating colors on table row or not
				$i = 0;
				
				//Controll variables
				$toBeAssigned = false;						
				$motivation = '';
				$award = '';						
				
				//Loop through each row fetched from db query and populate table
				while($row = mysql_fetch_array($result)) {
					
					//Check if person has been a member for 5 or more years
					if((date("Y") - $row['started']) >= 5) {
						//Check if person hasn't been assigned an award for this already
						if($row['fiveyearpin'] == 'not_assigned') {
							//Set some variables
							$toBeAssigned = true;
					
							//Set awards
							$award = $award."JFBK's förtjänstetecken 5 år";
					
							//If statements for user output
							if((date("Y") - $row['started']) == 5) {
								$motivation = $motivation."Personen har varit aktiv i kåren i 5 år";
							} elseif ((date("Y") - $row['started']) > 5) {
								$motivation = $motivation."Personen har varit aktiv i kåren i mer än 5 år";
							}
						}
					}
					
					//Check if person has been a member for 10 or more years
					if((date("Y") - $row['started']) >= 10) {
						//Check if person hasn't been assigned an award for this already
						if($row['tenyearpin'] == 'not_assigned') {
							//Set some variables
							$toBeAssigned = true;
					
							//Set awards
							if($award == '') {
								$award = $award."FSB's förtjänstetecken 10 år";
							} else {
								$award = $award.", FSB's förtjänstetecken 10 år";
							}
					
							//If statements for user output
							if((date("Y") - $row['started']) == 10) {
								if($motivation == '') {
									$motivation = $motivation."Personen har varit aktiv i kåren i 10 år";
								} else {
									$motivation = $motivation.", Personen har varit aktiv i kåren i 10 år";
								}
							} elseif ((date("Y") - $row['started']) > 10) {
								if($motivation == '') {
									$motivation = $motivation."Personen har varit aktiv i kåren i mer än 10 år";
								} else {
									$motivation = $motivation.", Personen har varit aktiv i kåren i mer än 10 år";
								}
							}
						}
					}
					
					//Check if person has been a member for 20 or more years
					if((date("Y") - $row['started']) >= 20) {
						//Check if person hasn't been assigned an award for this already
						if($row['twentyyearpin'] == 'not_assigned') {
							//Set some variables
							$toBeAssigned = true;
					
							//Set awards
							if($award == '') {
								$award = $award."FSB's förtjänstetecken 20 år";
							} else {
								$award = $award.", FSB's förtjänstetecken 20 år";
							}
					
							//If statements for user output
							if((date("Y") - $row['started']) == 20) {
								if($motivation == '') {
									$motivation = $motivation."Personen har varit aktiv i kåren i 20 år";
								} else {
									$motivation = $motivation.", Personen har varit aktiv i kåren i 20 år";
								}
							} elseif ((date("Y") - $row['started']) > 20) {
								if($motivation == '') {
									$motivation = $motivation."Personen har varit aktiv i kåren i mer än 20 år";
								} else {
									$motivation = $motivation.", Personen har varit aktiv i kåren i mer än 20 år";
								}
							}
						}
					}
					
					//Check if person has been a member for 30 or more years
					if((date("Y") - $row['started']) >= 30) {
						//Check if person hasn't been assigned an award for this already
						if($row['thirtyyearpin'] == 'not_assigned') {
							//Set some variables
							$toBeAssigned = true;
					
							//Set awards
							if($award == '') {
								$award = $award."FSB's förtjänstetecken 30 år";
							} else {
								$award = $award.", FSB's förtjänstetecken 30 år";
							}
					
							//If statements for user output
							if((date("Y") - $row['started']) == 30) {
								if($motivation == '') {
									$motivation = $motivation."Personen har varit aktiv i kåren i 30 år";
								} else {
									$motivation = $motivation.", Personen har varit aktiv i kåren i 30 år";
								}
							} elseif ((date("Y") - $row['started']) > 30) {
								if($motivation == '') {
									$motivation = $motivation."Personen har varit aktiv i kåren i mer än 30 år";
								} else {
									$motivation = $motivation.", Personen har varit aktiv i kåren i mer än 30 år";
								}
							}
						}
					}							
					
					if($toBeAssigned) {
						echo ("<tr"); if($i % 2){ echo(" class=\"alt\""); } echo("><td>");
						echo ($row['firstname'].' '.$row['lastname']);
						echo ("</td><td>");
						
						if($row['type'] == 'senior') {
							echo ('Alarm');
						} else {
							echo ('Oldboy');
						}
						
						echo ("</td><td>");		

						echo ($award);
						echo ("</td><td>");
						echo ($motivation);								
						echo ("</td></tr>");							
						$i++;
					}
					
					$toBeAssigned = false;
					$award = '';
					$motivation = '';
				}
			?>
		</table>
		<br />
		
		<h2>Jomala FBK's jubilarer att uppvakta <?php echo date("Y"); ?>-<?php echo date("Y")+1; ?></h2>			
		
		<table id="jfbk_table" style="width: auto;">
			<tr>
				<th>Namn</th>
				<th>Avdelning</th>
				<th>Födelsedatum</th>
				<th>Ålder</th>
				<th>Motivering</th>
			</tr>
			
			<?php	
				//Get info from database
				$result = get_allnfo_member_omember();
				
				//Variable to keep track if we should have alternating colors on table row or not
				$i = 0;
				
				//Controll variables
				$toBeAssigned = false;						
				$motivation = '';
				$birthYear = '';
				$otheraward = '';
				$dob = '';
				
				//Loop through each row fetched from db query and populate table
				while($row = mysql_fetch_array($result)) {
					//Get correct birthyear, otheraward and dob
					$birthYear = substr($row['dob'],-10,4);
					$otheraward = $row['otheraward'];
					$dob = substr($row['dob'],-2,2).'.'.substr($row['dob'],-5,2).'-'.substr($row['dob'],-10,4);
					
					//***********************************************************************************************
					//50 year old to celebrate
					if((date("Y") - $birthYear) == 50) {
						//Check if user has been assigned this already
						if((strpos($otheraward,'ubil') === false) || (strpos($otheraward,'50') === false)) {
							//Set variable
							$toBeAssigned = true;
							
							//If person already has had his birthday
							if(calculate_age($row['dob']) == 50) {
								//Prints to user
								$motivation = $motivation."Personen har redan fyllt 50 i år, uppvakta omgående!";	
							} else {
								$motivation = $motivation."Personen fyller 50 i år";									
							}
						}
					}							
					//If user gets 50 next year
					if((date("Y") - $birthYear) == 49) {
						//Set variable
						$toBeAssigned = true;	
						//Prints to user							
						$motivation = $motivation."Personen fyller 50 NÄSTA år, håll ett öga på detta";
					}	
					
					//***********************************************************************************************
					//60 year old to celebrate
					if((date("Y") - $birthYear) == 60) {
						//Check if user has been assigned this already
						if((strpos($otheraward,'ubil') === false) || (strpos($otheraward,'60') === false)) {
							//Set variable
							$toBeAssigned = true;
								
							//If person already has had his birthday
							if(calculate_age($row['dob']) == 60) {
								//Prints to user
								$motivation = $motivation."Personen har redan fyllt 60 i år, uppvakta omgående!";
							} else {
								$motivation = $motivation."Personen fyller 60 i år";
							}
						}
					}
					
					//If user gets 60 next year
					if((date("Y") - $birthYear) == 59) {
						//Set variable
						$toBeAssigned = true;
						//Prints to user
						$motivation = $motivation."Personen fyller 60 NÄSTA år, håll ett öga på detta";
					}		

					//***********************************************************************************************
					//70 year old to celebrate
					if((date("Y") - $birthYear) == 70) {
						//Check if user has been assigned this already
						if((strpos($otheraward,'ubil') === false) || (strpos($otheraward,'70') === false)) {
							//Set variable
							$toBeAssigned = true;
					
							//If person already has had his birthday
							if(calculate_age($row['dob']) == 70) {
								//Prints to user
								$motivation = $motivation."Personen har redan fyllt 70 i år, uppvakta omgående!";
							} else {
								$motivation = $motivation."Personen fyller 70 i år";
							}
						}
					}
						
					//If user gets 70 next year
					if((date("Y") - $birthYear) == 69) {
						//Set variable
						$toBeAssigned = true;
						//Prints to user
						$motivation = $motivation."Personen fyller 70 NÄSTA år, håll ett öga på detta";
					}		

					//***********************************************************************************************
					//80 year old to celebrate
					if((date("Y") - $birthYear) == 80) {
						//Check if user has been assigned this already
						if((strpos($otheraward,'ubil') === false) || (strpos($otheraward,'80') === false)) {
							//Set variable
							$toBeAssigned = true;
								
							//If person already has had his birthday
							if(calculate_age($row['dob']) == 80) {
								//Prints to user
								$motivation = $motivation."Personen har redan fyllt 80 i år, uppvakta omgående!";
							} else {
								$motivation = $motivation."Personen fyller 80 i år";
							}
						}
					}
					
					//If user gets 80 next year
					if((date("Y") - $birthYear) == 79) {
						//Set variable
						$toBeAssigned = true;
						//Prints to user
						$motivation = $motivation."Personen fyller 80 NÄSTA år, håll ett öga på detta";
					}	

					//***********************************************************************************************
					//90 year old to celebrate
					if((date("Y") - $birthYear) == 90) {
						//Check if user has been assigned this already
						if((strpos($otheraward,'ubil') === false) || (strpos($otheraward,'90') === false)) {
							//Set variable
							$toBeAssigned = true;
					
							//If person already has had his birthday
							if(calculate_age($row['dob']) == 90) {
								//Prints to user
								$motivation = $motivation."Personen har redan fyllt 90 i år, uppvakta omgående!";
							} else {
								$motivation = $motivation."Personen fyller 90 i år";
							}
						}
					}
						
					//If user gets 90 next year
					if((date("Y") - $birthYear) == 89) {
						//Set variable
						$toBeAssigned = true;
						//Prints to user
						$motivation = $motivation."Personen fyller 90 NÄSTA år, håll ett öga på detta";
					}

					//***********************************************************************************************
					//100 year old to celebrate
					if((date("Y") - $birthYear) == 100) {
						//Check if user has been assigned this already
						if((strpos($otheraward,'ubil') === false) || (strpos($otheraward,'100') === false)) {
							//Set variable
							$toBeAssigned = true;
								
							//If person already has had his birthday
							if(calculate_age($row['dob']) == 100) {
								//Prints to user
								$motivation = $motivation."Personen har redan fyllt 100 i år, uppvakta omgående!";
							} else {
								$motivation = $motivation."Personen fyller 100 i år";
							}
						}
					}
					
					//If user gets 100 next year
					if((date("Y") - $birthYear) == 99) {
						//Set variable
						$toBeAssigned = true;
						//Prints to user
						$motivation = $motivation."Personen fyller 100 NÄSTA år, håll ett öga på detta";
					}							
			
					if($toBeAssigned) {
						echo ("<tr"); if($i % 2){ echo(" class=\"alt\""); } echo("><td>");
						echo ($row['firstname'].' '.$row['lastname']);
						echo ("</td><td>");
						
						if($row['type'] == 'senior') {
							echo ('Alarm');
						} else {
							echo ('Oldboy');
						}
						
						echo ("</td><td>");		

						echo ($dob);
						echo ("</td><td>");
						echo (calculate_age($row['dob']));
						echo ("</td><td>");
						echo ($motivation);
						echo ("</td></tr>");							
						$i++;
					}
					
					//Reset some variables
					$toBeAssigned = false;						
					$motivation = '';
					$birthYear = '';
					$otheraward = '';
					$dob = '';
				}
			?>
		</table>
		<?php include('print-page-footer.php'); ?>
	</body>
</html>

