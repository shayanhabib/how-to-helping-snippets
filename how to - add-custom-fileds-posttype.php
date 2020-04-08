<?php 
add_action( 'add_meta_boxes', 'register_meta_box_bookingdatess');
function register_meta_box_bookingdatess() {
    add_meta_box( 'choose_fields', 'Fill below fields', 'meta_box_callback_service', 'bookingdatess', 'advanced', 'high' );
}

function meta_box_callback_service() {
 	global $post;
    echo '<input type="hidden" name="meta_noncename" id="meta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />'; 

	$pid = $post->ID;

	echo "<h4 style='margin:0;'>Select Transfer Options</h4>";
	//$select_transfer_options = get_post_meta($pid, "select_transfer_options", true);
	$select_transfer_options_title = get_post_meta($pid, "select_transfer_options_title", true);
	$select_transfer_options_title_exp = explode(",", $select_transfer_options_title);
	$select_transfer_options_price = get_post_meta($pid, "select_transfer_options_price", true);
	$select_transfer_options_price_exp = explode(",", $select_transfer_options_price);
	//var_dump($select_transfer_options_title);
	$c = 0;
    if ( count( $select_transfer_options_title_exp ) > 0 ) {
        foreach( $select_transfer_options_title_exp as $stt => $track ) {
            echo '<div class="divv">
            	<p><input placeholder="Transfer Option (Title)" type="text" name="select_transfer_options_title[]" value="'.$select_transfer_options_title_exp[$stt].'" /></p> 
            	<p><input placeholder="Transfer Option (Price)" type="text" name="select_transfer_options_price[]" value="'.$select_transfer_options_price_exp[$stt].'" /></p> 
            	<p><a href="#" class="remove">Remove Option</a></p>
            </div>';
            $c = $c +1;
        }
    }
    ?><div id="here"></div>
	<p><a href="#" class="add">Add Options</a></p>
	<script>
	    var $ = jQuery.noConflict();
	    $(document).ready(function() {
	        var count = <?php echo $c; ?>;
	        $(".add").click(function(e) {
	        	e.preventDefault();
	            count = count + 1;

	            $('#here').append('<div class="divv"><p><input placeholder="Transfer Option (Title)" type="text" name="select_transfer_options_title[]" value="" /></p> <p><input placeholder="Transfer Option (Price)" type="text" name="select_transfer_options_price[]" value="" /></p> <p><a href="#" class="remove">Remove Option</a></p></div>' );
	            return false;
	        });
	        $(".remove").live('click', function(e) {
	        	e.preventDefault();
	            $(this).parent().parent().remove();
	        });
	    });
	</script><?php
	
	echo "<h4 style='margin:0;'>Price</h4>";
	$pricee = get_post_meta($pid, "pricee", true);
	echo "<p><input name='pricee' type='text' value='".$pricee."'></p>";

}


add_action('save_post', 'save_meta_box_team', 1, 2); // save the custom fields
function save_meta_box_team( $post_id, $post ) {
    if ( !wp_verify_nonce( $_POST['meta_noncename'], plugin_basename(__FILE__) )) {
		return $post->ID;
	}
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;
	
	$meta_noncename['select_transfer_options_title'] = $_POST['select_transfer_options_title'];
	$meta_noncename['select_transfer_options_price'] = $_POST['select_transfer_options_price'];
	$meta_noncename['pricee'] = $_POST['pricee'];
	
	// Add values of $meta_noncename as custom fields
	foreach ($meta_noncename as $key => $value) { // Cycle through the $meta_noncename array!
		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}

}