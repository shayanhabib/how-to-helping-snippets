<?php //how to - delete all terms of custom taxonomy
function sjc_delete_terms() {
     if ( is_admin() ) {
		$termsid = array('839', '840', '841', '842','843','844','845','846','847','848');
		$terms = get_terms( 'businesscates', array( 'fields' => 'ids', 'hide_empty' => false, 'exclude' => $termsid ) );
		foreach ( $terms as $value ) {
			//var_dump($value);
			wp_delete_term( $value, 'businesscates' );
		}
     }
}
add_action( 'init', 'sjc_delete_terms' );