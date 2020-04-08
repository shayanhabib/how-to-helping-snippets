<?php
//how to redirect to custom thankyou page after successful checkout - woocommerce

add_action( 'woocommerce_thankyou', 'thankyou_redirect');
 
function thankyou_redirect( $order_id ){
    $order = new WC_Order( $order_id );
 
    $url = 'http://www.domain.com/thank-you/';
 
    if ( $order->status != 'failed' ) {
        wp_redirect($url);
        exit;
    }
}
?>