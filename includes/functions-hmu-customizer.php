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

include_once( dirname( __FILE__ ) . '/kirki/kirki.php' );

add_filter( 'kirki/config', 'hookmeup_kirki_configuration' );
function hookmeup_kirki_configuration() {
    return array( 'url_path' => get_site_url() . '/wp-content/plugins/hookmeup/includes/kirki/' );
}

add_action( 'customize_register', 'hookmeup_kirki_sections' );
function hookmeup_kirki_sections( $wp_customize ) {

	// Woocommerce Hooks
	$wp_customize->add_panel( 'hookmeup_section', array(
		'priority'    => 10,
		'title'       => esc_attr__('WooCommerce Hooks', 'hookmeup'),
		'capability'  => 'edit_theme_options'
	) );

	// Shop Archives
     $wp_customize->add_section( 'hookmeup_shop_section', array(
 		'title'       => esc_attr__('Shop Archives', 'hookmeup'),
 		'priority'    => 10,
 		'capability'    => 'edit_theme_options',
 		'panel'       => 'hookmeup_section',
 	) );

     // Single Product
     $wp_customize->add_section( 'hookmeup_product_section', array(
 		'title'       => esc_attr__('Product Page', 'hookmeup'),
 		'priority'    => 10,
 		'capability'  => 'edit_theme_options',
 		'panel'       => 'hookmeup_section',
 	) );

     // Cart
     $wp_customize->add_section( 'hookmeup_cart_section', array(
 		'title'       => esc_attr__('Cart', 'hookmeup'),
 		'priority'    => 10,
 		'capability'  => 'edit_theme_options',
 		'panel'       => 'hookmeup_section',
 	) );

     // Checkout
     $wp_customize->add_section( 'hookmeup_checkout_section', array(
 		'title'       => esc_attr__('Checkout', 'hookmeup'),
 		'priority'    => 10,
 		'capability'  => 'edit_theme_options',
 		'panel'       => 'hookmeup_section',
 	) );

     // My Account / Login
     $wp_customize->add_section( 'hookmeup_account_section', array(
 		'title'       => esc_attr__('My Account', 'hookmeup'),
 		'priority'    => 10,
 		'capability'  => 'edit_theme_options',
 		'panel'       => 'hookmeup_section',
 	) );

}

add_filter( 'kirki/fields', 'hookmeup_fields' );
function hookmeup_fields( $wp_customize ) {

	$hooks  = new HMU_Hooks();

	$hook_sections = $hooks->get_hook_sections();
	$hooks 		   = $hooks->get_all_hooks();

	return hookmeup_kirki_fields( $wp_customize, $hooks, $hook_sections );
}

function hookmeup_kirki_fields( $wp_customize, $hooks, $hook_sections ) {

	$fields = [];

	foreach( $hook_sections as $section ) {

		$fields[] = array(
			'type'        => 'toggle',
			'settings'    => $section. '_preview',
			'label'       => esc_attr__( 'Preview Available Hooks', 'hookmeup' ),
			'section'     => $section,
			'default'     => true,
			'priority'    => 10,
		);
	}

	foreach( $hooks as $hook ) {

	    $fields[] = array(
			'type'        => 'toggle',
			'settings'    => $hook['hook'],
			'label'       => esc_attr__( $hook['label'], 'hookmeup' ),
			'section'     => $hook['section'],
			'default'     => false,
			'priority'    => 10
		);

		$fields[] = array(
			'type'        => 'editor',
			'transport'   => 'auto',
			'settings'    => $hook['hook'] . '_editor',
			'label'       => esc_attr__( 'Editor Control', 'hookmeup' ),
			'section'     => $hook['section'],
			'default'     => '',
			'priority'    => 10,
			'required'    => array(
				array(
					'setting'  => $hook['hook'],
					'operator' => '==',
					'value'    => true,
				)
			)
		);
	}

    return $fields;
}
?>