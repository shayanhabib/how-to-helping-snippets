<?php  //convert image to base64
$path = 'mobile.png';
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
echo $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
?>