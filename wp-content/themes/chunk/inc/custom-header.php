<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<?php $header_image = get_header_image();
	if ( ! empty( $header_image ) ) { ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		</a>
	<?php } // if ( ! empty( $header_image ) ) ?>

 *
 * @package Chunk
 * @since Chunk 1.1
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses chunk_header_style()
 * @uses chunk_admin_header_style()
 * @uses chunk_admin_header_image()
 *
 * @package Chunk
 */
function chunk_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'chunk_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000',
		'width'                  => 800,
		'height'                 => 140,
		'flex-height'            => true,
		'wp-head-callback'       => 'chunk_header_style',
		'admin-head-callback'    => 'chunk_admin_header_style',
		'admin-preview-callback' => 'chunk_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'chunk_custom_header_setup' );

/**
 * Shiv for get_custom_header().
 *
 * get_custom_header() was introduced to WordPress
 * in version 3.4. To provide backward compatibility
 * with previous versions, we will define our own version
 * of this function.
 *
 * @todo Remove this function when WordPress 3.6 is released.
 * @return stdClass All properties represent attributes of the curent header image.
 *
 * @package Chunk
 * @since Chunk 1.1
 */

if ( ! function_exists( 'get_custom_header' ) ) {
	function get_custom_header() {
		return (object) array(
			'url'           => get_header_image(),
			'thumbnail_url' => get_header_image(),
			'width'         => HEADER_IMAGE_WIDTH,
			'height'        => HEADER_IMAGE_HEIGHT,
		);
	}
}

if ( ! function_exists( 'chunk_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see chunk_custom_header_setup().
 *
 * @since Chunk 1.1
 */
function chunk_header_style() {

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		#site-title,
		#site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
		#header {
			min-height: 0;
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-title a {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // chunk_header_style

if ( ! function_exists( 'chunk_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see chunk_custom_header_setup().
 *
 * @since Chunk 1.1
 */
function chunk_admin_header_style() {
?>
	<style type="text/css">
	#headimg {
		width: <?php echo get_custom_header()->width; ?>px;
		height: <?php echo get_custom_header()->height; ?>px;
	}
	#heading,
	#headimg h1,
	#headimg #desc {
		display: none;
	}
	</style>
<?php
}
endif; // chunk_admin_header_style