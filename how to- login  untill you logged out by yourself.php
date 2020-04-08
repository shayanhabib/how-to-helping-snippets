<?php 
//how to - login  untill you logged out by yourself..
add_filter( 'auth_cookie_expiration', 'wploop_never_log_out' );
function wploop_never_log_out( $expirein ) {
    return 1421150815; // 40+ years shown in seconds
}