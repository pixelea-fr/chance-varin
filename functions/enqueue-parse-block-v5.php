<?php
/**
 * Front-end : charge les CSS quand le bloc est présent
 * Supporte :
 *  – base_dir : dossier des triggers (.json/.js)
 *  – css_dir  : dossier des CSS (si différent)
 */
function up_enqueue_dynamic_styles() {
    if ( ! is_singular() ) return;

    global $post;
    if ( ! $post ) return;

    $sources = apply_filters( 'up_style_sources', [] );
    if ( empty( $sources ) ) return;

    $found = [];

    foreach ( $sources as $source ) {
        $base_dir    = $source['base_dir'] ?? '';
        $css_dir     = $source['css_dir']  ?? $base_dir; // fallback sur base_dir
        $trigger_ext = $source['trigger_ext'] ?? 'json';
        $load_ext    = $source['load_ext']    ?? 'css';

        // chemins des triggers
        $trigger_path = get_template_directory() . '/' . untrailingslashit( $base_dir ) . '/';
        if ( ! is_dir( $trigger_path ) ) continue;

        // chemins des CSS
        $css_path = get_template_directory() . '/' . untrailingslashit( $css_dir ) . '/';
        $css_url  = get_template_directory_uri() . '/' . untrailingslashit( $css_dir ) . '/';

        $trigger_files = glob( $trigger_path . '*.' . $trigger_ext );
        $slugs         = array_map( fn( $p ) => basename( $p, '.' . $trigger_ext ), $trigger_files );

        // CSS : .front.css + .css neutres
        $front_files   = glob( $css_path . '*.front.' . $load_ext );
        $regular_files = array_filter(
            glob( $css_path . '*.' . $load_ext ),
            fn( $f ) => ! str_contains( basename( $f ), '.editor.' ) && ! str_contains( basename( $f ), '.front.' )
        );

        $load_map = [];
        foreach ( $front_files as $file ) {
            $slug = str_replace( '.front.' . $load_ext, '', basename( $file ) );
            $load_map[$slug][] = $css_url . basename( $file );
        }
        foreach ( $regular_files as $file ) {
            $slug = basename( $file, '.' . $load_ext );
            $load_map[$slug][] = $css_url . basename( $file );
        }

        $valid = array_intersect_key( $load_map, array_flip( $slugs ) );

        $blocks = parse_blocks( $post->post_content );
        $check_blocks = function( $blocks ) use ( &$check_blocks, &$found, $valid, $trigger_ext ) {
            foreach ( $blocks as $block ) {
                if ( ! empty( $block['attrs']['className'] ) ) {
                    foreach ( $valid as $slug => $urls ) {
                        $class = $trigger_ext === 'json' ? 'is-style-' . $slug : $slug;
                        if ( str_contains( $block['attrs']['className'], $class ) ) {
                            $found[$slug] = array_merge( $found[$slug] ?? [], $urls );
                        }
                    }
                }
                if ( ! empty( $block['innerBlocks'] ) ) $check_blocks( $block['innerBlocks'] );
            }
        };
        $check_blocks( $blocks );
    }

    // Enqueue
    foreach ( $found as $slug => $urls ) {
        $urls = array_unique( $urls );
        foreach ( $urls as $idx => $url ) {
            wp_enqueue_style( 'up-style-' . $slug . '-' . $idx, $url, [], '1.0' );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'up_enqueue_dynamic_styles' );

/**
 * Back-office : éditeur
 * (inchangé, on garde base_dir pour l’instant)
 */
function up_add_editor_styles() {
    $sources = apply_filters( 'up_style_sources', [] );
    if ( empty( $sources ) ) return;

    foreach ( $sources as $source ) {
        $base_dir = $source['base_dir'] ?? '';
        $css_dir  = $source['css_dir']  ?? $base_dir; // même logique
        $load_ext = $source['load_ext'] ?? 'css';

        $css_path = get_template_directory() . '/' . untrailingslashit( $css_dir ) . '/';
        if ( ! is_dir( $css_path ) ) continue;

        // 1. .editor.css
        foreach ( glob( $css_path . '*.editor.' . $load_ext ) as $file ) {
            add_editor_style( untrailingslashit( $css_dir ) . '/' . basename( $file ) );
        }

        // 2. .css neutres
        foreach ( glob( $css_path . '*.' . $load_ext ) as $file ) {
            $bn = basename( $file );
            if ( str_contains( $bn, '.editor.' ) || str_contains( $bn, '.front.' ) ) continue;
            add_editor_style( untrailingslashit( $css_dir ) . '/' . $bn );
        }
    }
}
add_action( 'after_setup_theme', 'up_add_editor_styles' );
/** ____________________________________________________________ */

/* ----------------------------------------------------------
 *  FRONT : scripts dynamiques  (VERSION FINALE)
 * ---------------------------------------------------------- */
function up_enqueue_dynamic_scripts() {
    if ( ! is_singular() ) {
        return;
    }

    $post = get_post();
    if ( ! $post ) {
        return;
    }

    $sources = apply_filters( 'up_style_sources', [] );
    if ( empty( $sources ) ) {
        return;
    }

    $found = [];

    foreach ( $sources as $source ) {
        $base_dir    = $source['base_dir'] ?? '';
        $js_dir      = $source['js_dir']   ?? $base_dir . '/assets/js';
        $trigger_ext = $source['trigger_ext'] ?? 'json';
        $load_ext    = $source['load_ext']    ?? 'js';
        $load_ext ="js";

        // dossier des triggers
        $trigger_path = get_template_directory() . '/' . untrailingslashit( $base_dir ) . '/';
        if ( ! is_dir( $trigger_path ) ) {
            continue;
        }

        // dossier des scripts
        $js_path = get_template_directory() . '/' . untrailingslashit( $js_dir ) . '/';
        $js_url  = get_template_directory_uri() . '/' . untrailingslashit( $js_dir ) . '/';
        if ( ! is_dir( $js_path ) ) {
            continue;
        }

        // slugs déduits des triggers
        $trigger_files = glob( $trigger_path . '*.' . $trigger_ext );
        $slugs         = array_map( fn( $p ) => basename( $p, '.' . $trigger_ext ), $trigger_files );

        // fichiers JS à charger en front :
        // 1) neutres  (*.js)
        // 2) front     (*.front.js)
        // on ignore : *.editor.js
        $neutre_files = array_filter(
            glob( $js_path . '*.' . $load_ext ),
            fn( $f ) => ! str_contains( basename( $f ), '.' ) || substr_count( basename( $f ), '.' ) === 1
        );
        $front_files  = glob( $js_path . '*.front.' . $load_ext );

        $load_map = [];
        foreach ( $neutre_files as $file ) {
            $slug = basename( $file, '.' . $load_ext );
            $load_map[ $slug ][] = $js_url . basename( $file );
        }
        foreach ( $front_files as $file ) {
            $slug = str_replace( '.front.' . $load_ext, '', basename( $file ) );
            $load_map[ $slug ][] = $js_url . basename( $file );
        }

        $valid = array_intersect_key( $load_map, array_flip( $slugs ) );

        // parcours des blocs
        $blocks = parse_blocks( $post->post_content );
        $check_blocks = function ( $blocks ) use ( &$check_blocks, &$found, $valid, $trigger_ext ) {
            foreach ( $blocks as $block ) {
                if ( ! empty( $block['attrs']['className'] ) ) {
                    foreach ( $valid as $slug => $urls ) {
                        $class = $trigger_ext === 'json' ? 'is-style-' . $slug : $slug;
                        if ( str_contains( $block['attrs']['className'], $class ) ) {
                            $found[ $slug ] = array_merge( $found[ $slug ] ?? [], $urls );
                        }
                    }
                }
                if ( ! empty( $block['innerBlocks'] ) ) {
                    $check_blocks( $block['innerBlocks'] );
                }
            }
        };
        $check_blocks( $blocks );
    }

    // enqueue
    foreach ( $found as $slug => $urls ) {
        $urls = array_unique( $urls );
        foreach ( $urls as $idx => $url ) {
            wp_enqueue_script( 'up-script-' . $slug . '-' . $idx, $url, [ 'jquery' ], '1.0', true );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'up_enqueue_dynamic_scripts' );

/* ----------------------------------------------------------
 *  BACK : scripts éditeur (bloc)
 * ---------------------------------------------------------- */
function up_enqueue_editor_scripts() {
    $sources = apply_filters( 'up_style_sources', [] );
    if ( empty( $sources ) ) {
        return;
    }

    foreach ( $sources as $source ) {
        $base_dir = $source['base_dir'] ?? '';
        $js_dir   = $source['js_dir']   ?? $base_dir . '/assets/js';
        $load_ext ="js";

        $js_path = get_template_directory() . '/' . untrailingslashit( $js_dir ) . '/';
        if ( ! is_dir( $js_path ) ) {
            continue;
        }

        // 1) .editor.js
        foreach ( glob( $js_path . '*.editor.' . $load_ext ) as $file ) {
            wp_enqueue_script(
                'up-editor-' . basename( $file, '.' . $load_ext ),
                get_template_directory_uri() . '/' . untrailingslashit( $js_dir ) . '/' . basename( $file ),
                [ 'wp-blocks', 'wp-element', 'wp-editor' ],
                '1.0',
                true
            );
        }

        // 2) neutres
        foreach ( glob( $js_path . '*.' . $load_ext ) as $file ) {
            $bn = basename( $file );
        
            if ( str_contains( $bn, '.editor.' ) || str_contains( $bn, '.front.' ) ) {
                continue;
            }
            wp_enqueue_script(
                'up-editor-' . basename( $file, '.' . $load_ext ),
                get_template_directory_uri() . '/' . untrailingslashit( $js_dir ) . '/' . $bn,
                [ 'wp-blocks', 'wp-element', 'wp-editor' ],
                '1.0',
                true
            );
        }
    }
}
add_action( 'enqueue_block_editor_assets', 'up_enqueue_editor_scripts' );
/** ____________________________________________________________
 * Sources
 */
add_filter( 'up_style_sources', function ( $sources ) {
    // triggers dans styles/sections, CSS dans assets/css/block
    $sources[] = [
        'base_dir'    => 'styles/sections',
       'css_dir'     => 'assets/css/sections', 
       'js_dir'   => 'styles/sections/assets/js',
        'trigger_ext' => 'json',
        'load_ext'    => 'css',
    ];

    // triggers + CSS dans le même dossier
    $sources[] = [
        'base_dir'    => 'variations',
        'css_dir'     => 'assets/css/variations',
        'trigger_ext' => 'js',
        'load_ext'    => 'css',
    ];

    return $sources;
} );