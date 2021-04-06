<!doctype html>
<html lang="en">
  	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>JediTweeps</title>
	
		<!-- Bootstrap core CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">	

		<!-- Custom CSS -->
		<link rel="stylesheet" href="../css/style.css">

        <?php
        include "db.php";
        session_start();
        ?>
  	</head>
    <body>
        <header>
        <!-- https://getbootstrap.com/docs/4.0/components/navbar/
            Created By: BootStrap 
            Accessed On: 31 March, 2021
        -->

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container">
                    <a class="navbar-brand app-name" >Jedi<span class="yellow">Tweeps</span></a>
                </div>
            </nav>
        </header>
        <main class="container">
            <form action="login.php" method="post">
                <div class="container">
                    <input type="text" placeholder="Enter Username" name="username" required>
                    <br>
                    <input type="password" placeholder="Enter Password" name="password" required>
                    <br>
                    <button type="submit" class="login"name="login">Login</button>
                    <br>
                    <button type="button" class="cancel">Cancel</button>
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
                                    header("location: ../index.php");
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
        <footer class="py-5 footer">
			<div class="container">
			
				<p class="mb-1">&copy; 2021 JediTweeps Inc.</p>
			</div>
		</footer>

		
    </body>
</html>