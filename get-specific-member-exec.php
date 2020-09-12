<?php
	//Run the authentication script
	require_once('auth.php');

	//To handle output buffer
	ob_start();
	
	//Start session
	session_start();

	//Include database connection details
	require_once('config.php');
	require_once('functions.php');
	
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

	//Query to get all information about a member
	$qry = "SELECT * FROM crew WHERE crew_id='".clean($_POST['activeMemberSelect'])."'";
	$result = @mysql_query($qry);
	
	if($result) {
		$member = mysql_fetch_assoc($result);
		
		//Array to store new member form data in
		$member_data['selected_member'] = $_POST['activeMemberSelect'];
		$member_data['name'] = $member['firstname'].' '.$member['lastname'];
		$member_data['dob'] = substr($member['dob'],-2,2).'.'.substr($member['dob'],-5,2).'-'.substr($member['dob'],-10,4);
		$member_data['age'] = calculate_age($member['dob']);
		$member_data['nameice'] = $member['nameice'];
		$member_data['ice'] = $member['ice'];
		$member_data['seniorstarted'] = $member['seniorstarted'];
		
		//Check if member has any junior start year
		if($member['juniorstarted'] != '') {
			$member_data['juniorstarted'] = $member['juniorstarted'];
		} else {
			$member_data['juniorstarted'] = 'Har ej varit medlem i ungdomsavdelningen';
		}
		
		//Check if member has been assigned any number
		if($member['nr'] != '') {
			$member_data['nr'] = $member['nr'];
		} else {
			$member_data['nr'] = '-';
		}
		
		//Check if member has an phone number
		if($member['phone'] != '') {
			$member_data['phone'] = $member['phone'];
		} else {
			$member_data['phone'] = '-';
		}
		
		//Check if member has an email
		if($member['email'] != '') {
			$member_data['email'] = $member['email'];
		} else {
			$member_data['email'] = '-';
		}
		
		//check if member has any drivers license
		if($member['driverslicense'] != '') {
			$member_data['driverslicense'] = $member['driverslicense'];
		} else {
			$member_data['driverslicense'] = '-';
		}
		
		//Check if member has been assigned any other awards
		if($member['otheraward']) {
			$member_data['otheraward'] = $member['otheraward'];
		} else {
			//$member_data['otheraward'] = 'Har inte tilldelats några övriga utmärkelser';
			$member_data['otheraward'] = '-';
		}
		
		//Check if member has done any junior courses
		if($member['junioredusummary'] != '') {
			$member_data['junioreducation'] = $member['junioredusummary'];
		} else {
			//$member_data['junioreducation'] = 'Har ej genomfört några utbildningar som junior';
			$member_data['junioreducation'] = '-';
		}
		
		//If member has done any other education
		if($member['othereducation'] != '') {
			$member_data['othereducation'] = $member['othereducation'];
		} else {
			//$member_data['othereducation'] = 'Har ej genomfört några övriga utbildningar';
			$member_data['othereducation'] = '-';
		}
		
		//If member is part of the board assign proper string to variable
		if($member['board'] == 'yes') {
			$member_data['board'] = 'Ja';
			
			//If member has a role in the board, concat that to variable
			if($member['boardrole'] != '') {
				$member_data['board'] = $member_data['board'].', som '.strtolower($member['boardrole']);
			}
		} else {
			$member_data['board'] = 'Sitter ej i styrelsen';
		}
		
		//If member is chief assign proper value to variable
		if($member['chief'] == 'yes') {
			$member_data['chief'] = 'Ja';
		} else {
			$member_data['chief'] = 'Nej';
		}
		
		//If member is assistant chief assign proper value to variable
		if($member['assistantchief'] == 'yes') {
			$member_data['assistantchief'] = 'Ja';
		} else {
			$member_data['assistantchief'] = 'Nej';
		}
		
		//If member is active smokediver assign proper value to variable
		if($member['activesmokediver'] == 'yes') {
			$member_data['active_smoke_diver'] = 'Ja';
		} else {
			$member_data['active_smoke_diver'] = 'Nej';
		}		
		
		//If member has an assignment in trust, assign proper value to variable
		if($member['assignmentintrust'] != '') {
			$member_data['assignmentintrust'] = ucfirst($member['assignmentintrust']);
		} else {
			//$member_data['assignmentintrust'] = 'Har inget förtroendeuppdrag';
			$member_data['assignmentintrust'] = '-';
		}
		
		//If member has been in another firedepartment
		if($member['otherfiredept'] != '') {
			$member_data['other_firedept'] = $member['otherfiredept']; 
		} else {
			$member_data['other_firedept'] = '-';
		}
		
		//Check if member is a smokediver
		if((($member['smokediver'] != 'not_done') || ($member['basicff'] != 'not_done')) && ($member['activesmokediver'] == 'yes')) {
			//Check if member has done the uleborg test yet
			if($member['uleborgtest'] == 'not_done') {
				$member_data['uleborg'] = 'Har ej utfört uleåborgstestet ännu';
			} else {
				//Check if member passed or not
				if($member['uleborgresult'] == 'passed') {
					$member_data['uleborg'] = 'Utfört '.$member['uleborgtest'].' med Godkänt resultat'; 
				} else {
					$member_data['uleborg'] = 'Utfört '.$member['uleborgtest'].' med Ej Godkänt resultat';
				}
			}
			
			//Check if member has done the ekg test yet
			if($member['belastnekg'] == 'not_done') {
				$member_data['belastnekg'] = 'Har ej utfört belastnings ekg ännu';
			} else {
				//Check if member passed or not
				if($member['belastnekgresult'] == 'passed') {
					$member_data['belastnekg'] = 'Utfört '.$member['belastnekg'].' med Godkänt resultat'; 
				} else {
					$member_data['belastnekg'] = 'Utfört '.$member['belastnekg'].' med Ej Godkänt resultat';
				}
			}
		} else {
			if($member['activesmokediver'] == 'no' && (($member['smokediver'] != 'not_done') || ($member['basicff'] != 'not_done'))) {
				$member_data['uleborg'] = 'Medlem är ej aktiv rökdykare, ska inte göra uleåborgstestet';
				$member_data['belastnekg'] = 'Medlem är ej aktiv rökdykare, ska inte göra belastnings EKG';				
			} else {
				$member_data['uleborg'] = 'Medlem är ej rökdykare, ska inte göra uleåborgstestet';
				$member_data['belastnekg'] = 'Medlem är ej rökdykare, ska inte göra belastnings EKG';
			}
		}
		
		//Variable to store educations
		$education = '';
		
		//Check if member has done extman education and concat result to education string
		if($member['extman'] != 'not_done') {
			$education = $education.'Släckningsman('.$member['extman'].')';
		}
		
		//Check if member has done rescueman education and concat result to education string
		if($member['rescman'] != 'not_done') {
			if($education == '') {
				$education = $education.'Räddningsman('.$member['rescman'].')';
			} else {
				$education = $education.', Räddningsman('.$member['rescman'].')';
			}
		}
		
		//Check if member has done smokediver education and concat result to education string
		if($member['smokediver'] != 'not_done') {
			if($education == '') {
				$education = $education.'Rökdykare('.$member['smokediver'].')';
			} else {
				$education = $education.', Rökdykare('.$member['smokediver'].')';
			}
		}
		
		//Check if member has done basic fire fighting education and concat result to education string
		if($member['basicff'] != 'not_done') {
			if($education == '') {
				$education = $education.'Basic Fire Fighting('.$member['basicff'].')';
			} else {
				$education = $education.', Basic Fire Fighting('.$member['basicff'].')';
			}
		}		
		
		//Check if member has done high work education and concat result to education string
		if($member['highwork'] != 'not_done') {
			if($education == '') {
				$education = $education.'Arbete på hög höjd('.$member['highwork'].')';
			} else {
				$education = $education.', Arbete på hög höjd('.$member['highwork'].')';
			}
		}
		
		//Check if member has done first aid education and concat result to education string
		if($member['firstaid'] != 'not_done') {
			if($education == '') {
				$education = $education.'Brandkårens första hjälp('.$member['firstaid'].')';
			} else {
				$education = $education.', Brandkårens första hjälp('.$member['firstaid'].')';
			}
		}
		
		//Check if member has done oxygen education and concat result to education string
		if($member['oxygen'] != 'not_done') {
			if($education == '') {
				$education = $education.'Syredelegering('.$member['oxygen'].')';
			} else {
				$education = $education.', Syredelegering('.$member['oxygen'].')';
			}
		}
		
		//Check if member has done surface rescue course and concat result to education string
		if($member['surfacerescue'] != 'not_done') {
			if($education == '') {
				$education = $education.'Ytlivräddning('.$member['surfacerescue'].')';
			} else {
				$education = $education.', Ytlivräddning('.$member['surfacerescue'].')';
			}
		}
		
		//Check if member has done chief course and concat result to education string
		if($member['chiefedu'] != 'not_done') {
			if($education == '') {
				$education = $education.'Kårchef('.$member['chiefedu'].')';
			} else {
				$education = $education.', Kårchef('.$member['chiefedu'].')';
			}
		}		
		
		//Check if member has done unit commander rescue course and concat result to education string
		if($member['unitcommander'] != 'not_done') {
			if($education == '') {
				$education = $education.'Enhetschef('.$member['unitcommander'].')';
			} else {
				$education = $education.', Enhetschef('.$member['unitcommander'].')';
			}
		}
		
		//If member hasn't done any courses
		if($education == '') {
			//$education = 'Har ej genomfört några utbildningar';
			$education = '-';
		}	
		
		//Store education to member_data array
		$member_data['education'] = $education;

		//Variable to store awards in
		$awards = '';
		
		//Check if senior has achieved fiveyear pin
		if($member['fiveyearpin'] != 'not_assigned') {
			$awards = $awards.'JFBK\'s förtjänstetecken 5 år('.$member['fiveyearpin'].')';
		}	

		//Check if senior has achieved ten year pin and concat result to awards string
		if($member['tenyearpin'] != 'not_assigned') {
			if($awards == '') {
				$awards = $awards.'FSB\'s förtjänstetecken 10 år('.$member['tenyearpin'].')';
			} else {
				$awards = $awards.', FSB\'s förtjänstetecken 10 år('.$member['tenyearpin'].')';
			}
		}

		//Check if senior has achieved twenty year pin and concat result to awards string
		if($member['twentyyearpin'] != 'not_assigned') {
			if($awards == '') {
				$awards = $awards.'FSB\'s förtjänstetecken 20 år('.$member['twentyyearpin'].')';
			} else {
				$awards = $awards.', FSB\'s förtjänstetecken 20 år('.$member['twentyyearpin'].')';
			}
		}
		
		//Check if senior has achieved thirty year pin and concat result to awards string
		if($member['thirtyyearpin'] != 'not_assigned') {
			if($awards == '') {
				$awards = $awards.'FSB\'s förtjänstetecken 30 år('.$member['thirtyyearpin'].')';
			} else {
				$awards = $awards.', FSB\'s förtjänstetecken 30 år('.$member['thirtyyearpin'].')';
			}
		}				

		//Check if senior has achieved special pin and concat result to awards string
		if($member['specialpin'] != 'not_assigned') {
			if($awards == '') {
				$awards = $awards.'JFBK\'s förtjänstetecken - special medalj('.$member['specialpin'].')';
			} else {
				$awards = $awards.', JFBK\'s förtjänstetecken - special medalj('.$member['specialpin'].')';
			}
		}	
		
		//If member hasn't been assigned any awards
		if($awards == '') {
			$awards = '-';
		}
		
		//Store awards to member_data array
		$member_data['awards'] = $awards;

		//Store new member data array as Session
		$_SESSION['MEMBER_DATA'] = $member_data;
		
		session_write_close();
		ob_clean();
		header("location: get-specific-member.php");
		exit();
	} else {
		die(mysql_error());
	}
?>