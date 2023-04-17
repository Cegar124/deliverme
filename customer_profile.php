<?php include('include/config.php'); ?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>

    <body>
        
        <!-- header -->
        <?php include('customer_header.php'); ?>

        <!-- content -->
        <?php
            $query = mysqli_query($sql, "SELECT * FROM users");
            $row = mysqli_fetch_assoc($query);
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];

        ?>

        <?php
            $query = mysqli_query($sql, "SELECT * FROM customers");
            $row = mysqli_fetch_assoc($query);
            $cus_id = $row['cus_id'];
            $address_id = $row['address_id'];
        ?>

        <?php
            $query = mysqli_query($sql, "SELECT * FROM address WHERE address_id= '{$address_id}'");
            $result = mysqli_fetch_assoc($query);
            $st_name = $result['st_name'];
            $apt = $result['apt_number'];
            $city = $result['city'];
            $state = $result['state'];
            $zipcode = $result['zipcode'];
        ?>

        <p> Name: <?php echo $first_name; ?> <?php echo $last_name; ?></p>
        <p> Saved Address: <?php echo $st_name ?> <?php echo $city ?> <?php echo $state ?>  <?php echo $zipcode ?> </p>

        
    </body>
</html>