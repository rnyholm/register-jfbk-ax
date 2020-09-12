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
		<title>Jomala FBK - Styrelsen - Ta Bort Styrelsemedlem</title>
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
				<h2>Ta bort styrelsemedlem</h2>
				<p>För att ta bort styrelsemedlem, väljs medlemmen ur listan nedan, sedan anger du lösenordet<br />
				för ditt användarkonto, för att bekräfta att du har behörighet att utföra åtgärden<br />
				Till sist klickar du bara på "Ta bort styrelsemedlem" då tas personen bort från styrelsen.<br />
				<b>Observera</b> att om styrelse medlemmen är med i alarm- eller oldboysavdelningen så kan man<br />
				lägga till personen i styrelsen igen. Däremot om personen som ska tas bort ur styrelsen är en<br />
				utomstående person så tas den personen bort helt, dvs. ska du lägga till personen på nytt måste man<br />
				välja "Lägg till utomstående i styrelsen" från menyn "Styrelsen", och ange personens uppgifter.</p>
				
				<!--Table holding content for change password and error messages-->
				<table id="form_table">
					<tr>
						<td>
							<form id="removeBoardeMemberForm" name="removeBoardMemberForm" method="post" action="remove-board-member-exec.php">
								<table id="form_table">
									<tr>
										<th>Välj medlem</th>
										<!--Calling php function from script to populate dropdown list with admins-->
										<td><?php populate_with_board_members($_SESSION['MEMBER_DATA']['selected_member']);?></td>
									</tr>
									<tr>
										<th>Lösenord</th>
										<td><input name="password" type="password" class="textfield" id="password" /></td>
									</tr>
									<tr>
										<td></td>
										<td><input type="submit" name="Submit" value="Ta bort styrelsemedlem" /></td>
									</tr>
								</table>
							</form>
						</td>
						<td valign="top">
							<?php
								if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
									echo '<div id="error">';
									echo '<font class="result_heading">Följande fel har påträffats!</font><br />';
									echo '<font class="result_text">';
													foreach($_SESSION['ERRMSG_ARR'] as $msg) {
														echo '&bull;',$msg,'<br />'; 
													}
									echo '</font>';
									echo '</div>';
									
									unset($_SESSION['ERRMSG_ARR']);
								} else if($_SESSION['SUBMIT_SUCCESS'] == true) {									  
									echo '<div id="success">';
									echo '<font class="result_heading">Styrelsemedlem har tagits bort!</font><br />';
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