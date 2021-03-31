<?php 
include_once "includes/header.php";
include_once "includes/db.php";

if (!isset($_GET["clickedUser"])){
    header("Location: index.php?no-access=1");
    die();
}

$uid = $_GET["clickedUser"];

$query = "SELECT * FROM `users` WHERE `user_id` = '{$uid}'";
$result = $dbconnection->query($query);
$userData = $result->fetch_assoc();
$isMe=false;

?>
<div id="userInfo">
<h2 style="text-align: center">
<?php
if (isset($_SESSION["userID"]) && $uid == $_SESSION["userID"]){//If it is my profile
    echo "My";
    $isMe=true;
}
else{//If it is someone elses profile
    echo $userData["first_name"]." ".$userData["last_name"]."'s";
}

?>
 Profile </h2>
 <span class="username" style="align-content: center"><?php echo substr($userData["first_name"],0,1).substr($userData["last_name"],0,1)?></span>

<?php
    $query = "SELECT COUNT(*) FROM `posts` WHERE `user_id` = '{$uid}'";
    $result = $dbconnection->query($query);
    $numPosts = $result->fetch_row();

    echo "<h3>Posts: $numPosts[0]</h3>";

    $query = "SELECT COUNT(*) FROM `following` WHERE `followed_user_id` = '{$uid}'";
    $result = $dbconnection->query($query);
    $numFollowers = $result->fetch_row();

    echo "<h3>Followers: $numFollowers[0]</h3>";

    $query = "SELECT COUNT(*) FROM `following` WHERE `user_id` = '{$uid}'";
    $result = $dbconnection->query($query);
    $numFollowing = $result->fetch_row();

    echo "<h3>Following: $numFollowing[0]</h3>";
?>
</div>
<div id="activityFeed">
<h2>
<?php
if($isMe){
    echo "My";
}
else{
    echo $userData["first_name"]."'s";
}

?>
 Activity</h2>

 <!-- 
     Here we need to a joint sql query thing. We need to get all of the shit the user has posted, shared, and liked, then sory it by date, with the most recent thing being at the top
 -->

<?php include_once "includes/footer.php"?>