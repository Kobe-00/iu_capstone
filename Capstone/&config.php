<?php

 
define('PAYPAL_ID', 'Ado01vZxZvJ2OT9n83iGj15hnAh-j5pLXh-3jHJTw_4QJqm7c4I9RJZ38m7PIl6HOUVTScCLQvhYHKCH');
define('PAYPAL_SANDBOX',TRUE);


define('CLIENT_SECRET', 'EB5nw2Enfo9cNTLxcPnJ4OioY0a1uZawCN5i1yPk63LD_fgGyrIbaFFYZrbVBAUnHnUjel-AQtDN38aI');
 
define('PAYPAL_RETURN_URL', '&success.php');
define('PAYPAL_CANCEL_URL', '&cancel.php');
define('PAYPAL_NOTIFY_URL', '&ipn.php')
define('PAYPAL_CURRENCY', 'USD'); // set your currency here

define('DB_HOST', 'db.luddy.indiana.edu'); 
define('DB_USERNAME', 'i494f22_team45'); 
define('DB_PASSWORD', 'my+sql=i494f22_team45'); 
define('DB_NAME', 'i494f22_team45'); 
 
$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId(CLIENT_ID);
$gateway->setSecret(CLIENT_SECRET);
$gateway->setTestMode(true); //set it to 'false' when go live

?>