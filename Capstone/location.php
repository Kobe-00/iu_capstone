<?php session_start();?>
<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Testing selection</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
      select {

        /* styling */

        color:#E63946;
        font-weight: 600;
        background-color: white;
        border: thin solid #ababab;
        border-radius: 5px;
        display: inline-block;
        font: inherit;
        line-height: 1.70em;


        /* reset */

        margin: 0;      
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        -webkit-appearance: none;
        -moz-appearance: none;
        }

        select.minimal {
          font-size:16px;
          font-weight:600;
          background-image:
            linear-gradient(45deg, transparent 50%, gray 50%),
            linear-gradient(135deg, gray 50%, transparent 50%),
            linear-gradient(to right, #ccc, #ccc);
          background-position:
            calc(100% - 15px) calc(0.65em + 5px),
            calc(100% - 10px) calc(0.65em + 5px),
            calc(100% - 2.75em) 0.5em;
          background-size:
            5px 5px,
            5px 5px,
            1px 1.7em;
          background-repeat: no-repeat;
        }

        select.minimal:focus {
          background-image:
            linear-gradient(45deg, #E63946 50%, transparent 50%),
            linear-gradient(135deg, transparent 50%, #E63946 50%),
            linear-gradient(to right, #E63946, #E63946);
          background-position:
            calc(100% - 10px) calc(0.65em + 5px),
            calc(100% - 15px) calc(0.65em + 5px),
            calc(100% - 2.75em) 0.5em;
          background-size:
            5px 5px,
            5px 5px,
            1px 1.7em;
          background-repeat: no-repeat;
          border-color: #E63946;
          outline: 0;
        }


        select:-moz-focusring {
          color: transparent;
          text-shadow: 0 0 0 #31302F;
        }
    </style>
  </head>

<html>

  <body style="color:#31302F">
    <?php session_start();

    require("db.php");
        function parseToXML($htmlStr)
        {
        $xmlStr=str_replace('<','&lt;',$htmlStr);
        $xmlStr=str_replace('>','&gt;',$xmlStr);
        $xmlStr=str_replace('"','&quot;',$xmlStr);
        $xmlStr=str_replace("'",'&#39;',$xmlStr);
        $xmlStr=str_replace("&",'&amp;',$xmlStr);
        return $xmlStr;
        }
        
        $parkingID = $_REQUEST['parkingID'];
        $_SESSION['parkingID']= $parkingID;
        $query = "SELECT p.address, p.zip, p.price, p.notesByRentor,  u.fname, u.lname FROM parkingLocation AS p INNER JOIN users AS u ON p.ownerID = u.userID WHERE parkingID = '$parkingID';"; 
        $result = mysqli_query($conn,$query);
        
        while ($row = @mysqli_fetch_assoc($result)){
          echo "<div><h2>".$row['address']. "</h2></div>";
          echo "<p style='text-align:right;margin-right:1.0em; line- color:#ababab; '>".$row['zip']. "</p>";
          echo "<div style='font-family: pretendard, sans-serif; margin-top:3.0em;'>Owner<strong><span style='float:right; font-size:20px; color:#31302F;margin-right:1.0em;'>".$row['fname']." ".$row['lname']. "</span></strong></div><br>";          
          echo "<div style='margin-bottom:2.0em;'><p style='margin-bottom:1.0em; font-size:16px;'> Cost<span style='float:right; margin-bottom:1.0em;color:#31302F;font-size:20px; margin-right:1.0em;'>$&nbsp".$row['price'].       "</span></p>";   
          $query2 = "SELECT t.startTime, t.endTime, t.dateAvaliable FROM timeSlots AS t WHERE t.parkingID = '$parkingID' ORDER BY t.dateAvaliable, t.startTime";
          $result2 = mysqli_query($conn,$query2);
          echo '<label style="margin-bottom:1.0em; font-size:16px;"for="time">Time Slots</label>

          <select style="width:340px; color:#31302F;height:30px;font-size:14px;text-align:center; margin-top:2.0em;" name="time" id="time">';
          while ($row2 = @mysqli_fetch_assoc($result2)){
            $startTime = new DateTime($row2['startTime']);
            $endTime = new DateTime($row2['endTime']);
            $dateAvaliable = new DateTime($row2['dateAvaliable']);
            echo "<option value='{$row2['startTime']},{$row2['endTime']},{$row2['dateAvaliable']}'>{$dateAvaliable->format('F j, Y')} {$startTime->format('g:i A')} - {$endTime->format('g:i A')}&nbsp;&nbsp;&nbsp;</option>";
            $_SESSION['dateTime'][] = [$row2['startTime'], $row2['endTime'], $row2['dateAvaliable']];
            $_SESSION['dateAvaliable'] = $row2['dateAvaliable'];
            $_SESSION['startTime'] = $row2['startTime'];
            $_SESSION['endTime'] = $row2['endTime'];
        }
          echo '</select>';

          $_SESSION['notesByRentor'] = $row['notesByRentor'];
          $_SESSION['address'] = $row['address'];
          $_SESSION['zip'] = $row['zip'];
          $_SESSION['fname'] = $row['fname'];
          $_SESSION['lname'] = $row['lname'];
          $_SESSION['price'] = $row['price'];
          

          $query3 = "SELECT a.notesByRentor from applicationForm AS a WHERE a.address ='".$row['address']."'";
          $result3 = mysqli_query($conn,$query3);
          while ($row3 = @mysqli_fetch_assoc($result3)){
              $_SESSION['notesByRentor'] = $row3['notesByRentor'];
          }
          
          
        }
        
     ?>
    <a style="color:#E63946; float:right; font-size:16px; text-decoration:none; border-radius:50px; padding:0.5em 1.5em; margin:3.0em 0; border:1px solid #E63946;"href="checkout_review.php">RESERVE</a>
    
    
  </body>
</html>





