<?php //how to - remove website url field from wordpress comments.
function my_custom_comment_fields( $fields ){
  if(isset($fields['url']))
    unset($fields['url']);
  return $fields;
}

add_filter( 'comment_form_default_fields', 'my_custom_comment_fields' );