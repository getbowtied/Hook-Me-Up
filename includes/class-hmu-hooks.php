<?php

/**
 * Define the WooCommerce hooks
 *
 * @link       getbowtied.com
 * @since      1.0.0
 * @package    HMU
 * @subpackage HMU/includes
 * @author     GetBowtied <adi@getbowtied.com>
 */

class HMU_Hooks {

	/**
	 * Archive hooks list
	 * @var array
	 */
	protected $archive_hooks;

	/**
	 * Cart hooks list
	 * @var array
	 */
	protected $cart_hooks;

	/**
	 * Checkout hooks list
	 * @var array
	 */
	protected $checkout_hooks;

	/**
	 * Account hooks list
	 * @var array
	 */
	protected $account_hooks;

	/**
	 * Single Product hooks list
	 * @var array
	 */
	protected $product_hooks;

	/**
	 * Hook sections list
	 * @var array
	 */
	protected $hook_sections;

	/**
	 * HMU_Hooks constructor
	 */
	public function __construct() {

		$this->hook_sections = [ 
			'hookmeup_shop_section', 
			'hookmeup_product_section', 
			'hookmeup_cart_section', 
			'hookmeup_checkout_section', 
			'hookmeup_account_section'
		];

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

		$this->account_hooks = [
			[
				'slug' 		=> 'woocommerce_before_customer_login_form', 
				'label' 	=> 'Before Customer Login Form',
				'section' 	=> 'hookmeup_account_section'
			]
		];

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
	 */
	public function get_archive_hooks() {
		return $this->archive_hooks;
	}

	/**
	 * Retrieve array of cart hooks
	 */
	public function get_cart_hooks() {
		return $this->cart_hooks;
	}

	/**
	 * Retrieve array of checkout hooks
	 */
	public function get_checkout_hooks() {
		return $this->checkout_hooks;
	}

	/**
	 * Retrieve array of account hooks
	 */
	public function get_account_hooks() {
		return $this->account_hooks;
	}

	/**
	 * Retrieve array of single product hooks
	 */
	public function get_product_hooks() {
		return $this->product_hooks;
	}

	/**
	 * Retrieve array of section hooks used for customizer select field 
	 */
	public function get_select_hooks( $section ) {

		$hooks = $this->get_hooks( $section );
		$section_hooks['default'] = 'Choose...';
		
		foreach( $hooks as $hook ) {
			$section_hooks[$hook['slug']] = $hook['label'] . '&lt;p class="hook-description"&gt;' . $hook['slug'] . '&lt;/p&gt;';
		}

		return $section_hooks;
	}

	/**
	 * Retrieve array of section hooks used for customizer
	 */
	public function get_hooks( $section ) {

		switch( $section ) {
			case 'hookmeup_shop_section': 	  return $this->archive_hooks;  break;
			case 'hookmeup_product_section':  return $this->product_hooks;  break;
			case 'hookmeup_cart_section':	  return $this->cart_hooks; 	break;
			case 'hookmeup_checkout_section': return $this->checkout_hooks; break;
			case 'hookmeup_account_section':  return $this->account_hooks;  break;
			default: 						  return ''; 					break;
		}
	}

	/**
	 * Retrieve array of all registered hooks
	 */
	public function get_all_hooks() {

		$all_hooks = array_merge($this->product_hooks, $this->archive_hooks, $this->cart_hooks, $this->checkout_hooks, $this->account_hooks);

		return $all_hooks;
	}

	/**
	 * Retrieve array of hook sections
	 */
	public function get_hook_sections() {
		return $this->hook_sections;
	}
}
