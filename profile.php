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

<?php
//if user pressed follow button
if (isset($_POST['followButton'])) {
    //adding following information into db
    if (isset(($_SESSION["loggedin"]))) {
        $loggedInUser = $_SESSION["userID"];
        $userToFollow = $_POST['followButton'];

        //looking in db to see if logged in user is following clicked user
        $newFollow = "INSERT INTO `following`(`user_id`, `followed_user_id`) 
                          VALUES ($loggedInUser,$userToFollow)";
        $resultNewFollow = $mysqli->query($newFollow);
        if ($resultNewFollow) {
            unset($_POST['followButton']);
        }
    }
}

//if user pressed unfollow button
if (isset($_POST['unfollowButton'])) {
    //adding following information into db
    if (isset(($_SESSION["loggedin"]))) {
        $loggedInUser = $_SESSION["userID"];
        $userToUnfollow = $_POST['unfollowButton'];

        //looking in db to see if logged in user is following clicked user
        $newUnfollow = "DELETE FROM `following` 
                      WHERE `user_id` = $loggedInUser 
                      AND `followed_user_id` = $userToUnfollow";
        $resultNewUnfollow = $mysqli->query($newUnfollow);
        if ($resultNewUnfollow) {
            unset($_POST['unfollowButton']);
        }
    }
}
?>
<main class="container profile-container">
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
            <div class="info-display">
            <div class="user-info text-center">
        <span class="user-letter" style="align-content: center"><?php echo substr($userData["first_name"], 0, 1) . substr($userData["last_name"], 0, 1) ?></span>

        <?php
        echo "<p class='h4'>";
        echo $userData["first_name"] . " " . $userData["last_name"];
        echo "</p></div>";
        $query = "SELECT COUNT(*) FROM `posts` WHERE `user_id` = '{$uid}'";
        $result = $mysqli->query($query);
        $numPosts = $result->fetch_row();
        
        echo "<h3>$numPosts[0]<br><span class='lable-profile'>POSTS<span></h3>";

        $query = "SELECT COUNT(*) FROM `following` WHERE `followed_user_id` = '{$uid}'";
        $result = $mysqli->query($query);
        $numFollowers = $result->fetch_row();

        echo "<h3><a href='followers.php?user=$uid'>$numFollowers[0]</a><br><span class='lable-profile'>FOLLOWERS<span></h3>";

        $query = "SELECT COUNT(*) FROM `following` WHERE `user_id` = '{$uid}'";
        $result = $mysqli->query($query);
        $numFollowing = $result->fetch_row();

        echo "<h3 class='align-center'><a href='following.php?user=$uid'>$numFollowing[0]<br><span class='lable-profile'>FOLLOWING<span></a></h3>";

        ?>
        
        </div>
        <div class="action-button d-flex"> 
        <!-- When follow button is pressed db will be updated -->
        <form action="" method='post'>
            <?php
            //checking if user is logged in and on a profile that is not theirs
            if (isset(($_SESSION["loggedin"]))) {
                if (!$isMe && $_SESSION["loggedin"]) {
                    $loggedInUser = $_SESSION["userID"];

                    //looking in db to see if logged in user is following clicked user
                    $queryIsFollowing = "SELECT COUNT(*) 
                                         FROM `following` 
                                         WHERE `user_id` = '{$loggedInUser}'
                                         AND `followed_user_id` = '{$uid}'";
                    $resultIsFollowing = $mysqli->query($queryIsFollowing);


                    if ($resultIsFollowing) {
                        $isFollowing = $resultIsFollowing->fetch_row();
                        //$test = 0;
                        //if user is not following user
                        if ($isFollowing[0] == 0) {
                            echo "<button type='submit' id='followButton' name='followButton' value=$uid>Follow</button>";
                        }
                        //if user is following the user
                        else {
                            echo "<button type='submit' id='unfollowButton' name='unfollowButton' value=$uid>Unfollow</button>";
                        }
                    }
                }
            }

            ?>
        </form>
        <?php
            require "includes/block.php";
        ?>
        <form action="" method='post'>
            <input type='submit' value='Block' name='block'/>
        </form>
        </div>

    </div>
    <div id="activityFeed">
       
        

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
            <h6 class="fw-light post-detail">Posted by {$row['username']} on {$row['post_date']}</h6>
            <p class="post-content">{$row['post']}</p> 
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