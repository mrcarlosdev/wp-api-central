<?php

/**
 * @link              https://github.com/mrcarlosdev/wp-api-central
 * @since             1.0.0
 * @package           WP_API_Central
 *
 * @wordpress-plugin
 * Plugin Name:       WP API Central
 * Plugin URI:        https://github.com/mrcarlosdev/wp-api-central
 * Description:       WP API Central is a WordPress plugin that allows you to connect with cloud and gateway providers to access documentation for configured APIs. With WP API Central, you can view all relevant information about your APIs in one place, using WordPress as your documentation center.
 * Version:           1.0.0
 * Author:            Carlos Pérez
 * Author URI:        https://es.linkedin.com/in/mrcarlosdev
 * License:           MIT License
 * License URI:       https://github.com/mrcarlosdev/wp-api-central/blob/main/LICENSE
 * Text Domain:       wp-api-central
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 */
function activate_wp_api_central() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-api-central-activator.php';
    WP_API_Central_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_plugin_name() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-api-central-deactivator.php';
	WP_API_Central_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_api_central' );
register_deactivation_hook( __FILE__, 'deactivate_wp_api_central' );
