<?php
/**
 * Title: Query loop bien
 * Slug: ng1-base/query-loop-bien
 * Categories: layout
 * Keywords: query, bien
 * Block Types: core/query
 */
?>
<!-- wp:up/mobile-toggle {"targetId":"filtres","displayMode":"sticky","position":"bottom-center","variant":"pill","label":"Filtres","icon":"plus","useOverlay":true} /-->

<!-- wp:query {"queryId":0,"query":{"perPage":9,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"taxQuery":null,"parents":[],"format":[]}} -->
<div class="wp-block-query"><!-- wp:group {"className":"is-style-style3","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"},"anchor":"filtres"} -->
<div id="filtres" class="wp-block-group is-style-style3"><!-- wp:query-filter/taxonomy {"taxonomy":"noty_nature","emptyLabel":"Tout type de bien","label":"Nature du bien","filterType":"checkbox","options":[{"value":"terrain","label":"Label"}]} /-->

<!-- wp:query-filter/taxonomy {"taxonomy":"noty_transaction","emptyLabel":"Tous les types","label":"Type de transaction"} /-->

<!-- wp:query-filter/taxonomy {"taxonomy":"noty_ville","emptyLabel":"Toutes les villes","label":"Ville"} /-->

<!-- wp:query-filter/meta {"metaKey":"up_prix_hni","label":"Prix","filterType":"range","comparison":"range","isNumeric":true,"minBound":"50000","maxBound":"300000"} /--></div>
<!-- /wp:group -->

<!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|5"}},"layout":{"type":"grid","columnCount":3}} -->
<!-- wp:noty-broadcast-immo/card /-->
<!-- /wp:post-template -->

<!-- wp:query-no-results {"align":"wide"} -->
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|7","bottom":"var:preset|spacing|7","left":"var:preset|spacing|2","right":"var:preset|spacing|2"}}},"layout":{"type":"constrained","contentSize":"700px","wideSize":"890px"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--7);padding-right:var(--wp--preset--spacing--2);padding-bottom:var(--wp--preset--spacing--7);padding-left:var(--wp--preset--spacing--2)"><!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"typography":{"textAlign":"center"}},"fontSize":"xl"} -->
<h3 class="wp-block-heading has-text-align-center has-xl-font-size"><strong>Aucun Bien </strong></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"textAlign":"center"}}} -->
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