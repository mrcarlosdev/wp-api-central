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
function deactivate_wp_api_central() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-api-central-deactivator.php';
	WP_API_Central_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_api_central' );
register_deactivation_hook( __FILE__, 'deactivate_wp_api_central' );

/**
 * The code that makes the visible the plugin within the Wordpress menu.
 */
function menu_wp_api_central() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-api-central-menu.php';
	WP_API_Central_Menu::display();
}

add_action( 'admin_menu', 'menu_wp_api_central' );

function enqueue_bootstrap_js_wp_api_central($hook) {
    if ($hook != 'wp-api-central/admin/view-connection-provider-page.php') {
            return;
    }
    wp_enqueue_script('bootstrapJs',plugins_url('/node_modules/bootstrap/dist/js/bootstrap.min.js',__FILE__),array('jquery'));
}

function enqueue_bootstrap_css_wp_api_central($hook) {
    if ($hook != 'wp-api-central/admin/view-connection-provider-page.php') {
            return;
    }
    wp_enqueue_style('bootstrapCss',plugins_url('/node_modules/bootstrap/dist/css/bootstrap.min.css',__FILE__));
}

function EnqueueCustomJS($hook) {
    if ($hook != 'wp-api-central/admin/view-connection-provider-page.php') {
            return;
    }
        wp_enqueue_script('customJs',plugins_url('/admin/js/view-connection-provider-page.js',__FILE__),array('jquery'));
    wp_localize_script('customJs','AjaxRequest',[
                'url' => admin_url('admin-ajax.php'),
                'security' => wp_create_nonce('sec')
        ]);

        wp_localize_script('customJs','AjaxRequestAPIM',[
                'url' => '',
                'security' => wp_create_nonce('sec')
        ]);
}

add_action('admin_enqueue_scripts','enqueue_bootstrap_js_wp_api_central');
add_action('admin_enqueue_scripts','enqueue_bootstrap_css_wp_api_central');
add_action('admin_enqueue_scripts','EnqueueCustomJS');
