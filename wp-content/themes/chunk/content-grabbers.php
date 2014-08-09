<?php
/**
 * @package Chunk
 */

if ( function_exists( 'get_the_post_format_url' ) && ! function_exists( 'chunk_url_grabber' ) ) :
/**
 * Return the URL for the first link found in this post.
 *
 * @param string $the_content Post content, falls back to current post content if empty.
 * @return string URL or false when no link is present.
 */
function chunk_url_grabber( $the_content = '' ) {
	if ( empty( $the_content ) )
		$the_content = get_the_content();

	$url = get_the_post_format_url();
	if ( empty( $url ) )
		$url = get_content_url( $the_content );

	return esc_url_raw( $url );
}
endif; // function_exists( 'get_the_post_format_url' )

if ( ! function_exists( 'chunk_url_grabber' ) ) :
/**
 * Return the URL for the first link found in this post.
 *
 * @param string the_content Post content, falls back to current post content if empty.
 * @return string URL or empty string when no link is present.
 */
function chunk_url_grabber( $the_content = '' ) {
	if ( empty( $the_content ) )
		$the_content = get_the_content();
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', $the_content, $matches ) )
		return '';

	return esc_url_raw( $matches[1] );
}
endif; // ! function_exists( 'chunk_url_grabber' )

if ( ! function_exists( 'chunk_audio_grabber' ) ) :
/**
 * Return the first audio file found for a post.
 *
 * @param int post_id ID for parent post
 * @return boolean|WP_Post Attachment post.
 */
function chunk_audio_grabber( $post_id ) {
	$audio_attachments = get_children( array(
		'post_parent'    => $post_id,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'audio',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	if ( is_array( $audio_attachments ) && ! empty( $audio_attachments ) )
		return current( $audio_attachments );

	return false;
}
endif; // ! function_exists( 'chunk_audio_grabber' )
