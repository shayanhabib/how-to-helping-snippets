<?php //function to change sender email & sender name

// Function to change email address 
function wpb_sender_email( $original_email_address ) {
    return 'hello@barterla.net';
}
 
// Function to change sender name
function wpb_sender_name( $original_email_from ) {
    return 'Barter LA';
}
 
// Hooking up our functions to WordPress filters 
add_filter( 'wp_mail_from', 'wpb_sender_email' );
add_filter( 'wp_mail_from_name', 'wpb_sender_name' );