<?php
/**
 * @package gridz
 */
/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if(!isset($content_width)) $content_width = 640;

require(get_template_directory().'/inc/admin/theme-options.php');
$gridz_options = gridz_get_options();

/**
 * Inital theme setup
 */
add_action('after_setup_theme','gridz_setup');
function gridz_setup() {
    load_theme_textdomain('gridz', get_template_directory().'/languages' );
    add_editor_style();
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    add_image_size("gridz-featured",800,400,true);
    add_image_size("gridz-slider",640,640,true);
    register_nav_menu('primary', __('Primary Menu', 'gridz'));
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list'));
    add_theme_support('post-formats', array('gallery','image','video','audio','quote','link'));
    add_theme_support('custom-background', array('default-color' => "EEEEEE"));
    add_filter('use_default_gallery_style', '__return_false');
}

/**
 * Custom Header Setup
 */
function gridz_custom_header() {
    $args = array(
	'default-text-color' => 'ffffff',
	'default-image' => '',	
	'width' => 1600,
	'max-width' => 2000,
	'height' => 180,
	'flex-height' => true,
	'flex-width' => true,
	'random-default' => false,
	'wp-head-callback' => 'gridz_header_style',
	'admin-head-callback' => 'gridz_header_admin_style',
	'admin-preview-callback' => 'gridz_custom_header_admin_display'
    );
    add_theme_support('custom-header', $args);
}
add_action('after_setup_theme', 'gridz_custom_header');

/**
 * Custom header style
 */
function gridz_header_style() {
    global $gridz_options;
    $text_color = trim(get_header_textcolor());
    $header_image = trim(get_header_image());
    if($text_color == "") $text_color = "ffffff";
    if($header_image != "") $header_img_style = 'background-image: url('.$header_image.'); background-repeat: repeat;';
    if(!display_header_text()) $text_style = 'display: none;';
    ?>
    <style type="text/css">
	#header { background-color: <?php echo $gridz_options['header_color']; ?>; }
	#header .wrapper { height: <?php echo get_theme_support('custom-header', 'height'); ?>px; }
	#header { <?php echo $header_img_style; ?> }
	#header .site-title, #header .site-title a, #header .site-description { color: #<?php echo $text_color; ?>; }
	#header .site-title, #header .site-description { <?php echo $text_style; ?> }
	#header .site-title { font-size: <?php echo $gridz_options['site_title_font_size']; ?>px; }
	#header .site-title { <?php echo $gridz_options['site_title_font']; ?> }
    </style>
    <?php
}

/**
 * Custom header admin style
 */
function gridz_header_admin_style() {
    global $gridz_options;
    $text_color = trim(get_header_textcolor());
    $header_image = trim(get_header_image());
    if($text_color == "") $text_color = "ffffff";
    if($header_image != "") $header_img_style = 'background-image: url('.$header_image.'); background-repeat: repeat;';
    if(!display_header_text()) $text_style = 'display: none;';
    ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/fonts/fonts.css" type="text/css" media="all" />
    <style type="text/css">
	#headerimg { background-color: <?php echo $gridz_options['header_color']; ?>; overflow: hidden; <?php echo $header_img_style; ?> }
	#headerimg, #headerimg .tablayout { height: <?php echo get_theme_support('custom-header', 'height'); ?>px; }
	#headerimg .tablayout { width: 100%; }
	#headerimg .tablayout td { vertical-align: middle; text-align: left; padding: 10px 20px; }
	#headerimg .site-title { line-height: 1; margin-bottom: 0; padding-bottom: 0; <?php echo $gridz_options['site_title_font']; ?> font-size: <?php echo $gridz_options['site_title_font_size']; ?>px; }
	#headerimg .site-title, #headerimg .site-title a, #headerimg .site-description { color: #<?php echo $text_color; ?>; <?php echo $text_style; ?> text-decoration: none; }
	#headerimg .site-description { font-family: "Helvetica Neue", Helvetica, Arial, sans-serif !important; font-size: 13px; font-weight: 300; }
    </style>
    <?php
}

/**
 * Custom Header Display
 */
function gridz_custom_header_admin_display() {    
    ?>
    <header id="headerimg">
	<table class="tablayout"><tr>
	    <td><?php gridz_site_info(); ?></td>
	</tr></table>
    </header>
    <?php
}

