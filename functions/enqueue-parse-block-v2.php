<?php
/*
* Enqueue styles/scripts dynamiques selon les sources filtrables
 * Front : .css / .js
 * Editor : .editor.css / .editor.js
 */
function up_enqueue_dynamic_assets() {
    if ( ! is_singular() && ! is_admin() ) return;

    global $post;
    if ( ! $post && ! is_admin() ) return;

    $sources = apply_filters( 'up_asset_sources', [] );
    if ( empty( $sources ) ) return;

    $found = [
        'front' => [ 'css' => [], 'js' => [] ],
        'editor'=> [ 'css' => [], 'js' => [] ],
    ];

    foreach ( $sources as $source ) {
        $base_dir     = $source['base_dir']     ?? '';
        $trigger_ext  = $source['trigger_ext']  ?? 'json';
        $class_prefix = $source['class_prefix'] ?? '';

        $base_path = get_template_directory() . '/' . untrailingslashit( $base_dir ) . '/';
        $base_url  = get_template_directory_uri() . '/' . untrailingslashit( $base_dir ) . '/';

        if ( ! is_dir( $base_path ) ) continue;

        // Slugs depuis les fichiers déclencheurs
        $trigger_files = glob( $base_path . '*.' . $trigger_ext );
        $slugs = array_map( fn( $p ) => basename( $p, '.' . $trigger_ext ), $trigger_files );

        // Scan des assets
        $scan = function( $ext, $suffix = '' ) use ( $base_path, $base_url, &$found, $slugs, $trigger_ext, $class_prefix ) {
            $files = glob( $base_path . '*' . $suffix . '.' . $ext );
            foreach ( $files as $file ) {
                $slug = basename( $file, $suffix . '.' . $ext );
                if ( ! in_array( $slug, $slugs, true ) ) continue;

                $key = $suffix === '.editor' ? 'editor' : 'front';
                $found[ $key ][ $ext ][ $slug ] = $base_url . basename( $file );
            }
        };

        $scan( 'css', '' );        // front.css
        $scan( 'css', '.editor' ); // editor.css
        $scan( 'js',  '' );        // front.js
        $scan( 'js',  '.editor' ); // editor.js
    }

    // Classes utilisées dans le contenu
    $used_classes = [];
    if ( $post ) {
        $blocks = parse_blocks( $post->post_content );
        $collect = function( $blocks ) use ( &$collect, &$used_classes ) {
            foreach ( $blocks as $block ) {
                if ( ! empty( $block['attrs']['className'] ) ) {
                    $used_classes = array_merge( $used_classes, explode( ' ', $block['attrs']['className'] ) );
                }
                if ( ! empty( $block['innerBlocks'] ) ) $collect( $block['innerBlocks'] );
            }
        };
        $collect( $blocks );
    }
    $used_classes = array_unique( $used_classes );

    // Helper : classe correspondante au slug
    $class_for_slug = fn( $slug, $trigger_ext ) => $trigger_ext === 'json'
        ? 'is-style-' . $slug
        : $slug;

    // Enqueue front
    if ( ! is_admin() ) {
        foreach ( $found['front']['css'] as $slug => $url ) {
            if ( in_array( $class_for_slug( $slug, 'json' ), $used_classes, true ) ) {
                wp_enqueue_style(  " -$slug",  $url, [], '1.0' );
            }
        }
        foreach ( $found['front']['js'] as $slug => $url ) {
            if ( in_array( $class_for_slug( $slug, 'json' ), $used_classes, true ) ) {
                wp_enqueue_script( "up-script-$slug", $url, [], '1.0', true );
            }
        }
    }

    // Enqueue editor (back-office)
    if ( is_admin() ) {
        foreach ( $found['editor']['css'] as $slug => $url ) {
            wp_enqueue_style(  "up-editor-style-$slug",  $url, [], '1.0' );
        }
        foreach ( $found['editor']['js'] as $slug => $url ) {
            wp_enqueue_script( "up-editor-script-$slug", $url, [], '1.0', true );
        }
    }
}

// Hooks
add_action( 'wp_enqueue_scripts', 'up_enqueue_dynamic_assets' );
add_action( 'admin_enqueue_scripts', 'up_enqueue_dynamic_assets' );

add_filter( 'up_asset_sources', function( $sources ) {
    // Dossier styles/blocks : json → is-style-[slug]
    $sources[] = [
        'base_dir'     => 'styles/sections',
        'trigger_ext'  => 'json',
    ];

    // Dossier variations : json → is-style-[slug]
    $sources[] = [
        'base_dir'     => 'assets/variations',
        'trigger_ext'  => 'js',
    ];

    // Tu peux en ajouter autant que tu veux
    return $sources;
});