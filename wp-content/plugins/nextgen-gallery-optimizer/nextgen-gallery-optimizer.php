<?php
/*
Plugin Name: NextGEN Gallery Optimizer
Description: <strong><a href="http://www.markstechnologynews.com/nextgen-gallery-optimizer-premium/?ref=plugins">*** UPGRADE TO NEXTGEN GALLERY OPTIMIZER PREMIUM ***</a> to add support for ALL TEN NextGEN shortcodes and more!</strong>   NextGEN Gallery Optimizer improves your site's page load speed by ensuring NextGEN Gallery's scripts and styles ONLY load on posts with the [nggallery id=x] shortcode. It also includes and automatically integrates the fantastic Fancybox lightbox script, so now you can have gorgeous galleries AND a speedy site!
Author: Mark Jeldi
Version: 1.1.2

Author URI: http://www.markstechnologynews.com

Copyright 2012 Mark Jeldi | mark@markstechnologynews.com

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/


/**************************************************
* global variables and constants
**************************************************/

global $nggo_options;
global $nggo_nextgen_options;

$nggo_options = get_option('nextgen_optimizer_settings');
$nggo_nextgen_options = get_option('ngg_options');

define( 'NGGO_VERSION', '1.1.2' );
define( 'NGGO_FANCYBOX_VERSION', '1.3.4' );
define( 'NGGO_JQUERY_VERSION', '1.8.3' );



/**************************************************
* includes
**************************************************/

include('nextgen-optimizer-functions.php'); // plugin functionality
include('nextgen-optimizer-options.php'); // the plugin options page HTML, linked CSS and save functions
include('nextgen-optimizer-scripts-and-styles.php'); // script and stylesheet include functions



/**************************************************
* add options page
**************************************************/

// call our stylesheet
function nggo_load_styles() {
	wp_enqueue_style('nextgen_optimizer_styles', plugin_dir_url( __FILE__ ) . 'css/nextgen-optimizer-options.css');
}

// attach the above wp_enqueue_style so our stylesheet only loads on the options page we're building
function nggo_add_options_page() {
	$nggo_options_page = add_options_page('NextGEN Gallery Optimizer', 'NextGEN Optimizer', 'manage_options', 'nextgen_optimizer_options', 'nextgen_optimizer_options_page');
	add_action('admin_print_styles-' . $nggo_options_page, 'nggo_load_styles');
}

// create options page complete with attached css file and link in admin menu. 
add_action('admin_menu', 'nggo_add_options_page');



/**************************************************
* save settings
**************************************************/

// create our settings in the options table
function nggo_register_settings() {
	register_setting('nextgen_optimizer_settings_group', 'nextgen_optimizer_settings');
}
add_action('admin_init', 'nggo_register_settings');



/**************************************************
* add settings & donate links on plugins page
**************************************************/

function nggo_settings_link($links, $file) {
	if ($file == plugin_basename(__FILE__)) {
		$links[] = '<a href="'.admin_url('options-general.php?page=nextgen_optimizer_options').'">Settings</a>';
		$links[] = '<a href="http://wordpress.org/support/plugin/nextgen-gallery-optimizer">Support Forum</a>';
		$links[] = '<a href="http://wordpress.org/extend/plugins/nextgen-gallery-optimizer">Rate this plugin</a>';
	}
	return $links;
}
add_filter('plugin_row_meta', 'nggo_settings_link', 10, 2);



/**********************************************************************
* define default option settings on first activation
**********************************************************************/

function nggo_add_default_values() {
	
	global $nggo_options;
    	
    if (!is_array($nggo_options)) {  // set defaults for new users only
		
		$nggo_default_values = array(
				"theme" => "Default Styles",
				"css" => "",
				"fancybox" => "1",
				"do_redirect" => "yes",
				"show_message" => "yes"
				);
				
		update_option('nextgen_optimizer_settings', $nggo_default_values);
		
	}
}
register_activation_hook(__FILE__, 'nggo_add_default_values');



/********************************************************************************
* define extra default options after update from earlier versions
********************************************************************************/

