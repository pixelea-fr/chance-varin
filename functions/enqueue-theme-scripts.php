<?php

function enqueue_theme_styles() {
  wp_enqueue_style('main-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'enqueue_theme_styles');


function ajouter_css_editor_gutenberg() {
  wp_enqueue_style('editor', get_stylesheet_directory_uri() . '/editor.css', array(), null);
}
add_action('enqueue_block_assets', 'ajouter_css_editor_gutenberg');
