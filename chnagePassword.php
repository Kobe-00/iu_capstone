<!DOCTYPE html>
<html>
    <head>
        <title>Change Password</title>

        <!-- Stylesheets -->
        <link rel="stylesheet" href="css/styles.css">
    </head>

    <body>
        <?php include('includes/header.php'); ?>

        <main>
        <div class="editProfile">
            <?php
                $con=mysqli_connect("db.luddy.indiana.edu","i494f22_team45","my+sql=i494f22_team45", "i494f22_team45"); 
                $islogin = mysqli_real_escape_string($con, $_SESSION['email']);
                $sql = "SELECT fname, lname, email, password FROM users WHERE email='$islogin'";

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    mysqli_free_result($result);

                    // Step 4: Check if the user has submitted the form
                    if (isset($_POST['submit'])) {

                        // Step 5: Sanitize and validate the user inputs
                        $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
                        $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

                        if ($new_password != $confirm_password) {
                            echo "Error: New password and confirm password do not match.";
                            exit;
                        }

                        // Step 7: Update the user's password in the database
                        $sql = "UPDATE users SET password='$new_password' WHERE email='$islogin'";
                        if (mysqli_query($con, $sql)) {
                            echo "<script>alert('Password updated successfully!')</script>";
                            echo "<script>location.replace('userProfile.php');</script>";
                        } else {
                            echo "Error updating password: " . mysqli_error($con);
                        }
                    }
                } else {
                    die("SQL Error: " . mysqli_error($con));
                }

                // Step 8: Close the database connection
                mysqli_close($con);

                ?>
    
                <form method="POST">
                
                                <div class="editprofile_name">
                                    <h2><?php echo $row['fname']; ?> <?php echo $row['lname']; ?>'s Profile</h2>
                                </div>

                                <div class="editProfile_div">

                                <p style="color:#ADABAB; font-size:20px; margin:1.5em 0 2.5em 0;">Please change your passowrd</p>

                                <div class="input-block1">
                                    <input style ="width:420.5px;" type="text" name='new_password' size="40" required spellcheck="false">
                                    <span class="placeholder">New Password</span>
                                </div><br>

                                <div class="input-block1">
                                    <input style ="width:420.5px;" type="text" name='confirm_password' size="40" required spellcheck="false">
                                    <span class="placeholder">Confirm Password</span>
                                </div><br>

                                <div class="editprofile_button">
                                    <button type="submit" name="submit" style="width:150px; align-self:end; margin-right:1.0em;" class ="update">Update</button>                        
                                </div>


            </div>
        </main>
    </body>