<?php
/*
    * Feature: As a micro blog author I want to follow other micro blog authors
    * Developed By: Jake Coyne; B00775132; jc910209@dal.ca
    * This feature allows a logged in user to visit other users profile 
    * and choose to follow or un follow them, which will update the db and the users page
    * This feature is implemented using a form to get whether unfollow or follow was pressed
    * and sql scripts that insert a new row or deletes a row in the following db table
    * 
    * Comments with "Follow Feature" Represent the code written by Jake Coyne
*/
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
/*
    Follow Feature: Managing POST variables from form for follow button
*/

//if user pressed follow button
if (isset($_POST['followButton'])) {
    //checking the user is logged in and can follow another user
    if (isset(($_SESSION["loggedin"]))) {
        //setting logged in user id info from session variable
        $loggedInUser = $_SESSION["userID"];
        //setting user id for the user to follow based on POST value
        $userToFollow = $_POST['followButton'];

        //query to add new row into following db table
        $newFollow = "INSERT INTO `following`(`user_id`, `followed_user_id`) 
                          VALUES ($loggedInUser,$userToFollow)";
        //executing query
        $resultNewFollow = $mysqli->query($newFollow);

        //if the query was successful unset the follow button post variable
        //this is done to avoid the possibility of two inserts happening
        if ($resultNewFollow) {
            unset($_POST['followButton']);
        }
    }
}
/*
    Follow Feature: Managing POST variables from form for unfollow button
*/

//if user pressed unfollow button
if (isset($_POST['unfollowButton'])) {
    //checking the user is logged in and can unfollow another user
    if (isset(($_SESSION["loggedin"]))) {
        //setting logged in user id info from session variable
        $loggedInUser = $_SESSION["userID"];
        //setting user id for the user to unfollow based on POST value
        $userToUnfollow = $_POST['unfollowButton'];

        //query to delete row from following db table
        $newUnfollow = "DELETE FROM `following` 
                      WHERE `user_id` = $loggedInUser 
                      AND `followed_user_id` = $userToUnfollow";
        //executing query
        $resultNewUnfollow = $mysqli->query($newUnfollow);

        //if the query was successful unset the unfollow button post variable
        //this is done to avoid the possibility of two deletes happening
        if ($resultNewUnfollow) {
            unset($_POST['unfollowButton']);
        }
    }
}
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

        /*
                Follow Feature: Made Follwers anchor link w/ GET url to pass uid to followers php pages
        */
        //anchor link to redirect to followers.php with uid GET information
        echo "<h3><a href='followers.php?user=$uid'>Followers: $numFollowers[0]</a></h3>";

        $query = "SELECT COUNT(*) FROM `following` WHERE `user_id` = '{$uid}'";
        $result = $mysqli->query($query);
        $numFollowing = $result->fetch_row();

        /*
                Follow Feature: Made Follwing anchor link w/ GET url to pass uid to followers php pages
        */
        //anchor link to redirect to following.php with uid GET information
        echo "<h3><a href='following.php?user=$uid'>Following: $numFollowing[0]</a></h3>";

        ?>
        <!-- When follow button is pressed db will be updated -->
        <form action="" method='post'>
            <?php
            /*
                Follow Feature: Creating form with follow/unfollow button that updates dynamically
            */

            //checking if session variable is set
            if (isset(($_SESSION["loggedin"]))) {
                //checking the user is on somebody elses profile and is logged in
                if (!$isMe && $_SESSION["loggedin"]) {
                    //setting logged in user id
                    $loggedInUser = $_SESSION["userID"];

                    //query checking db to see if logged in user is already following the selected user
                    $queryIsFollowing = "SELECT COUNT(*) 
                                         FROM `following` 
                                         WHERE `user_id` = '{$loggedInUser}'
                                         AND `followed_user_id` = '{$uid}'";
                    //executing query
                    $resultIsFollowing = $mysqli->query($queryIsFollowing);

                    if ($resultIsFollowing) {
                        //getting result from query
                        $isFollowing = $resultIsFollowing->fetch_row();

                        //if the value from db is zero then the user is not following the selected user
                        if ($isFollowing[0] == 0) {
                            //therefore create a button to follow the user, where the post value is the users id
                            echo "<button type='submit' id='followButton' name='followButton' value=$uid>Follow</button>";
                        }
                        //if the value from db is not zero then the user is following the selected user
                        else {
                            //therefore create a button to unfollow the user, where the post value is the users id
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
            <input type='submit' value='block' name='block' />
        </form>

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