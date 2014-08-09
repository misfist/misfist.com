<?php
/**
 * @package WordPress
 * @subpackage Twenty Eight
 */

$themecolors = array(
	'bg' => 'ffffff',
	'text' => '444444',
	'link' => '3388cc',
	'border' => '289acf',
	'url' => 'cccccc',
);

if ( function_exists('register_sidebars') )
	register_sidebars(2);

$content_width = 425;

function twenty_eight_body_class( $classes, $class ) {
	return $class;
}

add_filter( 'body_class', 'twenty_eight_body_class', 1, 2 );

add_theme_support( 'automatic-feed-links' );

add_custom_background();