function nggo_add_extra_default_options() {
	
	global $nggo_options;
	
	if (!isset($nggo_options['jquery'])) {
		$nggo_options['jquery'] = 'wordpress'; // insert field or update value in array
		update_option('nextgen_optimizer_settings', $nggo_options); // update option array
	}

	if (!isset($nggo_options['version'])) {
		$nggo_options['version'] = 'not_set'; // insert field or update value in array
		update_option('nextgen_optimizer_settings', $nggo_options); // update option array
	}

	if (!isset($nggo_options['original_nextgen_thumbEffect'])) {
		$nggo_options['original_nextgen_thumbEffect'] = 'none'; // insert field or update value in array
		update_option('nextgen_optimizer_settings', $nggo_options); // update option array
	}

	if (!isset($nggo_options['original_nextgen_thumbCode'])) {
		$nggo_options['original_nextgen_thumbCode'] = 'none'; // insert field or update value in array
		update_option('nextgen_optimizer_settings', $nggo_options); // update option array
	}

	if (!isset($nggo_options['auto_fancybox_install'])) {
		$nggo_options['auto_fancybox_install'] = 'uninstalled'; // insert field or update value in array
		update_option('nextgen_optimizer_settings', $nggo_options); // update option array
	}

}
add_action('admin_init', 'nggo_add_extra_default_options');



/**********************************************************************
* redirect users to settings page on first activation
**********************************************************************/

function nggo_redirect_to_settings() {

    global $nggo_options;
		
	if (isset($nggo_options['do_redirect']) && ($nggo_options['do_redirect'] == 'yes')) {
        	        	
        wp_redirect(admin_url('options-general.php?page=nextgen_optimizer_options', __FILE__));
			
		// we only want to redirect to the settings page on first activation
		// so we'll update the value of "do_redirect" to "done"

		$nggo_options['do_redirect'] = 'done'; // amend value in array
		update_option('nextgen_optimizer_settings', $nggo_options); // update option array

	}		
}
add_action('admin_init', 'nggo_redirect_to_settings');



/**********************************************************************
* display thank you message on first activation
**********************************************************************/

function nggo_thanks_for_downloading() {
	
	if (isset($_GET['page']) && $_GET['page'] == 'nextgen_optimizer_options') {
		
		global $nggo_options;

    	if (isset($nggo_options['show_message']) && ($nggo_options['show_message'] == 'yes')) {
        	        	
			echo '
			<div id="message" class="updated">
			<p>Thanks for downloading NextGEN Gallery Optimizer! Please review the steps below to complete the installation.</p>
			</div>
			';
			
			// we only want to show this message once on first activation
			// so we'll update the value of "show_message" to "done"

			$nggo_options['show_message'] = 'done'; // amend value in array
			update_option('nextgen_optimizer_settings', $nggo_options); // update option array
	
		}
	}		
}
add_action('admin_notices', 'nggo_thanks_for_downloading');



/********************************************************************************
* Fix for Fancybox on IE6 & IE8
* Microsoft.AlphaImageLoader CSS requires absolute file paths.
* We'll run a regex (on activation and update) to write in the correct urls.
********************************************************************************/

