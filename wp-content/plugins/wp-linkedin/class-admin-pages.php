<?php
include 'class-admin-sections.php';


class WPLinkedInAdmin {

	function __construct($plugin) {
		$this->plugin = $plugin;

		add_action('admin_notices', array(&$this, 'admin_notices'));
		add_action('admin_enqueue_scripts', array(&$this, 'enqueue_scripts'));
		add_filter('plugin_action_links_' . WP_LINKEDIN_PLUGIN_BASENAME, array(&$this, 'add_settings_link'));
		add_filter('admin_menu', array(&$this, 'init_menu'));
		add_filter('admin_action_clear_cache', array(&$this, 'clear_cache'));
	}

	function init_menu() {
		$this->option_page_hook = add_submenu_page('options-general.php', __('LinkedIn Options', 'wp-linkedin'),
				__('LinkedIn', 'wp-linkedin'), 'manage_options', 'wp-linkedin', array(&$this, 'options_page'));
		$this->sections[] = new WPLinkedInOptionsSection('wp-linkedin');

		if (!is_multisite()) {
			if (WP_LINKEDIN_APPKEY_IS_OPTION) {
				$this->sections[] = new WPLinkedInAPISection('wp-linkedin');
			}
			$this->sections[] = new WPLinkedInExtensionsSection('wp-linkedin');
		}

		$this->sections[] = new WPLinkedInToolsSection('wp-linkedin');
		if (LI_DEBUG) $this->sections[] = new WPLinkedInDebugSection('wp-linkedin');
	}

	function enqueue_scripts($hook) {
		if (isset($this->option_page_hook) && $hook == $this->option_page_hook) {
			wp_enqueue_style('wp-linkedin-admin', plugins_url('theme/style.css', __FILE__), false, '1.0');
		}
	}

	function add_settings_link($links) {
		$url = admin_url('options-general.php?page=wp-linkedin');
		$links['settings'] = '<a href="' . $url . '">' . __('Settings') . '</a>';
		return $links;
	}

	function clear_cache() {
		$linkedin = wp_linkedin_connection();
		$linkedin->clear_cache();
		$redirect = (isset($_REQUEST['r'])) ? $_REQUEST['r'] : add_query_arg('page', 'wp-linkedin', admin_url('options-general.php'));
		$redirect = add_query_arg('cache_cleared', 1, $redirect);
		wp_safe_redirect($redirect);
		exit;
	}

	function admin_notices() {
		if (!WP_LINKEDIN_APPKEY && (current_user_can('manage_options')) && !is_multisite()) {
			$format = __('Your must create an application key/secret to access the LinkedIn API. Please follow the instructions <a href="%s">on the settings page</a>.', 'wp-linkedin');
			$notice = sprintf($format, admin_url('options-general.php?page=wp-linkedin#apikeys')); ?>
			<div class="error"><p><?php echo $notice; ?></p></div><?php
			return;
		}

		$linkedin = wp_linkedin_connection();
		if (!$linkedin->is_access_token_valid()) {
			$format = __('Your LinkedIn access token is invalid or has expired, please <a href="%s">click here</a> to get a new one.', 'wp-linkedin');
			$notice = sprintf($format, $linkedin->get_authorization_url()); ?>
			<div class="error"><p><?php echo $notice; ?></p></div><?php
		}

		if (LI_DEBUG && $linkedin->get_last_error()) { ?>
			<div class="error">
		        <p><?php _e('An error has occured while retrieving the profile:', 'wp-linkedin'); ?> <?php echo $linkedin->get_last_error(); ?></p>
			</div><?php
		}

		if (isset($_GET['oauth_status'])) {
			switch ($_GET['oauth_status']) {
				case 'success':
					$message = isset($_GET['oauth_message']) ? $_GET['oauth_message'] : __('The access token has been successfully updated.', 'wp-linkedin'); ?>
					<div class="updated"><p><?php echo $message; ?></p></div><?php
					break;

				case 'error':
					$message = isset($_GET['oauth_message']) ? $_GET['oauth_message'] : false; ?>
					<div class="error">
					<p><?php _e('An error has occured while updating the access token, please try again.', 'wp-linkedin'); ?>
					<?php echo ($message) ? '<br/>' . __('Error message: ', 'wp-linkedin') . $message : ''; ?></p>
					</div><?php
					break;
			}
		}

		if (isset($_GET['cache_cleared'])) { ?>
			<div class="updated"><p><?php _e('The cache has been cleared.', 'wp-linkedin'); ?></p></div><?php
		}
	}

