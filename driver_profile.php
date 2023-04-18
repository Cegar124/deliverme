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
            //getting user_id that matches to username and password

            $username = $_POST["username"];
            $password = $_POST["password"];
            
            $query = mysqli_query($sql, "SELECT * FROM users WHERE username='{$username}' AND password='{$password}' ");

            $row = mysqli_fetch_assoc($query);

            $user_id = $row['user_id'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
        ?>

        <?php
            $query = mysqli_query($sql, " SELECT COUNT(order_id) FROM orders WHERE driver_id='{$user_id}'");
            $result = mysqli_fetch_assoc($query);

        ?>

        <div class="container emp-profile" style= "padding-top: 100px;">
            <form method="post">

                <div class="row">

                    <div class="col-md-6">

                        <div class="profile-head">
                            <h5> <?php echo $first_name ?> <?php echo $last_name ?> </h5>
                        </div>

                    </div>

                </div>
                
                <div class="row" style="padding-top: 30px;">

                    <div class="col-md-8">

                        <div class="row">

                            <div class="col-md-4">
                                <label>Name</label>
                            </div>

                            <div class="col-md-6">
                                <p> <?php echo $first_name ?> <?php echo $last_name ?>  </p>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <label># of Orders</label>
                            </div>

                            <div class="col-md-6">
                                <p> <?php echo $result ?> </p>
                            </div>

                        </div>

                    </div>
                    
                </div>

                <!-- <div class="row" style= "padding-top: 20px;">
                    <div class="col-md-2">
                        <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
                    </div>
                </div> -->

            </form>           
        </div>

        
    </body>
</html>