<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/shaon-hossain45/
 * @since      1.0.0
 *
 * @package    Delivery_Date_Manager
 * @subpackage Delivery_Date_Manager/public
 */

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/delivery-date-manager-public-display.php';

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Delivery_Date_Manager
 * @subpackage Delivery_Date_Manager/public
 * @author     shaon <shaonhossain615@gmail.com>
 */
class Delivery_Date_Manager_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		/**
		 * Delivery Date Hooks class
		 */
		$deliverydatehooks_obj = new DeliveryDateHooks();

		$this->dispatch_actions( $deliverydatehooks_obj );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Delivery_Date_Manager_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Delivery_Date_Manager_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( 'jquery-ui', 'https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css', array(), '1.13.1', 'all' );

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/delivery-date-manager-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Delivery_Date_Manager_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Delivery_Date_Manager_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.6.0.js', array( 'jquery' ), '3.6.0', false );
		wp_enqueue_script( 'jquery-ui', 'https://code.jquery.com/ui/1.13.1/jquery-ui.js', array( 'jquery' ), '1.13.1', false );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/delivery-date-manager-public.js', array( 'jquery' ), $this->version, false );

	}


	/**
	 * Action dispatch
	 *
	 * @param  [type] $addressbook [description]
	 * @return [type]              [description]
	 */
	public function dispatch_actions( $data ) {

		// remove action adjust
		//add_action( 'wp_head', array( $data, 'change_proceed_to_checkout' ) );

		add_action( 'woocommerce_before_add_to_cart_button', array( $data, 'deliveryoptions_filed' ), 10 );
		add_action( 'woocommerce_add_cart_item_data', array( $data, 'deliveryoptions_filed_to_cart_item' ), 10, 3 );
		add_filter( 'woocommerce_get_item_data', array( $data, 'deliveryoptions_filed_display_text_cart' ), 10, 2 );
		add_action( 'woocommerce_checkout_create_order_line_item', array( $data, 'iconic_add_engraving_text_to_order_items' ), 10, 4 );
		add_filter( 'woocommerce_add_to_cart_validation', array( $data, 'bbloomer_only_one_in_cart' ), 9999, 2 );
		add_filter('woocommerce_billing_fields', array( $data, 'custom_woocommerce_billing_fields') );
		add_action( 'woocommerce_proceed_to_checkout', array( $data, 'change_proceed_to_checkout' ), 15 );

		add_action('wp_footer', array( $data, 'customer_notes_jquery' ) );

	}

}
