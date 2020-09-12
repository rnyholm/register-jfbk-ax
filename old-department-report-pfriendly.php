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
		<title>Jomala FBK - Oldboysavdelningen - Sammanställning <?php echo date('Y');?></title>
	  	<!--Hack to force internet explorer to show page as ie7 browser-->
		<meta http-equiv="X-UA-Compatible" content="IE=7"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/main.css" rel="stylesheet" type="text/css" />
		<link rel="icon" type="image/x-icon" href="css/images/icon.ico" />
	</head>
	
	<body>
		<h2>Sammanställning av oldboysavdelningen <?php echo date('Y');?></h2>
		<table id="form_table">
			<tr>
				<td>
					<table width="700" border="0" cellpadding="2" cellspacing="0">
						<col width="260" />
						<tr>
							<th class="heading" style="white-space:nowrap;">Kåruppgifter</th>
							<th class="heading" style="white-space:nowrap;">Antal</th>
						</tr>	
						<tr>
							<th>Styrelse medlemmar</th>
							<td><b><?php echo get_no_of_omembers_in_board(); ?></b> st(från oldboysavdelningen)</td>
						</tr>	
						<tr>
							<th>Manskap med förtroendeuppdrag</th>
							<td><b><?php echo get_no_of_omembers_with_assignmentintrust(); ?></b> st</td>
						</tr>								
						<tr><td><br /></td></tr>
						<tr>
							<th class="heading" style="white-space:nowrap;">Oldboys</th>
							<th class="heading" style="white-space:nowrap;">Antal/År</th>
						</tr>
						<tr>
							<th>Aktiva oldboys</th>
							<td><b><?php echo get_no_of_active_omembers(); ?></b> st</td>
						</tr>
						<tr>
							<th>Manskapets medelålder</th>
							<td><b><?php echo number_format(avg_age_members_ocrew()); ?></b> år</td>
						</tr>
						<tr>
							<th>År(i medel) som aktiv i kåren</th>
							<td><b><?php echo number_format(avg_years_as_members_ocrew()); ?></b> år</td>
						</tr>
						<tr>
							<th>Nya medlemmar(<?php echo date('Y');?>)</th>
							<td><b><?php echo get_no_of_new_omember(0); ?></b> st</td>
						</tr>
						<tr>
							<th>Nya medlemmar(<?php echo date('Y')-1;?>)</th>
							<td><b><?php echo get_no_of_new_omember(1); ?></b> st</td>
						</tr>
						<tr>
							<th>Nya medlemmar(<?php echo date('Y')-2;?>)</th>
							<td><b><?php echo get_no_of_new_omember(2); ?></b> st</td>
						</tr>
						<tr>
							<th>Tidigare medlem vid annan kår</th>
							<td><b><?php echo get_no_of_old_otherfiredept(); ?></b> st</td>
						</tr>							
						<tr>
							<th>Tidigare varit seniorer i kåren</th>
							<td><b><?php echo get_no_of_old_ex_seniors(); ?></b> st</td>
						</tr>								
						<tr>
							<th>Tidigare varit juniorer i kåren</th>
							<td><b><?php echo get_no_of_old_ex_juniors(); ?></b> st</td>
						</tr>
						<tr><td><br /></td></tr>
						<tr>
							<th class="heading" style="white-space:nowrap;">Utmärkelser</th>
							<th class="heading" style="white-space:nowrap;">Antal</th>
						</tr>		
						<tr>
							<th>JFBK's förtjänstetecken 5 år</th>
							<td><b><?php echo get_no_of_old_members_fiveyearpin(); ?></b> st</td>
						</tr>
						<tr>
							<th>FSB's förtjänstetecken 10 år</th>
							<td><b><?php echo get_no_of_old_members_tenyearpin(); ?></b> st</td>
						</tr>
						<tr>
							<th>FSB's förtjänstetecken 20 år</th>
							<td><b><?php echo get_no_of_old_members_twentyyearpin(); ?></b> st</td>
						</tr>
						<tr>
							<th>FSB's förtjänstetecken 30 år</th>
							<td><b><?php echo get_no_of_old_members_thirtyyearpin(); ?></b> st</td>
						</tr>								
						<tr>
							<th>JFBK's förtjänstetecken - special</th>
							<td><b><?php echo get_no_of_old_members_specialpin(); ?></b> st</td>
						</tr>
						<tr>
							<th>Övriga utmärkelser</th>
							<td><b><?php echo get_no_of_old_members_otheraward(); ?></b> st</td>
						</tr>												
						<tr><td></td></tr>
					</table>
				</td>
			</tr>
		</table>
		<?php include('print-page-footer.php'); ?>
	</body>
</html>
