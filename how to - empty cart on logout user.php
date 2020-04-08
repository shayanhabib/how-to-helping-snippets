<?php //how to empty cart on user logout .. 
function your_function() {
    if( function_exists('WC') ){
        WC()->cart->empty_cart();
    }
}
add_action('wp_logout', 'your_function');