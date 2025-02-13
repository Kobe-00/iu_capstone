<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Testing auto complete search</title>
    <link rel="stylesheet" href="css/styles.css">
  </head>
<html>

    <body>
    <?php 
        // function to geocode address, it will return false if unable to geocode address
        function geocode($address){
        
            // url encode the address
            $address = urlencode($address);
            
            // google map geocode api url
            $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyAI1WpJPgaXK2OmRntMpXkWdQVKjR7Od7U";
        
            // get the json response
            $resp_json = file_get_contents($url);
            
            // decode the json
            $resp = json_decode($resp_json, true);
        
            // response status will be 'OK', if able to geocode given address 
            if($resp['status']=='OK'){
        
                // get the important data
                $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
                $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
                $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
                
                // verify if data is complete
                if($lati && $longi && $formatted_address){
                
                    // put the data in the array
                    $data_arr = array();            
                    
                    array_push(
                        $data_arr, 
                            $lati, 
                            $longi, 
                            $formatted_address
                        );
                    
                    return $data_arr;
                    
                }else{
                    return false;
                }
                
            }
        
            else{
                // echo "<strong>ERROR: {$resp['status']}</strong>";
                return false;
            }
        }
        if($_POST){
 
            // get latitude, longitude and formatted address
            $data_arr = geocode($_POST['address']);
         
            // if able to geocode the address
            if($data_arr){
                 
                $latitude = $data_arr[0];
                $longitude = $data_arr[1];
                $formatted_address = $data_arr[2];
                //echo $latitude;
                //echo $longitude;
            }
        }
                             

    ?>
<!--     <form action="" method="post">
    <input type='text' name='address' placeholder='Enter any address here' />
    <input type='submit' value='Geocode!' /> -->
    </form>
    </body>
    
    <script 
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAI1WpJPgaXK2OmRntMpXkWdQVKjR7Od7U" async defer>
    </script>
    </html>
