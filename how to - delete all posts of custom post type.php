<?php //how to - delete all posts of custom post type
function sjc_delete_posts() {
     if ( is_admin() ) {
		$args = array( 'post_type' => 'gallertpt', 'posts_per_page' => '-1' );
		query_posts( $args );
		while ( have_posts() ) { 
			the_post();

			wp_delete_post( get_the_ID(), true );
		}
     }
}
add_action( 'init', 'sjc_delete_posts' );