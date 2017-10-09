<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              getbowtied.com
 * @since             1.0.0
 * @package           Hookmeup
 *
 * @wordpress-plugin
 * Plugin Name:       Hook Me Up – Easy Hooks for WooCommerce
 * Plugin URI:        hookmeup.wp-theme.design
 * Description:       Helps you customize WooCommerce templates without altering the code.
 * Version:           1.0.0
 * Author:            GetBowtied
 * Author URI:        getbowtied.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hookmeup
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'HookMeUp' ) ) :

/**
 * Main HookMeUp Class.
 *
 * @class HookMeUp
 * @version	1.0
 */
final class HookMeUp {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @access   protected
	 * @var      Hookmeup_Loader    $loader    Maintains and registers all hooks for the plugin.
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
	 * @var HookMeUp
	 */
	protected static $_instance = null;

	/**
	 * HookMeUp Constructor.
	 */
	public function __construct() {

		$this->includes();

		$this->loader = new Hookmeup_Loader();
		
		$this->init_hooks();

		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Main HookMeUp Instance.
	 *
	 * Ensures only one instance of HookMeUp is loaded or can be loaded.
	 *
	 * @static
	 * @return HookMeUp - Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Hook into actions and filters.
	 */
	private function init_hooks() {
		register_activation_hook( __FILE__, array( 'HookMeUp', 'activate_hookmeup' ) );
		register_deactivation_hook( __FILE__, array( 'HookMeUp', 'deactivate_hookmeup' ) );
		add_action( 'admin_init', array( 'HookMeUp', 'verify_woocommerce' ) );
	}

	/**
	 * The code that runs during plugin activation.
	 * This action is documented in includes/class-hookmeup-activator.php
	 */
	public static function activate_hookmeup() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-hookmeup-activator.php';
		Hookmeup_Activator::activate();
	}

	/**
	 * The code that runs during plugin deactivation.
	 * This action is documented in includes/class-hookmeup-deactivator.php
	 */
	public static function deactivate_hookmeup() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-hookmeup-deactivator.php';
		Hookmeup_Deactivator::deactivate();
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 * Load the required dependencies for this plugin.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 */
	public function includes() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-hookmeup-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-hookmeup-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( __FILE__ ) . 'admin/class-hookmeup-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( __FILE__ ) . 'public/class-hookmeup-public.php';

		/**
		 * The class responsible for checking if WooCommerce plugin is installed and activated
		 */
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-hookmeup-dependencies.php';

		/**
		 * Defines the customizer options 
		 */
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-hookmeup-customizer.php';

		/**
		 * The class responsible for defining and retrieving all the hooks that can be modified
		 */
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-hookmeup-hooks.php';
	}

	/**
	 * Verifies if WooCommerce plugin is installed and activated
	 * 
	 */
	public static function verify_woocommerce() {
	    $verifier = new Hookmeup_Verify_Dependencies();
	    $verifier->verify_woocommerce();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Hookmeup_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Hookmeup_i18n();

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

		$plugin_admin = new Hookmeup_Admin( $this->get_plugin_name(), $this->get_version() );

		add_action( 'admin_enqueue_scripts', array( $plugin_admin, 'enqueue_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $plugin_admin, 'enqueue_scripts' ) );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Hookmeup_Public( $this->get_plugin_name(), $this->get_version() );

		add_action( 'wp_enqueue_scripts', array( $plugin_public, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $plugin_public, 'enqueue_scripts' ) );

		// generate all of the registered hooks
		$plugin_public->generate_hooks();
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
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Hookmeup_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
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
 * Main instance of HookMeUp.
 *
 * Returns the main instance of WC to prevent the need to use globals.
 *
 * @return HookMeUp
 */
function hookmeup() {
	return HookMeUp::instance();
}

hookmeup();

