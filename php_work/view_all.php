<!DOCTYPE html>
<html>
<head>
	<title>View Promotions</title>
</head>
<body>


	<?php 


		// this receiver the JSON file to the API
		//
		$ch = curl_init('http://jserv.asuscomm.com/api/promotions');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		$result = curl_exec($ch);

		$result = json_decode($result, TRUE);

		// echo "<pre>"; print_r($result);
	?>

	<h3>PROMOTIONS</h3>
	<table border="1">
		<th>Title</th>
		<th>Description</th>
		
		<?php

			// this loops through the array and creates a column for titles & descriptions
			foreach ($result as $a) {
				echo "<tr><td>" . $a[Title] . "</td>" . 
						"<td>" . $a[Description] . "</td></tr>";
			}
		?>

	</table>


</body>
</html>