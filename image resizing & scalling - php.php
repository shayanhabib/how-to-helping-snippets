<?php 
function load_image($filename, $type) {
    if( $type == IMAGETYPE_JPEG ) {
        $image = imagecreatefromjpeg($filename);
    }
    elseif( $type == IMAGETYPE_PNG ) {
        $image = imagecreatefrompng($filename);
    }
    elseif( $type == IMAGETYPE_GIF ) {
        $image = imagecreatefromgif($filename);
    }
    return $image;
}

function resize_image($new_width, $new_height, $image, $width, $height) {
    $new_image = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    return $new_image;
}

function resize_image_to_width($new_width, $image, $width, $height) {
    $resize_ratio = $new_width / $width;
    $new_height = $height * $resize_ratio;
    return resize_image($new_width, $new_height, $image, $width, $height);
}

function resize_image_to_height($new_height, $image, $width, $height) {
    $ratio = $new_height / $height;
    $new_width = $width * $ratio;
    return resize_image($new_width, $new_height, $image, $width, $height);
}

function scale_image($scale, $image, $width, $height) {
    $new_width = $width * $scale;
    $new_height = $height * $scale;
    return resize_image($new_width, $new_height, $image, $width, $height);
}

function save_image($new_image, $new_filename, $new_type='jpeg', $quality=80) {
    if( $new_type == 'jpeg' ) {
        imagejpeg($new_image, $new_filename, $quality);
     }
     elseif( $new_type == 'png' ) {
        imagepng($new_image, $new_filename);
     }
     elseif( $new_type == 'gif' ) {
        imagegif($new_image, $new_filename);
     }
}


/* Testing the above code */
$filename = "./wallpapers/skyline.jpg";
list($width, $height, $type) = getimagesize($filename);
$old_image = load_image($filename, $type);

$new_image = resize_image(450, 560, $old_image, $width, $height);
$image_width_fixed = resize_image_to_width(560, $old_image, $width, $height);
$image_height_fixed = resize_image_to_height(900, $old_image, $width, $height);
$image_scaled = scale_image(0.8, $old_image, $width, $height);

save_image($new_image, './wallpapers/resized-'.basename($filename), 'jpeg', 75);
save_image($image_width_fixed, './wallpapers/fixed-width-'.basename($filename), 'jpeg', 75);
save_image($image_height_fixed, './wallpapers/fixed-height-'.basename($filename), 'jpeg', 75);
save_image($image_scaled, './wallpapers/scaled-'.basename($filename), 'jpeg', 75);