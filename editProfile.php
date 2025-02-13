<!DOCTYPE html>
<html>
    <head>
        <title>Edit Profile</title>

        <!-- Stylesheets -->
        <link rel="stylesheet" href="css/styles.css">
        <style>
        /* .lists {
            margin: auto;
            margin-top:3.0em ;
            text-align: center;
            display: flex;
            justify-content: space-around;
            border-radius: 15px;
            border: 1px solid #f5f5f5;
            background-color: #f5f5f5;
        }
        a {
            text-decoration: none;
            color: #ababab;
            font-family: pretendard, sans-serif;
            font-weight: bold;
            padding: 25px 20px;

        }
        a:hover {
            color: #e63946;
            padding: 19px 20px;
            background-color: white;
            border: 1px solid white;
            border-radius: 15px;
            margin: 5px 0px;

        } */
        main {
            margin: auto;
            width: 50%;
        }

        .lists {
            margin: auto;
            text-align: center;
            display: flex;
            justify-content: space-between;
            border-radius: 5px;
            background-color: #F2F4F8;
            margin-top:6.0em;

            
        }
        a {
            text-decoration: none;
            color: #ababab;
            font-family: pretendard, sans-serif;
            font-weight: bold;
            margin:0.25em;
            padding:0.5em 4.1em;
  



        }
        a:hover {
            color: #e63946;
            transition: all 0.5s;
            background-color: white;

            border-radius: 5px;


            -webkit-box-shadow: 0px 0px 15px 0px rgba(222,222,222,1);
-moz-box-shadow: 0px 0px 15px 0px rgba(222,222,222,1);
box-shadow: 0px 0px 15px 0px rgba(222,222,222,1);

        }
        .active {
            color: #e63946;
            background-color: white;
            text-decoration: none;
            border-radius: 5px;
            font-family: pretendard, sans-serif;
            font-weight: bold;
            margin:0.25em;
            padding:0.5em 4.1em;
            -webkit-box-shadow: 0px 0px 15px 0px rgba(222,222,222,1);
-moz-box-shadow: 0px 0px 15px 0px rgba(222,222,222,1);
box-shadow: 0px 0px 15px 0px rgba(222,222,222,1);

        }
        </style>
    </head>

    <body>
        <?php include('includes/header.php'); ?>

        <main>

            <div>

                <div class="lists">

                    <a href="account.php" color: #e63946 background-color: white;>Profile</a>
                    <a class="active" href="editProfile.php">Edit profile</a>
                    <a href="changePassword.php">Password</a>
                    <a href="&order_history.php">Review</a>


                </div>

            </div>

            <div class="editProfile">
            <?php
                $con=mysqli_connect("db.luddy.indiana.edu","i494f22_team45","my+sql=i494f22_team45", "i494f22_team45");
                $islogin = mysqli_real_escape_string($con, $_SESSION['email']);
                $sql = "SELECT fname, lname, phone, car, plateNum, email FROM users WHERE email='$islogin'";

                $result = mysqli_query($con, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    mysqli_free_result($result);

                    if (isset($_POST['submit'])) {
                        // Sanitize input data
                        $var_fname = mysqli_real_escape_string($con, $_POST['fname']);
                        $var_lname = mysqli_real_escape_string($con, $_POST['lname']);
                        $var_phone = mysqli_real_escape_string($con, $_POST['phone']);
                        $var_car = mysqli_real_escape_string($con, $_POST['car']);
                        $var_plateNum = mysqli_real_escape_string($con, $_POST['plateNum']);
                        $var_email = mysqli_real_escape_string($con, $_POST['email']);

                        // Update database
                        $update = "UPDATE users SET fname='$var_fname', lname='$var_lname', phone='$var_phone', car='$var_car', plateNum='$var_plateNum', email='$var_email' WHERE email='$islogin'";
                        if (mysqli_query($con, $update)) {
                            echo "<script>alert('You have successfully edited your profile!')</script>";
                            echo "<script>location.replace('account.php');</script>";
                            mysqli_close($con);
                        } else {
                            die("SQL Error: " . mysqli_error($con));
                        }
                    }
                } else {
                    die("SQL Error: " . mysqli_error($con));
                }
                ?>

                <form method="POST">


                    <div class="editProfile_div">

                        <p style="color:#ADABAB; font-size:20px; margin:0 0 2.5em 0;">Please edit your Information</p>
                        <div class="name_div">
                            <div class="input-block1">
                                <input style ="width:180px;" type="text" name="fname"  size="20" value="<?php echo $row['fname']; ?>" required spellcheck="false">
                                <span class="placeholder">First Name</span>
                            </div>

                            <div class="input-block1">
                                <input style ="width:180px; margin-left:22.5px;" type="text" name="lname"  size="20" value="<?php echo $row['lname']; ?>" required spellcheck="false">
                                <span class="placeholder">Last Name</span>
                            </div>
                        </div><br>

                        <div class="input-block1">
                            <input style ="width:420.5px;" type="text" name="phone"  size="40" value="<?php echo $row['phone']; ?>" required spellcheck="false">
                            <span class="placeholder">Phone Number</span>
                        </div><br>

                        
                        <div class="name_div">
                            <div class="input-block1">
                                <input style ="width:180px;" type="text" name="car"  size="20" value="<?php echo $row['car']; ?>" required spellcheck="false">
                                <span class="placeholder">Car Type</span>
                            </div>

                            <div class="input-block1">
                                <input style ="width:180px; margin-left:22.5px;"  type="text" name="plateNum"  size="20" value="<?php echo $row['plateNum']; ?>" required spellcheck="false">
                                <span class="placeholder">Plate Number</span>
                            </div>
                        </div><br>

                        <div class="input-block1">
                            <input style ="width:420.5px;" type="text" name="email"  size="40" value="<?php echo $row['email']; ?>" required spellcheck="false">
                            <span class="placeholder">Email</span>
                        </div>

                        <div class="editprofile_button">
                            <button type="submit" name="submit" style="width:150px; align-self:end; margin-right:1.0em;" class ="update">Update</button>                        
                        </div>
                    </div>

                </form>




                
            </div>
        </main>
    </body>

</html>