/**
 * Register sidebars and widgetized areas
 */
function gridz_widgets_init() {
    register_sidebar(array(
        'name' => __('Primary Sidebar', 'gridz'),
        'id' => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Footer Widget Area 1', 'gridz'),
        'id' => 'sidebar-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Footer Widget Area 2', 'gridz'),
        'id' => 'sidebar-3',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Footer Widget Area 3', 'gridz'),
        'id' => 'sidebar-4',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'gridz_widgets_init');

/**
 * Count the number of footer widget areas to enable dynamic classes for the footer
 */
function gridz_footer_widget_class() {
    $count = 0;
    if(is_active_sidebar('sidebar-2'))
        $count++;
    if(is_active_sidebar('sidebar-3'))
        $count++;
    if(is_active_sidebar('sidebar-4'))
        $count++;
    $class = '';
    switch($count) {
        case '1':
            $class = 'one';
            break;
        case '2':
            $class = 'two';
            break;
        case '3':
            $class = 'three';
            break;
    }
    if($class)
        echo 'class="clearfix '.$class.'"';
}

/**
 * Default menu to use if custom menu is not used
 */
function gridz_page_menu_args($args) {
    $args['show_home'] = false;
    $args['menu_class'] = 'primary-menu';
    return $args;
}
add_filter('wp_page_menu_args', 'gridz_page_menu_args');

/**
 * Responsive Dropdown Navigation
 */
function gridz_responsive_menu() {
    $location = 'primary';
    $menu_id = "";
    $current_page_url = get_permalink();
    $locations = get_nav_menu_locations();
    $output = '';
    if(has_nav_menu($location)) {
	$menu = wp_get_nav_menu_object($locations[$location]);
        $menu_id = $menu->term_id;
        $menu_items = wp_get_nav_menu_items($menu_id);
	$output .= '<nav id="navigation" class="responsive-navigation"><div class="wrapper">';
	$output .= '<div class="responsive-menu"><ul><li id="select-menu-item"><a href="javascript:void(0)">'.__('Select Page','gridz').'</a></li>';
	foreach((array)$menu_items as $key => $menu_item) {
	    $title = $menu_item->title;
            $url = $menu_item->url;
            if($current_page_url == $url) $current_page_class = ' class="current-responsive-page"'; else $current_page_class = '';
	    $output .= '<li'.$current_page_class.'><a href="'.$url.'">'.$title.'</a></li>';
	}
	$output .= '</ul></div>';
	$output .= '</div></nav>';
    } else {
	$menu_items = get_pages('hierarchical=0');
	$output .= '<nav id="navigation" class="responsive-navigation"><div class="wrapper">';
	$output .= '<div class="responsive-menu"><ul><li id="select-menu-item"><a href="javascript:void(0)">'.__('Select Page','gridz').'</a></li>';
	foreach($menu_items as $menu_item) {
	    $title = $menu_item->post_title;
            $url = get_page_link($menu_item->ID);
	    if($current_page_url == $url) $current_page_class = ' class="current-responsive-page"'; else $current_page_class = '';
	    $output .= '<li'.$current_page_class.'><a href="'.$url.'">'.$title.'</a></li>';
	}
	$output .= '</ul></div>';
	$output .= '</div></nav>';
    }
    echo $output;
}

/**
 * Filters Title for the Site
 */
function gridz_filter_wp_title($title) {
    $site_name = get_bloginfo('name');
    if(trim($title) != '') {
	$title = str_replace('&raquo;','',$title);
	$filtered_title = $title.' | '.$site_name;
    } else
	$filtered_title = $site_name;
    if (is_front_page()) {
        $site_description = get_bloginfo('description');
	if(trim($site_description) != '')
	    $filtered_title .= ' | '.$site_description;
    }
    return $filtered_title;
}
add_filter('wp_title', 'gridz_filter_wp_title');

/**
 * Blog Info
 */
function gridz_site_info($show_desc = true) {
    $site_title = get_bloginfo('name');
    echo '<h1 class="site-title"><a href="'.esc_url(home_url()).'">'.$site_title.'</a></h1>';
    if(trim(get_bloginfo('description')) != "" and $show_desc) {
        echo '<p class="site-description">'.get_bloginfo('description').'</p>';
    }
}

/**
 * Site Logo
 */
function gridz_site_logo() {
    global $gridz_options;
    if(trim($gridz_options['logo']) != "") {
	echo '<div class="site-logo"><img src="'.esc_url($gridz_options['logo']).'"/></div>';
    }
}

/**
 * Custom Favicon
 */
function gridz_site_favicon() {
    global $gridz_options;
    if(trim($gridz_options['favicon']) != "") {
	echo '<link rel="shortcut icon" href="'.esc_url($gridz_options['custom_favicon']).'"/>'."\n";
    }
}
add_action('wp_head','gridz_site_favicon');

/**
 * Enqueue javascript & stylesheet files required by theme
 */
function gridz_enqueue_scripts() {
    global $gridz_options;
    if(is_admin())
	return;
    if(is_singular() && get_option('thread_comments'))
        wp_enqueue_script('comment-reply');
    wp_enqueue_script('jquery');
    wp_enqueue_script('gridz_masonry_js', get_template_directory_uri().'/js/masonry.pkgd.min.js','jquery');
    wp_enqueue_script('gridz_imagesloaded_js', get_template_directory_uri().'/js/imagesloaded.pkgd.min.js','jquery');
    wp_enqueue_script('gridz_theme_js', get_template_directory_uri().'/js/theme.js','jquery');
    wp_enqueue_script('gridz_prettyPhoto_js', get_template_directory_uri().'/js/jquery.prettyPhoto.js','jquery');
    wp_enqueue_script('gridz_flexslider_js', get_template_directory_uri().'/js/jquery.flexslider-min.js','jquery');
    wp_enqueue_script('gridz_retina_js', get_template_directory_uri().'/js/retina-1.1.0.min.js','jquery');
    wp_enqueue_style('gridz_stylesheet', get_stylesheet_uri(), false, '1.0.1', 'all');
    wp_enqueue_style('gridz_font_css', get_template_directory_uri().'/fonts/stylesheet.css',false,false);
    wp_enqueue_style('gridz_genericons_css', get_template_directory_uri().'/genericons/genericons.css',false,false);
    wp_enqueue_style('gridz_prettyPhoto_css', get_template_directory_uri().'/css/prettyPhoto.css',false,false);
    wp_enqueue_style('gridz_flexslider_css', get_template_directory_uri().'/css/flexslider.css',false,false);
}
add_action('wp_enqueue_scripts', 'gridz_enqueue_scripts');

/**
 * Masonry Init
 */
function gridz_masonry_init() {
    global $gridz_options;
    wp_reset_query();
    if(!is_page() && !is_single()):
    ?>
    <script type="text/javascript">
	jQuery(window).load(function() {
	    var $container = jQuery("#grid-container");
	    $container.imagesLoaded(function() {
		$container.masonry({
		    itemSelector: ".grid",
		    isAnimated: true
		});
	    });
	});
    </script>
    <?php
    endif;
}
add_action("wp_footer","gridz_masonry_init");

/**
 * FlexSlider Init
 */
function gridz_flexslider_init() {
    wp_reset_query();
    if(!is_page() && !is_single()):
    ?>
    <script type="text/javascript">	
	jQuery(window).load(function() {
	    flexslider_init();
	});
	function flexslider_init() {
	    jQuery(".flexslider").flexslider({
		controlsContainer: ".flex-container",
                animation: "fade",
		slideshow: false,
		controlNav: false,
                slideshowSpeed: 4000,
		prevText: "<span class='genericon-previous'></span>",
		nextText: "<span class='genericon-next'></span>"
            });
	}
    </script>
    <?php
    endif;
}
add_action("wp_footer","gridz_flexslider_init");

/**
 * Adding IE related scripts to head
 */
function gridz_enqueue_ie_scripts() {
    echo '<!--[if lt IE 9]><script src="'.get_template_directory_uri().'/js/html5.js" type="text/javascript"></script><![endif]-->'."\n";
    echo '<!--[if lt IE 9]><link rel="stylesheet" href="'.get_template_directory_uri().'/css/ie8.css" type="text/css" media="all" /><![endif]-->'."\n";
    echo '<!--[if IE]><link rel="stylesheet" href="'.get_template_directory_uri().'/css/ie.css" type="text/css" media="all" /><![endif]-->'."\n";
}
add_action('wp_head','gridz_enqueue_ie_scripts');

/**
 * Custom CSS
 */
function gridz_custom_css() {
    global $gridz_options;
    ?>
    <style type="text/css">
	body { <?php echo $gridz_options['content_font']; ?> }	
	.primary-menu ul li a:hover { border-bottom-color: <?php echo $gridz_options['color_scheme']; ?>; color: <?php echo $gridz_options['color_scheme']; ?> !important; }
	.primary-menu ul li.current-menu-item a, .primary-menu ul li.current_page_item a { border-bottom-color: <?php echo $gridz_options['color_scheme']; ?>; color: <?php echo $gridz_options['color_scheme']; ?>; }
	.primary-menu li.has-bottom-child ul { border-top: 2px <?php echo $gridz_options['color_scheme']; ?> solid; }
	#page-navigation a:hover, #page-navigation a.current, #load-more a:hover { -moz-box-shadow: 0 2px <?php echo $gridz_options['color_scheme']; ?>; -webkit-box-shadow: 0 2px <?php echo $gridz_options['color_scheme']; ?>; box-shadow: 0 2px <?php echo $gridz_options['color_scheme']; ?>; }
	.entry-title { <?php echo $gridz_options['post_title_font']; ?> font-size: <?php echo $gridz_options['post_title_font_size']; ?>px; }
	.single-title { font-size: <?php echo ($gridz_options['post_title_font_size'] + 6); ?>px; }
	.widget-title, .comments-title { <?php echo $gridz_options['widget_title_font']; ?> font-size: <?php echo $gridz_options['widget_title_font_size']; ?>px; }
	.entry-meta a:hover, .entry-footer a:hover, .entry-content .more-link, #footer a:hover, .entry-content a, .comments-meta a, .comment-content a, #respond a, .comment-awaiting-moderation { color: <?php echo $gridz_options['color_scheme']; ?>; }
	article.grid blockquote, .widget #wp-calendar td#today span, .page-link span, .page-link a:hover span, .post-navigation a:hover, .comment-navigation a:hover { background-color: <?php echo $gridz_options['color_scheme']; ?>; }
	.flex-direction-nav a:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover { background-color: <?php echo $gridz_options['color_scheme']; ?> !important; }
	.widget_tag_cloud a:hover { border-color: <?php echo $gridz_options['color_scheme']; ?>; color: <?php echo $gridz_options['color_scheme']; ?>; }
    </style>
    <?php
}
add_action("wp_head","gridz_custom_css");

/**
 * Custom Background Color.
 * Remove default background pattern for custom background color
 */
function gridz_custom_bg_color() {
    $bgcolor = trim(get_background_color());
    $bgimage = trim(get_background_image());
    if($bgcolor != "" && $bgimage == ""):
    ?>
    <style type="text/css">
	body { background-image: none; }
    </style>
    <?php
    elseif($bgcolor == "" && $bgimage == ""):
    ?>
    <style type="text/css">
	body { background-size: 132px 132px; }
    </style>
    <?php
    endif;
}
add_action('wp_head','gridz_custom_bg_color');

/**
 * Adding PrettyPhoto Rel attribute to Images
 */
function gridz_prettyphoto_rel($content) {
    global $post;
    $pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
    $replacement = '<a$1href=$2$3.$4$5 rel="prettyPhoto['.$post->ID.']"$6>$7</a>';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}
add_filter('the_content','gridz_prettyphoto_rel');

/**
 * Add PrettyPhoto Init Script
 */
function gridz_prettyphoto_init() {
?>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery("a[rel^='prettyPhoto']").prettyPhoto({social_tools:false});
        });
    </script>
