<?php
/**
 * Title: Media Texte Décalé
 * Slug: ng1-base/media-text-decale
 * Categories: media-text, up
 * Keywords: pixelea, up ,ng1, media, texte ,image
 * Block Types: core/group
 */
?>
<?php $is_editor = is_admin() || wp_is_json_request() || (function_exists('get_current_screen') && get_current_screen() && get_current_screen()->is_block_editor()); ?>
<!-- wp:group {"metadata":{"name":"Media Texte Décalé"},"align":"full","className":"media-text-decale","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center","verticalAlignment":"top"}} -->
<div class="wp-block-group alignfull media-text-decale"><!-- wp:group {"metadata":{"name":"Media Texte Décalé | Textes"},"className":"is-style-style4 media-text-decale__txt","style":{"spacing":{"padding":{"top":"var:preset|spacing|8","bottom":"var:preset|spacing|8","left":"var:preset|spacing|8","right":"var:preset|spacing|8"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-style4 media-text-decale__txt" style="padding-top:var(--wp--preset--spacing--8);padding-right:var(--wp--preset--spacing--8);padding-bottom:var(--wp--preset--spacing--8);padding-left:var(--wp--preset--spacing--8)"><!-- wp:heading -->
<h2 class="wp-block-heading">Chancé-Varin &amp; associés</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Lorem ipsum dolor sit amet consectetur. Et eu metus tellus eget diam adipiscing feugiat natoque. Posuere mattis libero vulputate commodo purus. Adipiscing eu faucibus nec massa. Cursus sit dis magna a tellus duis. Tincidunt cursus mi interdum ultrices ultrices malesuada risus dolor non. Pellentesque est sit eget amet pretium. Nam at leo tortor volutpat enim egestas a. Amet mi at vulputate nisi sapien.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Lorem ipsum dolor sit amet consectetur. Et eu metus tellus eget diam adipiscing feugiat natoque. Posuere mattis libero vulputate commodo purus. Adipiscing eu faucibus nec massa. Cursus sit dis magna a tellus duis. Tincidunt cursus mi interdum ultrices ultrices malesuada risus dolor non. Pellentesque est sit eget amet pretium. Nam at leo tortor volutpat enim egestas a. Amet mi at vulputate nisi sapien.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Découvrez nos associés</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Media Texte Décalé | part 2"},"className":"media-text-decale__part2","layout":{"type":"flex","orientation":"vertical","verticalAlignment":"bottom"}} -->
<div class="wp-block-group media-text-decale__part2"><!-- wp:group {"metadata":{"name":"before-media"},"className":"media-text-decale__before-media","layout":{"type":"constrained","justifyContent":"center"}} -->
<div class="wp-block-group media-text-decale__before-media"><!-- wp:shortcode -->
<?php 
if (!$is_editor) {
    echo do_shortcode('[lottie_hover src="logo-chance-varin.json" speed="3" 
full_width="true"
persist_end="true" trigger="scroll"]');
} else {
    echo '[lottie_hover src="logo-chance-varin.json" speed="3" 
full_width="true"
persist_end="true" trigger="scroll"]';
}
?>
<!-- /wp:shortcode --></div>
<!-- /wp:group -->

<!-- wp:image {"id":154,"aspectRatio":"16/9","scale":"cover","sizeSlug":"large","linkDestination":"none","className":"media-text-decale__media"} -->
<figure class="wp-block-image size-large media-text-decale__media"><img src="<?php echo home_url(); ?>/wp-content/uploads/2025/12/chance-varin-equipe-1024x683.jpg" alt="Equipe Chance et Varin" class="wp-image-154" style="aspect-ratio:16/9;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->