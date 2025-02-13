<?php session_start();?>
<!DOCTYPE html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Congrats</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap-grid.min.css" />
    <style>
      body {
        background-color:#F5F5F5;
        margin-top:0;
        width:60% ;
        margin: 0 auto;
        font-family: pretendard, sans-serif;
        
      }
      .container {
        margin-top:5vh;
        background-color:white;
        border-radius:10px;
        -webkit-box-shadow: 0px 0px 15px 0px rgba(222,222,222,1);
        -moz-box-shadow: 0px 0px 15px 0px rgba(222,222,222,1);
        box-shadow: 0px 0px 15px 0px rgba(222,222,222,1);
      }
    </style>
  </head>
<html>
    
    <body>
    <?php include('includes/header.php'); ?>
      <center><h2>Congratulations you have been approved </h2></center>
    <div class = 'container'>  
        <div class="column">
          <div id="map"></div>
        </div>
        <div class="column"> 
            <?php
                require("db.php");
                $id = (int) $_POST['locationID'];
                $query = "SELECT latitude, longitude FROM parkingLocation WHERE parkingID = $id";
                $result = mysqli_query($conn,$query);
                while ($row = @mysqli_fetch_assoc($result)){
                  $latitude = $row['latitude'];
                  $longitude = $row['longitude'];
                  echo " <input type='hidden' id='latitude' name='latitude' value='$latitude'>";
                  echo " <input type='hidden' id='longitude' name='longitude' value='$longitude'>";
                }







                $query = "SELECT n.name, n.longitude FROM nearbyLocations AS n WHERE n.nearbyID = $id"; 
                $result = mysqli_query($conn,$query);
                //makes sure 5 or less options where clicked
                if(isset($_POST['button'])) {
                  $checked_arr = $_POST['checkbox'];
                  $count = count($checked_arr);
                  if ($count > 5){
                    echo "Too many options selected. Maximum is 5";
                  } else {
                    $query2 = "UPDATE nearbyLocations AS n SET n.listedOnSite = 0 WHERE n.listedOnSite = 1";
                    mysqli_query($conn,$query2);
                    foreach($_POST['checkbox'] as $lng){
                      $query2 = "UPDATE nearbyLocations AS n SET n.listedOnSite = 1 WHERE n.longitude = '$lng'";
                      mysqli_query($conn,$query2);
                      header("Location: https://cgi.luddy.indiana.edu/~team45/userMain.php");
                      exit();
                    };
                  }
                }
                echo "<h3>You can now select up to 5 nearby locations, to make your parking place seem more appealing </h3>";
                echo '<form method="post">';
                echo "<input type='hidden' id= 'locationID' name='locationID' value=$id />";
                while ($row = @mysqli_fetch_assoc($result)){
                  echo 
                  '<input type="checkbox" id='.$row['name'].'" name="checkbox[]" value='.$row['longitude'].'>
                  <label for='.$row['name'].'> '.$row['name'].'</label><br>';
                }
                echo '<input type="submit" name="button"
                class="button" value="Confirm"/>';
            ?>
        </div>
       
    </div>
    </body>
    <script>
      function initMap() {
        var myLatLng = new google.maps.LatLng(+document.getElementById('latitude').value, +document.getElementById('longitude').value);
        var map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: myLatLng,
          });

          new google.maps.Marker({
            position: myLatLng,
            map,
          });
        }

        window.initMap = initMap;
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAI1WpJPgaXK2OmRntMpXkWdQVKjR7Od7U&callback=initMap" async>
    </script>
</html> 

<!-- https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=39.1187%2C-86.5465&radius=1500&key=AIzaSyAI1WpJPgaXK2OmRntMpXkWdQVKjR7Od7U -->

<!-- Shorten User Table
Shorten Tables Across them all
Add Time table
Edit EmailNotifactions 
UPDATE nearbyLocations SET listedOnSite = 0 WHERE name = button-->