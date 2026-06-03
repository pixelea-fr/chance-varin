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
<!-- wp:query {"queryId":0,"query":{"inherit":true,"perPage":12,"pages":0,"offset":0,"postType":"noty_annonce","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","taxQuery":null},"className":"chance-varin-query"} -->
<div class="wp-block-query chance-varin-query">
	<!-- wp:group {"className":"chance-varin-query__intro","layout":{"type":"constrained"}} -->
	<div class="wp-block-group chance-varin-query__intro">
		<!-- wp:paragraph {"className":"chance-varin-query__cta"} -->
		<p class="chance-varin-query__cta">Besoin d’estimer vos frais ou votre financement ? <a href="/immobilier/tarifs-et-outils-pratiques/">Découvrir nos tarifs et outils pratiques</a></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"className":"chance-varin-query__filters","layout":{"type":"constrained"}} -->
	<div class="wp-block-group chance-varin-query__filters">
		<!-- wp:columns {"verticalAlignment":"top","className":"chance-varin-query__filters-grid"} -->
		<div class="wp-block-columns are-vertically-aligned-top chance-varin-query__filters-grid">
			<!-- wp:column {"verticalAlignment":"top"} -->
			<div class="wp-block-column is-vertically-aligned-top">
				<!-- wp:query-filter/meta {"metaKey":"up_transaction_type","label":"Vente / Location","filterType":"select","showLabel":true,"emptyLabel":"Toutes les annonces","options":[{"value":"vente_traditionnelle","label":"Vente"},{"value":"location","label":"Location"}]} /-->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"verticalAlignment":"top"} -->
			<div class="wp-block-column is-vertically-aligned-top">
				<!-- wp:query-filter/meta {"metaKey":"up_nature","label":"Types de biens","filterType":"checkbox","showLabel":true,"options":[{"value":"Appartement","label":"Appartement"},{"value":"Maison","label":"Maison"},{"value":"Locaux professionnels","label":"Locaux professionnels"},{"value":"Terrain à bâtir","label":"Terrain à bâtir"}]} /-->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"verticalAlignment":"top"} -->
			<div class="wp-block-column is-vertically-aligned-top">
				<!-- wp:query-filter/meta {"metaKey":"up_prix","label":"Budget","filterType":"range","comparison":"range","isNumeric":true,"showLabel":true,"placeholder":"Prix minimum","step":"1000"} /-->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"verticalAlignment":"top"} -->
			<div class="wp-block-column is-vertically-aligned-top">
				<!-- wp:query-filter/meta {"metaKey":"up_ville","label":"Communes","filterType":"checkbox","showLabel":true} /-->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->

		<!-- wp:query-filter/apply-button {"label":"Appliquer les filtres","resetLabel":"Réinitialiser","showReset":true} /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|5"}},"layout":{"type":"grid","columnCount":3}} -->
	<!-- wp:noty-broadcast-immo/card /-->
	<!-- /wp:post-template -->

	<!-- wp:query-no-results {"align":"wide"} -->
	<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|7","bottom":"var:preset|spacing|7","left":"var:preset|spacing|2","right":"var:preset|spacing|2"}}},"layout":{"type":"constrained","contentSize":"700px","wideSize":"890px"}} -->
	<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--7);padding-right:var(--wp--preset--spacing--2);padding-bottom:var(--wp--preset--spacing--7);padding-left:var(--wp--preset--spacing--2)">
		<!-- wp:group {"layout":{"type":"constrained"}} -->
		<div class="wp-block-group">
			<!-- wp:heading {"textAlign":"center","level":3,"fontSize":"xl"} -->
			<h3 class="wp-block-heading has-text-align-center has-xl-font-size"><strong>Aucune annonce</strong></h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center">Aucune annonce ne correspond aux critères sélectionnés.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
	<!-- /wp:query-no-results -->

	<!-- wp:query-pagination {"paginationArrow":"chevron","layout":{"type":"flex","justifyContent":"center"}} -->
	<!-- wp:query-pagination-previous /-->
	<!-- wp:query-pagination-numbers /-->
	<!-- wp:query-pagination-next /-->
	<!-- /wp:query-pagination -->
</div>
<!-- /wp:query -->
