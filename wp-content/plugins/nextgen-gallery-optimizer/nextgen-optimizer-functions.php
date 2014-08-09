<?php

/**********************************************************************
* remove nextgen gallery scripts [works on nextgen 1.6.2 and above]
**********************************************************************/

function nggo_remove_nextgen_js() {
	if (!is_admin()) {
		if (!defined('NGG_SKIP_LOAD_SCRIPTS')) {
			define('NGG_SKIP_LOAD_SCRIPTS', true);
		}
	}
}
add_action('init', 'nggo_remove_nextgen_js');



/**********************************************************************
* remove nextgen gallery styles
**********************************************************************/

function nggo_remove_nextgen_css() {
	if (!is_admin()) {
		wp_deregister_style('NextGEN');
		wp_deregister_style('shutter');
		wp_deregister_style('thickbox');
	}
}
add_action('wp_print_styles', 'nggo_remove_nextgen_css', 100);



/**********************************************************************
* check if post contains the [nggallery id=x] shortcode
* if so, load the appropriate scripts and styles
**********************************************************************/

function nggo_check_nggallery_shortcode() {

    global $post;
    global $nggo_options;
	global $nggo_nextgen_options;

 	if (!is_admin()) {
		
		if (have_posts()) {
			while (have_posts()) { 
				the_post();

    			$pattern = get_shortcode_regex();

    			if (preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches )
    			&& array_key_exists( 2, $matches )
    			&& in_array( 'nggallery', $matches[2] ) ) {
    

					if (isset($nggo_options['fancybox']) && ($nggo_options['fancybox'] == true)) {
		
						// see scripts-and-styles.php for functions
						add_action('wp_enqueue_scripts', 'nggo_load_jquery', 1000);
						add_action('wp_enqueue_scripts', 'nggo_load_fancybox_scripts', 1000);
						add_action('wp_print_styles', 'nggo_load_fancybox_styles', 1000);
						add_action('wp_head','nggo_fancybox_inline_js', 1000);
	
					}
					
					if (isset($nggo_nextgen_options['thumbEffect']) && ($nggo_nextgen_options['thumbEffect'] == 'shutter')) {
					
						// see scripts-and-styles.php for functions
						add_action('wp_enqueue_scripts', 'nggo_load_shutter_scripts', 1000);
						add_action('wp_print_styles', 'nggo_load_shutter_styles', 1000);
						add_action('wp_head','nggo_shutter_inline_js', 1000);
						
					}

					if (isset($nggo_nextgen_options['thumbEffect']) && ($nggo_nextgen_options['thumbEffect'] == 'thickbox')) {
					
						if (isset($nggo_options['jquery']) && ($nggo_options['jquery'] == 'google')) {
							add_action('wp_head','nggo_jquery_no_conflict_inline_js', 1000);
						}
						
						// see scripts-and-styles.php for functions
						add_action('wp_enqueue_scripts', 'nggo_load_jquery', 1000);
						add_action('wp_enqueue_scripts', 'nggo_load_thickbox_scripts', 1000);
						add_action('wp_print_styles', 'nggo_load_thickbox_styles', 1000);
						
					}
	
					add_action('wp_print_styles', 'nggo_load_nextgen_styles', 1000); // see scripts-and-styles.php for function

				}
			}
		}
	}
}
add_action( 'wp', 'nggo_check_nggallery_shortcode' );



/**********************************************************************
* check for unsupported shortcodes and display a front-end notification if detected
* inform admins about the differences between the basic and premium versions
* provide links to the documentation and support forums for more in-depth details
* message only displays on posts and pages, and only to administrators.
**********************************************************************/

