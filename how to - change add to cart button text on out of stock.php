<?php //change add to cart button text on out of stock

add_filter( 'woocommerce_product_add_to_cart_text', 'customizing_add_to_cart_button_text', 10, 2 );
add_filter( 'woocommerce_product_single_add_to_cart_text', 'customizing_add_to_cart_button_text', 10, 2 );
function customizing_add_to_cart_button_text( $button_text, $product ) {

    $sold_out = __( "Sold Out", "woocommerce" );

    $availability = $product->get_availability();
    $stock_status = $availability['class'];

    // Only for variable products on single product pages
    if ( $product->is_type('variable') && is_product() )
    {
    ?>
    <script>
    jQuery(document).ready(function($) {
        $('select').blur( function(){
            if( '' != $('input.variation_id').val() && $('p.stock').hasClass('out-of-stock') )
                $('button.single_add_to_cart_button').html('<?php echo $sold_out; ?>');
            else 
                $('button.single_add_to_cart_button').html('<?php echo $button_text; ?>');

            console.log($('input.variation_id').val());
        });
    });
    </script>
    <?php
    }
    // For all other cases (not a variable product on single product pages)
    elseif ( ! $product->is_type('variable') && ! is_product() ) 
    {
        if($stock_status == 'out-of-stock')
            $button_text = $sold_out.' ('.$stock_status.')';
        else
            $button_text.=' ('.$stock_status.')';
    }
    return $button_text;
}