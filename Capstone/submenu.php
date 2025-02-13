<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Testing inner menu</title>
    <link rel="stylesheet" href="css/styles.css">
  </head>

<html>

  <body>
    <nav>
    <?php 
    require("db.php");
        function parseToXML($htmlStr)
        {
        $xmlStr=str_replace('<','&lt;',$htmlStr);
        $xmlStr=str_replace('>','&gt;',$xmlStr);
        $xmlStr=str_replace('"','&quot;',$xmlStr);
        $xmlStr=str_replace("'",'&#39;',$xmlStr);
        $xmlStr=str_replace("&",'&amp;',$xmlStr);
        return $xmlStr;
        }

        echo($_GET["address"]);
        $query = "SELECT * FROM parkingLocation";
        $result = mysqli_query($conn,$query);
        echo '<ul>';
        
        while ($row = @mysqli_fetch_assoc($result)){
          
          echo '<li><form action="location.php" method="post">'.$row['address'].'<br>'
          .$rouw['price'].'<br>
          <input type="hidden" id="parkingID" name="parkingID" value="'.$row['parkingID'].'"> <input type="submit"></form></li>';
        }
        echo "</ul>";
        echo($_REQUEST["latLon"]);
        
        
     ?>
    
    
    
    </nav>
    <script>
      var latLon = sessionStorage.getItem("latLon")
      console.log(latLon)
    </script>
  </body>
</html>