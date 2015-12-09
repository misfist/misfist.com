<?php
function tiles_setup() {
	global $content_width;
if ( ! isset( $content_width ) ){
      $content_width = 1000;
}
	load_theme_textdomain( 'tiles', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	register_nav_menu( 'primary',  __( 'Main Menu', 'tiles' ));
	
	add_theme_support( 'custom-background', array(
		'default-color' => 'fff',
	) );
	add_theme_support( 'post-thumbnails' );
	add_image_size('tiles-blogthumb', 300, 9999);
}
add_action( 'after_setup_theme', 'tiles_setup' );
function tiles_scripts_styles() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

if (!is_admin()) {
if( is_home() || is_archive()) {
wp_enqueue_script( 'tiles-modernizr-script', get_template_directory_uri() . '/js/modernizr.custom.js', array( 'jquery' ), '', true );
wp_enqueue_script( 'masonry' );
wp_enqueue_script( 'tiles-images-loaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array( 'jquery' ), '', true );
wp_enqueue_script( 'tiles-classie-script', get_template_directory_uri() . '/js/classie.js', array( 'jquery' ), '', true );
wp_enqueue_script( 'tiles-color-finder', get_template_directory_uri() . '/js/colorfinder-1.1.js', array( 'jquery' ), '', true );
wp_enqueue_script( 'tiles-grid-scroll', get_template_directory_uri() . '/js/gridScrollFx.js', array( 'jquery' ), '', true );
}
wp_enqueue_script( 'tiles-menu-script', get_template_directory_uri() . '/js/tendina.js', array( 'jquery' ), '', true );
wp_enqueue_script( 'tiles-mobilemenu-script', get_template_directory_uri() . '/js/mobilemenu.js', array( 'jquery' ), '', true );
wp_enqueue_style('tiles-font-opensans', '//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800', array(), '1', 'screen'); 
wp_enqueue_style('tiles-arvo-font', '//fonts.googleapis.com/css?family=Arvo:400,700,400italic,700italic', array(), '1', 'screen'); 
wp_enqueue_style('tiles-custom-style', get_template_directory_uri().'/custom.css', array(), '1', 'screen'); 
wp_enqueue_style( 'tiles-genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.3' );
wp_enqueue_style( 'tiles-style', get_stylesheet_uri());
}
}
add_action( 'wp_enqueue_scripts', 'tiles_scripts_styles' );
function tiles_widgets_init() {
	
	register_sidebar( array(
		'name' => __( 'Right Sidebar', 'tiles' ),
		'id' => 'sidebar-1',
		'description' => __( 'Right sidebar visible in all pages, drag and drop widgets from the left', 'tiles' ),
		'before_widget' => '<div id="%1$s" class="widgets">',
      	'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'tiles_widgets_init' );
function tiles_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'tiles_page_menu_args' );
if ( ! function_exists( 'tiles_content_nav' ) ) :

function tiles_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>

<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
  <h3 class="assistive-text">
    <?php _e( 'Post navigation', 'tiles'); ?>
  </h3>
  <div class="nav-previous">
    <?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'tiles') ); ?>
  </div>
  <div class="nav-next">
    <?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'tiles') ); ?>
  </div>
</nav>
<!-- #<?php echo $html_id; ?> .navigation -->
<?php endif;
}
endif;
if ( ! function_exists( 'tiles_comment' ) ) :
function tiles_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
  <p>
    <?php _e( 'Pingback:', 'tiles'); ?>
    <?php comment_author_link(); ?>
    <?php edit_comment_link( __( '(Edit)', 'tiles'), '<span class="edit-link">', '</span>' ); ?>
  </p>
  <?php
			break;
		default :
		global $post;
	?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
  <article id="comment-<?php comment_ID(); ?>" class="comment">
    <header class="comment-meta comment-author vcard">
      <?php
					echo get_avatar( $comment, 44 );
					printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
						get_comment_author_link(),
						( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'tiles') . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						sprintf( __( '%1$s at %2$s', 'tiles'), get_comment_date(), get_comment_time() )
					);
				?>
    </header>
    <!-- .comment-meta -->
    
    <?php if ( '0' == $comment->comment_approved ) : ?>
    <p class="comment-awaiting-moderation">
      <?php _e( 'Your comment is awaiting moderation.', 'tiles'); ?>
    </p>
    <?php endif; ?>
    <section class="comment-content comment">
      <?php comment_text(); ?>
      <?php edit_comment_link( __( 'Edit', 'tiles'), '<p class="edit-link">', '</p>' ); ?>
    </section>
    <!-- .comment-content -->
    
    <div class="reply">
      <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'tiles'), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
    <!-- .reply --> 
  </article>
  <!-- #comment-## -->
  <?php
		break;
	endswitch; // end comment_type check
}
endif;
add_filter( 'wp_title', 'tiles_title', 10, 3 );
function tiles_title( $title, $sep, $seplocation )
{
    global $page, $paged;
    // Don't affect in feeds.
    if ( is_feed() )
        return $title;
    // Add the blog name
    if ( 'right' == $seplocation )
        $title .= get_bloginfo( 'name' );
    else
        $title = get_bloginfo( 'name' ) . $title;
    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title .= " {$sep} {$site_description}";
    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 )
        $title .= " {$sep} " . sprintf( __( 'Page %s', 'tiles'), max( $paged, $page ) );
    return $title;
}
function tiles_pagination($pages = '', $range = 4)
{  
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination\">";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".esc_url(get_pagenum_link(1))."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".esc_url(get_pagenum_link($paged - 1))."'>&lsaquo;</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".esc_url(get_pagenum_link($i))."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".esc_url(get_pagenum_link($paged + 1))."\">&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".esc_url(get_pagenum_link($pages))."'>&raquo;</a>";
         echo "</div>\n";
     }
}
function tiles_new_excerpt_length($length) {
	return 70;
}
add_filter('excerpt_length', 'tiles_new_excerpt_length'); 
function tiles_new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'tiles_new_excerpt_more');
function tiles_widget_first_last_classes($params) {

	global $tiles_widget_num; // Global a counter array
	$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
	$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets	

	if(!$tiles_widget_num) {// If the counter array doesn't exist, create it
		$tiles_widget_num = array();
	}

	if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
		return $params; // No widgets in this sidebar... bail early.
	}

	if(isset($tiles_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
		$tiles_widget_num[$this_id] ++;
	} else { // If not, create it starting with 1
		$tiles_widget_num[$this_id] = 1;
	}

	$class = 'class="widget-' . $tiles_widget_num[$this_id] . ' '; // Add a widget number class for additional styling options

	if($tiles_widget_num[$this_id] == 1) { // If this is the first widget
		$class .= 'widget-first ';
	} elseif($tiles_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { // If this is the last widget
		$class .= 'widget-last ';
	}

	$params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']); // Insert our new classes into "before widget"

	return $params;

}
add_filter('dynamic_sidebar_params','tiles_widget_first_last_classes');
add_filter( 'embed_oembed_html', 'tiles_oembed_filter', 10, 4 ) ;

function tiles_oembed_filter($html, $url, $attr, $post_ID) {
    $return = '<div class="video-container">'.$html.'</div>';
    return $return;
}
require get_template_directory() . '/customizer.php';

