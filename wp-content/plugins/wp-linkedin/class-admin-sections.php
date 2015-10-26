<?php

class WPLinkedInAdminSection {

	function __construct($option_page, $section_name, $section_id='default') {
		$this->option_page = $option_page;
		$this->section_id = $section_id;
		add_settings_section($section_id, $section_name, array(&$this, 'section_header'), $this->option_page);
		$this->register_settings();
	}

	protected function add_options_field($id, $title) {
		register_setting($this->option_page, 'wp-linkedin_' . $id);
		add_settings_field('wp-linkedin_' . $id, $title, array(&$this, 'field_' . $id), $this->option_page, $this->section_id);
	}

	protected function register_settings() {
	}

	function section_header() {
	}
}

class WPLinkedInOptionsSection extends WPLinkedInAdminSection {

	function __construct($option_page) {
		parent::__construct($option_page, __('Options', 'wp-linkedin'));
	}

	protected function register_settings() {
		$this->add_options_field('full_profile', __('Full Profile', 'wp-linkedin'));
		$this->add_options_field('fields', __('Profile fields', 'wp-linkedin'));
		$this->add_options_field('profilelanguage', __('Profile language', 'wp-linkedin'));
		$this->add_options_field('sendmail_on_token_expiry', __('Send mail on token expiry', 'wp-linkedin'));
		$this->add_options_field('add_card_to_content', __('LinkedIn cards', 'wp-linkedin'));
	}

	function field_full_profile() { ?>
		<label><input type="checkbox" name="wp-linkedin_full_profile"
			value="1" <?php checked(LINKEDIN_FULL_PROFILE); ?> />&nbsp;
			<?php _e('Check this option only if you have been authorized by LinkedIn to access the full profile.', 'wp-linkedin') ?></label>
		<p><em><?php _e('To be authorized you must apply to <a target="_blank" href="https://help.linkedin.com/app/ask/path/api-dvr">the "Apply with LinkedIn" program</a>.',
				'wp-linkedin'); ?>
			<?php _e('<a href="http://vdvn.me/p2lg" target="_blank">More information on vedovini.net</a>',
				'wp-linkedin'); ?></em></p><?php
	}

	function field_fields() { ?>
		<textarea id="wp-linkedin_fields" name="wp-linkedin_fields" rows="5"
		class="large-text"><?php echo get_option('wp-linkedin_fields', LINKEDIN_FIELDS_DEFAULT); ?></textarea>
		<p><em><?php _e('Comma separated list of fields to show on the profile.', 'wp-linkedin'); ?>
		<?php _e('You can overide this setting in the shortcode with the `fields` attribute.', 'wp-linkedin'); ?>
		<?php _e('See the <a href="https://developers.linkedin.com/documents/profile-fields" target="_blank">LinkedIn API documentation</a> for the complete list of fields.', 'wp-linkedin'); ?></em></p><?php
	}

	function field_profilelanguage() { ?>
		<select id="wp-linkedin_profilelanguage" name="wp-linkedin_profilelanguage"><?php
			$lang = get_option('wp-linkedin_profilelanguage');
			$languages = $this->getLanguages();

			echo '<option value="" ' . selected($lang, '', false) . '>' . __('Default', 'wp-linkedin') . '</option>';

			foreach ($languages as $k => $v) {
				echo '<option value="' . $k . '" ' . selected($lang, $k, false) . '>' . $v . '</option>';
			} ?>
		</select>
		<p><em><?php _e('The language of the profile to display if you have several profiles in different languages.', 'wp-linkedin'); ?>
		<?php _e('You can overide this setting in the shortcode with the `lang` attribute.', 'wp-linkedin'); ?>
		<?php printf(__('See "Requesting alternate profile languages" in the <a href="%s" target="_blank">LinkedIn API documentation</a> for details.', 'wp-linkedin'),
				'https://developer.linkedin.com/docs/signin-with-linkedin'); ?></em></p><?php
	}

