<?php
//Get Lattitude & Longitude from ZIP code ..

$country = "Belgium";
$zip = "9000";
//$url = "http://maps.googleapis.com/maps/api/geocode/json?sensor=true&components=country:US|postal_code:90210";

$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($country)."&amp;sensor=false";
$result_string = file_get_contents($url);
$result = json_decode($result_string, true);
$shortname = $result['results'][0]['address_components'][0]['short_name'];
//echo $shortname;

$url = "http://maps.googleapis.com/maps/api/geocode/json?sensor=true&components=country:".urlencode($shortname)."|postal_code:".urlencode($zip)."";
$result_string = file_get_contents($url);
$result = json_decode($result_string, true);
if(!empty($result['status'] == "OK")){
	$result1[]=$result['results'][0];
	$result2[]=$result1[0]['geometry'];
	$result3[]=$result2[0]['location'];
	//print_r($result); //result 
	echo "<strong>Address:</strong> ".$result1[0]['formatted_address'];
	echo "<br>";
	echo "<strong>Latitude:</strong> ".$result3[0]['lat'];
	echo "<br>";
	echo "<strong>Longitude:</strong> ".$result3[0]['lng'];
}