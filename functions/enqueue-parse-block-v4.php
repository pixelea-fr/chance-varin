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
        
        // On récupère tous les fichiers CSS avec différents patterns
        $front_files = glob( $base_path . '*.front.' . $load_ext );  // .front.css
        $regular_files = glob( $base_path . '*.' . $load_ext );      // .css (sans .editor ni .front)
        
        
        // Filtrer les fichiers .css pour exclure ceux qui ont .editor ou .front
        $regular_files = array_filter( $regular_files, function( $file ) use ( $load_ext ) {
            $basename = basename( $file );
            // Exclure les fichiers qui contiennent .editor. ou .front. dans leur nom
            return ! str_contains( $basename, '.editor.' ) && ! str_contains( $basename, '.front.' );
        });


        $slugs = array_map(
            fn( $path ) => basename( $path, '.' . $trigger_ext ),
            $trigger_files
        );

        // 🔥 NOUVELLE LOGIQUE : Tableau pour stocker plusieurs URLs par slug
        $load_map = [];
        
        // Traiter les fichiers .front.css
        foreach ( $front_files as $file ) {
            $basename = basename( $file );
            $slug = str_replace( '.front.' . $load_ext, '', $basename );
            if ( !isset( $load_map[$slug] ) ) {
                $load_map[$slug] = [];
            }
            $load_map[$slug][] = $base_url . $basename;
        }
        
        // Traiter les fichiers .css (sans .editor ni .front)
        foreach ( $regular_files as $file ) {
            $basename = basename( $file );
            $slug = basename( $file, '.' . $load_ext );
            if ( !isset( $load_map[$slug] ) ) {
                $load_map[$slug] = [];
            }
            $load_map[$slug][] = $base_url . $basename;
        }

        // 🔥 MODIFICATION : Intersection avec les slugs valides
        $valid_slugs = array_flip( $slugs );
        $valid_load_map = [];
        foreach ( $load_map as $slug => $urls ) {
            if ( isset( $valid_slugs[$slug] ) ) {
                $valid_load_map[$slug] = $urls;
            }
        }

        $blocks = parse_blocks( $post->post_content );

        $check_blocks = function( $blocks ) use ( &$check_blocks, &$found, $valid_load_map, $trigger_ext ) {
            foreach ( $blocks as $block ) {
                if ( ! empty( $block['attrs']['className'] ) ) {
                    foreach ( $valid_load_map as $slug => $urls ) {
                        $class_to_check = $trigger_ext === 'json'
                            ? 'is-style-' . $slug
                            : $slug;

                        if ( strpos( $block['attrs']['className'], $class_to_check ) !== false ) {
                            // 🔥 MODIFICATION : Ajouter toutes les URLs pour ce slug
                            if ( !isset( $found[$slug] ) ) {
                                $found[$slug] = [];
                            }
                            $found[$slug] = array_merge( $found[$slug], $urls );
                            $found[$slug] = array_unique( $found[$slug] ); // Éviter les doublons
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

    // 🔥 MODIFICATION : Enqueue tous les styles pour chaque slug
    foreach ( $found as $slug => $urls ) {
        if ( is_array( $urls ) ) {
            foreach ( $urls as $index => $url ) {
                wp_enqueue_style( 'up-style-' . $slug . '-' . $index, $url, [], '1.0' );
            }
        } else {
            wp_enqueue_style( 'up-style-' . $slug, $urls, [], '1.0' );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'up_enqueue_dynamic_styles' );

function up_add_editor_styles() {
    $sources = apply_filters( 'up_style_sources', [] );
    if ( empty( $sources ) ) return;

    foreach ( $sources as $source ) {
        $base_dir = $source['base_dir'] ?? '';
        $load_ext = $source['load_ext'] ?? 'css';
        $base_path = get_template_directory() . '/' . untrailingslashit( $base_dir ) . '/';
        if ( ! is_dir( $base_path ) ) continue;

        // 1. fichiers .editor.css
        foreach ( glob( $base_path . '*.editor.' . $load_ext ) as $file ) {
            add_editor_style( untrailingslashit( $base_dir ) . '/' . basename( $file ) );
        }

        // 2. fichiers .css mais PAS .editor. ni .front.
        foreach ( glob( $base_path . '*.' . $load_ext ) as $file ) {
            $bn = basename( $file );
            if ( str_contains( $bn, '.editor.' ) || str_contains( $bn, '.front.' ) ) continue;
           add_editor_style( untrailingslashit( $base_dir ) . '/' . $bn );
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