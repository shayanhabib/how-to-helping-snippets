<?php //add custom field for cart page.. 
add_action( 'woocommerce_before_add_to_cart_button', 'add_fields_before_add_to_cart' );
function add_fields_before_add_to_cart( ) {
	?>
	<table>
		<tr>
			<td>
				<?php _e( "Comment:" ); ?>
			</td>
			<td>
				<input type="text" name="woo_addcomment" placeholder="Add Comment" />
			</td>
		</tr>
	</table>
	<?php
}

/**
 * Add data to cart item
 */
add_filter( 'woocommerce_add_cart_item_data', 'add_cart_item_data', 25, 2 );
function add_cart_item_data( $cart_item_meta, $product_id ) {

	if ( isset( $_POST ['woo_addcomment'] ) ) {
		$custom_data = array();
		$custom_data['woo_addcomment']    = isset( $_POST ['woo_addcomment'] ) ?  sanitize_text_field ( $_POST ['woo_addcomment'] ) : "" ;
		$cart_item_meta['custom_data']     = $custom_data;
	}
	
	return $cart_item_meta;
}


/**
 * Display custom data on cart and checkout page.
 */
add_filter( 'woocommerce_get_item_data', 'get_item_data' , 25, 2 );
function get_item_data ( $other_data, $cart_item ) {

	if ( isset( $cart_item [ 'custom_data' ] ) ) {
		$custom_data  = $cart_item [ 'custom_data' ];
			
		$other_data[] = array( 'name' => 'Comment',
					'display'  => $custom_data['woo_addcomment'] );
	}
	
	return $other_data;
}


/**
 * Add order item meta.
 */

add_action( 'woocommerce_add_order_item_meta', 'add_order_item_meta' , 10, 2);
function add_order_item_meta ( $item_id, $values ) {

	if ( isset( $values [ 'custom_data' ] ) ) {

		$custom_data  = $values [ 'custom_data' ];
		wc_add_order_item_meta( $item_id, 'Comment', $custom_data['woo_addcomment'] );
	}
}