<?php
}
add_action("wp_footer","gridz_prettyphoto_init");

/**
 * Footer Credit
 */
function gridz_footer_credit() {
    $output = '';
    $output .= __('Copyright &copy;','gridz').' '.get_bloginfo('name');
    echo $output;
}

/**
 * Display Featured Image
 */
function gridz_featured_image($size = 'full', $link = true, $class = 'entry-featured') {
    if(has_post_thumbnail()) {
	$image = get_the_post_thumbnail(get_the_ID(),$size);
	if(trim($image) != "") {
	    if($link) echo '<div class="'.$class.'"><a href="'.get_permalink().'">'.$image.'</a></div>';
	    else echo '<div class="'.$class.'">'.$image.'</div>';
	}
    }
}

/**
 * Content class based on existence of sidebar
 */
function gridz_content_class($classname = 'fullwidth') {
    global $gridz_options;
    $output = 'grid-col-'.$gridz_options['grid_columns'];
    if(!is_active_sidebar('sidebar-1')) $output .= ' '.$classname;
    elseif(is_404() || is_page_template("page-fullwidth.php")) $output .= ' '.$classname;
    elseif((is_home() || is_archive()) && !$gridz_options['show_home_sidebar']) {
	$output .= ' '.$classname;
    }
    echo ' class="'.$output.'"';
}

