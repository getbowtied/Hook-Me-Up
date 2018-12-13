<?php

/**
 * Define the WooCommerce hooks
 *
 * @link       getbowtied.com
 * @since      1.0.0
 * @package    HMU
 * @subpackage HMU/includes
 * @author     GetBowtied
 */

class HookMeUp_Hooks {

	/**
	 * Archive hooks list
	 *
	 * @var array
	 *
	 * @since 1.0.0
	 */
	protected $archive_hooks;

	/**
	 * Cart hooks list
	 *
	 * @var array
	 *
	 * @since 1.0.0
	 */
	protected $cart_hooks;

	/**
	 * Checkout hooks list
	 *
	 * @var array
	 *
	 * @since 1.0.0
	 */
	protected $checkout_hooks;

	/**
	 * Account hooks list
	 *
	 * @var array
	 *
	 * @since 1.0.0
	 */
	protected $account_hooks;

	/**
	 * Single Product hooks list
	 *
	 * @var array
	 *
	 * @since 1.0.0
	 */
	protected $product_hooks;

	/**
	 * Thank You Page hooks list
	 *
	 * @var array
	 *
	 * @since 1.2
	 */
	protected $thankyou_hooks;

	/**
	 * Cart Widget hooks list
	 *
	 * @var array
	 *
	 * @since 1.2
	 */
	protected $cart_widget_hooks;

	/**
	 * Hook sections list
	 *
	 * @var array
	 *
	 * @since 1.0.0
	 */
	protected $hook_sections;

	/**
	 * HookMeUp_Hooks constructor
	 *
	 * @since 1.0.0
	 * @since 1.2 create separate functions for defining hook arrays
	 */
	public function __construct() {

		$this->define_hook_sections();
		$this->define_archive_hooks();
		$this->define_cart_hooks();
		$this->define_cart_widget_hooks();
		$this->define_thankyou_hooks();
		$this->define_checkout_hooks();
		$this->define_account_hooks();
		$this->define_product_hooks();
	}

	/**
	 * Define hook sections
	 *
	 * @since 1.2
	 *
	 * @return void
	 */
	protected function define_hook_sections() {

		$this->hook_sections = [ 
			'hookmeup_shop_section', 
			'hookmeup_product_section', 
			'hookmeup_cart_section', 
			'hookmeup_cart_widget_section',
			'hookmeup_thankyou_section',
			'hookmeup_checkout_section', 
			'hookmeup_account_section'
		];
	}

	/**
	 * Define archive hooks
	 *
	 * @since 1.2
	 *
	 * @return void
	 */
	protected function define_archive_hooks() {

		$this->archive_hooks = [
			[
				'slug'		=> 'woocommerce_before_main_content', 
				'label'		=> 'Before Main Content',
				'section'	=> 'hookmeup_shop_section'
			],
			[
				'slug'		=> 'woocommerce_before_shop_loop', 
				'label'		=> 'Before Shop Loop',
				'section'	=> 'hookmeup_shop_section'
			],
			[
				'slug' 		=> 'woocommerce_before_shop_loop_item', 
				'label' 	=> 'Before Shop Loop Item',
				'section' 	=> 'hookmeup_shop_section'
			],
			[
				'slug' 		=> 'woocommerce_before_shop_loop_item_title', 
				'label' 	=> 'Before Shop Loop Item Title',
				'section' 	=> 'hookmeup_shop_section'
			],
			[
				'slug'		=> 'woocommerce_after_shop_loop_item_title', 
				'label' 	=> 'After Shop Loop Item Title',
				'section'	=> 'hookmeup_shop_section'
			],
			[
				'slug'		=> 'woocommerce_after_shop_loop_item', 
				'label'	 	=> 'After Shop Loop Item',
				'section' 	=> 'hookmeup_shop_section'
			],
			[
				'slug' 		=> 'woocommerce_after_shop_loop', 
				'label' 	=> 'After Shop Loop',
				'section' 	=> 'hookmeup_shop_section'
			],
			[
				'slug' 		=> 'woocommerce_after_main_content', 
				'label' 	=> 'After Main Content',
				'section' 	=> 'hookmeup_shop_section'
			]
		];
	}

