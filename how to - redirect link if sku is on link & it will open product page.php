<?php //how to - redirect link if sku is on link & it will open product page

 $pid = "$_SERVER[REQUEST_URI]";
 $dd = explode("/", $pid);
 $pid = $dd[2];
 $pid_new='';
 $pid_new = wc_get_product_id_by_sku($pid);
 //print_r($pid_new);
 if($pid_new!=''&&$pid_new!='0') { wp_redirect(get_permalink($pid_new),301); exit;
 }
?>