<?php
/**
 * Title: Données du bien
 * Slug: ng1-base/data-bien-noty
 * Categories: Media
 * Keywords: up, pixelea, bien ,immobilier
 * Block Types: core/group
 */
?>
<?php $is_editor = is_admin() || wp_is_json_request() || (function_exists('get_current_screen') && get_current_screen() && get_current_screen()->is_block_editor()); ?>
<!-- wp:group {"metadata":{"name":"Données du bien | container"},"align":"full","className":"data-bien__container","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull data-bien__container"><!-- wp:group {"metadata":{"name":"Données du bien | wrapper"},"className":"data-bien__wrapper","style":{"spacing":{"blockGap":"var:preset|spacing|1"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group data-bien__wrapper"><!-- wp:shortcode -->
<?php 
if (!$is_editor) {
    echo do_shortcode('[noty_annonce]');
} else {
    echo '[noty_annonce]';
}
?>
<!-- /wp:shortcode --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->