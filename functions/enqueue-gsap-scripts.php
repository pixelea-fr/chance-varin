<?php

function enqueue_gsap_assets() {
  wp_enqueue_script(
      'gsap',
      'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js',
      array(),
      '3.12.2',
      true
  );

  wp_enqueue_script(
      'gsap-scroll-trigger',
      'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js',
      array('gsap'),
      '3.12.2',
      true
  );


  wp_enqueue_script(
      'gsap-animations-mark',
      get_stylesheet_directory_uri() . '/assets/js/gsap/is-style-mark-animate.js',
      array('gsap', 'gsap-scroll-trigger'),
     null,
      true
  );

  wp_enqueue_script(
    'gsap-timeline',
    get_stylesheet_directory_uri() . '/assets/js/gsap/timeline.js',
    array('gsap', 'gsap-scroll-trigger'),
       null,
      true
  );



}
add_action('wp_enqueue_scripts', 'enqueue_gsap_assets');