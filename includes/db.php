<?php
	//Database connection script
	//Connecting to 2170db database
	//Username and Password will need to be modified to meet local setup
	$hostservername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "jediDB";

	$mysqli = new mysqli($hostservername, $username, $password, $dbname);

	if($mysqli->errno)
	{
		die("Failed to connect to mysql: ($mysqli->connect_errno) $mysqli->errno");
	} else {
    	echo "DB Connected! (Remove after development)";
    	//Connected statement can be un commented for debugging
	}
?>