<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function chance_varin_get_general_email() {
	return 'chance-varin@notaires.fr';
}

function chance_varin_get_offices() {
	static $offices = null;

	if ( null !== $offices ) {
		return $offices;
	}

	$general_email = chance_varin_get_general_email();

	$offices = array(
		'lisieux' => array(
			'slug' => 'lisieux',
			'name' => 'Étude de Lisieux',
			'address_lines' => array(
				'Siège social',
				'18 Place François Mitterrand',
				'14100 LISIEUX',
			),
			'phone' => '0231622022',
			'phone_label' => '02 31 62 20 22',
			'email' => $general_email,
			'hours' => 'Lundi : 14:00–18:00. Mardi : 09:00–12:30, 13:45–18:00. Mercredi au vendredi : 08:45–12:30, 13:45–18:00.',
			'parking_note' => "Parking réservé à la clientèle en arrière de l'étude avec accès par le 1 rue Condorcet.",
			'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2609.8485017977714!2d0.222588476904035!3d49.1465007803875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e1c45c8dd7eb4b%3A0x10fd38b13e6d6904!2sChanc%C3%A9%20%26%20Varin%20-%20Notaires%20-%20Lisieux!5e0!3m2!1sfr!2sfr!4v1778148020635!5m2!1sfr!2sfr',
		),
		'pont-leveque' => array(
			'slug' => 'pont-leveque',
			'name' => "Étude de Pont l'Évêque",
			'address_lines' => array(
				'2 Place Jean Bureau',
				'14130 PONT L’EVEQUE',
			),
			'phone' => '0231640008',
			'phone_label' => '02 31 64 00 08',
			'email' => 'office.pontleveque@chance-varin.notaires.fr',
			'hours' => "Du lundi au vendredi : 09:00–12:00, 14:00–18:00. Samedi : sur rendez-vous.",
			'parking_note' => '',
			'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2602.462539354267!2d0.18460817691006012!3d49.28658057047771!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e1cde2de6320c1%3A0x1e05a84a895645ac!2sChanc%C3%A9%20%26%20Varin%20-%20Notaires%20-%20Thomas%20HOULEY!5e0!3m2!1sfr!2sfr!4v1778147973581!5m2!1sfr!2sfr',
		),
		'cambremer' => array(
			'slug' => 'cambremer',
			'name' => 'Étude de Cambremer',
			'address_lines' => array(
				'18 Rue de Verdun',
				'14340 CAMBREMER',
			),
			'phone' => '0231630303',
			'phone_label' => '02 31 63 03 03',
			'email' => $general_email,
			'hours' => 'Du lundi au vendredi : 09:00–12:00, 14:00–18:00.',
			'parking_note' => '',
			'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2609.545782068874!2d0.04586347690426322!3d49.15224787998133!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e1d966aded8863%3A0xc8be756355e6ec1f!2sChanc%C3%A9%20%26%20Varin%20-%20Notaires%20Cambremer!5e0!3m2!1sfr!2sfr!4v1778148042788!5m2!1sfr!2sfr',
		),
		'deauville' => array(
			'slug' => 'deauville',
			'name' => 'Étude de Deauville',
			'address_lines' => array(
				'34 rue Olliffe',
				'14800 DEAUVILLE',
			),
			'phone' => '0261820102',
			'phone_label' => '02 61 82 01 02',
			'email' => 'office.deauville@chance-varin.notaires.fr',
			'hours' => 'Du lundi au vendredi : 09:00–12:30, 14:00–18:00.',
			'parking_note' => '',
			'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2598.5594817965944!2d0.07377717691322834!3d49.36048576524107!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e1d565aa92145b%3A0x86e0e857925dd7f!2sChanc%C3%A9%20%26%20Varin%20-%20Notaire%20-%20Deauville%20-%20Ma%C3%AEtre%20Rapha%C3%ABl%20FUNG!5e0!3m2!1sfr!2sfr!4v1778148073283!5m2!1sfr!2sfr',
		),
		'mezidon' => array(
			'slug' => 'mezidon',
			'name' => 'Étude de Mézidon',
			'address_lines' => array(
				'37 Avenue Jean Jaurès',
				'14270 MEZIDON CANON',
			),
			'phone' => '0231200411',
			'phone_label' => '02 31 20 04 11',
			'email' => 'office.mezidon@chance-varin.notaires.fr',
			'hours' => 'Lundi, mardi, jeudi et vendredi : 10:00–12:00, 14:00–17:00. Mercredi : 10:00–12:00.',
			'parking_note' => '',
			'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2613.578917042651!2d-0.06790442309902214!3d49.075638285392884!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x480a748cbb1da247%3A0x325143e4dd2eb43b!2sMe%20St%C3%A9phanie%20BESSIN%20de%20JOYBERT!5e0!3m2!1sfr!2sfr!4v1778148129386!5m2!1sfr!2sfr',
		),
		'bonnebosq' => array(
			'slug' => 'bonnebosq',
			'name' => 'Étude de Bonnebosq',
			'address_lines' => array(
				'32 Rue du Centre',
				'14340 BONNEBOSQ',
			),
			'phone' => '0231650954',
			'phone_label' => '02 31 65 09 54',
			'email' => $general_email,
			'hours' => 'Lundi : 14:00–18:00. Mardi au vendredi : 08:45–12:30, 13:45–18:00.',
			'parking_note' => '',
			'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2606.791450571313!2d0.07571727690652948!3d49.204515676285716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e1d757e016402d%3A0x40f4d475a315690!2sOFFICE%20NOTARIAL%20-%20Chanc%C3%A9-Varin%20%26%20Associ%C3%A9s%20-%20Bonnebosq!5e0!3m2!1sfr!2sfr!4v1778148171770!5m2!1sfr!2sfr',
		),
	);

	foreach ( $offices as $key => $office ) {
		$address_query = implode( ', ', $office['address_lines'] );
		$offices[ $key ]['address'] = $address_query;
		$offices[ $key ]['maps_url'] = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( $address_query );
	}

	return $offices;
}

