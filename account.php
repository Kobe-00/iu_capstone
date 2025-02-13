<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">

    <style>
        /* main {
            margin: auto;
            width: 50%;
        }

        .lists {
            margin: auto;
            text-align: center;
            display: flex;
            justify-content: space-around;
            border-radius: 5px;
            border: 1px solid #f5f5f5;
            background-color: #F2F4F8;
            margin-top: 5px;
            
        }
        a {
            text-decoration: none;
            color: #ababab;
            font-family: pretendard, sans-serif;
            font-weight: bold;
            padding: 15px 20px;


        }
        a:hover {
            color: #e63946;
            padding: 9px 19px;
            background-color: white;
            border: 1px solid white;
            border-radius: 5px;
            margin: 5px 0px;
            -webkit-box-shadow: 0px 0px 15px 0px rgba(222,222,222,1);
-moz-box-shadow: 0px 0px 15px 0px rgba(222,222,222,1);
box-shadow: 0px 0px 15px 0px rgba(222,222,222,1);

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
            <h2 style="margin-bottom:0;">Account</h2><br>
            <p style="margin-top:0;color:#ABABAB;">Set your account settings down below</p>
            <div class="lists">

                <a class="active" href="account.php">Profile</a>
                <a href="editProfile.php">Edit profile</a>
                <a href="changePassword.php">Password</a>
                <a href="&order_history.php">Review</a>


            </div>
            <div>
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
                            echo "<script>location.replace('userProfile.php');</script>";
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
                    <div class="editProfile_div1">
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
                                <input style ="width:180px; margin-left:22.5px;"  type="text" name="f_plateNum"  size="20" value="<?php echo $row['plateNum']; ?>" required spellcheck="false">
                                <span class="placeholder">Plate Number</span>
                            </div>
                        </div><br>

                        <div class="input-block1">
                            <input style ="width:420.5px;" type="text" name="email"  size="40" value="<?php echo $row['email']; ?>" required spellcheck="false">
                            <span class="placeholder">Email</span>
                            
                        </div>
                        <br><br>

                        <a href="delete.php"><button style="width:65px;" class ="profile_button2" type="button">Delete</button></a>

                       
                    </div>

                </form>

            </div>

        </div>
    </main>
    
</body>
</html>