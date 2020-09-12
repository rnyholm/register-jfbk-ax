<?php
	require_once('auth.php');
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
	  <title>Jomala FBK - Om Sidan</title>
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
				<h2>Om denna sida</h2>
				<p>Denna sida är ett medlems- och utbildningsregister för Jomala Frivilliga brand- och räddningskår.
				Sidan är utvecklad av Robert Nyholm, för Jomala FBK och hostas i sin helhet av Jomala FBK.
				Den här sidan/registret är även ett fortlöpande projekt, dvs. ny funktionalitet kommer säkerligen komma till, 
				designen kan säkert ändras samt att funktionalitet kan komma att tas bort. Dessa ändringar sker i samråd med slutanvändarna.</p>
				<p>Sidan ses bäst i webbläsarna chrome,firefox eller opera.</p>
				<p>Tekniskt så är denna sida en "smart" sida, dvs. sidan körs på en Apache server och använder PHP för att hämta ut och lagra
				information från/till en SQL databas, PHP används även för att bygga upp vissa delar av html kod som renderas av webläsaren åt användaren.
				Data som lagras i databasen speglas, dvs. det finns alltid en dublett av databasen. Databasen skyddas såklart av lösenord.
				För att kunna använda sidan över huvudtaget behövs en inloggning bestående av ett användarnamn och ett lösenord som krypteras. För att
				inte någon ska kunna "fula" sig in på sidan så körs ett autentisierings-script före varje sidvisning, där det avgörs om användaren
				har rättigheter att se sidan.
				All inmatad data från användaren traverseras även med en viss method för att motverka SQL-injections.</p>
				<p>
				Vid frågor eller synpunkter kontakta Robert Nyholm telnr: 0457 5471 372 epost: <a class="in_body" href="mailto:webmaster@jfbk.ax?Subject=Jfbk Register">webmaster@jfbk.ax</a>
				</p>
				<p class="red">
				Utvecklaren har fulla rättigheter till all källkod och andra tekniska lösningar som används på denna sida!
				</p>
			</div>
		</div>
		<?php include('footer.php'); ?>
	</body>
</html>