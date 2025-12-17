 <?php
 function wpdocs_block_pattern_category() {
	register_block_pattern_category( 'up', array(
		'label' => __( 'pixelea', 'text-domain' )
	) );
    	register_block_pattern_category( 'media-text', array(
		'label' => __( 'Media & Texte', 'text-domain' )
	) );
}

add_action( 'init', 'wpdocs_block_pattern_category' );