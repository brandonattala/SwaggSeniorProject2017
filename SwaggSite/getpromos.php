<?php
$userId = $_GET['userId'];
if($userId != '')
    echo json_encode( array(data=>json_decode( file_get_contents("http://jserv.asuscomm.com/api/promotions?userId=" . $userId ))));
else echo json_encode( array(data=>json_decode( file_get_contents("http://jserv.asuscomm.com/api/promotions"))));
?>