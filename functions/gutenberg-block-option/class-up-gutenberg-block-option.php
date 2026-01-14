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
        $mode = get_option('up_ge_source_mode', 'merge');
        if (!is_string($mode)) { $mode = 'merge'; }
        $mode = sanitize_key($mode);
        if ($mode !== 'plugin' && $mode !== 'filter' && $mode !== 'theme' && $mode !== 'merge') { $mode = 'merge'; }

        // 1) Controls du thème (JSON)
        $themeOut = array();
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
                if (!isset($themeOut[$block])) { $themeOut[$block] = array(); }
                $themeOut[$block][] = $control;
            }
        }

        // 2) Controls du filtre
        $filterOut = array();
        $filtered = apply_filters('up_block_switches', array());
        if (is_array($filtered)) {
            foreach ($filtered as $b => $controls) {
                if (!is_array($controls)) { continue; }
                $filterOut[(string)$b] = $controls;
            }
        }

        // 3) Controls du plugin (option WP, même si le plugin est désactivé)
        $pluginOut = get_option('up_ge_switches_config', array());
        if (!is_array($pluginOut)) { $pluginOut = array(); }

        if ($mode === 'plugin') { return new \WP_REST_Response($pluginOut, 200); }
        if ($mode === 'filter') { return new \WP_REST_Response($filterOut, 200); }
        if ($mode === 'theme') { return new \WP_REST_Response($themeOut, 200); }

        // merge: plugin + filtre + thème (thème override filtre override plugin)
        $merged = array();
        foreach (array($pluginOut, $filterOut, $themeOut) as $conf) {
            if (!is_array($conf)) { continue; }
            foreach ($conf as $block => $controls) {
                if (!is_array($controls)) { continue; }
                if (!isset($merged[$block])) { $merged[$block] = array(); }
                foreach ($controls as $control) {
                    if (!is_array($control) || empty($control['id'])) { continue; }
                    $found = null;
                    foreach ($merged[$block] as $i => $existing) {
                        if (is_array($existing) && isset($existing['id']) && $existing['id'] === $control['id']) { $found = $i; break; }
                    }
                    if (null !== $found) {
                        $merged[$block][$found] = array_merge($merged[$block][$found], $control);
                    } else {
                        $merged[$block][] = $control;
                    }
                }
            }
        }

        return new \WP_REST_Response($merged, 200);
    }
}

if (!class_exists('Up_Block_Switches')) {
    UP_Gutenberg_Block_Option::get_instance();
}
