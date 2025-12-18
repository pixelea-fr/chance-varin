<?php
/**
 * Title: Double marquee
 * Slug: ng1-base/double-marquee
 * Categories: texte
 * Keywords: up, ng1, pixelea , marquee
 * Block Types: core/group
 */
?>
<?php $is_editor = is_admin() || wp_is_json_request() || (function_exists('get_current_screen') && get_current_screen() && get_current_screen()->is_block_editor()); ?>
<!-- wp:group {"metadata":{"name":"Section | Double marquee"},"align":"full","className":"section-double-marquee","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull section-double-marquee"><!-- wp:shortcode -->
<?php 
if (!$is_editor) {
    echo do_shortcode('[double_marquee line1="LOCATION - ACHAT - VENTE - VIAGER - MAISON - DOMAINE - HARAS - APPARTEMENT" line2="MAISON - DOMAINE - HARAS - APPARTEMENT - LOCATION - ACHAT - VENTE - VIAGER"  speed="30" class="double-marquee" color="var(--wp--preset--color--base-2)" ]');
} else {
    echo '[double_marquee line1="LOCATION - ACHAT - VENTE - VIAGER - MAISON - DOMAINE - HARAS - APPARTEMENT" line2="MAISON - DOMAINE - HARAS - APPARTEMENT - LOCATION - ACHAT - VENTE - VIAGER"  speed="30" class="double-marquee" color="var(--wp--preset--color--base-2)" ]';
}
?>
<!-- /wp:shortcode --></div>
<!-- /wp:group -->