function nggo_check_unsupported_shortcodes() {

    global $post;
	global $nggo_unsupported_shortcodes;
	global $nggo_slideshow_message_text;
	global $nggo_slideshow_message_tip;

 	if (!is_admin()) {
 		if (is_single() || is_page()) {
 			if (current_user_can( 'activate_plugins' )) { // since WP 2.0

				if (have_posts()) {
					while (have_posts()) { 
						the_post();
		
						$pattern = get_shortcode_regex();
		
						if (preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches )
						&& array_key_exists( 2, $matches )) {
		
							if (in_array( 'slideshow', $matches[2])) {
								
								$nggo_unsupported_shortcodes[0] = '<span style="font-weight:bold;">&#91;slideshow&nbsp;id=x&#93;</span>';
								add_filter ('the_content', 'nggo_unsupported_shortcode_message');
							}
		
							if (in_array( 'album', $matches[2]) && !in_array( 'nggallery', $matches[2])) {
								
								$nggo_unsupported_shortcodes[1] = '<span style="font-weight:bold;">&#91;album&nbsp;id=x&#93;</span>';
								add_filter ('the_content', 'nggo_unsupported_shortcode_message');
							}
		
							if (in_array( 'thumb', $matches[2]) && !in_array( 'nggallery', $matches[2])) {
								
								$nggo_unsupported_shortcodes[2] = '<span style="font-weight:bold;">&#91;thumb&nbsp;id=x&#93;</span>';
								add_filter ('the_content', 'nggo_unsupported_shortcode_message');
							}
		
							if (in_array( 'singlepic', $matches[2]) && !in_array( 'nggallery', $matches[2])) {
								
								$nggo_unsupported_shortcodes[3] = '<span style="font-weight:bold;">&#91;singlepic&nbsp;id=x&#93;</span>';
								add_filter ('the_content', 'nggo_unsupported_shortcode_message');
							}
		
							if (in_array( 'imagebrowser', $matches[2]) && !in_array( 'nggallery', $matches[2])) {
								
								$nggo_unsupported_shortcodes[4] = '<span style="font-weight:bold;">&#91;imagebrowser&nbsp;id=x&#93;</span>';
								add_filter ('the_content', 'nggo_unsupported_shortcode_message');
							}
		
							if (in_array( 'nggtags', $matches[2]) && !in_array( 'nggallery', $matches[2])) {
								
								if(isset($matches[0])) {
									foreach($matches[0] as $match) {
								
										if (strpos($match,'nggtags album') !== false) {
									
											$nggo_unsupported_shortcodes[5] = '<span style="font-weight:bold;">&#91;nggtags&nbsp;album=mytag&#93;</span>';
											add_filter ('the_content', 'nggo_unsupported_shortcode_message');
										}
		
										if (strpos($match,'nggtags gallery') !== false) {
									
											$nggo_unsupported_shortcodes[6] = '<span style="font-weight:bold;">&#91;nggtags&nbsp;gallery=mytag&#93;</span>';
											add_filter ('the_content', 'nggo_unsupported_shortcode_message');
										}
		
									}
								}
							}
		
							if (in_array( 'random', $matches[2]) && !in_array( 'nggallery', $matches[2])) {
								
								$nggo_unsupported_shortcodes[7] = '<span style="font-weight:bold;">&#91;random&nbsp;max=x&#93;</span>';
								add_filter ('the_content', 'nggo_unsupported_shortcode_message');
							}
		
							if (in_array( 'recent', $matches[2]) && !in_array( 'nggallery', $matches[2])) {
								
								$nggo_unsupported_shortcodes[8] = '<span style="font-weight:bold;">&#91;recent&nbsp;max=x&#93;</span>';
								add_filter ('the_content', 'nggo_unsupported_shortcode_message');
							}
		
							if (in_array( 'tagcloud', $matches[2]) && !in_array( 'nggallery', $matches[2])) {
								
								$nggo_unsupported_shortcodes[9] = '<span style="font-weight:bold;">&#91;tagcloud&#93;</span>';
								add_filter ('the_content', 'nggo_unsupported_shortcode_message');
							}
		
							if (isset($_GET['show']) && $_GET['show'] == 'slide') {
		
								$nggo_unsupported_shortcodes[10] = 'the <span style="font-weight:bold;">&#91;Show&nbsp;as&nbsp;slideshow&#93;</span> link';
								$nggo_slideshow_message_text = "slideshows,";
								$nggo_slideshow_message_tip = "show";
								add_filter ('the_content', 'nggo_unsupported_shortcode_message');
							}
					
						}
					}
				}			
			}
		}
	}
}
add_action( 'wp', 'nggo_check_unsupported_shortcodes' );



