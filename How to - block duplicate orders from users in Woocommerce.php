<?php //How to - block duplicate orders from users in Woocommerce?

// Block duplicate purchase of products in Woocommerce using hooks
function in_disable_repeat_purchase( $purchasable, $product ) {
    // Don't run on parents of variations, this will already check variations separately
    if ( $product->is_type( 'variable' ) ) {
        return $purchasable;
    }
    // Get the ID for the current product
    $product_id = $product->is_type( 'variation' ) ? $product->variation_id : $product->id;
    // return false if the customer has bought the product / variation
    if ( wc_customer_bought_product( wp_get_current_user()->user_email, get_current_user_id(), $product_id ) ) {
        $purchasable = false;
    }
    // Double-check for variations: if parent is not purchasable, then variation is not
    // if ( $purchasable && $product->is_type( 'variation' ) ) {
    //         $purchasable = $product->parent->is_purchasable();
    // }
    return $purchasable;
}
add_filter( 'woocommerce_is_purchasable', 'in_disable_repeat_purchase', 10, 2 );

function in_purchase_disabled_message() {
    global $product;
    if ( wc_customer_bought_product( wp_get_current_user()->user_email, get_current_user_id(), $product->id ) ) {
        echo '<div class="woocommerce"><div class="woocommerce-info">You\'ve already purchased this product!</div></div>';
    }
}
add_action( 'woocommerce_single_product_summary', 'in_purchase_disabled_message', 31 );
?>