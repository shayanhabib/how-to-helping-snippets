<?php
// To disable the automatic email response to users when their password or email is changed, include this in your functions.php.

/*
 * how to - Disable User Notification of Password Change Confirmation
 */
add_filter( 'send_email_change_email', '__return_false' );


// This is useful during development when setting up many user accounts at once and you have to change their information. It might be better to only return false if this is not your user id, so the notification still gets delivered if it’s not you doing the changes.

