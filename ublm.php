<?php
	require_once('auth.php');	
	$currentFile = $_SERVER["PHP_SELF"];
	$parts = Explode('/', $currentFile);
	$current_page = $parts[count($parts) - 1];
?>

<div id="user_container" class="link_inactive">
	<font size="4"><b><?php echo $_SESSION['SESS_FIRST_NAME'];?> <?php echo $_SESSION['SESS_LAST_NAME'];?></b></font>
	<!--Check if admin has logged in-->
	<?php 	if($_SESSION['SESS_CLASS'] == 'admin') {
					echo "| <a class='user_nav' href='add-user.php'>Ny användare</a> ";
					echo "| <a class='user_nav' href='change-user-pswd.php'>Byt användares lösenord</a> ";
					echo "| <a class='user_nav' href='delete-user.php'>Ta bort användare</a> ";
			}
	?>
	| <a class='user_nav' href='change-pswd.php'>Byt lösenord</a>
	| <a class="user_nav" href="logout.php">Logga ut</a>
</div>

<div id="logo_menu_container">
	<div id="logo">
	</div>
	<!--Div holding menu-->
	<div id="menu_container">
		<!--Commented block below is for multilevel dropdown navigation bar-->
		<!--<ul id="menu">
			<li class="menu-item">
				<a class='nav' href='home.php'>Hem</a>
			</li>
			<li class="menu-item">|</li>
			<li class="menu-item">
				Ungdomsavdelningen
				<ul class="sub-menu">
					<li class="sub-item">
						Medlemshantering
						<ul class="third-menu">
							<li><a class='nav' href='add-jun-member.php'>Lägg till ny junior</a></li>
							<li><a class='nav' href='#'>Redigera junior</a></li>
							<li><a class='nav' href='#'>Flytta junior till alarmavdelningen</a></li>
							<li><a class='nav' href='#'>Inaktivera junior</a></li>
							<li><a class='nav' href='#'>Återaktivera junior</a></li>
						</ul>
					</li>
					<li class="sub-item">
						Jobs
					</li>
					<li class="sub-item">
						Contact
					</li>
				</ul>
			</li>
			<li class="menu-item">|</li>
			<li class="menu-item">
				Alarmavdelningen
				<ul class="sub-menu">
					<li class="sub-item">
						Medlemshantering
						<ul class="third-menu">
							<li><a class='nav' href='add-member.php'>Lägg till ny senior</a> </li>
							<li><a class='nav' href='edit-member.php'>Redigera senior</a> </li>
							<li><a class='nav' href='#'>Flytta senior till oldboysavdelningen</a></li>
							<li><a class='nav' href='inactivate-member.php'>Inaktivera senior</a></li>
							<li><a class='nav' href='activate-member.php'>Återaktivera senior</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="menu-item">|</li>
			<li class="menu-item">
				Third Menu
			</li>
			<li class="menu-item">|</li>
			<li class="menu-item">
				Fourth Menu
			</li>
		</ul>​-->

		<ul id="navbar">
			<li>
				<a class='nav' href='home.php'>Hem</a>
			</li>
			<li><a>|</a></li>
			<li>
				<a class='nav' href="#">Ungdomsavdelningen</a>
				<ul>
					<li>
						<a class='nav' href='jun-department-report.php'>Visa sammanställning</a>
					</li>	
					<li>
						<a class='nav' href='list-jun-members.php'>Lista medlemmar</a>
					</li>									
					<li>
						<a class='nav' href='get-specific-jun-member.php'>Visa information om specifik medlem</a>
					</li>
					<li>
						<a class='nav' href='contact-list-jun-members.php'>Kontaktlista</a>
					</li>					
					<li>
						<a class='nav' href='get-jun-members-education.php'>Visa utbildningshistorik</a>
					</li>
					<li>
						<a class='nav' href='list-beginner-jun-members.php'>Visa ungdomar som genomfört Nybörjarkursen</a>
					</li>		
					<li>
						<a class='nav' href='list-lvlone-jun-members.php'>Visa ungdomar som genomfört Nivåkurs 1</a>
					</li>
					<li>
						<a class='nav' href='list-lvltwo-jun-members.php'>Visa ungdomar som genomfört Nivåkurs 2</a>
					</li>
					<li>
						<a class='nav' href='list-lvlthree-jun-members.php'>Visa ungdomar som genomfört Nivåkurs 3</a>
					</li>
					<li>
						<a class='nav' href='list-lvlfour-jun-members.php'>Visa ungdomar som genomfört Nivåkurs 4</a>
					</li>	
					<li>
						<a class='nav' href='list-jununitcommander-jun-members.php'>Visa ungdomar som genomfört Gruppchefs utbildningen</a>
					</li>	
					<li>
						<a class='nav' href='list-edu-jun-members.php'>Visa ungdomar som genomfört Utbildarkursen</a>
					</li>	
					<li>
						<a class='nav' href='add-jun-member.php'>Lägg till ny medlem</a>
					</li>
					<li>
						<a class='nav' href='edit-jun-member.php'>Redigera befintlig medlem</a>
					</li>					
					<li>
						<a class='nav' href='move-to-senior.php'>Flytta medlem till alarmavdelningen</a>
					</li>																							
					<li>
						<a class='nav' href='inactivate-jun-member.php'>Inaktivera medlem</a>
					</li>
					<li>
						<a class='nav' href='activate-jun-member.php'>Återaktivera medlem</a>
					</li>
				</ul>
			</li>	
			<li><a>|</a></li>
			<li>
				<a class='nav' href="#">Alarmavdelningen</a>
				<ul>
					<li>
						<a class='nav' href='department-report.php'>Visa sammanställning</a>
					</li>	
					<li>
						<a class='nav' href='list-chief-assistantchief-members.php'>Visa kårchef, biträdande kårchef och enhetschefer</a>
					</li>								
					<li>
						<a class='nav' href='list-members.php'>Lista medlemmar</a>
					</li>
					<li>
						<a class='nav' href='get-specific-member.php'>Visa information om specifik medlem</a>
					</li>
					<li>
						<a class='nav' href='contact-list-members.php'>Kontaktlista</a>
					</li>	
					<li>
						<a class='nav' href='list-members-trustassignment.php'>Visa medlemmar med förtroendeuppdrag</a>
					</li>		
					<li>
						<a class='nav' href='list-otherfiredept-members.php'>Visa medlemmar med tidigare brandkår</a>
					</li>												
					<li>
						<a class='nav' href='add-member.php'>Lägg till ny medlem</a> 
					</li>
					<li>
						<a class='nav' href='edit-member.php'>Redigera befintlig medlem</a> 
					</li>					
					<li>
						<a class='nav' href='move-to-oldboy.php'>Flytta medlem till oldboysavdelningen</a>
					</li>					
					<li>
						<a class='nav' href='inactivate-member.php'>Inaktivera medlem</a>
					</li>
					<li>
						<a class='nav' href='activate-member.php'>Återaktivera medlem</a>
					</li>
				</ul>
			</li>
			<li><a>|</a></li>
			<li>
				<a class='nav' href="#">Rökdykare</a>
				<ul>
					<li>
						<a class='nav' href='list-smokediver-members-smokemenu.php'>Visa utbildade rökdykare</a>
					</li>
					<li>
						<a class='nav' href='smokediver-report.php'>Visa sammanställning av rökdykare</a>
					</li>
					<li>
						<a class='nav' href='edit-smokediver.php'>Redigera rökdykare</a>
					</li>					
				</ul>
			</li>
			<li><a>|</a></li>			
			<li>
				<a class='nav' href='#'>Utbildning</a>
				<ul>
					<li>
						<a class='nav' href='get-members-education.php'>Visa utbildningshistorik</a>
					</li>
					<li>
						<a class='nav' href='list-extmen-members.php'>Visa släckningsmän</a>
					</li>	
					<li>
						<a class='nav' href='list-rescmen-members.php'>Visa räddningsmän</a>
					</li>	
					<li>
						<a class='nav' href='list-smokediver-members.php'>Visa rökdykare</a>
					</li>		
					<li>
						<a class='nav' href='list-highwork-members.php'>Visa medlemmar som genomfört Arbete på Hög Höjd</a>
					</li>	
					<li>
						<a class='nav' href='list-firstaid-members.php'>Visa medlemmar som genomfört Brandkårens FHJ</a>
					</li>	
					<li>
						<a class='nav' href='list-oxygen-members.php'>Visa medlemmar som genomfört Syredelegering utbildning</a>
					</li>
					<li>
						<a class='nav' href='list-surfacerescue-members.php'>Visa ytlivräddare</a>
					</li>	
					<li>
						<a class='nav' href='list-chiefedu-members.php'>Visa medlemmar som genomfört Kårchefs utbildning</a>
					</li>		
					<li>
						<a class='nav' href='list-unit-commander-members.php'>Visa enhetschefer</a>
					</li>	
					<li>
						<a class='nav' href='list-otheredu-members.php'>Visa medlemmar som genomfört någon Övrig utbildning</a>
					</li>	
					<li>
						<a class='nav' href='list-junioredu-members.php'>Visa medlemmar som genomfört någon Junior utbildning</a>
					</li>		
					<li>
						<a class='nav' href='list-driverlicense-members.php'>Visa Körkortssammanställning</a>
					</li>	
				</ul>
			</li>
			<li><a>|</a></li>			
			<li>
				<a class='nav' href="#">Oldboysavdelningen</a>
				<ul>
					<li>
						<a class='nav' href='old-department-report.php'>Visa sammanställning</a>
					</li>				
					<li>
						<a class='nav' href='list-old-members.php'>Lista medlemmar</a>
					</li>
					<li>
						<a class='nav' href='get-specific-old-member.php'>Visa information om specifik medlem</a>
					</li>
					<li>
						<a class='nav' href='contact-list-old-members.php'>Kontaktlista</a>
					</li>	
					<li>
						<a class='nav' href='get-old-members-education.php'>Visa utbildningshistorik</a>
					</li>					
					<li>
						<a class='nav' href='list-old-members-trustassignment.php'>Visa medlemmar med förtroendeuppdrag</a>
					</li>
					<li>
						<a class='nav' href='list-otherfiredept-old-members.php'>Visa medlemmar med tidigare brandkår</a>
					</li>												
					<li>
						<a class='nav' href='add-old-member.php'>Lägg till ny medlem</a>
					</li>
					<li>
						<a class='nav' href='edit-old-member.php'>Redigera befintlig medlem</a>
					</li>										
					<li>
						<a class='nav' href='inactivate-old-member.php'>Inaktivera medlem</a>
					</li>
					<li>
						<a class='nav' href='activate-old-member.php'>Återaktivera medlem</a>
					</li>
				</ul>
			</li>
			<li><a>|</a></li>
			<li>
				<a class='nav' href='#'>Utmärkelser</a>
				<ul>
					<li>
						<a class='nav' href='list-all-awards.php'>Lista utdelade utmärkelser</a>
					</li>
					<li>
						<a class='nav' href='who-should-get-award.php'>Visa medlemmar som ska tilldelas utmärkelse</a>
					</li>
					<li>
						<a class='nav' href='assign-award.php'>Tilldela utmärkelse</a>
					</li>
				</ul>
			</li>
			<li><a>|</a></li>
			<li>
				<a class='nav' href='#'>Styrelsen</a>
				<ul>
					<li>
						<a class='nav' href='list-board.php'>Lista styrelsen</a>
					</li>
					<li>
						<a class='nav' href='add-new-board-member.php'>Lägg till utomstående i styrelsen</a>
					</li>
					<li>
						<a class='nav' href='add-existing-member-to-board.php'>Lägg till befintlig medlem i styrelsen</a>
					</li>
					<li>
						<a class='nav' href='edit-board-member.php'>Redigera styrelsemedlem</a>
					</li>
					<li>
						<a class='nav' href='remove-board-member.php'>Ta bort styrelsemedlem</a>
					</li>
				</ul>
			</li>
			<li><a>|</a></li>
			<li>
				<a class='nav' href='help.php'>Hjälp</a>
			</li>
		</ul>
	</div>
</div>