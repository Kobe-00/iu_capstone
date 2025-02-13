<!DOCTYPE html>
<html>
  <head>
    <title>User Profile</title>

    <!-- Stylesheets -->
		<link rel="stylesheet" href="css/styles.css">
    <style>
      table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 1rem;
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
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 500;
        font-size: 20px;
        line-height: 24px;
      
      }
      td {
        color: #31302F;
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 500;
        font-size: 20px;
        line-height: 24px;
      }
    </style>
  </head>

  <body>
    <?php include('includes/header.php'); ?>

    <main>
    
      <div class="userProfile">
        <?php
        $islogin = $_SESSION['email'];
        $sql = "SELECT userID, fname, lname, phone, car, plateNum, email FROM users WHERE email='$islogin'";

        $con=mysqli_connect("db.luddy.indiana.edu","i494f22_team45","my+sql=i494f22_team45", "i494f22_team45"); 
        $result = mysqli_query($con, $sql);

        if($result) {
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_array($result)){
                    ?>

                    <div class="profile_name">
                      <h2><?php echo $row['fname']; ?> <?php echo $row['lname']; ?>'s Profile</h2>
                    </div>

                    <div class="card">
                      <div class=profile>
                        <br>
                        <br>
                        <br>
                        <table>
                          <tr><th>User ID</th><th>Name</th><th>Email</th><th></th></tr>
                          <tr><td><?php echo $row['userID']; ?></td><td><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></td><td><?php echo $row['email']; ?></td>
                          <td>
                            <form method="POST" action="delete.php">
                              <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
                              <button style="width:65px;" class ="profile_button2" type="submit">Delete</button>
                            </form>
                          </td></tr>
                        </table>
                      </div>
                      <div class="profile_buttons">
                        <a href="editProfile.php"><button style="width:130px; align-self:end; margin-right:1.0em;" class ="profile_button" type="button" onclick="alert('Time to Edit Your Profile!')">Edit<br>Profile</button></a>
                        <a href="changePassword.php"><button style="width:130px; align-self:end; margin-right:1.0em;" class ="profile_button" type="button" onclick="alert('Change Your Password!')">Change Password</button></a>
                        <a href="&order_history.php"><button style="width:130px; align-self:end; margin-right:1.0em;" class ="profile_button" type="button">Order<br>History</button></a>
                        <a href="viewReviews.php"><button style="width:130px; align-self:end; margin-right:1.0em;" class ="profile_button" type="button">Reviews<br>by Me</button></a>
                      </div>
                    </div>
                      
                    <?php
                }
            }
        }
        ?>
      </div>
     
    </main>
  </body>
</html>