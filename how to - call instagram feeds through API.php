<?php 
$instagram_url = "https://api.instagram.com/v1/users/self/media/recent/?access_token=3068171018.5794b3a.9be6b6caa9654286a2245e744b862dcc";

$instagram_json = file_get_contents($instagram_url);
$instagram_array = json_decode($instagram_json,true);

if(!empty($instagram_array)) {
	$i = 1;
	foreach($instagram_array['data'] as $image) {

		//echo $i;
		if( $i <= 2 ) {
			//if($image['type']=="image"){
			//echo $image['images']['standard_resolution']['url'];
			?>
			<div class="insta_div left" style="background-image: url(<?php echo $image['images']['standard_resolution']['url']; ?>);background-size:cover;" onClick="javascript:window.location='<?php echo $image['link']; ?>'">
				<span class="text_top">
					<i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('d M Y', $image['created_time']); ?>
				</span>
				<span class="text_btm">#iconichotelpenang</span>
				<img class="color_hover" src="<?php echo get_template_directory_uri(); ?>/images/insta_hover.jpg">
			</div>
			<?php //}
		}

		$i++;
	}
}
?>