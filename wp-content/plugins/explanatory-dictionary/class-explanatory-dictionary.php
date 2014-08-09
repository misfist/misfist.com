<?php
/**
 * Explanatory Dictionary.
 *
 * @package   Explanatory_Dictionary
 * @author    EXED internet (RJvD, BHdH) <service@exed.nl>
 * @license   GPL-2.0+
 * @link      http://www.exed.nl/
 * @copyright 2013  EXED internet  (email : service@exed.nl)
 */

/**
 * Plugin class.
 *
 * @package   Explanatory_Dictionary
 * @author    EXED internet (RJvD, BHdH) <service@exed.nl>
 */
class Explanatory_Dictionary {
	
	/**
	 * Plugin version, used for cache-busting of style and script file
	 * references.
	 *
	 * @since 4.0.0
	 */
	protected $version = '4.0.2';
	
	/**
	 * Unique identifier for your plugin.
	 *
	 * Use this value (not the variable name) as the text domain when
	 * internationalizing strings of text. It should
	 * match the Text Domain file header in the main plugin file.
	 *
	 * @since 4.0.0
	 */
	protected $plugin_slug = 'explanatory-dictionary';
	protected $plugin_slug_safe = 'explanatory_dictionary';
	
	/**
	 * Instance of this class.
	 *
	 * @since 4.0.0
	 */
	protected static $instance = null;
	
	/**
	 * Slug of the plugin screen.
	 *
	 * @since 4.0.0
	 */
	protected $plugin_screen_hook_suffix = null;
	
	/**
	 * Slug of the plugin options screen.
	 *
	 * @since 4.0.0
	 */
	protected $plugin_options_screen_hook_suffix = null;
	
	protected $exclude_array = array();
	
	/**
	 * hold the html of the definitioner to add at the end of the page.
	 * 
	 * @since 4.0.1 
	 */
	protected $definitioner;
	
	/**
	 * Exclude single words on the page specified by shortcode
	 * 
	 * @since 4.0.1
	 */
	protected $excluded_words = array();
	
	
	/**
	 * Initialize the plugin by setting localization, filters, and
	 * administration functions.
	 *
	 * @since 4.0.0
	 */
	private function __construct() {
		require_once( plugin_dir_path( __FILE__ ) . 'classes/settings.class.php' );
		require_once( plugin_dir_path( __FILE__ ) . 'classes/template.class.php' );
		
		define( 'DICTIONARY_VIEWS', plugin_dir_path( __FILE__ ) . 'views/' );
		
		$this->settings = Explanatory_Dictionary_Settings::get_instance();
		$this->template = Explanatory_Dictionary_Template::get_instance();
				
		// Load plugin text domain
		add_action( 'init', array( 
			$this, 'load_plugin_textdomain' 
		) );
		
		// Add the options page and menu item.
		add_action( 'admin_menu', array( 
			$this, 'add_plugin_admin_menu' 
		) );
		
		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( 
			$this, 'enqueue_admin_styles' 
		) );
		add_action( 'admin_enqueue_scripts', array( 
			$this, 'enqueue_admin_scripts' 
		) );
		
		// Load public-facing style sheet and JavaScript.
		add_action( 'wp_enqueue_scripts', array( 
			$this, 'enqueue_styles' 
		) );
		add_action( 'wp_enqueue_scripts', array( 
			$this, 'enqueue_scripts' 
		) );
		
		add_shortcode( 'explanatory-dictionary' , array( 
				$this, 'explanatory_dictionary_shortcode' 
		) );
		
		add_shortcode( 'no-explanation' , array( 
				$this, 'no_explanation_shortcode' 
		) );
		
		/**
		 * deprecated
		 */
		add_shortcode( 'explanatory dictionary' , array( 
				$this, 'explanatory_dictionary_shortcode' 
		) );
		
		/**
		 * deprecated
		 */
		add_shortcode( 'no explanation' , array( 
				$this, 'no_explanation_shortcode' 
		) );
		
		add_filter( 'the_content', array( 
				$this, 'add_explanatory_dictionary_words' 
		), 15 );
		
		add_action( 'admin_init', array( 
				$this, 'check_plugin_version' 
		) );
		
