<?php

/**
 * @link       https://github.com/mrcarlosdev/wp-api-central
 * @since      1.0.0
 *
 * @package    WP_API_Central
 * @subpackage WP_API_Central/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * @since      1.0.0
 * @package    WP_API_Central
 * @subpackage WP_API_Central/includes
 * @author     Carlos Pérez <mrcarlosdev@gmail.com>
 */
class WP_API_Central_Deactivator {

	/**
	 * Remove the database used by Azure provider (Azure API Management).
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

                if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
                exit();

                global $wpdb;

                $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}azure_config" );
	}
}