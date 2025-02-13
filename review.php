<? session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <title>Review & Rating</title>

        <!-- Stylesheets -->
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            .rating {
                
                float: left;
                width: 180px;

                padding: 12px 17px 12px;
                border-radius: 5px;
                border: 1px solid  #ADABAB;
                }

                /* Hide Radio Input */
                legend {
                    margin-bottom:.5em;
                    font-family: pretendard, sans-serif;
                }
                .rating input {
                display: none;

                
                }

                /* Star Label */
                .rating label:before {
                margin: 5px;
                font-size: 1.25em;
                font-family: FontAwesome;
                /* display: inline-block; */
                content: "\f005";
                }

                /* Star Label Checked */
                .rating label:before {
                content: "\f005";
                }

                /* 1 Star */
                .rating input:checked ~ label:nth-of-type(1):before {
                color: #FE980F;
                }
                /* 2 Star */
                .rating input:checked ~ label:nth-of-type(2):before {
                color: #FE980F;
                }
                /* 3 Star */
                .rating input:checked ~ label:nth-of-type(3):before {
                color: #FE980F;
                }
                /* 4 Star */
                .rating input:checked ~ label:nth-of-type(4):before {
                color: #FE980F;
                }
                /* 5 Star */
                .rating input:checked ~ label:nth-of-type(5):before {
                color: #FE980F;
                }
        </style>
    </head>

    <body>
        
        <?php include('includes/header.php'); ?>

        <main>
 
        <div class="editProfile_div">

            <div class="profile_name">
                <h2>Write Review</h2>
            </div><br>

            <form method="POST">
            <?php
                    if (isset($_POST['submit'])){

                        $connect = mysqli_connect("db.luddy.indiana.edu","i494f22_team45","my+sql=i494f22_team45", "i494f22_team45");

                        if (!$connect)
                            {die("Failed to connect to MySQL: " . mysqli_connect_error()); }

                        if($_SERVER["REQUEST_METHOD"] == "POST") {

                            $userID = $_POST['userID'];
                            $parkingID = $_POST['parkingID'];
                            $stars = $_POST['stars'];
                            $description = $_POST['description'];
                            $date = date("Y-m-d"); // Current date

    
                                    $sql1 = "INSERT INTO reviews (userID, parkingID, stars, description, date) VALUES ('$userID', '$parkingID', '$stars', '$description', '$date')";
                                    if (mysqli_query($connect,$sql1)) {
                                        echo "<script>alert('You have successfully add a review!')</script>";
                                        echo "<script>location.replace('viewReviews.php');</script>";  
                                    }
                                    else { die("SQL Error: " . mysqli_error($connect)); }
                                }
                                mysqli_close($connect);
                                
                            }
    
    
                ?>




                <div class="input-block1">
                    <input style ="width:180px;" type="hidden" name="userID" size="20" id="userID" value="<? echo $_SESSION['userID'];?>" placeholder="Account ID" required spellcheck="false">
                    <input style ="width:180px;" type="hidden" name="parkingID" size="20" id="parkingID" value="<?php echo $_SESSION['transactionID'];?>" placeholder="Transaction ID" required spellcheck="false">
                </div>


                
                

                <div class="input-block1">
                    <textarea style ="width:400px;" type="text" name="description" size="20" id="description" rows="5" placeholder="Description" required spellcheck="false"></textarea><br>
                </div><br>

                <div class="input-block1">
                    <select style ="width:180px;" name="stars" id="stars" required>
                        <option value="">Select Rating</option>
                        <option value="1">1 star</option>
                        <option value="2">2 stars</option>
                        <option value="3">3 stars</option>
                        <option value="4">4 stars</option>
                        <option value="5">5 stars</option>
                    </select>
                </div><br>

                <div class="editprofile_button">
                    <button type="submit" name="submit" style="width:150px; align-self:end;" class ="update">Submit</button>                        
                </div>
        
            </form>
        </div>
        </main>


    </body>
</html>