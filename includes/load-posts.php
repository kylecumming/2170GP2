<!-- Added some of the element and classes to work with using CSS : Sahil Sorathiya B00838439
I learned some of the elements of bootstrap and how to work with CSS on multiple pages together. Also refreshed my css knowledge -->

<?php
//checking if session has started, if not start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
session_regenerate_id(true);

/*NOTE (Ben): Should we allow searching while not logged in? Then you could view blocked user's content*/
/*
    This code to implement post data retrieval, display and search has been used with some
    modification from my submission for Assignment 3 in CSCI 2170 (Winter 2021).
    
    Ben Lee, Assignment 3: CSCI 2170 (Winter 2021), Faculty of Computer Science,
    Dalhousie University. Available online on Gitlab at https://git.cs.dal.ca/courses/2021-winter/csci-2170/a3/blee.
    Date accessed: Apr 2 2021
    */

//not needed db is required in header file
//require_once("includes/db.php");

//Loading posts of people I follow By Ben Lee starts here

if (!isset($_SESSION['userID'])) {
    echo "Must be logged in to view posts or to search.";
} else {
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
                                       (blocks.blocked_user_id = P.user_id AND blocks.user_id = {$_SESSION['userID']})) ";

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

//Ben's section ends here
    $resultIndex = 0;
    //Output any rows returned
    while ($row = $result->fetch_assoc()) {

        echo "<hr>
                    <section id='result1' class='space-above-below'>            
                    <h6 class='fw-light'>Posted by {$row['username']} on {$row['post_date']}</h6>
                    <p class=''>{$row['post']}</p> 
                    <p class='text-muted'>Likes: {$row['likeCount']}</p>";
                    
                    
                    require "likes.php";
                    //like button

                    echo "<div class='d-flex'><form action='index.php' method='GET'>
                            <input type='submit' value='♥ Like'  class='like-btn' name='like$row[post_id]'/>
                          </form> 
                          <a href='profile.php?clickedUser=$row[user_id]' role='button' class='view-btn'>User Profile</a>
                          </div>";

                          //Share button
                    if ($row["user_id"]!=$_SESSION["userID"]){
                        echo '<a href="share.php?postshare='.$row["post_id"].'">Share</a>';
                    }
                    echo "</section>";
        $resultIndex++;
    }
}
