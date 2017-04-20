<?php
$promoId = $_GET['id'];
$userId = $_GET['userId'];

//$ch = curl_init('http://localhost:16666/api/promotions/' . $promoId);
$ch = curl_init('http://jserv.asuscomm.com/api/promotions/' . $promoId);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_POSTFIELDS, $final_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($final_data)));
$result = json_decode(curl_exec($ch));

header("Location: MyPromos.htm?UserId=" . $userId);
?>