function nggo_fancybox_stylesheet_regex() {
	
	global $nggo_options;
	global $nggo_fancybox_css_path;
	
	if (is_admin()) {
	
		if (!isset($nggo_options['version']) ||
		isset($nggo_options['version']) && $nggo_options['version'] != NGGO_VERSION) {

			$nggo_fancybox_css_path = WP_PLUGIN_DIR."/nextgen-gallery-optimizer/css/jquery.fancybox-1.3.4.css";
			$nggo_fancybox_img_path = plugins_url( 'fancybox/' , __FILE__);
			$nggo_data = file_get_contents($nggo_fancybox_css_path);

			// the regex
			$nggo_patterns = array();
			$nggo_patterns[0] = '/\(src=\'(.*?)fancybox\//';
			$nggo_patterns[1] = '/url\(\'(.*?)fancybox\//';
			$nggo_replacements = array();
			$nggo_replacements[0] = '(src=\'' . $nggo_fancybox_img_path; 
			$nggo_replacements[1] = 'url(\'' . $nggo_fancybox_img_path;
			$nggo_update_css = preg_replace($nggo_patterns, $nggo_replacements, $nggo_data);

			// update css
			if (is_writable($nggo_fancybox_css_path)) {

				if (!$handle = fopen($nggo_fancybox_css_path, 'w+')) {
				add_action( 'admin_notices', 'nggo_file_not_writable_error' );
				exit;
    			}

    			if (fwrite($handle, $nggo_update_css) === FALSE) {
    			add_action( 'admin_notices', 'nggo_file_not_writable_error' );
				exit;
				}

			// we only want to run this regex on first activation or after auto-update
			// so we'll insert a "version" option to check against
			
			$nggo_options['version'] = NGGO_VERSION; // insert field or update value in array
			update_option('nextgen_optimizer_settings', $nggo_options); // update option array

			fclose($handle);


			} else {
	
				add_action( 'admin_notices', 'nggo_file_not_writable_error' );
			
			}
		}
	}
}
add_action('admin_init', 'nggo_fancybox_stylesheet_regex');


function nggo_file_not_writable_error() {
	
	global $pagenow;
	global $nggo_fancybox_css_path;
	
	// admin error message	
	
	if ($pagenow == 'plugins.php' || isset($_GET['page']) && $_GET['page'] == 'nextgen_optimizer_options') {
		
		$nggo_css_not_writable_message = '<div class="error"><p>';
		$nggo_css_not_writable_message.= '<b>NextGEN Gallery Optimizer Error Notification:</b><br />';
		$nggo_css_not_writable_message.= 'Optimizer automatically customizes Fancybox\'s css to ensure the lightbox displays correctly across all browsers. However...<br /><br />';
		$nggo_css_not_writable_message.= '<b>The stylesheet is not writable!</b><br />';
		$nggo_css_not_writable_message.= 'Please change permissions to <b>766</b> on the following file:&nbsp;&nbsp;<b>' . $nggo_fancybox_css_path . '</b><br /><br />';
		$nggo_css_not_writable_message.= 'There are several ways to do this...<br />';
		$nggo_css_not_writable_message.= '1. Right-click the file in your FTP client and select "Properties" or "Get Info".<br />';
		$nggo_css_not_writable_message.= '2. If using shared-hosting, select the file in your web-based file manager and look for a "Change Permissions" link.<br />';
		$nggo_css_not_writable_message.= '3. If you have SSH access, simply enter <b><i>sudo chmod 766 ' . $nggo_fancybox_css_path . ' </i></b>in your terminal.<br />';
		$nggo_css_not_writable_message.= '4. If you uploaded Optimizer via FTP, it may help to delete & reinstall the plugin through your WordPress admin at ';
		$nggo_css_not_writable_message.= '<a href="' . get_admin_url('', 'plugin-install.php?tab=upload') . '">Plugins --> Add New --> Upload</a>.';
		$nggo_css_not_writable_message.= '</p></div>';
		
		echo $nggo_css_not_writable_message;
		
	}

}



/********************************************************************************
* automatic fancybox installation
* saves original values on Gallery --> Options --> Effects page
* updates ngg_options with **class="myfancybox" rel="%GALLERY_NAME%"**
* reverts to previous values on deactivation
********************************************************************************/

