<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/shaon-hossain45/
 * @since             1.0.0
 * @package           Delivery_Date_Manager
 *
 * @wordpress-plugin
 * Plugin Name:       Delivery Date Manager
 * Plugin URI:        https://github.com/shaon-hossain45/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            shaon
 * Author URI:        https://github.com/shaon-hossain45/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       delivery-date-manager
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'DELIVERY_DATE_MANAGER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-delivery-date-manager-activator.php
 */
function activate_delivery_date_manager() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-delivery-date-manager-activator.php';
	Delivery_Date_Manager_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-delivery-date-manager-deactivator.php
 */
function deactivate_delivery_date_manager() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-delivery-date-manager-deactivator.php';
	Delivery_Date_Manager_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_delivery_date_manager' );
register_deactivation_hook( __FILE__, 'deactivate_delivery_date_manager' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-delivery-date-manager.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_delivery_date_manager() {

	$plugin = new Delivery_Date_Manager();
	$plugin->run();

}
run_delivery_date_manager();
