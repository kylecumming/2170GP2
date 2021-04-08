<!-- Added some of the element and classes to work with using CSS : Sahil Sorathiya B00838439
I learned some of the elements of bootstrap and how to work with CSS on multiple pages together. Also refreshed my css knowledge -->
<!-- Added ability to log in to session: Keaton Gibb B00833276
This really helped me know how to use $_POST better and $_SESSION which helped me with my individual assignments-->

<?php
require_once "includes/header.php";
?>

<main class="container main-login">
            <h2 class="login-heading">Please login</h2>
            <form action="login.php" method="post">
                <div class="login-input">
                    <input type="text" class="uname" placeholder="Enter Username" name="username" required>
                    <br>
                    <input type="password"  class="password"placeholder="Enter Password" name="password" required>
                    <br>
                    <button type="submit" class="login"name="login">Login</button>
                    <br>
                    <!-- <button type="button" class="cancel">Cancel</button> -->
                </div>
            </form>

            <?php
                if(isset($_POST['login'])) {

                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    
                    $user_query = "SELECT * FROM `users` WHERE username LIKE '$username'";

                    $results = $mysqli->query($user_query);

                    if(!empty($results)) {
                        $row = $results->fetch_row();
                        if(!empty($row)) {
                            if($username == $row[1]) {
                                if($password == $row[5])  {
                                    $_SESSION['loggedin'] = true;  
                                    $_SESSION['username'] = $username;
                                    $_SESSION['userID'] = $row[0];
                                    $_SESSION['admin'] = $row[6];
                                    header("location: index.php");
                                }
                                else {
                                    error(); 
                                }
                            }
                            else {
                                error(); 
                            }
                        }
                        else {
                            error(); 
                        }    
                    }
                    else {
                        error(); 
                    }
                }

                function error() {
                    $message = "Your username or password was incorrect. Try again.";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
            ?>
        </main>
<?php
require_once "includes/footer.php";
?>