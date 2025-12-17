<?php
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 12);

/* ----- php_include ----- */
require_once get_stylesheet_directory() . '/shortcodes/shortcode-lotties-hover/shortcode-lotties-hover.php';
require_once get_stylesheet_directory() . '/shortcodes/shortcodes-double-marquee/shortcodes-double-marquee.php';
/* ----- php_include fin ----- */

