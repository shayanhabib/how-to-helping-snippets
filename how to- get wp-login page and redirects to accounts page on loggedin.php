<?php 
//first method
if ( in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) ) ) {
	if(is_user_logged_in()) {
		header("Location: ".esc_url(home_url('/'))."my-account");
		die;
	}
}


//second method
//putbelow code on functions.php, it will redirect all user roles to my account page instead of wp-admin

function xc_redirect_users_by_role() {
 
    $current_user   = wp_get_current_user();
    $role_name      = $current_user->roles[0];
 
    if ( 'administrator' !== $role_name ) {
        wp_redirect( esc_url(home_url('/'))."my-account" );
    } // if
 
} // xc_redirect_users_by_role
add_action( 'admin_init', 'xc_redirect_users_by_role' );
?>