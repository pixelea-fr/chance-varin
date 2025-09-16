<?php
function up_enqueue_dynamic_styles() {
    if ( ! is_singular() ) return;

    global $post;
    if ( ! $post ) return;

    $sources = apply_filters( 'up_style_sources', [] );
    if ( empty( $sources ) ) return;

    $found = [];

    foreach ( $sources as $source ) {
        $base_dir     = $source['base_dir'] ?? '';
        $trigger_ext  = $source['trigger_ext'] ?? 'json';
        $load_ext     = $source['load_ext'] ?? 'css';

        $base_path = get_template_directory() . '/' . untrailingslashit( $base_dir ) . '/';
        $base_url  = get_template_directory_uri() . '/' . untrailingslashit( $base_dir ) . '/';

        if ( ! is_dir( $base_path ) ) continue;

        $trigger_files = glob( $base_path . '*.' . $trigger_ext );
        $load_files    = glob( $base_path . '*.' . $load_ext );

        $slugs = array_map(
            fn( $path ) => basename( $path, '.' . $trigger_ext ),
            $trigger_files
        );

        $load_map = [];
        foreach ( $load_files as $file ) {
            $slug = basename( $file, '.' . $load_ext );
            $load_map[$slug] = $base_url . basename( $file );
        }

        $valid = array_intersect_key( $load_map, array_flip( $slugs ) );

        $blocks = parse_blocks( $post->post_content );

        $check_blocks = function( $blocks ) use ( &$check_blocks, &$found, $valid, $trigger_ext ) {
            foreach ( $blocks as $block ) {
                if ( ! empty( $block['attrs']['className'] ) ) {
                    foreach ( $valid as $slug => $url ) {
                        $class_to_check = $trigger_ext === 'json'
                            ? 'is-style-' . $slug
                            : $slug;

                        if ( strpos( $block['attrs']['className'], $class_to_check ) !== false ) {
                            $found[ $slug ] = $url;
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

    foreach ( $found as $slug => $url ) {
        wp_enqueue_style( 'up-style-' . $slug, $url, [], '1.0' );
    }
}
add_action( 'wp_enqueue_scripts', 'up_enqueue_dynamic_styles' );


// Alternative : Hook spécifique pour add_editor_style
function up_add_editor_styles() {
    $sources = apply_filters( 'up_style_sources', [] );
    if ( empty( $sources ) ) return;

    foreach ( $sources as $source ) {
        $base_dir = $source['base_dir'] ?? '';
        $load_ext = $source['load_ext'] ?? 'css';
        $base_path = get_template_directory() . '/' . untrailingslashit( $base_dir ) . '/';

        if ( ! is_dir( $base_path ) ) continue;

        $editor_files = glob( $base_path . '*.editor.' . $load_ext );
        foreach ( $editor_files as $file ) {
            $relative_path = untrailingslashit( $base_dir ) . '/' . basename( $file );
            add_editor_style( $relative_path );
        }
    }
}
add_action( 'after_setup_theme', 'up_add_editor_styles' );


add_filter( 'up_style_sources', function( $sources ) {
    // Exemple 1 : styles/blocks avec .json → is-style-[slug]
    $sources[] = [
        'base_dir'     => 'styles/sections',
        'trigger_ext'  => 'json',
        'load_ext'     => 'css',
    ];

    // Exemple 2 : variations avec .js → is-style-[slug]
    $sources[] = [
        'base_dir'     => 'assets/variations',
        'trigger_ext'  => 'js',
        'load_ext'     => 'css',
    ];

    return $sources;
});