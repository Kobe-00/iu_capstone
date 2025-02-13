<!DOCTYPE html>
<html>
<head>
  <title>All Reviews</title>
  <style>
    body {
        font-family: pretendard, sans-serif;
        font-style: normal;
        background-color:#F5F5F5;
    }
    .a {
        padding:2.0em 2.0em 7.0em 2.0em;
        background-color:white;
        
        width:90%;
        margin: 10vh auto 0;
        box-shadow: 4px 4px 10px 3px rgba(0, 0, 0, 0.1);


    }
    h1 {
        text-align:center;
        color:#31302F;

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
    .star-icon {
        color: gold;
    }
    </style>
</head>

<body>
<?php include('includes/header.php'); ?>

<main>
<?php
    $host = "db.luddy.indiana.edu";
    $username = "i494f22_team45";
    $password = "my+sql=i494f22_team45";
    $dbname = "i494f22_team45";

    $conn = mysqli_connect($host, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $address = $_GET['address'];
    $sql = "SELECT * FROM parkingLocation WHERE address='$address'";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<h1>Reviews for " . $row['address'] . "</h1>";
            $parkingID = $row['parkingID'];
        }
        
        $sql = "SELECT * FROM reviews WHERE parkingID='$parkingID'";
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            echo "<div class='a'>";
            echo "<table>";
            echo "<tr><th>Rating</th><th>Description</th><th>Date</th></tr>";
            while($row = $result->fetch_assoc()) {
                $stars = $row['stars'];
                $starsHTML = '';
                for ($i = 1; $i <= 5; $i++) {
                  if ($i <= $stars) {
                    $starsHTML .= '<span class="star-icon">&#9733;</span>';
                  } else {
                    $starsHTML .= '<span class="star-icon">&#9734;</span>';
                  }
                }
                echo "<tr><td>" . $starsHTML . "</td><td>" . $row['description'] . "</td><td>" . $row['date'] . "</td></tr>";            
            }
            echo "</table>";
            echo "</div>";
        }
        else{
            echo "<p>No reviews found for this parking location.</p>";
        }
    }
    else{
        echo "<p>Parking location not found.</p>";
    }

    $conn->close();
?>
</main>
</body>
</html>