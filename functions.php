<?php

	/**
	 * File.......: functions.php
	 * Author.....: Robert Nyholm
	 * Description: File containing some different supporting functions
	 * 				needed by the application
	 */

	//Run the authentication script
	require_once('auth.php');

	//Include database connection details
	require_once('config.php');
	
	/**
	 * Function to calculate the averag years members has been part of the department.
	 * This function specifically do ths calculation of members in jcrew table.
	 * @return integer avg_years  average years in department of members in jcrew
	 */
	function avg_years_as_members_jcrew() {
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
	
		//Query to get started information about a member
		$query = "SELECT started FROM crew WHERE active='true' AND type='junior'";
		$result = @mysql_query($query) or die(mysql_error());
	
		//Variable to store sum of all active senior members years as members of the department
		$avg_year = 0;
	
		//Loop through results from database
		while($row = mysql_fetch_array($result)) {
			$avg_year = $avg_year + (date("Y") - $row['started']);
		}
	
		//Calculate average years
		$avg_year = $avg_year/get_no_of_active_jmembers();
	
		return $avg_year;
	}	
	
	/**
	 * Function to calculate the averag years members has been part of the department.
	 * This function specifically do ths calculation of members in crew table.
	 * @return integer avg_years  average years in department of members in crew
	 */
	function avg_years_as_members_crew() {
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
		
		//Query to get started information about a member
		$query = "SELECT started FROM crew WHERE active='true' AND type='senior'";
		$result = @mysql_query($query) or die(mysql_error());
		
		//Variable to store sum of all active senior members years as members of the department
		$avg_year = 0;

		//Loop through results from database
		while($row = mysql_fetch_array($result)) {
			$avg_year = $avg_year + (date("Y") - $row['started']); 
		}
		
		//Calculate average years
		$avg_year = $avg_year/get_no_of_active_members();
		
		return $avg_year;
	}
	
	/**
	 * Function to calculate the averag years members has been part of the department.
	 * This function specifically do ths calculation of members in ocrew table.
	 * @return integer avg_years  average years in department of members in ocrew
	 */
	function avg_years_as_members_ocrew() {
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
	
		//Query to get started information about a member
		$query = "SELECT started FROM crew WHERE active='true' AND type='oldboy'";
		$result = @mysql_query($query) or die(mysql_error());
	
		//Variable to store sum of all active senior members years as members of the department
		$avg_year = 0;
	
		//Loop through results from database
		while($row = mysql_fetch_array($result)) {
			$avg_year = $avg_year + (date("Y") - $row['started']);
		}
	
		//Calculate average years
		$avg_year = $avg_year/get_no_of_active_omembers();
	
		return $avg_year;
	}
	
	/**
	 * Function to calculate average age of the junior members
	 * @return integer avg_age average age of members in junior department
	 */
	function avg_age_members_jcrew() {
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
	
		//Query to get dob information about a member
		$query = "SELECT dob FROM crew WHERE active='true' AND type='junior'";
		$result = @mysql_query($query) or die(mysql_error());
	
		//Variable to store average years in
		$avg_age = 0;
	
		//Loop through results from database
		while($row = mysql_fetch_array($result)) {
			$avg_age = $avg_age + calculate_age($row['dob']);
		}
	
		//Calculate average age
		$avg_age = $avg_age/get_no_of_active_jmembers();
	
		return $avg_age;
	}
	
	/**
	 * Function to calculate average age of the senior members
	 * @return integer avg_age average age of members in senior department
	 */
	function avg_age_members_crew() {
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
		
		//Query to get dob information about a member
		$query = "SELECT dob FROM crew WHERE active='true' AND type='senior'";
		$result = @mysql_query($query) or die(mysql_error());	

		//Variable to store average years in
		$avg_age = 0;
		
		//Loop through results from database
		while($row = mysql_fetch_array($result)) {
			$avg_age = $avg_age + calculate_age($row['dob']);
		}	

		//Calculate average age
		$avg_age = $avg_age/get_no_of_active_members();
		
		return $avg_age;
	}
	
	/**
	 * Function to calculate average age of the oldboy members
	 * @return integer avg_age average age of members in oldboy department
	 */
	function avg_age_members_ocrew() {
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
	
		//Query to get dob information about a member
		$query = "SELECT dob FROM crew WHERE active='true' AND type='oldboy'";
		$result = @mysql_query($query) or die(mysql_error());
	
		//Variable to store average years in
		$avg_age = 0;
	
		//Loop through results from database
		while($row = mysql_fetch_array($result)) {
			$avg_age = $avg_age + calculate_age($row['dob']);
		}
	
		//Calculate average age
		$avg_age = $avg_age/get_no_of_active_omembers();
	
		return $avg_age;
	}
	
	/**
	 * Function to sanitize values received from the form. Prevents SQL injection
	 * @param String string to be sanitized
	 * @return String sanitized string
	 */
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}

	/**
	 * Get age from dob
	 * @param dob string The dob to validate in mysql format (yyyy-mm-dd)
	 * @return integer The age in years as of the current date
	 */
	function calculate_age($dob) {
		//calculate years of age (input string: YYYY-MM-DD)
		list($year, $month, $day) = explode("-", $dob);

		//return $year.'-'.$month.'-'.$day;
		
		$year_diff  = date("Y") - $year;
		$month_diff = date("m") - $month;
		$day_diff   = date("d") - $day;

		//return $year_diff .'-'.$month_diff.'-'.$day_diff;
		
		if ($day_diff < 0 && $month_diff < 1) {
			$year_diff--;
		}

		return $year_diff;
		//return date("Y").'-'.date("m").'-'.date("d");
	}
	
	/**
	 * Function to get all information about all junior members
	 * @return array The query result
	 */
	function get_allnfo_jmember() {
		
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
		$query = "SELECT * FROM crew WHERE active='true' AND type='junior'"; 
		$result = @mysql_query($query) or die(mysql_error());
		
		return $result;
	}
	
	/**
	 * Function to get all information about all senior members
	 * @return array The query result
	 */
	function get_allnfo_member() {
		
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
		$query = "SELECT * FROM crew WHERE active='true' AND type='senior'"; 
		$result = @mysql_query($query) or die(mysql_error());
		
		return $result;
	}
	
	/**
	 * Function to get all information about all oldboy members
	 * @return array The query result
	 */
	function get_allnfo_omember() {
		
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
		$query = "SELECT * FROM crew WHERE active='true' AND type='oldboy'"; 
		$result = @mysql_query($query) or die(mysql_error());
		
		return $result;
	}
	
	/**
	 * Function to get all information about all active oldboy and seniormembers
	 * @return array The query result
	 */
	function get_allnfo_member_omember() {
	
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
		$query = "SELECT * FROM crew WHERE active='true' AND type='oldboy' OR active='true' AND type='senior'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return $result;
	}
	
	/**
	 * Function to get all information about board members(excluding kassör)
	 * @return array The query result
	 */
	function get_nfo_board_members() {
		
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
		
		$query = "SELECT type,firstname,lastname,phone,email,boardrole FROM crew WHERE active='true' AND board='yes' AND boardrole NOT LIKE '%ssör' UNION ALL SELECT type AS type,firstname AS firstname,lastname AS lastname,phone AS phone,email AS email,boardrole AS boardrole FROM extboardmembers WHERE boardrole NOT LIKE '%ssör'"; 
		$result = @mysql_query($query) or die(mysql_error());
		
		return $result;
	}
	
	/**
	 * Function to get all information about kassör members
	 * @return array The query result
	 */
	function get_nfo_kassor_members() {
	
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
	
		$query = "SELECT type,firstname,lastname,phone,email,boardrole FROM crew WHERE active='true' AND board='yes' AND boardrole LIKE '%ssör' UNION ALL SELECT type AS type,firstname AS firstname,lastname AS lastname,phone AS phone,email AS email,boardrole AS boardrole FROM extboardmembers WHERE boardrole LIKE '%ssör'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return $result;
	}	

	/**
	 * Function to get number of active junior members
	 * @return int Number of active junior members 
	 */
	 function get_no_of_active_jmembers() {
		
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
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='junior'"; 
		$result = @mysql_query($query) or die(mysql_error());
		
		//Variable to hold number of members
		$members = 0;
		
		//Loop through results from database to count members
		while($row = mysql_fetch_array($result)) {
			$members++;
		}
		
		return $members;
	}
	
	/**
	 * Function to get number of active senior members
	 * @return int Number of active senior members
	 */
	 function get_no_of_active_members() {
	 	
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
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior'"; 
		$result = @mysql_query($query) or die(mysql_error());
		
		//Variable to hold number of members
		$members = 0;
		
		//Loop through results from database to count members
		while($row = mysql_fetch_array($result)) {
			$members++;
		}
		
		return $members;
	}
	
	/**
	 * Function to get number of active oldboy members
	 * @return int Number of active oldboy members
	 */
	 function get_no_of_active_omembers() {
		
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
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='oldboy'"; 
		$result = @mysql_query($query) or die(mysql_error());
		
		//Variable to hold number of members
		$members = 0;
		
		//Loop through results from database to count members
		while($row = mysql_fetch_array($result)) {
			$members++;
		}
		
		return $members;
	}
	
	/**
	 * Function to get how many junior member that started any given year 0 = this year, 1 = this year-1 and so on
	 * @param Difference in years backwards from current year
	 * @return Number of junior members started any given year 0 = this year, 1 = this year-1 and so on
	 */
	function get_no_of_new_jmember($yeardiff) {
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
	
		//Calculate correct year to retrieve no of new members from
		$year = date('Y')-$yeardiff;
	
		//Query to get all information about a member
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='junior' AND juniorstarted='".$year."'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}	
	
	/**
	 * Function to get how many senior member that started any given year 0 = this year, 1 = this year-1 and so on
	 * @param Difference in years backwards from current year
	 * @return Number of senior members started any given year 0 = this year, 1 = this year-1 and so on
	 */
	function get_no_of_new_member($yeardiff) {
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
		
		//Calculate correct year to retrieve no of new members from
		$year = date('Y')-$yeardiff;
		
		//Query to get all information about a member
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND seniorstarted='".$year."'";
		$result = @mysql_query($query) or die(mysql_error());	

		return  mysql_num_rows($result);	
	}
	
	/**
	 * Function to get how many oldboy member that started any given year 0 = this year, 1 = this year-1 and so on
	 * @param Difference in years backwards from current year
	 * @return Number of senior members started any given year 0 = this year, 1 = this year-1 and so on
	 */
	function get_no_of_new_omember($yeardiff) {
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
	
		//Calculate correct year to retrieve no of new members from
		$year = date('Y')-$yeardiff;
	
		//Query to get all information about a member
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='oldboy' AND oldboystarted='".$year."'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}	
	
	/**
	 * Function to get number members that has been part juniordepartment
	 * @return Number of members that has been part of juniordepartment
	 */
	function get_no_of_ex_juniors() {
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
		
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND juniorstarted NOT LIKE ''";
		$result = @mysql_query($query) or die(mysql_error());
		
		return  mysql_num_rows($result);
	}
	
	/**
	 * Function to get number old members that has been part juniordepartment
	 * @return Number of old members that has been part of juniordepartment
	 */
	function get_no_of_old_ex_juniors() {
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
	
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='oldboy' AND juniorstarted NOT LIKE ''";
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}
	
	/**
	 * Function to get number old members that has been part seniordepartment
	 * @return Number of old members that has been part of seniosrdepartment
	 */
	function get_no_of_old_ex_seniors() {
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
	
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='oldboy' AND seniorstarted NOT LIKE ''";
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}	
	
	/**
	 * Function to get number of senior member that holds a specific drivers license
	 * @param Type of license to lookup
	 * @return Number of members that holds a specific kind of drivers license(type)
	 */
	function get_no_of_license($type) {
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
		
		if($type == 'ALL') {
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND driverslicense NOT LIKE ''";
		} else {
			//Query to get all information about a member
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND driverslicense LIKE '%$type%'";
		}
		
		$result = @mysql_query($query) or die(mysql_error());	

		return  mysql_num_rows($result);
	}
	
	/**
	 * Function to return number of members that went through extman course on a specific year, or all members that went through ext course
	 * @param Search parameter, year, search and return number of members that went through the extman course on this year, or all to get all
	 * @return Number of members that went through the extman course on a given year, or all members that went through this course
	 */
	function get_no_of_extmen($param) {
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
		
		if($param == "ALL") { //Get all members that has went through course
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND extman NOT LIKE 'not_done'";			
		} else { //Get all members that has went through the course on year, this year - $param
			$year = date('Y')-$param;
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND extman='$year'";
		}
		
		$result = @mysql_query($query) or die(mysql_error());
		
		return  mysql_num_rows($result);		
	}
	
	/**
	 * Function to return number of members that went through rescman course on a specific year, or all members that went through resc course
	 * @param Search parameter, year, search and return number of members that went through the rescman course on this year, or all to get all
	 * @return Number of members that went through the rescman course on a given year, or all members that went through this course
	 */
	function get_no_of_rescmen($param) {
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
	
		if($param == "ALL") { //Get all members that has went through course
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND rescman NOT LIKE 'not_done'";
		} else { //Get all members that has went through the course on year, this year - $param
			$year = date('Y')-$param;
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND rescman='$year'";
		}
	
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}
	
	/**
	 * Function to return number of members that went through smokediver course on a specific year, or all members that went through smokediver course
	 * @param Search parameter, year, search and return number of members that went through the smokediver course on this year, or all to get all
	 * @return Number of members that went through the smokediver course on a given year, or all members that went through this course
	 */
	function get_no_of_smokemen($param) {
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
	
		if($param == "ALL") { //Get all members that has went through course
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND smokediver NOT LIKE 'not_done'";
		} else { //Get all members that has went through the course on year, this year - $param
			$year = date('Y')-$param;
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND smokediver='$year'";
		}
	
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}
	
	/**
	 * Function to return number of members that went through basic fire fighting course on a specific year, or all members that went through basic fire fighting course
	 * @param Search parameter, year, search and return number of members that went through the basic fire fighting course on this year, or all to get all
	 * @return Number of members that went through the basic fire fighting course on a given year, or all members that went through this course
	 */
	function get_no_of_basicff($param) {
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
	
		if($param == "ALL") { //Get all members that has went through course
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND basicff NOT LIKE 'not_done'";
		} else { //Get all members that has went through the course on year, this year - $param
			$year = date('Y')-$param;
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND basicff='$year'";
		}
	
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}	
	
	/**
	 * Function to return number of members that went through highwork course on a specific year, or all members that went through highwork course
	 * @param Search parameter, year, search and return number of members that went through the highwork course on this year, or all to get all
	 * @return Number of members that went through the highwork course on a given year, or all members that went through this course
	 */
	function get_no_of_highwork($param) {
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
	
		if($param == "ALL") { //Get all members that has went through course
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND highwork NOT LIKE 'not_done'";
		} else { //Get all members that has went through the course on year, this year - $param
			$year = date('Y')-$param;
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND highwork='$year'";
		}
	
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}
	
	/**
	 * Function to return number of members that went through surfacerescue course on a specific year, or all members that went through surfacerescue course
	 * @param Search parameter, year, search and return number of members that went through the surfacerescue course on this year, or all to get all
	 * @return Number of members that went through the surfacerescue course on a given year, or all members that went through this course
	 */
	function get_no_of_surfacerescue($param) {
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
	
		if($param == "ALL") { //Get all members that has went through course
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND surfacerescue NOT LIKE 'not_done'";
		} else { //Get all members that has went through the course on year, this year - $param
			$year = date('Y')-$param;
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND surfacerescue='$year'";
		}
	
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}
	
	/**
	 * Function to return number of members that went through firstaid course on a specific year, or all members that went through firstaid course
	 * @param Search parameter, year, search and return number of members that went through the firstaid course on this year, or all to get all
	 * @return Number of members that went through the firstaid course on a given year, or all members that went through this course
	 */
	function get_no_of_firstaid($param) {
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
	
		if($param == "ALL") { //Get all members that has went through course
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND firstaid NOT LIKE 'not_done'";
		} else { //Get all members that has went through the course on year, this year - $param
			$year = date('Y')-$param;
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND firstaid='$year'";
		}
	
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}
	
	/**
	 * Function to return number of members that went through oxygen course on a specific year, or all members that went through oxygen course
	 * @param Search parameter, year, search and return number of members that went through the oxygen course on this year, or all to get all
	 * @return Number of members that went through the oxygen course on a given year, or all members that went through this course
	 */
	function get_no_of_oxygen($param) {
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
	
		if($param == "ALL") { //Get all members that has went through course
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND oxygen NOT LIKE 'not_done'";
		} else { //Get all members that has went through the course on year, this year - $param
			$year = date('Y')-$param;
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND oxygen='$year'";
		}
	
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}
	
	/**
	 * Function to return number of members that went through chief course on a specific year, or all members that went through chief course
	 * @param Search parameter, year, search and return number of members that went through the chief course on this year, or all to get all
	 * @return Number of members that went through the chief course on a given year, or all members that went through this course
	 */
	function get_no_of_chief($param) {
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
	
		if($param == "ALL") { //Get all members that has went through course
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND chiefedu NOT LIKE 'not_done'";
		} else { //Get all members that has went through the course on year, this year - $param
			$year = date('Y')-$param;
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND chiefedu='$year'";
		}
	
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}	
	
	/**
	 * Function to return number of members that went through unitcommander course on a specific year, or all members that went through unitcommander course
	 * @param Search parameter, year, search and return number of members that went through the unitcommander course on this year, or all to get all
	 * @return Number of members that went through the unitcommander course on a given year, or all members that went through this course
	 */
	function get_no_of_unitcommander($param) {
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
	
		if($param == "ALL") { //Get all members that has went through course
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND unitcommander NOT LIKE 'not_done'";
		} else { //Get all members that has went through the course on year, this year - $param
			$year = date('Y')-$param;
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND unitcommander='$year'";
		}
	
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}
	
	/**
	 * Function to return number of members that has any other education
	 * @return Number of members that has any other education
	 */
	function get_no_of_othereducation() {
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
	
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND othereducation NOT LIKE ''";
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}
	
	/**
	 * Function to return number of members that has any junior education
	 * @return Number of members that has any junior education
	 */
	function get_no_of_junioreducation() {
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
	
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND junioredusummary NOT LIKE ''";
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}
	
	/**
	 * Function to return number of members that has been a member of any other firebrigade
	 * @return Number of members that has been a member of any other fire brigade
	 */
	function get_no_of_otherfiredept() {
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
	
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND otherfiredept NOT LIKE ''";
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}
	
	/**
	 * Function to return number of oldmembers that has been a member of any other firebrigade
	 * @return Number of members that has been a member of any other fire brigade
	 */
	function get_no_of_old_otherfiredept() {
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
	
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='oldboy' AND otherfiredept NOT LIKE ''";
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}	
	
	/**
	 * Function to get name of chief
	 * @return Name of chief
	 */
	function get_chief_name() {
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
		
		$query = "SELECT firstname,lastname FROM crew WHERE active='true' AND type='senior' AND chief='yes'";
		$result = @mysql_query($query) or die(mysql_error());
		
		//In case no chief exsists
		$name = "Kan ej hitta någon kårchef i registret!";
		
		//Loop through results from database
		while($row = mysql_fetch_array($result)) {
			$name = $row['firstname'].' '.$row['lastname'];
		}
		
		return $name;
	}
	
	/**
	 * Function to get name of the assistant chief
	 * @return Name of the assistant chief
	 */
	function get_assistant_chief_name() {
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
	
		$query = "SELECT firstname,lastname FROM crew WHERE active='true' AND type='senior' AND assistantchief='yes'";
		$result = @mysql_query($query) or die(mysql_error());
		
		//In case no chief exsists
		$name = "Kan ej hitta någon biträdande kårchef i registret!";
	
		//Loop through results from database
		while($row = mysql_fetch_array($result)) {
			$name = $row['firstname'].' '.$row['lastname'];
		}
	
		return $name;
	}
	
	/**
	 * Function to get the number of seniormembers that's a board member
	 * @return Number of senior members in board
	 */
	function get_no_of_members_in_board() {
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
		
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND board='yes'";
		$result = @mysql_query($query) or die(mysql_error());	
		
		return  mysql_num_rows($result);
	}
	
	/**
	 * Function to get the number of oldmembers that's a board member
	 * @return Number of old members in board
	 */
	function get_no_of_omembers_in_board() {
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
	
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='oldboy' AND board='yes'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}	
	
	function get_no_of_active_qualified_smokedivers() {
		//Get info from database
		$result = get_allnfo_member();
		
		//Variable to keep track of qualified smokedivers
		$i = 0;
		
		//Loop through each row fetched from db query and populate table
		while($row = mysql_fetch_array($result)) {
			//Check if member has passed any smokediving course
			if($row['smokediver'] != 'not_done' || $row['basicff'] != 'not_done') {
				//Check if they're active as smokedivers
				if($row['activesmokediver'] == 'yes') {
					//Check if member has done the tests
					if($row['uleborgtest'] != 'not_done' && $row['belastnekg'] != 'not_done') {
						//Check if tests has been done with positive results
						if($row['uleborgresult'] == 'passed' && $row['belastnekgresult'] == 'passed') {
							//Check if test has been performed latest the last year
							if(($row['uleborgtest'] > (date('Y')-2))) {
								$i++;
							}
						}
					}
				}	
			}			
		}
		
		return  $i++;		
	}
	
	function get_no_of_smokedivers_need_uleborgtest() {
		//Get info from database
		$result = get_allnfo_member();
	
		//Variable to keep track of qualified smokedivers
		$i = 0;
	
		//Loop through each row fetched from db query and populate table
		while($row = mysql_fetch_array($result)) {
			//Check if member has passed any smokediving course
			if($row['smokediver'] != 'not_done' || $row['basicff'] != 'not_done') {
				//Check if they're active as smokedivers
				if($row['activesmokediver'] == 'yes') {
					//Check if member has not passed or has done uleborgtest too long ago
					if($row['uleborgtest'] == 'not_done' || ($row['uleborgtest'] < (date('Y')-1)) || $row['uleborgresult'] == 'failed') {
						$i++;
					}
				}
			}
		}
	
		return  $i++;
	}
	
	function get_no_of_smokediver_educated() {
		//Get info from database
		$result = get_allnfo_member();
	
		//Variable to keep track of qualified smokedivers
		$i = 0;
	
		//Loop through each row fetched from db query and populate table
		while($row = mysql_fetch_array($result)) {
			//Check if member has passed any smokediving course
			if($row['smokediver'] != 'not_done' || $row['basicff'] != 'not_done') {
				$i++;
			}
		}
	
		return  $i++;
	}
	
	function get_no_of_smokedivers_need_belastnekg() {
		//Get info from database
		$result = get_allnfo_member();
	
		//Variable to keep track of qualified smokedivers
		$i = 0;
	
		//Loop through each row fetched from db query and populate table
		while($row = mysql_fetch_array($result)) {
			//Check if member has passed any smokediving course
			if($row['smokediver'] != 'not_done' || $row['basicff'] != 'not_done') {
				//Check if they're active as smokedivers
				if($row['activesmokediver'] == 'yes') {
					//Check if member has not passed or has done uleborgtest too long ago
					if($row['belastnekg'] == 'not_done' || $row['belastnekgresult'] == 'failed') {
						$i++;
					}
				}
			}
		}
	
		return  $i++;
	}
	
	/**
	 * Function to get the number of seniormembers with a assignment in trust
	 * @return Number of senior members with an assignment in trust
	 */
	function get_no_of_members_with_assignmentintrust() {
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
	
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND assignmentintrust NOT LIKE ''";
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}
	
	/**
	 * Function to get the number of oldmembers with a assignment in trust
	 * @return Number of old members with an assignment in trust
	 */
	function get_no_of_omembers_with_assignmentintrust() {
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
	
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='oldboy' AND assignmentintrust NOT LIKE ''";
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}	
	
	/**
	 * Function to get number of members that's been assigned a five year pin
	 * @return Number of members that's achieved a five year pin
	 */
	function get_no_of_members_fiveyearpin() {
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
		
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND fiveyearpin NOT LIKE 'not_assigned'";
		$result = @mysql_query($query) or die(mysql_error());
		
		return  mysql_num_rows($result);
	}
	
	/**
	 * Function to get number of old members that's been assigned a five year pin
	 * @return Number of members that's achieved a five year pin
	 */
	function get_no_of_old_members_fiveyearpin() {
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
	
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='oldboy' AND fiveyearpin NOT LIKE 'not_assigned'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}	
	
	/**
	 * Function to get number of members that's been assigned a ten year pin
	 * @return Number of members that's achieved a five ten pin
	 */
	function get_no_of_members_tenyearpin() {
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
	
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND tenyearpin NOT LIKE 'not_assigned'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}
	
	/**
	 * Function to get number of old members that's been assigned a ten year pin
	 * @return Number of members that's achieved a five ten pin
	 */
	function get_no_of_old_members_tenyearpin() {
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
	
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='oldboy' AND tenyearpin NOT LIKE 'not_assigned'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}	
	
	/**
	 * Function to get number of members that's been assigned a twenty year pin
	 * @return Number of members that's achieved a twenty year pin
	 */
	function get_no_of_members_twentyyearpin() {
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
	
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND twentyyearpin NOT LIKE 'not_assigned'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}
	
	/**
	 * Function to get number of old members that's been assigned a twenty year pin
	 * @return Number of members that's achieved a twenty year pin
	 */
	function get_no_of_old_members_twentyyearpin() {
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
	
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='oldboy' AND twentyyearpin NOT LIKE 'not_assigned'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}	
	
	/**
	 * Function to get number of members that's been assigned a thirty year pin
	 * @return Number of members that's achieved a thirty year pin
	 */
	function get_no_of_members_thirtyyearpin() {
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
	
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND thirtyyearpin NOT LIKE 'not_assigned'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}

	/**
	 * Function to get number of old members that's been assigned a thirty year pin
	 * @return Number of members that's achieved a thirty year pin
	 */
	function get_no_of_old_members_thirtyyearpin() {
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
	
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='oldboy' AND thirtyyearpin NOT LIKE 'not_assigned'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}	
	
	/**
	 * Function to get number of members that's been assigned a special pin
	 * @return Number of members that's achieved a special pin
	 */
	function get_no_of_members_specialpin() {
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
	
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND specialpin NOT LIKE 'not_assigned'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}
	
	/**
	 * Function to get number of old members that's been assigned a special pin
	 * @return Number of members that's achieved a special pin
	 */
	function get_no_of_old_members_specialpin() {
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
	
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='oldboy' AND specialpin NOT LIKE 'not_assigned'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}	
	
	/**
	 * Function to get number of members that's been assigned any other award
	 * 
	 * @return Number of members that's achieved any other award
	 */
	function get_no_of_members_otheraward() {
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
	
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='senior' AND otheraward NOT LIKE ''";
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}
	
	/**
	 * Function to get number of old members that's been assigned any other award
	 *
	 * @return Number of members that's achieved any other award
	 */
	function get_no_of_old_members_otheraward() {
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
	
		$query = "SELECT crew_id FROM crew WHERE active='true' AND type='oldboy' AND otheraward NOT LIKE ''";
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}	
	
	/**
	 * Function to return number of members that went through beginner course on a specific year, or all members that went through beginner course
	 * @param Search parameter, year, search and return number of members that went through the beginner course on this year, or all to get all
	 * @return Number of members that went through the beginner course on a given year, or all members that went through this course
	 */
	function get_no_of_beginner($param) {
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
	
		if($param == "ALL") { //Get all members that has went through course
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='junior' AND beginner NOT LIKE 'not_done'";
		} else { //Get all members that has went through the course on year, this year - $param
			$year = date('Y')-$param;
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='junior' AND beginner='$year'";
		}
	
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}

	/**
	 * Function to return number of members that went through level1 course on a specific year, or all members that went through level1 course
	 * @param Search parameter, year, search and return number of members that went through the level1 course on this year, or all to get all
	 * @return Number of members that went through the level1 course on a given year, or all members that went through this course
	 */
	function get_no_of_lvlone($param) {
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
	
		if($param == "ALL") { //Get all members that has went through course
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='junior' AND lvlone NOT LIKE 'not_done'";
		} else { //Get all members that has went through the course on year, this year - $param
			$year = date('Y')-$param;
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='junior' AND lvlone='$year'";
		}
	
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}

	/**
	 * Function to return number of members that went through level2 course on a specific year, or all members that went through level2 course
	 * @param Search parameter, year, search and return number of members that went through the level2 course on this year, or all to get all
	 * @return Number of members that went through the level2 course on a given year, or all members that went through this course
	 */
	function get_no_of_lvltwo($param) {
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
	
		if($param == "ALL") { //Get all members that has went through course
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='junior' AND lvltwo NOT LIKE 'not_done'";
		} else { //Get all members that has went through the course on year, this year - $param
			$year = date('Y')-$param;
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='junior' AND lvltwo='$year'";
		}
	
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}	
	
	/**
	 * Function to return number of members that went through level3 course on a specific year, or all members that went through level3 course
	 * @param Search parameter, year, search and return number of members that went through the level3 course on this year, or all to get all
	 * @return Number of members that went through the level3 course on a given year, or all members that went through this course
	 */
	function get_no_of_lvlthree($param) {
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
	
		if($param == "ALL") { //Get all members that has went through course
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='junior' AND lvlthree NOT LIKE 'not_done'";
		} else { //Get all members that has went through the course on year, this year - $param
			$year = date('Y')-$param;
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='junior' AND lvlthree='$year'";
		}
	
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}	
	
	/**
	 * Function to return number of members that went through level4 course on a specific year, or all members that went through level4 course
	 * @param Search parameter, year, search and return number of members that went through the level4 course on this year, or all to get all
	 * @return Number of members that went through the level4 course on a given year, or all members that went through this course
	 */
	function get_no_of_lvlfour($param) {
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
	
		if($param == "ALL") { //Get all members that has went through course
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='junior' AND lvlfour NOT LIKE 'not_done'";
		} else { //Get all members that has went through the course on year, this year - $param
			$year = date('Y')-$param;
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='junior' AND lvlfour='$year'";
		}
	
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}

	/**
	 * Function to return number of members that went through jununitcommander course on a specific year, or all members that went through jununitcommander course
	 * @param Search parameter, year, search and return number of members that went through the jununitcommandercourse on this year, or all to get all
	 * @return Number of members that went through the jununitcommander course on a given year, or all members that went through this course
	 */
	function get_no_of_jununitcommander($param) {
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
	
		if($param == "ALL") { //Get all members that has went through course
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='junior' AND jununitcommander NOT LIKE 'not_done'";
		} else { //Get all members that has went through the course on year, this year - $param
			$year = date('Y')-$param;
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='junior' AND jununitcommander='$year'";
		}
	
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}	
	
	/**
	 * Function to return number of members that went through education course on a specific year, or all members that went through education course
	 * @param Search parameter, year, search and return number of members that went through the education course on this year, or all to get all
	 * @return Number of members that went through the education course on a given year, or all members that went through this course
	 */
	function get_no_of_education($param) {
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
	
		if($param == "ALL") { //Get all members that has went through course
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='junior' AND education NOT LIKE 'not_done'";
		} else { //Get all members that has went through the course on year, this year - $param
			$year = date('Y')-$param;
			$query = "SELECT crew_id FROM crew WHERE active='true' AND type='junior' AND education='$year'";
		}
	
		$result = @mysql_query($query) or die(mysql_error());
	
		return  mysql_num_rows($result);
	}	
	
	/**
	 * Function to get all information about members who passed extmen course
	 * @return array The query result
	 */
	function get_nfo_extmen_members() {
	
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
	
		$query = "SELECT * FROM crew WHERE active='true' AND type='senior' AND extman NOT LIKE 'not_done'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return $result;
	}	
	
	/**
	 * Function to get all information about members who passed rescueman course
	 * @return array The query result
	 */
	function get_nfo_rescmen_members() {
	
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
	
		$query = "SELECT * FROM crew WHERE active='true' AND type='senior' AND rescman NOT LIKE 'not_done'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return $result;
	}	
	
	/**
	 * Function to get all information about members who passed smokediver course
	 * @return array The query result
	 */
	function get_nfo_smokemen_members() {
	
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
	
		$query = "SELECT * FROM crew WHERE active='true' AND type='senior' AND smokediver NOT LIKE 'not_done'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return $result;
	}	
	
	/**
	 * Function to get all information about members who passed basic fire fighting course
	 * @return array The query result
	 */
	function get_nfo_basicff_members() {
	
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
	
		$query = "SELECT * FROM crew WHERE active='true' AND type='senior' AND basicff NOT LIKE 'not_done'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return $result;
	}	
	
	/**
	 * Function to get all information about members who passed highwork course
	 * @return array The query result
	 */
	function get_nfo_highwork_members() {
	
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
	
		$query = "SELECT * FROM crew WHERE active='true' AND type='senior' AND highwork NOT LIKE 'not_done'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return $result;
	}	
	
	/**
	 * Function to get all information about members who passed firstaid course
	 * @return array The query result
	 */
	function get_nfo_firstaid_members() {
	
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
	
		$query = "SELECT * FROM crew WHERE active='true' AND type='senior' AND firstaid NOT LIKE 'not_done'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return $result;
	}

	/**
	 * Function to get all information about members who passed oxygen course
	 * @return array The query result
	 */
	function get_nfo_oxygen_members() {
	
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
	
		$query = "SELECT * FROM crew WHERE active='true' AND type='senior' AND oxygen NOT LIKE 'not_done'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return $result;
	}	
	
	/**
	 * Function to get all information about members who passed surfacerescue course
	 * @return array The query result
	 */
	function get_nfo_surfacerescue_members() {
	
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
	
		$query = "SELECT * FROM crew WHERE active='true' AND type='senior' AND surfacerescue NOT LIKE 'not_done'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return $result;
	}	
	
	/**
	 * Function to get all information about members who passed chief course
	 * @return array The query result
	 */
	function get_nfo_chiefedu_members() {
	
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
	
		$query = "SELECT * FROM crew WHERE active='true' AND type='senior' AND chiefedu NOT LIKE 'not_done'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return $result;
	}	
	
	/**
	 * Function to get all information about members who passed unitcommander course
	 * @return array The query result
	 */
	function get_nfo_unitcommander_members() {
	
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
	
		$query = "SELECT * FROM crew WHERE active='true' AND type='senior' AND unitcommander NOT LIKE 'not_done'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return $result;
	}	
	
	/**
	 * Function to get all information about members who passed any other courses
	 * @return array The query result
	 */
	function get_nfo_otheredu_members() {
	
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
	
		$query = "SELECT * FROM crew WHERE active='true' AND type='senior' AND othereducation NOT LIKE ''";
		$result = @mysql_query($query) or die(mysql_error());
	
		return $result;
	}	
	
	/**
	 * Function to get all information about members who passed any junior courses
	 * @return array The query result
	 */
	function get_nfo_junioredu_members() {
	
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
	
		$query = "SELECT * FROM crew WHERE active='true' AND type='senior' AND junioredusummary NOT LIKE ''";
		$result = @mysql_query($query) or die(mysql_error());
	
		return $result;
	}	
	
	/**
	 * Function to get number of senior member that holds a specific drivers license
	 * @param Type of license to lookup
	 * @return Number of members that holds a specific kind of drivers license(type)
	 */
	function get_nfo_of_license($type) {
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
	
		if($type == 'ALL') {
			$query = "SELECT * FROM crew WHERE active='true' AND type='senior' AND driverslicense NOT LIKE ''";
		} else {
			//Query to get all information about a member
			$query = "SELECT * FROM crew WHERE active='true' AND type='senior' AND driverslicense LIKE '%$type%'";
		}
	
		$result = @mysql_query($query) or die(mysql_error());
	
		return  $result;
	}	
	
	/**
	 * Function to get all information about junior members who passed the beginner course
	 * @return array The query result
	 */
	function get_nfo_beginner_jmembers() {
	
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
	
		$query = "SELECT * FROM crew WHERE active='true' AND type='junior' AND beginner NOT LIKE 'not_done'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return $result;
	}	
	
	/**
	 * Function to get all information about junior members who passed the lvlone course
	 * @return array The query result
	 */
	function get_nfo_lvlone_jmembers() {
	
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
	
		$query = "SELECT * FROM crew WHERE active='true' AND type='junior' AND lvlone NOT LIKE 'not_done'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return $result;
	}	
	
	/**
	 * Function to get all information about junior members who passed the lvltwo course
	 * @return array The query result
	 */
	function get_nfo_lvltwo_jmembers() {
	
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
	
		$query = "SELECT * FROM crew WHERE active='true' AND type='junior' AND lvltwo NOT LIKE 'not_done'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return $result;
	}	
	
	/**
	 * Function to get all information about junior members who passed the lvlthree course
	 * @return array The query result
	 */
	function get_nfo_lvlthree_jmembers() {
	
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
	
		$query = "SELECT * FROM crew WHERE active='true' AND type='junior' AND lvlthree NOT LIKE 'not_done'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return $result;
	}	
	
	/**
	 * Function to get all information about junior members who passed the lvlfour course
	 * @return array The query result
	 */
	function get_nfo_lvlfour_jmembers() {
	
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
	
		$query = "SELECT * FROM crew WHERE active='true' AND type='junior' AND lvlfour NOT LIKE 'not_done'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return $result;
	}	
	
	/**
	 * Function to get all information about junior members who passed the jununitcommander course
	 * @return array The query result
	 */
	function get_nfo_jununitcommander_jmembers() {
	
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
	
		$query = "SELECT * FROM crew WHERE active='true' AND type='junior' AND jununitcommander NOT LIKE 'not_done'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return $result;
	}

	/**
	 * Function to get all information about junior members who passed the education course
	 * @return array The query result
	 */
	function get_nfo_education_jmembers() {
	
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
	
		$query = "SELECT * FROM crew WHERE active='true' AND type='junior' AND education NOT LIKE 'not_done'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return $result;
	}	
	
	/**
	 * Function to get all information about members who has any assignment in trust
	 * @return array The query result
	 */
	function get_nfo_assignmentintrust_members() {
	
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
	
		$query = "SELECT * FROM crew WHERE active='true' AND type='senior' AND assignmentintrust NOT LIKE ''";
		$result = @mysql_query($query) or die(mysql_error());
	
		return $result;
	}
	
	/**
	 * Function to get all information about oldboy members who has any assignment in trust
	 * @return array The query result
	 */
	function get_nfo_assignmentintrust_omembers() {
	
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
	
		$query = "SELECT * FROM crew WHERE active='true' AND type='oldboy' AND assignmentintrust NOT LIKE ''";
		$result = @mysql_query($query) or die(mysql_error());
	
		return $result;
	}
	
	/**
	 * Function to get all information about chief and assistantchief members
	 * @return array The query result
	 */
	function get_nfo_chief_assistantchief_omembers() {
	
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
	
		$query = "SELECT * FROM crew WHERE active='true' AND type='senior' AND chief LIKE 'yes' OR active='true' AND type='senior' AND assistantchief LIKE 'yes'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return $result;
	}	
	
	/**
	 * Function to return all information of members that has been a member of any other firebrigade
	 * @return array The query result
	 */
	function get_nfo_of_otherfiredept() {
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
	
		$query = "SELECT * FROM crew WHERE active='true' AND type='senior' AND otherfiredept NOT LIKE ''";
		$result = @mysql_query($query) or die(mysql_error());
	
		return  $result;
	}	
	
	/**
	 * Function to return all information of oldmembers that has been a member of any other firebrigade
	 * @return array The query result
	 */
	function get_nfo_of_old_otherfiredept() {
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
	
		$query = "SELECT * FROM crew WHERE active='true' AND type='oldboy' AND otherfiredept NOT LIKE ''";
		$result = @mysql_query($query) or die(mysql_error());
	
		return  $result;
	}	
	
	/**
	 * Function to get all information about members who passed smokediver or basicff course and are active smokediver
	 * @return array The query result
	 */
	function get_nfo_all_active_smokemen_members() {
	
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
	
		$query = "SELECT * FROM crew WHERE active='true' AND type='senior' AND activesmokediver='yes' AND smokediver NOT LIKE 'not_done' OR active='true' AND type='senior' AND activesmokediver='yes' AND basicff NOT LIKE 'not_done'";
		$result = @mysql_query($query) or die(mysql_error());
	
		return $result;
	}	
?>