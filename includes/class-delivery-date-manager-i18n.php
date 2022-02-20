<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/shaon-hossain45/
 * @since      1.0.0
 *
 * @package    Delivery_Date_Manager
 * @subpackage Delivery_Date_Manager/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Delivery_Date_Manager
 * @subpackage Delivery_Date_Manager/includes
 * @author     shaon <shaonhossain615@gmail.com>
 */
class Delivery_Date_Manager_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'delivery-date-manager',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
