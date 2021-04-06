<?php
require_once "includes/header.php"
?>
<main lass="container">
    <h1>Following</h1>
    <?php
    if (isset($_SESSION['userID'])) {
        $userId = $_SESSION['userID'];
    }
    //if user id is not set then they must not be logged in
    else {
        header("Location: index.php?no-access=2");
        die();
    }
    $query = "SELECT `followed_user_id` 
              FROM `following` 
              WHERE `user_id` = {$userId}";
    $result = $mysqli->query($query);
    if ($result) {
        echo "<hr>";
        while ($row = $result->fetch_assoc()) {
            $queryUsernames = "SELECT `username` 
                               FROM `users` 
                               WHERE `user_id` = {$row['followed_user_id']}";
            $result2 = $mysqli->query($queryUsernames);
            if ($result2) {
                $followerResult = $result2->fetch_assoc();
                $follower = $followerResult['username'];
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