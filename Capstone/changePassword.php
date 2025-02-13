<!DOCTYPE html>
<html>
    <head>
        <title>Change Password</title>

        <!-- Stylesheets -->
        <link rel="stylesheet" href="css/styles.css">
        <style>
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
        <div class="lists">

            <a href="account.php">Profile</a>
            <a href="editProfile.php">Edit profile</a>
            <a class="active" href="changePassword.php">Password</a>
            <a href="&order_history.php">Review</a>


        </div>
                <?php
                $con=mysqli_connect("db.luddy.indiana.edu","i494f22_team45","my+sql=i494f22_team45", "i494f22_team45");
                        $islogin = mysqli_real_escape_string($con, $_SESSION['email']);
                        $sql = "SELECT email, password FROM users WHERE email='$islogin'";

                        $result = mysqli_query($con, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_array($result);
                            mysqli_free_result($result);

                            if (isset($_POST['submit'])) {
                                // Sanitize input data
                                $var_password = mysqli_real_escape_string($con, $_POST['password']);
                                $var_confirmPassword = mysqli_real_escape_string($con, $_POST['confirmPassword']);

                                // Update database
                                $update = "UPDATE users SET password='$var_password' WHERE email='$islogin'";
                                if (mysqli_query($con, $update)) {
                                    echo "<script>alert('You have successfully changed your password!')</script>";
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

                    <br><br><p style="color:#ADABAB; font-size:20px; margin:0 0 2.5em 0;">Please change your passowrd</p>

                        <div class="input-block1">
                            <input style ="width:420.5px;" type="text" size="40" value="<?php echo $row['email']; ?>">
                            <span class="placeholder">Email</span>
                        </div><br>

                        <div class="input-block1">
                            <input style ="width:420.5px;" type="text" name="password"  size="40" required spellcheck="false">
                            <span class="placeholder">New Password</span>
                        </div><br>

                        <div class="input-block1">
                            <input style ="width:420.5px;" type="text" name="confirmPassword"  size="40" required spellcheck="false">
                            <span class="placeholder">Confirm Password</span>
                        </div><br>

                        <div class="editprofile_button">
                            <button type="submit" name="submit" style="width:150px; align-self:end; margin-right:1.0em;" class ="update">Confirm</button>                        
                        </div>
                    </div>

                </form>
            </div>
        </main>

    </body>
</html>


               