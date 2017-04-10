<?php
$promoid = $_GET['id'];
if($promoid!= '')
	echo json_encode( array(data=>json_decode( file_get_contents("http://jserv.asuscomm.com/api/promotions/" . $promoid))));
?>