function nggo_fancybox_auto_install() {
	
	global $nggo_options;
	global $nggo_nextgen_options;
	
	if (is_admin()) {

		if (is_array($nggo_nextgen_options)) {

			// capture nextgen's original effects values
			// save the thumbEffect and thumbCode settings for later restoration

			if (isset($nggo_options['fancybox']) && ($nggo_options['fancybox'] == true)) {	
				if (!isset($nggo_options['original_nextgen_thumbEffect']) || ($nggo_options['original_nextgen_thumbEffect'] == 'none')) {
						
					$nggo_options['original_nextgen_thumbEffect'] = $nggo_nextgen_options['thumbEffect'];
					$nggo_options['original_nextgen_thumbCode'] = $nggo_nextgen_options['thumbCode'];
					update_option('nextgen_optimizer_settings', $nggo_options);
				
				}
			}


			// if the fancybox option is selected
			// install and update nextgen's effects settings
				
			if (isset($nggo_options['fancybox']) && ($nggo_options['fancybox'] == true)) {
				if (!isset($nggo_options['auto_fancybox_install']) || ($nggo_options['auto_fancybox_install'] != 'installed')) {
					
					// update nextgen for fancybox integration
					$nggo_nextgen_options['thumbEffect'] = 'custom';
					$nggo_nextgen_options['thumbCode'] = 'class=\"myfancybox\" rel=\"%GALLERY_NAME%\"';
					update_option('ngg_options', $nggo_nextgen_options);
				
					// set an option so we only run the install once
					$nggo_options['auto_fancybox_install'] = 'installed';
					update_option('nextgen_optimizer_settings', $nggo_options);
				
				}
			}


			// if the fancybox option is deselected, uninstall and return nextgen effects to previous values
			// only runs if fancybox's thumbcode is set in nextgen, and previous values are present in optimizer

			if (!isset($nggo_options['fancybox']) || ($nggo_options['fancybox'] == "")) {

				// prevents overwriting manually edited nextgen effects on upgrade		
				if (($nggo_nextgen_options['thumbEffect'] == 'custom') &&
				($nggo_nextgen_options['thumbCode'] == 'class=\"myfancybox\" rel=\"%GALLERY_NAME%\"')) {	
			
					if (isset($nggo_options['original_nextgen_thumbEffect']) &&
					($nggo_options['original_nextgen_thumbEffect'] != 'none') &&
					isset($nggo_options['original_nextgen_thumbCode']) &&
					($nggo_options['original_nextgen_thumbCode'] != 'none')) {

						// switch nextgen back to original values when fancybox is deselected
						$nggo_nextgen_options['thumbEffect'] = $nggo_options['original_nextgen_thumbEffect'];
						$nggo_nextgen_options['thumbCode'] = $nggo_options['original_nextgen_thumbCode'];
						update_option('ngg_options', $nggo_nextgen_options);
	
						// empty our settings so we can run again if fancybox is enabled
						$nggo_options['original_nextgen_thumbEffect'] = 'none';
						$nggo_options['original_nextgen_thumbCode'] = 'none';
						$nggo_options['auto_fancybox_install'] = 'uninstalled';
						update_option('nextgen_optimizer_settings', $nggo_options);
				
					}
				}
			}


			// if nextgen's effects settings are accidentally changed while optimizer is activated and fancybox checked
			// update fancybox integration and show notification message
				
			if (isset($nggo_options['fancybox']) && ($nggo_options['fancybox'] == true)) {	
				
				if (($nggo_nextgen_options['thumbEffect'] != 'custom') ||
				($nggo_nextgen_options['thumbCode'] != 'class=\"myfancybox\" rel=\"%GALLERY_NAME%\"')) {	
	
					$nggo_nextgen_options['thumbEffect'] = 'custom'; // insert field or update value in array
					$nggo_nextgen_options['thumbCode'] = 'class=\"myfancybox\" rel=\"%GALLERY_NAME%\"';
					update_option('ngg_options', $nggo_nextgen_options);
				
					add_action('admin_notices', 'nggo_please_uncheck_fancybox');
					
				}
			}

		}
		
		// check if nextgen has been deleted
		// empty our settings so we can run again if nextgen is re-installed

		if (!is_array($nggo_nextgen_options) &&
		isset($nggo_options['auto_fancybox_install']) &&
		$nggo_options['auto_fancybox_install'] == 'installed') {
				
			$nggo_options['original_nextgen_thumbEffect'] = 'none';
			$nggo_options['original_nextgen_thumbCode'] = 'none';
			$nggo_options['auto_fancybox_install'] = 'uninstalled';
			update_option('nextgen_optimizer_settings', $nggo_options);

		}
		
	}
}
add_action('admin_init', 'nggo_fancybox_auto_install');


