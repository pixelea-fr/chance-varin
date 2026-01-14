<?php

function chance_varin_register_taxonomy_genre() {
    $labels = array(
        'name'                       => __('Genres', 'chance-varin'),
        'singular_name'              => __('Genre', 'chance-varin'),
        'search_items'               => __('Rechercher un genre', 'chance-varin'),
        'all_items'                  => __('Tous les genres', 'chance-varin'),
        'edit_item'                  => __('Modifier le genre', 'chance-varin'),
        'update_item'                => __('Mettre à jour le genre', 'chance-varin'),
        'add_new_item'               => __('Ajouter un genre', 'chance-varin'),
        'new_item_name'              => __('Nouveau genre', 'chance-varin'),
        'menu_name'                  => __('Genres', 'chance-varin'),
    );

    register_taxonomy(
        'genre',
        array('bien'),
        array(
            'labels'            => $labels,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_rest'      => true,
            'hierarchical'      => false,
            'query_var'         => 'genre',
            'rewrite'           => array(
                'slug'       => 'genre',
                'with_front' => false,
            ),
        )
    );
}
add_action('init', 'chance_varin_register_taxonomy_genre', 5);

function chance_varin_ensure_genre_terms() {
    $defaults = array('location', 'vente', 'viager');

    foreach ($defaults as $slug) {
        if (!term_exists($slug, 'genre')) {
            wp_insert_term(
                ucfirst($slug),
                'genre',
                array('slug' => $slug)
            );
        }
    }
}
add_action('init', 'chance_varin_ensure_genre_terms', 20);

function chance_varin_genre_add_root_term_rewrite_rules() {
    $terms = get_terms(array(
        'taxonomy'   => 'genre',
        'hide_empty' => false,
        'fields'     => 'slugs',
    ));

    if (is_wp_error($terms) || empty($terms)) {
        return;
    }

    foreach ($terms as $slug) {
        add_rewrite_rule('^' . preg_quote($slug, '/') . '/?$', 'index.php?genre=' . $slug, 'top');
    }
}
add_action('init', 'chance_varin_genre_add_root_term_rewrite_rules', 30);

function chance_varin_genre_term_link_root($termlink, $term, $taxonomy) {
    if ($taxonomy !== 'genre') {
        return $termlink;
    }

    return home_url(user_trailingslashit($term->slug));
}
add_filter('term_link', 'chance_varin_genre_term_link_root', 10, 3);

function chance_varin_genre_flush_rewrite_rules_on_theme_switch() {
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'chance_varin_genre_flush_rewrite_rules_on_theme_switch');
