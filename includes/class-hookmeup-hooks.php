<?php

class Hookmeup_Hooks {

	/**
	 * Archive hooks list
	 * @access   protected
	 * @var      array
	 */
	protected $archive_hooks;

	/**
	 * Cart hooks list
	 * @access   protected
	 * @var      array
	 */
	protected $cart_hooks;

	/**
	 * Checkout hooks list
	 * @access   protected
	 * @var      array
	 */
	protected $checkout_hooks;

	/**
	 * Account hooks list
	 * @access   protected
	 * @var      array
	 */
	protected $account_hooks;

	/**
	 * Single Product hooks list
	 * @access   protected
	 * @var      array
	 */
	protected $product_hooks;

	public function __construct() {

		$this->archive_hooks = [
			[
				'hook' => 'woocommerce_before_main_content', 
				'label' => 'Before Main Content',
				'section' => 'hookmeup_shop_section'
			],
			[
				'hook' => 'woocommerce_archive_description', 
				'label' => 'Archive Description',
				'section' => 'hookmeup_shop_section'
			],
			[
				'hook' => 'woocommerce_before_shop_loop', 
				'label' => 'Before Shop Loop',
				'section' => 'hookmeup_shop_section'
			],
			[
				'hook' => 'woocommerce_before_shop_loop_item', 
				'label' => 'Before Shop Loop Item',
				'section' => 'hookmeup_shop_section'
			],
			[
				'hook' => 'woocommerce_before_shop_loop_item_title', 
				'label' => 'Before Shop Loop Item Title',
				'section' => 'hookmeup_shop_section'
			],
			[
				'hook' => 'woocommerce_after_shop_loop_item_title', 
				'label' => 'After Shop Loop Item Title',
				'section' => 'hookmeup_shop_section'
			],
			[
				'hook' => 'woocommerce_after_shop_loop_item', 
				'label' => 'After Shop Loop Item',
				'section' => 'hookmeup_shop_section'
			],
			[
				'hook' => 'woocommerce_after_shop_loop', 
				'label' => 'After Shop Loop',
				'section' => 'hookmeup_shop_section'
			],
			[
				'hook' => 'woocommerce_after_main_content', 
				'label' => 'After Main Content',
				'section' => 'hookmeup_shop_section'
			]
		];

		$this->cart_hooks = [
			[
				'hook' => 'woocommerce_before_cart', 
				'label' => 'Before Cart',
				'section' => 'hookmeup_cart_section'
			],
			[
				'hook' => 'woocommerce_before_cart_table', 
				'label' => 'Before Cart Table',
				'section' => 'hookmeup_cart_section'
			],
			[
				'hook' => 'woocommerce_before_cart_contents', 
				'label' => 'Before Cart Contents',
				'section' => 'hookmeup_cart_section'
			],
			[
				'hook' => 'woocommerce_cart_totals_before_order_total', 
				'label' => 'Cart Totals Before Order Total',
				'section' => 'hookmeup_cart_section'
			],
			[
				'hook' => 'woocommerce_cart_totals_after_order_total', 
				'label' => 'Cart Totals After Order Total',
				'section' => 'hookmeup_cart_section'
			],
			[
				'hook' => 'woocommerce_cart_contents', 
				'label' => 'Cart Contents',
				'section' => 'hookmeup_cart_section'
			],
			[
				'hook' => 'woocommerce_cart_coupon', 
				'label' => 'Cart Coupon',
				'section' => 'hookmeup_cart_section'
			],
			[
				'hook' => 'woocommerce_after_cart_contents', 
				'label' => 'After Cart Contents',
				'section' => 'hookmeup_cart_section'
			],
			[
				'hook' => 'woocommerce_after_cart_table', 
				'label' => 'After Cart Table',
				'section' => 'hookmeup_cart_section'
			],
			[
				'hook' => 'woocommerce_cart_collaterals', 
				'label' => 'Cart Collaterals',
				'section' => 'hookmeup_cart_section'
			],
			[
				'hook' => 'woocommerce_before_cart_totals', 
				'label' => 'Before Cart Totals',
				'section' => 'hookmeup_cart_section'
			],
			[
				'hook' => 'woocommerce_cart_totals_before_shipping', 
				'label' => 'Cart Totals Before Shipping',
				'section' => 'hookmeup_cart_section'
			],
			[
				'hook' => 'woocommerce_before_shipping_calculator', 
				'label' => 'Before Shippinh Calculator',
				'section' => 'hookmeup_cart_section'
			],
			[
				'hook' => 'woocommerce_after_shipping_calculator', 
				'label' => 'After Shipping Calculator',
				'section' => 'hookmeup_cart_section'
			],
			[
				'hook' => 'woocommerce_cart_totals_after_shipping', 
				'label' => 'Cart Totals After Shipping',
				'section' => 'hookmeup_cart_section'
			],
			[
				'hook' => 'woocommerce_proceed_to_checkout', 
				'label' => 'Proceed To Checkout',
				'section' => 'hookmeup_cart_section'
			],
			[
				'hook' => 'woocommerce_after_cart_totals', 
				'label' => 'After Cart Totals',
				'section' => 'hookmeup_cart_section'
			],
			[
				'hook' => 'woocommerce_after_cart', 
				'label' => 'After Cart',
				'section' => 'hookmeup_cart_section'
			],
			[
				'hook' => 'woocommerce_cart_is_empty', 
				'label' => 'Cart Is Empty',
				'section' => 'hookmeup_cart_section'
			]
		];

		$this->checkout_hooks = [
			[
				'hook' => 'woocommerce_before_checkout_form', 
				'label' => 'Before Checkout Form',
				'section' => 'hookmeup_checkout_section'
			],
			[
				'hook' => 'woocommerce_checkout_before_customer_details', 
				'label' => 'Before Customer Details',
				'section' => 'hookmeup_checkout_section'
			],
			[
				'hook' => 'woocommerce_before_checkout_billing_form', 
				'label' => 'Before Checkout Billing Form',
				'section' => 'hookmeup_checkout_section'
			],
			[
				'hook' => 'woocommerce_after_checkout_registration_form', 
				'label' => 'After Checkout Registration Form',
				'section' => 'hookmeup_checkout_section'
			],
			[
				'hook' => 'woocommerce_after_checkout_billing_form', 
				'label' => 'After Checkout Billing Form',
				'section' => 'hookmeup_checkout_section'
			],
			[
				'hook' => 'woocommerce_before_checkout_shipping_form', 
				'label' => 'Before Checkout Shipping Form',
				'section' => 'hookmeup_checkout_section'
			],
			[
				'hook' => 'woocommerce_after_checkout_shipping_form', 
				'label' => 'After Checkout Shipping Form',
				'section' => 'hookmeup_checkout_section'
			],
			[
				'hook' => 'woocommerce_before_order_notes', 
				'label' => 'Before Order Notes',
				'section' => 'hookmeup_checkout_section'
			],
			[
				'hook' => 'woocommerce_after_order_notes', 
				'label' => 'After Order Notes',
				'section' => 'hookmeup_checkout_section'
			],
			[
				'hook' => 'woocommerce_checkout_after_customer_details', 
				'label' => 'After Customer Details',
				'section' => 'hookmeup_checkout_section'
			],
			[
				'hook' => 'woocommerce_checkout_before_order_review', 
				'label' => 'Before Order Review',
				'section' => 'hookmeup_checkout_section'
			],
			[
				'hook' => 'woocommerce_review_order_before_cart_contents', 
				'label' => 'Review Order Before Cart Contents',
				'section' => 'hookmeup_checkout_section'
			],
			[
				'hook' => 'woocommerce_review_order_after_cart_contents', 
				'label' => 'Review Order After Cart Contents',
				'section' => 'hookmeup_checkout_section'
			],
			[
				'hook' => 'woocommerce_review_order_before_shipping', 
				'label' => 'Review Order Before Shipping',
				'section' => 'hookmeup_checkout_section'
			],
			[
				'hook' => 'woocommerce_review_order_after_shipping', 
				'label' => 'Review Order After Shipping',
				'section' => 'hookmeup_checkout_section'
			],
			[
				'hook' => 'woocommerce_review_order_before_order_total', 
				'label' => 'Review Order Before Order Total',
				'section' => 'hookmeup_checkout_section'
			],
			[
				'hook' => 'woocommerce_review_order_after_order_total', 
				'label' => 'Review Order After Order Total',
				'section' => 'hookmeup_checkout_section'
			],
			[
				'hook' => 'woocommerce_review_order_before_payment', 
				'label' => 'Review Order Before Payment',
				'section' => 'hookmeup_checkout_section'
			],
			[
				'hook' => 'woocommerce_review_order_before_submit', 
				'label' => 'Review Order Before Submit',
				'section' => 'hookmeup_checkout_section'
			],
			[
				'hook' => 'woocommerce_review_order_after_submit', 
				'label' => 'Review Order After Submit',
				'section' => 'hookmeup_checkout_section'
			],
			[
				'hook' => 'woocommerce_review_order_after_payment', 
				'label' => 'Review Order After Payment',
				'section' => 'hookmeup_checkout_section'
			],
			[
				'hook' => 'woocommerce_checkout_after_order_review', 
				'label' => 'After Order Review',
				'section' => 'hookmeup_checkout_section'
			],
			[
				'hook' => 'woocommerce_after_checkout_form', 
				'label' => 'After Checkout Form',
				'section' => 'hookmeup_checkout_section'
			]
		];

		$this->account_hooks = [
			[
				'hook' => 'woocommerce_before_customer_login_form', 
				'label' => 'Before Customer Login Form',
				'section' => 'hookmeup_account_section'
			]
		];

		$this->product_hooks = [
			[
				'hook' => 'woocommerce_before_single_product', 
				'label' => 'Before Single Product',
				'section' => 'hookmeup_product_section'
			],
			[
				'hook' => 'woocommerce_before_single_product_summary', 
				'label' => 'Before Single Product Summary',
				'section' => 'hookmeup_product_section'
			],
			[
				'hook' => 'woocommerce_single_product_summary', 
				'label' => 'Single Product Summary',
				'section' => 'hookmeup_product_section'
			],
			[
				'hook' => 'woocommerce_before_add_to_cart_form', 
				'label' => 'Before Add To Cart Form',
				'section' => 'hookmeup_product_section'
			],
			[
				'hook' => 'woocommerce_before_add_to_cart_button', 
				'label' => 'Before Add To Cart Button',
				'section' => 'hookmeup_product_section'
			],
			[
				'hook' => 'woocommerce_before_variations_form', 
				'label' => 'Before Variations Form',
				'section' => 'hookmeup_product_section'
			],
			[
				'hook' => 'woocommerce_before_single_variation', 
				'label' => 'Before Single Variation',
				'section' => 'hookmeup_product_section'
			],
			[
				'hook' => 'woocommerce_single_variation', 
				'label' => 'Single Variation',
				'section' => 'hookmeup_product_section'
			],
			[
				'hook' => 'woocommerce_after_single_variation', 
				'label' => 'After Single Variation',
				'section' => 'hookmeup_product_section'
			],
			[
				'hook' => 'woocommerce_after_add_to_cart_button', 
				'label' => 'After Add To Cart Button',
				'section' => 'hookmeup_product_section'
			],
			[
				'hook' => 'woocommerce_after_variations_form', 
				'label' => 'After Variations Form',
				'section' => 'hookmeup_product_section'
			],
			[
				'hook' => 'woocommerce_after_add_to_cart_form', 
				'label' => 'After Add To Cart Form',
				'section' => 'hookmeup_product_section'
			],
			[
				'hook' => 'woocommerce_product_meta_start', 
				'label' => 'Product Meta Start',
				'section' => 'hookmeup_product_section'
			],
			[
				'hook' => 'woocommerce_product_meta_end', 
				'label' => 'Product Meta End',
				'section' => 'hookmeup_product_section'
			],
			[
				'hook' => 'woocommerce_share', 
				'label' => 'Share',
				'section' => 'hookmeup_product_section'
			],
			[
				'hook' => 'woocommerce_after_single_product_summary', 
				'label' => 'After Single Product Summary',
				'section' => 'hookmeup_product_section'
			],
			[
				'hook' => 'woocommerce_after_single_product', 
				'label' => 'After Single Product',
				'section' => 'hookmeup_product_section'
			]
		];
	}

