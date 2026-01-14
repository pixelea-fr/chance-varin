<?php
/**
 * Fichier principal d'inclusion des metaboxes
 * Author : GEHIN Nicolas
 */

// Empêcher l'accès direct
if (!defined('ABSPATH')) {
    exit;
}

// Inclure la classe de base
if (file_exists(__DIR__ . '/class-ugm-metabox.php')) {
    include_once __DIR__ . '/class-ugm-metabox.php';
}

// Inclure les metaboxes
include_once __DIR__ . '/inc/donnesdubien_0.php';

add_action('admin_enqueue_scripts', function($hook) {
    if (!in_array($hook, array('post.php','post-new.php'), true)) {
        return;
    }
    if (defined('UGM_PLUGIN_VERSION')) {
        return;
    }
    if (wp_script_is('up-gutenberg-metabox-binding-copy', 'enqueued') || wp_script_is('up-gutenberg-metabox-binding-copy', 'registered')) {
        return;
    }
    $base = get_stylesheet_directory_uri() . '/functions/metabox/assets/';
    wp_enqueue_script('ugm-metabox-binding-copy', $base . 'js/metabox-binding-copy.js', array('jquery'), '1.0.0', true);
    wp_enqueue_style('ugm-metabox-binding-copy', $base . 'css/metabox-binding-copy.css', array(), '1.0.0');
    
    // Gallery assets pour les champs de type gallery
    wp_enqueue_media();
    wp_enqueue_script('ugm-metabox-gallery', $base . 'js/metabox-gallery.js', array('jquery', 'jquery-ui-sortable'), '1.0.0', true);
    wp_enqueue_style('ugm-metabox-gallery', $base . 'css/metabox-gallery.css', array(), '1.0.0');
    wp_localize_script('ugm-metabox-gallery', 'ugm_gallery_i18n', array(
        'selectImages' => __('Choisir des images', 'textdomain'),
        'remove' => __('Retirer', 'textdomain'),
    ));
});
