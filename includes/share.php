<?php
    session_start();
    if (!isset($_GET["postshare"]) || !isset($_GET["profile"])){
        header("location: ../index.php");
        die();
    }
    if(!isset($_SESSION["userID"])){
        header("location: ../login.php");
        die();
    }
    require_once "db.php";
    $user_query = "INSERT INTO `shares` (user_id, post_id) VALUES (".$_SESSION["userID"].", ".$_GET["postshare"].")";
    $results = $mysqli->query($user_query);
    header("location: ../profile.php?clickedUser=".$_GET["profile"]);
    die();

?>