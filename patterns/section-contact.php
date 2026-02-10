<?php
/**
 * Title: Section contact
 * Slug: ng1-base/section-contact
 * Keywords: contact, ng1, pixelea, formulaire
 * Block Types: core/group
 */
?>
<?php $is_editor = is_admin() || wp_is_json_request() || (function_exists('get_current_screen') && get_current_screen() && get_current_screen()->is_block_editor()); ?>
<!-- wp:group {"align":"full","className":"section-contact has-padding-l-120 has-padding-r-120 is-style-style1","layout":{"type":"constrained","contentSize":"1680px"}} -->
<div class="wp-block-group alignfull section-contact has-padding-l-120 has-padding-r-120 is-style-style1"><!-- wp:media-text {"mediaPosition":"right","mediaId":549,"mediaLink":"<?php echo home_url(); ?>/?attachment_id=549","mediaType":"image","verticalAlignment":"top","className":"has-padding-content-0 has-image-halph-bg-color-base-4","style":{"border":{"width":"1px"}},"borderColor":"base-4"} -->
<div class="wp-block-media-text has-media-on-the-right is-stacked-on-mobile is-vertically-aligned-top has-padding-content-0 has-image-halph-bg-color-base-4 has-border-color has-base-4-border-color" style="border-width:1px"><div class="wp-block-media-text__content"><!-- wp:group {"className":"has-padding-l-40 has-padding-r-40","style":{"spacing":{"padding":{"top":"var:preset|spacing|8","bottom":"var:preset|spacing|8"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-padding-l-40 has-padding-r-40" style="padding-top:var(--wp--preset--spacing--8);padding-bottom:var(--wp--preset--spacing--8)"><!-- wp:heading -->
<h2 class="wp-block-heading">Contactez-nous</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Lorem ipsum dolor sit amet consectetur. Facilisis ut purus lacus tempus proin in viverra.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"is-style-style6","layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-style6"><!-- wp:html -->
<?php 
if (!$is_editor) {
    echo do_shortcode('[contact-form-7 id="a6968d6" title="Formulaire de contact 1"]');
} else {
    echo '[contact-form-7 id="a6968d6" title="Formulaire de contact 1"]';
}
?>
<!-- /wp:html --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div><figure class="wp-block-media-text__media"><img src="<?php echo home_url(); ?>/wp-content/uploads/2026/01/devanture-683x1024.jpg" alt="" class="wp-image-549 size-full"/></figure></div>
<!-- /wp:media-text --></div>
<!-- /wp:group -->