	function options_page() {
		$page_slug = 'wp-linkedin';
		$post_target = admin_url('options.php');
		include 'page-options.php';
	}
}

class WPLinkedInNetworkAdmin {

	function __construct($plugin) {
		$this->plugin = $plugin;

		add_action('network_admin_notices', array(&$this, 'admin_notices'));
		add_action('admin_enqueue_scripts', array(&$this, 'enqueue_scripts'));
		add_action('network_admin_edit_li_update_options',  array(&$this, 'update_options'));
		add_filter('network_admin_plugin_action_links_' . WP_LINKEDIN_PLUGIN_BASENAME, array(&$this, 'add_settings_link'));
		add_filter('network_admin_menu', array(&$this, 'init_menu'));
	}

	function init_menu() {
		$this->option_page_hook = add_submenu_page('settings.php', __('LinkedIn Options', 'wp-linkedin'),
				__('LinkedIn', 'wp-linkedin'), 'manage_network_options', 'wp-linkedin-network', array(&$this, 'options_page'));

		if (WP_LINKEDIN_APPKEY_IS_OPTION) {
			$this->sections[] = new WPLinkedInAPISection('wp-linkedin-network');
		}

		$this->sections[] = new WPLinkedInExtensionsSection('wp-linkedin-network');
	}

	function enqueue_scripts($hook) {
		if (isset($this->option_page_hook) && $hook == $this->option_page_hook) {
			wp_enqueue_style('wp-linkedin-admin', plugins_url('theme/style.css', __FILE__), false, '1.0');
		}
	}

	function add_settings_link($links) {
		$url = network_admin_url('settings.php?page=wp-linkedin-network');
		$links['settings'] = '<a href="' . $url . '">' . __('Settings') . '</a>';
		return $links;
	}

	function admin_notices() {
		if (!WP_LINKEDIN_APPKEY && (current_user_can('manage_network_options'))) {
			$format = __('Your must create an application key/secret to access the LinkedIn API. Please follow the instructions <a href="%s">on the settings page</a>.', 'wp-linkedin');
			$notice = sprintf($format, network_admin_url('settings.php?page=wp-linkedin-network#apikeys')); ?>
			<div class="error"><p><?php echo $notice; ?></p></div><?php
			return;
		}
	}

	function options_page() {
		$page_slug = 'wp-linkedin-network';
		$post_target = add_query_arg('action', 'li_update_options', network_admin_url('edit.php'));

		if (isset($_GET['updated'])) {
			echo '<div id="message" class="updated notice is-dismissible"><p>' . __('Options saved.') . '</p></div>';
		}

		include 'page-options.php';
	}

	function update_options() {
		check_admin_referer('wp-linkedin-network-options');
		global $new_whitelist_options;
		$options = $new_whitelist_options['wp-linkedin-network'];

		foreach ($options as $option) {
			$option_value = (isset($_POST[$option])) ? $_POST[$option] : false;
			$option_value = apply_filters('sanitize_option_' . $option_name, $option_value);
			update_site_option($option, $option_value);
		}

		wp_safe_redirect(add_query_arg(array('page' => 'wp-linkedin-network',
				'updated' => 'true'), network_admin_url('settings.php')));
		exit;
	}
}