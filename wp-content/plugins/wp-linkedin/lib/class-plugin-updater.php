<?php

if (!class_exists('EDD_SL_Plugin_Updater')) {
	include('EDD_SL_Plugin_Updater.php');
}

class VDVNPluginUpdater {

	function __construct($plugin_file, $plugin_name, $plugin_version, $download_id) {
		$this->plugin_basename = plugin_basename($plugin_file);
		$this->plugin_slug = dirname($this->plugin_basename);
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;
		$this->license_key = trim((is_multisite()) ? get_site_option($this->plugin_slug . '_license_key') :
								get_option($this->plugin_slug . '_license_key'));
		$this->download_id = $download_id;
		$this->store_url = 'https://vedovini.net';
		$this->plugin_author = 'Claude Vedovini';

		$this->edd_updater = new EDD_SL_Plugin_Updater($this->store_url,
				$this->plugin_basename, array(
						'version' 	=> $this->plugin_version,	// current version number
						'license' 	=> $this->license_key, 		// license key (used get_option above to retrieve from DB)
						'item_name' => $this->plugin_name, 	   	// name of this plugin
						'item_id'   => $this->download_id,		// id of this plugin
						'author' 	=> $this->plugin_author,	// author of this plugin
						'url'       => home_url()
				));

		if (is_multisite()) {
			add_action('network_admin_menu', array(&$this, 'extensions_options'));
			add_action('network_admin_notices', array(&$this, 'admin_notices'));
			add_filter('network_admin_plugin_action_links_' . $this->plugin_basename, array(&$this, 'add_network_settings_link'));
		} else {
			add_action('admin_menu', array(&$this, 'extensions_options'));
			add_action('admin_notices', array(&$this, 'admin_notices'));
		}

		add_filter('plugin_row_meta', array(&$this, 'plugin_row_meta'), 10, 2 );
	}

	function admin_notices() {
		$capability = (is_multisite()) ? 'manage_network_options' : 'manage_options';

		if (current_user_can($capability)) {
			if (empty($this->license_key)) {
				$option_page = (is_multisite()) ? network_admin_url('settings.php?page=wp-linkedin-network#extensions') :
									admin_url('options-general.php?page=wp-linkedin#extensions');
				$error = __('You must provide a valid license key.', 'wp-linkedin');
				$format = __('Please <a href="%s">go to the settings page</a> and enter your key.', 'wp-linkedin');
				$error .= ' ' . sprintf($format, $option_page);
			} else {
				$status = $this->get_license_status();
				if (!is_wp_error($status)) {
					switch ($status->license) {
						case 'invalid':
						case 'expired':
						case 'item_name_mismatch':
							$error = $this->get_status_display($status);
					}
				}
			}

			if (isset($error)) { ?>
				<div class="error"><p><?php _e($this->plugin_name, 'wp-linkedin'); ?>: <?php echo $error; ?></p></div><?php
			}
		}
	}

	function add_network_settings_link($links) {
		$url = network_admin_url('settings.php?page=wp-linkedin-network#extensions');
		$links['settings'] = '<a href="' . $url . '">' . __('Settings') . '</a>';
		return $links;
	}

	function plugin_row_meta($links, $file) {
		if ($file == $this->plugin_basename) {
			$status = $this->get_license_status();

			if ($status->license == 'expired') {
				$links[] = sprintf(__('<a href="%s">Renew your license</a>.', 'wp-linked-in'), $this->renew_url());
			}
		}

		return $links;
	}

	function extensions_options() {
		$options_group = (is_multisite()) ? 'wp-linkedin-network' : 'wp-linkedin';
		register_setting($options_group, $this->plugin_slug . '_license_key', array(&$this, 'sanitize_license'));
		$option_name = ucwords(str_replace('WP LinkedIn ', '', __($this->plugin_name, 'wp-linkedin')));
		add_settings_field($this->plugin_slug . '_license_key', $option_name,
				array(&$this, 'license_key_field'), $options_group, 'extensions');
	}

	function license_key_field() {
		$field_name = $this->plugin_slug . '_license_key';
		$status = ($this->license_key) ? $this->get_license_status() : false; ?>
		<p>
			<input id="<?php echo $field_name; ?>" name="<?php echo $field_name; ?>"
				type="text" class="regular-text" value="<?php esc_attr_e($this->license_key); ?>" />
		</p><?php
		if (empty($this->license_key)) {
			echo '<p class="error"><em>' . __('You must provide a valid license key.', 'wp-linkedin') . '</em></p>';
		} else {
			echo '<p><em>' . $this->get_status_display($status) . '</em></p>';
		}
	}

	function renew_url() {
		return $this->store_url . '/checkout/?' . http_build_query(array(
				'edd_license_key' => $this->license_key,
				'download_id' => $this->download_id));
	}

	function get_license_status() {
		if (empty($this->license_status)) {
			$this->license_status = $this->check_license();
		}

		return $this->license_status;
	}

	function get_status_display($status) {
		if (is_wp_error($status)) {
			return $status->get_error_message();
		} else {
			switch ($status->license) {
				case 'inactive':
					return __('Your license key is inactive.', 'wp-linkedin');

				case 'site_inactive':
				case 'valid':
					return __('Your license key is valid.', 'wp-linkedin');

				case 'expired':
					return sprintf(__('Your license key has expired, <a href="%s">click here to renew it</a>.', 'wp-linkedin'), $this->renew_url());

				case 'disabled':
				case 'item_name_mismatch':
				case 'invalid':
				default:
					return __('Your license key is invalid.', 'wp-linkedin');
			}
		}
	}

	function check_license($action='check_license', $key=false) {
		// data to send in our API request
		$api_params = array(
			'edd_action'=> $action,
			'license' 	=> ($key) ? $key : $this->license_key,
			'item_name' => urlencode($this->plugin_name)
		);

		// Call the custom API.
		$response = wp_remote_get(add_query_arg($api_params, $this->store_url),
				array('timeout' => 15, 'sslverify' => false));

		// make sure the response came back okay
		if (is_wp_error($response)) return $response;

		// decode the license data
		$license_data = json_decode(wp_remote_retrieve_body($response));

		// $license_data->license will be either "active" or "inactive"
		return $license_data;
	}

	function sanitize_license($new) {
		$new = trim($new);

		if ($this->license_key != $new) {
			// automatically deactivate the old license and activate the new one
			if ($this->license_key) $this->check_license('deactivate_license');
		 	if ($new) $this->check_license('activate_license', $new);
		}

		return $new;
	}
}

