<?php
function register_double_marquee_assets() {
    // Register GSAP if not already registered
    if (!wp_script_is('gsap', 'registered')) {
        wp_register_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', array(), '3.12.5', true);
    }
    
    // Register assets
    wp_register_script(
        'double-marquee-js', 
        get_stylesheet_directory_uri() . '/shortcodes/shortcodes-double-marquee/assets/js/double-marquee.js', 
        array('gsap'), 
        null, 
        true
    );
    
    wp_register_style(
        'double-marquee-css', 
        get_stylesheet_directory_uri() . '/shortcodes/shortcodes-double-marquee/assets/css/double-marquee.css', 
        array(), 
        null
    );
}
add_action('wp_enqueue_scripts', 'register_double_marquee_assets');

function double_marquee_shortcode($atts) {
    // Paramètres par défaut
    $atts = shortcode_atts(array(
        'line1' => 'LOCATION - ACHAT - VENTE - VIAGER - MAISON - DOMAINE - HARAS - APPARTEMENT',
        'line2' => 'MAISON - DOMAINE - HARAS - APPARTEMENT - LOCATION - ACHAT - VENTE - VIAGER',
        'font_size' => '48px',
        'speed' => '30', // Durée en secondes pour un cycle complet
        'gap' => '2rem', // Espacement entre les éléments
        'color' => '#000000',
        'font_weight' => '700',
        'class' => '',
        'id' => '',
    ), $atts);

    // Enqueue assets
    wp_enqueue_script('double-marquee-js');
    wp_enqueue_style('double-marquee-css');

    // Build CSS variables
    $style = sprintf(
        '--marquee-font-size: %s; --marquee-gap: %s; --marquee-color: %s; --marquee-font-weight: %s;',
        esc_attr($atts['font_size']),
        esc_attr($atts['gap']),
        esc_attr($atts['color']),
        esc_attr($atts['font_weight'])
    );

    $wrapper_class = 'double-marquee-wrapper';
    if (!empty($atts['class'])) {
        $wrapper_class .= ' ' . esc_attr($atts['class']);
    }

    $wrapper_id = '';
    if (!empty($atts['id'])) {
        $wrapper_id = ' id="' . esc_attr($atts['id']) . '"';
    }

    ob_start();
    ?>
    <div class="<?php echo $wrapper_class; ?>"<?php echo $wrapper_id; ?> data-speed="<?php echo esc_attr($atts['speed']); ?>" style="<?php echo $style; ?>">
        <div class="marquee-line marquee-line-1">
            <div class="marquee-content">
                <span class="marquee-text"><?php echo esc_html($atts['line1']); ?></span>
                <span class="marquee-text" aria-hidden="true"><?php echo esc_html($atts['line1']); ?></span>
                <span class="marquee-text" aria-hidden="true"><?php echo esc_html($atts['line1']); ?></span>
            </div>
        </div>
        <div class="marquee-line marquee-line-2">
            <div class="marquee-content">
                <span class="marquee-text"><?php echo esc_html($atts['line2']); ?></span>
                <span class="marquee-text" aria-hidden="true"><?php echo esc_html($atts['line2']); ?></span>
                <span class="marquee-text" aria-hidden="true"><?php echo esc_html($atts['line2']); ?></span>
            </div>
        </div>
    </div>
    <?php
    $html = ob_get_clean();
    
    // Remove newlines and extra spaces to prevent wpautop issues
    $html = str_replace(array("\r\n", "\r", "\n", "\t"), '', $html);

    return apply_filters('up_double_marquee_html', $html, $atts);
}
add_shortcode('double_marquee', 'double_marquee_shortcode');