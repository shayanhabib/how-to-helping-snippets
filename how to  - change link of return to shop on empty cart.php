<?php //how to  - change link of return to shop on empty cart
function wc_empty_cart_redirect_url() {
    return $_SERVER['HTTP_REFERER'];
}
add_filter( 'woocommerce_return_to_shop_redirect', 'wc_empty_cart_redirect_url' );