	function field_sendmail_on_token_expiry() { ?>
		<label><input type="checkbox" name="wp-linkedin_sendmail_on_token_expiry"
			value="1" <?php checked(LINKEDIN_SENDMAIL_ON_TOKEN_EXPIRY); ?> />&nbsp;
			<?php _e('Check this option if you want the plugin to send you an email when the token has expired or is invalid.', 'wp-linkedin') ?></label><?php
	}

	function field_add_card_to_content() {
		$plugin = WPLinkedInPlugin::get_instance();
		$post_types = $plugin->get_post_types();
		$wp_post_types = get_post_types(array('public' => true), 'objects'); ?>
		<p><?php foreach ($wp_post_types as $name => $post_type): ?>
		<label style="white-space:nowrap;"><input type="checkbox" name="wp-linkedin_add_card_to_content[]"
			value="<?php echo $name; ?>" <?php checked(in_array($name, $post_types)); ?> /><?php echo $post_type->labels->name; ?></label>&nbsp;
		<?php endforeach; ?></p>
		<p><em><?php _e('Check the content types where you want your LinkedIn card inserted.', 'wp-linkedin') ?></em></p><?php
	}

	function getLanguages() {
		static $languages;

		if (!isset($languages)) {
			$languages = array(
					'in-ID' => __('Bahasa Indonesia', 'wp-linkedin'),
					'cs-CZ' => __('Czech', 'wp-linkedin'),
					'da-DK' => __('Danish', 'wp-linkedin'),
					'nl-NL' => __('Dutch', 'wp-linkedin'),
					'fr-FR' => __('French', 'wp-linkedin'),
					'de-DE' => __('German', 'wp-linkedin'),
					'it-IT' => __('Italian', 'wp-linkedin'),
					'ja-JP' => __('Japanese', 'wp-linkedin'),
					'ko-KR' => __('Korean', 'wp-linkedin'),
					'ms-MY' => __('Malay', 'wp-linkedin'),
					'no-NO' => __('Norwegian', 'wp-linkedin'),
					'pl-PL' => __('Polish', 'wp-linkedin'),
					'pt-BR' => __('Portuguese', 'wp-linkedin'),
					'ro-RO' => __('Romanian', 'wp-linkedin'),
					'ru-RU' => __('Russian', 'wp-linkedin'),
					'es-ES' => __('Spanish', 'wp-linkedin'),
					'sv-SE' => __('Swedish', 'wp-linkedin'),
					'tr-TR' => __('Turkish', 'wp-linkedin'),
					'sq-AL' => __('Albanian', 'wp-linkedin'),
					'hy-AM' => __('Armenian', 'wp-linkedin'),
					'bs-BA' => __('Bosnian', 'wp-linkedin'),
					'my-MM' => __('Burmese (Myanmar)', 'wp-linkedin'),
					'zh-CN' => __('Chinese (Simplified)', 'wp-linkedin'),
					'zh-TW' => __('Chinese (Traditional)', 'wp-linkedin'),
					'hr-HR' => __('Croatian', 'wp-linkedin'),
					'fi-FI' => __('Finnish', 'wp-linkedin'),
					'el-GR' => __('Greek', 'wp-linkedin'),
					'hi-IN' => __('Hindi', 'wp-linkedin'),
					'hu-HU' => __('Hungarian', 'wp-linkedin'),
					'is-IS' => __('Icelandic', 'wp-linkedin'),
					'jv-JV' => __('Javanese', 'wp-linkedin'),
					'kn-IN' => __('Kannada', 'wp-linkedin'),
					'lv-LV' => __('Latvian', 'wp-linkedin'),
					'lt-LT' => __('Lithuanian', 'wp-linkedin'),
					'ml-IN' => __('Malayalam', 'wp-linkedin'),
					'sr-BA' => __('Serbian', 'wp-linkedin'),
					'sk-SK' => __('Slovak', 'wp-linkedin'),
					'tl-PH' => __('Tagalog', 'wp-linkedin'),
					'ta-IN' => __('Tamil', 'wp-linkedin'),
					'te-IN' => __('Telugu', 'wp-linkedin'),
					'th-TH' => __('Thai', 'wp-linkedin'),
					'uk-UA' => __('Ukrainian', 'wp-linkedin'),
					'vi-VN' => __('Vietnamese', 'wp-linkedin'),
					'xx-XX' => __('Other', 'wp-linkedin')
			);
			asort($languages);
		}

		return $languages;
	}
}

