<?php
add_action('wp_enqueue_scripts', 'ng1_base_block_scripts');
function ng1_base_block_scripts() {
//-- Script des block js ---------

    wp_enqueue_script('vg-header-logo-centered', get_stylesheet_directory_uri() . '/assets/js/blocks/header-logo-centered.js', [], null, true);
    wp_enqueue_script('vg-media-text-decale', get_stylesheet_directory_uri() . '/assets/js/blocks/media-text-decale.js', [], null, true);
    wp_enqueue_script('vg-header-scroll', get_stylesheet_directory_uri() . '/assets/js/header-scroll.js', [], null, true);
    wp_enqueue_script('vg-has-decal-h1', get_stylesheet_directory_uri() . '/assets/js/has-decal-h1.js', [], null, true);

    wp_enqueue_script('vg-var-header-height', get_stylesheet_directory_uri() . '/assets/js/var-header-height.js', [], null, true);
    wp_enqueue_script('vg-media-text-type-4', get_stylesheet_directory_uri() . '/assets/js/blocks/media-text-type-4.js', [], null, true);
    wp_enqueue_script('vg-media-text-type-5', get_stylesheet_directory_uri() . '/assets/js/blocks/media-text-type-5.js', [], null, true);
    wp_enqueue_script('vg-section-text-type-2', get_stylesheet_directory_uri() . '/assets/js/blocks/section-text-type-2.js', [], null, true);
    wp_enqueue_script('vg-section-text-type-3', get_stylesheet_directory_uri() . '/assets/js/blocks/section-text-type-3.js', [], null, true);
    //--------------------
}
