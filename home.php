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
  <title>Jomala FBK - Hem</title>
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
			<h2>Välkommen till Jomala Frivilliga Brand- och Räddningskårs medlems- och utbildningsregister</h2>
			<p>I detta register sparas information om kårens medlemmar, deras utbildningar,
			förtroende uppdrag, utmärkelser och en del annat.<br />Dessa sidor är byggda på sådant vis att
			det ska vara så enkelt som möjligt att hantera medlemmar och deras information. Du kommer åt alla sidor
			via menyn ovanför och allra högst upp på sidan kan du byta ditt lösenord in till denna sida.<br />
			<!--Kom ihåg att kolla spalten nedan med nyheter från sidans administratör, ifall ny funktionalitet,
			buggfixar, uppdateringar eller annat viktigt på denna sida gjorts kommer det skrivas där.--></p>
			<p>Om du har förslag på ytterligare funktionalitet eller förbättringar så <a class="in_body" href="help.php">kontakta Robert</a>.</p>
			<p><u><b>Är det första gången du är inne på den här sidan, eller annars funderar över hur registret fungerar, så rekommenderas starkt att du läser hjälpsidan.
			<br /> Du når hjälpsidan genom menyn uppe på sidan eller genom att klicka <a class="in_body" href="help.php">här</a>.</b></u></p>
			<!-- 
			<hr></hr>
			
			<h2 style="margin-bottom: 5px;">Nytt från administratören!</h2>
			<div id="news_container">
				<font class="news_heading">Grunden i medlemsregistret</font><br />
				<font class="news_timestamp">15 Augusti, 2012 10:29</font><br />
				Nu ska grunden för de olika avdelningarna inom kåren vara implementerad och testad.
				Dvs. alla avdelningar har i "princip" samma funktionalitet, lite skillnader finns dock.
				Det som ytterligare återstår är för slutanvändarna att testa funktionaliten.<br /><br />
				
				<font class="news_heading">Användarrättigheter</font><br />
				<font class="news_timestamp">13 Augusti, 2012 13:07</font><br />
				Gjort lite ändringar i hur applikationen hanterar användarnas olika behörigheter,
				Ändringarna ska inte märkas för slutanvändaren, men det är mer förberett för vidareutveckling
				om man vill det.<br /><br />
				
				<font class="news_heading">Databasen, Buggfixar och Funktionalitet</font><br />
				<font class="news_timestamp">09 Augusti, 2012 12:57</font><br />
				Lite nytt igen! Den gamla databashanteringen är uppdaterad, så den funkar med den nya databsen,
				dock krävs lite mer testande. Lite små buggfixar som t.ex. att medlemmar i styrelsen som var registrerade
				oldboysavdelningen inte listades med de övriga styrelsemedlemmarna, att de olika start åren inte var i sync
				och lite annat småfix. Dessutom har oldboys avdelningen fått funktionalitet för att aktiver och inaktivera
				medlem. Så nu ska grunden i medlemshanteringen vara "klar".<br /><br />
				
				<font class="news_heading">"Ny" databas</font><br />
				<font class="news_timestamp">03 Augusti, 2012 06:03</font><br />
				Har byggt en ny databas till register.jfbk.ax. Den ny databasen har en bättre
				design och är mer förberedd för framtida behov.<br /><br />
				
				<font class="news_heading">Spalt för nyheter, uppdateringar och buggfixar</font><br />
				<font class="news_timestamp">31 Juli, 2012 17:24</font><br />
				Lagt till funktionlitet och stöd för att lägga in nyheter, uppdateringar och buggfixar!
			 	Kolla in denna spalt när du loggar in för att se efter ny funktionalitet och fixar.
			 	Kom även ihåg att rapportera buggar och problem, samt ge tips på ny funktionalitet till Robert!
			</div>-->
		</div>
	</div>
	<?php include('footer.php'); ?>
</body>
</html>