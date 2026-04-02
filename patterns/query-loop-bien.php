<?php
/**
 * Title: Query Loop Bien
 * Slug: ng1-base/query-loop-bien
 * Categories: query
 * Block Types: core/query
 * Description: Query loop pour les biens
 *
 * @package WordPress
 * @subpackage ng1-base
 * @since ng1-base 1.0
 */

?>
<!-- wp:query {"queryId":0,"query":"inherit"} -->


<div class="wp-block-query">
<!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|5"}},"layout":{"type":"grid","columnCount":3}} -->
<!-- wp:noty-broadcast-immo/card /-->
 <!-- /wp:post-template -->
<!-- wp:query-no-results {"align":"wide"} -->
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|7","bottom":"var:preset|spacing|7","left":"var:preset|spacing|2","right":"var:preset|spacing|2"}}},"layout":{"type":"constrained","contentSize":"700px","wideSize":"890px"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--7);padding-right:var(--wp--preset--spacing--2);padding-bottom:var(--wp--preset--spacing--7);padding-left:var(--wp--preset--spacing--2)"><!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":3,"fontSize":"xl"} -->
<h3 class="wp-block-heading has-text-align-center has-xl-font-size"><strong>Aucun Bien </strong></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Aucun bien n'est disponible pour le moment.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:query-no-results -->
<!-- wp:query-pagination {"paginationArrow":"chevron","layout":{"type":"flex","justifyContent":"center"}} -->
<!-- wp:query-pagination-previous /-->
<!-- wp:query-pagination-numbers /-->
<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination --></div>
<!-- /wp:query -->