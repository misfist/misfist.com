<?php
/*********************/
require_once ( get_template_directory() . '/inc/typo-widgets.php' );
require_once ( get_template_directory() . '/inc/customizer_register.php' );
/*********************/
add_action( 'after_setup_theme', 'typo_setup' );
if ( ! function_exists( 'typo_setup' ) ):
	function typo_setup() {
/******typo_setup*******/		
if ( ! isset( $content_width ) )
	$content_width = 620;
/*********************/	
load_theme_textdomain( 'typo-o-graphy', get_template_directory() . '/languages' );
/*********************/	
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 620, 290, true );
add_image_size('typo_single_post', 620, 290, true);
set_post_thumbnail_size( 2000, 390, true );
add_image_size('typo', 2000, 390, true);
add_theme_support( 'post-formats', array( 'aside', 'gallery','image','link','video', 'quote','status','audio','chat' ) );
add_theme_support( 'automatic-feed-links' );
/*********************/	
add_editor_style('css/editor-style.css');
/*********************/	
if (function_exists('wp_nav_menu')) {
register_nav_menus(array('primary' =>__( 'Primary Navigation', 'typo-o-graphy' )));
register_nav_menus(array('secondary' =>__( 'Secondary Navigation', 'typo-o-graphy' )));
register_nav_menus(array('footer' =>__( 'Footer Navigation', 'typo-o-graphy' )));
}
/*********************/	
add_filter('use_default_gallery_style', '__return_false');
/*********************/ 
add_theme_support( 'custom-background', array(
'default-color' => 'EFEFEF',
'default-image' => get_template_directory_uri() . '/images/bg.jpg',
) );
/*********************/ 
$custom_header_support = array(
        'default-text-color' => 'dd3333',
        'width' => apply_filters( 'typo_header_image_width', 960 ),
        'height' => apply_filters( 'typo_header_image_height', 390 ),
        'max-width' => 2000,
        'flex-height' => true,
        'flex-width'  => true,
        'random-default' => true,
        'wp-head-callback' => 'typo_header_style',
        'admin-head-callback' => 'typo_admin_header_style',
        'admin-preview-callback' => 'typo_header_img',
    );