		add_action( 'wp_footer', array(
				$this, 'add_definitioner'
		) );
	}
	
	/**
	 * Return an instance of this class.
	 *
	 * @since 4.0.0
	 *       
	 * @return object A single instance of this class.
	 */
	public static function get_instance() {
		
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self();
		}
		
		return self::$instance;
	}
	
	public function check_plugin_version() {		
		if ( false === get_option( $this->plugin_slug_safe . '_version' ) ) {
			global $wpdb;
			// TODO: Set the table to UTF-8
			$table_name = $wpdb->prefix . $this->plugin_slug_safe;
			$sql = "
				CREATE TABLE IF NOT EXISTS {$table_name} (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`word` varchar(255) NOT NULL,
					`synonyms_and_forms` text NOT NULL,
					`explanation` text NOT NULL,
					`status` int(1) NOT NULL DEFAULT 1,
					UNIQUE KEY id (id)
			);";
			
			require_once ( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
			
			add_option( $this->plugin_slug_safe . '_version' , $this->version );
			
		} else if ( get_option( $this->plugin_slug_safe . '_version' ) < $this->version ) {
			if ( '3.0.2' == get_option( $this->plugin_slug_safe . '_version' ) ) {
				global $wpdb;
				
				$table_name = $wpdb->prefix . $this->plugin_slug_safe;
				$wpdb->query("
					ALTER TABLE {$table_name}
					ADD `status` int(1) NOT NULL DEFAULT 1
				");
				
				$this->settings->migrate_old_settings();
				$this->update_synonyms();
			}
			else if ( '3.0' > get_option( $this->plugin_slug_safe . '_version' ) ) {
				global $wpdb;
				
				$table_name = $wpdb->prefix . $this->plugin_slug_safe;
				$wpdb->query("
					ALTER TABLE {$table_name} 
					ADD `synonyms_and_forms` TEXT NOT NULL AFTER `word`,
					ADD `status` int(1) NOT NULL DEFAULT 1
				");
				
				$this->settings->migrate_old_settings();
				$this->update_synonyms();
			} else {
				delete_option( $this->plugin_slug_safe . 'settings');
			}
			
			update_option( $this->plugin_slug_safe . '_version', $this->version);
		}
	}
	
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since 4.0.0
	 */
	public function load_plugin_textdomain() {
		
		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
		
		load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
	}
	
	/**
	 * Nonce function.
	 * This is to help with securely making sure forms have been processed
	 * from the correct place.
	 *
	 * @since 4.0.0
	 * @param $action string
	 *       	 Additional action to add to the nonce.
	 */
	public function get_nonce( $action = '' ) {
		if ( $action ) {
			return "{$this->plugin_slug}-component-action_{$action}";
		} else {
			return $this->plugin_slug;
		}
	}
	
	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since 4.0.0
	 *       
	 * @return null Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {
		if ( ! isset( $this->plugin_screen_hook_suffix ) || ! isset( $this->plugin_options_screen_hook_suffix ) ) {
			return;
		}
		
		$screen = get_current_screen();
		if ( $screen->id == $this->plugin_screen_hook_suffix || $screen->id == $this->plugin_options_screen_hook_suffix ) {
			wp_enqueue_style( $this->plugin_slug . '-admin-styles', plugins_url( 'css/admin.css', __FILE__ ), array(), $this->version );
		}
	}
	
	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since 4.0.0
	 *       
	 * @return null Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {
		if ( ! isset( $this->plugin_screen_hook_suffix ) || ! isset( $this->plugin_options_screen_hook_suffix ) ) {
			return;
		}
		
		$screen = get_current_screen();
		if ( $screen->id == $this->plugin_screen_hook_suffix || $screen->id == $this->plugin_options_screen_hook_suffix ) {
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'js/admin.js', __FILE__ ), array( 
				'jquery'
			), $this->version );
		}
		if ( $screen->id == $this->plugin_options_screen_hook_suffix ) {
			wp_enqueue_script( $this->plugin_slug . '-jscolor', plugins_url( 'js/jscolor.js', __FILE__ ), false, $this->version );
		}
		else{
			wp_enqueue_script( $this->plugin_slug . '-jscolor', plugins_url( 'js/jscolor.js', __FILE__ ), false, $this->version );
		}
	}
	
	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since 4.0.0
	 */
	public function enqueue_styles() {
		
		wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'css/public.css', __FILE__ ), array(), $this->version );
		
		$settings_list = $this->settings->get_settings_list();
		
		if( 'no' === $settings_list['_external_css_file'] ) {
			// TODO: Do a lot more checking if values are valid
			$display = '';
			$border_color_first = $settings_list['_background'];
			$border_color = $settings_list['_border_color'];
			if ( $settings_list['_border_size'] == 0 ) {
				$tooltip_bottom = '30px;';
				$display = 'display: none;';
				$border_color_first = 'transparent;';
				$border_color = 'transparent;';
			} else if ( $settings_list['_border_size'] < 2 ) {
				$border_size_border = '16px;';
				$border_first_width = '15px;';
				$border_first_left = '30px;';
				$tooltip_bottom = '35px;';
				$safe_zone_height = '19px;';
				$safe_zone_bottom = '20px;';
			} else {
				$border_size_border = ( ( $settings_list['_border_size'] * 2 ) + 16 ) . 'px;';
				$border_first_width = ( ( $settings_list['_border_size'] / 2 ) + 15 ) . 'px;';
				$border_first_left = ( ( ( $settings_list['_border_size'] / 2 ) == 1 ? 0 : ( $settings_list['_border_size'] / 2 ) ) + 31 ) . 'px;';
				$tooltip_bottom = ( $settings_list['_border_size'] + 35 ) . 'px;';
				$safe_zone_height = ( $settings_list['_border_size'] + 19 ) . 'px;';
				$safe_zone_bottom = ( $settings_list['_border_size'] + 20 ) . 'px;';
			}
			// TODO: Disable box shadow
			$word_decoration = ( 'underline' == $settings_list['_word_text_decoration'] ? 'border-bottom: 1px dashed;' : 'border-bottom: none;' );
			
	        $custom_css = "
	        
.explanatory-dictionary-highlight {
	font-style: {$settings_list['_word_font_style']};
	font-weight: {$settings_list['_word_font_weight']};
	{$word_decoration}
	color: {$settings_list['_word_color']};
}

#explanatory-dictionary-tooltip {
	width: {$settings_list['_width']};
	background-color: {$settings_list['_background']};
	text-align: {$settings_list['_text_align']};
	font-size: {$settings_list['_font_size']};
	color: {$settings_list['_color']};
	border-color: {$settings_list['_border_color']};
	border-width: {$settings_list['_border_size']};
	border-style: solid;
	background: {$settings_list['_background']};
	-webkit-border-radius: {$settings_list['_border_radius']};
	-moz-border-radius: {$settings_list['_border_radius']};
	border-radius: {$settings_list['_border_radius']};
	bottom: {$tooltip_bottom};
}

