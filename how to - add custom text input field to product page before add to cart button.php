<?php
/**
 * Add a custom text input field to the product page
 */
function plugin_republic_add_text_field() { 
	?>
	<p class="date">
		<input type="text" name='pr-field-date' placeholder="Date" id='pr-field-date' value=''>
	</p>
	<?php
}

add_action( 'woocommerce_after_add_to_cart_quantity', 'plugin_republic_add_text_field' );


/**
 * Validate our custom text input field value
 */
function plugin_republic_add_to_cart_validation( $passed, $product_id, $quantity, $variation_id=null ) {
	 if( empty( $_POST['pr-field-date'] ) ) {
		 $passed = false;
		 wc_add_notice( __( 'Date is a required field.', 'plugin-republic' ), 'error' );
	 }
	 return $passed;
}
add_filter( 'woocommerce_add_to_cart_validation', 'plugin_republic_add_to_cart_validation', 10, 4 );


/**
 * Add custom cart item data
 */
function plugin_republic_add_cart_item_data( $cart_item_data, $product_id, $variation_id ) {
	if( isset( $_POST['pr-field-date'] ) ) {
		$cart_item_data['pr_field_date'] = sanitize_text_field( $_POST['pr-field-date'] );
	}
	return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'plugin_republic_add_cart_item_data', 10, 3 );


/**
 * Display custom item data in the cart
 */
function plugin_republic_get_item_data( $item_data, $cart_item_data ) {
	if( isset( $cart_item_data['pr_field_date'] ) ) {
		 $item_data[] = array(
			 'key' => __( 'Date', 'plugin-republic' ),
			 'value' => wc_clean( $cart_item_data['pr_field_date'] )
		 );
	}
	return $item_data;
}
add_filter( 'woocommerce_get_item_data', 'plugin_republic_get_item_data', 10, 2 );


/**
 * Add custom meta to order
 */
function plugin_republic_checkout_create_order_line_item( $item, $cart_item_key, $values, $order ) {
	 if( isset( $values['pr_field_date'] ) ) {
		$item->add_meta_data(
			 __( 'Date', 'plugin-republic' ),
			 $values['pr_field_date'],
			 true
	 	);
	 }
}
add_action( 'woocommerce_checkout_create_order_line_item', 'plugin_republic_checkout_create_order_line_item', 10, 4 );


/**
 * Add custom cart item data to emails
 */
function plugin_republic_order_item_name( $product_name, $item ) {
	if( isset( $item['pr_field_date'] ) ) {
		 $product_name .= sprintf(
			 '<ul><li>%s: %s</li></ul>',
			 __( 'Date', 'plugin_republic' ),
			 esc_html( $item['pr_field_date'] )
		 );
	}
 	return $product_name;
}
add_filter( 'woocommerce_order_item_name', 'plugin_republic_order_item_name', 10, 2 );