	/**
	 * Define cart hooks
	 *
	 * @since 1.2
	 *
	 * @return void
	 */
	protected function define_cart_hooks() {

		$this->cart_hooks = [
			[
				'slug' 		=> 'woocommerce_before_cart', 
				'label' 	=> 'Before Cart',
				'section' 	=> 'hookmeup_cart_section'
			],
			[
				'slug' 		=> 'woocommerce_before_cart_table', 
				'label' 	=> 'Before Cart Table',
				'section' 	=> 'hookmeup_cart_section'
			],
			[
				'slug' 		=> 'woocommerce_after_cart_table', 
				'label' 	=> 'After Cart Table',
				'section' 	=> 'hookmeup_cart_section'
			],
			[
				'slug' 		=> 'woocommerce_before_cart_totals', 
				'label' 	=> 'Before Cart Totals',
				'section' 	=> 'hookmeup_cart_section'
			],
			[
				'slug' 		=> 'woocommerce_before_shipping_calculator', 
				'label' 	=> 'Before Shipping Calculator',
				'section' 	=> 'hookmeup_cart_section'
			],
			[
				'slug' 		=> 'woocommerce_after_shipping_calculator', 
				'label' 	=> 'After Shipping Calculator',
				'section' 	=> 'hookmeup_cart_section'
			],
			[
				'slug' 		=> 'woocommerce_proceed_to_checkout', 
				'label' 	=> 'Proceed To Checkout',
				'section' 	=> 'hookmeup_cart_section'
			],
			[
				'slug' 		=> 'woocommerce_after_cart_totals', 
				'label' 	=> 'After Cart Totals',
				'section' 	=> 'hookmeup_cart_section'
			],
			[
				'slug' 		=> 'woocommerce_after_cart', 
				'label' 	=> 'After Cart',
				'section' 	=> 'hookmeup_cart_section'
			],
			[
				'slug' 		=> 'woocommerce_cart_is_empty', 
				'label' 	=> 'Cart Is Empty',
				'section' 	=> 'hookmeup_cart_section'
			]
		];
	}

	/**
	 * Define cart widget hooks
	 *
	 * @since 1.2
	 *
	 * @return void
	 */
	protected function define_cart_widget_hooks() {

		$this->cart_widget_hooks = [
			[
				'slug' 		=> 'woocommerce_before_mini_cart', 
				'label' 	=> 'Before Mini Cart',
				'section' 	=> 'hookmeup_cart_widget_section'
			],
			[
				'slug' 		=> 'woocommerce_mini_cart_contents', 
				'label' 	=> 'Mini Cart Contents',
				'section' 	=> 'hookmeup_cart_widget_section'
			],
			[
				'slug' 		=> 'woocommerce_widget_shopping_cart_buttons', 
				'label' 	=> 'Shopping Cart Buttons',
				'section' 	=> 'hookmeup_cart_widget_section'
			],
			[
				'slug' 		=> 'woocommerce_after_mini_cart', 
				'label' 	=> 'After Mini Cart',
				'section' 	=> 'hookmeup_cart_widget_section'
			],
		];
	}

	/**
	 * Define thank you page hooks
	 *
	 * @since 1.2
	 *
	 * @return void
	 */
	protected function define_thankyou_hooks() {

		$this->thankyou_hooks = [
			[
				'slug' 		=> 'woocommerce_thankyou', 
				'label' 	=> 'Thank You',
				'section' 	=> 'hookmeup_thankyou_section'
			]
		];
	}

	/**
	 * Define checkout hooks
	 *
	 * @since 1.2
	 *
	 * @return void
	 */
	protected function define_checkout_hooks() {

		$this->checkout_hooks = [
			[
				'slug' 		=> 'woocommerce_before_checkout_form', 
				'label' 	=> 'Before Checkout Form',
				'section' 	=> 'hookmeup_checkout_section'
			],
			[
				'slug' 		=> 'woocommerce_before_checkout_billing_form', 
				'label' 	=> 'Before Checkout Billing Form',
				'section' 	=> 'hookmeup_checkout_section'
			],
			[
				'slug' 		=> 'woocommerce_after_checkout_registration_form', 
				'label' 	=> 'After Checkout Registration Form',
				'section' 	=> 'hookmeup_checkout_section'
			],
			[
				'slug' 		=> 'woocommerce_after_checkout_billing_form', 
				'label' 	=> 'After Checkout Billing Form',
				'section' 	=> 'hookmeup_checkout_section'
			],
			[
				'slug' 		=> 'woocommerce_before_checkout_shipping_form', 
				'label' 	=> 'Before Checkout Shipping Form',
				'section' 	=> 'hookmeup_checkout_section'
			],
			[
				'slug' 		=> 'woocommerce_after_checkout_shipping_form', 
				'label' 	=> 'After Checkout Shipping Form',
				'section' 	=> 'hookmeup_checkout_section'
			],
			[
				'slug' 		=> 'woocommerce_after_order_notes', 
				'label' 	=> 'After Order Notes',
				'section' 	=> 'hookmeup_checkout_section'
			],
			[
				'slug' 		=> 'woocommerce_checkout_before_order_review', 
				'label' 	=> 'Before Order Review',
				'section' 	=> 'hookmeup_checkout_section'
			],
			[
				'slug' 		=> 'woocommerce_review_order_before_payment', 
				'label' 	=> 'Review Order Before Payment',
				'section' 	=> 'hookmeup_checkout_section'
			],
			[
				'slug' 		=> 'woocommerce_review_order_after_payment', 
				'label' 	=> 'Review Order After Payment',
				'section' 	=> 'hookmeup_checkout_section'
			],
			[
				'slug' 		=> 'woocommerce_after_checkout_form', 
				'label' 	=> 'After Checkout Form',
				'section' 	=> 'hookmeup_checkout_section'
			]
		];
	}

