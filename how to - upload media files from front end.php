<?php
//how to upload media files from front end
require_once(ABSPATH . "wp-admin" . '/includes/image.php');
require_once(ABSPATH . "wp-admin" . '/includes/file.php');
require_once(ABSPATH . "wp-admin" . '/includes/media.php');

//Upload featured image / attachment
if($_FILES['company_logo']['size'] != 0){
	$company_logo = 'company_logo';
	$set_profile_image = media_handle_upload( $company_logo, $update_query );
	//set_post_thumbnail( $update_query, $set_profile_image );
	$set_profile_image = wp_get_attachment_url($set_profile_image);
	update_post_meta($update_query, "company_logo", $set_profile_image);
}