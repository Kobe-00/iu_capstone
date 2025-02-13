<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Log In</title>

        <!-- Stylesheets -->
		<link rel="stylesheet" href="css/styles.css">
    </head>

    <body style="background-color:#F5F5F5;">
        <main>

            
            <?php
                if (isset($_POST['submit_login'])) {
                    $connect = mysqli_connect("db.luddy.indiana.edu","i494f22_team45","my+sql=i494f22_team45", "i494f22_team45");

                    if (!$connect) 
                        {die("Failed to connect to MySQL: " . mysqli_connect_error());}

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $email_error = "";
                            $password_error = "";

                            if (empty($_POST["login_email"])) {
                                $email_error = "Please enter your email! \n";
                            }
                            else {
                                $email_login = mysqli_real_escape_string($connect, $_POST['login_email']);
                                if (!filter_var($email_login, FILTER_VALIDATE_EMAIL)) {
                                    $email_error = "Invalid email format";
                                }
                            }

                            if (empty($_POST["login_password"])) {
                                $password_error = "Please enter your password! \n";
                            }
                            else {
                                $password_login = mysqli_real_escape_string($connect, $_POST['login_password']);}

                        if((empty($email_login) OR !filter_var($email_login, FILTER_VALIDATE_EMAIL) OR empty($password_login))){}
                        else {
                            
                            $matching_login = mysqli_query($connect, "SELECT * FROM users WHERE (email='$email_login' AND password = '$password_login')");
                            $row = mysqli_fetch_assoc($matching_login);
                            if (mysqli_num_rows($matching_login) <= 0) {
                                $no_account_msg = "Please create an account!";
                            }
                            else {
                                $_SESSION['email'] = $email_login;
                                $_SESSION['userID'] = $row['userID'];
                                $_SESSION['lname'] = $row['lname'];
                                $_SESSION['username'] = $row['username'];
                                $_SESSION['lname'] = $row['lname'];
                                

                                echo '<script>alert("You successfully log in!")</script>';
                                echo "<script>location.replace('userMain.php');</script>";
                                exit;
                            }
                        }
                    }
                    mysqli_close($connect);
                }
            ?>

            <div class="parent_login">
                <div class="image_div">
                    <img style="  border-top-right-radius: 10px;
                    border-bottom-right-radius: 10px;" src="images/login_image.png" width="410vw" height="558">
                </div>
                <div class="login_div">
                    <p><strong style="font-size:24px;">Welcome Back</strong></p>
                    <p style="color:#ADABAB; font-size:12px; margin:2.0em 0 4.0em 0;">Please enter your login credentials to continue</p>
                    <form method = "POST"> 
                        <div class="input-block">
                            <input type="email" name="login_email"  size="40"  required spellcheck="false">
                            <span class="placeholder">Email</span>
                            <span class="comment"> <?php echo $email_error;?></span><br><br>
                        </div>

                       <div class="input-block">
                            <input type="password" name="login_password"  size="40"  required spellcheck="false">
                                <span class="placeholder">Password</span>
                                <a style="color:#E63946; font-size:11px;float:right; text-decoration:none; margin-top:1.0em;"href="password.php"><strong>Forgot Password?</strong></a></p>
                                <span class="comment"> <?php echo $password_error;?></span><br><br>
                                <span class="comment"> <?php echo $no_account_msg;?></span><br><br>
                                
                       </div>
        
                        
                
                        
                        <div class="login_buttons">
                            <button class="login_button2" type="submit" name="submit_login" value="SUBMIT">Login</button> 
                            <!-- <a href= "signup.php" class="login_button">SIGN UP</a> -->
                            <p style="color:#ADABAB; font-size:11px; margin:1.0em auto 0 auto;">Don't have an account yet? &nbsp; <a style="color:#E63946; text-decoration:none;"href="signup.php"><strong>Sign Up</strong></a></p>
                        </div>
                        
                    </form>
                </div>


            </div>


        </main>
    </body>



</html>