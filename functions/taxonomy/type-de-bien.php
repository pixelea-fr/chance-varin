<?php

function chance_varin_register_taxonomy_type_de_bien() {
    $labels = array(
        'name'                       => __('Types de bien', 'chance-varin'),
        'singular_name'              => __('Type de bien', 'chance-varin'),
        'search_items'               => __('Rechercher un type', 'chance-varin'),
        'all_items'                  => __('Tous les types', 'chance-varin'),
        'edit_item'                  => __('Modifier le type', 'chance-varin'),
        'update_item'                => __('Mettre à jour le type', 'chance-varin'),
        'add_new_item'               => __('Ajouter un type', 'chance-varin'),
        'new_item_name'              => __('Nouveau type', 'chance-varin'),
        'menu_name'                  => __('Types de bien', 'chance-varin'),
    );

    register_taxonomy(
        'type_de_bien',
        array('bien'),
        array(
            'labels'            => $labels,
            'public'            => false,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_rest'      => true,
            'hierarchical'      => true,
        )
    );
}
add_action('init', 'chance_varin_register_taxonomy_type_de_bien', 5);

function chance_varin_ensure_type_de_bien_terms() {
    $defaults = array('maison', 'appartement', 'terrain');

    foreach ($defaults as $slug) {
        if (!term_exists($slug, 'type_de_bien')) {
            wp_insert_term(
                ucfirst($slug),
                'type_de_bien',
                array('slug' => $slug)
            );
        }
    }
}
add_action('init', 'chance_varin_ensure_type_de_bien_terms', 20);
