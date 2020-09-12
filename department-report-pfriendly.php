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
		<title>Jomala FBK - Alarmavdelningen - Sammanställning <?php echo date('Y');?></title>
	  	<!--Hack to force internet explorer to show page as ie7 browser-->
		<meta http-equiv="X-UA-Compatible" content="IE=7"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/main.css" rel="stylesheet" type="text/css" />
		<link rel="icon" type="image/x-icon" href="css/images/icon.ico" />
	</head>
	
	<body>
		<h2>Sammanställning av alarmavdelningen <?php echo date('Y');?></h2>
		<table id="form_table">
			<tr>
				<td>
					<table width="700" border="0" cellpadding="2" cellspacing="0">
						<col width="260" />
						<tr>
							<th class="heading" style="white-space:nowrap;">Kåruppgifter</th>
							<th class="heading" style="white-space:nowrap;">Namn/Antal</th>
						</tr>
						<tr>
							<th>Kårchef</th>
							<td><b><?php echo get_chief_name(); ?></b></td>
						</tr>	
						<tr>
							<th>Biträdande kårchef</th>
							<td><b><?php echo get_assistant_chief_name(); ?></b></td>
						</tr>	
						<tr>
							<th>Styrelse medlemmar</th>
							<td><b><?php echo get_no_of_members_in_board(); ?></b> st(från alarmavdelningen)</td>
						</tr>	
						<tr>
							<th>Manskap med förtroendeuppdrag</th>
							<td><b><?php echo get_no_of_members_with_assignmentintrust(); ?></b> st</td>
						</tr>								
						<tr><td><br /></td></tr>
						<tr>
							<th class="heading" style="white-space:nowrap;">Manskap</th>
							<th class="heading" style="white-space:nowrap;">Antal/År</th>
						</tr>
						<tr>
							<th>Aktivt manskap</th>
							<td><b><?php echo get_no_of_active_members(); ?></b> st</td>
						</tr>
						<tr>
							<th>Manskapets medelålder</th>
							<td><b><?php echo number_format(avg_age_members_crew()); ?></b> år</td>
						</tr>
						<tr>
							<th>År(i medel) som aktiv i kåren</th>
							<td><b><?php echo number_format(avg_years_as_members_crew()); ?></b> år</td>
						</tr>
						<tr>
							<th>Nya medlemmar(<?php echo date('Y');?>)</th>
							<td><b><?php echo get_no_of_new_member(0); ?></b> st</td>
						</tr>
						<tr>
							<th>Nya medlemmar(<?php echo date('Y')-1;?>)</th>
							<td><b><?php echo get_no_of_new_member(1); ?></b> st</td>
						</tr>
						<tr>
							<th>Nya medlemmar(<?php echo date('Y')-2;?>)</th>
							<td><b><?php echo get_no_of_new_member(2); ?></b> st</td>
						</tr>
						<tr>
							<th>Tidigare medlem vid annan kår</th>
							<td><b><?php echo get_no_of_otherfiredept(); ?></b> st</td>
						</tr>								
						<tr>
							<th>Tidigare varit juniorer i kåren</th>
							<td><b><?php echo get_no_of_ex_juniors(); ?></b> st</td>
						</tr>
						<tr><td><br /></td></tr>
						<tr>
							<th class="heading" style="white-space:nowrap;">Rökdykare</th>
							<th class="heading" style="white-space:nowrap;">Antal/År</th>
						</tr>
						<tr>
							<th>Aktiva "godkända" rökdykare</th>
							<td><b><?php echo get_no_of_active_qualified_smokedivers(); ?></b> st(utbildning, uleåborgstest och belastnings ekg i skick)</td>
						</tr>		
						<tr>
							<th>Behöver utföra uleåborgstestet</th>
							<td><b><?php echo get_no_of_smokedivers_need_uleborgtest(); ?></b> st(ej genomfört, ej godkänt eller för längesedan senaste test)</td>
						</tr>	
						<tr>
							<th>Behöver utföra belastnings EKG</th>
							<td><b><?php echo get_no_of_smokedivers_need_belastnekg(); ?></b> st(ej genomfört eller ej godkänt)</td>
						</tr>	
						<tr>
							<th>Totalt antal rökdykarutbildade</th>
							<td><b><?php echo get_no_of_smokediver_educated(); ?></b> st(genomfört utbildning men behöver ej vara aktiva)</td>
						</tr>																
						<tr><td><br /></td></tr>
						<tr>
							<th class="heading" style="white-space:nowrap;">Körkort</th>
							<th class="heading" style="white-space:nowrap;">Antal</th>
						</tr>
						<tr>
							<th>B-kort</th>
							<td><b><?php echo get_no_of_license("b"); ?></b> st</td>
						</tr>
						<tr>
							<th>BE-kort</th>
							<td><b><?php echo get_no_of_license("be"); ?></b> st</td>
						</tr>
						<tr>
							<th>C-kort</th>
							<td><b><?php echo get_no_of_license("c"); ?></b> st</td>
						</tr>
						<tr>
							<th>CE-kort</th>
							<td><b><?php echo get_no_of_license("ce"); ?></b> st</td>
						</tr>
						<tr>
							<th>D-kort</th>
							<td><b><?php echo get_no_of_license("d"); ?></b> st</td>
						</tr>
						<tr>
							<th>DE-kort</th>
							<td><b><?php echo get_no_of_license("de"); ?></b> st</td>
						</tr>								
						<tr><td><br /></td></tr>
						<tr>
							<th class="heading" style="white-space:nowrap;">Utbildning</th>
							<th class="heading" style="white-space:nowrap;">Antal</th>
						</tr>								
						<tr>
							<th>Släckningsman</th>
							<td><b><?php echo get_no_of_extmen("ALL"); ?></b> st totalt, <b><?php echo get_no_of_extmen("0"); ?></b> st gick kursen år(<?php echo date('Y');?>) och <b><?php echo get_no_of_extmen("1"); ?></b> st gick kursen år(<?php echo date('Y')-1;?>)</td>
						</tr>
						<tr>
							<th>Räddningsman</th>
							<td><b><?php echo get_no_of_rescmen("ALL"); ?></b> st totalt, <b><?php echo get_no_of_rescmen("0"); ?></b> st gick kursen år(<?php echo date('Y');?>) och <b><?php echo get_no_of_rescmen("1"); ?></b> st gick kursen år(<?php echo date('Y')-1;?>)</td>
						</tr>
						<tr>
							<th>Rökdykare</th>
							<td><b><?php echo get_no_of_smokemen("ALL"); ?></b> st totalt, <b><?php echo get_no_of_smokemen("0"); ?></b> st gick kursen år(<?php echo date('Y');?>) och <b><?php echo get_no_of_smokemen("1"); ?></b> st gick kursen år(<?php echo date('Y')-1;?>)</td>
						</tr>
						<tr>
							<th>Basic Fire Fighting</th>
							<td><b><?php echo get_no_of_basicff("ALL"); ?></b> st totalt, <b><?php echo get_no_of_basicff("0"); ?></b> st gick kursen år(<?php echo date('Y');?>) och <b><?php echo get_no_of_basicff("1"); ?></b> st gick kursen år(<?php echo date('Y')-1;?>)</td>
						</tr>								
						<tr>
							<th>Arbete på hög höjd</th>
							<td><b><?php echo get_no_of_highwork("ALL"); ?></b> st totalt, <b><?php echo get_no_of_highwork("0"); ?></b> st gick kursen år(<?php echo date('Y');?>) och <b><?php echo get_no_of_highwork("1"); ?></b> st gick kursen år(<?php echo date('Y')-1;?>)</td>
						</tr>
						<tr>
							<th>Ytlivräddning</th>
							<td><b><?php echo get_no_of_surfacerescue("ALL"); ?></b> st totalt, <b><?php echo get_no_of_surfacerescue("0"); ?></b> st gick kursen år(<?php echo date('Y');?>) och <b><?php echo get_no_of_surfacerescue("1"); ?></b> st gick kursen år(<?php echo date('Y')-1;?>)</td>
						</tr>						
						<tr>
							<th>Brandkårens första hjälp</th>
							<td><b><?php echo get_no_of_firstaid("ALL"); ?></b> st totalt, <b><?php echo get_no_of_firstaid("0"); ?></b> st gick kursen år(<?php echo date('Y');?>) och <b><?php echo get_no_of_firstaid("1"); ?></b> st gick kursen år(<?php echo date('Y')-1;?>)</td>
						</tr>
						<tr>
							<th>Syredelegering</th>
							<td><b><?php echo get_no_of_oxygen("ALL"); ?></b> st totalt, <b><?php echo get_no_of_oxygen("0"); ?></b> st gick kursen år(<?php echo date('Y');?>) och <b><?php echo get_no_of_oxygen("1"); ?></b> st gick kursen år(<?php echo date('Y')-1;?>)</td>
						</tr>
						<tr>
							<th>Kårchef</th>
							<td><b><?php echo get_no_of_chief("ALL"); ?></b> st totalt, <b><?php echo get_no_of_chief("0"); ?></b> st gick kursen år(<?php echo date('Y');?>) och <b><?php echo get_no_of_chief("1"); ?></b> st gick kursen år(<?php echo date('Y')-1;?>)</td>
						</tr>								
						<tr>
							<th>Enhetschef</th>
							<td><b><?php echo get_no_of_unitcommander("ALL"); ?></b> st totalt, <b><?php echo get_no_of_unitcommander("0"); ?></b> st gick kursen år(<?php echo date('Y');?>) och <b><?php echo get_no_of_unitcommander("1"); ?></b> st gick kursen år(<?php echo date('Y')-1;?>)</td>
						</tr>
						<tr>
							<th>Övrig utbildning</th>
							<td><b><?php echo get_no_of_othereducation(); ?></b> st</td>
						</tr>
						<tr>
							<th>Junior utbildning</th>
							<td><b><?php echo get_no_of_junioreducation(); ?></b> st</td>
						</tr>
						<tr><td><br /></td></tr>
						<tr>
							<th class="heading" style="white-space:nowrap;">Utmärkelser</th>
							<th class="heading" style="white-space:nowrap;">Antal</th>
						</tr>		
						<tr>
							<th>JFBK's förtjänstetecken 5 år</th>
							<td><b><?php echo get_no_of_members_fiveyearpin(); ?></b> st</td>
						</tr>
						<tr>
							<th>FSB's förtjänstetecken 10 år</th>
							<td><b><?php echo get_no_of_members_tenyearpin(); ?></b> st</td>
						</tr>
						<tr>
							<th>FSB's förtjänstetecken 20 år</th>
							<td><b><?php echo get_no_of_members_twentyyearpin(); ?></b> st</td>
						</tr>
						<tr>
							<th>FSB's förtjänstetecken 30 år</th>
							<td><b><?php echo get_no_of_members_thirtyyearpin(); ?></b> st</td>
						</tr>								
						<tr>
							<th>JFBK's förtjänstetecken - special</th>
							<td><b><?php echo get_no_of_members_specialpin(); ?></b> st</td>
						</tr>
						<tr>
							<th>Övriga utmärkelser</th>
							<td><b><?php echo get_no_of_members_otheraward(); ?></b> st</td>
						</tr>
						<tr><td></td></tr>
					</table>
				</td>
			</tr>
		</table>
		<?php include('print-page-footer.php'); ?>
	</body>
</html>
