<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Map</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>

      /* CSS in map.php  */
      /* Modal styling */
      .modal {
        transition-delay:0.4s;
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 25%;
        height: 80%;
        margin-top:14.3vh;
        overflow: auto;
        background-color: rgba(245, 245, 245, 1);
        -webkit-box-shadow: 0px 0px 6px 0px rgba(235,235,235,0.74);
        -moz-box-shadow: 0px 0px 6px 0px rgba(235,235,235,0.74);
        box-shadow: 0px 0px 6px 0px rgba(235,235,235,0.74);
            margin-left:39.75vw;
        padding:2.0em 2.0em;
      }
      .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        width: 80%;
        
      }
      .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
      }
      .close:hover,
      .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
      }
      /* scroller */
      .scroller {
        width: 36.25vw;
        height: 550px;
        scrollbar-width: thin;
        scrollbar-color: #ababab #f5f5f5;
        overflow-x: hidden;
        overflow-y: auto;
        position:relative;
        margin-left:0.5em;
        padding-left:0.5em;
      }
      ::-webkit-scrollbar {
        width: 10px;
      }
      ::-webkit-scrollbar-thumb {
        background-color: #ababab;
        border-radius: 10px;
        border: 2px solid #ffffff;
      }
      .sort {
        border: 1px solid #e63946;
        background-color: white;
        color: #e63946;
        width: 300px; 
        align-self: end;
        margin-right: 1.0em;
        font-size: 13px;
        font-family: pretendard, sans-serif;
        border-radius: 5px;
        text-decoration: none;
        padding: 3px;

      }

      .sort:hover{
        border: 1px solid #e63946;
        background-color: #e63946;
        color: white;
        width: 300px; 
        align-self: end;
        margin-right: 1.0em;
        font-size: 13px;
        font-family: pretendard, sans-serif;
        border-radius: 5px;
        text-decoration: none;
        padding: 3px;

      }
      .review {
        margin: auto;
        margin-left: 280px;
        background: white;
        text-decoration: none;
        font-weight: 600;
        color: #E63946;
        font-size: 17px;
      }

      .review:hover{
        margin: auto;
        margin-left: 280px;
        background: white;
        text-decoration: underline;
        font-weight: 600;
        color: blue;
        font-size: 17px;
      }

      /* ::-webkit-scrollbar-track {
        background: #f5f5f5;
      } */
      <?php include('includes/header.php'); ?>
    </style>
  </head>

