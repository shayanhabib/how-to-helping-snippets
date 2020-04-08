<?php
//how to - choose option in woo variations
add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'nooption_filter_dropdown_args', 10 );
function nooption_filter_dropdown_args( $args ) {
    $var_tax = get_taxonomy( $args['attribute'] );
    $args['show_option_none'] = apply_filters( 'the_title', "Choose ".$var_tax->labels->name );
    return $args;
}