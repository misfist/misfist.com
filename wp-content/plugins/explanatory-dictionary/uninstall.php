<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package   Dictionary_List
 * @author    Robert-John van Doesburg <info@rjvandoesburg.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2013 Robert-John van Doesburg
 */

// If uninstall, not called from WordPress, then exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// TODO: Define uninstall functionality here

global $wpdb;
$table_name = $wpdb->prefix . "dictionary_list";
$sql = "
	DROP TABLE `{$table_name}`
";
	
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );