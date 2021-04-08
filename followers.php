<!-- Added some of the element and classes to work with using CSS : Sahil Sorathiya B00838439
I learned some of the elements of bootstrap and how to work with CSS on multiple pages together. Also refreshed my css knowledge -->

<?php
require_once "includes/header.php"
?>
<main class="container following-main">
    <h1>Followers</h1>
    <?php
    if (!isset($_GET["user"])) {
        header("Location: index.php?no-access=1");
        die();
    }

    $uid = $_GET["user"];

    $query = "SELECT `user_id` 
              FROM `following` 
              WHERE `followed_user_id` = {$uid}";
    $result = $mysqli->query($query);
    if ($result) {
        echo "<hr>";
        while ($row = $result->fetch_assoc()) {
            $queryUsernames = "SELECT `username` 
                               FROM `users` 
                               WHERE `user_id` = {$row['user_id']}";
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