function chance_varin_get_office( $slug ) {
	$offices = chance_varin_get_offices();
	return $offices[ $slug ] ?? null;
}

function chance_varin_get_office_for_current_page() {
	if ( ! is_page() ) {
		return null;
	}

	$post = get_queried_object();
	if ( ! $post || empty( $post->post_name ) ) {
		return null;
	}

	return chance_varin_get_office( $post->post_name );
}

function chance_varin_get_tools_links() {
	return array(
		array(
			'label' => "Barème des frais d'acquisition",
			'description' => 'Simulateur officiel ANIL pour estimer les frais liés à un achat immobilier.',
			'url' => 'https://www.anil.org/outils/outils-de-calcul/frais-dacquisition-dits-frais-de-notaire/',
			'source' => 'ANIL',
		),
		array(
			'label' => 'Mensualités de prêt',
			'description' => "Outil officiel ANIL pour visualiser l'échéancier d'un prêt immobilier.",
			'url' => 'https://www.anil.org/outils/outils-de-calcul/echeancier-dun-pret/',
			'source' => 'ANIL',
		),
		array(
			'label' => "Capacité d'emprunt",
			'description' => 'Diagnostic de financement immobilier officiel proposé par l’ANIL.',
			'url' => 'https://www.anil.org/outils/outils-de-calcul/diagnostic-de-financement/',
			'source' => 'ANIL',
		),
		array(
			'label' => 'Plus-value immobilière',
			'description' => "Calculateur officiel ANIL pour estimer l'impôt sur la plus-value.",
			'url' => 'https://www.anil.org/outils/outils-de-calcul/plus-value-immobiliere/',
			'source' => 'ANIL',
		),
		array(
			'label' => 'Comprendre les frais d’acquisition',
			'description' => 'Article explicatif officiel Notaires de France.',
			'url' => 'https://www.notaires.fr/fr/immobilier-fiscalite/financement/les-frais-dacquisition',
			'source' => 'Notaires de France',
		),
	);
}

function chance_varin_get_notaire_rss_feeds() {
	return array(
		'news' => 'https://www.notaires.fr/fr/rss/actualites',
		'immobilier' => 'https://www.notaires.fr/fr/rss/thematique?id_thematique=4101',
		'role-notaire' => 'https://www.notaires.fr/fr/rss/thematique?id_thematique=4107',
	);
}

function chance_varin_get_rss_cache_dir() {
	$uploads = wp_get_upload_dir();
	if ( empty( $uploads['basedir'] ) ) {
		return '';
	}

	$dir = trailingslashit( $uploads['basedir'] ) . 'chance-varin-cache';

	if ( ! is_dir( $dir ) ) {
		wp_mkdir_p( $dir );
	}

	return is_dir( $dir ) ? $dir : '';
}

