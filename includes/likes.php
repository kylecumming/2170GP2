<!--Database Query to add the likes to the database (done by Kyle Cumming, B00773076)-->
<?php 

if($_GET['like' . $row[post_id]]){
    $userid = $_SESSION['userID'];
    $postid = $row['post_id'];
    $user_query = "INSERT INTO likes (user_id, post_id) VALUES ($userid, $postid)";
    $results = $mysqli->query($user_query);
}
?>