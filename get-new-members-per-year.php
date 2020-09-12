<?php
	require_once('auth.php');
	require_once('populate-list.php');
	$currentFile = $_SERVER["PHP_SELF"];
	$parts = Explode('/', $currentFile);
	$current_page = $parts[count($parts) - 1];
	
	if($_SESSION['LAST_PAGE'] != $current_page) {
		//To unset some data specific to add/edit - member, just to clean them out
		unset($_SESSION['MEMBER_DATA']);
	}
	
	$_SESSION['LAST_PAGE'] = $current_page;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Jomala FBK - Alarmavdelningen - Antal Nya Medlemmar Per År</title>
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
				<h2>Antal nya medlemmar per år i alarmavdelningen</h2>
				<p>Välj ett årtal nedan för att se hur många nya medlemmar alarmavdelningen fick just det året.<br />
				Du kan även se diagram över antal nya medlemmar över en tio årig period, samt hur många medlemmar alarmavdelningen<br />
				har fått hittills detta år. Diagrammet öppnas i nytt fönster.</p>
				
				<table id="form_table">
					<form id="getNewMemberPerYearForm" name="getNewMemberPerYearForm" method="post" action="get-new-members-per-year-exec.php">
					<tr>
						<th>Välj år</th>
						<!--Calling php function from script to populate dropdown list with admins-->
						<td><?php populate_with_senior_start_years();?></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="Submit" value="Hämta antal medlemmar" /><br/> 
					</form>
							<input type="submit" name="newMemYearButton" id="newMemYearButton" value="Visa diagram" onClick="window.open('new-members-per-year-chart.php','_blank','toolbar=yes,scrollbars=no,width=900,height=480')" />
						</td>
					</tr>
					<tr>
					<td></td>
						<td valign="top">
							<?php
								if($_SESSION['MEMBER_DATA']['new_sen_members_per_year'] != '') {									  
									echo '<div id="success">';
									echo '<font class="result_heading">Tillväxt för specifikt år!</font><br />';
									echo '<p class="result_paragraph">'.$_SESSION['MEMBER_DATA']['new_sen_members_per_year'].'</p>';
									echo '</div>';
										  
									unset($_SESSION['SUBMIT_SUCCESS']);
								}
							?>	
						</td>
					</tr>
				</table>
			</div>
		</div>
		<?php include('footer.php'); ?>
	</body>
</html>