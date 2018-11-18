<?php

require_once get_stylesheet_directory() . '/inc/widgets/categoriesed_articles_widget.php';


add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );

   wp_enqueue_style( 'child-style', get_stylesheet_directory_uri().'/style.css' );
}



add_filter( 'excerpt_length', function( $length ) { return 20; } );


