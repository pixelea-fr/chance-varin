<?php
function register_map_chance_varin_assets() {
    wp_register_script(
        'map-chance-varin-popin',
        get_stylesheet_directory_uri() . '/shortcodes/shortcode-map-chance-varin/assets/js/popin.js',
        array(),
        null,
        true
    );

    wp_register_style(
        'map-chance-varin-css',
        get_stylesheet_directory_uri() . '/shortcodes/shortcode-map-chance-varin/assets/css/map-chance-varin.css',
        array(),
        null
    );
}
add_action( 'wp_enqueue_scripts', 'register_map_chance_varin_assets' );

function map_chance_varin_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'class' => '',
        'link' => '',
    ), $atts );

    wp_enqueue_script( 'map-chance-varin-popin' );
    wp_enqueue_style( 'map-chance-varin-css' );

    $svg_path = get_stylesheet_directory() . '/shortcodes/shortcode-map-chance-varin/assets/img/map.svg';
    $svg      = '';
    if ( file_exists( $svg_path ) ) {
        $svg = file_get_contents( $svg_path );
        
        // Ajouter data-link sur les groupes SVG si l'attribut link est fourni
        if ( ! empty( $atts['link'] ) ) {
            $escaped_link = esc_url( $atts['link'] );
            $svg = preg_replace(
                '/(<g[^>]*class="svg-cv-group"[^>]*>)/',
                '$1 data-link="' . $escaped_link . '"',
                $svg
            );
        }
    }

    $wrapper_class = 'map-chance-varin';
    if ( ! empty( $atts['class'] ) ) {
        $wrapper_class .= ' ' . esc_attr( $atts['class'] );
    }

    ob_start();
    ?>
    <div class="<?php echo $wrapper_class; ?>">
        <div class="map-chance-varin__svg"><?php echo $svg; ?></div>
        <div class="map-chance-varin__tooltip" aria-hidden="true"></div>
    </div>
    <?php
    $html = ob_get_clean();

    $html = str_replace( array( "\r\n", "\r", "\n", "\t" ), '', $html );
    $html = preg_replace( '/>\s+</', '><', $html );

    return $html;
}
add_shortcode( 'map_chance_varin', 'map_chance_varin_shortcode' );
