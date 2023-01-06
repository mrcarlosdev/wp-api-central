<?php

/**
 * @link       https://github.com/mrcarlosdev/wp-api-central
 * @since      1.0.0
 *
 * @package    WP_API_Central
 * @subpackage WP_API_Central/includes
 */

/**
 * Fired during plugin activation.
 *
 * @since      1.0.0
 * @package    WP_API_Central
 * @subpackage WP_API_Central/includes
 * @author     Carlos Pérez <mrcarlosdev@gmail.com>
 */
class WP_API_Central_Activator {

	/**
	 * Set up the database for using Azure provider (Azure API Management).
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

        global $wpdb;

        $sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}azure_config(
                `accessToken` VARCHAR(255) NULL,
                `subscriptionId` VARCHAR(255) NULL,
                `resourceGroup` VARCHAR(255) NULL,
                `serviceId` VARCHAR(255) NULL);";

        $wpdb->query($sql);

        $table = $wpdb->prefix."azure_config";       
        $wpdb->insert($table, array(
                'accessToken' => '',
                'subscriptionId' => '',
                'resourceGroup' => '', 
                'serviceId' => '',
        ));
        
	}
}