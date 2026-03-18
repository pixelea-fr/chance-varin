<?php
function noty_banner_content_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'taxonomy' => 'noty_transaction',
        'hide_name' => false,
        'hide_description' => false,
        'show_link' => false,
        'class' => '',
    ), $atts );

    $post_id = get_the_ID();
    if ( ! $post_id ) {
        return '';
    }

    $taxonomy = sanitize_text_field( $atts['taxonomy'] );
    $hide_name = filter_var( $atts['hide_name'], FILTER_VALIDATE_BOOLEAN );
    $hide_description = filter_var( $atts['hide_description'], FILTER_VALIDATE_BOOLEAN );
    $show_link = filter_var( $atts['show_link'], FILTER_VALIDATE_BOOLEAN );

    $terms = get_the_terms( $post_id, $taxonomy );
    
    if ( ! $terms || is_wp_error( $terms ) ) {
        return '';
    }

    $term = $terms[0];
    
    $data = array(
        'term' => $term,
        'taxonomy' => $taxonomy,
        'hide_name' => $hide_name,
        'hide_description' => $hide_description,
        'show_link' => $show_link,
        'wrapper_class' => 'noty-banner-content',
    );

    if ( ! empty( $atts['class'] ) ) {
        $data['wrapper_class'] .= ' ' . esc_attr( $atts['class'] );
    }

    ob_start();
    include get_stylesheet_directory() . '/shortcodes/shortcode-noty-banner-content/templates/banner-content.php';
    $html = ob_get_clean();

    $html = str_replace( array( "\r\n", "\r", "\n", "\t" ), '', $html );
    $html = preg_replace( '/>\s+</', '><', $html );

    return $html;
}
add_shortcode( 'noty-banner-content', 'noty_banner_content_shortcode' );
