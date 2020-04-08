<?php //how to customize font family & size etc in wp-admin text editor file 

//Add the following to the functions.php file of your theme.
/**
 * Registers an editor stylesheet for the theme.
 */
function wpdocs_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );


//Next, create a file named custom-editor-style.css in your themes root directory. Any CSS rules added to that file will be reflected within the TinyMCE visual editor. The contents of the file might look like this:
?>
<style type="text/css">
body#tinymce.wp-editor { 
    font-family: Arial, Helvetica, sans-serif; 
    margin: 10px; 
}
 
body#tinymce.wp-editor a {
    color: #4CA6CF;
}
</style>