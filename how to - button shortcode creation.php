<?php //[button color="green" size="medium" link="http://oceanoffpcsgamesdownloads.xyz/tekken-3-game-free-download-for-pc-setup-window-7/" target="blank"]Download Now[/button]

function btn_shortcode($atts = [], $content = null, $tag = '') {
    // normalize attribute keys, lowercase
    $atts = array_change_key_case((array)$atts, CASE_LOWER);
 
    // override default attributes with user attributes
    $wporg_atts = shortcode_atts([
         'color' => 'green',
         'size' => 'medium',
         'link' => '#',
         'target' => 'blank'
     ], $atts, $tag);

    // start output 
 
    // start box
    $color = $atts['color'];
    $size = $atts['size'];
    if($size == "small") {
        $s = "16px";
    }
    else if($size == "medium") {
        $s = "20px";
    }
    else if($size == "large") {
        $s = "24px";
    }
    else {
        $s = "";
    }
    $link = $atts['link'];
    $target = $atts['target'];
    
    $btn = '<a href="'.$link.'" target="_'.$target.'"><button style="background:'.$color.';color:#fff;font-weight:normal;padding:14px 30px;font-size:'.$s.';">'.$content.'</button>';

    // return output
    return $btn;
}
 
function btn_shortcodes_init() {
    add_shortcode('button', 'btn_shortcode');
}
 
add_action('init', 'btn_shortcodes_init');