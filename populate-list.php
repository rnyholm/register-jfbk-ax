<?php

	/**
	 * File.......: populate-list.php
	 * Author.....: Robert Nyholm
	 * Description: File containing functions to fill and populate lists.
	 */

	//Run the authentication script
	require_once('auth.php');	
	
	//Include database connection details
	require_once('config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	
	/**
	 * Function to populate list with suer classes
	 * @param String selected selected alternative
	 */
	function populate_with_classes($selected) {
		echo("<select class=\"textfield\" name=\"classSelect\">");
			if("admin" == $selected) {
				echo("<option value=\"admin\" selected=\"selected\">Administratör</option>");
				echo("<option value=\"user\">Användare</option>");
			} else {
				echo("<option value=\"admin\">Administratör</option>");
				echo("<option value=\"user\" selected=\"selected\">Användare</option>");
			}
		echo("</select>");
	}
	
	/**
	 * Function to populate list with admins
	 * @param String selected selected alternative 
	 */
	function populate_with_admins($selected) {
		$query = "SELECT firstname, lastname, login FROM members WHERE class != 'admin'"; 
		$results = mysql_query($query) or die(mysql_error()); 

		if(mysql_num_rows($results) > 0){ 
			echo("<select class=\"textfield\" name=\"userSelect\">"); 
			while($row = mysql_fetch_object($results)){ 
				if($row->login == $selected) {
					echo("<option value=\"$row->login\" selected=\"selected\">$row->firstname $row->lastname</option>"); 
				} else {
					echo("<option value=\"$row->login\">$row->firstname $row->lastname</option>"); 
				}
			} 
			echo("</select>"); 
		} else{ 
			echo("<i>Inga användare finns i registret!</i>"); 
		}
	}
	
	/**
	 * Function to populate list with all members, both active and inactive
	 * @param String selected selected alternative  
	 */
	function populate_with_members($selected) {
		$query = "SELECT crew_id, firstname, lastname FROM crew"; 
		$results = mysql_query($query) or die(mysql_error()); 

		if(mysql_num_rows($results) > 0){ 
			echo("<select class=\"textfield\" name=\"memberSelect\">"); 
			while($row = mysql_fetch_object($results)){ 
				if($row->crew_id == $selected) {
					echo("<option value=\"$row->crew_id\" selected=\"selected\">$row->firstname $row->lastname</option>"); 
				} else {
					echo("<option value=\"$row->crew_id\">$row->firstname $row->lastname</option>"); 
				}
			} 
			echo("</select>"); 
		} else{ 
			echo("<i>Inga medlemmar finns i databasen!</i>"); 
		}
	}
	
	/**
	 * Function to populate list with active senior members
	 * @param String selected selected alternative  
	 */
	function populate_with_active_members($selected) {
		$query = "SELECT crew_id, firstname, lastname FROM crew WHERE active='true' AND type='senior'"; 
		$results = mysql_query($query) or die(mysql_error()); 

		if(mysql_num_rows($results) > 0){ 
			echo("<select class=\"textfield\" name=\"activeMemberSelect\">"); 
			while($row = mysql_fetch_object($results)){ 
				if($row->crew_id == $selected) {
					echo("<option value=\"$row->crew_id\" selected=\"selected\">$row->firstname $row->lastname</option>"); 
				} else {
					echo("<option value=\"$row->crew_id\">$row->firstname $row->lastname</option>"); 
				}
			} 
			echo("</select>"); 
		} else{ 
			echo("<i>Inga aktiva medlemmar finns i alarmavdelningen!</i>"); 
		}
	}

	/**
	 * Function to populate list with board members from tables crew and extboardmembers
	 * @param String selected selected alternative 
	 */
	function populate_with_board_members($selected) {
		//Get boardmembers from crew table
		$query = "SELECT crew_id, firstname, lastname FROM crew WHERE active='true' AND board='yes'"; 
		$crew_result = mysql_query($query) or die(mysql_error());
		
		//Get boardmembers from extboardmembers
		$query = "SELECT board_id, firstname, lastname FROM extboardmembers"; 
		$ext_result = mysql_query($query) or die(mysql_error());
		
		 //Only print select if we have any results
		if(mysql_num_rows($crew_result) > 0 || mysql_num_rows($ext_result) > 0) {
			echo("<select class=\"textfield\" name=\"boardMemberSelect\">");
			
			//Results from crew table exist, append crew_id and S
			if(mysql_num_rows($crew_result) > 0) {
				while($row = mysql_fetch_object($crew_result)){ 
					if('C'.$row->crew_id == $selected) {
						echo("<option value=\"".'C'."$row->crew_id\" selected=\"selected\">$row->firstname $row->lastname</option>"); 
					} else {
						echo("<option value=\"".'C'."$row->crew_id\">$row->firstname $row->lastname</option>"); 
					}
				} 
			}
			
			//Results from extendedboardmembers table exist, append board_id and E
			if(mysql_num_rows($ext_result) > 0) {
				while($row = mysql_fetch_object($ext_result)){ 
					if('E'.$row->board_id == $selected) {
						echo("<option value=\"".'E'."$row->board_id\" selected=\"selected\">$row->firstname $row->lastname</option>"); 
					} else {
						echo("<option value=\"".'E'."$row->board_id\">$row->firstname $row->lastname</option>"); 
					}
				} 
			}
			
			echo("</select>"); 
		} else{ 
			echo("<i>Finns inga styrelsemedlemmar!</i>"); 
		}	
	}
	
	/**
	 * Function to populate list with no board members from table crew
	 * @param String selected selected alternative 
	 */
	function populate_with_noboard_members($selected) {
		//Get boardmembers from crew table
		$query = "SELECT crew_id, firstname, lastname FROM crew WHERE active='true' AND board='no' AND type NOT LIKE 'junior'"; 
		$crew_result = mysql_query($query) or die(mysql_error());
		
		 //Only print select if we have any results
		if(mysql_num_rows($crew_result) > 0 || mysql_num_rows($ocrew_result) > 0) {
			echo("<select class=\"textfield\" name=\"noBoardMemberSelect\">");
			
			//Results from crew table exist, append crew_id and S
			if(mysql_num_rows($crew_result) > 0) {
				while($row = mysql_fetch_object($crew_result)){ 
					if('S'.$row->crew_id == $selected) {
						echo("<option value=\"".'S'."$row->crew_id\" selected=\"selected\">$row->firstname $row->lastname</option>"); 
					} else {
						echo("<option value=\"".'S'."$row->crew_id\">$row->firstname $row->lastname</option>"); 
					}
				} 
			}
			
			echo("</select>"); 
		} else{ 
			echo("<i>Finns inga medlemmar som inte är med i styrelsen!</i>"); 
		}	
	}
	
	/**
	 * Function to populate list with members and old members from table crew
	 * @param String selected selected alternative
	 */
	function populate_with_members_old_members($selected) {
		//Get boardmembers from crew table
		$query = "SELECT crew_id, firstname, lastname FROM crew WHERE active='true' AND type NOT LIKE 'junior'";
		$crew_result = mysql_query($query) or die(mysql_error());
	
		//Only print select if we have any results
		if(mysql_num_rows($crew_result) > 0 || mysql_num_rows($ocrew_result) > 0) {
			echo("<select class=\"textfield\" name=\"memberOldMemberSelect\">");
				
			//Results from crew table exist,
			if(mysql_num_rows($crew_result) > 0) {
				while($row = mysql_fetch_object($crew_result)){
					if($row->crew_id == $selected) {
						echo("<option value=\"$row->crew_id\" selected=\"selected\">$row->firstname $row->lastname</option>");
					} else {
						echo("<option value=\"$row->crew_id\">$row->firstname $row->lastname</option>");
					}
				}
			}
				
			echo("</select>");
		} else{
			echo("<i>Finns inga medlemmar som är aktiva i alarmavdelningen eller oldboysavdelningen!</i>");
		}
	}

	/**
	 * Function to populate list with active junior members
	 * @param String selected selected alternative 
	 */
	function populate_with_active_jun_members($selected) {
		$query = "SELECT crew_id, firstname, lastname FROM crew WHERE active='true' AND type='junior'"; 
		$results = mysql_query($query) or die(mysql_error()); 

		if(mysql_num_rows($results) > 0){ 
			echo("<select class=\"textfield\" name=\"activeJunMemberSelect\">"); 
			while($row = mysql_fetch_object($results)){ 
				if($row->crew_id == $selected) {
					echo("<option value=\"$row->crew_id\" selected=\"selected\">$row->firstname $row->lastname</option>"); 
				} else {
					echo("<option value=\"$row->crew_id\">$row->firstname $row->lastname</option>"); 
				}
			} 
			echo("</select>"); 
		} else{ 
			echo("<i>Inga aktiva medlemmar finns i ungdomsavdelningen!</i>"); 
		}
	}
	
	/**
	 * Function to populate list with active oldboys members
	 * @param String selected selected alternative 
	 */
	function populate_with_active_old_members($selected) {
		$query = "SELECT crew_id, firstname, lastname FROM crew WHERE active='true' AND type='oldboy'";
		$results = mysql_query($query) or die(mysql_error());
	
		if(mysql_num_rows($results) > 0){
			echo("<select class=\"textfield\" name=\"activeOldMemberSelect\">");
			while($row = mysql_fetch_object($results)){
				if($row->crew_id == $selected) {
					echo("<option value=\"$row->crew_id\" selected=\"selected\">$row->firstname $row->lastname</option>");
				} else {
					echo("<option value=\"$row->crew_id\">$row->firstname $row->lastname</option>");
				}
			}
			echo("</select>");
		} else{
			echo("<i>Inga aktiva medlemmar finns i oldboysavdelningen!</i>");
		}
	}

	/**
	 * Function to populate list with inactive members
	 * @param String selected selected alternative
	 */
	function populate_with_inactive_members($selected) {
		$query = "SELECT crew_id, firstname, lastname FROM crew WHERE active='false' AND type='senior'"; 
		$results = mysql_query($query) or die(mysql_error()); 

		if(mysql_num_rows($results) > 0){ 
			echo("<select class=\"textfield\" name=\"inactiveMemberSelect\">"); 
			while($row = mysql_fetch_object($results)){ 
				if($row->crew_id == $selected) {
					echo("<option value=\"$row->crew_id\" selected=\"selected\">$row->firstname $row->lastname</option>"); 
				} else {
					echo("<option value=\"$row->crew_id\">$row->firstname $row->lastname</option>"); 
				}
			} 
			echo("</select>"); 
		} else{ 
			echo("<i>Finns inga inaktiva medlemmar i alarmavdelningen!</i>"); 
		}
	}

	/**
	 * Function to populate list with inactive oldmembers
	 * @param String selected selected alternative
	 */
	function populate_with_inactive_old_members($selected) {
		$query = "SELECT crew_id, firstname, lastname FROM crew WHERE active='false' AND type='oldboy'";
		$results = mysql_query($query) or die(mysql_error());
	
		if(mysql_num_rows($results) > 0){
			echo("<select class=\"textfield\" name=\"inactiveOldMemberSelect\">");
			while($row = mysql_fetch_object($results)){
				if($row->crew_id == $selected) {
					echo("<option value=\"$row->crew_id\" selected=\"selected\">$row->firstname $row->lastname</option>");
				} else {
					echo("<option value=\"$row->crew_id\">$row->firstname $row->lastname</option>");
				}
			}
			echo("</select>");
		} else{
			echo("<i>Finns inga inaktiva medlemmar i oldboysavdelningen!</i>");
		}
	}

	/**
	 * Function to populate list with active senior members
	 * @param String selected selected alternative
	 */
	function populate_with_inactive_jun_members($selected) {
		$query = "SELECT crew_id, firstname, lastname FROM crew WHERE active='false' AND type='junior'"; 
		$results = mysql_query($query) or die(mysql_error()); 

		if(mysql_num_rows($results) > 0){ 
			echo("<select class=\"textfield\" name=\"inactiveJunMemberSelect\">"); 
			while($row = mysql_fetch_object($results)){ 
				if($row->crew_id == $selected) {
					echo("<option value=\"$row->crew_id\" selected=\"selected\">$row->firstname $row->lastname</option>"); 
				} else {
					echo("<option value=\"$row->crew_id\">$row->firstname $row->lastname</option>"); 
				}
			} 
			echo("</select>"); 
		} else{ 
			echo("<i>Finns inga inaktiva medlemmar i ungdomsavdelningen!</i>"); 
		}
	}
	
	/**
	 * Function to populate list with start years for seniors
	 * @param String selected selected alternative
	 */
	function populate_with_senior_start_years($selected) {
		echo("<select class=\"textfield\" name=\"startYearSelect\">"); 
		$year = date("Y"); 
		
		for ($i = 0; $i <= 60; $i++) {
			if($year == $selected) {
				echo '<option value="'.$year.'" selected="selected">'.$year.'</option>'; 
			} else {
				echo '<option value="'.$year.'">'.$year.'</option>'; 
			}
			
			$year--;
		}
		
		echo("</select>"); 
	}
	
	/**
	 * Function to populate list with start years for juniors
	 * @param String selected selected alternative
	 */
	function populate_with_junior_start_years($selected) {
		echo("<select class=\"textfield\" name=\"startYearSelect\">"); 
		$year = date("Y"); 
		
		for ($i = 0; $i <= 60; $i++) {
			if($year == $selected) {
				echo '<option value="'.$year.'" selected="selected">'.$year.'</option>'; 
			} else {
				echo '<option value="'.$year.'">'.$year.'</option>'; 
			}
			
			$year--;
		}
		
		echo("</select>"); 
	}
	
	/**
	 * Function to populate list with junior birth years
	 * @param String selected selected alternative
	 */
	function populate_with_jun_birth_years($selected) {
		echo("<select class=\"textfield\" name=\"junBirthYearSelect\">"); 
		$year = date("Y"); 
		
		for ($i = 0; $i <= 20; $i++) {
			if($year == $selected) {
				echo '<option value="'.$year.'" selected="selected">'.$year.'</option>'; 
			} else {
				echo '<option value="'.$year.'">'.$year.'</option>'; 
			}
			
			$year--;
		}
		
		echo("</select>"); 
	}

	/**
	 * Function to populate list with education years
	 * @param String name course name
	 * @param String selected selected alternative
	 */
	function populate_with_education_years($name, $selected) {
		echo("<select class=\"textfield\" name=\"$name\">"); 
		$year = date("Y"); 
		
		for ($i = 0; $i <= 62; $i++) {
			 if($i == 0) {
				echo "<option value=\"not_done\">Ej genomförd</option>"; 
			 } else if($i == 1) {
			 	if($selected == "dont_know") {
			 		echo "<option value=\"Vet ej\" selected=\"selected\">Vet ej</option>";
			 	} else {
			 		echo "<option value=\"Vet ej\">Vet ej</option>";
			 	}
			 } else {
				if($year == $selected) {
					echo '<option value="'.$year.'" selected="selected">'.$year.'</option>'; 
				} else {
					echo '<option value="'.$year.'">'.$year.'</option>'; 
				}
				$year--;
			}
		}
		
		echo("</select>"); 
	}
	
	/**
	 * Function to populate list with award years
	 * @param String name award name
	 * @param String selected selected alternative
	 */
	function populate_with_award_years($name, $selected) {
		echo("<select class=\"textfield\" name=\"$name\">"); 
		$year = date("Y"); 
		
		for ($i = 0; $i <= 61; $i++) {
			 if($i == 0) {
				echo "<option value=\"not_assigned\">Ej tilldelad</option>"; 
			 } else {
				if($year == $selected) {
					echo '<option value="'.$year.'" selected="selected">'.$year.'</option>'; 
				} else {
					echo '<option value="'.$year.'">'.$year.'</option>'; 
				}
				$year--;
			}
		}
		
		echo("</select>"); 
	}
	
	/**
	 * Function to populate list with days in month
	 * @param String selected selected alternative
	 */
	function populate_with_days($selected) {
		echo("<select class=\"textfield\" name=\"day\">"); 
		
		for ($i = 1; $i <= 31; $i++) {
			if($i == $selected) {
				if($i < 10) {	
					$day = '0'.$i;
					echo '<option value="'.$day.'" selected="selected">'.$day.'</option>'; 
				} else {
					$day = $i;
					echo '<option value="'.$day.'" selected="selected">'.$day.'</option>'; 
				}
			} else {
				if($i < 10) {
					$day = '0'.$i;
					echo '<option value="'.$day.'">'.$day.'</option>'; 
				} else {
					$day = $i;
					echo '<option value="'.$day.'">'.$day.'</option>'; 
				}
			}
		}
		
		echo("</select>"); 	
	}

	/**
	 * Function to populate list with months in year
	 * @param String selected selected alternative
	 */
	function populate_with_months($selected) {
		echo("<select class=\"textfield\" name=\"month\">"); 
		
		for ($i = 1; $i <= 12; $i++) {
			if($i == $selected) {
				if($i < 10) {
					$month = '0'.$i; 
					echo '<option value="'.$month.'" selected="selected">'.$month.'</option>'; 
				} else {
					$month = $i; 
					echo '<option value="'.$month.'" selected="selected">'.$month.'</option>'; 
				}
			} else {
				if($i < 10) {
					$month = '0'.$i; 
					echo '<option value="'.$month.'">'.$month.'</option>'; 
				} else {
					$month = $i; 
					echo '<option value="'.$month.'">'.$month.'</option>'; 
				}
			}
		}
		
		echo("</select>"); 	
	}

	/**
	 * Function to populate list with years
	 * @param String selected selected alternative
	 */
	function populate_with_years($selected) {
		echo("<select class=\"textfield\" name=\"year\">"); 
		$year = date("Y"); 
		
		for ($i = 0; $i <= 90; $i++) {
			if($year == $selected) {
				echo '<option value="'.$year.'" selected="selected">'.$year.'</option>'; 
			} else {
				echo '<option value="'.$year.'">'.$year.'</option>'; 
			}
			
			$year--;
		}
		
		echo("</select>"); 
	}
	
	/**
	 * Function to populate list with smokedivers
	 * @param String selected selected alternative
	 */
	function populate_with_all_smokedivers($selected) {
		$query = "SELECT crew_id, firstname, lastname FROM crew WHERE active='true' AND type='senior' AND smokediver NOT LIKE 'not_done' OR active='true' AND type='senior' AND basicff NOT LIKE 'not_done'";
		$results = mysql_query($query) or die(mysql_error());
	
		if(mysql_num_rows($results) > 0){
			echo("<select class=\"textfield\" name=\"smokediverSelect\">");
			while($row = mysql_fetch_object($results)){
				if($row->crew_id == $selected) {
					echo("<option value=\"$row->crew_id\" selected=\"selected\">$row->firstname $row->lastname</option>");
				} else {
					echo("<option value=\"$row->crew_id\">$row->firstname $row->lastname</option>");
				}
			}
			echo("</select>");
		} else{
			echo("<i>Inga rökdykarutbildade finns i registret!</i>");
		}
	}
?>