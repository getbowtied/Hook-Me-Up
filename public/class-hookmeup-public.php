<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       getbowtied.com
 * @since      1.0.0
 *
 * @package    Hookmeup
 * @subpackage Hookmeup/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Hookmeup
 * @subpackage Hookmeup/public
 * @author     GetBowtied <adi@getbowtied.com>
 */
class Hookmeup_Public {

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
		 * defined in Hookmeup_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Hookmeup_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
	
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/hookmeup-public.css', array(), $this->version, 'all' );
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
		 * defined in Hookmeup_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Hookmeup_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/hookmeup-public.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Generate hook divs in every page
	 */
	public function generate_hooks() {

		//var_dump(get_theme_mods());

		$hooks = new Hookmeup_Hooks();
		$hooks_list = $hooks->get_all_hooks();

		foreach( $hooks_list as $hook) {

		    add_action( $hook['hook'], function() use ($hook) {
 
		    	$hook_name = $hook['hook'];
		    	$hook_section = $hook['section'];

		    	$option_section = get_theme_mod($hook_section . '_preview', true);
		        $option_toggle  = get_theme_mod($hook_name, false);
		        $option_content = get_theme_mod($hook_name . '_editor', '');

		        if( $option_section ) {

			        echo '<div id="' . $hook_name . '">'; 

			        if( $option_toggle && $option_content ) {
			            echo $option_content;
			        } else {
			            echo '<p class="hook">' . $hook_name . '</p>';
			        }

			        echo '</div>';
			    } else {
			    	if( $option_toggle && $option_content ) {
			            echo $option_content;
			        }
			    }

		    }, 20 );
		}
	}

}
