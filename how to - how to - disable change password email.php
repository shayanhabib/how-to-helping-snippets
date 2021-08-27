<?php //how to - disable change password email

// To disable Password Change notifications:
function disable_password_change_email( $send, $user, $userdata ) {
    return false;
}
add_filter( 'send_password_change_email', 'disable_password_change_email' );


// --OR--


// Or even shorter:
add_filter( 'send_password_change_email', '__return_false' );