class WPLinkedInAPISection extends WPLinkedInAdminSection {

	function __construct($option_page) {
		parent::__construct($option_page, __('LinkedIn API', 'wp-linkedin'), 'apikeys');
	}

	protected function register_settings() {
		$this->add_options_field('redirect_uri', __('Redirect URL', 'wp-linkedin'));
		$this->add_options_field('appkey', __('Client ID', 'wp-linkedin'));
		$this->add_options_field('appsecret', __('Client secret', 'wp-linkedin'));
		$this->add_options_field('ssl_verifypeer', __('Verify SSL peer', 'wp-linkedin'));
	}

	function section_header() { ?>
		<p><?php _e('As of April 11, 2014 LinkedIn requires that redirect uris
				be registered, thus forcing every plugin installation to have
				its own application key/secret pair and register the corresponding
				redirect uri.', 'wp-linkedin'); ?></p>
		<p><?php _e('Please follow the instructions on <a href="http://vdvn.me/p2tt" target="_blank">how to create a LinkedIn API application for the WP-LinkedIn plugin</a>.', 'wp-linkedin'); ?></p><?php
	}

	function field_redirect_uri() {
		$linkedin = wp_linkedin_connection();
		$redirect_uri = $linkedin->get_token_process_url(); ?>
		<input type="text" id="redirect_uri" class="regular-text" readonly value="<?php echo $redirect_uri; ?>">
		<a href="#" class="button button-secondary button-copy"><?php _e('Copy', 'wp-linkedin'); ?></a>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('.button-copy').click(function() {
					$('#redirect_uri').select();
					document.execCommand('copy');
					return false;
				});
			})
		</script><?php
	}

	function field_appkey() { ?>
		<input type="text" name="wp-linkedin_appkey" class="regular-text" value="<?php echo WP_LINKEDIN_APPKEY; ?>" /><?php
	}

	function field_appsecret() { ?>
		<input type="text" name="wp-linkedin_appsecret" class="regular-text" value="<?php echo WP_LINKEDIN_APPSECRET; ?>" /><?php
	}

	function field_ssl_verifypeer() { ?>
		<label><input type="checkbox" name="wp-linkedin_ssl_verifypeer"
			value="1" <?php checked(LINKEDIN_SSL_VERIFYPEER); ?> />&nbsp;
			<?php _e('Uncheck this option only if you have SSL certificate issues on your server.', 'wp-linkedin') ?></label><?php
	}
}

class WPLinkedInExtensionsSection extends WPLinkedInAdminSection {

	function __construct($option_page) {
		parent::__construct($option_page, __('Extensions', 'wp-linkedin'), 'extensions');
	}


	function download_link($pid) {
		echo "http://vdvn.me/checkout?download_id={$pid}&edd_action=add_to_cart";
	}