/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own gridz_posted_on to override in a child theme
 */
function gridz_posted_on($dateformat = 'M j, Y', $date_label = '', $author_label = '') {
    echo '<span class="entry-date">'.$date_label.'<a href="'.esc_url(get_permalink()).'" title="'.esc_attr(get_the_time()).'" rel="bookmark">'.esc_html(get_the_date($dateformat)).'</a></span><span class="entry-author">'.$author_label.'<a href="'.esc_url(get_author_posts_url(get_the_author_meta('ID'))).'" title="'.esc_attr(sprintf(__('View all posts by %s', 'gridz'), get_the_author())).'" rel="author">'.get_the_author().'</a></span>';
}

/**
 * Display Post Comments link
 */
function gridz_comments_link($comments_label = true) {
    if(comments_open() && !post_password_required()) {
        if($comments_label)
            comments_popup_link(__('0 Comments', 'gridz'), __('1 comment', 'gridz'), __('% comments', 'gridz'), 'entry-comments');
        else
            comments_popup_link(__('0', 'gridz'), __('1', 'gridz'), __('%', 'gridz'), 'entry-comments');
    }
}

/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function gridz_excerpt_length($length) {
    return 40;
}
add_filter('excerpt_length', 'gridz_excerpt_length');

/**
 * Returns a Read more link for excerpts
 */