function chance_varin_get_rss_cache_images_dir() {
	$dir = chance_varin_get_rss_cache_dir();
	if ( '' === $dir ) {
		return '';
	}

	$images_dir = trailingslashit( $dir ) . 'images';

	if ( ! is_dir( $images_dir ) ) {
		wp_mkdir_p( $images_dir );
	}

	return is_dir( $images_dir ) ? $images_dir : '';
}

function chance_varin_get_rss_cache_file( $theme ) {
	$dir = chance_varin_get_rss_cache_dir();
	if ( '' === $dir ) {
		return '';
	}

	return trailingslashit( $dir ) . 'rss-' . sanitize_key( $theme ) . '.json';
}

function chance_varin_get_rss_cache_ttl() {
	return 6 * HOUR_IN_SECONDS;
}

function chance_varin_get_rss_cache_retention() {
	return 14 * DAY_IN_SECONDS;
}

function chance_varin_extract_first_image_url( $html ) {
	$html = (string) $html;
	if ( '' === $html ) {
		return '';
	}

	if ( preg_match( '/<img[^>]+src=["\']([^"\']+)["\']/i', $html, $matches ) ) {
		return esc_url_raw( html_entity_decode( $matches[1], ENT_QUOTES, 'UTF-8' ) );
	}

	return '';
}

function chance_varin_extract_rss_enclosure_image_url( $item ) {
	if ( ! is_object( $item ) || ! method_exists( $item, 'get_enclosures' ) ) {
		return '';
	}

	$enclosures = $item->get_enclosures();
	if ( empty( $enclosures ) || ! is_array( $enclosures ) ) {
		return '';
	}

	foreach ( $enclosures as $enclosure ) {
		if ( ! is_object( $enclosure ) || ! method_exists( $enclosure, 'get_type' ) || ! method_exists( $enclosure, 'get_link' ) ) {
			continue;
		}

		$type = strtolower( (string) $enclosure->get_type() );
		$link = esc_url_raw( (string) $enclosure->get_link() );

		if ( '' !== $link && 0 === strpos( $type, 'image/' ) ) {
			return $link;
		}
	}

	return '';
}

function chance_varin_get_rss_cache_baseurl() {
	$uploads = wp_get_upload_dir();
	if ( empty( $uploads['baseurl'] ) ) {
		return '';
	}

	return trailingslashit( $uploads['baseurl'] ) . 'chance-varin-cache';
}

function chance_varin_get_extension_from_content_type( $content_type ) {
	$content_type = strtolower( trim( (string) $content_type ) );

	$map = array(
		'image/jpeg' => 'jpg',
		'image/jpg'  => 'jpg',
		'image/png'  => 'png',
		'image/webp' => 'webp',
		'image/gif'  => 'gif',
	);

	return $map[ $content_type ] ?? '';
}

function chance_varin_cache_rss_image( $image_url, $theme ) {
	$image_url = esc_url_raw( (string) $image_url );
	if ( '' === $image_url ) {
		return '';
	}

	$images_dir = chance_varin_get_rss_cache_images_dir();
	$baseurl    = chance_varin_get_rss_cache_baseurl();
	if ( '' === $images_dir || '' === $baseurl ) {
		return '';
	}

	$path      = wp_parse_url( $image_url, PHP_URL_PATH );
	$extension = strtolower( pathinfo( (string) $path, PATHINFO_EXTENSION ) );
	if ( '' === $extension ) {
		$extension = 'jpg';
	}

	$allowed_extensions = array( 'jpg', 'jpeg', 'png', 'gif', 'webp' );
	if ( ! in_array( $extension, $allowed_extensions, true ) ) {
		$extension = 'jpg';
	}

	$filename   = sanitize_file_name( sanitize_key( $theme ) . '-' . md5( $image_url ) . '.' . $extension );
	$file_path  = trailingslashit( $images_dir ) . $filename;
	$file_url   = trailingslashit( $baseurl ) . 'images/' . $filename;

	if ( file_exists( $file_path ) && filesize( $file_path ) > 0 ) {
		return esc_url_raw( $file_url );
	}

	$response = wp_remote_get(
		$image_url,
		array(
			'timeout' => 15,
			'redirection' => 5,
		)
	);

	if ( is_wp_error( $response ) ) {
		return '';
	}

	$code = (int) wp_remote_retrieve_response_code( $response );
	$body = wp_remote_retrieve_body( $response );
	if ( 200 !== $code || '' === $body ) {
		return '';
	}

	$content_type = (string) wp_remote_retrieve_header( $response, 'content-type' );
	$type_ext     = chance_varin_get_extension_from_content_type( $content_type );

	if ( '' !== $type_ext && $type_ext !== $extension ) {
		$filename  = sanitize_file_name( sanitize_key( $theme ) . '-' . md5( $image_url ) . '.' . $type_ext );
		$file_path = trailingslashit( $images_dir ) . $filename;
		$file_url  = trailingslashit( $baseurl ) . 'images/' . $filename;
	}

	if ( false === file_put_contents( $file_path, $body, LOCK_EX ) ) {
		return '';
	}

	return esc_url_raw( $file_url );
}