	function section_header() { ?>
		<p><?php _e('Extensions are premium WordPress plugins that add new features to the WP-LinkedIn plugin.', 'wp-linkedin'); ?>
		<?php _e('The following is a list of the existing extensions.', 'wp-linkedin'); ?></p>
		<div class="extension"><div class="extension-inner">
			<strong><a href="http://vdvn.me/p1nd"><?php _e('WP LinkedIn Multi-Users', 'wp-linkedin'); ?></a></strong>
			<p><?php _e('Enables profiles and recommendations for any registered user. Enables users to create accounts and log in using LinkedIn', 'wp-linkedin'); ?></p>
			<span class="submit"><a class="button button-primary" href="<?php $this->download_link(2137); ?>"><?php _e('Get it!', 'wp-linkedin'); ?></a></span>
		</div></div>
		<div class="extension"><div class="extension-inner">
			<strong><a href="http://vdvn.me/p1nr"><?php _e('WP LinkedIn for Companies', 'wp-linkedin'); ?></a></strong>
			<p><?php _e('Provides shortcodes and widgets to display company profiles and company page updates on your blog.', 'wp-linkedin'); ?></p>
			<span class="submit"><a class="button button-primary" href="<?php $this->download_link(2151); ?>"><?php _e('Get it!', 'wp-linkedin'); ?></a></span>
		</div></div>
		<div class="extension"><div class="extension-inner">
			<strong><a href="http://vdvn.me/p2ub"><?php _e('WP LinkedIn Advanced Templates', 'wp-linkedin'); ?></a></strong>
			<p><?php _e('Provides advanced templates for the LinkedIn profile and the company page updates.', 'wp-linkedin'); ?></p>
			<span class="submit"><a class="button button-primary" href="<?php $this->download_link(3683); ?>"><?php _e('Get it!', 'wp-linkedin'); ?></a></span>
		</div></div>
		<p style="clear:both"><?php _e('If you purchased any extension please provide the license keys below.', 'wp-linkedin'); ?></p><?php
	}
}

class WPLinkedInToolsSection extends WPLinkedInAdminSection {

	function __construct($option_page) {
		parent::__construct($option_page, __('Tools', 'wp-linkedin'), 'tools');
	}

	function section_header() {
		$linkedin = wp_linkedin_connection();
		$clearcache_url = add_query_arg(array('action' => 'clear_cache',
				'r' => $_SERVER['REQUEST_URI']), admin_url('admin.php')); ?>
		<div class="tool"><div class="tool-inner">
			<span class="submit"><a href="<?php echo $linkedin->get_authorization_url(); ?>" class="button button-primary"><?php _e('Regenerate LinkedIn Access Token', 'wp-linkedin'); ?></a></span>
			<br><em><?php _e('You need to regenerate the token when it has expired, when you installed a new extension for this plugin or when LinkedIn grants you new rights.', 'wp-linkedin'); ?></em>
		</div></div>
		<div class="tool"><div class="tool-inner">
			<span class="submit"><a href="<?php echo $clearcache_url; ?>" class="button button-primary"><?php _e('Clear the Cache', 'wp-linkedin'); ?></a></span>
			<br><em><?php _e('The content of your profile is locally cached for 12 hours, use that button if you want to force the plugin to reload your profile.', 'wp-linkedin'); ?></em>
		</div></div><?php
	}
}


class WPLinkedInDebugSection extends WPLinkedInAdminSection {

	function __construct($option_page) {
		parent::__construct($option_page, __('Debug', 'wp-linkedin'), 'debug');
	}

	protected function register_settings() {
		$this->add_options_field('access_token', __('Access Token', 'wp-linkedin'));
		$this->add_options_field('profile', __('Your Profile', 'wp-linkedin'));
	}

	function field_access_token() {
		$linkedin = wp_linkedin_connection(); ?>
		<input readonly type="text" class="large-text" value="<?php esc_attr_e($linkedin->get_access_token()); ?>" /><?php
	}

	function field_profile() {
		echo '<textarea class="large-text" rows="20" readonly>';
		$fields = preg_replace('/\s+/', '', LINKEDIN_FIELDS_BASIC . ',' . LINKEDIN_FIELDS);
		$profile = wp_linkedin_get_profile($fields, LINKEDIN_PROFILELANGUAGE);
		print_r(json_encode($profile, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
		echo '</textarea>';
	}
}