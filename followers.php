<?php
/*
    * Feature: As a micro blog author I want to see a list of the authors that follow me
    * Developed By: Jake Coyne; B00775132; jc910209@dal.ca
    * This page loads what users are following them based off the user selected in our GET variable
    * This page first finds all the user id's in the following db table
    * Then displays there user names through the users db table
    *
*/
require_once "includes/header.php"
?>
<main lass="container">
    <h1>Followers</h1>
    <?php
    //checking that the user is set in GET Variable
    //if not set then redirect to home page with no access message
    if (!isset($_GET["user"])) {
        header("Location: index.php?no-access=1");
        die();
    }

    //setting a variable for user id
    $uid = $_GET["user"];

    //creating sql query to find all the users that are follwing $uid
    $query = "SELECT `user_id` 
              FROM `following` 
              WHERE `followed_user_id` = {$uid}";
    //executing query
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
                               WHERE `user_id` = {$row['user_id']}";

            //executing query
            $result2 = $mysqli->query($queryUsernames);
            if ($result2) {
                //setting the user info to a variables
                $followerResult = $result2->fetch_assoc();
                //displaying results dynamically for follower of user
                $follower = $followerResult['username'];
                echo "<h6>$follower</h6>";
                //printing line seperator
                echo "<hr>";
            }
        }
    }
    //error check incase sql statement is not working
    else {
        echo "<p>ERROR: Contact Developer</p>";
    }

    ?>
</main>
<?php
require_once "includes/footer.php"
?>