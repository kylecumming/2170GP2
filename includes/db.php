<?php
	//Database connection script
	//Connecting to 2170db database
	//Username and Password will need to be modified to meet local setup
	$hostservername = "localhost:3307";
	$username = "root";
	$password = "root";
	$dbname = "jediDB";

	$mysqli = new mysqli($hostservername, $username, $password, $dbname);


	if($mysqli->connect_error)
	{
		die("Failed to connect to mysql: ($mysqli->connect_error) $mysqli->connect_error");
	} else {
    	echo "DB Connected! (Remove after development)";
    	//Connected statement can be un commented for debugging
	}
?>