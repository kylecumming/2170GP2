<?php

/*
    * Feature: As a micro blog author I want to see a list of the authors that I follow
    * Developed By: Jake Coyne; B00775132; jc910209@dal.ca
    * This page loads who a user is following based off the user selected in our GET variable
    * This page first finds all the user id's in the following db table
    * Then displays there user names through the users db table
    *
*/

require_once "includes/header.php"
?>
<main class="container following-main">
    <h1>Following</h1>
    <?php

    //checking that the user is set in GET Variable
    //if not set then redirect to home page with no access message
    if (!isset($_GET["user"])) {
        header("Location: index.php?no-access=1");
        die();
    }

    //setting a variable for user id
    $uid = $_GET["user"];


//creating sql query to find all the users $uid is following
    $query = "SELECT `followed_user_id` 
              FROM `following` 
              WHERE `user_id` = {$uid}";
    $result = $mysqli->query($query);
    if ($result) {

        //printing line seperator
        echo "<hr>";

        //loops for each row found in following table
        while ($row = $result->fetch_assoc()) {

              //creating sql query to get the username information 
            //based off the user id found in the previous query

            $queryUsernames = "SELECT `username` 
                               FROM `users` 
                               WHERE `user_id` = {$row['followed_user_id']}";

            //executing query
            $result2 = $mysqli->query($queryUsernames);
            if ($result2) {
                $followerResult = $result2->fetch_assoc();
                $follower = $followerResult['username'];

                //displaying results dynamically for each user followed
                echo "<h6>$follower</h6>";
                echo "<hr>";
            }
        }
    } else {
        echo "<p>ERROR: Contact Developer</p>";
    }

    ?>
</main>
<?php
require_once "includes/footer.php"
?>