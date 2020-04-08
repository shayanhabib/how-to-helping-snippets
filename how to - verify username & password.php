<?php //verify username & password..
function verify_username_password( $user, $username, $password ) {
  $login_page  = home_url( '/' );
    if( $username == "" || $password == "" ) {
        wp_redirect( $login_page . "?login=empty" );
        exit;
    }
}
add_filter( 'authenticate', 'verify_username_password', 1, 3);