function gridz_continue_reading_link() {
    return '<a class="more-link" href="'.get_permalink().'">'.__('Read more...','gridz').'</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with a gridz_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function gridz_auto_excerpt_more($more) {
    return gridz_continue_reading_link();
}
add_filter('excerpt_more', 'gridz_auto_excerpt_more');

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function gridz_custom_excerpt_more( $output ) {
    if(has_excerpt() && !is_attachment()) {
        $output .= gridz_continue_reading_link();
    }
    return $output;
}
add_filter('get_the_excerpt', 'gridz_custom_excerpt_more');

/**
 * Post Categories & Tags List
 */
function gridz_utility_list($container = true, $show_categories = true, $show_tags = true, $show_label = true, $category_label = "", $tag_label = "", $sep = ", ") {
    global $gridz_options;
    $show_categories = $gridz_options['show_categories'];
    $show_tags = $gridz_options['show_tags'];
    $output = "";
    $categories_list = "";
    $tag_list = "";
    if($show_categories) $categories_list = get_the_category_list($sep);
    if($show_tags) {
        if($show_label) $tag_list = get_the_tag_list('<span class="entry-tags">'.$tag_label,$sep,'</span>');
        else $tag_list = get_the_tag_list('<span class="entry-tags">'.'',$sep,'</span>');
    }
    if($categories_list != "") {
        if($show_label) $categories_list = '<span class="entry-categories">'.$category_label.$categories_list.'</span>';
        else $categories_list = '<span class="entry-categories">'.$categories_list.'</span>';
    }
    $output .= $categories_list.$tag_list;
    if($container and $output != "") $output = '<div class="entry-utility">'.$output.'</div>'."\n";
    echo $output;
}

/**
 * Create paged navigation for posts
 */
