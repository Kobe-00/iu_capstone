
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css">
  <style>
    main {
      margin: auto;
      width:50%;
    }
    body {
      font-family: pretendard, sans-serif;
      font-style: normal;

    }
    .history {
      padding:5px 2.0em 7.0em 0.5em;
      background-color:white;
      margin-top: 3.0em;

      box-shadow: 4px 4px 10px 3px rgba(0, 0, 0, 0.1);


    }
    h1 {
      text-align:center;
      color:#31302F;
      margin-bottom:0;

    }
    table {
      border-collapse: collapse;
      width: 100%;
      margin-bottom: 1rem;
      /* background-color: #F5F5F5; */
    }
    th, td {
      padding: 0.75rem;
      text-align: center;
      vertical-align: middle;
      
    
    }
    th {
      /* background-color: #E63946; */
      border-bottom: 1px solid #ABABAB;
      color: #ABABAB;
    
    }
    td {
      color: #31302F;
    
    }
    tr:nth-child(even) {
      /* background-color: #f2f2f2; */
    }
    .review-button {
      background-color: #E63946;
      color: white;
      border: none;
      padding: 8px 16px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-family: pretendard, sans-serif;
      font-size: 14px;
      margin-top: 1.5em;
      /* margin-right:20vw; */
      cursor: pointer;
      float:right;
      font-weight: 600;
    }

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
  <a href="changePassword.php">Password</a>
  <a class="active" href="&order_history.php">Review</a>


  </div>
<?php
session_start();

$servername = "db.luddy.indiana.edu";
$username = "i494f22_team45";
$password = "my+sql=i494f22_team45";
$dbname = "i494f22_team45";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$userID = $_SESSION['userID'];
$sql = "SELECT *
        FROM transaction as tr 
        JOIN users as u on u.userID = tr.userID
        JOIN parkingLocation as pL on pL.parkingID = tr.parkingID
        WHERE tr.userID = ".$userID;
$result = $conn->query($sql);




// edit action="?.php"
// use input name, transaction_id
if ($result->num_rows > 0) {
  echo "<body><form method='POST' action='review.php'>";
  echo "<div class='history'><h1>ORDER HISTORY</h1><br>";
  echo "<p><strong style='color:#ababab;'>User ID:&nbsp"?><? echo $_SESSION['userID'];?><?"</strong></p><br>";
  echo "<table>";
  echo "<tr><th>Select</th><th>Transaction ID</th><th>Address</th><th>Time Frame</th><th>Date</th><th>Status</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td><input type='radio' name='transaction_id' value='" . $row["transactionID"] . "'></td><td>" . $row["transactionID"] . "</td><td>" . $row["address"] . "</td><td>" . $row["timeFrame"] . "</td><td>" . $row["date"] . "</td><td>" . $row["status"] . "</td></tr>";
    $_SESSION['transactionID'] = $row['transactionID'];
    $_SESSION['parkingID'] = $row['parkingID'];
    
  }
  echo "</table>";
  echo "</div><input type='submit' class='review-button' value='WRTIE REVIEW'>";
  echo "</form></body>";

} 
else {
  echo "No results found.";
}

$conn->close();
?>
</main>
</body>
</html>

 
