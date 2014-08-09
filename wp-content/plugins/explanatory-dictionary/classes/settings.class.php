<?php
/**
 * Explanatory Dictionary.
 *
 * @package   Explanatory_Dictionary
 * @author    Robert-John van Doesburg <info@rjvandoesburg.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2013 Robert-John van Doesburg
 */

/**
 * Plugin class.
 *
 * @package Explanatory_Dictionary
 * @author Robert-John van Doesburg <info@rjvandoesburg.com>
 */
class Explanatory_Dictionary_Settings extends Explanatory_Dictionary {
	
	protected $external_css_file = 'no';
	protected $width = '200px';
	protected $text_align = 'justify';
	protected $font_size = '12px';
	protected $color = '#000000';
	protected $title_font_size = '16px';
	protected $title_color = '#000000';
	protected $title_font_style = 'normal';
	protected $title_font_weight = 'normal';
	protected $title_text_decoration = 'none';
	protected $border_size = '1px';
	protected $border_color = '#214579';
	protected $background = '#FFFDF7';
	protected $padding = '5px 10px';
	protected $border_radius = '5px';
	protected $word_color = '#750909';
	protected $word_font_style = 'normal';
	protected $word_font_weight = 'normal';
	protected $usedletters = '';
	protected $word_text_decoration = 'none';
	protected $unicode = 'no';
	protected $exclude = '-1';
	protected $limit = -1;
	protected $alphabet = 'A B C D E F G H I J K L M N O P Q R S T U V W X Y Z';
	protected $settings_list;
	
	/**
	 * Instance of this class.
	 *
	 * @since 1.0.0
	 *       
	 * @var object
	 */
	protected static $instance = null;
	
	/**
	 * Initialize the plugin by setting localization, filters, and
	 * administration functions.
	 *
	 * @since 1.0.0
	 */
	private function __construct() {
		// Load the template class from the parent
		add_action( 'init', array(
				$this, 'start'
		) );
	}
	
	/**
	 * Return an instance of this class.
	 *
	 * @since 1.0.0
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
	
	public function start() {
		$this->create_settings_list();
		
		$this->add_default_options();
		$this->load_user_settings();
	}
	
	public function create_settings_list() {
		$this->settings_list = array(
			'_external_css_file' => $this->external_css_file,
			'_width' => $this->width,
			'_text_align' => $this->text_align,
			'_font_size' => $this->font_size,
			'_color' => $this->color,
			'_title_font_size' => $this->title_font_size,
			'_title_color' => $this->title_color,
			'_title_font_style' => $this->title_font_style,
			'_title_font_weight' => $this->title_font_weight,
			'_title_text_decoration' => $this->title_text_decoration,
			'_border_size' => $this->border_size,
			'_border_color' => $this->border_color,
			'_background' => $this->background,
			'_padding' => $this->padding,
			'_border_radius' => $this->border_radius,
			'_word_color' => $this->word_color,
			'_word_font_style' => $this->word_font_style,
			'_word_font_weight' => $this->word_font_weight,
			'_usedletters' => $this->usedletters,
			'_word_text_decoration' => $this->word_text_decoration,
			'_unicode' => $this->unicode,
			'_exclude' => $this->exclude,
			'_limit' => $this->limit,
			'_alphabet' => $this->alphabet,
		);
	}
	
	public function add_default_options() {
		add_option( $this->plugin_slug_safe . '_settings', $this->settings_list );
	}
	
	public function reset_settings() {
		$this->create_settings_list();
		
		$this->update_settings( $this->settings_list );
	}
	
	public function load_user_settings() {	

		$this->settings_list = get_option( $this->plugin_slug_safe . '_settings' );
	}
	
	public function get_settings_list() {
		$this->load_user_settings();
		
		return $this->settings_list;
	}
	
	public function update_settings( $settings ) {
		if ( ! is_array( $settings ) ) {
			return false;
		}
		update_option( $this->plugin_slug_safe . '_settings', $settings );
		
		return true;
	}
	
	public function migrate_old_settings() {
		$old_settings = get_option($this->plugin_slug_safe . '_settings');
		$new_settings = array();
		foreach ( $old_settings as $key => $value ) {
			$new_key = str_replace( $this->plugin_slug_safe, '', $key );
			$new_settings[ $new_key ] = $value;
		}
		update_option( $this->plugin_slug_safe . '_settings', $new_settings );
	}
	
}


















