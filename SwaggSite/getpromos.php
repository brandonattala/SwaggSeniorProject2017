<?php
$userId = $_GET['userId'];
$promoId = $_GET['id'];

if($promoId != '')
{
    echo file_get_contents("http://jserv.asuscomm.com/api/promotions/" . $promoId );
}
else{
    if($userId != '')
        echo json_encode( array(data=>json_decode( file_get_contents("http://jserv.asuscomm.com/api/promotions?userId=" . $userId ))));
    else echo json_encode( array(data=>json_decode( file_get_contents("http://jserv.asuscomm.com/api/promotions"))));
}


?>