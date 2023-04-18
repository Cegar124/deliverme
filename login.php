<?php include('include/config.php'); ?>

<html>
<body>    

    <?php
        //getting user_id that matches to username and password

        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $query = mysqli_query($sql, "SELECT * FROM users WHERE username='{$username}' AND password='{$password}' ");

        $row = mysqli_fetch_assoc($query);

        $user_id = $row['user_id'];
    ?>

    <?php 
        //check if user_id exists in customers table, and route to customer pages

        $query = mysqli_query($sql, "SELECT * FROM customers WHERE cus_id='{$user_id}' ");

        if($row = mysqli_fetch_assoc($query)) {
            header("Location: http://localhost/deliverme/customer_profile.php?user_id=".$user_id."");
        }

    ?>

    <?php
        //check if user_id exists in admin table, and route to admin pages    
        
        $query = mysqli_query($sql, "SELECT * FROM admin WHERE admin_id='{$user_id}' ");

        if($row = mysqli_fetch_assoc($query)) {
            // route to admin pages
        }

    ?>

    <?php
        //check if user_id exists in drivers table, and route to driver pages
        
        $query = mysqli_query($sql, "SELECT * FROM drivers WHERE driver_id='{$user_id}' ");

        if($row = mysqli_fetch_assoc($query)) {
            // route to driver pages
        }

    ?>  

</body>
</html>