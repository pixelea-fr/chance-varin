<?php
/**
 * Title: Media texte localisation
 * Slug: ng1-base/media-text-localisation
 * Categories: media-text
 * Keywords: up, pixelea, ng1 , media , texte , localisation
 * Block Types: core/group
 */
?>
<?php $is_editor = is_admin() || wp_is_json_request() || (function_exists('get_current_screen') && get_current_screen() && get_current_screen()->is_block_editor()); ?>
<!-- wp:group {"metadata":{"name":"Media-text | Localisation"},"align":"full","className":"is-style-style2 media-text-localisation has-text-style-1 has-padding-l-120 has-padding-r-120","style":{"spacing":{"padding":{"top":"var:preset|spacing|8","bottom":"var:preset|spacing|8"},"blockGap":"0"}},"layout":{"type":"constrained","contentSize":"1682px"}} -->
<div class="wp-block-group alignfull is-style-style2 media-text-localisation has-text-style-1 has-padding-l-120 has-padding-r-120" style="padding-top:var(--wp--preset--spacing--8);padding-bottom:var(--wp--preset--spacing--8)"><!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"40%"} -->
<div class="wp-block-column" style="flex-basis:40%"><!-- wp:html -->
<?php 
if (!$is_editor) {
    echo do_shortcode('[map_chance_varin class="media-text-localisation__img"]');
} else {
    echo '[map_chance_varin class="media-text-localisation__img"]';
}
?>
<!-- /wp:html --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"","style":{"spacing":{"blockGap":"var:preset|spacing|5"}}} -->
<div class="wp-block-column"><!-- wp:heading {"textAlign":"right"} -->
<h2 class="wp-block-heading has-text-align-right">Texte où on est ?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"right"} -->
<p class="has-text-align-right">Lorem ipsum dolor sit amet consectetur. Ipsum eu sapien eu mattis fermentum ridiculus ut enim aliquet. Euismod libero vel aliquet volutpat ut nunc. Lacus eu urna commodo pellentesque elit magnis sapien turpis. Porttitor nisi tempor pharetra aenean sapien enim. Facilisis nisl gravida porta etiam dictumst egestas faucibus ullamcorper. Neque et curabitur ut cras non viverra viverra. Arcu sit elit massa vehicula vel faucibus egestas viverra facilisi. Tortor est suspendisse magnis eget adipiscing. Faucibus mattis cras amet sed nullam laoreet commodo. Pretium mi quam arcu odio leo faucibus sed sit. Vulputate lacus id id nec duis turpis pretium. Ac duis facilisis quisque euismod. Commodo congue mauris tortor commodo aliquet.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->