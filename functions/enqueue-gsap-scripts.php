<?php
function register_gsap_scripts(){

        wp_register_script(
            'gsap',
            'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js',
            array(),
            '3.12.2',
            true
        );
      
        wp_register_script(
            'gsap-scroll-trigger',
            'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js',
            array('gsap'),
            '3.12.2',
            true
        );
}

function enqueue_gsap_assets() {

  wp_enqueue_script(
      'gsap-sample',
      get_stylesheet_directory_uri() . '/assets/js/gsap/gsap-sample.js',
      array('gsap', 'gsap-scroll-trigger'),
     null,
      true
  );

}
add_action('wp_enqueue_scripts', 'enqueue_gsap_assets');