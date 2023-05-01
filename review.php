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
            // Getting all orders from user
            $query = mysqli_query($sql, "SELECT * FROM orders WHERE cus_id='{$user_id}'");
            $orders = array();
            while ($row = mysqli_fetch_assoc($query)) {
                $order = array();
                $driver_id = $row['driver_id'];
                $store_id = $row['store_id'];
                $date = $row['date'];

                // Getting drivers for each order
                $subQuery = mysqli_query($sql, "SELECT * FROM users WHERE user_id='{$driver_id}'");
                $subRow = mysqli_fetch_assoc($subQuery);
                $driver_first_name = $subRow['first_name'];
                $driver_last_name = $subRow['last_name'];

                // Getting store information for each order
                $subQuery = mysqli_query($sql, "SELECT * FROM stores WHERE store_id='{$store_id}'");
                $store_address_id = mysqli_fetch_assoc($subQuery)['address_id'];

                $subQuery = mysqli_query($sql, "SELECT * FROM address WHERE address_id='{$store_address_id}'");
                $subRow = mysqli_fetch_assoc($subQuery);
                $store_st_name = $subRow['st_name'];
                $store_city = $subRow['city'];
                $store_state = $subRow['state'];
                $store_zipcode = $subRow['zipcode'];

                // Getting reviews for the driver
                $reviews = array();
                $subQuery = mysqli_query($sql, "SELECT * FROM reviews WHERE driver_id='{$driver_id}'");
                while($subRow = mysqli_fetch_assoc($subQuery)) {
                    $review = array();
                    $review_text = $subRow['review'];
                    $cus_id = $subRow['cus_id'];
                    array_push($review, $review_text, $cus_id);
                    array_push($reviews, $review);
                }

                array_push($order, $driver_id, $store_id, $date, $driver_first_name, $driver_last_name, $store_st_name, $store_city, $store_state, $store_zipcode, $reviews);
                array_push($orders, $order);
            };

        ?>

        <?php 
        /*
            Index
            0: driver id
            1: store id
            2: date
            3: driver first name
            4: driver last name
            5: store street name
            6: store city
            7: store state
            8: store zipcode
            9: review : [review text, cus id]
        */
            
            function renderOrders($orders) {
                $str = '';
                foreach ($orders as $order) {
                    $str = $str.
                    "<div class='row' style='padding-top: 30px;'>
                        <div class='col-md-8'>
                            <div>
                                <h3>Order from: {$order[5]} {$order[6]}, {$order[7]} {$order[8]} on {$order[2]}</h3>
                            </div>

                            <div>

                                <div class='col-md-4'>
                                    <h4>Driver</h4>
                                </div>

                                <div class='col-md-6'>
                                    <h5>{$order[3]} {$order[4]}</h5>
                                </div>

                            </div>

                            <div class='col'>

                                <div class=''>
                                    <h5>Reviews</h5>
                                </div>

                                ".renderReviews($order[9])."
                                <form action='' method='post'>
                                    <input type='hidden' name='action' value='submit'/>
                                    <input type='hidden' value={$order[0]} name='driver_id'/>
                                    <input type='text' placeholder='Leave a review' name='review' />
                                    <button type='submit'>Submit</button>
                                </form>
                            </div>

                        </div>
                    </div>";
                };
                return $str;
            };

            function renderReviews($reviews) {
                $str = '';
                foreach ($reviews as $review) {
                    $str = $str."
                        <div>
                            From user #{$review[1]}
                        </div>
                        <div class=''>
                            &nbsp;&nbsp;&nbsp;'{$review[0]}'
                        </div>";
                };
                return $str;
            };

            ?>


        <?php     
            if (isset($_POST['action'])) {
                $reviewSubmitted = $_POST['review'];
                $driver_id = $_POST['driver_id'];

                // Get the last review_id and set next review_id
                $query = mysqli_query($sql, "SELECT MAX(review_id) FROM reviews");
                $row = mysqli_fetch_assoc($query);
                $review_id = $row['MAX(review_id)'] + 1;

                $query = mysqli_query($sql, "INSERT INTO reviews (review_id, driver_id, cus_id, review) VALUES ('{$review_id}', '{$driver_id}', '{$user_id}', '{$reviewSubmitted}')");

                header('Location: review.php');
            };
        
        ?>


        <div class="container emp-profile" style= "padding-top: 100px;">
                <div class="row">

                    <div class="col-md-6">

                        <div class="profile-head">
                            <h3> <?php echo $first_name ?> <?php echo $last_name ?> </h3>
                        </div>

                    </div>

                </div>
                <?php echo renderOrders($orders);?>
                
                
                <form action="" method="post">
                    <input type="hidden" name="action" value="submit"/>
                    <div class="row" style= "padding-top: 20px;">
                        <div class="col-md-2">
                            <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
                        </div>
                    </div>
                </form>
        </div>

        
    </body>
</html>