add_theme_support( 'custom-header', $custom_header_support );
/*********************/
    register_default_headers( array(
            'typo' => array(
            'url' => '%s/images/header.jpg',
            'thumbnail_url' => '%s/images/header-thumbnail.jpg',
            'description' => __( 'Header', 'typo-o-graphy' ),
        ),
            'typo 2' => array(
            'url' => '%s/images/header-2.jpg',
            'thumbnail_url' => '%s/images/header-thumbnail-2.jpg',
            'description' => __( 'Header 2', 'typo-o-graphy' ),
        )
    ) );
    /*********************/
}
endif;
/**********end setup***********/
/*********************/
function typo_content_width() {
if ( is_attachment() || is_page_template('page-sidebar.php') ) {
global $content_width;
$content_width = 940;
}
}
add_action( 'template_redirect', 'typo_content_width' );
/*********************/
function typo_widgets_init() {
register_sidebar( array(
        'name' => __( 'Header Widget Area', 'typo-o-graphy'),
        'id' => 'header-widget-area',
        'description' => __( 'The header widget area', 'typo-o-graphy' ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    
    register_sidebar( array(
        'name' => __( 'Sidebar Widget Area', 'typo-o-graphy'),
        'id' => 'sidebar-widget-area',
        'description' => __( 'The sidebar widget area', 'typo-o-graphy' ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    
        register_sidebar( array(
        'name' => __( 'First Footer Widget Area', 'typo-o-graphy' ),
        'id' => 'first-footer-widget-area',
        'description' => __( 'The first footer widget area', 'typo-o-graphy' ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    
    register_sidebar( array(
        'name' => __( 'Third Footer Widget Area', 'typo-o-graphy' ),
        'id' => 'third-footer-widget-area',
        'description' => __( 'The third footer widget area', 'typo-o-graphy' ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}
add_action( 'widgets_init', 'typo_widgets_init' );
/*********************/
function typo_script() {
	if (!is_admin()) {
		$options = get_option('typo_options');
	    $layout_color = $options['layout_color'];
		$lightbox = $options['layout_lightbox'];
        $header_css = $options['header_font'];
        $txt_css = $options['text_font'];
        $protocol = is_ssl() ? 'https' : 'http';
/**************************************************************************************************/  		
        if ( comments_open() && get_option( 'thread_comments' ) ) 
	       wp_enqueue_script( 'comment-reply' );
/**************************************************************************************************/  
	    wp_register_script('flexslider', get_template_directory_uri() .'/js/jquery.flexslider-min.js', array('jquery'));
		wp_enqueue_script('flexslider');
/**************************************************************************************************/  					
		wp_enqueue_style( 'typo-style', get_stylesheet_uri() );
/**************************************************************************************************/  		
		wp_register_style('layout', get_template_directory_uri(). '/css/skeleton.css', '', '30122012', 'all');
		wp_enqueue_style('layout');	
/**************************************************************************************************/  		
	    if ($lightbox !='disabled') {
		     wp_register_style('cssbox', get_template_directory_uri(). '/gallery/'.$lightbox.'/colorbox.css', '', '30122012', 'all');
	         wp_enqueue_style('cssbox');
			 	
			 wp_register_script('colorbox', get_template_directory_uri() .'/js/jquery.colorbox-min.js', array('jquery'));
		     wp_enqueue_script('colorbox');	
	}		
/**************************************************************************************************/        
        if (($header_css !='Georgia') || ($txt_css !='Georgia')) {
        wp_register_style('font', trailingslashit(get_template_directory_uri()) . 'css/font.css', '', '30122012', 'all');
        wp_enqueue_style('font');           
        } 
/**************************************************************************************************/          		
	    if ($layout_color =='Dark') {
		     wp_register_style('dark', get_template_directory_uri(). '/css/dark.css', '', '30122012', 'all');
		     wp_enqueue_style('dark');		
	}	
/**********page-home.php template***********/		
if (is_page_template('page-home.php') || is_page_template('page-home-gallery.php') || is_page_template('page-home-portfolio.php'|| is_page_template('page-home-blog.php'))) {
		wp_register_script('masonry', get_template_directory_uri() .'/js/jquery.masonry.min.js', array('jquery'));
		wp_enqueue_script('masonry');		
}
/*********************/	
		global $is_IE;
		if ($is_IE){
		wp_register_script('ie-html5', get_template_directory_uri() .'/js/html5.js', array('jquery'));
		wp_enqueue_script('ie-html5');		
		}	
/**************************************************************************************************/  		
}
}
add_action('wp_enqueue_scripts', 'typo_script');
/*********************/
function typo_fancybox() {
		$options = get_option('typo_options');
		$lightbox = $options['layout_lightbox'];
		
	if ( $lightbox !='disabled'){
		echo '<script>jQuery(document).ready(function($) {
		$(".gallery-icon a").attr("rel", \'gallery\');	
		$(".post-content a[href$=\'.jpg\']").colorbox({current:"'.__('Image {current} of {total}', 'typo-o-graphy').'" ,previous: \''.__('Previous', 'typo-o-graphy').'\',next: \''.__('Next', 'typo-o-graphy').'\', maxHeight:"99%"});
		$(".post-content a[href$=\'.jpeg\']").colorbox({current:"'.__('Image {current} of {total}', 'typo-o-graphy').'" ,previous: \''.__('Previous', 'typo-o-graphy').'\',next: \''.__('Next', 'typo-o-graphy').'\', maxHeight:"99%"});
		$(".post-content a[href$=\'.png\']").colorbox({current:"'.__('Image {current} of {total}', 'typo-o-graphy').'" ,previous: \''.__('Previous', 'typo-o-graphy').'\',next: \''.__('Next', 'typo-o-graphy').'\', maxHeight:"99%"});
		$(".post-content a[href$=\'.gif\']").colorbox({current:"'.__('Image {current} of {total}', 'typo-o-graphy').'" ,previous: \''.__('Previous', 'typo-o-graphy').'\',next: \''.__('Next', 'typo-o-graphy').'\', maxHeight:"99%"});		
});</script>';
		}
		}
add_action('wp_head', 'typo_fancybox');
/*********************/
function typo_jq() {
	if ( ! is_admin() ){
		echo '<script>jQuery(document).ready(function($) {
					$(\'.flexslider\').flexslider({
						controlsContainer : ".flex-container",
						animation : "fade",
						easing: "swing",
						slideshow: false,
					    controlNav : true,
						pauseOnHover : true,
						smoothHeight: true,
					});
				});</script>';
		}
		}
add_action('wp_head', 'typo_jq');
/*********************/
function typo_j_masonry() {
	if (is_page_template('page-home.php') || is_page_template('page-home-gallery.php')|| is_page_template('page-home-blog.php')){
		echo '<script>jQuery(document).ready(function($) {
						$("#masonry_container").masonry({
			        	itemSelector : ".masonry_box"});                                    						
		});</script>';
		}
		}
add_action('wp_head', 'typo_j_masonry');
/*********************/ 
function typo_menu_args( $args ) {
    $args['show_home'] = true;
    return $args; 
}
add_filter( 'wp_page_menu_args', 'typo_menu_args' );
/*********************/	
if ( ! function_exists( 'typo_header_style' ) ) :
function typo_header_style() { ?>
<style type="text/css">
<?php 
if ( is_singular() && has_post_thumbnail() && !has_post_format( 'image' ) && !has_post_format( 'audio' ) && !has_post_format( 'gallery' ) && !is_page_template('page-home.php') && !is_page_template('page-home-portfolio.php') && !is_page_template('page-home-gallery.php')){
    
        $image_id = get_post_thumbnail_id();
        $image_url = wp_get_attachment_image_src($image_id,"typo", true);
                
    echo '#header{ background:#000 url('.$image_url[0].') no-repeat top center; 
                   min-height: '.$image_url[2].'px
    }';
    } elseif (get_header_image()){
		$header_image_width  = get_custom_header()->width;
		$header_image_height = get_custom_header()->height;
        ?>
 #header{   
    background:#000 url(<?php header_image(); ?>) no-repeat top center;
    min-height: <?php echo $header_image_height; ?>px;
    <?php if ($header_image_width < '960') echo 'box-shadow: 0 0 0 #fff'; ?>
    }       
<?php    }  ?>

<?php if ( ! display_header_text() ) : ?>
#header .eleven, #header .sixteen {
	position: absolute !important;
	clip: rect(1px 1px 1px 1px); 
	clip: rect(1px, 1px, 1px, 1px);
}
#headerimg{min-height: 0;}
<?php	else : ?>
#header-desc, #header h1 a, #header h2 a {
	color: #<?php echo get_header_textcolor(); ?>!important;
}
	<?php endif;  ?>
</style>
<?php

}
endif;
/*********************/
if ( ! function_exists( 'typo_admin_header_style' ) ) :
function typo_admin_header_style() {
?>
<style type="text/css">
<?php if (get_header_image()) : 
	if ( function_exists( 'get_custom_header' ) ) {
		$header_image_width  = get_custom_header()->width;
		$header_image_height = get_custom_header()->height;
}
	?>	
	#header{	
	background: url(<?php header_image(); ?>) no-repeat top center;	
    min-height: <?php echo $header_image_height; ?>px; 
    width: <?php echo $header_image_width; ?>px; 
    border: 1px solid #000;
	}
<?php else : ?>
	#header {
		background: #000!important;
		min-height: 280px;
	}
<?php endif; ?>
<?php if ( ! display_header_text() ) : ?>
.headerimg  {
	display: none!important;
}
#header{min-height: 0;}
<?php	else : ?>
#header .headerimg {
    background: url(<?php echo get_template_directory_uri() ?>/images/header.png) no-repeat center top;  
}
#header{
	background:url(<?php header_image(); ?>) no-repeat top center;
	font: 14px/1.5 "Palatino Linotype", Georgia, "URW Palladio L", "Times New Roman", Times, serif;
}
#header h1, #header h2 {
    font-size: 48px;
    margin: 0 10px;
    padding: 35px 0 120px 0;
    background: url(<?php echo get_template_directory_uri() ?>/images/header-btm.png) no-repeat center bottom;
    text-align: center;
    line-height: 0.9
}

#header h3 {
    color: #555;
    font-weight: normal;
    padding: 3px 8px 35px 8px;
    margin: 0 auto 0;
    display: block;
    max-width: 360px;
    text-align: center;
    font-size: 14px;
    background: url(<?php echo get_template_directory_uri() ?>/images/header-desc.png) no-repeat center bottom;
    letter-spacing: 1px;
}
#header-desc, #header h1 a, #header h2 a {
	color: #<?php echo get_header_textcolor(); ?>!important;
	text-decoration: none;
}
.logo .headerimg, .logo h1, .logo h2, .logo #header-desc{
	background: none!important;
}
.logo h1, .logo h2{
	padding: 20px 0!important;
}
.headerimg img{
	max-width: 640px;
	height: auto
}
	<?php endif; ?>
</style>
<?php
}

endif;
/*********************/
if ( ! function_exists( 'typo_header_img' ) ) :
function typo_header_img() { ?>
<header id="header">
	<div class="container">	
<div class="sixteen columns headerimg">
<h2>
<a href="<?php echo site_url(); ?>"><?php bloginfo('name'); ?></a>
</h2>
<?php $site_description = get_bloginfo( 'description' ); if ( $site_description ) {
?>
<h3 id="header-desc"><?php echo $site_description; ?></h3>
<?php } ?>
</div>
</div>
</div>				
<?php
}
endif;
/*********************/
function typo_excerpt_length($length) {
	if (has_post_format('status')) {
	return 140;				
	} else {
	return 60;				
	}
}
add_filter('excerpt_length', 'typo_excerpt_length');
/*********************/	
function typo_quote_content( $content ) {
	if ( has_post_format( 'quote' ) ) {
		preg_match( '/<blockquote.*?>/', $content, $matches );
		if ( empty( $matches ) )
			$content = "<blockquote>{$content}</blockquote>";
	}
	return $content;
}
add_filter( 'the_content', 'typo_quote_content' );
/*********************/	
if (!function_exists('typo_posted_on')) :
function typo_posted_on() {
if (!is_search()) {
if (is_single()) {
$format_text = __('<p>%4$s <em>by</em> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s </a></span></p>', 'typo-o-graphy');
} else {
$format_text = __('<p><a href="%1$s" title="%2$s" rel="bookmark"> <time datetime="%3$s" pubdate> %4$s </time></a> <em>by</em> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s </a></span></p>', 'typo-o-graphy');
}
printf($format_text, esc_url(get_permalink()), esc_attr(sprintf(__('Permanent Link to %s', 'typo-o-graphy'), the_title_attribute('echo=0'))), esc_attr(get_the_date('c')), esc_html(get_the_date()), esc_url(get_author_posts_url(get_the_author_meta('ID'))), sprintf(esc_attr__('View all posts by %s', 'typo-o-graphy'), get_the_author()), esc_html(get_the_author()));
}
		}
endif;
/*********************/
if (!function_exists('typo_posted_footer')) :
function typo_posted_footer() {
$tag = get_the_tag_list('', __(', ', 'typo-o-graphy'));
$categories = get_the_category_list(__(', ', 'typo-o-graphy'));
if ($tag) {
printf(__('<p>Categories: %1$s, Tags: %2$s </p>', 'typo-o-graphy'), $categories, $tag);	
} 
elseif($categories) {
printf(__('<p>Categories: %1$s </p>', 'typo-o-graphy'), $categories);
} 
}
endif;
/*********************/
function typo_pre_get_posts( $query )
{
    $sticky = get_option( 'sticky_posts' );
    if ( !is_admin() && $query->is_main_query() && $query->is_home() ) {
        $query->set( 'post__not_in', $sticky );
    }
}
add_action( 'pre_get_posts', 'typo_pre_get_posts' );
/*********************/
function typo_recent_comments_style() {
global $wp_widget_factory;
remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'typo_recent_comments_style' );
/*********************/
function typo_excerpt_more( $more ) {
return ' &hellip;' . ' <a class="meta-nav" href="'. get_permalink() . '">' . __( 'Continue reading &rarr;', 'typo-o-graphy' ) . '</a>';
}
add_filter( 'excerpt_more', 'typo_excerpt_more' );
/*********************/
if (!function_exists('typo_footer_menu')) :
function typo_footer_menu() { ?>
		<ul class="twelve columns menufooter">
			<?php wp_register();?>
			<li>
				<?php wp_loginout();?>
			</li>
			<li>
				<a href="<?php bloginfo('rss2_url');?>" title="<?php _e('Syndicate this site using RSS', 'typo-o-graphy');?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>', 'typo-o-graphy');?></a>
			</li>
			<li>
				<a href="<?php bloginfo('comments_rss2_url');?>" title="<?php _e('The latest comments to all posts in RSS', 'typo-o-graphy');?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>', 'typo-o-graphy');?></a>
			</li>
			<li>
				<a href="<?php echo esc_url(__('http://wordpress.org/', 'typo-o-graphy'));?>" title="<?php _e('Powered by WordPress, state-of-the-art semantic personal publishing platform.', 'typo-o-graphy');?>"><abbr title="WordPress">WP</abbr></a>
			</li>
			<?php wp_meta();?>
		</ul>	
<?php }
endif;
/**********
 * @note: credit goes to TwentyTwelve theme.***********/
function typo_wp_title( $title, $sep ) {
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
$title = "$title $sep " . sprintf( __( 'Page %s', 'typo-o-graphy' ), max( $paged, $page ) );

return $title;
}
add_filter( 'wp_title', 'typo_wp_title', 10, 2 );
/**
 * Adjusts content_width value for video shortcodes in video post formats.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param array $atts Attribute list.
 * @return array Filtered attribute list.
 */
function typo_video_width( $atts ) {
    if ( ! is_admin() && has_post_format( 'video' ) ) {
        $new_width = 620;
        $atts['height'] = round( ( $atts['height'] * $new_width ) / $atts['width'] );
        $atts['width'] = $new_width;
    }

    return $atts;
}
add_action( 'embed_defaults',       'typo_video_width' );
add_action( 'shortcode_atts_video', 'typo_video_width' );
/*********************/
if ( ! function_exists('typo_pagination') ) {
function typo_pagination() {
global $wp_query, $wp_rewrite;
$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

$pagination = array(
'base' => @add_query_arg('paged','%#%'),
'format' => '',
'total' => $wp_query->max_num_pages,
'current' => $current,
'show_all' => false,
'mid_size' => 4,
'end_size' => 2,
'type' => 'plain'
);

if( $wp_rewrite->using_permalinks() )
$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

if( !empty($wp_query->query_vars['s']) )
$pagination['add_args'] = array( 's' => get_query_var( 's' ) );

echo '<div class="sixteen columns wp-pagenavi">' .paginate_links($pagination).'</div>' ;
}
}
/*********************/
if ( ! function_exists( 'typo_custom_comments' ) ) :
function typo_custom_comments( $comment, $args, $depth ) {
$GLOBALS['comment'] = $comment;
switch ( $comment->comment_type ) :
case 'pingback' :
case 'trackback' :
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e('Pingback:', 'typo-o-graphy'); ?> <?php comment_author_link(); ?> <?php edit_comment_link(__('(Edit)', 'typo-o-graphy'), '<span class="edit-link">', '</span>'); ?></p>
	<?php
	break;
	default :
	global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
				echo get_avatar($comment, 60);
				printf('<cite class="fn">%1$s %2$s</cite>', get_comment_author_link(), ($comment -> user_id === $post -> post_author) ? '<span> ' . __('Post author', 'typo-o-graphy') . '</span>' : '');
				printf(' <a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>', esc_url(get_comment_link($comment -> comment_ID)), get_comment_time('c'),
				/* translators: 1: date, 2: time */
				sprintf(__('%1$s at %2$s', 'typo-o-graphy'), get_comment_date(), get_comment_time()));
				?>
			</header>

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'typo-o-graphy'); ?></p>
			<?php endif; ?>

			<section class="comment post-content">
				<?php comment_text(); ?>
				<?php edit_comment_link(__('Edit', 'typo-o-graphy'), '<p class="edit-link">', '</p>'); ?>
			</section>

			<div class="reply">
				<?php comment_reply_link(array_merge($args, array('reply_text' => __('Reply <span>&darr;</span>', 'typo-o-graphy'), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
			</div>
		</article>
	<?php
	break;
	endswitch;
	}
	endif;
?>
