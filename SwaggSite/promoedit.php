<?php

function filter($var){
    return $var != "" && $var != null;
}
header("content-type:application/json");

$category = $_POST["Category"];
$title = $_POST["Title"];
$description = $_POST["Description"];
$start = $_POST["Start"];
$end = $_POST["End"];
$userId = $_POST["userId"];
$picture = file_get_contents($_FILES['PromoPic']['tmp_name']);
$picture_name = $_FILES['PromoPic']['name'];
$postToFacebook = $_POST["postToFacebook"];
$promoId = $_POST["PromotionId"];
$fileId = $_POST["FileUploadId"];
$currentFileName = $_POST["FileName"];
$currentFileData = $_POST["FileData"];

$files = array_filter(array(array_filter(array( FileName => $picture_name == "" ? $currentFileName : $picture_name, FileUploadId=>$fileId, FileData => $picture == null ? $currentFileData : base64_encode($picture)))));

$array = array(PromotionId => $promoId,
    Title => $title, Description => $description, Start => $start,
    End => $end, Category => $category, UserId => $userId, FacebookPost => $postToFacebook,  Files => $files);
$array =array_filter( $array, "filter");

$final_data = json_encode($array);

//$ch = curl_init('http://localhost:16666/api/promotions/' . $promoId);
$ch = curl_init('http://jserv.asuscomm.com/api/promotions/' . $promoId);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, $final_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($final_data)));
$result = json_decode(curl_exec($ch));

return $result;
?>
