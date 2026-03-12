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
<!-- wp:pattern {"slug":"ng1-base/card-bien"} /-->
<!-- /wp:post-template -->
<!-- wp:query-pagination {"paginationArrow":"chevron","layout":{"type":"flex","justifyContent":"center"}} -->
<!-- wp:query-pagination-previous /-->
<!-- wp:query-pagination-numbers /-->
<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination --></div>
<!-- /wp:query -->