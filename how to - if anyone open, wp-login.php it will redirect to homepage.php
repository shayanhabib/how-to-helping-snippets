<?php //if anyone open, wp-login.php it will redirect to homepage..
function redirect_login_page() {
  $login_page  = home_url( '/' );
  $page_viewed = basename($_SERVER['REQUEST_URI']);
 
  if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
    wp_redirect($login_page);
    exit;
  }
}
add_action('init','redirect_login_page');