function nggo_please_uncheck_fancybox() {
    	
	echo '
	<div id="message" class="updated">
	<p>
	To use a different gallery effect, please deactivate Fancybox on the 
	<a href="' . admin_url('options-general.php?page=nextgen_optimizer_options', __FILE__) . '" target="_blank">
	NextGEN Optimizer settings page</a> and return to 
	<a href="' . admin_url( 'admin.php?page=nggallery-options#effects' , __FILE__) . '" target="_blank">
	Gallery --> Options --> Effects</a> to make your changes.
	</p>
	</div>
	';
	
}


function nggo_fancybox_auto_uninstall() {
	
	global $nggo_options;
	global $nggo_nextgen_options;
	
	if (is_admin()) {

		if (is_array($nggo_nextgen_options)) {
	
			if (isset($nggo_options['fancybox']) && ($nggo_options['fancybox'] == true)) {
			
				if (isset($nggo_options['original_nextgen_thumbEffect']) && isset($nggo_options['original_nextgen_thumbCode'])) {
	
					// switch nextgen back to original values on deactivation
					$nggo_nextgen_options['thumbEffect'] = $nggo_options['original_nextgen_thumbEffect'];
					$nggo_nextgen_options['thumbCode'] = $nggo_options['original_nextgen_thumbCode'];
					update_option('ngg_options', $nggo_nextgen_options);
							
				}
			}
		
			// empty our settings so we can run again on reactivation
			$nggo_options['original_nextgen_thumbEffect'] = 'none';
			$nggo_options['original_nextgen_thumbCode'] = 'none';
			$nggo_options['auto_fancybox_install'] = 'uninstalled';
			update_option('nextgen_optimizer_settings', $nggo_options); // update option array

		}
	}
}
register_deactivation_hook(__FILE__, 'nggo_fancybox_auto_uninstall');



/********************************************************************************
* Check to make sure jQuery isn't deregistered.
* We'll run a regex on the functions.php files for "wp_deregister_script('jquery');"
* If detected (and not re-registered with a CDN version), we'll alert the user via an admin message.
********************************************************************************/

function nggo_check_for_deregister_jquery_regex() {

	global $nggo_child_functions_path;
	global $nggo_parent_functions_path;
	global $pagenow;
	
	if ($pagenow == 'plugins.php' || isset($_GET['page']) && $_GET['page'] == 'nextgen_optimizer_options') {
	
		$nggo_child_functions_path = get_stylesheet_directory() . '/functions.php'; // looks for a child theme first, and if not in use, returns path to parent theme.		
		$nggo_parent_functions_path = get_template_directory() . '/functions.php'; // gets file path to parent theme
		
		$nggo_functions_pattern = '/wp\_(deregister|register|enqueue)\_script\s*\(\s*(\'|"|\s*)jquery(\'|"|\s*)/';

		
		// check the child theme's functions.php (if in use and if file exists)
		// if no child theme is in use, checks the parent theme's functions.php instead
		
		if (file_exists($nggo_child_functions_path)) {
			$nggo_functions_file = file_get_contents($nggo_child_functions_path);
		
			if (preg_match_all($nggo_functions_pattern, $nggo_functions_file, $nggo_functions_matches)
			&& array_key_exists(1, $nggo_functions_matches)
			&& !in_array('register', $nggo_functions_matches[1])
			&& !in_array('enqueue', $nggo_functions_matches[1])) {
				
				add_action( 'admin_notices', 'nggo_check_for_deregister_jquery_child_message' );
	
			}
		}
		
		// check the parent theme's functions.php
		// only runs if get_stylesheet_directory() did not return the parent theme's path above
		
		if (file_exists($nggo_parent_functions_path) && ($nggo_parent_functions_path != $nggo_child_functions_path)) {
			$nggo_functions_file = file_get_contents($nggo_parent_functions_path);
							
			if (preg_match_all($nggo_functions_pattern, $nggo_functions_file, $nggo_functions_matches)
			&& array_key_exists(1, $nggo_functions_matches)
			&& !in_array('register', $nggo_functions_matches[1])
			&& !in_array('enqueue', $nggo_functions_matches[1])) {
				
				add_action( 'admin_notices', 'nggo_check_for_deregister_jquery_parent_message' );
	
			}
		}
	}
}
add_action('admin_init', 'nggo_check_for_deregister_jquery_regex');


