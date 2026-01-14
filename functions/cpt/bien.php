<?php
/**
 * Register Custom Post Type for Biens Immobiliers
 */
function up_register_cpt_bien() {

	$labels = array(
		'name'                  => _x( 'Biens', 'Post Type General Name', 'chance-varin' ),
		'singular_name'         => _x( 'Bien', 'Post Type Singular Name', 'chance-varin' ),
		'menu_name'             => __( 'Biens Immobiliers', 'chance-varin' ),
		'name_admin_bar'        => __( 'Bien', 'chance-varin' ),
		'archives'              => __( 'Archives des biens', 'chance-varin' ),
		'attributes'            => __( 'Attributs du bien', 'chance-varin' ),
		'parent_item_colon'     => __( 'Bien parent :', 'chance-varin' ),
		'all_items'             => __( 'Tous les biens', 'chance-varin' ),
		'add_new_item'          => __( 'Ajouter un nouveau bien', 'chance-varin' ),
		'add_new'               => __( 'Ajouter', 'chance-varin' ),
		'new_item'              => __( 'Nouveau bien', 'chance-varin' ),
		'edit_item'             => __( 'Modifier le bien', 'chance-varin' ),
		'update_item'           => __( 'Mettre à jour le bien', 'chance-varin' ),
		'view_item'             => __( 'Voir le bien', 'chance-varin' ),
		'view_items'            => __( 'Voir les biens', 'chance-varin' ),
		'search_items'          => __( 'Rechercher un bien', 'chance-varin' ),
		'not_found'             => __( 'Aucun bien trouvé', 'chance-varin' ),
		'not_found_in_trash'    => __( 'Aucun bien trouvé dans la corbeille', 'chance-varin' ),
		'featured_image'        => __( 'Image mise en avant', 'chance-varin' ),
		'set_featured_image'    => __( 'Définir l\'image mise en avant', 'chance-varin' ),
		'remove_featured_image' => __( 'Supprimer l\'image mise en avant', 'chance-varin' ),
		'use_featured_image'    => __( 'Utiliser comme image mise en avant', 'chance-varin' ),
		'insert_into_item'      => __( 'Insérer dans le bien', 'chance-varin' ),
		'uploaded_to_this_item' => __( 'Téléversé sur ce bien', 'chance-varin' ),
		'items_list'            => __( 'Liste des biens', 'chance-varin' ),
		'items_list_navigation' => __( 'Navigation de la liste des biens', 'chance-varin' ),
		'filter_items_list'     => __( 'Filtrer la liste des biens', 'chance-varin' ),
	);
	$args = array(
		'label'                 => __( 'Bien', 'chance-varin' ),
		'description'           => __( 'Catalogue des biens immobiliers', 'chance-varin' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' ),
		'taxonomies'            => array(), // Ajouter des taxonomies si nécessaire (ex: type de bien, ville)
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-building',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true, // Pour l'éditeur Gutenberg
		'rewrite'               => array( 'slug' => 'biens' ),
	);
	register_post_type( 'bien', $args );

}
add_action( 'init', 'up_register_cpt_bien', 0 );