	public function get_archive_hooks() {
		return $this->archive_hooks;
	}

	public function get_cart_hooks() {
		return $this->cart_hooks;
	}

	public function get_checkout_hooks() {
		return $this->checkout_hooks;
	}

	public function get_account_hooks() {
		return $this->account_hooks;
	}

	public function get_product_hooks() {
		return $this->product_hooks;
	}

	public function get_all_hooks() {

		$all_hooks = array_merge($this->product_hooks, $this->archive_hooks, $this->cart_hooks, $this->checkout_hooks, $this->account_hooks);

		return $all_hooks;
	}

	// public function generate_all_hooks( ) {
	// 	$this->generate_hooks( $this->archive_hooks );
	// 	$this->generate_hooks( $this->cart_hooks );
	// 	$this->generate_hooks( $this->checkout_hooks );
	// 	$this->generate_hooks( $this->account_hooks );
	// 	$this->generate_hooks( $this->product_hooks );
	// }

	// public function generate_hooks( $hooks ) {

	// 	foreach( $hooks as $hook ) {

	// 	    $hook_name = $hook['hook'];

	// 	    add_action( $hook_name, function() use ($hook_name) {

	// 	        $option_toggle  = get_theme_mod($hook_name);
	// 	        $option_content = get_theme_mod($hook_name . '_editor');

	// 	        echo '<div id="' . $hook_name . '">'; 

	// 	        if( $option_toggle == true ) {
	// 	            if( $option_content ) { 
	// 	                echo $option_content;
	// 	            } else {
	// 	                echo '<p class="hook">' . $hook_name . '</p>';
	// 	            }
	// 	        } else {
	// 	            echo '<p class="hook">' . $hook_name . '</p>';
	// 	        }

	// 	        echo '</div>';

	// 	    }, 20 );
	// 	}
	// }
}