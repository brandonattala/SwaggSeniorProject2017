<?php
	$category = $_POST["Category"];
	$title = $_POST["Title"];
	$description = $_POST["Description"];
	$start = $_POST["Start"];
	$end = $_POST["End"];
	$picture = file_get_contents($_FILES['PromoPic']['tmp_name']);
	$picture_name = $_FILES['PromoPic']['name'];
	$files = array(array( FileName => $picture_name, FileData => base64_encode($picture)));


	$array = array(
		Title => $title, Description => $description, Start => $start,
		End => $end, Category => $category, Files => $files);

	$final_data = json_encode($array);  

	$ch = curl_init('http://jserv.asuscomm.com/api/promotions');
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $final_data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($final_data)));
	$result = json_decode(curl_exec($ch));
	
	echo '<h1>' . $result->Title . '</h1>';
	echo '<img alt="Embedded Image" src="data:image/png;base64,' . $result->Files[0]->FileData . '" />';

?>
