<?php
//add support for page-attributes to post

function wpcodex_add_excerpt_support_for_posts() {
	add_post_type_support( 'post', 'page-attributes' );
}
add_action( 'init', 'wpcodex_add_excerpt_support_for_posts' );