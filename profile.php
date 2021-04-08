<!-- Added some of the element and classes to work with using CSS : Sahil Sorathiya B00838439
I learned some of the elements of bootstrap and how to work with CSS on multiple pages together. Also refreshed my css knowledge -->
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
    *
    *
    *
    *
    * Feature: As a user I want to view my profile after I have logged in
    * Developed By: Scott Myrden; B00751830; sc502051@dal.ca
    * This feature allows a logged in user to visit other users profiles, and their own 
    * 
*/

//Scott Code begin
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
//Scott Code end
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
//Scott Code begin
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
        
        /*
                Follow Feature: Made Follwers anchor link w/ GET url to pass uid to followers php pages
        */
        //anchor link to redirect to followers.php with uid GET information
        echo "<h3>$numPosts[0]<br><span class='lable-profile'>POSTS<span></h3>";

        $query = "SELECT COUNT(*) FROM `following` WHERE `followed_user_id` = '{$uid}'";
        $result = $mysqli->query($query);
        $numFollowers = $result->fetch_row();

        /*
                Follow Feature: Made Follwing anchor link w/ GET url to pass uid to followers php pages
        */
        //anchor link to redirect to following.php with uid GET information
        echo "<h3><a href='followers.php?user=$uid'>$numFollowers[0]</a><br><span class='lable-profile'>FOLLOWERS<span></h3>";

        $query = "SELECT COUNT(*) FROM `following` WHERE `user_id` = '{$uid}'";
        $result = $mysqli->query($query);
        $numFollowing = $result->fetch_row();

        echo "<h3 class='align-center'><a href='following.php?user=$uid'>$numFollowing[0]<br><span class='lable-profile'>FOLLOWING<span></a></h3>";
        //Scott Code end
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
                                         //executing query
                    $resultIsFollowing = $mysqli->query($queryIsFollowing);


                    if ($resultIsFollowing) {

                        //getting result from query
                        $isFollowing = $resultIsFollowing->fetch_row();
                        //$test = 0;
                        //if user is not following user
                        if ($isFollowing[0] == 0) {
                            //therefore create a button to follow the user, where the post value is the users id
                            echo "<button type='submit' id='followButton' name='followButton' value=$uid>Follow</button>";
                        }
                        //if user is following the user
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
            if($_SESSION["userID"]!=$uid){
        ?>
        <!--Button to block users done by  (Kyle Cumming B00773076)-->
        <form action="" method='post'>
            <input type='submit' value='Block' name='block'/>
        </form>
        <?php }?>
        </div>

    </div>
    <div id="activityFeed">
       
        

        <?php
        //Scott code begin
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
            
            END;
            if (!$isMe){
                echo '<a href="includes/share.php?postshare='.$row["post_id"].'&profile='.$row["user_id"].'">Share</a>';
            }
            echo "</section>";
            
            $resultIndex++;
        }


        // Could make array full of posts
        ?>

        <!-- 
     Here we need to a joint sql query thing. We need to get all of the shit the user has posted, shared, and liked, then sory it by date, with the most recent thing being at the top
 -->
    </div>
</main>
<?php include_once "includes/footer.php" 
//Scott Code end
?>