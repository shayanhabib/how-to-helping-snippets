<?php //how to - Add Payment Method Column to Admin Orders

//Add Payment Method Column to Admin Orders

add_filter( 'manage_edit-shop_order_columns', 'add_payment_method_column', 20 );
function add_payment_method_column( $columns ) {
 $new_columns = array();

 foreach ( $columns as $column_name => $column_info ) {

 $new_columns[ $column_name ] = $column_info;

 if ( 'order_total' === $column_name ) {
 $new_columns['order_payment'] = __( 'Payment Method', 'my-textdomain' );
 }
 }

 return $new_columns;
}


add_action( 'manage_shop_order_posts_custom_column', 'add_payment_method_column_content' );
function add_payment_method_column_content( $column ) {
 global $post;

 if ( 'order_payment' === $column ) {

 $order = wc_get_order( $post->ID );
 echo $order->payment_method_title;
 }
}