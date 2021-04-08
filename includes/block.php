<!-- query  to add blocked users to the database (done by Kyle Cumming B00773076) -->
<?php
        if($_POST['block']){
            $userprofile = $_SESSION["userID"];
            $user_query = "INSERT INTO blocks (user_id, blocked_user_id) VALUES ($userprofile, $uid)";
            $results = $mysqli->query($user_query);
        } 
?>