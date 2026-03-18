<?php
if ( ! isset( $data ) || ! isset( $data['term'] ) ) {
    return;
}

$term = $data['term'];
$show_link = $data['show_link'];
$hide_name = $data['hide_name'];
$hide_description = $data['hide_description'];
$wrapper_class = $data['wrapper_class'];
?>
<div class="<?php echo esc_attr( $wrapper_class ); ?>">
    <?php if ( ! $hide_name ) : ?>
        <?php if ( $show_link ) : ?>
            <p class="noty-banner-content__name">
                <a href="<?php echo esc_url( get_term_link( $term ) ); ?>">
                    <?php echo esc_html( $term->name ); ?>
                </a>
            </p>
        <?php else : ?>
            <p class="noty-banner-content__name">
                <?php echo esc_html( $term->name ); ?>
            </p>
        <?php endif; ?>
    <?php endif; ?>
    <?php if ( ! $hide_description && ! empty( $term->description ) ) : ?>
        <div class="noty-banner-content__description">
            <?php echo wp_kses_post( $term->description ); ?>
        </div>
    <?php endif; ?>
</div>
