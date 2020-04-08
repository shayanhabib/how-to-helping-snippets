<?php
$pro_args = array(
    'post_type' => 'product',
    'posts_per_page' => 3,
    'order' => 'DESC',
    'post__not_in' => array( $post->ID ),
    'tax_query' => array(
            'relation' => 'OR',
            array(
                    'taxonomy' => 'product_cat',
                    'field' => 'id',
                    'terms' => '55'
            )
    )
);
$rel_query = new WP_Query( $pro_args);
if( $rel_query->have_posts() ) : 
while ( $rel_query->have_posts() ) : $rel_query->the_post(); ?>

//template

<?php endwhile; ?>
<?php endif; wp_reset_query(); ?>