<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       getbowtied.com
 * @since      1.0.0
 * @package    HMU
 * @subpackage HMU/public
 */

class HookMeUp_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since 1.0.0
	 * 
	 * @var string
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
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
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function enqueue_styles() {
	
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/css/hmu-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Generate hooks in frontend
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function generate_hooks() {

		$hooks = new HookMeUp_Hooks();
		$hooks_list = $hooks->get_all_hooks();

		foreach( $hooks_list as $hook) {

		    add_action( $hook['slug'], function() use ($hook) {
 
		    	$option_section = get_option( $hook['section'] . '_preview', false );
		        $option_content = get_option( $hook['slug'] . '_editor', '' );

		        if( isset($option_content) && $option_content != "" ) {

			        echo '<div id="' . $hook['slug'] . '" class="hmu-hook">' . do_shortcode(__( $option_content, 'hookmeup' )) . '</div>';

			    } else if( $option_section && is_user_logged_in() && ( is_admin() || is_super_admin() ) ) {

			        echo '<div id="' . $hook['slug'] . '" class="hmu-hook"><p class="hook">' . $hook['slug'] . '</p></div>';
			        
			    }

		    }, 20 );
		}
	}

}
