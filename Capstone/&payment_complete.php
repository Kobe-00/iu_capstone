
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Complete</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="payment_background">
    
    <h1>YOUR PAYMENT<br>HAS BEEN COMPLETED</h1>
    <p>We're thrilled to let you know that your purchase has been successful.<br>
         We will send you a confirmation email with all the relevant details shortly.<br>
         If you don't receive the email within the next few minutes,<br>
          please check your spam folder. Thank you for your purchase!</p>
         
    <!-- <a class="round_button"style="padding:1.5vh 2.0vw; text-decoration:none; border:1px solid #4A61BF; background-color:#FFFFFF; color: #4A61BF;" href="userMain.php">Explore More</a>
     -->
     <a class="button-more" href="userMain.php">
        <span class="circle" aria-hidden="true">
            <span class="icon arrow"></span>
        </span>
        <span class="button-text">Explor More</span>
    </a>
    <?php session_start();


        $connect = mysqli_connect("db.luddy.indiana.edu","i494f22_team45","my+sql=i494f22_team45", "i494f22_team45");

        if (!$connect)
            {die("Failed to connect to MySQL: " . mysqli_connect_error()); }


        $timeFrame = date("H:i:s");
        $date = date("Y-m-d");

        $transactionID = $_SESSION['transactionID'];
        $userID = $_SESSION['userID'];
        $parkingID = $_SESSION['parkingID'];
        echo  'USERID:'.$userID.'<br>parkingID:'.$parkingID.'<br>';


        $sql_check = "SELECT * FROM transaction WHERE userID = $userID AND parkingID = $parkingID AND timeFrame = '$timeFrame' AND date = '$date'";
        $result_check = mysqli_query($connect, $sql_check);

        if (mysqli_num_rows($result_check) > 0) {
            echo "Data already exists."; 
        } else {

            $sql = "INSERT INTO transaction (userID, parkingID, timeFrame, date, status) 
                    VALUES ($userID, $parkingID, '$timeFrame', '$date', 'completed')";
            

            if (mysqli_query($connect, $sql)) {
                mysqli_close($connect);
                header("Location: &payment_redirect.php");
                exit();
            } else {
                echo "Error inserting record: " . mysqli_error($connect);
            }
        }
                
    ?>
    

</body>
</html>