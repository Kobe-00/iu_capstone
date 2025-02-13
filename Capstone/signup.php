<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up</title>

        <!-- Stylesheets -->
		<link rel="stylesheet" href="css/styles.css">
    </head>

    <body style="background-color:#F5F5F5;">
        <main>
            <div class="signup">

                <form method="POST">

                <?php
                    if (isset($_POST['register'])){

                        $connect = mysqli_connect("db.luddy.indiana.edu","i494f22_team45","my+sql=i494f22_team45", "i494f22_team45");

                        if (!$connect)
                            {die("Failed to connect to MySQL: " . mysqli_connect_error()); }

                        if($_SERVER["REQUEST_METHOD"] == "POST") {
                            $username_Err = "";
                            $fname_Err = "";
                            $lname_Err = "";
                            $phone_Err = "";
                            $car_Err = "";
                            $plateNum = "";
                            $email_Err = "";
                            $password_Err = "";

                            if (empty($_POST["f_username"])) {
                                $fname_Err = "Please enter your User Name! \n";
                            }
                            else {
                                $var_username = mysqli_real_escape_string($connect, $_POST['f_username']);
                            }

                            if (empty($_POST["f_fname"])) {
                                $fname_Err = "Please enter your first name! \n";
                            }
                            else {
                                $var_fname = mysqli_real_escape_string($connect, $_POST['f_fname']);
                            }

                            if (empty($_POST["f_lname"])) {
                                $lname_Err = "Please enter your last name! \n";
                            }
                            else {
                                $var_lname = mysqli_real_escape_string($connect, $_POST['f_lname']);
                            }

                            if (empty($_POST["f_phone"])) {
                                $fname_Err = "Please enter your phone number! \n";
                            }
                            else {
                                $var_phone = mysqli_real_escape_string($connect, $_POST['f_phone']);
                            }

                            if (empty($_POST["f_car"])) {
                                $lname_Err = "Please enter your car type! \n";
                            }
                            else {
                                $var_car = mysqli_real_escape_string($connect, $_POST['f_car']);
                            }

                            if (empty($_POST["f_plateNum"])) {
                                $lname_Err = "Please enter your plate number! \n";
                            }
                            else {
                                $var_plateNum = mysqli_real_escape_string($connect, $_POST['f_plateNum']);
                            }

                            if (empty($_POST["f_email"])) {
                                $email_Err = "Please enter your email! \n";
                            }
                            else {
                                $var_email = mysqli_real_escape_string($connect, $_POST['f_email']);
                                if (!filter_var($var_email, FILTER_VALIDATE_EMAIL)) {
                                    $email_Err = "Invalid Eamil Format!";
                                }
                            }

                            if (empty($_POST["f_password"])) {
                                $password_Err = "Please enter your password! \n";
                            }
                            else {
                                $var_password = mysqli_real_escape_string($connect, $_POST['f_password']);
                            }

                            if ((empty($var_username) OR empty($var_fname) OR empty($var_lname) OR empty($var_phone) OR empty($var_car) OR !filter_var($var_email, FILTER_VALIDATE_EMAIL) OR empty($var_password))) {}
                            else{
                                $duplicate = mysqli_query($connect,"SELECT * FROM users WHERE email='$var_email'");
                            
                                if( mysqli_num_rows($duplicate) > 0 ){
                                    $email_Err= "Already Existed email!";
                                }
                                else {
                                    $sql1 = "INSERT INTO users (username, fname, lname, phone, car, plateNum, email, password) VALUES ('$var_username', '$var_fname', '$var_lname', '$var_phone', '$var_car', '$var_plateNum', '$var_email', '$var_password')";
                                    if (mysqli_query($connect,$sql1)) {
                                        echo "<script>alert('You have successfully created your account!')</script>";
                                        echo "<script>location.replace('login.php');</script>";  
                                    }
                                    else { die("SQL Error: " . mysqli_error($connect)); }
                                }
                                mysqli_close($connect);
                                
                            }
                        }
                    }
                ?>
                <div class="parent_signup">
                    <div class="image_div">
                        <img style=" border-top-left-radius: 10px;
                        border-bottom-left-radius: 10px;" src="images/background.png" width="430" height="558">
                        <img  class ="absoulte_logo"src="images/logo.png" width="150" height="150">
                        <div class="absolute_text">
                            <p style="text-align:center; font-size:24px;">Welcome to Park Share</p>
                            <p style="text-align:center;">To keep connected with us <br>Please log in with your account</p>
                        </div>
                        <div class="absolute_login">
                            <a class ="login_button2"style="font-size:14px; padding: 0.5em 5.0em; text-decoration:none;"href="login.php">Login</a>
                        </div>
                        


                    </div>
                    <div class="signup_div">
                        <p><strong style="font-size:24px;">Create an Account</strong></p>
                        <p style="color:#ADABAB; font-size:12px; margin:2.0em 0 4.0em 0;">Please enter your Information</p>

                        <div style="margin-left:1.0em;" class="input-block">
                            <input style ="width:233.5px;" type="text" name="f_username"  size="40"  required spellcheck="false">
                            <span class="placeholder">Username</span>
                            <span class="comment"> <?php echo $username_Err; ?></span><br><br>
                        </div>

                        <div style="margin-left:1.0em;"  class="name_div">
                            <div class="input-block">
                                <input style ="width:100px;" type="text" name="f_fname"  size="20"  required spellcheck="false">
                                <span class="placeholder">First Name</span>
                                <span class="comment"> <?php echo $fname_Err; ?></span><br><br>
                            </div>
                            <div class="input-block">
                                <input style ="width:100px; margin-left:0.5em;" type="text" name="f_lname"  size="20"  required spellcheck="false">
                                <span class="placeholder">Last Name</span>
                                <span class="comment"> <?php echo $lname_Err; ?></span><br><br>
                            </div>
                        </div>

                        <div style="margin-left:1.0em;" class="input-block">
                            <input style ="width:233.5px;" type="text" name="f_phone"  size="40"  required spellcheck="false">
                            <span class="placeholder">Phone Number</span>
                            <span class="comment"> <?php echo $phone_Err; ?></span><br><br>
                        </div>

                        
                        <div style="margin-left:1.0em;" class="name_div">
                            <div class="input-block">
                                <input style ="width:100px;" type="text" name="f_car"  size="20"  required spellcheck="false">
                                <span class="placeholder">Car Type</span>
                                <span class="comment"> <?php echo $car_Err; ?></span><br><br>
                            </div>

                            <div class="input-block">
                                <input style ="width:100px; margin-left:0.5em;"  type="text" name="f_plateNum"  size="20"  required spellcheck="false">
                                <span class="placeholder">Plate Number</span>
                                <span class="comment"> <?php echo $plateNum_Err; ?></span><br><br>
                            </div>
                        </div>

                        <div style="margin-left:1.0em;" class="input-block">
                            <input style ="width:233.5px;" type="text" name="f_email"  size="40"  required spellcheck="false">
                            <span class="placeholder">Email</span>
                            <span class="comment"> <?php echo $email_Err; ?></span><br><br>
                        </div>
        
                        <div style="margin-left:1.0em;" class="input-block">
                            <input style ="width:233.5px;" type="text" name="f_password"  size="40"  required spellcheck="false">
                            <span class="placeholder">Password</span>
                            <span class="comment"> <?php echo $password_Err; ?></span><br><br>
                        </div>
                        <input style="width:130.5px; align-self:end; margin-right:1.0em;" class ="login_button2" type="submit" name="register" value="Sign Up"/>
                        </form>
                    </div>
                </div>
        </main>
    </body>



</html>