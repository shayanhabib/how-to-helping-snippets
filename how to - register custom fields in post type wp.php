<?php //how to register custom fields in post type wp 
//Register Meta Box for team members
add_action( 'add_meta_boxes', 'register_meta_box_team');
function register_meta_box_team() {
    add_meta_box( 'contact_info', esc_html__( 'Contact Information', 'text-domain' ), 'meta_box_callback_team', 'teampt', 'advanced', 'high' );
    add_meta_box( 'social_profiles', esc_html__( 'Social Profiles', 'text-domain' ), 'meta_box_callback_team_social', 'teampt', 'advanced', 'high' );
    add_meta_box( 'secretary_profiles', esc_html__( 'Secretary Profile', 'text-domain' ), 'meta_box_callback_team_secretary', 'teampt', 'advanced', 'high' );
}

//Add meta box for team members
function meta_box_callback_team() {
 	global $post;
	
	// Noncename needed to verify where the data originated
    echo '<input type="hidden" name="teammeta_noncename" id="teammeta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />'; 
	
	$member_tagline = get_post_meta($post->ID, "member_tagline", true);
	$member_expertise = get_post_meta($post->ID, "member_expertise", true);
	$member_sector = get_post_meta($post->ID, "member_sector", true);
	$member_designation = get_post_meta($post->ID, "member_designation", true);
	$member_department = get_post_meta($post->ID, "member_department", true);
	$member_location = get_post_meta($post->ID, "member_location", true);
	$member_phone = get_post_meta($post->ID, "member_phone", true);
	$member_mobile = get_post_meta($post->ID, "member_mobile", true);
	$member_fax = get_post_meta($post->ID, "member_fax", true);
	$member_email = get_post_meta($post->ID, "member_email", true);

	echo "<p><input type='text' name='member_tagline' style='width:300px;' placeholder='Tagline' value='".$member_tagline."' /></p>";
	echo "<p><input type='text' name='member_expertise' style='width:300px;' placeholder='Expertise' value='".$member_expertise."' /></p>";
	echo "<p><input type='text' name='member_sector' style='width:300px;' placeholder='Sector' value='".$member_sector."' /></p>";
	echo "<p><input type='text' name='member_designation' style='width:300px;' placeholder='Designation' value='".$member_designation."' /></p>";
	echo "<p><input type='text' name='member_department' style='width:300px;' placeholder='Department' value='".$member_department."' /></p>";
	echo "<p><input type='text' name='member_location' style='width:300px;' placeholder='Location' value='".$member_location."' /></p>";
	echo "<p><input type='text' name='member_phone' style='width:300px;' placeholder='Phone No.' value='".$member_phone."' /></p>";
	echo "<p><input type='text' name='member_mobile' style='width:300px;' placeholder='Mobile No.' value='".$member_mobile."' /></p>";
	echo "<p><input type='text' name='member_fax' style='width:300px;' placeholder='Fax No.' value='".$member_fax."' /></p>";
	echo "<p><input type='text' name='member_email' style='width:300px;' placeholder='E-mail' value='".$member_email."' /></p>";
}

function meta_box_callback_team_social() {
 	global $post;
	
	// Noncename needed to verify where the data originated
    echo '<input type="hidden" name="teammeta_noncename" id="teammeta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />'; 
	
	$member_facebook = get_post_meta($post->ID, "member_facebook", true);
	$member_twitter = get_post_meta($post->ID, "member_twitter", true);
	$member_google = get_post_meta($post->ID, "member_google", true);
	$member_linkedin = get_post_meta($post->ID, "member_linkedin", true);
	$member_youtube = get_post_meta($post->ID, "member_youtube", true);
	$member_website = get_post_meta($post->ID, "member_website", true);

	echo "<p><input type='text' name='member_facebook' style='width:300px;' placeholder='Facebook URL' value='".$member_facebook."' /></p>";
	echo "<p><input type='text' name='member_twitter' style='width:300px;' placeholder='Twitter URL' value='".$member_twitter."' /></p>";
	echo "<p><input type='text' name='member_google' style='width:300px;' placeholder='Google Plus URL' value='".$member_google."' /></p>";
	echo "<p><input type='text' name='member_linkedin' style='width:300px;' placeholder='LinkedIn URL' value='".$member_linkedin."' /></p>";
	echo "<p><input type='text' name='member_youtube' style='width:300px;' placeholder='Youtube URL' value='".$member_youtube."' /></p>";
	echo "<p><input type='text' name='member_website' style='width:300px;' placeholder='Website URL' value='".$member_website."' /></p>";
}

