<?php
session_start();

// Establish database connection (replace with your own details)
$servername = "db.luddy.indiana.edu";
$username = "i494f22_team45";
$password = "my+sql=i494f22_team45";
$dbname = "i494f22_team45";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Define variables with user input data
$userID = $_POST['userID'];
$parkingID = $_POST['parkingID'];
$stars = $_POST['stars'];
$description = $_POST['description'];
$date = date("Y-m-d"); // Current date

// Prepare the SQL statement
$sql = "INSERT INTO reviews (userID, parkingID, stars, description, date) 
        VALUES ('$userID', '$parkingID' '$stars', '$description', '$date');";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iiiss", $userID, $parkingID, $stars, $description, $date);

// Execute the statement and check for errors
if ($stmt->execute()) {
    echo "Review added successfully";
    echo "<script>location.replace('viewReviews.php');</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>
