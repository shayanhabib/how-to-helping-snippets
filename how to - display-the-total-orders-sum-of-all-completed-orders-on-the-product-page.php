<?php //how to - display-the-total-orders-sum-of-all-completed-orders-on-the-product-page

global $wpdb;

$productid = "";
 
$total_sales = $wpdb->get_var( "SELECT SUM( order_item_meta__line_total.meta_value) as order_item_amount 
    FROM {$wpdb->posts} AS posts
    INNER JOIN {$wpdb->prefix}woocommerce_order_items AS order_items ON posts.ID = order_items.order_id
    INNER JOIN {$wpdb->prefix}woocommerce_order_itemmeta AS order_item_meta__line_total ON (order_items.order_item_id = order_item_meta__line_total.order_item_id)
        AND (order_item_meta__line_total.meta_key = '_line_total')
    INNER JOIN {$wpdb->prefix}woocommerce_order_itemmeta AS order_item_meta__product_id_array ON order_items.order_item_id = order_item_meta__product_id_array.order_item_id 
    WHERE posts.post_type IN ( 'shop_order' )
    AND posts.post_status IN ( 'wc-completed' ) AND ( ( order_item_meta__product_id_array.meta_key IN ('_product_id','_variation_id') 
    AND order_item_meta__product_id_array.meta_value IN ('{$productid}') ) );" );
 
echo wc_price( $total_sales );