function nggo_check_for_deregister_jquery_child_message() {
	
	global $nggo_child_functions_path;
	global $pagenow;
	
	if ($pagenow == 'plugins.php' || isset($_GET['page']) && $_GET['page'] == 'nextgen_optimizer_options') {
		
		echo '<div class="error"><p>NextGEN Gallery Optimizer:<br />Your theme appears to be deregistering jQuery, which may prevent the Fancybox lightbox from functioning.<br />To resolve this issue, please remove <b>wp_deregister_script(\'jquery\');</b> from <i>' . $nggo_child_functions_path . '</i>.</p></div>';

	}
}


function nggo_check_for_deregister_jquery_parent_message() {
	
	global $nggo_parent_functions_path;
	global $pagenow;
	
	if ($pagenow == 'plugins.php' || isset($_GET['page']) && $_GET['page'] == 'nextgen_optimizer_options') {
		
		echo '<div class="error"><p>NextGEN Gallery Optimizer:<br />Your theme appears to be deregistering jQuery, which may prevent the Fancybox lightbox from functioning.<br />To resolve this issue, please remove <b>wp_deregister_script(\'jquery\');</b> from <i>' . $nggo_parent_functions_path . '</i>.</p></div>';

	}
}



/********************************************************************************
* Check to make sure NextGEN Gallery is installed and activated.
* If not, show an admin notification to assist with the installation/activation process.
********************************************************************************/

function nggo_nextgen_installed_and_activated_check() {

	global $pagenow;

	if ($pagenow == 'plugins.php' || isset($_GET['page']) && $_GET['page'] == 'nextgen_optimizer_options') {
        
		// check if nextgen gallery is installed
		
		if (!get_plugins('/nextgen-gallery')) {

			$nggo_nextgen_check = '<div class="error"><p>';
			$nggo_nextgen_check.= '<b>NextGEN Gallery Optimizer Error Notification:</b><br />';
			$nggo_nextgen_check.= 'Optimizer is an add-on for the NextGEN Gallery WordPress plugin, but it appears...<b>NextGEN Gallery is not <i>installed</i>.</b><br />';
			$nggo_nextgen_check.= 'Please <a href="' . get_admin_url('', 'plugin-install.php?tab=search&s=NextGEN+Gallery') . '">download it here automatically</a> ';
			$nggo_nextgen_check.= 'or <a href="http://wordpress.org/extend/plugins/nextgen-gallery">manually from the WordPress repository</a>.';
			$nggo_nextgen_check.= '</p></div>';
			
			echo $nggo_nextgen_check;

		}

		// check if nextgen gallery is installed and activated
		
		if (get_plugins('/nextgen-gallery') && !is_plugin_active('nextgen-gallery/nggallery.php')) { // since WP 2.5

			$nggo_nextgen_check = '<div class="error"><p>';
			$nggo_nextgen_check.= '<b>NextGEN Gallery Optimizer Error Notification:</b><br />';
			$nggo_nextgen_check.= 'Optimizer is an add-on for the NextGEN Gallery WordPress plugin, but it appears...<b>NextGEN Gallery is not <i>activated</i>.</b><br />';
			$nggo_nextgen_check.= 'Please click the "Activate" link under the "NextGEN Gallery" item on <a href="' . get_admin_url('', 'plugins.php') . '">your plugins page</a>.';
			$nggo_nextgen_check.= '</p></div>';
			
			echo $nggo_nextgen_check;

		}

	}		
}
add_action('admin_notices', 'nggo_nextgen_installed_and_activated_check');