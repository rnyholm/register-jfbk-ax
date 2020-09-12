<?php
	//Run the authentication script
	require_once('auth.php');
	
	//To handle output buffer
	ob_start();
	
	//Start session
	session_start();

	//Include database connection details
	require_once('config.php');
	
	//Include functions
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
	$qry = "SELECT * FROM crew WHERE crew_id='".clean($_POST['activeOldMemberSelect'])."'";
	$result = @mysql_query($qry);
	
	if($result) {
		$member = mysql_fetch_assoc($result);
		
		//Array to store new member form data in
		$member_data['selected_member'] = $_POST['activeOldMemberSelect'];
		$member_data['name'] = $member['firstname'].' '.$member['lastname'];
		$member_data['dob'] = substr($member['dob'],-2,2).'.'.substr($member['dob'],-5,2).'-'.substr($member['dob'],-10,4);
		$member_data['age'] = calculate_age($member['dob']);
		$member_data['nameice'] = $member['nameice'];
		$member_data['ice'] = $member['ice'];		
		$member_data['oldboystarted'] = $member['oldboystarted'];
		
		//Check if member has any junior start year
		if($member['juniorstarted'] != '') {
			$member_data['juniorstarted'] = $member['juniorstarted'];
		} else {
			$member_data['juniorstarted'] = 'Har ej varit medlem i ungdomsavdelningen';
		}
		
		//Check if member has any senior start year
		if($member['seniorstarted'] != '') {
			$member_data['seniorstarted'] = $member['seniorstarted'];
		} else {
			$member_data['seniorstarted'] = 'Har ej varit medlem i alarmavdelningen';
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
		
		//Check if member has been assigned any other awards
		if($member['otheraward']) {
			$member_data['otheraward'] = $member['otheraward'];
		} else {
			//$member_data['otheraward'] = 'Har inte tilldelats några övriga utmärkelser';
			$member_data['otheraward'] = '-';
		}
		
		/*
		//Check if member has been assigned any awards
		if($member['awardsummary']) {
			$member_data['awards'] = $member['awardsummary'];
		} else {
			//$member_data['otheraward'] = 'Har inte tilldelats några övriga utmärkelser';
			$member_data['awards'] = '-';
		}
		*/
		
		//Check if member has done any junior courses
		if($member['junioredusummary'] != '') {
			$member_data['junior_education'] = $member['junioredusummary'];
		} else {
			//$member_data['junioreducation'] = 'Har ej genomfört några utbildningar som junior';
			$member_data['junior_education'] = '-';
		}
		
		//Check if member has done any senior courses
		if($member['senioredusummary'] != '') {
			$member_data['senior_education'] = $member['senioredusummary'];
		} else {
			$member_data['senior_education'] = '-';
		}
		
		//If member has done any other education
		if($member['othereducation'] != '') {
			$member_data['other_education'] = $member['othereducation'];
		} else {
			//$member_data['othereducation'] = 'Har ej genomfört några övriga utbildningar';
			$member_data['other_education'] = '-';
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
		
		//If member has an assignment in trust, assign proper value to variable
		if($member['assignmentintrust'] != '') {
			$member_data['assignment_in_trust'] = ucfirst($member['assignmentintrust']);
		} else {
			//$member_data['assignmentintrust'] = 'Har inget förtroendeuppdrag';
			$member_data['assignment_in_trust'] = '-';
		}
		
		//If member has been in another firedepartment
		if($member['otherfiredept'] != '') {
			$member_data['other_firedept'] = $member['otherfiredept'];
		} else {
			$member_data['other_firedept'] = '-';
		}	

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
		header("location: get-specific-old-member.php");
		exit();
	} else {
		die(mysql_error());
	}
?>