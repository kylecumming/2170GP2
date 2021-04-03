<!doctype html>
<html lang="en">
  	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>JediTweeps</title>
	
		<!-- Bootstrap core CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">	

		<!-- Custom CSS -->
		<link rel="stylesheet" href="css/style.css">

        <?php 
		include_once "includes/db.php";
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
                    <a class="navbar-brand app-name" href="index.php">Jedi<span class="yellow">Tweeps</span></a>
                
                    <div class="collapse navbar-collapse" id="navbarText">                        
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="includes/profile.php?clickedUser=1">My Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Feeds</a>
                            </li>
                        </ul>
        
                    </div>
        
                    <div class="search-form">
                        <form method="post"> 
                
                            <lable for="srch" class="d-none">Search</lable>
                            <input type="text" id="srch" name="searchKeywords" placeholder="Search By">

                            <label for="searchBy" class="d-none">Choose a car:</label>
                            <select name="searchOption" id="searchBy">
                                <option value="name">Name</option>
                                <option value="uname">Username</option>
                            </select>
                
                        </form>
                
                    </div>
                    <ul class="navbar-nav mr-auto sign-in">
                        <li class="nav-link">
                            <?php 
                                if(!empty($_SESSION['loggedin'])) {
                                    if ($_SESSION['loggedin']){//if logged in (still need to know how we are tracking user)
                                        echo '<a class="sign" href="includes/logout.php">Logout</a>';
                                    }
                                    else{
                                        echo '<a class="sign" href="includes/login.php">Login</a>';
                                    }
                                }
                                else{
                                    echo '<a class="sign" href="includes/login.php">Login</a>';
                                }
                            ?>
                        </li>
                    </ul>  
                </div>
            </nav>
        </header>
        <main class="container">
