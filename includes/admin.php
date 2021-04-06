<?php
    include_once "header.php";
    if($_SESSION['admin'] != 1){
        header('location: ../index.php');

    }

    if(!$_POST['formAsk'] == "yes" || $_POST['formAsk'] == "no" ){

?>
    <section id="adminForm">
    
        <form method="POST">
            <label for="formAsk">Would you like to create a new user? <input type="radio" name="formAsk" value="yes">Yes</input> <input type="radio" name="formAsk" value="no" checked>No</input> </label><br>
            <input type="submit" id="addUserStart" name="addUserStart" value="Continue">
        </form>

<?php
}
    if($_POST['formAsk'] == "yes"){

?>
    
        <form method="POST">
            <label for="username">UserName: <input type="text" id="username" name="username"></label><br>
            <label for="fname">First Name: <input type="text" id="fname" name="fname"></label><br>
            <label for="lname">Last Name: <input type="text" id="lname" name="lname"></label><br>
            <label for="email">Email: <input type="text" id="email" name="email"></label><br>
            <label for="password">Password: <input type="text" id="password" name="password"></label><br>
            <label for="adminAbility">Admin: <input type="radio" id="adminAbility" name="adminAbility" value="yes">Yes</input> <input type="radio" id="adminAbility" name="adminAbility" value="no" checked>No</input> </label><br>
            <input type="submit" id="submitAdmin" name="submitAdmin" value="Add User">
        </form>
    </section>

<?php
    }

    if(isset($_POST['submitAdmin'])){
        if(!empty($_POST["username"]) && !empty($_POST["fname"]) && !empty($_POST["lname"]) && !empty($_POST["email"])  && !empty($_POST["password"]) && !empty($_POST["adminAbility"])  ){
            $username = $_POST["username"];
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
        
            if($_POST["adminAbility"] == 'yes'){
                $admin = 1;
            } else{
                $admin = 0;
            }
            
            $userQ = "INSERT INTO users (user_id, username, first_name, last_name, email, password, admin) VALUES (NULL, '$username', '$fname', '$lname', '$email', '$password', '$admin')";

            $worked = $mysqli->query($userQ);

            if($worked === true){
                echo "<h3>User has been added!</h3>";
            } else{
                echo "<h3>User was not added. Please try again.</h3>";
            }
        } else{
            echo "<h3>Please try again.</h3>";
        }
    }


?>


<?php
    $user_query = "SELECT * FROM `users`";

    $results = $mysqli->query($user_query);

    if ($results->num_rows > 0){
?>
    <section id="adminPagetable">    
        <table id="adminTable">
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Admin</th>
            <tr>
    <?php

        $count = 1;
        while ($row = $results->fetch_assoc()){ 
    ?>
            <tr id="user<?php echo $count;?>">
                <td> <?php echo $row['user_id']; ?></td> 
                <td> <?php echo $row['username'] ; ?></td>
                <td> <?php echo $row['first_name']; ?></td>
                <td> <?php echo $row['last_name']; ?></td>
                <td> <?php echo $row['email']; ?></td>
                <td> <?php echo $row['password']; ?></td>
                <td> <?php echo $row['admin']; ?></td> 
            </tr>
<?php
            echo "<br>";
            $count++;
        }
        echo "</table>";
        echo "</section>";
    }
?>



<?php
    include_once "footer.php";
?>