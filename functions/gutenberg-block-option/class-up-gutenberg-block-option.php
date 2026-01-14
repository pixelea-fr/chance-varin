<?php
if (!defined('ABSPATH')) { exit; }
class UP_Gutenberg_Block_Option {
    private static $instance = null;
    public static function get_instance() {
        if (null === self::$instance) { self::$instance = new self(); }
        return self::$instance;
    }
    private function __construct() {
        add_action('rest_api_init', array($this, 'register_rest'));
        add_action('enqueue_block_editor_assets', array($this, 'enqueue_editor'));
    }
    public function enqueue_editor() {
        if (wp_script_is('up-block-switches-editor', 'registered') || wp_script_is('up-block-switches-editor', 'enqueued')) { return; }
        $src = get_stylesheet_directory_uri() . '/functions/gutenberg-block-option/assets/editor.js';
        $deps = array('wp-blocks','wp-i18n','wp-element','wp-components','wp-compose','wp-data','wp-edit-post','wp-plugins','wp-api-fetch','wp-hooks','wp-block-editor');
        wp_enqueue_script('up-block-switches-editor', $src, $deps, filemtime(__DIR__ . '/assets/editor.js'), true);
        $nonce = wp_create_nonce('wp_rest');
        wp_add_inline_script('wp-api-fetch', 'wp.apiFetch.use( wp.apiFetch.createNonceMiddleware( "' . $nonce . '" ) );');
    }
    public function register_rest() {
        register_rest_route('up/v1', '/switches', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_switches'),
            'permission_callback' => function(){ return current_user_can('edit_posts'); },
        ));
    }
    public function get_switches(\WP_REST_Request $request) {
        $sources = get_option('up_ge_control_sources', array());
        if (!is_array($sources)) { $sources = array(); }

        // 1) Controls du thème (JSON)
        $themeControls = array();
        $dir = __DIR__ . '/inc/';
        $files = glob($dir . '*.json');
        if (is_array($files)) {
            foreach ($files as $file) {
                if (!is_file($file) || !is_readable($file)) { continue; }
                $raw = file_get_contents($file);
                $decoded = json_decode($raw, true);
                if (!is_array($decoded) || empty($decoded['block']) || empty($decoded['control']) || !is_array($decoded['control'])) { continue; }
                $block = (string) $decoded['block'];
                $control = $decoded['control'];
                if (empty($control['id'])) { continue; }
                $key = $block . '|' . (string)$control['id'];
                $themeControls[$key] = array('block' => $block, 'control' => $control);
            }
        }

        // 2) Controls du filtre
        $filterControls = array();
        $filtered = apply_filters('up_block_switches', array());
        if (is_array($filtered)) {
            foreach ($filtered as $b => $controls) {
                if (!is_array($controls)) { continue; }
                foreach ($controls as $c) {
                    if (!is_array($c) || empty($c['id'])) { continue; }
                    $key = (string)$b . '|' . (string)$c['id'];
                    $filterControls[$key] = array('block' => (string)$b, 'control' => $c);
                }
            }
        }

        // 3) Résolution de source et construction
        $allKeys = array_unique(array_merge(array_keys($themeControls), array_keys($filterControls)));
        $out = array();
        foreach ($allKeys as $key) {
            $wanted = isset($sources[$key]) ? (string)$sources[$key] : '';
            if ($wanted !== 'theme' && $wanted !== 'filter' && $wanted !== 'plugin') {
                $wanted = isset($themeControls[$key]) ? 'theme' : 'filter';
            }
            // plugin n'existe pas ici: fallback theme > filter
            if ($wanted === 'plugin') {
                $wanted = isset($themeControls[$key]) ? 'theme' : 'filter';
            }

            $entry = null;
            if ($wanted === 'theme' && isset($themeControls[$key])) {
                $entry = $themeControls[$key];
            } elseif ($wanted === 'filter' && isset($filterControls[$key])) {
                $entry = $filterControls[$key];
            }

            if (!$entry) {
                // fallback si la source choisie n'est pas dispo
                if (isset($themeControls[$key])) { $entry = $themeControls[$key]; }
                elseif (isset($filterControls[$key])) { $entry = $filterControls[$key]; }
            }
            if (!$entry) { continue; }

            $block = (string)$entry['block'];
            $control = $entry['control'];
            if (!isset($out[$block])) { $out[$block] = array(); }
            $out[$block][] = $control;
        }

        return new \WP_REST_Response($out, 200);
    }
}

if (!class_exists('Up_Block_Switches')) {
    UP_Gutenberg_Block_Option::get_instance();
}