#explanatory-dictionary-tooltip .explanatory-dictionary-tooltip-content {
	padding: {$settings_list['_padding']};
}

#explanatory-dictionary-tooltip-bottom-safe-zone {
	height: {$safe_zone_height};
	bottom: -{$safe_zone_bottom};
}

#explanatory-dictionary-tooltip .explanatory-dictionary-tooltip-bottom {
	border-right-color: transparent;
	border-right-width: {$border_first_width};
	border-right-style: solid;
	
	border-top-color: {$border_color_first};
	border-top-width: {$border_first_width};
	border-top-style: solid;
	left: {$border_first_left};
}

#explanatory-dictionary-tooltip .explanatory-dictionary-tooltip-bottom-border {
	border-right-color: transparent;
	border-right-width: {$border_size_border};
	border-right-style: solid;
	
	border-top-color: {$border_color};
	border-top-width: {$border_size_border};
	border-top-style: solid;
	
}

#explanatory-dictionary-tooltip dt {
	font-size: {$settings_list['_title_font_size']};
	color: {$settings_list['_title_color']};
	font-weight: {$settings_list['_title_font_weight']};
	font-style: {$settings_list['_title_font_style']};
	text-decoration: {$settings_list['_title_text_decoration']};
}

#explanatory-dictionary-tooltip dd {
	font-size: {$settings_list['_font_size']};
	color: {$settings_list['_color']};
	font-weight: normal;
}
	        ";
        	wp_add_inline_style( $this->plugin_slug . '-plugin-styles', $custom_css );
		}
		
		
	}
	
	/**
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since 4.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_slug . '-plugin-script', plugins_url( 'js/public.js', __FILE__ ), array( 
			'jquery'
		), $this->version );
	}
	
	/**
	 * Register the administration menu for this plugin into the WordPress
	 * Dashboard menu.
	 *
	 * @since 4.0.0
	 */
	public function add_plugin_admin_menu() {
		global $wp_version;
		
		$icon = 'dashicons-book';
		
		if( $wp_version < '3.8' ) {
			$icon = plugin_dir_url(__FILE__) . 'book_open.ico';
		}
		$this->plugin_screen_hook_suffix = add_menu_page( 'Explanatory Dictionary', 'Explanatory Dictionary', 'manage_options',  $this->plugin_slug, array(
				$this->template, 'display_plugin_admin_page'
		), $icon );
		
		$this->plugin_options_screen_hook_suffix = add_submenu_page( $this->plugin_slug, __( 'Options', $this->plugin_slug ), __( 'Options', $this->plugin_slug ), 'manage_options', $this->plugin_slug . '-options', array( 
			$this->template, 'display_plugin_admin_options_page' 
		) );
		//add new pagina toegevoegen in het admin menu
		$this->plugin_options_screen_hook_suffix = add_submenu_page( $this->plugin_slug, __( 'Add new', $this->plugin_slug ), __( 'Add new', $this->plugin_slug ), 'manage_options', $this->plugin_slug . '&action=add', array( 
			$this->template, 'display_plugin_admin_options_page' 
		) );

	
	}
	
	/**
	 * A function for displaying messages in the admin.
	 * It will wrap the message in the appropriate <div> with the
	 * custom class entered. The updated class will be added if no $class is
	 * given.
	 *
	 * @since 4.0.0
	 * @param $class string
	 *       	 Class the <div> should have.
	 * @param $message string
	 *       	 The text that should be displayed.
	 */
	function admin_message( $message, $class = 'updated', $link = '' ) {
		
		echo '
			<div class="' . ( ! empty( $class ) ? esc_attr( $class ) : 'updated' ) . '">
				<p><strong>' . $message . '</strong></p>
				' . ( ! empty( $link ) ? '<p>' . $link . '</p>' : '' ) . '
			</div>
		';
	}
	
	/**
	 * Get all entries from the database by status
	 *
	 * @since 4.0.0
	 * @param $status int
	 *       	 The status of the entries
	 */
	public function get_all_entries_by_status( $status ) {
		global $wpdb;
		
		$table_name = $wpdb->prefix . $this->plugin_slug_safe;
		
		$result = $wpdb->get_results( $wpdb->prepare( "
			SELECT *
			FROM {$table_name}
			WHERE `status` = %d		
		", $status ) );
		
		if ( ! empty( $result ) ) {
			
			$formatted = array();
			foreach ( $result as $row ) {
				$formatted[$row->word] = $row;
			}
			
			return $formatted;
		} else {
			return array();
		}
	}
	
	/**
	 * Get all entries from the database
	 *
	 * @since 4.0.0
	 * @param $status int
	 *       	 The status of the entries
	 */
	public function get_all_entries() {
		global $wpdb;
		
		$table_name = $wpdb->prefix . $this->plugin_slug_safe;
		
		$result = $wpdb->get_results( "
			SELECT *
			FROM {$table_name}
		");
		
		if ( ! empty( $result ) ) {
			
			$formatted = array();
			foreach ( $result as $row ) {
				$formatted[$row->word] = $row;
			}
			
			return $formatted;
		} else {
			return array();
		}
	}
	
	/**
	 * Get the number of entries from the database
	 *
	 * @since 4.0.0
	 */
	public function get_number_of_entries() {
		global $wpdb;
		
		$table_name = $wpdb->prefix . $this->plugin_slug_safe;
		
		$wpdb->get_results( "
			SELECT `id`
			FROM {$table_name}
		" );
		
		return $wpdb->num_rows;
	}
	
	/**
	 * Add a new entry to the database
	 *
	 * @since 4.0.0
	 * @param $word string
	 *       	 The word
	 * @param $synonyms text
	 *       	 The synonyms of the word
	 * @param $explanation text
	 *       	 The explaation of the word
	 *       	
	 */
	public function add_new_entry( $word, $synonyms, $explanation ) {
		global $wpdb;
		if( ! empty( $word ) ){
			$table_name = $wpdb->prefix . $this->plugin_slug_safe;
		
			$array_synonyms = array();
			if( !empty( $synonyms ) ) {
				$array_synonyms = explode(',', $synonyms );
				array_walk( $array_synonyms, array( 'self' , 'trim' ) );
				$array_synonyms = array_unique( $array_synonyms );
				if( ! empty( $array_synonyms ) ){
					foreach( $array_synonyms as $key => $value ){
						if( strtolower( $value ) == strtolower( $word ) ){
							unset( $array_synonyms[$key] );
						}
					}	
				}
			}
			
			foreach( $this->get_all_entries() as $existing ) {
				if( $word == $existing->word ) {
					return __( 'The word you are trying to define already exists', $this->plugin_slug );
				}
				if( !empty( $array_synonyms ) && in_array( $existing->synonyms_and_forms, $array_synonyms ) ) {
					return sprintf( __( 'The synonym for this word is already defined at <i>%s</i> as a synonym', $this->plugin_slug ), $existing->word);
				}
				if( !empty( $array_synonyms ) && in_array( $existing->word, $array_synonyms ) ) {
					return sprintf( __( 'You are trying to define a synonym for this word but <i>%s</i> is already defined as a word', $this->plugin_slug ), $existing->word);
				}
				if( !empty( $existing->synonyms_and_forms ) &&  in_array( $word, maybe_unserialize( $existing->synonyms_and_forms ) ) ) {
					return sprintf( __( 'The word you are trying to define already exists as a synonym at <i>%s</i>', $this->plugin_slug ), $existing->word);
				}
			}
			
			if( empty( $array_synonyms ) ){
				$array_synonyms = '';
			}
			
			$insert = $wpdb->insert( $table_name, array( 
				'word' => stripcslashes( $word ), 'synonyms_and_forms' => maybe_serialize( $array_synonyms ), 'explanation' => stripcslashes( $explanation ) 
			), array( 
				'%s', '%s', '%s' 
			) );
			
			return $insert;
		}
	}
	
	/**
	 * Update an entry in the database
	 *
	 * @since 4.0.0
	 * @param $id int
	 *       	 The id of the entry
	 * @param $word string
	 *       	 The word
	 * @param $synonyms text
	 *       	 The synonyms of the word
	 * @param $explanation text
	 *       	 The explaation of the word
	 *       	
	 */
	public function update_entry( $entry_id, $word, $synonyms, $explanation, $status ) {
		global $wpdb;
		if( !empty( $word ) ){
			$table_name = $wpdb->prefix . $this->plugin_slug_safe;
			
			$arrasy_synonyms = array();
			if( !empty( $synonyms ) ) {
				if( strlen( $synonyms ) > 1 ){
					$array_synonyms = explode(',', $synonyms );
					array_walk( $array_synonyms, array( 'self' , 'trim' ) );
					$array_synonyms = array_unique( $array_synonyms );
					if( ! empty( $array_synonyms ) ){
						foreach( $array_synonyms as $key => $value ){
							if( strtolower( $value ) == strtolower( $word ) ){
								unset( $array_synonyms[$key] );
							}
						}	
					}
				}
			};
			
			$current = $this->get_entry( $entry_id );
			foreach( $this->get_all_entries() as $existing ) {
				if( $current->id != $existing->id) {
					if( $word == $existing->word && $current->word != $existing->word ) {
						return __( 'The word you are trying to define already exists', $this->plugin_slug );
					}
					if( !empty( $array_synonyms ) && in_array( $existing->synonyms_and_forms, $array_synonyms ) ) {
						return sprintf( __( 'The synonym for this word is already defined at <i>%s</i> as a synonym', $this->plugin_slug ), $existing->word);
					}
					if( !empty( $array_synonyms ) && in_array( $existing->word, $array_synonyms ) ) {
						return sprintf( __( 'You are trying to define a synonym for this word but <i>%s</i> is already defined as a word', $this->plugin_slug ), $existing->word);
					}
					if( !empty( $existing->synonyms_and_forms ) && in_array( $word, maybe_unserialize( $existing->synonyms_and_forms ) ) ) {
						return sprintf( __( 'The word you are trying to define already exists as a synonym at <i>%s</i>', $this->plugin_slug ), $existing->word);
					}
				}
			}
			
			if( empty( $array_synonyms ) ){
				$array_synonyms = '';
			}
	
			$update = $wpdb->update( $table_name, array( 
				'word' => stripcslashes( $word ), 'synonyms_and_forms' => maybe_serialize( $array_synonyms ), 'explanation' => stripcslashes( $explanation ), 'status' => $status 
			), array( 
				'id' => $entry_id 
			), array( 
				'%s', '%s', '%s', '%d' 
			), array( 
				'%d' 
			) );
			
			return $update;
		}
	}
	
	/**
	 * Get an entry object by id
	 *
	 * @since 4.0.0
	 * @param $entry_id int
	 *       	 The id for the entry
	 */
	public function get_entry( $entry_id ) {
		global $wpdb;
		
		$table_name = $wpdb->prefix . $this->plugin_slug_safe;
		
		$select = $wpdb->get_row( $wpdb->prepare( "
				SELECT *
				FROM `{$table_name}`
				WHERE `id` = %d
			", $entry_id ) );
		
		return $select;
	}
	
	/**
	 * Delete an entry from the database
	 *
	 * @since 4.0.0
	 * @param $entry_id unknown_type       	
	 * @return unknown
	 */
	public function delete_entry( $entry_id ) {
		global $wpdb;
		
		$table_name = $wpdb->prefix . $this->plugin_slug_safe;
		
		$delete = $wpdb->delete( $table_name, array( 
			'id' => $entry_id 
		), array( 
			'%d' 
		) );
		
		return $delete;
	}
	
	/**
	 * Set the status of an entry 1 = active 0 = inactive
	 * 
	 * @since 4.0.0
	 * @param $entry_id unknown_type       	
	 * @return unknown
	 */
	public function set_entry_status( $entry_id, $status ) {
		global $wpdb;
		
		$table_name = $wpdb->prefix . $this->plugin_slug_safe;
		
		$update = $wpdb->update( $table_name, array( 
			'status' => $status 
		), array( 
			'id' => $entry_id 
		), array( 
			'%d' 
		), array( 
			'%d' 
		) );
		
		return $update;
	}
	
	/**
	 * Creates the list by the shortcode
	 * 
	 * @since 4.0.0
	 * @param array $atts (Wordress default parameter) 
	 */
	public function explanatory_dictionary_shortcode( $atts ) {
		extract( shortcode_atts( array(
			'letter' => 'A',
		), $atts ) );
		
		remove_filter( 'the_content', array(
				$this, 'add_explanatory_dictionary_words'
		), 15 );
		
		ob_start();
		$this->template->display_explanatory_dictionary( $atts );
		$output_string = ob_get_contents();
		ob_end_clean();
		
		return $output_string;
		
	}
	
	/**
	 * Removes the explanation tag from the word/sentence
	 * 
	 * @since 4.0.1
	 * @param array $atts (Wordress default parameter) 
	 */
	public function no_explanation_shortcode( $atts, $content ) {
		$this->excluded_words[] = $content;
		return $content;
	}
	
	/**
	 * Get all letters from the database
	 * 
	 * @since 4.0.0
	 * @param array $letters The letters that need to be fetched
	 */
	public function get_dictionary( $letters = array() ) {
		global $wpdb;
	
		$table_name = $wpdb->prefix . $this->plugin_slug_safe;
	
		$include = '';
		$counter = 1;
		
		if ( ! empty( $letters ) ) {
			$include .= 'AND (';
			foreach ( $letters as $letter ) {
				$include .= "`word` LIKE '{$letter}%' ";
				
				if ( $counter < count( $letters ) ) {
					$include .= "OR ";
				}
				$counter++;
			}
			$include .= ')';
		}
		
		$result = $wpdb->get_results( "
			SELECT *
			FROM {$table_name}
			WHERE `status` = 1
			{$include}
			ORDER BY `word`
		" );
	
		if ( ! empty( $result ) ) {
			
			$formatted = array();
			foreach ( $result as $row ) {
				$formatted[] = $row;
			}
				
			return $formatted;
		} else {
			return array();
		}
	}
	
	/**
	 * Check if the letter has words
	 * 
	 * @since 4.0.0
	 * @param string $letter The letter to check
	 */
	public function has_words_for_letter( $letter ) {
		global $wpdb;
		
		$table_name = $wpdb->prefix . $this->plugin_slug_safe;
		
		$result = $wpdb->get_row( "
			SELECT `id`
			FROM `{$table_name}`
			WHERE `word` LIKE '{$letter}%'
			AND `status` = 1
		" );
		
		return ( null === $result ? false : true );
	}
	
	/**
	 * Make the words or synonyms show a tooltip
	 * 
	 * @since 4.0.0
	 * @param unknown_type $content
	 */
	public function add_explanatory_dictionary_words( $content ) {
		$dictionary = $this->get_dictionary();
		
		if( empty( $dictionary ) )
			return $content;
	
		// Temporarily remove content we don't want to filter (images, headings, links)
		$searches = array( 
			'/<article.*<\/article>/i', // used for doc list
			'/<form.*<\/form>/i', // timeplan/other forms
			'/<h2.*<\/h2>/i',
			'/<h3.*<\/h3>/i',
			'/<h4.*<\/h4>/i',
			'/<a.*<\/a>/i',
			'/<img[^>]+\>/i',
			'/<input[^>]+\>/i',
		);
		$content = preg_replace_callback( $searches , array( $this, 'store_content_to_avoid' ), $content );
		
		$searches = array(); // search words to replace
		$replacements = array(); // span placeholder text ot replace the term with
		$definitions = array(); // list of definitions that exist in the document
		
		$counter = 0;
		
		// Loop through the words and build search/replace arrays to use in a preg_replace, plus definitions to define at the end of the document
		foreach( $dictionary as $word ) {
			if( ! in_array( $word->word, $this->excluded_words ) ) {
				$new_word = preg_quote($word->word, '/');
				if( preg_match( '/\b' . $new_word . '\b/u', $content ) ) {					
					$searches[$counter] = '/\b' . $new_word . '\b/u';
					$replacements[$counter] = '<span class="explanatory-dictionary-highlight" data-definition="explanatory-dictionary-definition-' . $counter . '">$0</span>';
					$definitions[] = array( 'id' => $counter, 'word' => $word->word, 'explanation' => $word->explanation );
				}
				
				if( !empty( $word->synonyms_and_forms ) ) {
					$word->synonyms_and_forms = maybe_unserialize( $word->synonyms_and_forms );
					if( !empty( $word->synonyms_and_forms ) ) {
						
						$extra_key = 1000; // need to use a differnet key - synonym should be a separate defintion so we get the title right
						foreach( $word->synonyms_and_forms as $synonym_or_form ) {
							if( ! in_array( $synonym_or_form, $this->excluded_words ) ) {
								$new_synonym_or_form = preg_quote($synonym_or_form, '/');
								if( preg_match( '/\b' . $new_synonym_or_form . '\b/u', $content ) ) {
									$thekey = $extra_key + $counter;
									$searches[$thekey] = '/\b' . $new_synonym_or_form . '\b/u';
									$replacements[$thekey] = '<span class="explanatory-dictionary-highlight" data-definition="explanatory-dictionary-definition-' . $thekey . '">$0</span>';	
									$definitions[] = array( 'id' => $thekey, 'word' => $synonym_or_form, 'explanation' => $word->explanation );
									$extra_key++;
								}
							}
						}
					}
				}
				$counter++;
			}
		}
		
		// Run the preg_replace on the content
		
		ksort($replacements);
		ksort($searches);
		$settings_list = $this->settings->get_settings_list();
		$content = preg_replace( $searches, $replacements, $content, $settings_list['_limit'] );
		
		// Reinstate the content that we didn't want to filter
		$this->exclude_array;
		
		foreach( $this->exclude_array as $key => $html ) {
			// Debug with: echo htmlspecialchars($key . '=>' . $html) . '<br /><br /><br />';
			$content = preg_replace( '/\~' . $key . '\~/', $html, $content); // puts the content back in
		}
		
		foreach( $this->exclude_array as $key => $html ) {
			$content = preg_replace( '/\~' . $key . '\~/', $html, $content); // passes again for any matches inside matches!
		}
		
		if(count($definitions) > 0 ) {
			// Add the matched definitions
			$defs = '
				<aside id="explanatory-dictionary-page-definitions">
					<h2> ' . __( 'Definitioner', $this->plugin_slug ) . ' </h2>
					<dl>
			';
				
			foreach( $definitions as $definition ) {
				$defs .= '
					<dt class="explanatory-dictionary-definition-' . $definition['id'] . '">' . $definition['word'] . '</dt>
					<dd class="explanatory-dictionary-definition-' . $definition['id'] . '">' . $definition['explanation'] . '</dd>
				';
			}
				
			// Add the definitions to the end of the_content
			$defs .= '
					</dl>
				</aside>
				<div id="explanatory-dictionary-tooltip" style="display: none">
					<span class="explanatory-dictionary-tooltip-top"></span>
					<span class="explanatory-dictionary-tooltip-content"></span>
					<span class="explanatory-dictionary-tooltip-bottom-safe-zone">
						<span class="explanatory-dictionary-tooltip-bottom"></span>
						<span class="explanatory-dictionary-tooltip-bottom-border"></span>
					</span>
				</div>
			';
			$this->definitioner = $defs;
			//$content = $content;
		}
		return $content;
	}
	
	/**
	 * Add the definitioner to the end of the page to prevent multiple instances
	 * 
	 * @since 4.0.1
	 */
	public function add_definitioner()
	{
		echo $this->definitioner;
	}
	
	/**
	 * Helper for preg_replace_callback
	 * Adds content we don't want to filter to a global array to reintate later
	 * Replaces the content with a placeholder that has the same key as the array record
	 * 
	 * @since 4.0.0
	 */
	public function store_content_to_avoid($matches) {
		$this->exclude_array[] = $matches[0]; // adds matched content to the array
		end($this->exclude_array);
		return '~' . key($this->exclude_array) . '~'; // this is the placeholder
	}
	
	/**
	 * Get serialized data and return them comma separated
	 * 
	 * @since 4.0.0
	 * @param string $data
	 */
	function synonyms_output( $data = false ) {
		if( !$data ) {
			return;
		}
	
		$data = maybe_unserialize( $data );
		echo implode( ', ', $data );
	}

	/**
	 * Trim function
	 * 
	 * @since 4.0.0
	 * @param string $v The string that needs trimming
	 */
	function trim( &$v ) {
		$v = trim( $v );
	}
	
	/**
	 * Serialize the old synonyms
	 * 
	 * @since 4.0.0
	 */
	function update_synonyms() {
		global $wpdb;
		$table_name = $wpdb->prefix . $this->plugin_slug_safe;
		
		foreach( $this->get_all_entries() as $entry ) {
			$arrasy_synonyms = array();
			if( !empty( $entry->synonyms_and_forms ) ) {
				$array_synonyms = explode(',', $entry->synonyms_and_forms );
				array_walk( $array_synonyms, array( 'self' , 'trim' ) );
				$array_synonyms = array_unique( $array_synonyms );
			}
			$update = $wpdb->update( $table_name, array(
					'word' => stripcslashes( $entry->word ), 'synonyms_and_forms' => maybe_serialize( $array_synonyms ), 'explanation' => stripcslashes( $entry->explanation ), 'status' => 1
			), array(
					'id' => $entry->id
			), array(
					'%s', '%s', '%s', '%d'
			), array(
					'%d'
			) );
		}
	}
}