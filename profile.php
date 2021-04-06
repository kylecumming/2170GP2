<?php
require_once "includes/header.php";

if (!isset($_GET["clickedUser"])) {
    header("Location: index.php?no-access=1");
    die();
}

$uid = $_GET["clickedUser"];

$query = "SELECT * FROM `users` WHERE `user_id` = '{$uid}'";
$result = $mysqli->query($query);
$userData = $result->fetch_assoc();
$isMe = false;

?>
<main class="container">
    <div id="userInfo">
        <h2 style="text-align: center">
            <?php
            if (isset($_SESSION["userID"]) && $uid == $_SESSION["userID"]) { //If it is my profile
                echo "My";
                $isMe = true;
            } else { //If it is someone elses profile
                echo $userData["first_name"] . " " . $userData["last_name"] . "'s";
            }

            ?>
            Profile </h2>
        <span class="username" style="align-content: center"><?php echo substr($userData["first_name"], 0, 1) . substr($userData["last_name"], 0, 1) ?></span>

        <?php
        $query = "SELECT COUNT(*) FROM `posts` WHERE `user_id` = '{$uid}'";
        $result = $mysqli->query($query);
        $numPosts = $result->fetch_row();

        echo "<h3>Posts: $numPosts[0]</h3>";

        $query = "SELECT COUNT(*) FROM `following` WHERE `followed_user_id` = '{$uid}'";
        $result = $mysqli->query($query);
        $numFollowers = $result->fetch_row();

        echo "<h3>Followers: $numFollowers[0]</h3>";

        $query = "SELECT COUNT(*) FROM `following` WHERE `user_id` = '{$uid}'";
        $result = $mysqli->query($query);
        $numFollowing = $result->fetch_row();

        echo "<h3>Following: $numFollowing[0]</h3>";
        ?>
    </div>
    <div id="activityFeed">
        <h2>
            <?php
            if ($isMe) {
                echo "My";
            } else {
                echo $userData["first_name"] . "'s";
            }

            ?>
            Activity</h2>

        <?php

        $query = "SELECT P.post, P.post_date, P.username
                                 FROM `users` U
                                 JOIN `posts` P  ON (U.user_id = P.user_id)
                                 LEFT JOIN `shares` S ON (U.user_id = S.user_id) 
                            WHERE 
                            U.user_id = {$uid}";

        $result = $mysqli->query($query);
        $resultIndex = 1;
        while ($row = $result->fetch_assoc()) {
            $resultStr = "result" . $resultIndex;
            echo <<<END
            <hr>
            <section id="result$resultStr" class="space-above-below">            
            <h6 class="fw-light">Posted by {$row['username']} on {$row['post_date']}</h6>
            <p class="">{$row['post']}</p> 
            <p class="text-muted">Likes: {$row['likeCount']}</p>

            </section>

END;
            $resultIndex++;
        }


        // Could make array full of posts
        ?>

        <!-- 
     Here we need to a joint sql query thing. We need to get all of the shit the user has posted, shared, and liked, then sory it by date, with the most recent thing being at the top
 -->
    </div>
</main>
<?php include_once "includes/footer.php" ?>