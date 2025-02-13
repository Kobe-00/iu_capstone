<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Testing auto complete search</title>
    <link rel="stylesheet" href="css/styles.css">
  </head>


<html>
   
  <body>
    <form action="searchResults.php" method="post">
    <input id="autocomplete" name="location" placeholder="Enter Location" type="text"/>
    <input type="submit" name="s" id="s">
    </form>
  </body>
  
   <script> 
    let autocomplete;
    function initAutocomplete(){
      autocomplete = new google.maps.places.Autocomplete(document.getElementById('autocomplete'),
      {
        types: ['establishment'],
        componentRestrictions: { country: ["US"] },
        fields: ['geometry', 'name']
      });
      autocomplete.addListenerer('place_changed', onPlaceChanged());
    }   
    function onPlaceChanged() {
      var place = autocomplete.getPlace();
        if (!place.geometry){
          document.getElementById("autocomplete").placeholder = "enter place";
        } else {
          document.getElementById("autocomplete").placeholder = place.name;
        }
      console.log(place.name)
    }
  </script> 
  <script 
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDR2MQqcW4ipUZv0scuYwparY7ySVExc1U&libraries=places&callback=initAutocomplete" async defer>
  </script>
</html>