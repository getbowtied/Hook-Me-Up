<?php

/**
 * Plugin Name:       		Hook Me Up – Easy Hooks for WooCommerce
 * Plugin URI:        		hookmeup.wp-theme.design
 * Description:       		Helps you customize WooCommerce templates without altering the code.
 * Version:           		1.0.0
 * Author:            		GetBowtied
 * Author URI:        		getbowtied.com
 * License:           		GPL-2.0+
 * License URI:       		http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       		hookmeup
 * Domain Path:       		/languages
 * WC requires at least: 	3.0.0 
 * WC tested up to: 		3.2.0 
 *
 * @link              getbowtied.com
 * @since             1.0.0
 * @package           HMU
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! defined( 'HMU_DIR' ) ) {
    define( 'HMU_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! function_exists( 'is_plugin_active' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

if ( ! class_exists( 'HMU' ) ) :

/**
 * HMU
 * @version	1.0
 */
final class HMU {

	/**
	 * Maintaining and registering all hooks that power the plugin.
	 *
	 * @access protected
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name = "hookmeup";

	/**
	 * The current version of the plugin.
	 *
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version = '1.0.0';

	/**
	 * The single instance of the class.
	 *
	 * @var HMU
	 */
	protected static $_instance = null;

	public function __construct() {

		if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			$this->includes();
			$this->loader = new HMU_Loader();
			$this->set_locale();
			$this->define_admin_hooks();
			$this->define_public_hooks();  
	    } else {
	    	add_action( 'admin_notices', array( $this, 'woocommerce_not_installed_warning' ) );
	    }
	}

	/**
	 * Main HMU Instance.
	 *
	 * Ensures only one instance of HMU is loaded or can be loaded.
	 *
	 * @static
	 * @return HMU - Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 */
	public function includes() {

		require_once( HMU_DIR . 'includes/class-hmu-loader.php' );
		require_once( HMU_DIR . 'includes/class-hmu-i18n.php' );
		require_once( HMU_DIR . 'admin/class-hmu-admin.php' );
		require_once( HMU_DIR . 'public/class-hmu-public.php' );
		require_once( HMU_DIR . 'includes/class-hmu-hooks.php' );
		require_once( HMU_DIR . 'includes/functions-hmu-customizer.php' );
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the HMU_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {
		$plugin_i18n = new HMU_i18n();
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new HMU_Admin( $this->get_plugin_name(), $this->get_version() );

		add_action( 'admin_enqueue_scripts', array( $plugin_admin, 'enqueue_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $plugin_admin, 'enqueue_scripts' ) );

		add_action( 'wp_ajax_get_url', array( $plugin_admin, 'get_url' ) );
		add_action( 'wp_ajax_nopriv_get_url', array( $plugin_admin, 'get_url' ) );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new HMU_Public( $this->get_plugin_name(), $this->get_version() );

		add_action( 'wp_enqueue_scripts', array( $plugin_public, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $plugin_public, 'enqueue_scripts' ) );
	}

	public function woocommerce_not_installed_warning() {

	?>
		<div class="message error woocommerce-admin-notice woocommerce-st-inactive woocommerce-not-configured">
			<p><?php echo esc_html_e( 'Hook Me Up is enabled but not effective. It requires WooCommerce in order to work.', 'hookmeup' ); ?></p>
		</div>
		
	<?php
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    HMU_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}

endif;

/**
 * Main instance of HMU.
 *
 * Returns the main instance of WC to prevent the need to use globals.
 *
 * @return HMU
 */
function hookmeup() {
	return HMU::instance();
}

hookmeup();

