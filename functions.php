<?php

include_once 'functions/enqueue-theme-scripts.php';
include_once 'functions/enqueue-gsap-scripts.php';
include_once 'functions/enqueue-parse-block-v5.php';
include_once 'functions/enqueue-selected-style-js-admin.php';

include_once 'functions/load-patterns-json.php';
include_once 'functions/no-cache.php';
include_once 'functions/enqueue-variations.php';


add_action( 'after_setup_theme', function() {
    remove_theme_support( 'core-block-patterns' );

} );
add_filter( 'should_load_remote_block_patterns', '__return_false' );