	/**
	 * Define account hooks
	 *
	 * @since 1.2
	 *
	 * @return void
	 */
	protected function define_account_hooks() {

		$this->account_hooks = [
			[
				'slug' 		=> 'woocommerce_before_customer_login_form', 
				'label' 	=> 'Before Customer Login Form',
				'section' 	=> 'hookmeup_account_section'
			]
		];
	}

	/**
	 * Define product hooks
	 *
	 * @since 1.2
	 *
	 * @return void
	 */
	protected function define_product_hooks() {

		$this->product_hooks = [
			[
				'slug' 		=> 'woocommerce_before_single_product', 
				'label' 	=> 'Before Single Product',
				'section' 	=> 'hookmeup_product_section'
			],
			[
				'slug' 		=> 'woocommerce_single_product_summary', 
				'label' 	=> 'Single Product Summary',
				'section' 	=> 'hookmeup_product_section'
			],
			[
				'slug' 		=> 'woocommerce_before_add_to_cart_form', 
				'label' 	=> 'Before Add To Cart Form',
				'section' 	=> 'hookmeup_product_section'
			],
			[
				'slug' 		=> 'woocommerce_after_add_to_cart_form', 
				'label' 	=> 'After Add To Cart Form',
				'section' 	=> 'hookmeup_product_section'
			],
			[
				'slug' 		=> 'woocommerce_share', 
				'label' 	=> 'Share',
				'section' 	=> 'hookmeup_product_section'
			],
			[
				'slug' 		=> 'woocommerce_after_single_product', 
				'label' 	=> 'After Single Product',
				'section' 	=> 'hookmeup_product_section'
			]
		];
	}

	/**
	 * Retrieve array of archive hooks
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_archive_hooks() {
		return $this->archive_hooks;
	}

	/**
	 * Retrieve array of cart hooks
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_cart_hooks() {
		return $this->cart_hooks;
	}

	/**
	 * Retrieve array of checkout hooks
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_checkout_hooks() {
		return $this->checkout_hooks;
	}

	/**
	 * Retrieve array of account hooks
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_account_hooks() {
		return $this->account_hooks;
	}

	/**
	 * Retrieve array of single product hooks
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_product_hooks() {
		return $this->product_hooks;
	}

	/**
	 * Retrieve array of cart widget hooks
	 *
	 * @since 1.2
	 *
	 * @return array
	 */
	public function get_cart_widget_hooks() {
		return $this->cart_widget_hooks;
	}

	/**
	 * Retrieve array of thank you page hooks
	 *
	 * @since 1.2
	 *
	 * @return array
	 */
	public function get_thankyou_hooks() {
		return $this->thankyou_hooks;
	}

	/**
	 * Retrieve array of section hooks used for customizer
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_hooks( $section ) {

		switch( $section ) {
			case 'hookmeup_shop_section': 	  		return $this->archive_hooks;  		break;
			case 'hookmeup_product_section':  		return $this->product_hooks;  		break;
			case 'hookmeup_cart_section':	  		return $this->cart_hooks; 			break;
			case 'hookmeup_cart_widget_section': 	return $this->cart_widget_hooks; 	break;
			case 'hookmeup_thankyou_section': 		return $this->thankyou_hooks; 		break;
			case 'hookmeup_checkout_section': 		return $this->checkout_hooks; 		break;
			case 'hookmeup_account_section':  		return $this->account_hooks;  		break;
			default: 						  		return ''; 							break;
		}
	}

	/**
	 * Retrieve array of all registered hooks
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_all_hooks() {

		$all_hooks = array_merge(
			$this->product_hooks,
			$this->archive_hooks,
			$this->cart_hooks,
			$this->cart_widget_hooks,
			$this->thankyou_hooks,
			$this->checkout_hooks,
			$this->account_hooks
		);

		return $all_hooks;
	}

	/**
	 * Retrieve array of hook sections
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_hook_sections() {
		return $this->hook_sections;
	}
}
