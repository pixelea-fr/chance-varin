<?php
/**
 * Metabox: Données du bien
 * Author : GEHIN Nicolas
 */

// Empêcher l'accès direct
if (!defined('ABSPATH')) {
    exit;
}

class UGM_donnees_du_bien extends UGM_Metabox {

    private static $instance = null;
    private $metabox_id = 'donnesdubien_0';
    private $metabox_title = 'Données du bien';
    private $post_types = array('bien');

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('add_meta_boxes', array($this, 'add_metabox'));
        add_action('save_post', array($this, 'save_metabox'));
        add_action('init', array($this, 'register_meta_fields'));
    }

    public function add_metabox() {
        foreach ($this->post_types as $post_type) {
            add_meta_box(
                $this->metabox_id,
                $this->metabox_title,
                array($this, 'render_metabox'),
                $post_type,
                'normal',
                'default'
            );
        }
    }

    public function register_meta_fields() {
        foreach ($this->post_types as $post_type) {
            register_post_meta($post_type, 'reference', array(
                'single' => true,
                'type' => 'string',
                'show_in_rest' => true,
                'auth_callback' => function() { return current_user_can('edit_posts'); }
            ));
        }
        foreach ($this->post_types as $post_type) {
            register_post_meta($post_type, 'prix', array(
                'single' => true,
                'type' => 'number',
                'show_in_rest' => true,
                'auth_callback' => function() { return current_user_can('edit_posts'); }
            ));
            register_post_meta($post_type, 'prix_formatted', array(
                'single' => true,
                'type' => 'string',
                'show_in_rest' => true,
                'auth_callback' => function() { return current_user_can('edit_posts'); }
            ));
        }
        foreach ($this->post_types as $post_type) {
            register_post_meta($post_type, 'loyer', array(
                'single' => true,
                'type' => 'number',
                'show_in_rest' => true,
                'auth_callback' => function() { return current_user_can('edit_posts'); }
            ));
            register_post_meta($post_type, 'loyer_formatted', array(
                'single' => true,
                'type' => 'string',
                'show_in_rest' => true,
                'auth_callback' => function() { return current_user_can('edit_posts'); }
            ));
        }
        foreach ($this->post_types as $post_type) {
            register_post_meta($post_type, 'surface', array(
                'single' => true,
                'type' => 'number',
                'show_in_rest' => true,
                'auth_callback' => function() { return current_user_can('edit_posts'); }
            ));
            register_post_meta($post_type, 'surface_formatted', array(
                'single' => true,
                'type' => 'string',
                'show_in_rest' => true,
                'auth_callback' => function() { return current_user_can('edit_posts'); }
            ));
        }
        foreach ($this->post_types as $post_type) {
            register_post_meta($post_type, 'surface_terrain', array(
                'single' => true,
                'type' => 'number',
                'show_in_rest' => true,
                'auth_callback' => function() { return current_user_can('edit_posts'); }
            ));
            register_post_meta($post_type, 'surface_terrain_formatted', array(
                'single' => true,
                'type' => 'string',
                'show_in_rest' => true,
                'auth_callback' => function() { return current_user_can('edit_posts'); }
            ));
        }
        foreach ($this->post_types as $post_type) {
            register_post_meta($post_type, 'frais_negociation', array(
                'single' => true,
                'type' => 'number',
                'show_in_rest' => true,
                'auth_callback' => function() { return current_user_can('edit_posts'); }
            ));
            register_post_meta($post_type, 'frais_negociation_formatted', array(
                'single' => true,
                'type' => 'string',
                'show_in_rest' => true,
                'auth_callback' => function() { return current_user_can('edit_posts'); }
            ));
        }
        foreach ($this->post_types as $post_type) {
            register_post_meta($post_type, 'frais_acte', array(
                'single' => true,
                'type' => 'number',
                'show_in_rest' => true,
                'auth_callback' => function() { return current_user_can('edit_posts'); }
            ));
            register_post_meta($post_type, 'frais_acte_formatted', array(
                'single' => true,
                'type' => 'string',
                'show_in_rest' => true,
                'auth_callback' => function() { return current_user_can('edit_posts'); }
            ));
        }
        foreach ($this->post_types as $post_type) {
            register_post_meta($post_type, 'images', array(
                'single' => true,
                'type' => 'string',
                'show_in_rest' => true,
                'auth_callback' => function() { return current_user_can('edit_posts'); }
            ));
        }
    }

    public function render_metabox($post) {
        wp_nonce_field('save_metabox_' . $this->metabox_id, 'metabox_nonce_' . $this->metabox_id);
        echo '<table class="form-table">';
        // Champ: Référence
        $value_reference = get_post_meta($post->ID, 'reference', true);
        echo '<tr>';
        echo '<th scope="row"><label for="reference">Référence</label></th>';
        echo '<td>';
        echo '<input type="text" id="reference" name="reference" value="' . esc_attr($value_reference) . '" class="regular-text" />';
        echo '</td>';
        echo '</tr>';

        // Champ: prix
        $value_prix = get_post_meta($post->ID, 'prix', true);
        echo '<tr>';
        echo '<th scope="row"><label for="prix">prix</label></th>';
        echo '<td>';
        echo '<input type="number" id="prix" name="prix" value="' . esc_attr($value_prix) . '" class="small-text" />';
        echo '</td>';
        echo '</tr>';

        // Champ: Loyer
        $value_loyer = get_post_meta($post->ID, 'loyer', true);
        echo '<tr>';
        echo '<th scope="row"><label for="loyer">Loyer</label></th>';
        echo '<td>';
        echo '<input type="number" id="loyer" name="loyer" value="' . esc_attr($value_loyer) . '" class="small-text" />';
        echo '</td>';
        echo '</tr>';

        // Champ: Surface
        $value_surface = get_post_meta($post->ID, 'surface', true);
        echo '<tr>';
        echo '<th scope="row"><label for="surface">Surface</label></th>';
        echo '<td>';
        echo '<input type="number" id="surface" name="surface" value="' . esc_attr($value_surface) . '" class="small-text" />';
        echo '</td>';
        echo '</tr>';

        // Champ: Surface Terrain
        $value_surface_terrain = get_post_meta($post->ID, 'surface_terrain', true);
        echo '<tr>';
        echo '<th scope="row"><label for="surface_terrain">Surface Terrain</label></th>';
        echo '<td>';
        echo '<input type="number" id="surface_terrain" name="surface_terrain" value="' . esc_attr($value_surface_terrain) . '" class="small-text" />';
        echo '</td>';
        echo '</tr>';

        // Champ: Frais de Négociation
        $value_frais_negociation = get_post_meta($post->ID, 'frais_negociation', true);
        echo '<tr>';
        echo '<th scope="row"><label for="frais_negociation">Frais de Négociation</label></th>';
        echo '<td>';
        echo '<input type="number" id="frais_negociation" name="frais_negociation" value="' . esc_attr($value_frais_negociation) . '" class="small-text" />';
        echo '</td>';
        echo '</tr>';

        // Champ: Frais Acte
        $value_frais_acte = get_post_meta($post->ID, 'frais_acte', true);
        echo '<tr>';
        echo '<th scope="row"><label for="frais_acte">Frais Acte</label></th>';
        echo '<td>';
        echo '<input type="number" id="frais_acte" name="frais_acte" value="' . esc_attr($value_frais_acte) . '" class="small-text" />';
        echo '</td>';
        echo '</tr>';

        // Champ: image
        $value_images = get_post_meta($post->ID, 'images', true);
        echo '<tr>';
        echo '<th scope="row"><label for="images">image</label></th>';
        echo '<td>';
        $ids_images = array_filter(array_map('absint', array_filter(array_map('trim', explode(',', (string)$value_images)))));
        echo '<div class="ugm-gallery-field" data-input="#images">';
        echo '<button type="button" class="button ugm-gallery-select">' . esc_html__('Choisir des images', 'textdomain') . '</button>';
        echo '<ul class="ugm-gallery-list" data-name="images">';
        if (!empty($ids_images)) {
            foreach ($ids_images as $att_id) {
                $thumb = wp_get_attachment_image($att_id, array(80,80), true);
                if ($thumb) {
                    echo '<li class="ugm-gallery-item" data-id="' . esc_attr($att_id) . '">';
                    echo '<span class="ugm-thumb">' . $thumb . '</span>';
                    echo '<button type="button" class="button-link ugm-remove" aria-label="' . esc_attr__('Retirer', 'textdomain') . '">&times;</button>';
                    echo '</li>';
                }
            }
        }
        echo '</ul>';
        echo '<input type="hidden" id="images" name="images" value="' . esc_attr(implode(',', $ids_images)) . '" />';
        echo '</div>';
        echo '</td>';
        echo '</tr>';

        echo '</table>';
    }

    public function save_metabox($post_id) {
        // Vérifications de sécurité
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!isset($_POST['metabox_nonce_' . $this->metabox_id])) return;
        if (!wp_verify_nonce($_POST['metabox_nonce_' . $this->metabox_id], 'save_metabox_' . $this->metabox_id)) return;
        if (!current_user_can('edit_post', $post_id)) return;

        // Sauvegarder: reference
        if (isset($_POST['reference'])) {
            $value_reference = sanitize_text_field(wp_unslash($_POST['reference']));
        } else {
            $value_reference = '';
        }
        update_post_meta($post_id, 'reference', $value_reference);

        // Sauvegarder: prix
        if (isset($_POST['prix'])) {
            $value_prix = sanitize_text_field(wp_unslash($_POST['prix']));
        } else {
            $value_prix = '';
        }
        update_post_meta($post_id, 'prix', $value_prix);
        // Donnée dérivée
        $formatted_value = $this->apply_filter_currency_eur($value_prix);
        update_post_meta($post_id, 'prix_formatted', $formatted_value);

        // Sauvegarder: loyer
        if (isset($_POST['loyer'])) {
            $value_loyer = sanitize_text_field(wp_unslash($_POST['loyer']));
        } else {
            $value_loyer = '';
        }
        update_post_meta($post_id, 'loyer', $value_loyer);
        // Donnée dérivée
        $formatted_value = $this->apply_filter_currency_eur($value_loyer);
        update_post_meta($post_id, 'loyer_formatted', $formatted_value);

        // Sauvegarder: surface
        if (isset($_POST['surface'])) {
            $value_surface = sanitize_text_field(wp_unslash($_POST['surface']));
        } else {
            $value_surface = '';
        }
        update_post_meta($post_id, 'surface', $value_surface);
        // Donnée dérivée
        $formatted_value = $this->apply_filter_surface_m2($value_surface);
        update_post_meta($post_id, 'surface_formatted', $formatted_value);

        // Sauvegarder: surface_terrain
        if (isset($_POST['surface_terrain'])) {
            $value_surface_terrain = sanitize_text_field(wp_unslash($_POST['surface_terrain']));
        } else {
            $value_surface_terrain = '';
        }
        update_post_meta($post_id, 'surface_terrain', $value_surface_terrain);
        // Donnée dérivée
        $formatted_value = $this->apply_filter_surface_m2($value_surface_terrain);
        update_post_meta($post_id, 'surface_terrain_formatted', $formatted_value);

        // Sauvegarder: frais_negociation
        if (isset($_POST['frais_negociation'])) {
            $value_frais_negociation = sanitize_text_field(wp_unslash($_POST['frais_negociation']));
        } else {
            $value_frais_negociation = '';
        }
        update_post_meta($post_id, 'frais_negociation', $value_frais_negociation);
        // Donnée dérivée
        $formatted_value = $this->apply_filter_currency_eur($value_frais_negociation);
        update_post_meta($post_id, 'frais_negociation_formatted', $formatted_value);

        // Sauvegarder: frais_acte
        if (isset($_POST['frais_acte'])) {
            $value_frais_acte = sanitize_text_field(wp_unslash($_POST['frais_acte']));
        } else {
            $value_frais_acte = '';
        }
        update_post_meta($post_id, 'frais_acte', $value_frais_acte);
        // Donnée dérivée
        $formatted_value = $this->apply_filter_currency_eur($value_frais_acte);
        update_post_meta($post_id, 'frais_acte_formatted', $formatted_value);

        // Sauvegarder: images
        if (isset($_POST['images'])) {
            $ids = array_filter(array_map('absint', array_filter(array_map('trim', explode(',', (string)wp_unslash($_POST['images']))))));
            $value_images = implode(',', $ids);
        } else {
            $value_images = '';
        }
        update_post_meta($post_id, 'images', $value_images);

    }
}

// Initialiser
$ugm_should_load = true;
if (class_exists('UpGutenbergMetabox')) {
    $ugm_sources = get_option('ugm_metabox_sources', array());
    $ugm_source = isset($ugm_sources['donnesdubien_0']) ? $ugm_sources['donnesdubien_0'] : 'plugin';
    $ugm_should_load = ($ugm_source === 'theme');
}
if ($ugm_should_load) {
    UGM_donnees_du_bien::get_instance();
}
