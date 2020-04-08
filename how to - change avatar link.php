<?php //how to - change avatar link 
add_filter( 'avatar_defaults', 'mytheme_default_avatar' );
function mytheme_default_avatar( $avatar_defaults )  {
    $avatar = get_option('avatar_default');

    $new_avatar_url = get_template_directory_uri() . '/images/default_avatar.png';

    if( $avatar != $new_avatar_url ) {
        update_option( 'avatar_default', $new_avatar_url );
    }

    $avatar_defaults[ $new_avatar_url ] = 'Default Avatar';
    return $avatar_defaults;
}