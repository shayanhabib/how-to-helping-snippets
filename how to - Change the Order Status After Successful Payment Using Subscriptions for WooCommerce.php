<?php //how to - Change the Order Status After Successful Payment Using Subscriptions for WooCommerce

add_action( 'woocommerce_order_status_processing', 'processing_to_completed');
function processing_to_completed($order_id){

	if( !empty($order_id) ){
		// $order = wc_get_order($order_id);
	    $order = new WC_Order($order_id);
	    if( $order->is_paid() ){
	    	$order->update_status('completed'); 
	    }
	}

}