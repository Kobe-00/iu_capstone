
<?php session_start();?>
<!DOCTYPE html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Validate</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap-grid.min.css" />
  </head>
<html>
    <body>
        <form id="sellerRegistration" action="sellerRegistration.php" method="post">
        <input type='hidden' id= 'hiddenField' name='hiddenField' value='' />
            <?php session_start();
            
            // Connecting To Database
                require("db.php");
                // Connecting to geocode function
                require('geocode.php');
                //cleaning input functions
                function Clean($str){
                $res = str_replace(array( '\'', '"',
                ',' , ';', '<', '>', '#', '$', "_" ), ' ', $str);
                $clean = trim($res);
                return $clean;
                }   
                function validateDate($date, $format = 'Y-m-d'){
                $d = DateTime::createFromFormat($format, $date);
                return $d && $d->format($format) === $date;
                }
                function validateZipCode($zipCode) {
                if (preg_match('#[0-9]{5}#', $zipCode))
                    return true;
                else
                    return false;
                }
                // a check to stop invalid entries from being added
                $valid = true;
            //Grabbing Form Data
            //-------------------------------------------------
                $data_arr = geocode($_POST['address']. " " . $_POST['zip']);
                
                    // if able to geocode the address
                    if($data_arr){
                        
                        $latitude = $data_arr[0];
                        $longitude = $data_arr[1];
                        $formatted_address = $data_arr[2];
                        $address = $_POST['address'];
                    } else {
                    // returning user to page if address not valid
                    echo '<script>
                    function mySubmit($val) {
                        document.getElementById("hiddenField").value = $val;
                        document.getElementById("sellerRegistration").submit();
                    }
                    mySubmit("Address Not Found")
                    </script>';
                    $valid = false;
                    }
                //validate zipcode   
                //-------------------------------------------------                   
                if (validateZipCode(clean($_POST['zip'])) != true){
                echo '<script>
                function mySubmit($val) {
                    document.getElementById("hiddenField").value = $val;
                    document.getElementById("sellerRegistration").submit();
                }
                mySubmit("Invalid Zip Code")
                </script>';
                $valid = false;
                } else {
                $zip = clean($_POST['zip']);
                }

                // validate original  
                // -------------------------------------------------  
                $checkDouble = "SELECT * FROM parkingLocation AS p WHERE p.address = '$address'";
                    $result = mysqli_query($conn, $checkDouble);
                    echo mysqli_num_rows($result);
                    if (mysqli_num_rows($result) > 0){
                        echo '<script>
                        function mySubmit($val) {
                            document.getElementById("hiddenField").value = $val;
                            document.getElementById("sellerRegistration").submit();
                        }
                        mySubmit("Address Already In Use")
                        </script>';
                        $valid = false;
                    }
                
                //validate price
                //-------------------------------------------------
                $price = (float) clean($_POST['price']);
                if (is_numeric($_POST['price']) != 1 ) {
                    echo '<script>
                    function mySubmit($val) {
                    document.getElementById("hiddenField").value = $val;
                    document.getElementById("sellerRegistration").submit();
                    }
                    mySubmit("Not a valid price")
                    </script>';
                    $valid = false;
                } elseif ($price > 30.00) {
                    echo '<script>
                function mySubmit($val) {
                    document.getElementById("hiddenField").value = $val;
                    document.getElementById("sellerRegistration").submit();
                }
                mySubmit("Price exceeds maxium limit of $30 per hour")
                </script>';
                $valid = false;
                }

                
                //Validate dates
                //-------------------------------------------------
                
                $currentDate = date("Y-m-d");
                $startDate = $_POST['start'];
                $endDate = $_POST['end'];
                if ($startDate == $currentDate){
                    echo '<script>
                    function mySubmit($val) {
                        document.getElementById("hiddenField").value = $val;
                        document.getElementById("sellerRegistration").submit();
                    }
                    mySubmit("Can not open on day of registration")
                    </script>';
                    $valid = false;
                }
                if ($startDate > $endDate) {
                    echo '<script>
                    function mySubmit($val) {
                        document.getElementById("hiddenField").value = $val;
                        document.getElementById("sellerRegistration").submit();
                    }
                    mySubmit("The date it opens can not be later then the date it closes")
                    </script>';
                    $valid = false;
                }
                if ($conn -> connect_errno) {
                    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                    exit();
                }
                
                
                
                
                
            // doesn't need to be validated 
            //--------------------------------------------------------
                $dob = $_POST['date'];
               
                // if valid remained true data is added to the database
                if ($valid == true){
                    // getting form ID
                $sql = "SELECT * from applicationForm";

                if ($result = mysqli_query($conn, $sql)) {
                
                    // Return the number of rows in result set
                    $rowcount = mysqli_num_rows( $result ) + 1;
                }
                echo $data['total'];
                //adding application data to database
                $id = $_SESSION['userID'];
                $insert = "INSERT INTO applicationForm (userID, date_of_birth, password, address, zip, price, notesByRentor, active) VALUES 
                ('$id', '$dob', '$password', '$address', '$zip', '$price', '$notes', 'active')";
                if ($conn->query($insert) === TRUE) {
                    echo "New record created successfully <br>";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
                // inserting data in parkingLocation
                $lat = (double) $latitude;
                $lng = (double) $longitude;
                $insertParking = "INSERT INTO parkingLocation(ownerID, address, zip, latitude, longitude, active, price) VALUES 
                ('$id', '$address', '$zip','$lat', '$lng', 1,'$price')";
                if ($conn->query($insertParking) === TRUE) {
                    echo "New record created successfully <br>";
                } else {
                    echo "Error updating record: " . $conn->error;
                }

                //Getting the nearby locations info
                $url = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$latitude.'%2C'.$longitude.'&radius=1500&key=AIzaSyAI1WpJPgaXK2OmRntMpXkWdQVKjR7Od7U&callback=initMap';
                $response = file_get_contents($url);
                
                $dataArray = json_decode($response,true);
                foreach($dataArray['results'] as $v){
                    $name = $v['name'];
                    //print_r($name);
                    //echo "<br>";
                    $count = 0;
                    foreach($v['geometry'] as $geo){
                    // preventing bug that entered data with lat and lng as 0. How? I have no idea.
                    if (print_r($geo['lat'], true) == 0){
                        continue;
                    } else {
                        $x = print_r($geo['lat'], true);
                        $lat = (float)$x;
                        $y = print_r($geo['lng'], true);
                        $log = (float)$y;
                        // inserting it into the database
                        $query = "SELECT parkingID FROM parkingLocation AS p WHERE p.address = '$address'";
                        $result = mysqli_query($conn,$query);
                        while ($row = @mysqli_fetch_assoc($result)){
                            $id = $row['parkingID'];
                            if ($count < 2){
                            $query = "INSERT INTO nearbyLocations (nearbyID, name, longitude, latitude, listedOnSite) VALUES ($id, '$name','$log','$lat', 0)";
                            $count = $count + 1;
                            mysqli_query($conn, $query);
                            } else {
                            $query = "INSERT INTO nearbyLocations (nearbyID, name, longitude, latitude, listedOnSite) VALUES ($id, '$name','$log','$lat', 0)";
                            mysqli_query($conn, $query);
                            }
                        }
                    }

                    }  
                    
                

                }
                foreach($_POST['time'] as $times){
                    
                    $times = trim ($times,"[");
                    $times = trim ($times,"]");
                    $time = explode(",", $times);
                    $startDate = $_POST['start'];
                    $endDate = $_POST['end'];
                    $date = date_create($startDate);
                    $end = date_create($endDate);
                    while($date < $end){
                        $x = date_format($date,"Y-m-d");
                        $query = "INSERT INTO timeSlots(parkingID, startTime, endTime, dateAvaliable, status) VALUES ($id, '$time[0]', '$time[1]', '$x', 'available')";
                        mysqli_query($conn, $query);
                        date_add($date,date_interval_create_from_date_string("1 day"));
                    } 
                } 
            }
            ?>
   </form>
        <form id="editLocations" action="editLocations.php" method="post">
        <input type='hidden' id= 'locationID' name='locationID' value='' /> 
       <?php
        if($valid == true){
            $query = "SELECT parkingID FROM parkingLocation AS p WHERE p.address = '$address'";
            $result = mysqli_query($conn,$query);
              while ($row = @mysqli_fetch_assoc($result)){
                $id = $row['parkingID'];
                echo "<script>
                function mySubmit(val) {
                    document.getElementById('locationID').value = val;
                    document.getElementById('editLocations').submit();
                    
                }
                mySubmit('$id')
                </script>";
        }
    }
        ?>

        </form>
    </body>
</html>