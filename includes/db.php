<?php
	
	$hostservername = "localhost:3307";
	$username = "root";
	$password = "root";
	$dbname = "jedidb";//Change for out database

	$dbconnection = new mysqli($hostservername, $username, $password, $dbname);

	if ($dbconnection->connect_error){
		die("Git Wrecked Nurd<br>" . $dbconnection->connect_error);
	}
	else {
		//echo "<h1>Connected!</h1>";
	}

?>