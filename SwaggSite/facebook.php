<?php
$userId = $_GET['userId'];

$clientSecret = "12dc857bd0f291844192658cd73d6661";
$clientId = "1096923750454328";

if ($_REQUEST["code"] == "")
{
	header(sprintf("Location: https://graph.facebook.com/oauth/authorize?client_id=%s&redirect_uri=http://localhost:46592/facebook.php/&scope=publish_actions,publish_pages,manage_pages", $clientId));
}
else
{
	$response = json_decode(file_get_contents(sprintf("https://graph.facebook.com/oauth/access_token?client_id=%s&redirect_uri=http://localhost:46592/facebook.php/&scope=publish_actions,publish_pages,manage_pages&client_secret=%s&code=%s", $clientId, $clientSecret, $_REQUEST["code"])));

	if($response->access_token == "")
	{
		// TODO Show error
	}
	else
	{
		$response = json_decode(file_get_contents(sprintf("https://graph.facebook.com/v2.8/oauth/access_token?grant_type=fb_exchange_token&client_id=%s&client_secret=%s&fb_exchange_token=%s", $clientId, $clientSecret, $response->access_token)));
		$accessToken = $response->access_token;

        $ch = curl_init('http://localhost:16666/api/users');
        //$ch = curl_init('http://jserv.asuscomm.com/api/promotions');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $final_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($final_data)));
        $result = json_decode(curl_exec($ch));
        return $result;
	}

}


?>