function chance_varin_read_rss_cache( $theme ) {
	$file = chance_varin_get_rss_cache_file( $theme );
	if ( '' === $file || ! file_exists( $file ) || ! is_readable( $file ) ) {
		return null;
	}

	$content = file_get_contents( $file );
	if ( false === $content || '' === $content ) {
		return null;
	}

	$data = json_decode( $content, true );
	if ( ! is_array( $data ) || empty( $data['items'] ) || ! is_array( $data['items'] ) ) {
		return null;
	}

	$data['generated_at'] = isset( $data['generated_at'] ) ? absint( $data['generated_at'] ) : 0;
	return $data;
}

function chance_varin_write_rss_cache( $theme, $feed_url, $items ) {
	$file = chance_varin_get_rss_cache_file( $theme );
	if ( '' === $file ) {
		return false;
	}

	$payload = wp_json_encode(
		array(
			'theme' => sanitize_key( $theme ),
			'feed_url' => esc_url_raw( $feed_url ),
			'generated_at' => time(),
			'items' => array_values( $items ),
		),
		JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
	);

	if ( ! is_string( $payload ) || '' === $payload ) {
		return false;
	}

	return false !== file_put_contents( $file, $payload, LOCK_EX );
}

function chance_varin_normalize_rss_item( $item ) {
	$description_html = (string) $item->get_description();
	$image_url        = chance_varin_extract_rss_enclosure_image_url( $item );

	if ( '' === $image_url ) {
		$image_url = chance_varin_extract_first_image_url( $description_html );
	}

	return array(
		'date' => $item->get_date( 'd/m/Y' ) ?: '',
		'title' => wp_strip_all_tags( (string) $item->get_title() ),
		'permalink' => esc_url_raw( (string) $item->get_permalink() ),
		'description' => wp_trim_words( wp_strip_all_tags( $description_html ), 26 ),
		'image' => $image_url,
		'image_cached' => '',
	);
}

function chance_varin_fetch_notaire_rss_items( $theme, $limit = 20 ) {
	$feeds = chance_varin_get_notaire_rss_feeds();
	$theme = sanitize_key( $theme );
	$feed  = $feeds[ $theme ] ?? $feeds['news'];
	$limit = max( 1, min( 20, absint( $limit ) ) );
	$ttl   = chance_varin_get_rss_cache_ttl();
	$cache = chance_varin_read_rss_cache( $theme );

	if ( $cache && ! empty( $cache['generated_at'] ) && ( time() - $cache['generated_at'] ) < $ttl ) {
		return array_slice( $cache['items'], 0, $limit );
	}

	if ( ! function_exists( 'fetch_feed' ) ) {
		require_once ABSPATH . WPINC . '/feed.php';
	}

	$rss = fetch_feed( $feed );
	if ( is_wp_error( $rss ) ) {
		return $cache ? array_slice( $cache['items'], 0, $limit ) : array();
	}

	$items = $rss->get_items( 0, 20 );
	if ( empty( $items ) ) {
		return $cache ? array_slice( $cache['items'], 0, $limit ) : array();
	}

	$normalized_items = array();
	foreach ( $items as $item ) {
		$normalized_item = chance_varin_normalize_rss_item( $item );
		if ( ! empty( $normalized_item['image'] ) ) {
			$normalized_item['image_cached'] = chance_varin_cache_rss_image( $normalized_item['image'], $theme );
		}

		$normalized_items[] = $normalized_item;
	}

	chance_varin_write_rss_cache( $theme, $feed, $normalized_items );

	return array_slice( $normalized_items, 0, $limit );
}

