<?php //add user profile fields
function user_profile_other_informations($profile_fields) {

	// Add new fields
	$profile_fields['company_name'] = 'Company name';
	$profile_fields['address1'] = 'Address line 1';
	$profile_fields['address2'] = 'Address line 2';
	$profile_fields['state'] = 'State / Province';
	$profile_fields['city'] = 'City';
	$profile_fields['zipcode'] = 'ZIP / Postal Code';
	$profile_fields['lat'] = 'Lattitude';
	$profile_fields['lng'] = 'Longitude';
	$profile_fields['country'] = 'Country';
	$profile_fields['contact_number'] = 'Contact Number';

	return $profile_fields;
}
add_filter('user_contactmethods', 'user_profile_other_informations');