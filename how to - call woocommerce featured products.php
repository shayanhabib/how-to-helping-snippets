<ul class="productitem">
						<?php
						$atts = shortcode_atts( array(
							'per_page' => '8',
							'columns' => '4',
							'orderby' => 'date',
							'order' => 'asc',
							'category' => '', // Slugs
							'operator' => 'IN', // Possible values are 'IN', 'NOT IN', 'AND'.
						), $atts, 'featured_products' );

						$meta_query = WC()->query->get_meta_query();
						$tax_query = WC()->query->get_tax_query();
						$tax_query[] = array(
							'taxonomy' => 'product_visibility',
							'field' => 'name',
							'terms' => 'featured',
							'operator' => 'IN',
						);

						$query_args = array(
							'post_type' => 'product',
							'post_status' => 'publish',
							'ignore_sticky_posts' => 1,
							'posts_per_page' => $atts['per_page'],
							'orderby' => $atts['orderby'],
							'order' => $atts['order'],
							'meta_query' => $meta_query,
							'tax_query' => $tax_query,
						);

						$featured = new WP_Query($query_args);
						$featured = $featured->posts;
						foreach( $featured as $product ){
							//print_r($product);
							$featured_image = wp_get_attachment_url( get_post_thumbnail_id($product->ID));
							if(!empty($featured_image)) {
								$image = wp_get_attachment_url( get_post_thumbnail_id($product->ID));
							} else { 
								$image = esc_url(home_url('/'))."wp-content/plugins/woocommerce/assets/images/placeholder.png"; 
							}
							$product1 = new WC_Product($product->ID);
							$pidd = $product->ID;
							$guidd = $product->guid;
							$protitle = $product->post_title;
							?>
							<li>
								<div class="bgimage" style="background-image: url(<?php echo $image; ?>);">
									<?php if ( $product1->is_on_sale() ) : ?>
										<span class="note sale">Sale!</span>
									<?php endif; ?>
									<div class="actionbtns">
										<div class="col33">
											<a href="<?php echo do_shortcode('[add_to_cart_url id="'.$pidd.'"]'); ?>"><i class="fa fa-shopping-cart"></i></a>
										</div>
										<div class="col33">
											<a href="<?php esc_url(home_url('/')); ?>?add_to_wishlist=<?php echo $pidd; ?>"><i class="fa fa-heart-o"></i></a>
										</div>
										<div class="col33">
											<a href="<?php echo $guidd; ?>"><i class="fa fa-refresh"></i></a>
										</div>
										<div class="clear"></div>
										<a href="javascript:;" class="quickview" onClick="quickview(<?php echo $pidd; ?>)"><i class="fa fa-search"></i> Quick View</a>
									</div>
								</div>
								<span class="category"><?php 
								$cat1 = get_the_terms( $pidd, 'product_cat' );
								//print_r($cat1);
								foreach ( $cat1 as $term1 ) {
									echo "<a href='#'>".$term1->slug."</a>";
								}
								?></span>
								<h3><a href="<?php echo $guidd; ?>"><?php echo $protitle; ?></a></h3>
								<p class="price"><?php echo $product1->get_price_html(); ?></p>
							</li>
							<?php
						}
						wp_reset_query(); ?>
						</ul>
						<div class="clear"></div>