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
	
	//Store POST value, representing member
	$member_data['selected_member'] = $_POST['activeMemberSelect'];

	//Store new member data array as Session
	$_SESSION['MEMBER_DATA'] = $member_data;

	//Input Validations
	if($_POST['password'] == '') {
		$errmsg_arr[] = 'Lösenord saknas';
		$errflag = true;	
	}

	//Create query
	$qry="SELECT * FROM members WHERE login='".clean($_SESSION['SESS_LOGIN'])."' AND passwd='".clean(md5($_POST['password']))."'";
	$result=mysql_query($qry);
	
	if(!$errflag) {
		//Check whether the query was successful or not
		if($result) {
			//Indeed admin are logged in
			if(mysql_num_rows($result) == 1) {
				//Create query to get all information about senior
				$qry = "SELECT * FROM crew WHERE crew_id='".clean($_POST['activeMemberSelect'])."'";
				$result = mysql_query($qry) or die(mysql_error());
				
				$member = mysql_fetch_assoc($result);
				
				//Variable to store education as senior
				$senior_education = '';
				
				//Check if senior has done extman
				if($member['extman'] != 'not_done') {
					$senior_education = $senior_education.'Släckningsman('.$member['extman'].')';
				}
				
				//Check if senior has done rescue man education and concat result to education string
				if($member['rescman'] != 'not_done') {
					if($senior_education == '') {
						$senior_education = $senior_education.'Räddningsman('.$member['rescman'].')';
					} else {
						$senior_education = $senior_education.', Räddningsman('.$member['rescman'].')';
					}
				}
				
				//Check if senior has done smoke diver education and concat result to education string
				if($member['smokediver'] != 'not_done') {
					if($senior_education == '') {
						$senior_education = $senior_education.'Rökdykare('.$member['smokediver'].')';
					} else {
						$senior_education = $senior_education.', Rökdykare('.$member['smokediver'].')';
					}
				}
				
				//Check if senior has done basic fire fighting education and concat result to education string
				if($member['basicff'] != 'not_done') {
					if($senior_education == '') {
						$senior_education = $senior_education.'Basic Fire Fighting('.$member['basicff'].')';
					} else {
						$senior_education = $senior_education.', Basic Fire Fighting('.$member['basicff'].')';
					}
				}				
				
				//Check if senior has done high work education and concat result to education string
				if($member['highwork'] != 'not_done') {
					if($senior_education == '') {
						$senior_education = $senior_education.'Arbete på hög höjd('.$member['highwork'].')';
					} else {
						$senior_education = $senior_education.', Arbete på hög höjd('.$member['highwork'].')';
					}
				}
				
				//Check if senior has done firstaid education and concat result to education string
				if($member['firstaid'] != 'not_done') {
					if($senior_education == '') {
						$senior_education = $senior_education.'Brandkårens FHJ('.$member['firstaid'].')';
					} else {
						$senior_education = $senior_education.', Brandkårens FHJ('.$member['firstaid'].')';
					}
				}
				
				//Check if senior has done oxygen education and concat result to education string
				if($member['oxygen'] != 'not_done') {
					if($senior_education == '') {
						$senior_education = $senior_education.'Syredelegering('.$member['oxygen'].')';
					} else {
						$senior_education = $senior_education.', Syredelegering('.$member['oxygen'].')';
					}
				}
				
				//Check if senior has done surfacerescue course and concat result to education string
				if($member['surfacerescue'] != 'not_done') {
					if($senior_education == '') {
						$senior_education = $senior_education.'Ytlivräddare('.$member['surfacerescue'].')';
					} else {
						$senior_education = $senior_education.', Ytlivräddare('.$member['surfacerescue'].')';
					}
				}
				
				//Check if senior has done chief course and concat result to education string
				if($member['chiefedu'] != 'not_done') {
					if($senior_education == '') {
						$senior_education = $senior_education.'Kårchef('.$member['chiefedu'].')';
					} else {
						$senior_education = $senior_education.', Kårchef('.$member['chiefedu'].')';
					}
				}				
				
				//Check if senior has done unitcommander course and concat result to education string
				if($member['unitcommander'] != 'not_done') {
					if($senior_education == '') {
						$senior_education = $senior_education.'Enhetschef('.$member['unitcommander'].')';
					} else {
						$senior_education = $senior_education.', Enhetschef('.$member['unitcommander'].')';
					}
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

				//Add other awards
				if($awards == '') {
					$awards = $awards.$member['otheraward'];
				} else {
					$awards = $awards.', '.$member['otheraward'];
				}				
				
				//Update member, set flag moved to true
				$qry = "UPDATE crew SET type='oldboy',oldboystarted='".clean(date("Y"))."',chief='no',assistantchief='no',activesmokediver='no',senioredusummary='".clean($senior_education)."',awardsummary='".clean($awards)."' WHERE crew_id='".clean($_POST['activeMemberSelect'])."'";
				$result = @mysql_query($qry) or die(mysql_error());
				
				//Set session variable, catch it in calling file to decide wether this script is successfull or not
				$_SESSION['SUBMIT_SUCCESS'] = true;
				unset($_SESSION['MEMBER_DATA']);
				session_write_close();
				ob_clean();
				header("location: move-to-oldboy.php");
				exit();
			}else { //<--This case shouldn't be able to happen
				$errmsg_arr[] = 'Fel lösenord för ditt användarkonto har angetts';
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				ob_clean();
				header("location:  move-to-oldboy.php");
				exit();
			}
		} else {
			die(mysql_error());
		}
	} else {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		ob_clean();
		header("location: move-to-oldboy.php");
		exit();		
	}
?>