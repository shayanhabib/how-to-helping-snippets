<?php //show recent post widget of post category & exclude the current post
function wpb_postsbycategory() {
	$categories = get_the_category( $post->ID );
	$separator = ', ';
	$output = '';
	if ( ! empty( $categories ) ) {
	    foreach( $categories as $category ) {
	        $output .= $category->term_id . $separator;
	    }
	    $category_idss = trim( $output, $separator );
	}
	$pidd = get_the_ID();
	$the_query = new WP_Query( array( 'cat' => $category_idss, 'post__not_in' => array($pidd), 'posts_per_page' => '5' ) ); 
	if ( $the_query->have_posts() ) {
		$string .= '<div class="widget widget_recent_entries"><h3 class="widget-title">Recent News</h3><ul class="postsbycategory widget_recent_entries">';
		while ( $the_query->have_posts() ) {
		$the_query->the_post();
		$string .= '<li><a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_title() .'</a><span class="post-date">'.get_the_date().'</span></li>';
		}
	} else {
		$string .= '<li>No posts available</li>';
	}
	$string .= '</ul></div>';
	return $string;
	wp_reset_postdata();
}
// Add a shortcode
add_shortcode('categoryposts', 'wpb_postsbycategory');

// Enable shortcodes in text widgets
add_filter('widget_text', 'do_shortcode');
?>