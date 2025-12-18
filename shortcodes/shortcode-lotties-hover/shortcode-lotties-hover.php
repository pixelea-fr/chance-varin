<?php
/**
 * Shortcode Lottie : play on hover / reverse on leave
 * Usage : [lottie_hover src="/animations/logo8.json" width="185" height="199"]
 */

function up_lottie_hover_shortcode($atts) {
  static $instance = 0;
  $instance++;

  $atts = shortcode_atts([
    'src'      => '',
    'width'    => '200',
    'height'   => '200',
    'speed'    => '1',
    'reverse'  => 'true',
    'loop'     => 'false',
    'autoplay' => 'false',
    'class'    => '',
    'id'       => '',
    'link'          => '',
    'hover_trigger' => '',
    'persist_end'   => 'true',
    'trigger'       => 'hover', // hover, scroll
    'full_width'    => 'false',
  ], $atts);

  if (empty($atts['src'])) {
    return '';
  }

  $src = trim($atts['src']);
  if (preg_match('#^https?://#i', $src) || str_starts_with($src, '//')) {
    $src_url = $src;
  } else {
    $src_url = trailingslashit(get_stylesheet_directory_uri()) . 'assets/lotties/' . ltrim($src, '/');
  }

  // Charger lottie-web (CDN)
  wp_enqueue_script(
    'lottie-web',
    'https://unpkg.com/lottie-web/build/player/lottie.min.js',
    [],
    null,
    true
  );

  // Charger ScrollTrigger (GSAP) si trigger=scroll
  if ($atts['trigger'] === 'scroll') {
      wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', array(), '3.12.5', true);
      wp_enqueue_script('gsap-scroll-trigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js', array('gsap'), '3.12.5', true);
  }

  // Charger notre script JS dédié
  wp_enqueue_script(
    'up-lottie-hover-script',
    get_stylesheet_directory_uri() . '/shortcodes/shortcode-lotties-hover/assets/js/shortcode-lotties-hover.js',
    ['lottie-web'], // Dépendance
    '1.1',
    true
  );

  // Gestion de l'ID et des classes
  $container_id = !empty($atts['id']) ? $atts['id'] : 'lottie-hover-' . $instance;
  $classes = 'lottie-hover-container';
  if (!empty($atts['class'])) {
    $classes .= ' ' . $atts['class'];
  }
  
  // Préparation des data attributes
  $speed    = esc_attr($atts['speed']);
  $reverse  = filter_var($atts['reverse'], FILTER_VALIDATE_BOOLEAN) ? 'true' : 'false';
  $loop     = filter_var($atts['loop'], FILTER_VALIDATE_BOOLEAN) ? 'true' : 'false';
  $autoplay = filter_var($atts['autoplay'], FILTER_VALIDATE_BOOLEAN) ? 'true' : 'false';
  $trigger_sel = !empty($atts['hover_trigger']) ? $atts['hover_trigger'] : '';
  
  $persist_end = filter_var($atts['persist_end'], FILTER_VALIDATE_BOOLEAN) ? 'true' : 'false';
  $trigger_type = in_array($atts['trigger'], ['hover', 'scroll']) ? $atts['trigger'] : 'hover';
  $full_width = filter_var($atts['full_width'], FILTER_VALIDATE_BOOLEAN);

  // Style calculations
  $style = '';
  if ($full_width) {
      $style = 'width: 100%; height: auto;';
  } else {
      $style = 'width:' . esc_attr($atts['width']) . 'px;height:' . esc_attr($atts['height']) . 'px;';
  }

  ob_start(); 
  
  // Wrapper lien (ouverture)
  if (!empty($atts['link'])) {
    echo '<a href="' . esc_url($atts['link']) . '" class="lottie-hover-link">';
  }
  ?>
    <div
      id="<?php echo esc_attr($container_id); ?>"
      class="<?php echo esc_attr($classes); ?>"
      style="<?php echo $style; ?>"
      data-src="<?php echo esc_url($src_url); ?>"
      data-speed="<?php echo $speed; ?>"
      data-reverse="<?php echo $reverse; ?>"
      data-loop="<?php echo $loop; ?>"
      data-autoplay="<?php echo $autoplay; ?>"
      data-hover-trigger="<?php echo $trigger_sel; ?>"
      data-persist-end="<?php echo $persist_end; ?>"
      data-trigger="<?php echo $trigger_type; ?>"
      data-full-width="<?php echo $full_width ? 'true' : 'false'; ?>">
    </div>
  <?php
  
  // Wrapper lien (fermeture)
  if (!empty($atts['link'])) {
    echo '</a>';
  }

  return ob_get_clean();
}

add_shortcode('lottie_hover', 'up_lottie_hover_shortcode');


