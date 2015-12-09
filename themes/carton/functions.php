<?php
/**
 * Defining constants
 *
 * @since 1.0.0
 */
$bavotasan_theme_data = wp_get_theme();
define( 'BAVOTASAN_THEME_URL', get_template_directory_uri() );
define( 'BAVOTASAN_THEME_TEMPLATE', get_template_directory() );
define( 'BAVOTASAN_THEME_NAME', $bavotasan_theme_data->Name );

/**
 * Includes
 *
 * @since 1.0.0
 */
require( BAVOTASAN_THEME_TEMPLATE . '/library/theme-options.php' ); // Functions for theme options page
require( BAVOTASAN_THEME_TEMPLATE . '/library/preview-pro.php' ); // Preview Carton Pro

/**
 * Setting up the content width variable
 *
 * @since 1.0.0
 */
$bavotasan_theme_options = bavotasan_theme_options();
$article_width = $bavotasan_theme_options['column_width'] * 3 - 50;
if ( ! isset( $content_width ) )
	$content_width = $article_width;

add_action( 'after_setup_theme', 'bavotasan_setup' );
if ( ! function_exists( 'bavotasan_setup' ) ) :
/**
 * Initial setup for Carton theme
 *
 * This function is attached to the 'after_setup_theme' action hook.
 *
 * @uses	BAVOTASAN_THEME_TEMPLATE
 * @uses	load_theme_textdomain()
 * @uses	register_nav_menu()
 * @uses	add_theme_support()
 * @uses	add_editor_style()
 *
 * @since 1.0.0
 */
function bavotasan_setup() {
	load_theme_textdomain( 'carton', BAVOTASAN_THEME_TEMPLATE . '/library/languages' );

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'carton' ) );

	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'gallery', 'image', 'video', 'audio', 'quote', 'link', 'status', 'aside' ) );

	// This theme uses Featured Images (also known as post thumbnails) for archive pages
	add_theme_support( 'post-thumbnails' );

	// Add a filter to bavotasan_header_image_width and bavotasan_header_image_height to change the width and height of your custom header.
	add_theme_support( 'custom-header', array(
		'header-text' => false,
		'flex-height' => true,
		'flex-width' => true,
		'random-default' => true,
		'width' => apply_filters( 'bavotasan_header_image_width', 250 ),
		'height' => apply_filters( 'bavotasan_header_image_height', 80 ),
	) );

	// Add support for custom backgrounds
	add_theme_support( 'custom-background', array(
		'default-color' => 'EEEEEE',
	) );

	// Add HTML5 elements
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
}
endif; // bavotasan_setup

add_action( 'wp_head', 'bavotasan_styles', 99 );
/**
 * Add a style block to the theme for the current link color.
 *
 * This function is attached to the 'wp_head' action hook.
 *
 * @since 1.0.0
 */
function bavotasan_styles() {
	$bavotasan_theme_options = bavotasan_theme_options();
	?>
<style>
.single #primary,.page #primary,.error404 #primary,.search-no-results #primary { max-width: <?php echo $bavotasan_theme_options['sidebar_width'] + $bavotasan_theme_options['column_width'] * 3 + 10; ?>px; }
article.masonry { max-width: <?php echo $bavotasan_theme_options['column_width'] - 10; ?>px }
article.masonry:first-child { max-width: <?php echo $bavotasan_theme_options[ 'column_width'] * 2 - 10; ?>px }
#primary { padding-left: <?php echo $bavotasan_theme_options['sidebar_width']; ?>px }
#secondary { width: <?php echo $bavotasan_theme_options['sidebar_width']; ?>px }
</style>
	<?php
}

add_action( 'admin_bar_menu', 'bavotasan_admin_bar_menu', 999 );
/**
 * Add menu item to toolbar
 *
 * This function is attached to the 'admin_bar_menu' action hook.
 *
 * @param	array $wp_admin_bar
 *
 * @since 2.0.4
 */
function bavotasan_admin_bar_menu( $wp_admin_bar ) {
    if ( current_user_can( 'edit_theme_options' ) && is_admin_bar_showing() )
    	$wp_admin_bar->add_node( array( 'id' => 'bavotasan_toolbar', 'title' => BAVOTASAN_THEME_NAME, 'href' => esc_url( admin_url( 'customize.php' ) ) ) );
}

add_action( 'wp_enqueue_scripts', 'bavotasan_add_js' );
if ( ! function_exists( 'bavotasan_add_js' ) ) :
/**
 * Load all JavaScript to header
 *
 * This function is attached to the 'wp_enqueue_scripts' action hook.
 *
 * @uses	is_singular()
 * @uses	get_option()
 * @uses	wp_enqueue_script()
 * @uses	BAVOTASAN_THEME_URL
 *
 * @since 1.0.0
 */
