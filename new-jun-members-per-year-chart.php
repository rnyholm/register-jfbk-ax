<?php
	require_once('auth.php');
	require_once('functions.php');
	require_once('populate-list.php');	
	
	/**
	 * Retrieve data from database to fill in diagram
	 */

	//Include database connection details
	require_once('config.php');
	
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
	
	//Set year to ten years back from current year
	$year = date("Y") - 10;
	//Variable to count number of members per year
	$members = 0;
	
	//Loop from ten years back to this year
	for($i=0; $i<11; $i++) {
		//Query to get all information about a member
		$query = "SELECT crew_id FROM crew WHERE juniorstarted='".clean($year)."'";
		$result = @mysql_query($query) or die(mysql_error());
		
		//Loop through results from database to count members
		while($row = mysql_fetch_array($result)) {
			//Count members
			$members++;
		}
		
		//Store number of members in array
		$members_arr[$i] = $members;
		//Reset member counter
		$members = 0;
		//Increase year variable
		$year++;
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Jomala FBK - Ungdomsavdelningen - Översikt Medlemstillväxt</title>
		<!--Hack to force internet explorer to show page as ie7 browser-->
		<meta http-equiv="X-UA-Compatible" content="IE=7"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/main.css" rel="stylesheet" type="text/css" />
		<link rel="icon" type="image/x-icon" href="css/images/icon.ico" />
		
	    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
	    <script type="text/javascript">
	      google.load("visualization", "1", {packages:["corechart"]});
	      google.setOnLoadCallback(drawChart);
	      function drawChart() {	
			var data = google.visualization.arrayToDataTable([
				['År', 'Nya medlemmar'],
				<?php
					$year = date("Y") - 10;
					for($i=0; $i<11; $i++) {
						if($i<10) {
							echo("['"); echo($year); echo("', "); echo($members_arr[$i]); echo("],\n");
						} else {
							echo("['"); echo($year); echo("', "); echo($members_arr[$i]); echo("]\n");
						}
						
						$year++;
					}
				?>
			]);
	
	        var options = {
				title: 'Ungdomsavdelningens medlemstillväxt (10 år)',
				colors:['#F07B78','#F07B78'],
				titleTextStyle:{fontName: '"Trebuchet MS"'},
				tooltipTextStyle:{fontName: '"Arial"'},
				chartArea:{left:100,top:50,height:'60%'}
	        };
	
	        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
	        chart.draw(data, options);
	      }
	    </script>
		
	</head>
	
	<body>
		<div id="chart_div" style="width: 850px; height: 400px;"></div>
		<?php include('chart-footer.php'); ?>
	</body>
</html>