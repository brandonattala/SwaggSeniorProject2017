<?php
header("content-type:application/json");

$promoid = $_GET['id'];

$category = $_POST["PromoCat"];
$title = $_POST["PromoTitle"];
$description = $_POST["PromoDetail"];
$start = $_POST["PromoStart"];
$end = $_POST["PromoEnd"];
$userId = $_POST["userId"];

$final_data = json_encode($array);

$ch = curl_init('http://jserv.asuscomm.com/api/promotions'. $promoid);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $final_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($final_data)));
$result = json_decode(curl_exec($ch));

?>