function gridz_pagination($range = 4){
    global $paged, $wp_query;
    $max_page = 0;
    if (!$max_page) {
        $max_page = $wp_query->max_num_pages;
    }
    if($max_page > 1){
        echo '<nav id="page-navigation">'."\n";
        if(!$paged){
            $paged = 1;
        }
        if($paged != 1){
            echo "<a class='first-page' href=".get_pagenum_link(1).">".__('First','gridz')."</a>";
        }
        previous_posts_link(' &laquo; ');
        if($max_page > $range){
            if($paged < $range){
                for($i = 1; $i <= ($range + 1); $i++){
                    echo "<a href='".get_pagenum_link($i) ."'";
                    if($i==$paged) echo " class='current'";
                    echo ">".number_format_i18n($i)."</a>";
                }
            }
            elseif($paged >= ($max_page - ceil(($range/2)))){
                for($i = $max_page - $range; $i <= $max_page; $i++){
                    echo "<a href='".get_pagenum_link($i) ."'";
                    if($i==$paged) echo " class='current'";
                    echo ">".number_format_i18n($i)."</a>";
                }
            }
            elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
                for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){
                    echo "<a href='".get_pagenum_link($i) ."'";
                    if($i==$paged) echo " class='current'";
                    echo ">".number_format_i18n($i)."</a>";
                }
            }
        }
        else{
            for($i = 1; $i <= $max_page; $i++){
                echo "<a href='".get_pagenum_link($i) ."'";
                if($i==$paged) echo " class='current'";
                echo ">".number_format_i18n($i)."</a>";
            }
        }
        next_posts_link(' &raquo; ');
        if($paged != $max_page){
            echo "<a class='last-page' href=".get_pagenum_link($max_page).">".__('Last','gridz')."</a>";
        }
        echo '</nav>'."\n";
    }
}

/**
 * Display navigation to next/previous post when applicable
 */
function gridz_post_nav(){
    global $gridz_options;
    // Don't print empty markup if there's nowhere to navigate.
    $previous =(is_attachment())? get_post(get_post()->post_parent): get_adjacent_post(false, '', true);
    $next = get_adjacent_post(false, '', false);
    if((!$next && !$previous) || !$gridz_options['show_post_nav']){
	return;
    }
    ?>
    <nav class="post-navigation">
	<?php
	if(is_attachment()):
	    previous_post_link('%link', __('Published In %title', 'gridz'));
    else :
	    previous_post_link('%link', __('<span class="genericon-previous"></span>', 'gridz'));
	    next_post_link('%link', __('<span class="genericon-next"></span>', 'gridz'));
	endif;
	?>
    </nav>
    <?php
}

/**
 * Social Profile
 */
function gridz_social_links($type = "profile") {
    $social = array(
        "feed" => array("name" => "feed", "profile_url" => get_bloginfo('rss2_url'), "icon" => "feed"),        
    );
    $output = '';
    foreach($social as $entry) {
        $output .= '<a id="social-'.$type.'-'.$entry['name'].'" class="social-'.$type.'" href="'.esc_url($entry['profile_url']).'"><span class="genericon-'.$entry['icon'].'"></span></a>';
    }
    echo $output;
}

/**
 * Callback for Comments
 */
