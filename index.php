<?php include('include/config.php'); ?>
<html>
    <head>
        <title> test </title>
    </head>

    <body>
        <!-- header -->
        <?php include('templates/header.php'); ?>

        <!-- menu -->
        <?php include('templates/menu.php'); ?>

        <!-- content -->
        <?php
        $query = mysqli_query($sql, "SELECT * FROM customers");
        while($row = mysqli_fetch_assoc($query))
        {
            $cus_id = $row['cus_id'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $address_id = $row['address_id'];
        }?>


        <h1> <?php echo $cus_id; ?> </h1>
        <p> <?php echo $first_name; ?> </p>
        <p> <?php echo $last_name; ?> </p>
        <p> <?php echo $address_id; ?> </p>


        <!-- footer -->
        <?php include('templates/footer.php'); ?>

        
    </body>
</html>