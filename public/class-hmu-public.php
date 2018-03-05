<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       getbowtied.com
 * @since      1.0.0
 * @package    HMU
 * @subpackage HMU/public
 */

class HMU_Public {

	/**
	 * The ID of this plugin.
	 * 
	 * @var string
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @var string
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		/**
		 * Generate all of the registered hooks
		 */
		$this->generate_hooks();
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 */
	public function enqueue_styles() {
	
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/hmu-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Generate hooks in frontend
	 */
	public function generate_hooks() {

		$hooks = new HMU_Hooks();
		$hooks_list = $hooks->get_all_hooks();

		foreach( $hooks_list as $hook) {

		    add_action( $hook['slug'], function() use ($hook) {
 
		    	$option_toggle	= get_theme_mod( $hook['slug'] . '_toggle', true );
		    	$option_section = get_theme_mod( $hook['section'] . '_preview', true );
		        $option_content = get_theme_mod( $hook['slug'] . '_editor', '' );

		        if( $option_toggle && isset($option_content) && $option_content != "" ) {

			        echo '<div id="' . $hook['slug'] . '" class="hmu-hook">' . $option_content . '</div>';

			    } else if( $option_section && is_user_logged_in() && ( is_admin() || is_super_admin() ) ) {

			        echo '<div id="' . $hook['slug'] . '" class="hmu-hook"><p class="hook">' . $hook['slug'] . '</p></div>';
			        
			    }

		    }, 20 );
		}
	}

}
