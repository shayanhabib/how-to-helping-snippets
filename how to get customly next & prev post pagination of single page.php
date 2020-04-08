<?php
//how to get customly next & prev post pagination of single page?


  if($hsv_opt['single-portfolio-navigation']) {
		$prev_post	=	get_previous_post();
		if( $prev_post && has_post_thumbnail($prev_post->ID)) {
			$args = array(
				'post_per_page'	=>	1,
				'include'		=>	$prev_post->ID,
				'post_type'		=>	'portfolio',
			);

			$prev_post 	=	get_posts( $args );
			foreach($prev_post as $post) {
				setup_postdata($post);
				$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'portfolio');
			?>
			<div class="element  clearfix col1-3 home">
				<a href="<?php the_permalink(); ?> " title="">
						<figure class="images"> <img src="<?php echo esc_attr($src[0]); ?>" alt="Previous<span><?php the_title(); ?></span><i>&rarr;</i>" class="slip" /> </figure>
					</a>
			</div>

			<?php
				wp_reset_postdata();


			} // end foreach
		} // end of if

		$next_post	=	get_next_post();
		if( $next_post && has_post_thumbnail($next_post->ID) ) {
			$args = array(
				'post_per_page'	=>	1,
				'include'		=>	$next_post->ID,
				'post_type'		=>	'portfolio',
			);

			$next_post 	=	get_posts( $args );
			foreach($next_post as $post) {
				setup_postdata($post);
				$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'portfolio');

			?>
			<div class="element  clearfix col1-3 home">
				<a href="<?php the_permalink(); ?> " title="">
						<figure class="images"> <img src="<?php echo esc_attr($src[0]); ?>" alt="Next<span><?php the_title(); ?></span><i>&rarr;</i>" class="slip" /> </figure>
					</a>
			</div>

			<?php
				wp_reset_postdata();
			} // end foreach
		} // end of if
  }
?>