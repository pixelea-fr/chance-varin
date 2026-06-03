<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function chance_varin_shortcode_google_map( $atts ) {
	$atts = shortcode_atts(
		array(
			'office' => '',
			'query' => '',
			'height' => '420',
			'class' => '',
		),
		$atts
	);

	$office = $atts['office'] ? chance_varin_get_office( sanitize_title( $atts['office'] ) ) : null;
	$query  = trim( (string) $atts['query'] );

	if ( $office && ! empty( $office['map_embed_url'] ) ) {
		$query = '';
	}

	if ( '' === $query && $office && empty( $office['map_embed_url'] ) ) {
		$query = $office['address'];
	}

	if ( '' === $query && ( ! $office || empty( $office['map_embed_url'] ) ) ) {
		return '';
	}

	$height = absint( $atts['height'] );
	if ( $height <= 0 ) {
		$height = 420;
	}

	$classes = 'chance-varin-map';
	if ( '' !== $atts['class'] ) {
		$classes .= ' ' . sanitize_html_class( $atts['class'] );
	}

	ob_start();
	?>
	<div class="<?php echo esc_attr( $classes ); ?>">
		<iframe
			class="chance-varin-map__iframe"
			src="<?php echo esc_url( ! empty( $office['map_embed_url'] ) ? $office['map_embed_url'] : 'https://www.google.com/maps?q=' . rawurlencode( $query ) . '&output=embed' ); ?>"
			width="100%"
			height="<?php echo esc_attr( $height ); ?>"
			style="border:0;"
			loading="lazy"
			referrerpolicy="no-referrer-when-downgrade"
			allowfullscreen
		></iframe>
	</div>
	<?php

	return trim( preg_replace( '/\s+/', ' ', ob_get_clean() ) );
}
add_shortcode( 'chance_varin_google_map', 'chance_varin_shortcode_google_map' );

function chance_varin_shortcode_office_details( $atts ) {
	$atts = shortcode_atts(
		array(
			'office' => '',
			'context' => 'detail',
			'class' => '',
		),
		$atts
	);

	$office = chance_varin_get_office( sanitize_title( $atts['office'] ) );
	if ( ! $office ) {
		return '';
	}

	$classes = 'chance-varin-office chance-varin-office--' . sanitize_html_class( $atts['context'] );
	if ( '' !== $atts['class'] ) {
		$classes .= ' ' . sanitize_html_class( $atts['class'] );
	}

	$meta = chance_varin_render_office_meta_lines( $office, $atts['context'] );
	if ( '' === $meta ) {
		return '';
	}

	ob_start();
	?>
	<div class="<?php echo esc_attr( $classes ); ?>">
		<h3 class="chance-varin-office__title"><?php echo esc_html( $office['name'] ); ?></h3>
		<p class="chance-varin-office__meta"><?php echo wp_kses_post( $meta ); ?></p>
	</div>
	<?php

	return trim( preg_replace( '/\s+/', ' ', ob_get_clean() ) );
}
add_shortcode( 'chance_varin_office_details', 'chance_varin_shortcode_office_details' );

function chance_varin_shortcode_google_reviews( $atts ) {
	$atts = shortcode_atts(
		array(
			'office' => '',
			'class' => '',
		),
		$atts
	);

	$office_slug = sanitize_title( (string) $atts['office'] );
	if ( '' === $office_slug ) {
		return '';
	}

	$markup = chance_varin_render_google_reviews( $office_slug );
	if ( '' === $markup ) {
		return '';
	}

	$classes = 'chance-varin-office-map__reviews';
	if ( '' !== $atts['class'] ) {
		$classes .= ' ' . sanitize_html_class( $atts['class'] );
	}

	return '<div class="' . esc_attr( $classes ) . '">' . $markup . '</div>';
}
add_shortcode( 'chance_varin_google_reviews', 'chance_varin_shortcode_google_reviews' );

function chance_varin_shortcode_tools_pratiques( $atts ) {
	$atts = shortcode_atts(
		array(
			'title' => 'Tarifs et outils pratiques',
			'class' => '',
			'show_disclaimer' => 'true',
		),
		$atts
	);

	$tools = chance_varin_get_tools_links();
	$classes = 'chance-varin-tools';
	if ( '' !== $atts['class'] ) {
		$classes .= ' ' . sanitize_html_class( $atts['class'] );
	}

	ob_start();
	?>
	<section class="<?php echo esc_attr( $classes ); ?>">
		<div class="chance-varin-tools__header">
			<h2 class="chance-varin-tools__title"><?php echo esc_html( $atts['title'] ); ?></h2>
			<p class="chance-varin-tools__intro">Retrouvez ici une sélection d’outils utiles pour préparer un projet immobilier et estimer certains frais ou capacités de financement.</p>
			<p class="chance-varin-tools__legal">Le barème légal des honoraires de négociation immobilière doit être intégré ici dès validation du document transmis par l’étude.</p>
			<?php if ( filter_var( $atts['show_disclaimer'], FILTER_VALIDATE_BOOLEAN ) ) : ?>
				<p class="chance-varin-tools__disclaimer">Simulations à titre indicatif, sans valeur contractuelle.</p>
			<?php endif; ?>
		</div>
		<div class="chance-varin-tools__grid">
			<?php foreach ( $tools as $tool ) : ?>
				<article class="chance-varin-tools__item">
					<p class="chance-varin-tools__source"><?php echo esc_html( $tool['source'] ); ?></p>
					<h3 class="chance-varin-tools__item-title"><?php echo esc_html( $tool['label'] ); ?></h3>
					<p class="chance-varin-tools__item-text"><?php echo esc_html( $tool['description'] ); ?></p>
					<p class="chance-varin-tools__item-link">
						<a href="<?php echo esc_url( $tool['url'] ); ?>" target="_blank" rel="noopener noreferrer nofollow">Accéder à l’outil</a>
					</p>
				</article>
			<?php endforeach; ?>
		</div>
	</section>
	<?php

	return trim( preg_replace( '/\s+/', ' ', ob_get_clean() ) );
}
add_shortcode( 'chance_varin_tools_pratiques', 'chance_varin_shortcode_tools_pratiques' );

