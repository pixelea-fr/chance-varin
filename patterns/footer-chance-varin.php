<?php
/**
 * Title: Footer Chance Varin
 * Slug: ng1-base/footer-chance-varin
 * Block Types: core/template-part/footer
 */

$offices = chance_varin_get_offices();
?>
<!-- wp:group {"metadata":{"name":"Footer | Chance Varin"},"align":"full","className":"footer-chance-varin","style":{"spacing":{"padding":{"right":"var:preset|spacing|4","left":"var:preset|spacing|4","top":"13.8rem"}}},"layout":{"type":"constrained","contentSize":"1420px","wideSize":"1856px"}} -->
<div class="wp-block-group alignfull footer-chance-varin" style="padding-top:13.8rem;padding-right:var(--wp--preset--spacing--4);padding-left:var(--wp--preset--spacing--4)"><!-- wp:columns {"align":"wide","className":"footer-chance-varin__wrapper"} -->
<div class="wp-block-columns alignwide footer-chance-varin__wrapper"><!-- wp:column {"verticalAlignment":"top","width":"40%","metadata":{"name":"Colonne 1"},"className":"footer-chance-varin__col1 has-align-vertical-tablet-center"} -->
<div class="wp-block-column is-vertically-aligned-top footer-chance-varin__col1 has-align-vertical-tablet-center" style="flex-basis:40%"><!-- wp:group {"className":"has-align-vertical-align-tablet-center","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-align-vertical-align-tablet-center"><!-- wp:site-logo {"width":250} /-->

<!-- wp:social-links {"iconColor":"base-2","iconColorValue":"#F1804C","size":"has-normal-icon-size","className":"is-style-logos-only","layout":{"type":"flex","justifyContent":"center"}} -->
<ul class="wp-block-social-links has-normal-icon-size has-icon-color is-style-logos-only"><!-- wp:social-link {"url":"https://fr.linkedin.com/company/chanc%C3%A9-varin-associ%C3%A9s-notaires","service":"linkedin"} /-->

<!-- wp:social-link {"url":"https://www.facebook.com/p/Chanc%C3%A9-Varin-61575509511147/","service":"facebook"} /-->

<!-- wp:social-link {"url":"https://www.instagram.com/chance_varin_notaires/","service":"instagram"} /-->

<!-- wp:social-link {"url":"mailto:<?php echo esc_attr( chance_varin_get_general_email() ); ?>","service":"mail"} /--></ul>
<!-- /wp:social-links --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"","metadata":{"name":"Colonne 2"},"className":"is-style-style1 footer-chance-varin__col2"} -->
<div class="wp-block-column is-style-style1 footer-chance-varin__col2"><!-- wp:group {"metadata":{"name":"footer-chance-varin__grid"},"className":"footer-chance-varin__grid","layout":{"type":"grid","columnCount":3,"minimumColumnWidth":null}} -->
<div class="wp-block-group footer-chance-varin__grid">
<?php foreach ( $offices as $office ) : ?>
	<!-- wp:group {"className":"footer-fiche chance-varin-office chance-varin-office--footer","style":{"spacing":{"blockGap":"0.63rem"}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group footer-fiche chance-varin-office chance-varin-office--footer">
		<!-- wp:heading {"level":3,"className":"fiche-footer","style":{"typography":{"fontSize":"21px","lineHeight":"1","fontStyle":"normal","fontWeight":"400"}}} -->
		<h3 class="wp-block-heading fiche-footer" style="font-size:21px;font-style:normal;font-weight:400;line-height:1"><?php echo esc_html( $office['name'] ); ?></h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"footer-fiche has-xs-font-size chance-varin-office__meta","style":{"typography":{"lineHeight":"1.87"}},"fontSize":"xs"} -->
		<p class="footer-fiche has-xs-font-size chance-varin-office__meta" style="line-height:1.87"><?php echo wp_kses_post( chance_varin_render_office_meta_lines( $office, 'footer' ) ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
<?php endforeach; ?>
</div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:spacer {"height":"var:preset|spacing|7"} -->
<div style="height:var(--wp--preset--spacing--7)" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:separator {"align":"wide","className":"is-style-default footer-chance-varin__separator","backgroundColor":"accent-4"} -->
<hr class="wp-block-separator alignwide has-text-color has-accent-4-color has-alpha-channel-opacity has-accent-4-background-color has-background is-style-default footer-chance-varin__separator"/>
<!-- /wp:separator -->

<!-- wp:group {"metadata":{"name":"Footer | Chance Varin | bas"},"align":"wide","className":"footer-chance-varin__bas","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|2","bottom":"var:preset|spacing|2"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
<div class="wp-block-group alignwide footer-chance-varin__bas" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--2);padding-bottom:var(--wp--preset--spacing--2)"><!-- wp:group {"metadata":{"name":"Bas de page - Custom Colors"},"className":"is-style-style1 has-width-100 has-align-space-around","style":{"elements":{"link":{"color":{"text":"var:preset|color|currentColor"}}},"border":{"top":{"width":"0px","style":"none"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group is-style-style1 has-width-100 has-align-space-around has-link-color" style="border-top-style:none;border-top-width:0px"><!-- wp:navigation {"ref":223,"overlayMenu":"never","className":"is-style-copyright","style":{"typography":{"lineHeight":"1.4"}},"fontSize":"s"} /-->

<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.4"}},"fontSize":"s"} -->
<p class="has-s-font-size" style="line-height:1.4">© <a href="https://www.pixelea.fr">Design &amp; Développement Pixelea</a> - 2025</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
