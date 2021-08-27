<?php //how to - Get List of WooCommerce Customer Emails Who Purchased a Specific Product

// Access WordPress database
global $wpdb;
 
// Select Product ID
$product_id = 7164;
       
// Find billing emails in the DB order table
$statuses = array_map( 'esc_sql', wc_get_is_paid_statuses() );
$customer_emails = $wpdb->get_col("
   SELECT DISTINCT pm.meta_value FROM {$wpdb->posts} AS p
   INNER JOIN {$wpdb->postmeta} AS pm ON p.ID = pm.post_id
   INNER JOIN {$wpdb->prefix}woocommerce_order_items AS i ON p.ID = i.order_id
   INNER JOIN {$wpdb->prefix}woocommerce_order_itemmeta AS im ON i.order_item_id = im.order_item_id
   WHERE p.post_status IN ( 'wc-" . implode( "','wc-", $statuses ) . "' )
   AND pm.meta_key IN ( '_billing_email' )
   AND im.meta_key IN ( '_product_id', '_variation_id' )
   AND im.meta_value = $product_id
");
 
// Print array on screen
// print_r( $customer_emails );
echo count($customer_emails);