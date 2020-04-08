<?php //Enabled default Woo-commerce coupon field on CartFlows checkout page


// Supposed to add this code in theme's functions.php. 

add_action( 'wp', 'enabled_default_coupon_form' );

/**
 * Action to add filter for enabling default WooCommerce coupon field.
 */
function enabled_default_coupon_form() {

	// Bail if CartFlows is not active.
	if( ! defined( 'CARTFLOWS_VER' ) ) {
		return;
	}

	// On CartFlows checkout page only.
	if ( _is_wcf_checkout_type() || _is_wcf_checkout_shortcode() ) {
		add_action( 'woocommerce_before_checkout_form', 'enable_woo_coupon_form' , 11 );
		add_filter( 'woocommerce_coupons_enabled', '__return_true', 11 );
	}
}

/**
 * Enable and display default WooCommerce coupon field.
 */
function enable_woo_coupon_form() {

	$wcf_instance = Cartflows_Checkout_Markup::get_instance();

	remove_action( 'woocommerce_checkout_order_review', array( $wcf_instance, 'display_custom_coupon_field' ) );

	woocommerce_checkout_coupon_form();
}