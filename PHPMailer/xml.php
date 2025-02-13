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


// Select all the rows in the markers table
$query = "SELECT * FROM parkingLocation WHERE active = 1";
$result = mysqli_query($conn,$query);

header("Content-type: text/xml");

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";
echo '<markers>';
$ind=0;
// Iterate through the rows, printing XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
  // Add to XML document node
  echo '<marker ';
  echo 'id="' . $row['parkingID'] . '" ';
  echo 'ownerID="$'. parseToXML($row['price']) . '" ';
  echo 'address="' . parseToXML($row['address']) . '" ';
  echo 'lat="' . $row['latitude'] . '" ';
  echo 'lng="' . $row['longitude'] . '" ';
  echo '/>';
  $ind = $ind + 1;
}

// End XML file
echo '</markers>';

?>