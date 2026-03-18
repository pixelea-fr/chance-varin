<?php
/**
 * Title: cover-type-single
 * Slug: ng1-base/cover-type-single
 * Categories: media
 * Keywords: pixelea, ng1, up, banner, cover, bannière
 * Block Types: core/cover
 */
?>
<?php $is_editor = is_admin() || wp_is_json_request() || (function_exists('get_current_screen') && get_current_screen() && get_current_screen()->is_block_editor()); ?>
<!-- wp:cover {"url":"<?php echo home_url(); ?>/wp-content/uploads/2026/01/Photo-interieur-1024x683.jpeg","id":1014,"dimRatio":50,"overlayColor":"base-4","isUserOverlayColor":true,"minHeight":600,"sizeSlug":"full","align":"full","className":"is-style-style5 cover-type-1","style":{"color":{"duotone":"var:preset|duotone|blanc-noir"},"spacing":{"blockGap":"var:preset|spacing|2","padding":{"right":"var:preset|spacing|2","left":"var:preset|spacing|2","top":"var:preset|spacing|8","bottom":"var:preset|spacing|8"}}},"layout":{"type":"constrained","contentSize":"760px"}} -->
<div class="wp-block-cover alignfull is-style-style5 cover-type-1" style="padding-top:var(--wp--preset--spacing--8);padding-right:var(--wp--preset--spacing--2);padding-bottom:var(--wp--preset--spacing--8);padding-left:var(--wp--preset--spacing--2);min-height:600px"><img class="wp-block-cover__image-background wp-image-1014 size-full" alt="" src="<?php echo home_url(); ?>/wp-content/uploads/2026/01/Photo-interieur-1024x683.jpeg" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-base-4-background-color has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:html -->
<?php 
if (!$is_editor) {
    echo do_shortcode('[noty-banner-content]');
} else {
    echo '[noty-banner-content]';
}
?>
<!-- /wp:html --></div></div>
<!-- /wp:cover -->