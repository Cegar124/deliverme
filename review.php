<?php include('include/config.php'); ?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>

    <body>
        
        <!-- header -->
        <?php include('customer_header.php'); ?>

        <?php
            // Getting user information from session
            session_start();

            $user_id = $_SESSION['user_id'];
            $first_name = $_SESSION['first_name'];
            $last_name = $_SESSION['last_name'];
        ?>


        <?php
            $query = mysqli_query($sql, "SELECT * FROM reviews WHERE cus_id='{$user_id}' ");
            $row = mysqli_fetch_assoc($query);
            $review_id = $row['review_id'];
            $driver_id = $row['driver_id'];
            $review_text = $row['review'];
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

                        <div class="col">

                            <div class="">
                                <label>Reviews</label>
                            </div>

                            <div class="">
                                <p>Driver #<?php echo $driver_id?>:
                                <?php echo $review_text?>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="row" style= "padding-top: 20px;">
                    <div class="col-md-2">
                        <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
                    </div>
                </div>

            </form>           
        </div>

        
    </body>
</html>