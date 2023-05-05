<?php include('include/config.php'); ?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>

    <body>
        
        <!-- header -->
        <?php include('driver_header.php'); ?>

        <?php
            // Getting user information from session
            $user_id = $_GET["user_id"];
            $query = mysqli_query($sql, "SELECT * FROM users WHERE user_id='{$user_id}'");

            $row = mysqli_fetch_assoc($query);
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            session_start();

            // $user_id = $_SESSION['user_id'];
            // $first_name = $_SESSION['first_name'];
            // $last_name = $_SESSION['last_name'];
        ?>

        <?php
            $reviews = array();
            $query = mysqli_query($sql, "SELECT * FROM reviews WHERE driver_id = '{$user_id}'");
            while($row = mysqli_fetch_assoc($query)) {
                $review = array();
                $review_id = $row['review_id'];
                $cus_id = $row['cus_id'];
                $subQuery = mysqli_query($sql, "SELECT username FROM users WHERE user_id = '{$cus_id}'");
                $subRow = mysqli_fetch_assoc($subQuery);
                $cus_username = $subRow['username'];
                $reviewText = $row['review'];
                $replyText = $row['reply'];
                $placeholder = "Edit your reply...";
                if ($replyText == NULL) {
                    $replyText = "No replies...";
                    $placeholder = "Leave a reply...";
                }
                array_push($review, $review_id, $cus_username, $reviewText, $replyText, $placeholder);
                array_push($reviews, $review);
            }

        ?>

        <?php 
            function renderReviews($reviews) {
                $str = '';
                foreach ($reviews as $review) {
                    $str = $str."
                        <div>
                            From user #{$review[1]}
                        </div>
                        <div class=''>
                            &nbsp;&nbsp;&nbsp;'{$review[2]}'<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'{$review[3]}' 
                            <div class='d-flex'>
                                <form action='' method='post'>
                                    <input type='hidden' name='reply' value='submit'/>
                                    <input type='hidden' name='review_id' value={$review[0]}/>
                                    <div>
                                        <input type='text' placeholder='{$review[4]}' name='replyText'/>
                                        <button type='submit'>Done</button>
                                    </div>
                                </form>
                                <form action='' method='post'>
                                    <input type='hidden' name='deleteReply' value='submit'/>
                                    <input type='hidden' name='review_id' value={$review[0]}/>
                                    <button type='submit'>Delete reply</button>
                                </form>
                            </div>
                        </div>";
                };
                return $str;
            }
        ?>

        <?php 
            if (isset($_POST['reply'])) {
                $review_id = intval($_POST['review_id']);
                $reviewText = $_POST['replyText'];

                $query = mysqli_query($sql, "UPDATE reviews SET reply = '{$reviewText}' WHERE review_id = '{$review_id}'");

                header("Location: driver_review.php?user_id=$user_id");
            }
        ?>

        <?php 
            if (isset($_POST['deleteReply'])) {
                $review_id = intval($_POST['review_id']);
                $query = mysqli_query($sql, "UPDATE reviews SET reply = NULL WHERE review_id = '{$review_id}'");
                header("Location: driver_review.php?user_id=$user_id");
            }
        ?>


        <div class="container emp-profile" style= "padding-top: 100px;">
                <div class="row">

                    <div class="col-md-6">

                        <div class="profile-head">
                            <h3> <?php echo $first_name ?> <?php echo $last_name ?> </h3>
                        </div>

                    </div>
                    <div>
                        <br>
                        <h4>Your Reviews</h4>
                    </div>

                    <?php echo renderReviews($reviews)?>
                </div>
        </div>

        
    </body>
</html>