function chance_varin_shortcode_notaire_rss( $atts ) {
	$atts = shortcode_atts(
		array(
			'theme' => 'news',
			'limit' => 20,
			'title' => 'Actualités Notaires de France',
			'class' => '',
			'swiper' => 'false',
		),
		$atts
	);

	$theme = sanitize_key( $atts['theme'] );
	$limit = max( 1, min( 20, absint( $atts['limit'] ) ) );
	$use_swiper = filter_var( $atts['swiper'], FILTER_VALIDATE_BOOLEAN );

	$items = chance_varin_fetch_notaire_rss_items( $theme, $limit );
	if ( empty( $items ) ) {
		return '';
	}

	$classes = 'chance-varin-rss';
	if ( '' !== $atts['class'] ) {
		$classes .= ' ' . sanitize_html_class( $atts['class'] );
	}
	if ( $use_swiper ) {
		$classes .= ' chance-varin-rss--swiper';
		wp_enqueue_style( 'swiper-css', 'https://unpkg.com/swiper@11/swiper-bundle.min.css' );
		wp_enqueue_script( 'swiper-js', 'https://unpkg.com/swiper@11/swiper-bundle.min.js', array(), null, true );
	}

	ob_start();
	?>
	<section class="<?php echo esc_attr( $classes ); ?>">
		<div class="chance-varin-rss__header">
			<h2 class="wp-block-heading"><?php echo esc_html( $atts['title'] ); ?></h2>
		</div>
		<?php if ( $use_swiper ) : ?>
		<div class="swiper chance-varin-rss__swiper">
			<div class="swiper-wrapper chance-varin-rss__track" role="list">
		<?php else : ?>
		<div class="chance-varin-rss__track" role="list">
		<?php endif; ?>
			<?php foreach ( $items as $item ) : ?>
				<article class="<?php echo $use_swiper ? 'swiper-slide ' : ''; ?>chance-varin-rss__item" role="listitem">
					<?php if ( ! empty( $item['image_cached'] ) || ! empty( $item['image'] ) ) : ?>
						<figure class="chance-varin-rss__media">
							<img
								class="chance-varin-rss__image"
								src="<?php echo esc_url( $item['image_cached'] ?: $item['image'] ); ?>"
								alt="<?php echo esc_attr( $item['title'] ?? '' ); ?>"
								loading="lazy"
							/>
						</figure>
					<?php endif; ?>
					<?php if ( ! empty( $item['date'] ) ) : ?>
						<p class="chance-varin-rss__date"><?php echo esc_html( $item['date'] ); ?></p>
					<?php endif; ?>
					<h3 class="chance-varin-rss__item-title">
						<a href="<?php echo esc_url( $item['permalink'] ?? '' ); ?>" target="_blank" rel="noopener noreferrer nofollow"><?php echo esc_html( $item['title'] ?? '' ); ?></a>
					</h3>
					<?php if ( ! empty( $item['description'] ) ) : ?>
						<p class="chance-varin-rss__excerpt"><?php echo esc_html( $item['description'] ); ?></p>
					<?php endif; ?>
				</article>
			<?php endforeach; ?>
		<?php if ( $use_swiper ) : ?>
			</div>
			<div class="swiper-pagination"></div>
		</div>
		<?php else : ?>
		</div>
		<?php endif; ?>
	</section>
	<?php
	if ( $use_swiper ) :
		$swiper_id = uniqid( 'rss-swiper-' );
	?>
	<script>
	document.addEventListener('DOMContentLoaded', function() {
		new Swiper('.chance-varin-rss--swiper .chance-varin-rss__swiper', {
			slidesPerView: 'auto',
			spaceBetween: 24,
			freeMode: true,
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},
			breakpoints: {
				0: { slidesPerView: 1.2, spaceBetween: 16 },
				480: { slidesPerView: 1.8, spaceBetween: 20 },
				768: { slidesPerView: 2.5, spaceBetween: 24 },
				1024: { slidesPerView: 3.5, spaceBetween: 24 },
				1280: { slidesPerView: 4.5, spaceBetween: 24 },
			}
		});
	});
	</script>
	<?php
	endif;

	return trim( preg_replace( '/\s+/', ' ', ob_get_clean() ) );
}
add_shortcode( 'chance_varin_notaire_rss', 'chance_varin_shortcode_notaire_rss' );
