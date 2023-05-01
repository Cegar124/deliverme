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
                        <h3>Customer Register</h3>
                        <h5>User Name</h5>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputUsername1">First name</label>
                                <input type="text" name="firstname" class="form-control" id="exampleInputFirstname1" aria-describedby="firstnameHelp" placeholder="Enter First Name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputUsername1">Last Name</label>
                                <input type="text" name="lastname" class="form-control" id="exampleInputLastname1" aria-describedby="lastnameHelp" placeholder="Enter Username" required>
                            </div>
                        </div>
                        <hr>
                        <h5>Account Information</h5>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputUsername1">Username</label>
                                <input type="username" name="username" class="form-control" id="exampleInputUsername1" aria-describedby="usernameHelp" placeholder="Enter Username" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                            </div>
                        </div>
                        <hr>
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
                        <hr>
                        <h5>User Type</h5>
                        <input type="radio" id="customer" name="user_type" value="customer">
                        <label for="customer">customer</label>
                        <input type="radio" id="driver" name="user_type" value="driver">
                        <label for="driver">driver</label>

                        <div class="d-flex justify-content-center" style="padding-top: 30px; padding-bottom: 30px" >
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

                <?php
                    if (isset($_POST['action'])) {
                        // Parse user info when submit is pressed.
                        $first_name = $_POST['firstname'];
                        $last_name = $_POST['lastname'];
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $st_name = $_POST['street'];
                        $city = $_POST['city'];
                        $state = $_POST['state'];
                        $country = $_POST['country'];
                        $apt = $_POST['aptnum'];
                        $zipcode = $_POST['zipcode'];
                        $user_type = $_POST['user_type'];

                        // Get the last user_id and set next user_id
                        $query = mysqli_query($sql, "SELECT MAX(user_id) FROM users");
                        $row = mysqli_fetch_assoc($query);
                        $user_id = $row['MAX(user_id)'] + 1;

                        // insert user information to database
                        $query2 = mysqli_query($sql, "INSERT INTO users (user_id, username, password, first_name, last_name) VALUES ('{$user_id}', '{$username}', '{$password}', '{$first_name}', '{$last_name}') ");

                        $query3 = mysqli_query($sql, "INSERT INTO address (address_id, st_name, zipcode, city, state, country, apt_num) VALUES ('{$user_id}', '{$st_name}', '{$zipcode}', '{$city}', '{$state}', '{$country}', '{$apt}') ");

                        if ($user_type == "customer") {
                            $query4 = mysqli_query($sql, "INSERT INTO customers (cus_id, address_id) VALUES ('{$user_id}', '{$user_id}')");
                        } else if ($user_type == "driver") {
                            $query4 = mysqli_query($sql, "INSERT INTO drivers (driver_id) VALUES ('{$user_id}')");
                        }

                        // Redirect user to login page But doesn't work :(
                        header('Location: index.php');
                    }
                ?>
                <div class="d-flex justify-content-center">
                        <p> Already have an account?: </p>
                        <div class="d-flex justify-content-center" >
                            
                            <div class="col d-flex justify-content-center">
                                <a class="btn btn-sm" href="index.php">Login</button>
                            </div>
                        </div>

                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
