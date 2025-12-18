<?php
/**
 * Scanner patterns_json → variations de core/group
 * Ajouter dans functions.php ou dans un plugin
 */
add_action( 'init', 'cv_register_variations_from_json' );

function cv_register_variations_from_json() {
    $dir = get_theme_file_path( 'patterns_json' );

    if ( ! is_dir( $dir ) ) {
        return;
    }

    /* on va lire tous les fichiers .json */
    $files = glob( "$dir/*.json" );

    foreach ( $files as $file ) {
        $raw = file_get_contents( $file );
        $data = json_decode( $raw, true );

        /* on s’assure d’avoir le minimum */
        if ( empty( $data['title'] ) || empty( $data['content'] ) ) {
            continue;
        }

        /* on fabrique un slug propre */
        $name = sanitize_title( $data['title'] );

        /* on parse le HTML pour récupérer les attributs du premier groupe
           (facultatif, mais pratique si tu veux conserver className, style…) */
        libxml_use_internal_errors( true );
        $dom = new DOMDocument();
        $dom->loadHTML( '<?xml encoding="UTF-8">' . $data['content'], LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );
        $xpath = new DOMXPath( $dom );
        $group = $xpath->query( '//div[contains(@class,"wp-block-group")]' )->item( 0 );

        $attrs = [];
        if ( $group ) {
            /* className */
            $class = $group->getAttribute( 'class' );
            if ( $class ) {
                $attrs['className'] = implode( ' ', array_diff( explode( ' ', $class ), [ 'wp-block-group' ] ) );
            }
            /* on pourrait aussi récupérer des styles inline, data-*, etc. */
        }
        libxml_clear_errors();

        /* keywords : on prend ceux du JSON, sinon on découpe le titre */
        $keywords = $data['keywords'] ?? [];
        if ( ! $keywords ) {
            $keywords = explode( ' ', strtolower( $data['title'] ) );
        }

        /* on parse le contenu en innerBlocks */
        $parsed = parse_blocks( $data['content'] );
        $innerBlocks = array_map( 'cv_normalize_inner_block', $parsed );

        /* on enregistre la variation */
        register_block_variation( 'core/group', [
            'name'        => $name,
            'title'       => $data['title'],
            'description' => $data['description'] ?? '',
            'keywords'    => $keywords,
            'attributes'  => $attrs,
            'scope'       => [ 'inserter' ],   // visible dans / et +
            'innerBlocks' => $innerBlocks,
        ] );
    }
}

/* helper : convertit un bloc parsé en format attendu par innerBlocks */
function cv_normalize_inner_block( $block ) {
    $inner = [];
    if ( ! empty( $block['innerBlocks'] ) ) {
        $inner = array_map( 'cv_normalize_inner_block', $block['innerBlocks'] );
    }
    return [
        $block['blockName'],
        $block['attrs'] ?? [],
        $inner
    ];
}