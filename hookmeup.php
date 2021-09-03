<?php

/**
 * Plugin Name:       		HookMeUp – Additional Content for WooCommerce
 * Plugin URI:        		https://wordpress.org/plugins/hookmeup/
 * Description:       		Helps you customize WooCommerce templates without altering the code.
 * Version:           		1.3.5
 * Author:            		GetBowtied
 * Author URI:        		https://getbowtied.com/
 * License:           		GPL-2.0+
 * License URI:       		http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       		hookmeup
 * Domain Path:       		/languages
 * Requires at least: 		5.0
 * Tested up to: 			5.8
 * WC requires at least: 	3.3.4
 * WC tested up to: 		5.6.0
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

if ( ! class_exists( 'HookMeUp' ) ) :

	/**
	 * HookMeUp class.
	 *
	 * @since 1.0.0.0
	 */
	class HookMeUp {

		/**
		 * Maintaining and registering all hooks that power the plugin.
		 *
		 * @since 1.0.0
		 * @access protected
		 */
		protected $loader;

		/**
		 * The unique identifier of this plugin.
		 *
		 * @since 1.0.0
		 * @var string
		 */
		protected $plugin_name = "hookmeup";

		/**
		 * The current version of the plugin.
		 *
		 * @since 1.0.0
		 * @var string
		 */
		protected $version = '1.2.1';

		/**
		 * The single instance of the class.
		 *
		 * @since 1.0.0
		 * @var HookMeUp
		 */
		protected static $_instance = null;

		/**
		 * HookMeUp constructor
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			/**
			 * Die if WooCommerce not installed/activated
			 */
			if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
				$this->includes();
				$this->add_hooks();
				$this->loader = new HookMeUp_Loader();
				$this->set_locale();
				$this->define_public_hooks();
				$this->define_customizer();
				if( !get_option( 'hookmeup_done_import', false ) ) {
					$done_import = $this->import_options();
					if( $done_import ) {
						update_option( 'hookmeup_done_import', true );
					}
				}
		    } else {
		    	add_action( 'admin_notices', array( $this, 'woocommerce_not_installed_warning' ) );
		    }
		}

		/**
		 * Ensures only one instance of HookMeUp is loaded or can be loaded.
		 *
		 * @since 1.0.0
		 *
		 * @return HookMeUp
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Imports hooks stored as theme mods into the options WP table
		 *
		 * @since 1.2.1
		 * @return void
		 */
		private function import_options() {
			$done_import = true;

			$hooks = new HookMeUp_Hooks();
			$hooks_list = $hooks->get_all_hooks();
			foreach( $hooks_list as $hook) {
				if( get_theme_mod( $hook['section'] . '_preview' ) ) {
					update_option( 'hookmeup_' . $hook['section'] . '_preview', get_theme_mod( $hook['section'] . '_preview', 'no' ) );
					if( get_option( 'hookmeup_' . $hook['section'] . '_preview' ) ) {
						remove_theme_mod( $hook['section'] . '_preview' );
					} else {
						$done_import = false;
					}
				}
				if( get_theme_mod( $hook['slug'] . '_editor' ) ) {
					update_option( 'hookmeup_' . $hook['slug'] . '_editor', get_theme_mod( $hook['slug'] . '_editor', '' ) );
					if( get_option( 'hookmeup_' . $hook['slug'] . '_editor' ) ) {
						remove_theme_mod( $hook['slug'] . '_editor' );
					} else {
						$done_import = false;
					}
				}
			}

			return $done_import;
		}

		/**
		 * Include required core files used in admin and on the frontend.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		protected function includes() {

			include_once( HMU_DIR . 'includes/customizer/class/class-hmu-editor.php' );
			include_once( HMU_DIR . 'includes/customizer/class/class-hmu-collapsible.php' );
			include_once( HMU_DIR . 'includes/customizer/class/class-hmu-toggle.php' );
			include_once( HMU_DIR . 'includes/customizer/class/class-hmu-info.php' );

			include_once( HMU_DIR . 'includes/class-hmu-loader.php' );
			include_once( HMU_DIR . 'includes/class-hmu-i18n.php' );
			include_once( HMU_DIR . 'includes/class-hmu-hooks.php' );
			include_once( HMU_DIR . 'includes/class-hmu-customizer.php' );

			include_once( HMU_DIR . 'public/class-hmu-public.php' );
		}

		/**
		 * Add hooks.
		 *
		 * @since 1.2
		 *
		 * @return void
		 */
		protected function add_hooks() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_customizer_styles' ) );
		}

		public function enqueue_customizer_styles() {

			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

			wp_enqueue_script( 'hmu-customizer-scripts',
				plugins_url( 'includes/customizer/assets/js/hmu-go-to-page.js', __FILE__ ),
				array( 'jquery' ),
				$this->get_version(),
				true
			);

			wp_enqueue_style( 'hmu-customizer-styles',
				plugins_url( "includes/customizer/assets/css/customizer{$suffix}.css", __FILE__ ),
				array(),
				$this->get_version(),
				false
			);
		}

		/**
		 * Define the locale for this plugin for internationalization.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		private function set_locale() {
			$plugin_i18n = new HookMeUp_i18n();
			$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'hookmeup' );
		}

		/**
		 * Register all of the hooks related to the public-facing functionality of the plugin.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		private function define_public_hooks() {

			$plugin_public = new HookMeUp_Public( $this->get_plugin_name(), $this->get_version() );
			add_action( 'wp_enqueue_scripts', array( $plugin_public, 'enqueue_styles' ) );
		}

		/**
		 * Register all of the hooks related to the customizer.
		 *
		 * @since 1.2
		 *
		 * @return void
		 */
		private function define_customizer() {

			$plugin_customizer = new HookMeUp_Customizer();
		}

		/**
		 * Display warning when WooCommerce not installed or activated
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		public function woocommerce_not_installed_warning() {
		?>
			<div class="message error woocommerce-admin-notice woocommerce-st-inactive woocommerce-not-configured">
				<p><?php echo esc_html_e( 'HookMeUp is enabled but not effective. It requires WooCommerce in order to work.', 'hookmeup' ); ?></p>
			</div>
		<?php
		}

		/**
		 * Run the loader to execute all of the hooks with WordPress.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		public function run() {
			$this->loader->run();
		}

		/**
		 * The reference to the class that orchestrates the hooks with the plugin.
		 */
		public function get_loader() {
			return $this->loader;
		}

		/**
		 * The name of the plugin used to uniquely identify it within the context of
		 * WordPress and to define internationalization functionality.
		 */
		public function get_plugin_name() {
			return $this->plugin_name;
		}

		/**
		 * Retrieve the version number of the plugin.
		 */
		public function get_version() {
			return $this->version;
		}

	}

endif;

$hookmeup = new HookMeUp;
