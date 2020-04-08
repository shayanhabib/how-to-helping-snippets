<?php //how to - Limit purchases to one product per order

add_filter( 'woocommerce_add_to_cart_validation', 'wc_limit_one_per_order', 10, 2 );
function wc_limit_one_per_order( $passed_validation, $product_id ) {
	//product ids to check on.
	if ( 31 !== $product_id ) {
		return $passed_validation;
	}

	//count if only 1 is allowed to be in cart item..
	if ( WC()->cart->get_cart_contents_count() >= 1 ) {
		wc_add_notice( __( 'This product cannot be purchased with other products. Please, empty your cart first and then add it again.', 'woocommerce' ), 'error' );
		return false;
	}

	//return
	return $passed_validation;
}
