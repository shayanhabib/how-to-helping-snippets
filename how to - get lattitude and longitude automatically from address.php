<?php 
$address = "6641 Avon Belden Rd";
$prepAddr = str_replace(' ','+',$address);
$geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?key=AIzaSyAEDq8M6WsXVmo_08lPapjlqYCFVRBt6ro&address='.$prepAddr);
$output= json_decode($geocode);
//var_dump($output);
$latitude = $output->results[0]->geometry->location->lat;
$longitude = $output->results[0]->geometry->location->lng;

echo "latitude - ".$latitude;
echo "longitude - ".$longitude;


////another way


$prepAddr = str_replace( ' ','+', trim($address) );
$geocode = 'https://maps.google.com/maps/api/geocode/json?key=AIzaSyAEDq8M6WsXVmo_08lPapjlqYCFVRBt6ro&address='.$prepAddr;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $geocode);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$responseJson = curl_exec($ch);
curl_close($ch);
$response = json_decode($responseJson);
$latitudee = "";
$longitudee = "";
if ( $response->status == 'OK' ) {
	//var_dump($response);
    $latitudee = $response->results[0]->geometry->location->lat;
    $longitudee = $response->results[0]->geometry->location->lng;
}