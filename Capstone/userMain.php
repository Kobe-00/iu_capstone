<?php session_start();?>

<!DOCTYPE html>
<html>
    <head>
        <title>User Main</title>

        <!-- Stylesheets -->
		<link rel="stylesheet" href="css/styles.css">
    </head>
    <body style="background-image: url(images/usermain_background1.png);  background-size: 100vh; 
  background-position: top  right -40px;
  background-repeat: no-repeat;">
        <?php include('includes/header.php'); ?>



        <main>

        <div style="display:flex; margin:5.0em auto;">
        <!-- <form id="geo" name="geo" action="map.php" method="post">
            <input id="address" name="address" type="text"/> 
            <input type="submit" value="Search">
        </form> -->
        
       
            <form id="geo" name="geo" action="map.php" method="post">
              <div style=" border:1px solid #ddd; border-radius:30px;   -webkit-box-shadow: 0px 0px 15px 0px rgba(222,222,222,1);
                -moz-box-shadow: 0px 0px 15px 0px rgba(222,222,222,1);
                box-shadow: 0px 0px 15px 0px rgba(222,222,222,1); width:55vw; padding:0.75em 2.0em; position:relative;"
                class="input-group">
                <img style="position:absolute; left:1; top: 0.80em;margin-right:1.0em; width:22px;"
                src="images/search.png" alt="Search">
                <input style="border:none; color:#31302F; margin-left:3.0em; font-size:16px; padding:0;width: 600px;height:25px;"
                id="address" name="address" type="text"  
                placeholder="Enter a location" class="form-control" 
                onkeydown="if (event.keyCode == 13) { this.form.submit(); return false; }"/>
              </div>
            
            <!-- <div style="display:flex; justify-contents: center;">
              <p style="padding-top:3.0em; font-size:16px; font-weight:bold;color:#31302F; line-height:20px;">
              <img style="width:22px; margin-right:0.5em; vertical-align: text-top;"src="images/pointer.png">More Parking Spaces: Find available parking spots easily with our service.
              <br><br><img style="width:22px; margin-right:0.5em; vertical-align: text-top;"src="images/pointer.png">Various Filter Options: Customize your search results with multiple filtering options.
              <br><br><img style="width:22px; margin-right:0.5em; vertical-align: text-top;"src="images/pointer.png">Convenient Parking Rentals: Rent a parking spot quickly and easily with our service.</p>

            </div> -->
            <div style="display:flex; justify-contents: center;">
              <div class="dropdown">
                <button class="dropbtn" disabled>
                  <img src="images/pointer.png">MORE PARKING SPACES
                </button>
                <div class="dropdown-content">
                  <p>Find available parking spots easily with our service.</p>
                </div>
              </div>
              <div class="dropdown">
                <button class="dropbtn" disabled>
                  <img src="images/pointer.png">VARIOUS FILTER OPTIONS
                </button>
                <div class="dropdown-content">
                  <p>Customize your search results with multiple filtering options.</p>
                </div>
              </div>
              <div class="dropdown">
                <button class="dropbtn" disabled>
                  <img src="images/pointer.png">CONVENIENT PARKING RENTAL
                </button>
                <div class="dropdown-content">
                  <p>Rent a parking spot quickly and easily with our service.</p>
                </div>
              </div>
            </div>
              <!-- <div class="dropdown" style="margin-top:5.0em;">
              <button class="dropbtn" disabled>
                <img src="images/description.png">DESCRIPTIONS
              </button>
              <div class="dropdown-content_d">
              <p>The goal of this project is to solve the parking crisis found around town. There are often too many cars but insufficient parking for everyone, especially in more crowded areas like IU. There is little space available to make many more public parking areas, and building new ones would be costly. That is why our plan is to make a service for individuals to buy and rent parking on private properties. This would help communities make more use of the space as most people, with access to private parking, usually have more than they need for the number of cars they own. This not only provides additional parking but also allows landowners to make extra money on the side. </p>
              </div>
              </div> -->

                <div style="margin-top:5.0em; width:50%; line-height:1.25em;">
                  <button class="dropbtn" disabled>
                    <img src="images/description.png">DESCRIPTIONS
                  </button>
                  <div>
                    <p>The goal of this project is to solve the parking crisis found around town. 
                      There are often too many cars but insufficient parking for everyone, especially 
                      in more crowded areas like IU. There is little space available to make many more 
                      public parking areas, and building new ones would be costly. That is why our plan 
                      is to make a service for individuals to buy and rent parking on private properties. 
                      This would help communities make more use of the space as most people, with access 
                      to private parking, usually have more than they need for the number of cars they own. 
                      This not only provides additional parking but also allows landowners to make extra money on the side. </p>
                  </div>  
                </div>
              
 
            </form>




 
        </div>
        </main>
        <!-- <div id="map_1"></div> -->
    </body>

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
        var map = new google.maps.Map(document.getElementById('map_1'), {
          center: new google.maps.LatLng( 39.168, -86.520),
          zoom: 16
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
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
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
      let autocomplete;
      function initAutocomplete(){
        autocomplete = new google.maps.places.Autocomplete(document.getElementById('address'));
        autocomplete.addListenerer('place_changed', onPlaceChanged());
      }   
      function onPlaceChanged() {
        var place = autocomplete.getPlace();
          if (!place.geometry){
            document.getElementById("address").placeholder = "Enter a Location";
          } else {
            document.getElementById("address").placeholder = place.name;
          }
        console.log(place.name)
      }
    </script>
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAI1WpJPgaXK2OmRntMpXkWdQVKjR7Od7U&callback=initMap" async></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAI1WpJPgaXK2OmRntMpXkWdQVKjR7Od7U&libraries=places&callback=initAutocomplete" async defer></script>


</html>