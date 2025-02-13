<?php
require('adminphp.php');

$maintenant = time();
$maintenant = date ("Y/m/d", time());
$PushingBox = urlencode($PushingBox);
$PushingBoxTitre1 = urlencode($PushingBoxTitre1);
$PushingBoxTitre2 = urlencode($PushingBoxTitre2);
$PushingBoxTitre3 = urlencode($PushingBoxTitre3);
$PushingBoxMsg1 = urlencode($PushingBoxMsg1);
$PushingBoxMsg2 = urlencode($PushingBoxMsg2);
$PushingBoxMsg3 = urlencode($PushingBoxMsg3);
//echo "$maintenant - $regulier - $info - $PushingBoxTitre1 - $PushingBoxMsg1 - $PushingBox";


if ($info==1){
if ($maintenant==$regulier){
$url = "http://api.pushingbox.com/pushingbox?devid=$PushingBox&titre=$PushingBoxTitre1&msg=$PushingBoxMsg1";
$ch = curl_init($url);
    echo $url;
curl_exec($ch);
curl_close($ch);
}

if ($maintenant==$mensuel){
$ch = curl_init("http://api.pushingbox.com/pushingbox?devid=$PushingBox&titre=$PushingBoxTitre2&msg=$PushingBoxMsg2");
curl_exec ($ch);
curl_close ($ch);
}

if ($maintenant==$annuel){
$ch = curl_init("http://api.pushingbox.com/pushingbox?devid=$PushingBox&titre=$PushingBoxTitre3&msg=$PushingBoxMsg3");
curl_exec ($ch);
curl_close ($ch);
}
}
?>