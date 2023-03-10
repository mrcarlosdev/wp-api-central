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
class WP_API_Central_Menu {

	/**
	 * Display the plugin within the Wordpress menu
	 *
	 * @since    1.0.0
	 */
	public static function display() {

		add_menu_page(
			'WP API Central', // Title of the page
			'WP API Central', // Text to show on the menu link
			'manage_options', // Capability requirement to see the link
					plugin_dir_path( __DIR__ ) . 'admin/view-connection-provider-page.php', // slug
					null, // content function
					plugins_url('/../admin/icons/wp-api-central-menu-logo.png', __FILE__), // icon
					'1'
		  );

		  add_submenu_page(plugin_dir_path( __DIR__ ) . 'admin/view-connection-provider-page.php', 'Widgets', 'Widgets', 'manage_options', plugin_dir_path( __DIR__ ) . 'admin/view-widgets-page.php');
	}
}
