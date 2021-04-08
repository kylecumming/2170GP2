<?php
	//Database connection script
	//Connecting to 2170db database
	//Username and Password will need to be modified to meet local setup
	$hostservername = "db.cs.dal.ca";
    $username = "cumming";
    $password = "r25iTVnLv8FNKazUydDUTucrE";
    $dbname = "cumming";


	$mysqli = new mysqli($hostservername, $username, $password, $dbname);


	if($mysqli->connect_error)
	{
		die("Failed to connect to mysql: ($mysqli->connect_error) $mysqli->connect_error");
	} else {
    	//echo "DB Connected! (Remove after development)";
    	//Connected statement can be un commented for debugging
	}
?>