function nggo_unsupported_shortcode_message($content) {

	global $nggo_unsupported_shortcodes;
	global $nggo_slideshow_message_text;
	global $nggo_slideshow_message_tip;

	$nggo_unsupported_shortcodes_list = implode($nggo_unsupported_shortcodes, ' and ');

	$nggo_unsupported_message = '<div style="font-family:HelveticaNeue-Light,Helvetica Neue Light,Helvetica Neue,sans-serif; letter-spacing:normal; color: #444; background: #F4F4F4 url(' . plugins_url( 'images/bg.gif' , __FILE__) . '); text-align:left; padding:15px 20px 20px; border:1px solid #ddd; margin: 20px 0;">';
	$nggo_unsupported_message.= '<div style="width:32px; height:32px; float:left; margin: 0 15px 0 0; background: url(' . plugins_url( 'images/plugins-icon.png' , __FILE__) . ') no-repeat; _background:none; _filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=' . plugins_url( 'images/plugins-icon.png' , __FILE__) . ', sizingMethod=\'crop\');" src="' . plugins_url( 'images/plugins-icon.png' , __FILE__) . '">&nbsp;</div><p style="font-size:18px; line-height:20px; padding:5px 0 20px; margin:0; clear:none;">NextGEN Gallery Optimizer Admin Notification</p>';
	
	// shortcode opening paragraph
	if ($nggo_slideshow_message_tip != 'show') {
	$nggo_unsupported_message.= '<p style="font-size:14px; line-height:18px; padding:0; margin:0;">This original, Basic version of the NextGEN Gallery Optimizer plugin currently only supports the popular <span style="font-weight:bold;">&#91;nggallery&nbsp;id=x&#93;</span> shortcode.</p>';
	}	

	// show as slideshow opening paragraph
	if ($nggo_slideshow_message_tip == 'show') {
	$nggo_unsupported_message.= '<p style="font-size:14px; line-height:18px; padding:0; margin:0;">This original, Basic version of the NextGEN Gallery Optimizer plugin does not currently support the <span style="font-weight:bold;">&#91;Show&nbsp;as&nbsp;slideshow&#93;</span> text link.</p>';
	}
	
	$nggo_unsupported_message.= '<p style="font-size:14px; line-height:18px; padding:0; margin:15px 0 0 0;">If you\'d like to use ' . $nggo_unsupported_shortcodes_list . ' with Optimizer, please consider upgrading to <b><a style="color:#333; font-weight:bold; text-decoration:underline;" href="http://www.markstechnologynews.com/nextgen-gallery-optimizer-premium/?ref=message">Optimizer Premium</a></b> - which adds support for ' . $nggo_slideshow_message_text . ' ALL TEN NextGEN shortcodes and much, much more.</p>';

	// show as slideshow deactivation tip
	if ($nggo_slideshow_message_tip == 'show') {
	$nggo_unsupported_message.= '<p style="font-size:12px; line-height:18px; padding:0; margin:15px 0 0 0;">Alternatively, if you\'d like to hide the &#91;Show&nbsp;as&nbsp;slideshow&#93; link from your galleries, simply navigate to Gallery --> Options --> Gallery and uncheck the "Integrate slideshow" option.</p>';
	}

	// links to documentation and support
	$nggo_unsupported_message.= '<p style="font-size:12px; line-height:18px; padding:0; margin:15px 0 0 0;"><a style="color:#333; text-decoration:underline;" href="http://wordpress.org/extend/plugins/nextgen-gallery-optimizer/">Documentation</a> | <a style="color:#333; text-decoration:underline;" href="http://wordpress.org/extend/plugins/nextgen-gallery-optimizer/installation/">Installation</a> | <a style="color:#333; text-decoration:underline;" href="http://wordpress.org/support/plugin/nextgen-gallery-optimizer">Support Forum</a> | <a style="color:#333; text-decoration:underline;" href="mailto:mark@markstechnologynews.com">Contact</a> | <a style="color:#333; text-decoration:underline;" href="http://www.markstechnologynews.com/nextgen-gallery-optimizer-premium/?ref=message">Get the Premium version</a></p>';
	$nggo_unsupported_message.= '</div>';
	
	$content = $nggo_unsupported_message . $content;
	
	return $content;

}