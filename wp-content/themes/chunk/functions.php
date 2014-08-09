<?php
/**
 * @package Chunk
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 580;

/**
 * Setup Chunk
 */
function chunk_setup() {
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 */
	load_theme_textdomain( 'chunk', get_template_directory_uri() . '/languages' );

	/**
	 * Add feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'gallery', 'chat', 'audio' ) );

	/**
	 * Add custom background support.
	 */
	add_theme_support( 'custom-background' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Main Menu', 'chunk' ),
	) );
}
add_action( 'after_setup_theme', 'chunk_setup' );


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function chunk_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'chunk_page_menu_args' );

/**
 * Register our footer widget area
 */
function chunk_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer', 'chunk' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'chunk_widgets_init' );

/**
 * Enqueue scripts and styles
 *
 * @since Chunk 1.1
 */
function chunk_general_scripts() {
	wp_enqueue_style( 'chunk-style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'chunk_general_scripts' );

/**
 * Enqueue font styles.
 */
function chunk_fonts() {
	$protocol = is_ssl() ? 'https' : 'http';
	wp_enqueue_style( 'oswald', "$protocol://fonts.googleapis.com/css?family=Oswald&subset=latin,latin-ext" );
}
add_action( 'wp_enqueue_scripts', 'chunk_fonts' );

/**
 * Audio helper script.
 *
 * If an audio shortcode exists we will enqueue javascript
 * that replaces all non-supported audio player instances
 * with text links.
 *
 * @uses shortcode_exists();
 */
function chunk_scripts() {
	if ( shortcode_exists( 'audio' ) )
		return;

	if ( ! is_singular() || has_post_format( 'audio' ) )
		wp_enqueue_script( 'chunk-audio', get_template_directory_uri() . '/js/audio.js', array(), '20120314' );
}
add_action( 'wp_enqueue_scripts', 'chunk_scripts' );

/**
 * Custom Classes
 */
function chunk_body_classes( $classes ) {
	if ( is_multi_author() ) {
		$classes[] = 'multiple-authors';
	} else {
		$classes[] = 'single-author';
	}

	return $classes;
}
add_filter( 'body_class', 'chunk_body_classes' );

/**
 * Date formats for Chunk.
 */
function chunk_date() {
	$date_format = get_option( 'date_format' );
	if ( 'F j, Y' == $date_format ) :
		the_time( 'M d Y' );
	else:
		the_time( $date_format );
	endif;
}

/**
 * Appends post title to Aside and Quote posts
 *
 * @param string $content
 * @return string
 */
function chunk_conditional_title( $content ) {

	if ( has_post_format( 'aside' ) || has_post_format( 'quote' ) ) {
		if ( ! is_singular() )
			$content .= the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>', false );
		else
			$content .= the_title( '<h2 class="entry-title">', '</h2>', false );
	}

	return $content;
}
add_filter( 'the_content', 'chunk_conditional_title', 0 );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @since Chunk 1.1
 */
function chunk_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'chunk' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'chunk_wp_title', 10, 2 );

/**
 * Get a short-form mime type for an audio file to display as a class attribute.
 *
 * @param int ID of an attachment
 * @return string A short representation of the file's mime type.
 */
function chunk_post_classes( $classes ) {
	if ( has_post_format( 'audio' ) ) {
		$audio = chunk_audio_grabber( get_the_ID() );

		if ( $audio ) {
			$mime = str_replace( 'audio/', '', get_post_mime_type( $audio->ID ) );
			if ( in_array( $mime, array( 'mp3', 'ogg', 'wav', ) ) )
				$classes[] = $mime;
		}
	}
	return $classes;
}
add_filter( 'post_class', 'chunk_post_classes' );

if ( ! function_exists( 'the_post_format_audio' ) ) :
/**
 * Shiv for the_post_format_audio().
 *
 * the_post_format_audio() was introduced to WordPress in version 3.6. To
 * provide backward compatibility with previous versions, we will define our
 * own version of this function.
 *
 * @todo Remove this function when WordPress 3.8 is released.
 *
 * @param string $name The name of the shortcode.
 * @return bool True if shortcode exists; False otherwise.
 */
function the_post_format_audio() {
	$audio = chunk_audio_grabber( get_the_ID() );
	if ( ! empty( $audio ) ) :
		$url = wp_get_attachment_url( $audio->ID );
	?>
		<div class="player">
			<audio controls preload="auto" autobuffer id="audio-player-<?php the_ID(); ?>" src="<?php echo esc_url( $url ); ?>">
				<source src="<?php echo esc_url( $url ); ?>" type="<?php echo esc_attr( get_post_mime_type( $audio->ID ) ); ?>" />
			</audio>
			<p class="audio-file-link"><?php printf( __( 'Download: %1$s', 'chunk' ), sprintf( '<a href="%1$s">%2$s</a>', esc_url( $url ), get_the_title( $audio->ID ) ) ); ?></p>
		</div>
	<?php
	endif;
}
endif;

if ( ! function_exists( 'shortcode_exists' ) ) :
/**
 * Shiv for shortcode_exists().
 *
 * shortcode_exists() was introduced to WordPress in version 3.6. To
 * provide backward compatibility with previous versions, we will define our
 * own version of this function.
 *
 * @todo Remove this function when WordPress 3.8 is released.
 *
 * @param string $name The name of the shortcode.
 * @return bool True if shortcode exists; False otherwise.
 */
function shortcode_exists( $tag ) {
	global $shortcode_tags;
	return array_key_exists( $tag, $shortcode_tags );
}
endif;

/**
 * Deprecated.
 *
 * This function is kept just in case it has
 * been used in a child theme. It does nothing.
 *
 * @deprecated 1.1
 */
function chunk_add_audio_support() {
	_deprecated_function( __FUNCTION__, '1.2' );
}

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Load up our functions for grabbing content from posts
 */
require( get_template_directory() . '/content-grabbers.php' );

/**
 * Load Jetpack compatibility file.
 */
require( get_template_directory() . '/inc/jetpack.php' );
