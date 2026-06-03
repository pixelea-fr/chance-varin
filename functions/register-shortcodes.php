<?php
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 12);

/* ----- php_include ----- */
require_once get_stylesheet_directory() . '/shortcodes/shortcode-lotties-hover/shortcode-lotties-hover.php';
require_once get_stylesheet_directory() . '/shortcodes/shortcode-double-marquee/shortcode-double-marquee.php';
require_once get_stylesheet_directory() . '/shortcodes/shortcode-map-chance-varin/shortcode-map-chance-varin.php';
require_once get_stylesheet_directory() . '/shortcodes/shortcode-noty-banner-content/shortcode-noty-banner-content.php';
require_once get_stylesheet_directory() . '/shortcodes/shortcode-chance-varin/shortcode-chance-varin.php';
/* ----- php_include fin ----- */
