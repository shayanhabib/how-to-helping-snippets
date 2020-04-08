<?php //how to = Disable showing posts and media of other Wordpress users
add_action('pre_get_posts', 'query_set_only_author' );
function query_set_only_author( $wp_query ) {
 global $current_user;
 if( is_admin() && !current_user_can('edit_others_posts') ) {
    $wp_query->set( 'author', $current_user->ID );
    add_filter('views_edit-post', 'fix_post_counts');
    add_filter('views_upload', 'fix_media_counts');
 }
}