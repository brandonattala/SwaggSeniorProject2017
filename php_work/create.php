<html>
<head>

	<!--things required for picture preview-->
	<!---->
	<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
	<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
	<meta charset=utf-8 />


	<!--javaScript to display picture preview-->
	<!---->
	<script type="text/javaScript">     
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('#blah')
						.attr('src', e.target.result)
						.width(200)
						.height(180);
				};

				reader.readAsDataURL(input.files[0]);
			}
		}
	</script>

	<title>Create Promotion</title>
</head>
<body>


<form action="create.php", method="post", enctype="multipart/form-data">

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

	<h3>Image Upload</h3>
	<input type="file", name="picture", id="picture", accept="image/*", onchange="readURL(this);">
		<img id="blah" src="#" alt="your image" />

	<h3>Start Date</h3>
	<input name="start", type="date", data-date-inline-picker="false", data-date-popover='{"inline": true}'>

	<h3>End Date</h3>
	<input name="end", type="date", data-date-inline-picker="false", data-date-popover='{"inline": true}'>


	<br>
	<br>

	<input type="submit" name="check_submit">
	<a href="index.php">Cancel</a>


</form>



<?php
	$category = $_POST["category"];
	$title = $_POST["title"];
	$description = $_POST["description"];
	$start = $_POST["start"];
	$end = $_POST["end"];
	$picture = file_get_contents($_FILES['picture']['tmp_name']);
	$picture_name = $_FILES['picture']['name'];
	$files = array(array( FileName => $picture_name, FileData => base64_encode($picture)));


	$array = array(
		Title => $title, Description => $description, Start => $start,
		End => $end, Category => $category, Files => $files);



	// this saves the data to a JSON file called promotion_data
	// in the same directory as the index.php file

	$final_data = json_encode($array);  

	echo $final_data;

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
