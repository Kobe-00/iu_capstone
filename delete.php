<?php session_start();
// Connect to the database
// $con = mysqli_connect("db.luddy.indiana.edu", "i494f22_team45", "my+sql=i494f22_team45", "i494f22_team45");
// if (mysqli_connect_errno()) {
//     echo "Failed to connect to MySQL: " . mysqli_connect_error();
//     exit();
// }
// $email = $_POST['email'];
// if(!empty($email)){
//     // Get the review ID from the POST request
    

//     // Delete the review from the database
//     $sql = "DELETE FROM users WHERE email='$email'";
//     $result = mysqli_query($con, $sql);

//     if ($result) {
//         echo "<script>alert('Deleted the account!')</script>";
//         echo "<script>location.replace('home.php');</script>";
//     } else {
//         echo "Error deleting review: " . mysqli_error($con);
//     }

//     // Close the database connection
//     mysqli_close($con);
    
// }


// Connect to the database
$con = mysqli_connect("db.luddy.indiana.edu", "i494f22_team45", "my+sql=i494f22_team45", "i494f22_team45");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Get the email from the POST request
$email = $_SESSION['email'];

if (!empty($email)){
    // Escape special characters in the email to prevent SQL Injection
    $email = mysqli_real_escape_string($con, $email);

    // Delete the user from the database
    $sql = "DELETE FROM users WHERE email='$email'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "<script>alert('Deleted the account!')</script>";
        echo "<script>location.replace('home.php');</script>";
    } else {
        echo "Error deleting user: " . mysqli_error($con);
    }
} else {
    echo "Email cannot be empty";
}

// Close the database connection
mysqli_close($con);
?>
