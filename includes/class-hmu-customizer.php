<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       getbowtied.com
 * @since      1.2
 * @package    HMU
 * @subpackage HMU/includes/customizer
 */

class HookMeUp_Customizer {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.2
	 */
	public function __construct() {

		$this->add_hooks();
	}

	/**
	 * Add hooks.
	 *
	 * @since 1.2
	 *
	 * @return void
	 */
	protected function add_hooks() {

		add_action( 'customize_register', array( $this, 'define_hmu_sections' ) );
		add_action( 'customize_register', array( $this, 'define_hmu_controls' ) );
		add_action( 'wp_ajax_get_hmu_customize_section_url', array( $this, 'get_hmu_customize_section_url' ) );
	}

	/**
	 * Define customizer sections
	 *
	 * @since 1.2
	 *
	 * @return void
	 */
	public function define_hmu_sections( $wp_customize ) {

		// Woocommerce Hooks
		$wp_customize->add_panel( 'hookmeup_section' , array(
		    'title'      => esc_attr__('WooCommerce Hooks', 'hookmeup'),
		    'priority'   => 10,
		) );

		// Plugin Settings
	    $wp_customize->add_section( 'hookmeup_settings_section', array(
	 		'title'       => esc_attr__('Settings', 'hookmeup'),
	 		'priority'    => 9,
	 		'panel'       => 'hookmeup_section',
	 	) );

		// Shop Archives
	    $wp_customize->add_section( 'hookmeup_shop_section', array(
	 		'title'       => esc_attr__('Shop Archives', 'hookmeup'),
	 		'priority'    => 10,
	 		'panel'       => 'hookmeup_section',
	 	) );

	 	// Single Product
	    $wp_customize->add_section( 'hookmeup_product_section', array(
	 		'title'       => esc_attr__('Product Page', 'hookmeup'),
	 		'priority'    => 10,
	 		'panel'       => 'hookmeup_section',
	 	) );

	    // Cart
	    $wp_customize->add_section( 'hookmeup_cart_section', array(
	 		'title'       => esc_attr__('Cart', 'hookmeup'),
	 		'priority'    => 10,
	 		'panel'       => 'hookmeup_section',
	 	) );

	 	// Cart Widget
	    $wp_customize->add_section( 'hookmeup_cart_widget_section', array(
	 		'title'       => esc_attr__('Cart Widget', 'hookmeup'),
	 		'priority'    => 10,
	 		'panel'       => 'hookmeup_section',
	 	) );

	 	// Thank You Page
	    $wp_customize->add_section( 'hookmeup_thankyou_section', array(
	 		'title'       => esc_attr__('Thank You Page', 'hookmeup'),
	 		'priority'    => 10,
	 		'panel'       => 'hookmeup_section',
	 	) );

	    // Checkout
	    $wp_customize->add_section( 'hookmeup_checkout_section', array(
	 		'title'       => esc_attr__('Checkout', 'hookmeup'),
	 		'priority'    => 10,
	 		'panel'       => 'hookmeup_section',
	 	) );

	    // Login / Register
	    $wp_customize->add_section( 'hookmeup_login_section', array(
	 		'title'       => esc_attr__('Login / Register', 'hookmeup'),
	 		'priority'    => 10,
	 		'panel'       => 'hookmeup_section',
	 	) );

	 	// My Account
	    $wp_customize->add_section( 'hookmeup_account_section', array(
	 		'title'       => esc_attr__('My Account', 'hookmeup'),
	 		'priority'    => 10,
	 		'panel'       => 'hookmeup_section',
	 	) );
	}

	/**
	 * Define customizer controls
	 *
	 * @since 1.2
	 * @since 1.2.4 split functionality into 2 functions
	 *
	 * @return void
	 */
	public function define_hmu_controls( $wp_customize ) {
		if( HookMeUp_User_Roles::user_is_admin() ) {
			$this->define_settings_controls( $wp_customize );
		}
		
		$this->define_sections_controls( $wp_customize );
	}

	/**
	 * Define settings controls
	 *
	 * @since 1.2.4
	 *
	 * @return void
	 */
	private function define_settings_controls( $wp_customize ) {

		$wp_customize->add_setting( 'hookmeup_user_roles_select', array(
				'default'           => array('editor'),
				'sanitize_callback' => 'HookMeUp_Customizer::hmu_sanitize_multi_checkbox'
			)
		);

		$wp_customize->add_control( new WP_Customize_Multi_Checkbox_Control( $wp_customize, 'hookmeup_user_roles_select', array(
					'section' => 'hookmeup_settings_section',
					'label'   => __( 'Grant Access to User Roles', 'hookmeup' ),
					'description' => __( 'Users having one of the selected user roles will be able to see hook previews and edit hooks.', 'hookeup' ),
					'choices' => HookMeUp_User_Roles::get_user_roles(),
				)
			)
		);
	}

