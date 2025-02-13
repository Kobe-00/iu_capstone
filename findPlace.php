<!DOCTYPE html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Testing auto complete search</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap-grid.min.css" />
  </head>
<html>
    <body>
      <div> Congrats Your Application has Been Approved! </div>

    
        <div class="container">
        <div class="row">
          <div class="col">
            <div id="map"></div>
          </div>
          <div class="col">
            <?php echo "Application Number '.$rowcount.'" ?>
          <div class="col">
          <?php echo 'Date Confirmed '.date("m/d/y").' Time Confirmed '.date("h:i:sa").'  Price $'.$price ?>
          </div>
          <div class="col">
          <?php echo "Location '.$address.'" ?>
          </div>
          <div class="col">
          <?php  
          echo 'Nearby Locations';
            $id = 1;
            $query = "SELECT n.name, n.longitude FROM nearbyLocations AS n WHERE n.nearbyID = $id"; 
            $result = mysqli_query($conn,$query);
            if(isset($_POST['button'])) {
              $checked_arr = $_POST['checkbox'];
              $count = count($checked_arr);
              echo "There are ".$count." checkboxe(s) are checked";
              if ($count > 5){
                echo "Too many options selected maximum is 5";
              } else {
                $query2 = "UPDATE nearbyLocations AS n SET n.listedOnSite = 0 WHERE n.listedOnSite = 1";
                mysqli_query($conn,$query2);
                foreach($_POST['checkbox'] as $lng){
                  echo $lng;
                  $query2 = "UPDATE nearbyLocations AS n SET n.listedOnSite = 1 WHERE n.longitude = '$lng'";
                  mysqli_query($conn,$query2);
                  header("Location: findPlace.php");
                };
              }
            }
            echo '<form method="post">';
            $a = $_POST['address'];
            $z = $_POST['zip'];
            $p = $_POST['price'];
            $pw - $_POST['password'];
            $d = $_POST['dob'];
            echo "<input type='hidden' id='address' name='address' value=$a";
            echo "<input type='hidden' id='zip' name='zip' value=$z";
            echo "<input type='hidden' id='price' name='price' value=$p";
            echo "<input type='hidden' id='password' name='password' value=$pw";
            echo "<input type='hidden' id='dob' name='dob' value=$d";
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
        </div>
        <div class="row">
            <div class="col">
              <button onclick='window.location.href="userMain.php";'>
                Finish
              </button>
            </div>
            <div class="col">
              for
            <input type="hidden" id="postId" name="postId" value="34657">
              <button onclick='window.location.href="editLocations.php";'>
                Edit
              </button>
            </div>
          </div>
        </div>';
  
    
    </body>
    <script> 
  function mySubmit($val) {
     document.getElementById('hiddenField').value = $val;
     document.getElementById("sellerRegistration").submit();
   }
</script>
</html> 

<!-- https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=39.1187%2C-86.5465&radius=1500&key=AIzaSyAI1WpJPgaXK2OmRntMpXkWdQVKjR7Od7U -->

<!-- INSERT INTO applicationForm (userID, date_of_birth, password, address, zip, price, arriving, leaving, notesByRentor, active) VALUES 
                                  (1, '1999-12-12','welcome','4307 Falcon Drive', 47403, '5', '5:00', '6:00', 'rwes', 'active'); -->