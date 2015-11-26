<?php
/**
 * @package Chunk
 */

if(! function_exists( 'patricia_lutz_enqueue_styles' ) ) {
	function patricia_lutz_enqueue_styles() {

		$parent_style = 'chunk-style';

	    wp_enqueue_style( 'chunk-style', trailingslashit(  get_template_directory_uri() ) . 'style.css' );

	    wp_enqueue_style( 'patricia-lutz-style', trailingslashit(  get_stylesheet_directory_uri() ) . 'style.css',
        array( $parent_style )
	      );

	    wp_enqueue_script( 'patricia-lutz-script', trailingslashit(  get_stylesheet_directory_uri() ) . 'assets/js/scripts.min.js', array( 'jquery' ), '', true );

	    wp_enqueue_style( 'oswald', 'http://fonts.googleapis.com/css?family=Oswald' );
	}

	add_action( 'wp_enqueue_scripts', 'patricia_lutz_enqueue_styles' );
}


// /**
//  * Register our footer widget area
//  */
// function chunk_widgets_init() {
// 	register_sidebar( array(
// 		'name' => __( 'Footer', 'chunk' ),
// 		'id' => 'sidebar-1',
// 		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
// 		'after_widget' => "</aside>",
// 		'before_title' => '<h3 class="widget-title">',
// 		'after_title' => '</h3>',
// 	) );

// 	register_sidebar( array(
// 		'name' => __( 'Social', 'chunk' ),
// 		'id' => 'sidebar-social',
// 		'before_widget' => '<div class="social-links">',
// 		'after_widget' => "</div>",
// 		'before_title' => '<h3 class="widget-title">',
// 		'after_title' => '</h3>',
// 	) );
// }
// add_action( 'widgets_init', 'chunk_widgets_init' );