function chance_varin_schedule_rss_cache_cleanup() {
	if ( ! wp_next_scheduled( 'chance_varin_rss_cache_cleanup' ) ) {
		wp_schedule_event( time() + HOUR_IN_SECONDS, 'daily', 'chance_varin_rss_cache_cleanup' );
	}
}
add_action( 'init', 'chance_varin_schedule_rss_cache_cleanup' );

function chance_varin_cleanup_rss_cache() {
	$cache_dir  = chance_varin_get_rss_cache_dir();
	$images_dir = chance_varin_get_rss_cache_images_dir();

	if ( '' === $cache_dir || '' === $images_dir ) {
		return;
	}

	$retention       = chance_varin_get_rss_cache_retention();
	$ttl             = chance_varin_get_rss_cache_ttl();
	$image_grace_ttl = max( $retention, $ttl * 4 );
	$now             = time();
	$referenced      = array();

	foreach ( glob( trailingslashit( $cache_dir ) . 'rss-*.json' ) ?: array() as $json_file ) {
		$purge_file = false;
		$data       = json_decode( (string) file_get_contents( $json_file ), true );

		if ( ! is_array( $data ) || empty( $data['items'] ) || ! is_array( $data['items'] ) ) {
			$purge_file = true;
		} else {
			$generated_at = isset( $data['generated_at'] ) ? absint( $data['generated_at'] ) : 0;
			if ( $generated_at > 0 && ( $now - $generated_at ) > $retention ) {
				$purge_file = true;
			}

			foreach ( $data['items'] as $item ) {
				if ( ! empty( $item['image_cached'] ) ) {
					$path = wp_parse_url( $item['image_cached'], PHP_URL_PATH );
					if ( is_string( $path ) && '' !== $path ) {
						$referenced[ basename( $path ) ] = true;
					}
				}
			}
		}

		if ( $purge_file && file_exists( $json_file ) ) {
			unlink( $json_file );
		}
	}

	foreach ( glob( trailingslashit( $images_dir ) . '*' ) ?: array() as $image_file ) {
		$filename = basename( $image_file );
		$mtime    = filemtime( $image_file );

		if ( isset( $referenced[ $filename ] ) ) {
			continue;
		}

		if ( false !== $mtime && ( $now - $mtime ) > $image_grace_ttl && file_exists( $image_file ) ) {
			unlink( $image_file );
		}
	}
}
add_action( 'chance_varin_rss_cache_cleanup', 'chance_varin_cleanup_rss_cache' );

function chance_varin_get_google_reviews_data() {
	return array(
		'lisieux' => array(
			'type' => 'widget',
			'shortcode' => '[trustindex data-widget-id=9ee81ca71f12364719769ad33fa]',
		),
		'pont-leveque' => array(
			'type' => 'widget',
			'shortcode' => '[trustindex data-widget-id=237ee6a71911364fd426e45c345]',
		),
		'deauville' => array(
			'type' => 'widget',
			'shortcode' => '[trustindex data-widget-id=237ee6a71911364fd426e45c345]',
		),
		'cambremer' => array(
			'type' => 'cta',
			'title' => 'Aucun avis Google pour le moment',
			'text' => 'Soyez le premier à partager votre expérience avec l’étude de Cambremer.',
			'button_label' => 'Donner mon avis',
			'button_url' => '#',
		),
	);
}

function chance_varin_render_office_address_html( $office ) {
	if ( empty( $office['address_lines'] ) || empty( $office['maps_url'] ) ) {
		return '';
	}

	$lines = array_map( 'esc_html', $office['address_lines'] );
	return sprintf(
		'<a class="chance-varin-office__address-link" href="%1$s" target="_blank" rel="noopener noreferrer">%2$s</a>',
		esc_url( $office['maps_url'] ),
		implode( '<br>', $lines )
	);
}

