<?php //if login failed, redirect user to homepage..
function login_failed() {
  $login_page  = home_url( '/' );
  wp_redirect( $login_page . '?login=failed' );
  exit;
}
add_action( 'wp_login_failed', 'login_failed' );