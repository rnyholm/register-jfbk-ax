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
	
	$members = get_no_of_active_jmembers();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Jomala FBK - Ungdomsavdelningen - Lista Medlemmar</title>
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
				<h2>Lista medlemmar i ungdomsavdelningen</h2>
				<p>Alla aktiva medlemmar i ungdomsavdelningen och dess personliga data listas här nedan. <br />
				Juniorers utbildningar listas på annan sida som nås via menyn eller knapp nedan, likaså om du vill<br />
				redigera medlemmars information.<br />
				Om du vill skriva ut tabellen, trycker du på knappen nedan så öppnas en ny sida med enbart tabellen,<br />
				tänk på att du kan behöva skriva ut som landskap(liggande) annars kanske inte hela tabellen skrivs ut.</p>
				
				<p>
					<input type="submit" style="width: 150px" name="editJunButton" id="editJunButton" value="Redigera medlemmar" onclick="location.href='edit-jun-member.php'" />
					<input type="submit" style="width: 200px" name="showJunEduButton" id="showJunEduButton" value="Visa medlemmars utbildningar" onclick="location.href='get-jun-members-education.php'" />
					<input type="submit" name="listMembersPfriendly" id="listMembersPfriendly" value="Utskriftsvänlig version" onclick="window.open('list-jun-members-pfriendly.php','_blank','toolbar=yes,scrollbars=yes,width=1000,height=900')" />
				</p>
				
				<h2>Medlemmar i Ungdomsavdelningen <?php echo date("Y"); ?></h2>
				
				<p>
					Det finns <b><u><?php echo($members); ?></u></b> aktiva medlemmar i ungdomsavdelningen.<br />
					Antal år(i medel) som ungdomsavdelningens medlemmar varit aktiva i kåren är <b><u><?php echo(number_format(avg_years_as_members_jcrew())); ?></u></b> år.<br />
					Medelåldern för medlemmarna i ungdomsavdelningen är <b><u><?php echo(number_format(avg_age_members_jcrew())); ?></u></b> år.
				</p>
				
				<table id="jfbk_table">
					<tr>
						<th>Namn</th>
						<th>Födelsedatum</th>
						<th>Ålder</th>
						<th>Telefonnummer</th>
						<th>E-post</th>
						<th>Inskrivningsår</th>
						<th>Tröj storlek</th>
						<th>Förälder</th>
						<th>Förälders tel. nummer</th>						
					</tr>
					
					<?php	
						//Get info from database
						$result = get_allnfo_jmember();
						
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
							echo ($row['size']);
							echo ("</td><td>");
							echo ($row['nameice']);
							echo ("</td><td>");
							echo ($row['ice']);							
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