function chance_varin_render_office_meta_lines( $office, $context = 'default' ) {
	$lines = array();

	$address_html = chance_varin_render_office_address_html( $office );
	if ( $address_html !== '' ) {
		$lines[] = $address_html;
	}

	if ( ! empty( $office['phone'] ) ) {
		$lines[] = sprintf(
			'<a href="tel:%1$s">%2$s</a>',
			esc_attr( $office['phone'] ),
			esc_html( $office['phone_label'] ?? $office['phone'] )
		);
	}

	if ( ! empty( $office['email'] ) ) {
		$lines[] = sprintf(
			'<a href="mailto:%1$s">%1$s</a>',
			esc_html( $office['email'] )
		);
	}

	if ( ! empty( $office['hours'] ) ) {
		$lines[] = '<span class="chance-varin-office__hours"><strong>Horaires :</strong> ' . esc_html( $office['hours'] ) . '</span>';
	} elseif ( 'footer' === $context ) {
		$lines[] = '<span class="chance-varin-office__hours chance-varin-office__hours--pending"><strong>Horaires :</strong> à confirmer</span>';
	}

	if ( ! empty( $office['parking_note'] ) && 'detail' === $context ) {
		$lines[] = '<span class="chance-varin-office__parking">' . esc_html( $office['parking_note'] ) . '</span>';
	}

	return implode( '<br>', $lines );
}

function chance_varin_render_google_reviews( $office_slug ) {
	$data = chance_varin_get_google_reviews_data();
	$slug = sanitize_title( (string) $office_slug );

	if ( empty( $data[ $slug ] ) ) {
		return '';
	}

	$review = $data[ $slug ];

	if ( 'widget' === ( $review['type'] ?? '' ) && ! empty( $review['shortcode'] ) && shortcode_exists( 'trustindex' ) ) {
		return '<div class="chance-varin-google-reviews chance-varin-google-reviews--widget">' . do_shortcode( $review['shortcode'] ) . '</div>';
	}

	if ( 'cta' === ( $review['type'] ?? '' ) ) {
		$title = $review['title'] ?? '';
		$text  = $review['text'] ?? '';
		$label = $review['button_label'] ?? 'Donner mon avis';
		$url   = $review['button_url'] ?? '#';

		$html  = '<div class="chance-varin-google-reviews chance-varin-google-reviews--cta">';
		if ( '' !== $title ) {
			$html .= '<h3 class="chance-varin-google-reviews__title">' . esc_html( $title ) . '</h3>';
		}
		if ( '' !== $text ) {
			$html .= '<p class="chance-varin-google-reviews__text">' . esc_html( $text ) . '</p>';
		}
		$html .= '<p class="chance-varin-google-reviews__action"><a class="btn-with-arrow" href="' . esc_url( $url ) . '" target="_blank" rel="noopener noreferrer nofollow">' . esc_html( $label ) . '</a></p>';
		$html .= '</div>';

		return $html;
	}

	return '';
}

function chance_varin_filter_contact_page_block( $block_content, $block ) {
	if ( ! is_page( 'contact' ) ) {
		return $block_content;
	}

	$attrs = $block['attrs'] ?? array();
	$class = $attrs['className'] ?? '';

	if ( is_string( $class ) && false !== strpos( $class, 'section-information-contact__container' ) ) {
		return '';
	}

	return $block_content;
}
add_filter( 'render_block', 'chance_varin_filter_contact_page_block', 20, 2 );

function chance_varin_replace_office_info_media_with_map( $block_content, $block ) {
	static $map_replaced = false;

	if ( ! is_page() ) {
		$map_replaced = false;
		return $block_content;
	}

	$office = chance_varin_get_office_for_current_page();
	if ( ! $office ) {
		$map_replaced = false;
		return $block_content;
	}

	$block_name = $block['blockName'] ?? '';
	$attrs      = $block['attrs'] ?? array();
	$class_name = $attrs['className'] ?? '';

	if ( $map_replaced || 'core/media-text' !== $block_name || ! is_string( $class_name ) || false === strpos( $class_name, 'section-information__media-txt' ) ) {
		return $block_content;
	}

	$map_replaced = true;

	$map = do_shortcode(
		sprintf(
			'[chance_varin_google_map office="%1$s" height="420" class="chance-varin-office-map__embed"]',
			esc_attr( $office['slug'] )
		)
	);

	if ( '' === $map ) {
		return $block_content;
	}

	$replacement = '<figure class="wp-block-media-text__media chance-varin-office-map__media">' . $map . '</figure>';
	$updated     = preg_replace( '/<figure class="wp-block-media-text__media">.*?<\/figure>/s', $replacement, $block_content, 1 );

	if ( ! is_string( $updated ) || $updated === '' ) {
		return $block_content;
	}

	return $updated;
}
add_filter( 'render_block', 'chance_varin_replace_office_info_media_with_map', 21, 2 );
