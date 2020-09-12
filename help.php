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
  <title>Jomala FBK - Hjälp</title>
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
			<h2>Hjälpsidan</h2>
			<p>Som tidigare nämnts är detta register uppbyggt på sådant vis att det ska vara så enkelt som möjligt att hantera kårens medlemmar och dess utbildningar, utmärkelser,
			 personuppgifter och så vidare. Hursomhelst så kan problem uppstå och det kan vara svårt att förstå hur det fungerar och då kan det vara värt läsa igenom den här sidan
			  efter svar. Om frågor ändå finns eller problem uppstår så kontakta Robert på mail <a class="in_body" href="mailto:webmaster@jfbk.ax?Subject=Jfbk%20registret">webmaster@jfbk.ax</a> eller
			  telnr. 0457 5471 372.</p>
			<h3>Vad tar denna sida upp?</h3>
			<p>Hjälpsidan tar upp kort om följande:
				<ul>
					<li>Registrets struktur</li>
					<li>Menyupplägg</li>
					<li>Att lägga in eller redigera information</li>
					<li>Flytta en medlem till annan avdelning</li>
					<li>Inaktivera eller återaktivera medlem</li>
					<li>Statistik, sammanställningar, kontaktlista m.m.</li>
					<li>Utbildningar</li>
					<li>Rökdykare</li>
					<li>Utmärkelser</li>
					<li>Styrelsen</li>					
					<li>Utskrifter</li>
				</ul> 
			</p>
			
			<h3>Registrets struktur</h3>
			<p>Till att börja med ska sägas att detta register ska inte alla ha tillgång till, utan en handfull personer som har hand om registret och dess information. Detta beror dels på grund <br />
			av att känslig data finns i detta registret och dels på att det finns större risk att felaktigheter uppstår i regsitret om fler har tillgång till det.<br />
			Tanken med registret är att det ska vara en databas för medlemmars information och registret ska smidigt följa en medlem ändå från junior till oldboy. Strukturen på registret följer
		 	även detta mönster, och är programmerad så att det på så enkelt sätt som möjligt ska gå att flytta medlemmar mellan avdelningar, aktivera/inaktivera, lägga till/redigera medlemmar och så vidare.
		 	Registret är även byggt på så vis att det inte ska kunna gå att göra något så stort fel att någon medlem försvinner(eller dylikt) ur registret. Det finns även mycket kontroller när man lägger in
		 	data i registret som gör att det är ganska svårt att ange för lite eller felaktig information. På de ställen där det är "någorlunda" viktigt att information anges enligt rätt mönster så står detta tydligt, 
		 	och dessutom finns alltid ett exempel på hur det ska se ut.<br />
		 	När det gäller att hämta ut information ur registret är det ännu lättare, man väljer helt enkelt information som man vill ha ut från menyn uppe på sidan så serveras informationen i tabell eller annan form.
		 	På dessa sidor där information finns att hämta ut finns alltid en knapp som man kan klicka på för att få sidan i utskriftsvänligt format.
			</p>
			
			<h3>Menyupplägg</h3>
			<p>För att lättast beskriva menyupplägget använder jag bilden nedan. Men det huvudsakliga att komma ihåg är att en del menyer hanterar medlemmer från både alarm- och oldboys avdelningen.
		 	Detta gäller funktioner/positioner som medlemmar ur båda grupperna kan ha.<br />
		 	Angående administratörsdelen på användarmenyn så är den delen något som merparten av användarna av registret inte kommer se, då detta gäller administratörer av registret. Enda skillnaden mellan en administratör och
		 	"vanlig" användare är att administratören kan lägga till nya användare av registret samt ändra deras lösenord. Annars är det inte så mycket mer att säga om menyerna, bilden säger det mesta.<br /><br />
			<img border="0" src="css/images/menu_description.png" width="1000" height="290" /></p>
			
			<h3>Att lägga in eller redigera information</h3>
			<p>Under respektive avdelnings meny finns alternativen "Lägg till ny medlem" och "Redigera befintlig medlem", och som namnen säger så lägger man till nya eller redigerar befintliga medlemmar genom att klicka på någon av dem.
		 	Upplägget på dessa sidor ser rätt lika ut mellan de olika avdelningarna, fast skillnader finns förstås. Dessa skillnader är specifika per avdelning. Det viktiga med angående informationen som sätts in i registret är att den aldrig går förlorad, 
		 	t.ex. om man byter avdelning på en medlem så följer informationen med den till nästa avdelning. Detta gör att man slipper skriva så mycket information till registret och minskar risken för fel.<br />
		 	När man lägger till information eller redigerar så görs speciella kontroller innan data lagras. Dessa kontroller ser till att nödvändig data fylls i för medlemmen, och det kommer tydliga meddelanden vid sparande av information som säger
		 	om informationen sparades eller om fel påträffats. Om fel påträffats så står även vilket fel som påträffades, ex. -Förnamn saknas. Så det är väldigt enkelt och smidigt att göra detta. Dock så ska man vara lite noga med information som anges genom
		  	att man får fylla i själv(finns bara en textruta att fylla i). Då måst man vara lite noga med att följa specifika mönster, för andra funktioner letar efter mönster i den angivna informationen och är den ifylld fel så finns det risk för att vissa funktioner
		   	inte fungerar som tänkt. Men där detta gäller finns alltid ett exempel så man kan se hur det ska se ut.<br />
		   	En sista sak att nämna angående dessa meny alternativ är att de är de kraftfullaste menyerna i registret, dvs. man kan ändra precis all angiven data på dessa sidor. Så om något behöver ändras för en medlem så kan man alltid ordna det här.</p>
			
			<h3>Flytta en medlem till annan avdelning</h3> 
			<p>Under respektive avdelnings meny finns ett alternativ "Flytta medlem till -------avdelningen" och dett alternativ används när en medlem ska byta avdelning. Och detta är bus enkelt att göra, man går in på "Flytta till ------avdelningen". Där listas medlemmar som kan flyttas
			i en rullgardinslista. Sen väljer man bara medlem som ska flyttas sen anger man sitt lösenord för användarkontot(för att säkerställa att det sitter en person med behörighet till registret framför datorn), sen klickar man bara på "Flytta medlem". Då har
			medlemmen och dess information flyttat avdelning och finns numera på den nya avdelningens sida. <br />
			OBS. denna åtgärd kan inte ångras så använd den med eftertanke.</p> 
			
			<h3>Inaktivera eller återaktivera medlem</h3>
			<p>Under respektive meny finns ytterligare alternativen "Inaktivera medlem" och "Återaktivera medlem", dessa används då en medlem slutar i kåren. Förfarandet är rätt lika som när man flyttar en medlem så det ska inte vara något problem att göra detta.<br />
			När en person är inaktiverad så syns han inte på medlemssidorna mera, men personens information finns kvar vilket gör det väldigt smidigt om personen vill börja i kåren igen och det gör man lika enkelt som när man inaktiverade personen.</p>
			
			<h3>Statistik, sammanställningar, kontaktlista m.m.</h3>
			<p>Respektive avdelningssida har även olika alternativ för att visa sammanställningar, kontaktlistor, statistik och annat. Dessa kräver ingen indata från användaren att använda utan man bara klickar på det man vill se. Så det finns egentligen inget mer att säga om det annat
			än att det bara är att utforska dessa alternativ på egen hand.</p>
			
			<h3>Utbildningar</h3>
			<p>Denna del av registret skiljer sig lite mellan avdelningarn. För ungdomsavdelningen finns alla utbildningslistor och utbildningshistorik under menyn "Ungdomsavdelningen", och det är information som visar vem som gått vilka kurser och vilka som gått en specifik kurs.<br />
			Utbildningshistorik, utbildningslistor och körkortssammanställning finns även för alarmavdelningen, men här har dessa alternativ placerats under en egen meny "Utbildning". Denna information visar vem som gått vilka kurser, vilka som gått specifik kurs och vem som har vilka körkort.<br />
			Oldboysavdelningen har endast funktion för att visa utbildningshistorik och det finns som alternativ under deras meny.</p>
			
			<h3>Rökdykare</h3>
			<p>Under menyn "Rökdykare" finns alternativ för att lista vilka personer som har rökdykar utbildning, samt vilka personer som är godkända rökdykare och personer som inte har uleåborgstestet eller belastnings EKG'n i skick och därför inte är godkända rökdykare. Slutligen kan man även här ändra
			rökdykares information och det är inte svårt att göra. Bara välj rökdykare ur listan, ändra nödvändig information och spara. Detta går även att göra via "Redigera befintlig medlem" under alarmavdelningens meny.</p>
			
			<h3>Utmärkelser</h3>
			<p>Under denna menyn så kan man se alla utdelade utmärkelser i kåren, samt se vilka som är i tur att få en utmärkelse. Man ser även jubilarer som är i tur att uppvaktas. Ytterligare kan man tilldela utmärkelser under denna meny också, och här är förfaringssättet väldigt lika som när man redigerar
			rökdykare under den menyn. Men man väljer medlem som ska tilldelas en utmärkelse, tilldelar utmärkelse och sparar. Här är det dock viktigt att när man tilldelar Jubilar så ska det vara enligt formatet 50-års Jubilar(gåva,årtal uppvaktat), så ex. ett 70 års jubilar ska fyllas i enligt följande:
			 70-års Jubilar(Guldyxa,2013). Denna information fylls i under "Övriga utmärkelser". <br />
			 Detta går även att utföra via "Redigera befintlig medlem" under Alarm- och Oldboysavdelningen.</p>
			 
			<h3>Styrelsen</h3>
			<p>Här så listar man styrelsen och kårens kassör. Man kan även lägga till, redigera och ta bort medlem ur styrelsen under denna meny. Om det är någon person som inte annars är med i kåren men som sitter med i styrelsen så läggs den personen till här under alternativet "Lägg till utomstående i styrelsen".
			Dock ska man tänka på att när man tar bort en person ur styrelsen som är tillagd som utomstående så tas den personens uppgifter bort helt och hållet ur registret.</p>
			
			<h3>Utskrifter</h3>
			<p>För att skriva ut information från registret så rekommenderas att man trycker på knappen "Utskriftsvänlig version". Då öppnas ett nytt fönster med enbart relevant text och där finns en länk som heter "Skriv ut sidan", och när man trycker på den så öppnas utskrifts dialogen och man skriver ut som vanligt.
			Att tänka på dock är att endel tabeller är så breda att man måste skriva ut som liggande(landskap) för att det ska bli en vettig utskrift.</p>
		</div>
	</div>
	<?php include('footer.php'); ?>
</body>
</html>