<html>
<head>
	<title>Create Promotion</title>
</head>
<body>


<form action="create.php" method="post">

	<br>
	<br>
	<h3>Category</h3>
	<select name="category">
		<option value="breakfast">BREAKFAST</option>
		<option value="lunch">LUNCH</option>
		<option value="dinner">DINNER</option>
		<option value="nightlife">NIGHTLIFE</option>
		<option value="sales">SALES</option>
		<option value="local_news">LOCAL NEWS</option>
		<option value="government">GOVERNMENT</option>
		<option value="entertainment">ENTERTAINMENT</option>
		<option value="recreation">RECREATION</option>
	</select>


	<h3>Title</h3>
	<input name="title", type="text">

	<h3>Description</h3>
	<textarea name="description", rows="20", cols="80"></textarea>

	<h3>Start Date</h3>
	<input name="start", type="date", data-date-inline-picker="false", data-date-popover='{"inline": true}'>

	<h3>End Date</h3>
	<input name="end", type="date", data-date-inline-picker="false", data-date-popover='{"inline": true}'>


	<br>
	<br>

	<input type="submit">
	<a href="index.php">Cancel</a>

</form>



<?php

	$category = $_POST["category"];
	$title = $_POST["title"];
	$description = $_POST["description"];
	$start = $_POST["start"];
	$end = $_POST["end"];


	// this saves the data to a JSON file called promotion_data
	// in the same directory as the index.php file
	//
	$final_data = json_encode($_POST);  


	// this sends the JSON file to the API
	//
	$ch = curl_init('http://jserv.asuscomm.com/api/promotions');
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $final_data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($final_data)));
	$result = curl_exec($ch);

?>

</body>
</html>