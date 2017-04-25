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
	$files = array_filter(array(array_filter(array( FileName => $picture_name, FileData => base64_encode($picture)))));

    $array = array(
		Title => $title, Description => $description, Start => $start,
		End => $end, Category => $category, UserId => $userId, FacebookPost => $postToFacebook,  Files => $files);
	$array =array_filter( $array, "filter");

	$final_data = json_encode($array);
    //return json_encode($array);

    //$ch = curl_init('http://localhost:16666/api/promotions');
    $ch = curl_init('http://jserv.asuscomm.com/api/promotions');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $final_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($final_data)));
    $result = json_decode(curl_exec($ch));
    return $result;
?>