	/**
	 * Define sections controls
	 *
	 * @since 1.2.4
	 *
	 * @return void
	 */
	private function define_sections_controls( $wp_customize ) {

		$hooks  = new HookMeUp_Hooks();
		$hook_sections = $hooks->get_hook_sections();

		foreach( $hook_sections as $section ) {
			$section_hooks = $hooks->get_hooks( $section['name'] );

			if( $section['preview'] ) {
				$wp_customize->add_setting( 'hookmeup_' . $section['name'] . '_preview', array(
					'type'		 			=> 'option',
					'default'    			=> 'no',
					'sanitize_callback'    	=> 'HookMeUp_Customizer::hmu_bool_to_string',
					'sanitize_js_callback' 	=> 'HookMeUp_Customizer::hmu_string_to_bool',
					'capability' 			=> 'manage_options',
					'transport'  			=> 'refresh',
				) );

				$wp_customize->add_control( new WP_Customize_Toggle_Control( $wp_customize, 'hookmeup_' . $section['name'] . '_preview', array(
					'label'       	=> esc_attr__( 'Preview Available Hooks', 'hookmeup' ),
					'description'	=> '<span>'. __( 'They will only be visible while logged in as admin.', 'hookmeup') .'</span>',
					'section'     	=> $section['name'],
					'priority'    	=> 10,
				) ) );
			}

			if( !empty($section['info']) ) {
				$wp_customize->add_setting( 'hookmeup_' . $section['name'] . '_info', array(
						'transport'  => 'refresh',
					) );

				$wp_customize->add_control( new WP_Customize_Info_Control( $wp_customize, 'hookmeup_' . $section['name'] . '_info', array(
					'section'     	=> $section['name'],
					'info'			=> $section['info'],
					'priority'    	=> 10,
				) ) );
			}

		    foreach( $section_hooks as $hook ) {

		    	$wp_customize->add_setting( 'hookmeup_' . $hook['slug'] . '_collapsible', array(
					'transport'  => 'refresh',
				) );

				$wp_customize->add_control( new WP_Customize_Collapsible_Control( $wp_customize, 'hookmeup_' . $hook['slug'] . '_collapsible', array(
					'section' 			=> $hook['section'],
					'label'				=> $hook['label'],
					'slug'				=> $hook['slug'],
					'priority'			=> 10,
				) ) );

				$wp_customize->add_setting( 'hookmeup_' . $hook['slug'] . '_editor', array(
					'type' 		 => 'option',
					'transport'  => 'refresh',
					'capability' => 'manage_options',
					'default' 	 => '',
				) );

		     	$wp_customize->add_control( new WP_Customize_Editor_Control( $wp_customize, 'hookmeup_' . $hook['slug'] . '_editor', array(
					'section' 			=> $hook['section'],
					'priority'			=> 10,
					'editor_settings' 	=> array(
						'quicktags' 	=> true,
						'tinymce'   	=> true,
						'mediaButtons' 	=> true
					),
				) ) );
			}
		}
	}

	/**
	 * Sanitize function converts boolean to string
	 *
	 * @since 1.2.4
	 *
	 * @return string
	 */
	public static function hmu_bool_to_string( $bool ) {
		$bool = is_bool( $bool ) ? $bool : ( 'yes' === $bool || 1 === $bool || 'true' === $bool || '1' === $bool );

		return true === $bool ? 'yes' : 'no';
	}

	/**
	 * Sanitize function converts string to boolean
	 *
	 * @since 1.2.4
	 *
	 * @return boolean
	 */
	public static function hmu_string_to_bool( $string ) {
		return is_bool( $string ) ? $string : ( 'yes' === $string || 1 === $string || 'true' === $string || '1' === $string );
	}

	/**
	 * Sanitize function for multi checkbox
	 *
	 * @since 1.2.4
	 *
	 * @return string
	 */
	public static function hmu_sanitize_multi_checkbox( $values ) {
		$multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;

		return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
	}

	/**
	 * Retrieve preview url for the current section
	 *
	 * @since 1.2
	 *
	 * @return void
	 */
	private function get_hmu_customize_section_url() {

		switch( $_POST['page'] ) {
			case 'shop':
				echo get_permalink( wc_get_page_id( 'shop' ) );
				break;
			case 'cart':
				echo wc_get_cart_url();
				break;
			case 'checkout':
				echo wc_get_checkout_url();
				break;
			case 'account':
				echo get_permalink( get_option('woocommerce_myaccount_page_id') );
				break;
			case 'product':
				$args = array('orderby' => 'rand', 'limit' => 1);
				$products = wc_get_products($args);
				if( $products[0] ) {
					echo get_permalink( $products[0]->get_id() );
				} else {
					echo get_permalink( wc_get_page_id( 'shop' ) );
				}
				break;
			default:
				echo get_home_url();
				break;
		}
		exit();
	}
}