<html>
  <body style="color:#31302F;">

    <nav id = "menu">
      <br>
      <form method="post">
        <input type="hidden" id="filter" name="filter" value="distance">
        <?php 
          $address = $new_str = str_replace(' ', '',$_POST['address']);
          echo "<input type='hidden' id='address' name='address' value=$address>" 
        ?>
        <input type="submit" value="Sort by Distance (Closest to Farthest/Default)" class ="sort">

      </form>

      <form method="post">
        <input type="hidden" id="filter" name="filter" value="priceLowHigh">
        <?php 
          $address = $new_str = str_replace(' ', '',$_POST['address']);
          echo "<input type='hidden' id='address' name='address' value=$address>" 
        ?>
        <input type="submit" value="Sort by Price (Lowest to Highest)" class ="sort">
      </form>


      <form method="post">
        <input type="hidden" id="filter" name="filter" value="dateTime">
        <input type="date" id="date" name="date" min="<?echo date('Y-m-d');?>">
        <select id="time" name="time">
                        <option value="1:00,2:00">1:00-2:00</option>
                        <option value="2:00,3:00">2:00-3:00</option>
                        <option value="3:00,4:00">3:00-4:00</option>
                        <option value="4:00,5:00">4:00-5:00</option>
                        <option value="5:00,6:00">5:00-6:00</option>
                        <option value="6:00,7:00">6:00-7:00</option>
                        <option value="7:00,8:00">7:00-8:00</option>
                        <option value="8:00,9:00">8:00-9:00</option>
                        <option value="9:00,10:00">9:00-10:00</option>
                        <option value="10:00,11:00">10:00-11:00</option>
                        <option value="11:00,12:00">11:00-12:00</option>
                        <option value="12:00,13:00">12:00-13:00</option>
                        <option value="13:00,14:00">13:00-14:00</option>
                        <option value="14:00,15:00">14:00-15:00</option>
                        <option value="15:00,16:00">15:00-16:00</option>
                        <option value="16:00,17:00">16:00-17:00</option>
                        <option value="17:00,18:00">17:00-18:00</option>
                        <option value="18:00,19:00">18:00-19:00</option>
                        <option value="19:00,20:00">19:00-20:00</option>
                        <option value="20:00,21:00">20:00-21:00</option>
                        <option value="21:00,22:00">21:00-22:00</option>
                        <option value="22:00,23:00">22:00-23:00</option>
                        <option value="23:00,24:00">23:00-24:00</option>
                        <option value="24:00,1:00">24:00-1:00</option>
                      </select>
        <?php 
          $address = $new_str = str_replace(' ', '',$_POST['address']);
          echo "<input type='hidden' id='address' name='address' value=$address>" 
        ?>
        <input type="submit" value="Search by Date and Time">
      </form>


    <?php 
      require("db.php");
      require("geocode.php");
          function parseToXML($htmlStr)
          {
          $xmlStr=str_replace('<','&lt;',$htmlStr);
          $xmlStr=str_replace('>','&gt;',$xmlStr);
          $xmlStr=str_replace('"','&quot;',$xmlStr);
          $xmlStr=str_replace("'",'&#39;',$xmlStr);
          $xmlStr=str_replace("&",'&amp;',$xmlStr);
          return $xmlStr;
          }
          echo "<ul>";
          $data_arr = geocode($_POST['address']);
          if($data_arr){
                 
            $latitude = $data_arr[0];
            $longitude = $data_arr[1];
            $formatted_address = $data_arr[2];
            $address = $_POST['address'];
        }
        // echo the values as hidden values to use 
        echo " <input type='hidden' id='latitude' name='latitude' value='$latitude'>";
        echo " <input type='hidden' id='longitude' name='longitude' value='$longitude'>";
        echo " <input type='hidden' id='address' name='address' value='$address'>";
          // Select all the rows in the markers table


            // create a table to store the mahattan distances for each location
            $latLonSizeArray = [];
            ?><div class="scroller"><?
            $query = "SELECT * FROM parkingLocation";
            $result = mysqli_query($conn,$query);	
            
            $filter = $_POST['filter'];
            
            if ($filter == 'priceLowHigh'){
  
              $query = "SELECT * FROM parkingLocation WHERE active = 1 ORDER BY price ASC";
              $result = mysqli_query($conn,$query);
              while ($row = @mysqli_fetch_assoc($result)){     
                  
                echo '      
                  <div style="margin-right:3.0em;display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline; align-content: stretch;">
                    <p style="font-size:20px;">'.$row['address'].'</p>
                    <p>$&nbsp'.$row['price'].'</p>
                  </div>
                    <input type="hidden" id="parkingID" name="parkingID" value="'.$row['parkingID'].'"> 
                    <button style="float:right; margin-right:3.0em; border: 1px solid #E63946; border-radius:15px; color:#E63946; background-color:white; padding:0.5em 1.0em;" class="view-details" onclick="showModal('.$row['parkingID'].')" type="button">DETAILS</button>
                  
                  <div style="border: 1px solid #F5F5F5; margin:3.0em 0 1.5em 0; width:36vw;"></div>
                  ';
                
              }
  
            } elseif ($filter == 'dateTime'){
                $times = $_POST['time'];
                $time = explode(",", $times);
                $date = $_POST['date'];
                $query = "SELECT parkingID FROM timeSlots WHERE startTime = '$time[0]' AND endTime = '$time[1]' AND dateAvaliable = '$date'";
                if (!mysqli_query($conn, $query)) {
                  echo("Error description: " . mysqli_error($conn));
                } 
                $result = mysqli_query($conn,$query);
                while ($row = @mysqli_fetch_assoc($result)){
                  $id = $row['parkingID'];
                  $query = "SELECT * FROM parkingLocation WHERE parkingID = $id";
                  if (!mysqli_query($conn, $query)) {
                    echo("Error description: " . mysqli_error($conn));
                  } 
                  $result2 = mysqli_query($conn,$query);
                  while ($row2 = @mysqli_fetch_assoc($result2)){                           
                    echo '      
                      <div style="margin-right:3.0em;display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline; align-content: stretch;">
                        <p style="font-size:20px;">'.$row2['address'].'</p>
                        <p>$&nbsp'.$row2['price'].'</p>
                      </div>
                        <input type="hidden" id="parkingID" name="parkingID" value="'.$row2['parkingID'].'"> 
                        <button style="float:right; margin-right:3.0em; border: 1px solid #E63946; border-radius:15px; color:#E63946; background-color:white; padding:0.5em 1.0em;" class="view-details" onclick="showModal('.$row['parkingID'].')" type="button">DETAILS</button>
                      
                      <div style="border: 1px solid #F5F5F5; margin:3.0em 0 1.5em 0; width:36vw;"></div>
                      ';
                  }
                }
            } else { 

            while($row = $result->fetch_array())  {
              $distance = sqrt((floatval($row['latitude']) - $latitude) ** 2 +  ((floatval($row['longitude']) - $longitude  ) ** 2));
              if ($row["active"]==0){
                continue;
              } else {
                $latLonSizeArray[$row["parkingID"]] = $distance;
              }
            }
            // sort table from smallest to largest
            asort($latLonSizeArray);
            foreach($latLonSizeArray as $key => $val) {
              //create each form in inorder from shortest to longest
              $query = "SELECT * FROM parkingLocation WHERE parkingID = $key";
              $result = mysqli_query($conn,$query);
              // while ($row = @mysqli_fetch_assoc($result)){           
              //   echo '<li><form action="location.php" method="post">'.$row['address'].'<br>'
              //   .$row['price'].'<br>
              //   <input type="hidden" id="parkingID" name="parkingID" value="'.$row['parkingID'].'"> <input type="submit"></form></li>';
              // }
             
              // Create view detail button to pop up modal
              while ($row = @mysqli_fetch_assoc($result)){     
                
                  echo '      
                    <div style="margin-right:3.0em;display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline; align-content: stretch;">
                      <p style="font-size:20px;">'.$row['address'].'</p>
                      <p>$&nbsp'.$row['price'].'</p>
                    </div>
                      <input type="hidden" id="parkingID" name="parkingID" value="'.$row['parkingID'].'"> 
                      <button style="float:right; margin-right:3.0em; border: 1px solid #E63946; border-radius:15px; color:#E63946; background-color:white; padding:0.5em 1.0em;" class="view-details" onclick="showModal('.$row['parkingID'].')" type="button">DETAILS</button>
                    
                    <div style="border: 1px solid #F5F5F5; margin:3.0em 0 1.5em 0; width:36vw;"></div>
                    ';
                  
                }
                
            }
            ?></div><?
          
            
            echo "</ul>"; 
          }
    
          
     ?>


    </nav>
    <!-- create Where the map goes-->
    <div id="map"></div>

    <script>
      var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };
        
        function initMap() {   
        var latlng = new google.maps.LatLng(+document.getElementById('latitude').value, +document.getElementById('longitude').value);
        var map = new google.maps.Map(document.getElementById('map'), {
          center: latlng,
          zoom: 12
        });
        var latlng = new google.maps.LatLng(+document.getElementById('latitude').value, +document.getElementById('longitude').value);
        new google.maps.Marker({
        position: latlng,
        map,
        title: document.getElementById('address').value,
        });
        var infoWindow = new google.maps.InfoWindow;

          downloadUrl('https://cgi.luddy.indiana.edu/~hshinkle/xml.php', function(data) {
            var xml = data.responseXML;
            
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('id');
              var name = markerElem.getAttribute('ownerID');
              var address = markerElem.getAttribute('address');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                icon: iconBase + "parking_lot_maps.png"
              });
              // Hopping animation when icon image is clicked
              // Displaing modal when icon image is double clicked
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
                marker.setAnimation(google.maps.Animation.BOUNCE);
                setTimeout(function() {
                  marker.setAnimation(null);
                }, 750);
                marker.addListener('dblclick', function() {
                  showModal(id);
                });

              });
            });
          });
        }



      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }
      


      function doNothing() {}

    </script>
    <script>
      // Link to location.php to fetch items in location.php
      function showModal(parkingID) {
        var modal = document.getElementById("myModal");
        modal.style.display = "block";
        
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            modal.innerHTML = xhr.responseText;
          }
        };
        xhr.open("GET", "location.php?parkingID=" + parkingID, true);
        xhr.send();

        window.onclick = function(event) {
          if (event.target == modal) {
            modal.style.display = "none";
          }
        }
        var map = document.getElementById("map");
        map.onclick = function() {
          modal.style.display = "none";
        }
      }






  </script>
      
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAI1WpJPgaXK2OmRntMpXkWdQVKjR7Od7U&callback=initMap" async>
    </script>
          <a href="viewAllReviews.php" style="width:150px;" class ="review">View Reviews</a>


          <!-- Fetch data from location.php -->
          <div id="myModal" class="modal">
            <div class="modal-content">
              <span class="close">&times;

              </span>
            </div>
          </div>

    
        
            
              
                

              
          
  </body>

</html>