function bavotasan_add_js() {
	$bavotasan_theme_options = bavotasan_theme_options();
	$var = array();

	if ( is_singular() ) {
		if ( get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
	} elseif ( ! is_page() ) {
		$var['loader'] = BAVOTASAN_THEME_URL . '/library/images/ajax-loader.gif';
		$var['more_text'] = '<em>' . __( 'No more posts.', 'carton' ) . '</em>';

		wp_enqueue_script( 'masonry', BAVOTASAN_THEME_URL .'/library/js/masonry.js', '', '3.1.1', true );
	}

	wp_enqueue_script( 'harvey', BAVOTASAN_THEME_URL .'/library/js/harvey.js', '', '', true );

	wp_enqueue_script( 'theme_js', BAVOTASAN_THEME_URL .'/library/js/theme.js', array( 'jquery', 'harvey' ), '', true );
	wp_localize_script( 'theme_js', 'theme_js_vars', $var );

	wp_enqueue_style( 'theme_stylesheet', get_stylesheet_uri() );
	wp_enqueue_style( 'google_fonts', '//fonts.googleapis.com/css?family=Lato:300,400,900|Quicksand', false, null, 'all' );
}
endif; // bavotasan_add_js

add_action( 'widgets_init', 'bavotasan_widgets_init' );
if ( ! function_exists( 'bavotasan_widgets_init' ) ) :
/**
 * Creating the two sidebars
 *
 * This function is attached to the 'widgets_init' action hook.
 *
 * @uses	register_sidebar()
 *
 * @since 1.0.0
 */
function bavotasan_widgets_init() {
	register_sidebar( array(
		'name' => __( 'First Sidebar', 'carton' ),
		'id' => 'sidebar',
		'description' => __( 'This is the sidebar widgetized area. All defaults widgets work great here.', 'carton' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
endif; // bavotasan_widgets_init

add_filter( 'wp_title', 'bavotasan_filter_wp_title', 10, 2 );
if ( ! function_exists( 'bavotasan_filter_wp_title' ) ) :
/**
 * Filters the page title appropriately depending on the current page
 *
 * @uses	get_bloginfo()
 * @uses	is_home()
 * @uses	is_front_page()
 *
 * @since 1.0.0
 */
function bavotasan_filter_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'carton' ), max( $paged, $page ) );

	return $title;
}
endif; // bavotasan_filter_wp_title

if ( ! function_exists( 'bavotasan_comment' ) ) :
/**
 * Callback function for comments
 *
 * Referenced via wp_list_comments() in comments.php.
 *
 * @uses	get_avatar()
 * @uses	get_comment_author_link()
 * @uses	get_comment_date()
 * @uses	get_comment_time()
 * @uses	edit_comment_link()
 * @uses	comment_text()
 * @uses	comments_open()
 * @uses	comment_reply_link()
 *
 * @since 1.0.0
 */
function bavotasan_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	switch ( $comment->comment_type ) :
		case '' :
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>" class="comment-body">
				<div class="comment-avatar">
					<?php echo get_avatar( $comment, 60 ); ?>
				</div>
				<div class="comment-content">
					<div class="comment-author">
						<?php echo get_comment_author_link() . ' '; ?>
					</div>
					<div class="comment-meta">
						<?php
						printf( __( '%1$s at %2$s', 'carton' ), get_comment_date(), get_comment_time() );
						edit_comment_link( __( '(edit)', 'carton' ), '  ', '' );
						?>
					</div>
					<div class="comment-text">
						<?php if ( '0' == $comment->comment_approved ) { echo '<em>' . __( 'Your comment is awaiting moderation.', 'carton' ) . '</em>'; } ?>
						<?php comment_text() ?>
					</div>
					<?php if ( $args['max_depth'] != $depth && comments_open() && 'pingback' != $comment->comment_type ) { ?>
					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php
			break;

		case 'pingback'  :
		case 'trackback' :
		?>
		<li class="pingback">
			<div class="comment-body">
				<?php _e( 'Pingback:', 'carton' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(edit)', 'carton' ), ' ' ); ?>
			</div>
			<?php
			break;
	endswitch;
}
endif; // bavotasan_comment

add_filter( 'excerpt_more', 'bavotasan_excerpt' );
if ( ! function_exists( 'bavotasan_excerpt' ) ) :
/**
 * Adds a read more link to all excerpts
 *
 * This function is attached to the 'excerpt_more' filter hook.
 *
 * @param	int $more
 *
 * @return	Custom excerpt ending
 *
	 * @since 1.0.0
 */
function bavotasan_excerpt( $more ) {
	return '&hellip;';
}
endif; // bavotasan_excerpt

add_filter( 'wp_trim_excerpt', 'bavotasan_excerpt_more' );
if ( ! function_exists( 'bavotasan_excerpt_more' ) ) :
/**
 * Adds a read more link to all excerpts
 *
 * This function is attached to the 'wp_trim_excerpt' filter hook.
 *
 * @param	string $text
 *
 * @return	Custom read more link
 *
 * @since 1.0.0
 */
function bavotasan_excerpt_more( $text ) {
	$bavotasan_theme_options = bavotasan_theme_options();
	return '<p class="excerpt">' . $text . '</p>' . '<p class="more-link-p"><a class="more-link" href="' . get_permalink( get_the_ID() ) . '">' . __( 'Read more &rarr;', 'carton' ) . '</a></p>';
}
endif; // bavotasan_excerpt_more

add_filter( 'the_content_more_link', 'bavotasan_content_more_link', 10, 2 );
if ( ! function_exists( 'bavotasan_content_more_link' ) ) :
/**
 * Customize read more link for content
 *
 * This function is attached to the 'the_content_more_link' filter hook.
 *
 * @param	string $link
 * @param	string $text
 *
 * @return	Custom read more link
 *
 * @since 1.0.0
 */
function bavotasan_content_more_link( $link, $text ) {
	return '<p class="more-link-p"><a class="more-link" href="' . get_permalink( get_the_ID() ) . '">' . $text . '</a></p>';
}
endif; // bavotasan_content_more_link

/*
 * Remove default gallery styles
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Add class to sub-menu parent items
 *
 * @author Kirk Wight <http://kwight.ca/adding-a-sub-menu-indicator-to-parent-menu-items/>
 * @since 1.0.0
 */
class Bavotasan_Page_Navigation_Walker extends Walker_Nav_Menu {
    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
        $id_field = $this->db_fields['id'];
        if ( !empty( $children_elements[ $element->$id_field ] ) )
            $element->classes[] = 'sub-menu-parent';

        Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
}

add_filter( 'wp_nav_menu_args', 'bavotasan_nav_menu_args' );
/**
 * Set our new walker only if a menu is assigned and a child theme hasn't modified it to one level deep
 *
 * This function is attached to the 'wp_nav_menu_args' filter hook.
 *
 * @author Kirk Wight <http://kwight.ca/adding-a-sub-menu-indicator-to-parent-menu-items/>
 * @since 1.0.0
 */
function bavotasan_nav_menu_args( $args ) {
    if ( 1 !== $args[ 'depth' ] && has_nav_menu( 'primary' ) )
        $args[ 'walker' ] = new Bavotasan_Page_Navigation_Walker;

    return $args;
}

if ( ! function_exists( 'bavotasan_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since 1.0.0
 */
function bavotasan_content_nav() {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav class="navigation" role="navigation">
			<h3 class="screen-reader-text"><?php _e( 'Post navigation', 'carton' ); ?></h3>
			<span class="nav-previous"><?php next_posts_link( __( '&larr; Older posts', 'carton' ) ); ?></span>&nbsp;&nbsp;&nbsp;<span class="nav-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'carton' ) ); ?></span>
		</nav>
	<?php endif;
}
endif;

/**
 * Retrieves the IDs for images in a gallery.
 *
 * @uses get_post_galleries() first, if available. Falls back to shortcode parsing,
 * then as last option uses a get_posts() call.
 *
 * @since 1.0.4
 *
 * @return array List of image IDs from the post gallery.
 */
function bavotasan_get_gallery_images() {
	$images = array();

	if ( function_exists( 'get_post_galleries' ) ) {
		$galleries = get_post_galleries( get_the_ID(), false );
		if ( isset( $galleries[0]['ids'] ) )
		 	$images = explode( ',', $galleries[0]['ids'] );
	} else {
		$pattern = get_shortcode_regex();
		preg_match( "/$pattern/s", get_the_content(), $match );
		$atts = shortcode_parse_atts( $match[3] );
		if ( isset( $atts['ids'] ) )
			$images = explode( ',', $atts['ids'] );
	}

	if ( ! $images ) {
		$images = get_posts( array(
			'fields' => 'ids',
			'numberposts' => 999,
			'order' => 'ASC',
			'orderby' => 'menu_order',
			'post_mime_type' => 'image',
			'post_parent' => get_the_ID(),
			'post_type' => 'attachment',
		) );
	}

	return $images;
}

add_filter( 'post_class', 'bavotasan_masonry' );
/**
 * Add masonry class where needed.
 *
 * This function is attached to the 'post_class' filter hook.
 *
 * @since 1.0.4
 */
function bavotasan_masonry( $classes ) {
    if ( is_home() || is_archive() || is_search() )
        $classes[] = 'masonry';

	return $classes;
}