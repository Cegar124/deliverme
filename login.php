<?php include('include/config.php'); ?>

<html>
<body>    

    <?php
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $query = mysqli_query($sql, "SELECT * FROM users WHERE username='{$username}' AND password='{$password}' ");

        $row = mysqli_fetch_assoc($query);

        $user_id = $row['user_id'];
    ?>

    <?php
        
        $query = mysqli_query($sql, "SELECT * FROM customers WHERE cus_id='{$user_id}' ");

        if($row = mysqli_fetch_assoc($query)) {
            header("Location: http://localhost/deliverme/customer_profile.php");
        }

    ?>

    <?php
        
        $query = mysqli_query($sql, "SELECT * FROM admin WHERE admin_id='{$user_id}' ");

        if($row = mysqli_fetch_assoc($query)) {
            // route to admin pages
        }

    ?>

    <?php
        
        $query = mysqli_query($sql, "SELECT * FROM drivers WHERE driver_id='{$user_id}' ");

        if($row = mysqli_fetch_assoc($query)) {
            // route to driver pages
        }

    ?>

    

    

</body>
</html>