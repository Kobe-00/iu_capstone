<!DOCTYPE html>
<html>
<head>
  <title>All Reviews</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
    a {
        color: #e63946;
    }
    a:hover {
        color: white;
        background-color: #e63946;
    }
    .fa-star {
            color: #ddd;
    }
    .checked {
        color: gold;
    }
    .half-checked:before {
        content: "\f089";
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

    $sql = "SELECT parkingLocation.address, AVG(reviews.stars) AS avg_stars
    FROM parkingLocation
    LEFT JOIN reviews ON parkingLocation.parkingID = reviews.parkingID
    GROUP BY parkingLocation.parkingID
    ORDER BY parkingLocation.address";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        echo"<h1>All Reviews</h1>";
        echo "<div class='a'>";
        echo "<table>";
        echo "<tr><th>Parking Address</th><th>Average Rating</th><th>View Reviews</th></tr>";
        while($row = $result->fetch_assoc()) {
            $address = $row['address'];
            $avgStars = $row['avg_stars'];
            $fullStars = floor($avgStars);
            $halfStars = round($avgStars * 2) % 2;
            echo "<tr><td>" . $address . "</td><td>";
            for ($i = 1; $i <= $fullStars; $i++) {
                echo "<span class='fa fa-star checked'></span>";
            }
            if ($halfStars == 1) {
                echo "<span class='fa fa-star half-checked'></span>";
            }
            for ($i = $fullStars + $halfStars + 1; $i <= 5; $i++) {
                echo "<span class='fa fa-star'></span>";
            }
            echo "</td><td><a href='reviews.php?address=" . $address . "'>View Reviews</a></td></tr>";
        }
        echo "</table>";
        echo "</div>";
    }
    else{
        echo "No results found.";
    }

    $conn->close();

?>




</main>
</body>
</html>
