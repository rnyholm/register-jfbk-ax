<?php
	require_once('auth.php');
	require_once('populate-list.php');
	require_once ('functions.php');
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
		<title>Jomala FBK - Ungdomsavdelningen - Sammanställning <?php echo date('Y');?></title>
	  	<!--Hack to force internet explorer to show page as ie7 browser-->
		<meta http-equiv="X-UA-Compatible" content="IE=7"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/main.css" rel="stylesheet" type="text/css" />
		<link rel="icon" type="image/x-icon" href="css/images/icon.ico" />
	</head>
	
	<body>
		<h2>Sammanställning av ungdomsavdelningen <?php echo date('Y');?></h2>
		<table id="form_table">
			<tr>
				<td>
					<table width="700" border="0" cellpadding="2" cellspacing="0">
						<col width="260" />
						<tr>
							<th class="heading" style="white-space:nowrap;">Ungdomar</th>
							<th class="heading" style="white-space:nowrap;">Antal/År</th>
						</tr>
						<tr>
							<th>Aktiva ungdomar</th>
							<td><b><?php echo get_no_of_active_jmembers(); ?></b> st</td>
						</tr>
						<tr>
							<th>Manskapets medelålder</th>
							<td><b><?php echo number_format(avg_age_members_jcrew()); ?></b> år</td>
						</tr>
						<tr>
							<th>År(i medel) som aktiv i kåren</th>
							<td><b><?php echo number_format(avg_years_as_members_jcrew()); ?></b> år</td>
						</tr>
						<tr>
							<th>Nya medlemmar(<?php echo date('Y');?>)</th>
							<td><b><?php echo get_no_of_new_jmember(0); ?></b> st</td>
						</tr>
						<tr>
							<th>Nya medlemmar(<?php echo date('Y')-1;?>)</th>
							<td><b><?php echo get_no_of_new_jmember(1); ?></b> st</td>
						</tr>
						<tr>
							<th>Nya medlemmar(<?php echo date('Y')-2;?>)</th>
							<td><b><?php echo get_no_of_new_jmember(2); ?></b> st</td>
						</tr>																								
						<tr><td><br /></td></tr>
						<tr>
							<th class="heading" style="white-space:nowrap;">Utbildning</th>
							<th class="heading" style="white-space:nowrap;">Antal</th>
						</tr>								
						<tr>
							<th>Nybörjarkurs</th>
							<td><b><?php echo get_no_of_beginner("ALL"); ?></b> st totalt, <b><?php echo get_no_of_beginner("0"); ?></b> st gick kursen år(<?php echo date('Y');?>) och <b><?php echo get_no_of_beginner("1"); ?></b> st gick kursen år(<?php echo date('Y')-1;?>)</td>
						</tr>
						<tr>
							<th>Nivåkurs 1</th>
							<td><b><?php echo get_no_of_lvlone("ALL"); ?></b> st totalt, <b><?php echo get_no_of_lvlone("0"); ?></b> st gick kursen år(<?php echo date('Y');?>) och <b><?php echo get_no_of_lvlone("1"); ?></b> st gick kursen år(<?php echo date('Y')-1;?>)</td>
						</tr>
						<tr>
							<th>Nivåkurs 2</th>
							<td><b><?php echo get_no_of_lvltwo("ALL"); ?></b> st totalt, <b><?php echo get_no_of_lvltwo("0"); ?></b> st gick kursen år(<?php echo date('Y');?>) och <b><?php echo get_no_of_lvltwo("1"); ?></b> st gick kursen år(<?php echo date('Y')-1;?>)</td>
						</tr>
						<tr>
							<th>Nivåkurs 3</th>
							<td><b><?php echo get_no_of_lvlthree("ALL"); ?></b> st totalt, <b><?php echo get_no_of_lvlthree("0"); ?></b> st gick kursen år(<?php echo date('Y');?>) och <b><?php echo get_no_of_lvlthree("1"); ?></b> st gick kursen år(<?php echo date('Y')-1;?>)</td>
						</tr>								
						<tr>
							<th>Nivåkurs 4</th>
							<td><b><?php echo get_no_of_lvlfour("ALL"); ?></b> st totalt, <b><?php echo get_no_of_lvlfour("0"); ?></b> st gick kursen år(<?php echo date('Y');?>) och <b><?php echo get_no_of_lvlfour("1"); ?></b> st gick kursen år(<?php echo date('Y')-1;?>)</td>
						</tr>
						<tr>
							<th>Gruppchef</th>
							<td><b><?php echo get_no_of_jununitcommander("ALL"); ?></b> st totalt, <b><?php echo get_no_of_jununitcommander("0"); ?></b> st gick kursen år(<?php echo date('Y');?>) och <b><?php echo get_no_of_jununitcommander("1"); ?></b> st gick kursen år(<?php echo date('Y')-1;?>)</td>
						</tr>						
						<tr>
							<th>Utbildarkurs</th>
							<td><b><?php echo get_no_of_education("ALL"); ?></b> st totalt, <b><?php echo get_no_of_education("0"); ?></b> st gick kursen år(<?php echo date('Y');?>) och <b><?php echo get_no_of_education("1"); ?></b> st gick kursen år(<?php echo date('Y')-1;?>)</td>
						</tr>
						<tr><td></td></tr>
					</table>
				</td>
			</tr>
		</table>
		<?php include('print-page-footer.php'); ?>
	</body>
</html>
