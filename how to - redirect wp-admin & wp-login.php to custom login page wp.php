<?php //how to - redirect wp-admin & wp-login.php to custom login page wp 

//if anyone open, wp-login.php it will redirect to homepage..
function redirect_login_page() {
  $login_page  = home_url( '/' );
  $page_viewed = basename($_SERVER['REQUEST_URI']);
 
  if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
    wp_redirect($login_page);
    exit;
  }
}
add_action('init','redirect_login_page');


//if login failed, redirect user to homepage..
function login_failed() {
  $login_page  = home_url( '/' );
  wp_redirect( $login_page . '?login=failed' );
  exit;
}
add_action( 'wp_login_failed', 'login_failed' );
 
//verify username & password..
function verify_username_password( $user, $username, $password ) {
  $login_page  = home_url( '/' );
    if( $username == "" || $password == "" ) {
        wp_redirect( $login_page . "?login=empty" );
        exit;
    }
}
add_filter( 'authenticate', 'verify_username_password', 1, 3);


//logout page redirect..
function logout_page() {
  $login_page  = home_url( '/' );
  wp_redirect( $login_page . "?login=false" );
  exit;
}
add_action('wp_logout','logout_page');