<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-out</title>
    <style>

        
        
    </style>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body style="margin-top:20px;"class="review_body">
    <img style = "display: block; margin: 1.0em auto 0 ; height: 40px;"src="images/CONFIRM@4x.png" alt="notification">
    
    <main style="height:550px;"class="review_main">

        <div  class="reveiw_container">
            <div class="review_col1">
                <div class="review_name">
                    <p style="padding-left:0.6em; font-weight:700;">CHECKOUT</p>
                </div>
                
            </div>
            <div class="review_col2">
                <div class="order_row">
                    <p>ORDER DETAIL</p>
                </div>
            </div>
            <div class="detail_col1">
                <div class="ordernumber_row1">
                <p style="color:#ADABAB">LOCATION</p>
                </div>
                <div class="ordernumber_row2">
                <p style="font-size:12px;"><?php echo $_SESSION['address'];?></p>

                </div>
            </div>
            <div class="detail_col2">
                <div class="loca_row1">

                </div>
                <div class="locat_row2">

                </div>
            </div>
            <div class="parking_col1">
                <div class="fee_row1">
                    <p style="color:#ADABAB">PARKING FEE</p>

                </div>
                <div class="fee_row2">
                    <p style="font-size:12px;">$&nbsp<?php echo $_SESSION['price'];?></p>

                </div>
            </div>
            <div class="parking_col2">
                <div class="arrive_row1">
                    <p style="color:#ADABAB">ARRIVING TIME</p>

                </div>
                <div class="arrive_row2">
                    <p style="font-size:12px;"><?php echo $_SESSION['dateAvaliable']."&nbsp;&nbsp;&nbsp;";?><?php echo $_SESSION['startTime'];?></p>

                </div>
            </div>
            <div class="parking_col3">
                <div class="leave_row1">
                    <p style="color:#ADABAB">LEAVING TIME</p>

                </div>
                <div class="leave_row2">
                    <p style="font-size:12px;"><?php echo $_SESSION['dateAvaliable']."&nbsp;&nbsp;&nbsp;";?><?php echo $_SESSION['endTime'];?></p>

                </div>
            </div>
            <div class="profile_col1">
                <div class="rentor_row1">
                    <p style="color:#ADABAB">RENTER</p>

                </div>
                <div class="rentor_row2">
                    <p style="font-size:12px;"><?php echo $_SESSION['fname']." ";?><?php echo $_SESSION['lname'];?></p>

                </div>
            </div>
            <div class="profile_col2">
                <div class="notes_row1">
                    <p style="color:#ADABAB">RENTOR’S REQUEST</p>

                </div>
                <div class="notes_row2">
                    <p style="font-size:12px;"><?php echo $_SESSION['notesByRentor'];?></p>
                    <p style="float:right; margin: 5.0em 13.0em 0 0; width:10px;" id="paypal-payment-button"></p>
                </div>
                
                
            </div>
            
            
        </div>
        <!-- <a class="round_button_review"href="userMain.php">NEXT</a>   -->
        <!-- <a style="  float:right; margin-top:1.5em;"class="button-next_review" href="&paypal.php">
            <span class="circle" aria-hidden="true">
                <span class="icon arrow"></span>
            </span>
            <span class="button-text">CONFIRM</span>
        </a> -->
        <a style="margin-top:6.5em;" class="button-back_review" href="checkout_review.php">BACK</a>
        
    
        <script>
            var price = "<?php echo $_SESSION['price']; ?>" ;
        </script>
        <script src="https://www.paypal.com/sdk/js?client-id=AcEdTrkC3bqs-zJ2yUaMDci72g8HnC_S_HUj7mKc2lXOlASl6n1KepT6uYt1OZsWWTPgdD6CuTyRmXjI&disable-funding=credit,card"></script>
        <script src="&index.js"></script>
    </main>

     

</body>
</html>
