<!-- Added some of the element and classes to work with using CSS : Sahil Sorathiya B00838439
I learned some of the elements of bootstrap and how to work with CSS on multiple pages together. Also refreshed my css knowledge -->
<!-- Added ability to log in to session: Keaton Gibb B00833276
This really helped me know how to use $_POST better and $_SESSION which helped me with my individual assignments-->

<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JediTweeps</title>

    <!-- Copied from starter code given for assignment 3 by Dr. Raghav Sampangi 
    Accessed On 31 March, 2021
    Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <?php
        require_once "db.php";
        echo PHP_EOL;
        ?>
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
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <?php
                            if(($_SESSION['admin'] == 0  || $_SESSION['admin'] == 1) && isset($_SESSION['admin'])){
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php?clickedUser=<?php echo $_SESSION["userID"] ?>">My Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Feeds</a>
                        </li>
                        <?php
                                
                            }
                        ?>
                        <?php
                        if (isset($_SESSION['admin'])) {
                            if ($_SESSION['admin'] == 1) {
                        ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin.php">Administrative</a>
                                </li>
                        <?php
                            }
                        }
                        ?>

                    </ul>

                </div>

                <div class="search-form">
                    <form method="post">

                        <label for="srch" class="d-none">Search</label>
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
                        if (!empty($_SESSION['loggedin'])) {
                            if ($_SESSION['loggedin']) { //if logged in 
                                echo '<a class="sign" href="includes/logout.php">Logout</a>';
                            } else {
                                echo '<a class="sign" href="login.php">Login</a>';
                            }
                        } else {
                            echo '<a class="sign" href="login.php">Login</a>';
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </nav>
    </header>