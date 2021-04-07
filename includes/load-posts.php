<?php
//checking if session has started, if not start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
session_regenerate_id(true);

/*
    This code to implement post data retrieval, display and search has been used with some
    modification from my submission for Assignment 3 in CSCI 2170 (Winter 2021).
    
    Ben Lee, Assignment 3: CSCI 2170 (Winter 2021), Faculty of Computer Science,
    Dalhousie University. Available online on Gitlab at https://git.cs.dal.ca/courses/2021-winter/csci-2170/a3/blee.
    Date accessed: Apr 2 2021
    */

//not needed db is required in header file
//require_once("includes/db.php");

/*NOTE (Ben): Should we allow searching while not logged in? Then you could view blocked user's content*/
if (!isset($_SESSION['userID'])) {
    echo "Must be logged in to view posts or to search.";
} else {
    echo $_SESSION['userID'];
    $result;
    $query = "SELECT P.post, P.post_date, P.username, P.post_id, P.user_id, (SELECT COUNT(p2.post_id) FROM `likes` L JOIN `posts` p2 ON (L.post_id = p2.post_id) WHERE p2.post_id = P.post_id) AS likeCount
                                 FROM `users` U
                                 JOIN `following` F ON (U.user_id = F.user_id)
                                 LEFT JOIN `shares` S ON (F.followed_user_id = S.user_id)
                                 JOIN `posts` P  ON (F.followed_user_id = P.user_id OR S.post_id = P.post_id)
                            WHERE 
                            U.user_id = {$_SESSION['userID']} AND 
                            NOT EXISTS (SELECT blocks.* FROM blocks WHERE 
                                       (blocks.blocked_user_id = {$_SESSION['userID']} AND blocks.user_id = P.user_id) OR
                                       (blocks.blocked_user_id = p.user_id AND blocks.user_id = {$_SESSION['userID']})) ";

    //Check to see if any keywords were given
    if (isset($_POST['searchKeywords']) && $_POST['searchKeywords'] != "") {
        echo "<h2 class='fw-light'>Search Results</h2>";

        //Sanitize and wildcard the input keywords
        $keywords = explode(" ", htmlspecialchars(stripslashes(trim($_POST['searchKeywords']))));
        $wildCarded = "%";
        foreach ($keywords as $k) {
            $wildCarded .= $k . "%";
        }

        //If searched by name
        if ($_POST['searchOption'] == "name") {
            $query .= "AND
                           (U.first_name LIKE '$wildCarded' OR
                            U.last_name  LIKE '$wildCarded')
                            ORDER BY P.post_date DESC";
        }
        //If searched by username
        else if ($_POST['searchOption'] == "uname") {
            $query .= "AND
                            U.username LIKE '$wildCarded'
                            ORDER BY P.post_date DESC";
        }
    } else //NOTE (Ben) : If no keywords given currently it shows all posts
    {
        $query .= "ORDER BY P.post_date DESC";
    }
    $result = $mysqli->query($query);
    //check to see if query was properly executed
    if (!$result) {
        die("Error executing query: ($dbconnection->errno) $dbconnection->error<br>SQL = $query");
    }

    //Check to see if any rows were returned
    if ($result->num_rows == 0) {
        echo "<p>Sorry, no tweeps available</p>";
    }

    $resultIndex = 0;
    //Output any rows returned
    while ($row = $result->fetch_assoc()) {

        echo "
                    <hr>
                    <section id='result1' class='space-above-below'>            
                    <h6 class='fw-light'>Posted by {$row['username']} on {$row['post_date']}</h6>
                    <p class=''>{$row['post']}</p> 
                    <p class='text-muted'>Likes: {$row['likeCount']}</p>";
                    
                    //if($_GET['like' . $row[post_id]]){
                      //  $userid = $_SESSION['userID'];
                        //$postid = $row['post_id'];
                        //$user_query = "INSERT INTO likes (user_id, post_id) VALUES ($userid, $postid)";
                        //$results = $mysqli->query($user_query);
                    //}
                    require "likes.php";
                    //like button
                    echo "<form action='index.php' method='GET'>
                            <input type='submit' value='like' name='like$row[post_id]'/>
                          </form> 
                          <a href='profile.php?clickedUser=$row[user_id]' role='button' class='btn btn-primary'>User Profile</a>";
                    //Share button
                    if ($row["user_id"]!=$_SESSION["userID"]){
                        echo '<a href="share.php?postshare='.$row["post_id"].'">Share</a>';
                    }
                          
                    echo '</section>';
        $resultIndex++;
    }
}
