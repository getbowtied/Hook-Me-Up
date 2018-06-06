<?php
/**
 * Define the customizer options
 *
 * @link       getbowtied.com
 * @since      1.0.0
 * @package    HMU
 * @subpackage HMU/includes
 * @author     GetBowtied <adi@getbowtied.com>
 */

/**
 * Kirki config
 */
if ( !class_exists( 'Kirki' ) ) {
	include_once( dirname( __FILE__ ) . '/kirki/kirki.php' );

	add_filter( 'kirki/config', 'hookmeup_kirki_configuration', 999 );
	function hookmeup_kirki_configuration() {
	    return array( 'url_path' => get_site_url() . '/wp-content/plugins/hookmeup/includes/kirki/' );
	}
}

if ( class_exists( 'Kirki' ) ) {

	/**
	 * HMU customizer
	 */
	function generate_kirki_fields() {
		hookmeup_kirki_sections();
		hookmeup_kirki_fields();
	}

	/**
	 * Define Kirki sections
	 */
	function hookmeup_kirki_sections() {

		/**
		 * Woocommerce Hooks
		 */
		Kirki::add_panel( 'hookmeup_section', array(
			'priority'    => 10,
			'title'       => esc_attr__('WooCommerce Hooks', 'hookmeup'),
			'capability'  => 'edit_theme_options'
		) );

		/**
		 * Shop Archives
		 */
	     Kirki::add_section( 'hookmeup_shop_section', array(
	 		'title'       => esc_attr__('Shop Archives', 'hookmeup'),
	 		'priority'    => 10,
	 		'capability'  => 'edit_theme_options',
	 		'panel'       => 'hookmeup_section',
	 	) );

	     /**
	      * Single Product
	      */
	     Kirki::add_section( 'hookmeup_product_section', array(
	 		'title'       => esc_attr__('Product Page', 'hookmeup'),
	 		'priority'    => 10,
	 		'capability'  => 'edit_theme_options',
	 		'panel'       => 'hookmeup_section',
	 	) );

	     /**
	      * Cart
	      */
	     Kirki::add_section( 'hookmeup_cart_section', array(
	 		'title'       => esc_attr__('Cart', 'hookmeup'),
	 		'priority'    => 10,
	 		'capability'  => 'edit_theme_options',
	 		'panel'       => 'hookmeup_section',
	 	) );

	     /**
	      * Checkout
	      */
	     Kirki::add_section( 'hookmeup_checkout_section', array(
	 		'title'       => esc_attr__('Checkout', 'hookmeup'),
	 		'priority'    => 10,
	 		'capability'  => 'edit_theme_options',
	 		'panel'       => 'hookmeup_section',
	 	) );

	     /**
	      * My Account / Login
	      */
	     Kirki::add_section( 'hookmeup_account_section', array(
	 		'title'       => esc_attr__('My Account', 'hookmeup'),
	 		'priority'    => 10,
	 		'capability'  => 'edit_theme_options',
	 		'panel'       => 'hookmeup_section',
	 	) );

	     Kirki::add_section( 'hookmeup_test_section', array(
	 		'title'       => esc_attr__('Test Section', 'hookmeup'),
	 		'priority'    => 10,
	 		'capability'  => 'edit_theme_options',
	 		'panel'       => 'hookmeup_section',
	 		'active_callback' => array(
				array(
					'setting'  => 'hookmeup_account_section_preview',
					'operator' => '==',
					'value'    => false,
				)
			)
	 	) );

	     Kirki::add_field( 'hmu_field', array(
			'type'        => 'toggle',
			'settings'	  => $section. '_preview',
			'label'       => esc_attr__( 'Preview Available Hooks', 'hookmeup' ),
			'section'     => 'hookmeup_test_section',
			'default'     => false,
			'priority'    => 10,
		));
	}

	/**
	 * Define Kirki fields
	 */
	function hookmeup_kirki_fields() {

		$hooks  = new HMU_Hooks();
		$hook_sections = $hooks->get_hook_sections();

		foreach( $hook_sections as $section ) {
			$section_select_hooks = $hooks->get_select_hooks( $section );
			$section_hooks = $hooks->get_hooks( $section );
			hookmeup_fields( $section_hooks, $section_select_hooks, $section );
		}
	}

	/**
	 * Generate Kirki fields
	 */
	function hookmeup_fields( $hooks, $select_hooks, $section ) {

		Kirki::add_config( 'hmu_field', array(
			'capability'    => 'edit_theme_options',
			'option_type'   => 'theme_mod',
		) );

		Kirki::add_field( 'hmu_field', array(
			'type'        => 'switch',
			'settings'	  => $section. '_preview',
			'label'       => esc_attr__( 'Preview Available Hooks', 'hookmeup' ),
			'section'     => $section,
			'tooltip'        => esc_attr__( 'They will only be visible while logged in as admin.', 'hookmeup' ),
			'default'     => false,
			'priority'    => 10,
		));

	    foreach( $hooks as $hook ) {

	    	Kirki::add_field( 'hmu_field', array(
				'type'        => 'custom',
				'settings'    => $hook['slug'] . '_collapsible',
				'section'     => $hook['section'],
				'tooltip'	  => $hook['slug'],
				'default'     => '<div class="customize-control-collapsible"><span class="'.$hook['slug'].'"></span><h3><div></div>' . $hook['label'] . '</h3></div>',
				'priority'    => 10,
			));

			Kirki::add_field( 'hmu_field', array(
				'type'        => 'editor',
				'label'       => '',
				'section'     => $hook['section'],
				'settings'	  => $hook['slug'] . '_editor',
				'priority'    => 10,
			));
		}
	}

	generate_kirki_fields();
}

?>