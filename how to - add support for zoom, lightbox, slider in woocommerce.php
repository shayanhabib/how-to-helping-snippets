<?php //how to add support for zoom, lightbox, slider in woocommerce
add_action( 'after_setup_theme', 'somewoo_supports' );
 
function somewoo_supports() {
	//add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	//add_theme_support( 'wc-product-gallery-slider' );
}
?>

<style>
/* WooCommerce 3.0 Gallery */
 
.woocommerce-product-gallery {
position: relative;
margin-bottom: 3em
}
 
.woocommerce-product-gallery figure {
margin: 0
}
 
.woocommerce-product-gallery .woocommerce-product-gallery__image:nth-child(n+2) {
width: 25%;
display: inline-block
}
 
.woocommerce-product-gallery .flex-control-thumbs li {
list-style: none;
float: left;
cursor: pointer
}
 
.woocommerce-product-gallery .flex-control-thumbs img {
opacity: .5
}
 
.woocommerce-product-gallery .flex-control-thumbs img.flex-active,.woocommerce-product-gallery .flex-control-thumbs img:hover {
opacity: 1
}
 
.woocommerce-product-gallery img {
display: block
}
 
.woocommerce-product-gallery--columns-3 .flex-control-thumbs li {
width: 33.3333%
}
 
.woocommerce-product-gallery--columns-4 .flex-control-thumbs li {
width: 25%
}
 
.woocommerce-product-gallery--columns-5 .flex-control-thumbs li {
width: 20%
}
 
.woocommerce-product-gallery__trigger {
position: absolute;
top: 1em;
right: 1em;
z-index: 99;
}
 
a.woocommerce-product-gallery__trigger {
text-decoration: none;
}
 
.single-product div.product .woocommerce-product-gallery .woocommerce-product-gallery__trigger {
position: absolute;
top: .875em;
right: .875em;
display: block;
height: 2em;
width: 2em;
border-radius: 3px;
z-index: 99;
text-align: center;
text-indent: -999px;
overflow: hidden;
}
 
.single-product div.product .woocommerce-product-gallery .woocommerce-product-gallery__trigger {
background-color: #169fda;
color: #ffffff;
}
 
.single-product div.product .woocommerce-product-gallery .woocommerce-product-gallery__trigger:hover {
background-color: #1781ae;
border-color: #1781ae;
color: #ffffff;
}
 
.single-product div.product .woocommerce-product-gallery .woocommerce-product-gallery__trigger:before {
font: normal normal normal 1em/1 FontAwesome;
font-size: inherit;
text-rendering: auto;
-webkit-font-smoothing: antialiased;
-moz-osx-font-smoothing: grayscale;
display: block;
content: "\f00e";
line-height: 2;
text-indent: 0;
}
</style>