<?php
/**
 * Define the customizer options
 *
 * @link       getbowtied.com
 * @since      1.0.0
 * @package    HMU
 * @subpackage HMU/includes
 * @author     GetBowtied 
 */

add_action( 'admin_enqueue_scripts', 'enqueue_customizer_styles' );
function enqueue_customizer_styles() {
	wp_enqueue_script( 'hmu-customizer-scripts', plugins_url( 'includes/customizer/js/hmu-go-to-page.js', dirname( __FILE__ ) ), array( 'jquery' ), '1.0', false );
	wp_enqueue_style( 'hmu-customizer-styles', plugins_url( 'includes/customizer/css/customizer.css', dirname( __FILE__ ) ), array(), '1.0', false );
}

// Customizer
add_action( 'customize_register', 'hookmeup_sections' );
function hookmeup_sections( $wp_customize ) {

	// Woocommerce Hooks
	$wp_customize->add_panel( 'hookmeup_section' , array(
	    'title'      => esc_attr__('WooCommerce Hooks', 'hookmeup'),
	    'priority'   => 10,
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

    // Checkout
    $wp_customize->add_section( 'hookmeup_checkout_section', array(
 		'title'       => esc_attr__('Checkout', 'hookmeup'),
 		'priority'    => 10,
 		'panel'       => 'hookmeup_section',
 	) );

    // My Account / Login
    $wp_customize->add_section( 'hookmeup_account_section', array(
 		'title'       => esc_attr__('My Account', 'hookmeup'),
 		'priority'    => 10,
 		'panel'       => 'hookmeup_section',
 	) );

    // Hook Controls
	$hooks  = new HMU_Hooks();
	$hook_sections = $hooks->get_hook_sections();

	foreach( $hook_sections as $section ) {
		$section_hooks = $hooks->get_hooks( $section );

		$wp_customize->add_setting( $section . '_preview', array(
			'default'    => '1',
			'capability' => 'manage_options',
			'transport' => 'refresh',
		) );

		$wp_customize->add_control( new WP_Customize_Toggle_Control( $wp_customize, $section . '_preview', array(
			'type'        => 'light',
			'label'       => esc_attr__( 'Preview Available Hooks', 'hookmeup' ),
			'section'     => $section,
			//'tooltip'     => esc_attr__( 'They will only be visible while logged in as admin.', 'hookmeup' ),
			'priority'    => 10,
		) ) );

	    foreach( $section_hooks as $hook ) {

	    	$wp_customize->add_setting( $hook['slug'] . '_collapsible', array(
				'transport'  => 'postMessage',
				'capability' => 'edit_theme_options'
			) );

			$wp_customize->add_control( new WP_Customize_Collapsible_Control( $wp_customize, $hook['slug'] . '_collapsible', array(
				'section' 			=> $hook['section'],
				'label'				=> $hook['label'],
				'slug'				=> $hook['slug'],
				'priority'			=> 10,
			) ) );

			$wp_customize->add_setting( $hook['slug'] . '_editor', array(
				'transport' => 'refresh',
				'default' => '',
			) );

	     	$wp_customize->add_control( new WP_Customize_Editor_Control( $wp_customize, $hook['slug'] . '_editor', array(
				'section' 			=> $hook['section'],
				'label'				=> $hook['label'],
				'priority'			=> 10,
				'editor_settings' 	=> array(
					'quicktags' => true,
					'tinymce'   => true,
				),
			) ) );
		}
	}
}

// Generate customizer Go-To-Page URL
add_action( 'wp_ajax_get_customize_section_url', 'get_customize_section_url' );
function get_customize_section_url() {

	switch($_POST['page']) {
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
			echo get_permalink( $products[0]->get_id() ); 
			break;
		default:
			echo get_home_url();
			break;
	}
	exit();
}