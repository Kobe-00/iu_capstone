<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review</title>
    <style>
        <?php include('includes/header.php'); ?>
        
        
    </style>
    <link rel="stylesheet" href="css/styles.css">

</head>
<body class="review_body">
    <img style = "display: block; margin: 2.0em auto 0 ; height: 40px;"src="images/REVIEW@4x.png">
    
    <main  class="review_main">

        <div  class="reveiw_container">
            <div class="review_col1">
                <div class="review_name">
                    <p style="padding-left:0.6em; font-weight:700">REVIEW</p>
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
                    <p style="font-size:12px;">$&nbsp<?php echo $_SESSION['price']?></p>

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
                    <p style="font-size:12px;"><?php echo $_SESSION['fname']." ";?><?php echo $_SESSION['lname'];?><br></p>

                </div>
            </div>
            <div class="profile_col2">
                <div class="notes_row1">
                    <p style="color:#ADABAB">RENTOR’S REQUEST</p>

                </div>
                <div class="notes_row2">
                    <p style="font-size:12px;"><?php echo $_SESSION['notesByRentor'];?></p>
                    
                </div>
                
                
            </div>
            
            
        </div>
        <!-- <a class="round_button_review"href="userMain.php">NEXT</a>   -->
        <a style="  float:right; margin-top:1.5em;"class="button-next_review" href="&paypal.php">
            <span class="circle" aria-hidden="true">
                <span class="icon arrow"></span>
            </span>
            <span class="button-text">NEXT</span>
        </a>
        <a style=""class="button-back_review" href="map.php">BACK</a>
    </main>
     

</body>
</html>