<?php
	//Process the submitted blog post here.
	
	//SANITIZE DATA BEFORE SUBMISSION TO JEDIBLOG
	

	require_once "header.php";

	
	$postContent = $_REQUEST['blog'];

	//$_SESSION["submitted"] = 0;

	$content = htmlspecialchars(stripslashes(trim($postContent)));
	//$date = date("Y-m-d");

    $username = $_SESSION['username'];
	$userID = $_SESSION["userID"];

	$user_query = "INSERT INTO posts (post_id, post, user_id, username) VALUES (NULL, '$content', '$userID', '$username')";
	

	$results = $mysqli->query($user_query);

	

	if($results === true){
		$_SESSION["submitted"] = 1;
        //echo "<br><h1>SUBMITTED</h1>";
	}
	else{
		die("The Blog did not post.");
	}

	header("location: ../index.php");
	
	require_once "footer.php";
?>