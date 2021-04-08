<!-- Added some of the element and classes to work with using CSS : Sahil Sorathiya B00838439
I learned some of the elements of bootstrap and how to work with CSS on multiple pages together. Also refreshed my css knowledge -->
<?php
    include_once "includes/header.php";
    echo "<main class='container'>";
    if($_SESSION['admin'] != 1){
        header('location: index.php');

    }

    if(!$_POST['formAsk'] == "yes" || $_POST['formAsk'] == "no" ){

?>

    <section id="adminForm">
    
    <div class="ask-create">
        <form method="POST">
            <button type="submit" id="addUserStart" name="formAsk" value="yes">Create New User</button>
        </form>
    </div>

<?php
}
    if($_POST['formAsk'] == "yes"){

?>
    
    <form method="POST">
        <div class="create-user text-center">
            <div class="d-flex flex-row user-name">
                <label for="fname" class="d-none">First Name:</label>
                <input type="text" id="fname" class="user-input"name="fname"  placeholder="First Name">
                <label for="lname" class="d-none">Last Name:</label>
                <input type="text" id="lname" class="user-input"name="lname" placeholder="Last Name">
            </div>
            <label for="username" class="d-none">UserName: </label>
            <input type="text" id="username" class="user-input"name="username" placeholder="Username"><br>
            <label for="email" class="d-none">Email: </label>
            <input type="text" id="email" class="user-input"name="email" placeholder="Email"><br>
            <label for="password" class="d-none">Password: </label>
            <input type="password" id="password" class="user-input"name="password" placeholder="Password"><br>
            <div class="text-center">
                
                <input type="radio" id="admin" name="adminAbility" value="yes">
                <label for="admin" class="">Administrator</label>&nbsp&nbsp&nbsp&nbsp&nbsp
                <input type="radio" id="blogger" name="adminAbility" value="no" checked>
                <label for="blogger" class="">Blogger</label>
            </div>
            
            
            <input type="submit" id="submitAdmin" name="submitAdmin" value="Add User">
        </div>
        </form>

    </section>

<?php
     }
     echo "<div class='update-message'>";
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
</div>

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
        
            $count++;
        }
    
    
    }
?>
</table>
</section>

</main>

<?php
    include_once "includes/footer.php";
?>