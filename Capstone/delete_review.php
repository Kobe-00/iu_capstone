<?php
// Connect to the database
$con = mysqli_connect("db.luddy.indiana.edu", "i494f22_team45", "my+sql=i494f22_team45", "i494f22_team45");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Get the review ID from the POST request
$reviewID = $_POST['reviewID'];

// Delete the review from the database
$sql = "DELETE FROM reviews WHERE reviewID='$reviewID'";
$result = mysqli_query($con, $sql);

if ($result) {
    echo "<script>alert('Password updated successfully!')</script>";
    echo "<script>location.replace('viewReviews.php');</script>";
} else {
    echo "Error deleting review: " . mysqli_error($con);
}

// Close the database connection
mysqli_close($con);
?>