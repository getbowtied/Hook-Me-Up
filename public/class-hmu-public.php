<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       getbowtied.com
 * @since      1.0.0
 *
 * @package    HMU
 * @subpackage HMU/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    HMU
 * @subpackage HMU/public
 * @author     GetBowtied <adi@getbowtied.com>
 */
class HMU_Public {

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

		// generate all of the registered hooks
		$this->generate_hooks();
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
	
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/hmu-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/hmu-public.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Generate hook divs in every page
	 */
	public function generate_hooks() {

		$hooks = new HMU_Hooks();
		$hooks_list = $hooks->get_all_hooks();

		foreach( $hooks_list as $hook) {

		    add_action( $hook['hook'], function() use ($hook) {
 
		    	$hook_name = $hook['hook'];

		    	$option_toggle	= get_theme_mod( $hook_name . '_toggle', false );
		    	$option_section = get_theme_mod( $hook['section'] . '_preview', true );
		        $option_content = get_theme_mod( $hook_name . '_editor', '' );

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
