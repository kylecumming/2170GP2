<?php
	//Process the submitted blog post here.
	
	//SANITIZE DATA BEFORE SUBMISSION TO JEDIBLOG
	

	require_once "header.php";

	
	$postContent = $_REQUEST['blog'];

	//$_SESSION["submitted"] = 0;

	$content = htmlspecialchars(stripslashes(trim($postContent)));
	//$date = date("Y-m-d");

    $username = "dowell";//$_SESSION['username'];
	$userID = "1";//$_SESSION["userID"] ;

	$querySQL = "INSERT INTO posts (post_id, post, user_id, username) VALUES (NULL, '$content', '$userID', '$username')";
	
    echo "<br>";
    echo $content;
    echo "<br>";
    echo $username;
    echo "<br>";
    echo $userID;
    echo "<br>";
    echo $querySQL;
    
    echo "<br>";
    echo "<br>";

	$result = mysqli_query($mysqli, $querySQL); 
	echo $mysqli ->error;
	

	if($result === true){
		$_SESSION["submitted"] = 1;
        echo "<br><h1>SUBMITTED</h1>";
	}
	else{
		die("The Blog did not post.");
	}

	//header("location: ../index.php");
	
	require_once "footer.php";
?>