<?php
//make parent child relationship for posts

add_action('registered_post_type', 'igy2411_make_posts_hierarchical', 10, 2 );

// Runs after each post type is registered
function igy2411_make_posts_hierarchical($post_type, $pto){

    // Return, if not post type posts
    if ($post_type != 'post') return;

    // access $wp_post_types global variable
    global $wp_post_types;

    // Set post type "post" to be hierarchical
    $wp_post_types['post']->hierarchical = 1;

    // Add page attributes to post backend
    // This adds the box to set up parent and menu order on edit posts.
    add_post_type_support( 'post', 'page-attributes' );

}