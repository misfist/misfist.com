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
class Explanatory_Dictionary_Template extends Explanatory_Dictionary {
	
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
		// Load the settings class from the parent
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
		$this->settings = parent::get_instance()->settings;
	}
	
	/**
	 * Render the page for this plugin.
	 *
	 * @since 1.0.0
	 */
	public function display_plugin_admin_page() {
		if ( isset( $_GET['action'] ) && ! empty( $_GET['action'] ) ) {
			$action = $_GET['action'];
			switch ( $action ) {
				case 'add' :
					include_once ( DICTIONARY_VIEWS . 'admin-add.php' );
					break;
				case 'edit' :
					include_once ( DICTIONARY_VIEWS . 'admin-edit.php' );
					break;
				case 'delete' :
					$delete = $this->delete_entry( $_GET['item'] );
					$message = __( 'The entry has been deleted', $this->plugin_slug );
					$class = 'updated fade';
						
					if ( false === $delete ) {
						$message = __( 'An error has occured during deleting', $this->plugin_slug );
						$class = 'error fade';
					}
						
					include_once ( DICTIONARY_VIEWS . 'admin-list.php' );
					break;
			}
		} else if ( ( isset( $_POST['bulk-action'] ) && ! empty( $_POST['bulk-action'] ) ) || ( isset( $_POST['bulk-action-2'] ) && ! empty( $_POST['bulk-action-2'] ) ) ) {
			$action = ! empty( $_POST['bulk-action'] ) ? $_POST['bulk-action'] : $_POST['bulk-action-2'];
				
			switch ( $action ) {
				case 'bulk-active' :
					$errors = false;
					foreach ( $_POST['entries'] as $entry ) {
						if ( false === $this->set_entry_status( $entry, 1 ) ) {
							$errors = true;
						}
					}
					$message = __( 'The entries have been set to active', $this->plugin_slug );
					$class = 'updated fade';
						
					if ( true === $errors ) {
						$message = __( 'An error has occured during the update', $this->plugin_slug );
						$class = 'error fade';
					}
					break;
				case 'bulk-inactive' :
					$errors = false;
					foreach ( $_POST['entries'] as $entry ) {
						if ( false === $this->set_entry_status( $entry, 0 ) ) {
							$errors = true;
						}
					}
					$message = __( 'The entries have been set to inactive', $this->plugin_slug );
					$class = 'updated fade';
						
					if ( true === $errors ) {
						$message = __( 'An error has occured during the update', $this->plugin_slug );
						$class = 'error fade';
					}
						
					break;
				case 'bulk-delete' :						
					$errors = false;
					foreach ( $_POST['entries'] as $entry ) {
						if ( false === $this->delete_entry( $entry ) ) {
							$errors = true;
						}
					}
					$message = __( 'The entries have been deleted', $this->plugin_slug );
					$class = 'updated fade';
						
					if ( true === $errors ) {
						$message = __( 'An error has occured during deleting', $this->plugin_slug );
						$class = 'error fade';
					}
					break;
			}
				
			include_once ( DICTIONARY_VIEWS . 'admin-list.php' );
		} else {
			include_once ( DICTIONARY_VIEWS . 'admin-list.php' );
		}
	}
	
	/**
	 * Render the settings page for this plugin.
	 *
	 * @since 1.0.0
	 */
	public function display_plugin_admin_options_page() {
		include_once ( DICTIONARY_VIEWS . 'admin-options.php' );
	}
	
	public function display_explanatory_dictionary( $atts ) {
		include_once ( DICTIONARY_VIEWS . 'explanatory-dictionary.php' );
	}
}