<?php
add_action( 'after_setup_theme', 'bartleby_theme_setup' );
function bartleby_theme_setup() {
require_once ( get_template_directory() . '/theme-options.php' );
register_nav_menu( 'main-menu', __( 'Main Menu', 'bartleby' ) );
register_nav_menu( 'bottom-menu', __( 'Footer Menu', 'bartleby' ) );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 280, 210, true);
add_theme_support( 'custom-background', array(
// Background color default
'default-color' => 'fff'
) );
add_editor_style('/inc/custom-editor-style.css');
if ( ! isset( $content_width ) ) $content_width = 900;
function bartleby_new_excerpt_more($more) {
global $post;
return '...';
}
add_filter('excerpt_more', 'bartleby_new_excerpt_more');
function bartleby_custom_excerpt_length( $length ) {
return 20;
}
add_filter( 'excerpt_length', 'bartleby_custom_excerpt_length', 999 );
function bartleby_blank_slate_title($title) {
if ($title == '') {
return 'Untitled Post';
} else {
return $title;
}
}
add_filter('the_title', 'bartleby_blank_slate_title');
/* Thanks to One Trick Pony, StackExchange */
add_filter('post_class', 'bartleby_post_class');
function bartleby_post_class($classes){
  global $wp_query;
  if(($wp_query->current_post+1) == $wp_query->post_count) $classes[] = 'last';
  return $classes;
}
/* Secondary Excerpt by c.bavota - thanks! */
function bartleby_excerpt($limit) {
$excerpt = explode(' ', get_the_excerpt(), $limit);
if (count($excerpt)>=$limit) {
array_pop($excerpt);
$excerpt = implode(" ",$excerpt).'...';
} else {
$excerpt = implode(" ",$excerpt);
}	
$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
return $excerpt;
}
function bartleby_content($limit) {
$content = explode(' ', get_the_content(), $limit);
if (count($content)>=$limit) {
array_pop($content);
$content = implode(" ",$content).'...';
} else {
$content = implode(" ",$content);
}
$content = preg_replace('/\[.+\]/','', $content);
$content = apply_filters('the_content', $content); 
$content = str_replace(']]>', ']]&gt;', $content);
return $content;
}
}
function bartleby_wp_title( $title, $sep ) {
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
$title = "$title $sep " . sprintf( __( 'Page %s', 'bartleby' ), max( $paged, $page ) );
return $title;
}
add_filter( 'wp_title', 'bartleby_wp_title', 10, 2 );
// End theme setup
/* Scripts, Fonts & Styles */
/**
 * Enqueue Google Fonts
 */
function bartleby_font() {
	$protocol = is_ssl() ? 'https' : 'http';
		wp_register_style( 'bartleby-slab', "$protocol://fonts.googleapis.com/css?family=Josefin+Slab" );
		wp_register_style( 'bartleby-ubuntu', "$protocol://fonts.googleapis.com/css?family=Ubuntu+Condensed" );
}
add_action( 'init', 'bartleby_font' );
function bartleby_scripts_styles() {
	global $wp_styles;
	wp_register_style( 'bartleby-foundation-style', get_template_directory_uri() . '/stylesheets/foundation.min.css', 
	array(), 
	'2132013', 
	'all' );
	wp_register_script( 'bartleby-modernizr', get_template_directory_uri() . '/javascripts/modernizr.foundation.js', array(), '1.0', true );
	wp_register_script( 'bartleby-navigation', get_template_directory_uri() . '/javascripts/navigation.js', array(), '1.0', true );
		// enqueing:
	wp_enqueue_style( 'bartleby-foundation-style' );
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'bartleby-slab' );
	wp_enqueue_style( 'bartleby-ubuntu' );
	wp_enqueue_script( 'bartleby-navigation');
	wp_enqueue_script( 'bartleby-modernizr');
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { 
		wp_enqueue_script( 'comment-reply' ); 
	}
}
add_action( 'wp_enqueue_scripts', 'bartleby_scripts_styles' );
/* Sidebar Areas */
function bartleby_register_sidebars() {
register_sidebar(array(
'name' => __( 'Right Sidebar', 'bartleby' ),
'id' => 'sidebar',
'description' => __( 'Widgets in this area will be shown on the right-hand side.', 'bartleby' ),
'before_widget' => '<div>',
'after_widget' => '</div>',
'before_title' => '<div class="sidebar-title-block"><h4 class="sidebar">',
'after_title' => '</h4></div>',
));
register_sidebar(array(
'name' => __( 'Below Posts' , 'bartleby' ),
'id' => 'belowposts-sidebar',
'description' => __( 'Widgets in this area will be shown beneath the blog post type. Use this for sharing, related articles and more.' , 'bartleby' ),
'before_title' => '<div class="sidebar-title-block"><h4 class="belowposts">',
'after_title' => '</h4></div>',
'before_widget' => '<div class="bottom-widget">',
'after_widget' => '</div><hr>',
));
}
add_action( 'widgets_init', 'bartleby_register_sidebars' );
/* Twenty Twelve Comment System */
if ( ! function_exists( 'twentytwelve_comment' ) ) :
/**
* Template for comments and pingbacks.
* To override this walker in a child theme without modifying the comments template
* simply create your own twentytwelve_comment(), and that function will be used instead.
* Used as a callback by wp_list_comments() for displaying the comments.
* @since Twenty Twelve 1.0
*/
function bartleby_comment( $comment, $args, $depth ) {
$GLOBALS['comment'] = $comment;
switch ( $comment->comment_type ) :
case 'pingback' :
case 'trackback' :
// Display trackbacks differently than normal comments.
?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
<p><?php esc_attr_e( 'Pingback:', 'bartleby' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'bartleby' ), '<span class="edit-link">', '</span>' ); ?></p>
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
echo get_avatar( $comment, 77 );
printf( '<cite class="fn">%1$s %2$s</cite>',
get_comment_author_link(),
// If current post author is also comment author, make it known visually.
( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'bartleby' ) . '</span>' : ''
);
printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
esc_url( get_comment_link( $comment->comment_ID ) ),
get_comment_time( 'c' ),
/* translators: 1: date, 2: time */
sprintf( __( '%1$s at %2$s', 'bartleby' ), get_comment_date(), get_comment_time() )
);
?>
</header><!-- .comment-meta -->
<?php if ( '0' == $comment->comment_approved ) : ?>
<p class="comment-awaiting-moderation"><?php esc_attr_e( 'Your comment is awaiting moderation.', 'bartleby' ); ?></p>
<?php endif; ?>
<section class="comment-content comment">
<?php comment_text(); ?>
<?php edit_comment_link( __( 'Edit', 'bartleby' ), '<p class="edit-link">', '</p>' ); ?>
</section><!-- .comment-content -->
<div class="reply">
<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'bartleby' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
</div><!-- .reply -->
</article><!-- #comment-## -->
<?php
break;
endswitch; // end comment_type check
}endif;