<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Chunk
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function chunk_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'footer_widgets' => is_active_sidebar( 'sidebar-1' ),
		'container'      => 'content',
		'footer'         => 'page',
	) );
}
add_action( 'after_setup_theme', 'chunk_jetpack_setup' );
