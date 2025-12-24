<?php
add_action('wp_enqueue_scripts', 'ng1_base_block_scripts');
function ng1_base_block_scripts() {
//-- Script des block js ---------

    wp_enqueue_script('vg-header-logo-centered', get_stylesheet_directory_uri() . '/assets/js/blocks/header-logo-centered.js', [], null, true);
     wp_enqueue_script('vg-media-text-decale', get_stylesheet_directory_uri() . '/assets/js/blocks/media-text-decale.js', [], null, true);
    wp_enqueue_script('vg-header-scroll', get_stylesheet_directory_uri() . '/assets/js/header-scroll.js', [], null, true);
//--------------------
}