function gridz_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
    switch($comment->comment_type):
	case 'pingback':
	case 'trackback':
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
	<div class="comment-content">
	    <?php comment_author_link(); ?>
	</div>
    <?php
    break;
    default:
    ?>
    <li <?php comment_class(); ?>>
        <div id="comment-<?php comment_ID(); ?>">
	    <?php echo get_avatar($comment, 48); ?>
	    <div class="comments-body">
		<div class="comments-meta">
		    <span class="comments-author"><?php comment_author_link(); ?></span> <?php printf(__('commented on %s','gridz'),get_comment_date()); ?>
		    <?php comment_reply_link(array_merge($args, array('before' => '', 'reply_text' => __('Reply', 'gridz'), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
		</div>
		<?php if($comment->comment_approved == '0'): ?>
		    <p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation', 'gridz'); ?></p>
		<?php endif; ?>
		<div class="comment-content">
		    <?php comment_text(); ?>
		</div>
	    </div>	    
	</div>
    <?php
    break;
    endswitch;
}

/**
 * Print the attached image with a link to the next attached image
 */
function gridz_the_attached_image() {
	$post = get_post();
	$attachment_size = apply_filters('gridz_attachment_size', array(810, 810));
	$next_attachment_url = wp_get_attachment_url();
	$attachment_ids = get_posts(array(
	    'post_parent'    => $post->post_parent,
	    'fields'         => 'ids',
	    'numberposts'    => -1,
	    'post_status'    => 'inherit',
	    'post_type'      => 'attachment',
	    'post_mime_type' => 'image',
	    'order'          => 'ASC',
	    'orderby'        => 'menu_order ID',
	));
	if(count($attachment_ids) > 1) {
	    foreach($attachment_ids as $attachment_id) {
		if($attachment_id == $post->ID) {
		    $next_id = current($attachment_ids);
		    break;
		}
	    }
	    if($next_id) {
		$next_attachment_url = get_attachment_link($next_id);
	    } else {
		$next_attachment_url = get_attachment_link(array_shift($attachment_ids));
	    }
	}
	$exp = "/^https?:\/\/(.)*\.(jpg|png|gif|ico)$/i";
	if(!preg_match($exp,$next_attachment_url)) $rel = "attachment"; else $rel = "prettyPhoto";
	printf('<a href="%1$s" rel="%2$s">%3$s</a>', esc_url($next_attachment_url), $rel, wp_get_attachment_image($post->ID, $attachment_size));
}

/**
 * Get first image for Image post type
 */
function gridz_first_image($link = true, $class = 'entry-featured') {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches[1][0];

  if(empty($first_img)) {
    $first_img = "";
  } else {
    if($link) $first_img = '<div class="'.$class.'"><a href="'.get_permalink().'"><img src="'.$first_img.'"/></a></div>';
    else $first_img = '<div class="'.$class.'"><img src="'.$first_img.'"/></div>';
  }
  return $first_img;
}

/**
 * Extract Quotes
 */
function gridz_post_quote() {
    global $post;
    $quote_list = "";
    $quote_arr = array();
    if(preg_match_all("/<blockquote>(.*?)<\/blockquote>/s",$post->post_content, $matches)) {
        $quote_arr = $matches[0];
        foreach($quote_arr as $entry) {
            $quote_list .= $entry;
        }
    }
    return $quote_list;
}

/**
 * Extract audio from Content
 */
function gridz_post_audio() {
    global $post;
    $audio_list = "";
    $audio_arr = array();    
    if(preg_match_all('/href=\"(.*?)\.mp3\"/i',$post->post_content, $matches)) {
	$audio_arr = $matches[1];
        $audio_list .= '<audio class="post-audio" loop="loop" controls="controls">';
        foreach($audio_arr as $entry) {
	    $audio_list .= '<source src="'.$entry.'.mp3"/>';	    
        }
        $audio_list .= '</audio>';
    }
    $ie_audio_list = '';
    if(preg_match_all('/href=\"(.*?)\.mp3\">(.*?)<\/a>/i',$post->post_content, $matches)) {
	$audio_arr = $matches[0];	
	foreach($audio_arr as $entry) {
	    $ie_audio_list .= '<p><a class="ie-audio-link"'.$entry.'</p>';
	}
    }
    if($audio_list != "" || $ie_audio_list != "")
	return '<div class="entry-featured">'.$audio_list.$ie_audio_list.'</div>';
}

/**
 * Extract embed video from Post meta
 */
function gridz_post_video() {
    global $post;
    $meta = get_post_meta($post->ID);
    foreach($meta as $val) {
        foreach($val as $entry) {
            if(preg_match('/<embed/', $entry) or preg_match('/<iframe/', $entry)) {
                return '<div class="entry-featured">'.$entry.'</div>';
            }
        }
    }
}

/**
 * Display flexslider Gallery
 */
function gridz_post_gallery($size = "full") {
    if(get_post_gallery()) {
        $gallery = get_post_gallery(get_the_ID(), false);
        $attachments = explode(",",$gallery['ids']);
	$output = "";
        foreach($attachments as $entry) {
            $img_src = wp_get_attachment_image_src($entry, $size);
            $output .= '<li><a href="'.get_attachment_link($entry).'"><img src="'.$img_src[0].'"/></a></li>';
        }
        if(trim($output) != "") $output = '<div class="entry-featured"><div class="flex-container"><div class="flexslider" id="gallery-'.get_the_ID().'"><ul class="slides">'.$output. '</ul></div></div></div>';
	return $output;
    }
}

/**
 * Function to trim words
 */
function gridz_trim_text($input, $length = 40, $ellipses = true, $strip_html = true) {
    if($strip_html) {
	$input = strip_tags($input);
    }
    if(strlen($input) <= $length) {
	return $input;
    }
    $last_space = strrpos(substr($input, 0, $length), ' ');
    $trimmed_text = substr($input, 0, $last_space);
    if($ellipses) {
	$trimmed_text .= '...';
    }
    return $trimmed_text;
}
?>