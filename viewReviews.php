<!DOCTYPE html>
<html>
<head>
  <title>Reviews Written by Me</title>
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
    </style>
</head>

<body>
<?php include('includes/header.php'); ?>

<main>
<h1>Reviews</h1>
<?php
        $userID = $_SESSION['userID'];
        $sql = "SELECT * FROM reviews WHERE userID='$userID'";

        $con=mysqli_connect("db.luddy.indiana.edu","i494f22_team45","my+sql=i494f22_team45", "i494f22_team45"); 
        $result = mysqli_query($con, $sql);

        if($result) {
            if(mysqli_num_rows($result)>0){
                echo"<div class='a'>";
                echo"<table>";
                echo"<tr><th>Parking ID</th><th>Rating</th><th>Description</th><th>Date</th><th></th><th></th></tr>";
                while($row = mysqli_fetch_array($result)){
                    ?>
                    
                    <tr><td><?php echo $row['parkingID']; ?></td><td><?php echo $row['stars']; ?></td><td><?php echo $row['description']; ?></td><td><?php echo $row['date']; ?></td>
                    <td>
                        <form method="POST" action="delete_review.php">
                            <input type="hidden" name="reviewID" value="<?php echo $row['reviewID']; ?>">
                            <button style="width:65px;" class ="profile_button2" type="submit">Delete</button>
                        </form>
                    </td></tr>
                    <?php
                }
            }
            echo"</table>";
            echo"</div>";
        }
        ?>
    

    </main>
</body>
</html>
