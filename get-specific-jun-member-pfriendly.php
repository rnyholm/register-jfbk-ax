<?php
	require_once('auth.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Jomala FBK - Ungdomsavdelningen - Information Om Medlem</title>
	  	<!--Hack to force internet explorer to show page as ie7 browser-->
		<meta http-equiv="X-UA-Compatible" content="IE=7"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/main.css" rel="stylesheet" type="text/css" />
		<link rel="icon" type="image/x-icon" href="css/images/icon.ico" />
	</head>
	<body>
		<?php
			if($_SESSION['MEMBER_DATA']['name'] != '') {?>
				<table id="form_table">
					<tr>
						<td>
							<table width="640" border="0" cellpadding="2" cellspacing="0">
								<col width="220" />
								<tr>
									<th class="heading" style="white-space:nowrap;">Information om medlem</th>
								</tr>
								<tr>
									<th>Namn</th>
									<td><?php echo $_SESSION['MEMBER_DATA']['name']; ?></td>
								</tr>
								<tr>
									<th>Födelsedatum</th>
									<td><?php echo $_SESSION['MEMBER_DATA']['dob']; ?></td>
								</tr>
								<tr>
									<th>Ålder</th>
									<td><?php echo $_SESSION['MEMBER_DATA']['age']; ?></td>
								</tr>
								<tr>
									<th>Telefonnummer</th>
									<td><?php echo $_SESSION['MEMBER_DATA']['phone']; ?></td>
								</tr>
								<tr>
									<th>E-post</th>
									<td><?php echo $_SESSION['MEMBER_DATA']['email']; ?></td>
								</tr>
								<tr>
									<th>Storlek på tröja</th>
									<td><?php echo $_SESSION['MEMBER_DATA']['size']; ?></td>
								</tr>
								<tr>
									<th>Förälders namn</th>
									<td><?php echo $_SESSION['MEMBER_DATA']['nameice']; ?></td>
								</tr>							
								<tr>
									<th>Förälders telefonnummer</th>
									<td><?php echo $_SESSION['MEMBER_DATA']['ice']; ?></td>
								</tr>								
								<tr>
									<th>Inskrivningsår(Ungdomsavd.)</th>
									<td><?php echo $_SESSION['MEMBER_DATA']['juniorstarted']; ?></td>
								</tr>
	
								<tr>
									<th valign="top">Utbildningar</th>
									<td><?php echo $_SESSION['MEMBER_DATA']['education']; ?></td>
								</tr>
								<tr><td></td></tr>
	
							</table>
						</td>
					</tr>
				</table>
		<?php
			} else {
				echo '<div id="error">';
				echo '<font class="result_heading">Ingen medlem är vald!</font><br />';
				echo '<p class="result_paragraph">Stäng detta fönster, välj en medlem och försök igen.</p>';
				echo '</div>';
			}
		?>
		<?php include('print-page-footer.php'); ?>
	</body>
</html>