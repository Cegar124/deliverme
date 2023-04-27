<?php include('include/config.php'); ?>

<html>

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">    
    </head>

    <body>
        
        

        <!-- menu -->
        <?php include('templates/menu.php'); ?>

        <!-- content -->

        <div class="container">
            <div class="align-items-center" style="padding-top: 200px">

                <div class="d-flex justify-content-center">
                
                    <form action="" method="post">
                        <input type="hidden" name="action" value="submit"/>
                        <h3>Order List</h3>
                        <h5>Item and Quantity</h5>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputItem1">Item</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Item Name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputQuatity1">Quantity</label>
                                <input type="number" name="quantity" class="form-control" placeholder="Enter Quantity" required>
                            </div>
                        </div>
                        <hr>
                        <h5>Store Information</h5>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputStorename1">Store Name</label>
                                <input type="text" name="store" class="form-control"  placeholder="Enter Store Name" required>
                            </div>
                            
                        </div>
                        <h5>Address</h5>
                        <div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Street</label>
                                <input type="text" name="street" class="form-control" id="exampleInputStreet1" placeholder="Street" required>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">City</label>
                                    <input type="text" name="city" class="form-control" id="exampleInputCity1" placeholder="City" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">State</label>
                                    <input type="text" name="State" class="form-control" id="exampleInputState1" placeholder="State" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputPassword1">Country</label>
                                    <input type="text" name="country" class="form-control" id="exampleInputCountry1" placeholder="Country" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Apartment Number</label>
                                <input type="number" name="aptnum" class="form-control" id="exampleInputAptnum1" placeholder="Apt #" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Zipcode</label>
                                <input type="number" name="zipcode" class="form-control" id="exampleInputZipcode1" placeholder="Zipcode" required>
                            </div>
                        </div>
                        <h5>Date and Time</h5>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputDate1">Date</label>
                                <input type="date" name="date" class="form-control"  placeholder="Enter Date" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputTime1">Time</label>
                                <input type="time" name="time" class="form-control" placeholder="Enter Time" required>
                            </div>
                        </div>
                        <h5>Username</h5>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputStorename1">Username</label>
                                <input type="username" name="username" class="form-control" id="exampleInputUsername1" aria-describedby="usernameHelp" placeholder="Enter Username" required>
                            </div>
                            
                        </div>
                        <div class="d-flex justify-content-center" style="padding-top: 30px; padding-bottom: 30px" >
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        
                </div>        
                        

                <?php
                    if (isset($_POST['action'])) {
                        // Parse user info when submit is pressed.
                        $name = $_POST['name'];
                        $quantity = $_POST['quantity'];
                        //$store_name = $_POST['store']; /// I dont know if this is correct// do we need to add an attribute called name in store ot have store name
                        $time = $_POST['time'];
                        $date = $_POST['date'];
                        $st_name = $_POST['street'];
                        $city = $_POST['city'];
                        $state = $_POST['state'];
                        $country = $_POST['country'];
                        $apt = $_POST['aptnum'];
                        $zipcode = $_POST['zipcode'];
                        //getting user_id that matches to username and password

                        $username = $_POST["username"];


                         // Get the last order_id and set next order_id
                        $query = mysqli_query($sql, "SELECT MAX(order_id) FROM orders");
                        $row = mysqli_fetch_assoc($query);
                        $order_id = $row['MAX(order_id)'] + 1;

                         // got do the above step for store id
                        $query1 = mysqli_query($sql, "SELECT MAX(store_id) FROM stores");
                        $row1 = mysqli_fetch_assoc($query1);
                        $store_id = $row1['MAX(store_id)'] + 1;

                         // got do the above step for item id
                        $query2 = mysqli_query($sql, "SELECT MAX(item_id) FROM items");
                        $row2 = mysqli_fetch_assoc($query2);
                        $item_id = $row2['MAX(item_id)'] + 1;

                        // do above step for address id
                        $query3 = mysqli_query($sql, "SELECT MAX(address_id) FROM address");
                        $row3 = mysqli_fetch_assoc($query3);
                        $address_id = $row3['MAX(address_id)'] + 1;
                        //getting user_id that matches to username
                        $query8 = mysqli_query($sql, "SELECT user_id FROM users WHERE username='{$username}'");
                        $row = mysqli_fetch_assoc($query8);
                        $cus_id = $row4['user_id'];


                        // insert user information to database
                        $query4 = mysqli_query($sql, "INSERT INTO address (address_id, st_name, zipcode, city, state, country, apt_num) VALUES ('{$store_id}', '{$st_name}', '{$zipcode}', '{$city}', '{$state}', '{$country}', '{$apt}') ");
                        $query5 = mysqli_query($sql, "INSERT INTO items (item_id, name) VALUES ('{$item_id}', '{$name}')");
                        $query6 = mysqli_query($sql, "INSERT INTO stores (store_id ,address_id) VALUES ('{$store_id}', '{$address_id}')");
                        
                        $query7 = mysqli_query($sql, "INSERT INTO list (order_id, item_id, quantity) VALUES ('{$order_id}', '{$item_id}', '{$quantity}')");
                        $conn = "INSERT INTO orders (order_id, cus_id, driver_id, store_id, list, date, time) VALUES ('{$order_id}', '{$cus_id}','{$driver_id}', '{$store_id}', '{$query7}', '{$date}', '{$time}')";

                        $query9 = mysqli_query($sql, $conn);

                        
                        // fix the row names please
                        if (!$query9) {
                            printf("Error message: %s\n", mysqli_error($sql));
                        }
                        



                       
                    }
                ?>
            </div>   
            
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
