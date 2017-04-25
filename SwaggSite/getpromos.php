<?php
$userId = $_GET['userId'];
$promoId = $_GET['id'];
//$baseurl = "localhost:16666";
$baseurl = "jserv.asuscomm.com";

if($promoId != '')
{
    echo file_get_contents("http://". $baseurl . "/api/promotions/" . $promoId );
}
else{
    if($userId != '')
        echo json_encode( array(data=>json_decode( file_get_contents("http://". $baseurl . "/api/promotions?userId=" . $userId ))));
    else echo json_encode( array(data=>json_decode( file_get_contents("http://". $baseurl . "/api/promotions"))));
}


?>