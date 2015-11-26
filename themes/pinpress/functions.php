<?php 
/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 625;

function pin_gg_load()
{
wp_enqueue_script('jquery');
wp_enqueue_script('jquery-masonry');
}
add_action('wp_enqueue_scripts','pin_gg_load');
	
function pin_theme_setup() {

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );
	register_nav_menu( 'primary', __( 'Primary Menu', 'pin' ) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );
	$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => '444',
	    'default-image'          => '',
       // Set height and width, with a maximum value for the width.
		'height'                 => 250,
		'width'                  => 960,
		'max-width'              => 2000,

		// Support flexible height and width.
		'flex-height'            => true,
		'flex-width'             => true,

		// Random image rotation off by default.
		'random-default'         => false,
		// Callbacks for styling the header and the admin preview.
		'wp-head-callback'       => 'pin_header_style'
	);

	add_theme_support( 'custom-header', $args );
   if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
		
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); 
}
add_action( 'after_setup_theme', 'pin_theme_setup' );

//custom header text
function pin_header_style() {
	global $wp_styles;
	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'pin-ie', get_template_directory_uri() . '/ie.css', array( 'pin-style' ), '20121010' );
	$wp_styles->add_data( 'pin-ie', 'conditional', 'lt IE 9' );
	
	$text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	if ( $text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
		return;

	// If we get this far, we have custom styles.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text, use that.
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo $text_color; ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
	
}


//webfonts
function pin_google_webfonts() {
    $protocol = is_ssl() ? 'https' : 'http';
    $query_args = array(
        'family' => 'Roboto:100,300,400,500,700',
        'subset' => 'latin',
    );

    wp_enqueue_style('google-webfonts',
        add_query_arg($query_args, "$protocol://fonts.googleapis.com/css" ),
        array(), null);
}

add_action( 'wp_enqueue_scripts', 'pin_google_webfonts' );



// sidebar
function pin_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'pin' ),
		'id' => 'sidebar-1',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'pin' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'pin_widgets_init' );

if ( ! function_exists( 'pin_arc_nav' ) ) :
function pin_arc_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'pin' ); ?></h3>
			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'pin' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'pin' ) ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}
endif;

// limit excerpt
function pin_custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'pin_custom_excerpt_length', 999 );

/*commnets func*/
if ( ! function_exists( 'pin_comment' ) ) :
function pin_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'pin' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'pin' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'pin' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'pin' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'pin' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'pin' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'pin' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

//menu js
function pin_scripts_styles() {
	global $wp_styles;
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	wp_enqueue_script( 'pin-nav', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true );

	wp_enqueue_style( 'pin-style', get_stylesheet_uri() );
	
}
add_action( 'wp_enqueue_scripts', 'pin_scripts_styles' );

//for title

function pin_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	$title .= get_bloginfo( 'name' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'pin' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'pin_title', 10, 2 );

//for infinite scroll
function pin_infinite_js(){
	wp_register_script( 'infinite_scroll',  get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', array('jquery'),null,true );
	if( ! is_singular() ) {
		wp_enqueue_script('infinite_scroll');
	}
}
add_action('wp_enqueue_scripts', 'pin_infinite_js');


//Infinite Scroll and masonry

function pin_infinite_masonry_js() {
	if( ! is_singular() ) { ?>
	<script>
	function aadwid()
	{
		var ctot = jQuery('#col').width();
		var quot = Math.floor(ctot/200);
		var rem = ctot%200;
		var cadd = Math.floor(rem/quot);
		var centry = 170 + cadd;
		jQuery('#col article').css('width',centry);
	}
	jQuery(window).load(function(){
		 aadwid();
	    	jQuery("#col").masonry();
	    });

	jQuery(window).resize(function() {
		aadwid();
		jQuery("#col").masonry( 'reload' );
	});
	   
	
	var infinite_scroll = {
		loading: {
			img: "<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif",
			msgText: "<?php _e( ' ', 'custom' ); ?>",
			finishedMsg: "<?php _e( 'All posts loaded.', 'custom' ); ?>"
		},
		"nextSelector":"#nav-below .nav-previous a",
		"navSelector":"#nav-below",
		"itemSelector":"article",
		"contentSelector":"#col"
	};
	setInterval(function() {
		jQuery( infinite_scroll.contentSelector ).infinitescroll( infinite_scroll );
		aadwid();
		jQuery("#col").masonry( 'reload' );
	}, 100);
	
	
	</script>
	<?php
	}
}
add_action( 'wp_footer', 'pin_infinite_masonry_js',100 );

//for 404 page infinite scroll
function pin_paged_404_fix( ) {
	global $wp_query;
	if ( is_404() || !is_paged() || 0 != count( $wp_query->posts ) )
		return;
	$wp_query->set_404();
	status_header( 404 );
	nocache_headers();
}
add_action( 'wp', 'pin_paged_404_fix' );