function meta_box_callback_team_secretary() {
 	global $post;
	
	// Noncename needed to verify where the data originated
    echo '<input type="hidden" name="teammeta_noncename" id="teammeta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />'; 
	
	$member_sec_name = get_post_meta($post->ID, "member_sec_name", true);
	$member_sec_phone = get_post_meta($post->ID, "member_sec_phone", true);
	$member_sec_mobile = get_post_meta($post->ID, "member_sec_mobile", true);
	$member_sec_fax = get_post_meta($post->ID, "member_sec_fax", true);
	$member_sec_email = get_post_meta($post->ID, "member_sec_email", true);

	echo "<p><input type='text' name='member_sec_name' style='width:300px;' placeholder='Secretary Name' value='".$member_sec_name."' /></p>";
	echo "<p><input type='text' name='member_sec_phone' style='width:300px;' placeholder='Phone No.' value='".$member_sec_phone."' /></p>";
	echo "<p><input type='text' name='member_sec_mobile' style='width:300px;' placeholder='Mobile No.' value='".$member_sec_mobile."' /></p>";
	echo "<p><input type='text' name='member_sec_fax' style='width:300px;' placeholder='Fax No.' value='".$member_sec_fax."' /></p>";
	echo "<p><input type='text' name='member_sec_email' style='width:300px;' placeholder='E-mail' value='".$member_sec_email."' /></p>";
}

//save meta box for team members
add_action('save_post', 'save_meta_box_team', 1, 2); // save the custom fields
function save_meta_box_team( $post_id, $post ) {
    if ( !wp_verify_nonce( $_POST['teammeta_noncename'], plugin_basename(__FILE__) )) {
		return $post->ID;
	}
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;
	
	$teammeta_noncename['member_tagline'] = $_POST['member_tagline'];
	$teammeta_noncename['member_expertise'] = $_POST['member_expertise'];
	$teammeta_noncename['member_sector'] = $_POST['member_sector'];
	$teammeta_noncename['member_designation'] = $_POST['member_designation'];
	$teammeta_noncename['member_department'] = $_POST['member_department'];
	$teammeta_noncename['member_location'] = $_POST['member_location'];
	$teammeta_noncename['member_phone'] = $_POST['member_phone'];
	$teammeta_noncename['member_mobile'] = $_POST['member_mobile'];
	$teammeta_noncename['member_fax'] = $_POST['member_fax'];
	$teammeta_noncename['member_email'] = $_POST['member_email'];
	
	$teammeta_noncename['member_facebook'] = $_POST['member_facebook'];
	$teammeta_noncename['member_twitter'] = $_POST['member_twitter'];
	$teammeta_noncename['member_google'] = $_POST['member_google'];
	$teammeta_noncename['member_linkedin'] = $_POST['member_linkedin'];
	$teammeta_noncename['member_youtube'] = $_POST['member_youtube'];
	$teammeta_noncename['member_website'] = $_POST['member_website'];

	$teammeta_noncename['member_sec_name'] = $_POST['member_sec_name'];
	$teammeta_noncename['member_sec_phone'] = $_POST['member_sec_phone'];
	$teammeta_noncename['member_sec_mobile'] = $_POST['member_sec_mobile'];
	$teammeta_noncename['member_sec_fax'] = $_POST['member_sec_fax'];
	$teammeta_noncename['member_sec_email'] = $_POST['member_sec_email'];
	
	// Add values of $teammeta_noncename as custom fields
	foreach ($teammeta_noncename as $key => $value) { // Cycle through the $teammeta_noncename array!
		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}

}