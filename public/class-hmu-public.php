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
	 * Transforms boolean into string
	 *
	 * @since 1.2.2
	 *
	 * @return string
	 */
	public function hookmeup_boolean_to_string( $bool ) {
		$bool = is_bool( $bool ) ? $bool : ( 'yes' === $bool || 1 === $bool || 'true' === $bool || '1' === $bool );

		return true === $bool ? 'yes' : 'no';
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

			if( !isset($hook['slug']) || !isset($hook['section']) || !isset($hook['priority']) ) {
				continue;
			}

		    add_action( $hook['slug'], function() use ($hook) {

		    	$option_section = $this->hookmeup_boolean_to_string( get_option( 'hookmeup_' . $hook['section'] . '_preview', 'no' ) );
		        $option_content = get_option( 'hookmeup_' . $hook['slug'] . '_editor', '' );

		        if( isset($option_content) && !empty($option_content) ) {

			        echo '<div id="' . $hook['slug'] . '" class="hmu-hook">' . do_shortcode(__( $option_content, 'hookmeup' )) . '</div>';

			    } else if( $option_section == 'yes' && is_user_logged_in() && ( current_user_can( 'edit_theme_options' ) ) ) {

			        echo '<div id="' . $hook['slug'] . '" class="hmu-hook"><p class="hook">' . $hook['slug'] . '</p></div>';

			    }

		    }, $hook['priority'] );
		}
	}

}
