<?php
session_set_cookie_params(3600); // 1 hour
error_reporting(E_ALL);
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        <?php include 'css/styles.css'; ?>
    </style> 

</head>
<body>

    <?php 


        $islogin = $_SESSION['email'];

        if ($islogin) {
            ?>

            <div class="topnav">
                <a href="userMain.php"><img width= '100' height='100' src="images/logo.png"></a>
                
                <div class="topnav-right">
                    <a href="account.php">ACCOUNT</a>
                    <a href="logout.php">SIGN OUT</a>
                    <a href="sellerRegistration.php">APPLY TO SELL</a>

                </div>
            </div>
            <?
        }
        else {
            echo '<script>alert("Your session has expired. Please log in again")</script>';
            echo "<script>location.replace('login.php');</script>";
            exit();
 
        }


        
    
    ?>



</body>
</html>