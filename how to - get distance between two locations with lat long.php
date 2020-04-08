<?php
//distance between two locations 

function distance($lat1, $lon1, $lat2, $lon2, $unit) {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
    return ($miles * 1.609344);
  } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
        return $miles;
      }
}


$mylocation = explode(", ", "32.9697, -96.80322"); //mine location
$other_location = explode(", ", "29.46786, -98.53506"); //other location

$distance_between_two_locations= distance($mylocation[0],$mylocation[1],$other_location[0],$other_location[1], "K");
print_r($distance_between_two_locations);

?>