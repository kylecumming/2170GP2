<?php
    include_once "header.php";
    if($_SESSION['admin'] != 1){
        header('location: ../index.php');

    }

    $user_query = "SELECT * FROM `users`";

    $results = $mysqli->query($user_query);

    if ($results->num_rows > 0){
        ?>
        
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
    }
?>



<?php
    include_once "footer.php";
?>