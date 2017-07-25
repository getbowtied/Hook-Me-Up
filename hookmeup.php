<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              getbowtied.com
 * @since             1.0.0
 * @package           Hookmeup
 *
 * @wordpress-plugin
 * Plugin Name:       Hook Me Up – Easy Hooks for WooCommerce
 * Plugin URI:        hookmeup.wp-theme.design
 * Description:       Helps you customize WooCommerce templates without altering the code.
 * Version:           1.0.0
 * Author:            GetBowtied
 * Author URI:        getbowtied.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hookmeup
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-hookmeup-activator.php
 */
function activate_hookmeup() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-hookmeup-activator.php';
	Hookmeup_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-hookmeup-deactivator.php
 */
function deactivate_hookmeup() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-hookmeup-deactivator.php';
	Hookmeup_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_hookmeup' );
register_deactivation_hook( __FILE__, 'deactivate_hookmeup' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-hookmeup.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_hookmeup() {

	$plugin = new Hookmeup();
	$plugin->run();

}
run_hookmeup();

// CART HOOKS

// Hook content before the cart
 
add_action( 'woocommerce_before_cart', 'hook_this_before_cart', 20 );
 
function hook_this_before_cart() {
    echo '<p class="hook">woocommerce_before_cart</p>';
}

// Hook content before the cart

add_action( 'woocommerce_before_cart_table', 'hook_this_before_cart_table', 20 );
 
function hook_this_before_cart_table() {
    echo '<p class="hook">woocommerce_before_cart_table</p>';
}

// Hook content before cart contents

add_action( 'woocommerce_before_cart_contents', 'hook_this_before_cart_contents', 20 );

function hook_this_before_cart_contents() {
    echo '<p class="hook">woocommerce_before_cart_contents</p>';
}

// Hook content before order total

add_action( 'woocommerce_cart_totals_before_order_total', 'hook_this_cart_totals_before_order_total', 20 );
 
function hook_this_cart_totals_before_order_total() {
    echo '<p class="hook">woocommerce_cart_totals_before_order_total</p>';
}

// Hook content after order total

add_action( 'woocommerce_cart_totals_after_order_total', 'hook_this_cart_totals_after_order_total', 20 );
 
function hook_this_cart_totals_after_order_total() {
    echo '<p class="hook">woocommerce_cart_totals_after_order_total</p>';
}

// Hook content woocommerce_cart_contents

add_action( 'woocommerce_cart_contents', 'hook_this_cart_contents', 20 );
 
function hook_this_cart_contents() {
    echo '<p class="hook">woocommerce_cart_contents</p>';
}

// Hook content woocommerce_cart_coupon

add_action( 'woocommerce_cart_coupon', 'hook_this_cart_coupon', 20 );
 
function hook_this_cart_coupon() {
    echo '<p class="hook">woocommerce_cart_coupon</p>';
}

// Hook content after_cart_contents

add_action( 'woocommerce_after_cart_contents', 'hook_this_after_cart_contents', 20 );
 
function hook_this_after_cart_contents() {
    echo '<p class="hook">woocommerce_after_cart_contents</p>';
}

// Hook content after_cart_table

add_action( 'woocommerce_after_cart_table', 'hook_this_after_cart_table', 20 );
 
function hook_this_after_cart_table() {
    echo '<p class="hook">woocommerce_after_cart_table</p>';
}

// Hook contentwoocommerce_cart_collaterals

add_action( 'woocommerce_cart_collaterals', 'hook_this_cart_collaterals', 20 );
 
function hook_this_cart_collaterals() {
    echo '<p class="hook">woocommerce_cart_collaterals</p>';
}

// Hook content before_cart_totals

add_action( 'woocommerce_before_cart_totals', 'hook_this_before_cart_totals', 20 );
 
function hook_this_before_cart_totals() {
    echo '<p class="hook">woocommerce_before_cart_totals</p>';
}

// Hook content cart_totals_before_shipping

add_action( 'woocommerce_cart_totals_before_shipping', 'hook_this_cart_totals_before_shipping', 20 );
 
function hook_this_cart_totals_before_shipping() {
    echo '<p class="hook">woocommerce_cart_totals_before_shipping</p>';
}

// Hook content before_shipping_calculator

add_action( 'woocommerce_before_shipping_calculator', 'hook_this_before_shipping_calculator', 20 );
 
function hook_this_before_shipping_calculator() {
    echo '<p class="hook">woocommerce_before_shipping_calculator</p>';
}

// Hook content after_shipping_calculator

add_action( 'woocommerce_after_shipping_calculator', 'hook_this_after_shipping_calculator', 20 );
 
function hook_this_after_shipping_calculator() {
    echo '<p class="hook">woocommerce_after_shipping_calculator</p>';
}

// Hook content cart_totals_after_shipping

add_action( 'woocommerce_cart_totals_after_shipping', 'hook_this_cart_totals_after_shipping', 20 );
 
function hook_this_cart_totals_after_shipping() {
    echo '<p class="hook">woocommerce_cart_totals_after_shipping</p>';
}

// Hook content woocommerce_proceed_to_checkout

add_action( 'woocommerce_proceed_to_checkout', 'hook_this_proceed_to_checkout', 20 );
 
function hook_this_proceed_to_checkout() {
    echo '<p class="hook">woocommerce_proceed_to_checkout</p>';
}

// Hook content woocommerce_after_cart_totals

add_action( 'woocommerce_after_cart_totals', 'hook_this_after_cart_totals', 20 );
 
function hook_this_after_cart_totals() {
    echo '<p class="hook">woocommerce_after_cart_totals</p>';
}

// Hook content woocommerce_after_cart

add_action( 'woocommerce_after_cart', 'hook_this_after_cart', 20 );
 
function hook_this_after_cart() {
    echo '<p class="hook">woocommerce_after_cart</p>';
}

// MY ACCOUNT HOOKS

// Login / Hook content before the login form
 
add_action( 'woocommerce_before_customer_login_form', 'hook_this_before_customer_login_form', 20 );
 
function hook_this_before_customer_login_form() {
    echo '<p class="hook">woocommerce_before_customer_login_form</p>';
}

// EMPTY CART HOOKS

// Hook content in the Empty Cart Page
 
add_action( 'woocommerce_cart_is_empty', 'hook_this_cart_is_empty', 20 );
 
function hook_this_cart_is_empty() {
    echo '<p class="hook">woocommerce_cart_is_empty</p>';
}

// CHECKOUT

// Hook content before the Checkout form
 
add_action( 'woocommerce_before_checkout_form', 'hook_this_before_checkout_form', 20 );
 
function hook_this_before_checkout_form() {
    echo '<p class="hook">woocommerce_before_checkout_form</p>';
}

// Hook content before customer details
 
add_action( 'woocommerce_checkout_before_customer_details', 'hook_this_checkout_before_customer_details', 20 );
 
function hook_this_checkout_before_customer_details() {
    echo '<p class="hook">woocommerce_checkout_before_customer_details</p>';
}

// Hook content before customer details
 
add_action( 'woocommerce_before_checkout_billing_form', 'hook_this_before_checkout_billing_form', 20 );
 
function hook_this_before_checkout_billing_form() {
    echo '<p class="hook">woocommerce_before_checkout_billing_form</p>';
}

// Hook content after checkout billing form
 
add_action( 'woocommerce_after_checkout_registration_form', 'hook_this_after_checkout_registration_form', 20 );
 
function hook_this_after_checkout_registration_form() {
    echo '<p class="hook">woocommerce_after_checkout_registration_form</p>';
}

// Hook content after_checkout_billing_form
 
add_action( 'woocommerce_after_checkout_billing_form', 'hook_this_after_checkout_billing_form', 20 );
 
function hook_this_after_checkout_billing_form() {
    echo '<p class="hook">woocommerce_after_checkout_billing_form</p>';
}

// Hook content before_checkout_shipping_form
 
add_action( 'woocommerce_before_checkout_shipping_form', 'hook_this_before_checkout_shipping_form', 20 );
 
function hook_this_before_checkout_shipping_form() {
    echo '<p class="hook">woocommerce_before_checkout_shipping_form</p>';
}

// Hook content after_checkout_shipping_form
 
add_action( 'woocommerce_after_checkout_shipping_form', 'hook_this_after_checkout_shipping_form', 20 );
 
function hook_this_after_checkout_shipping_form() {
    echo '<p class="hook">woocommerce_after_checkout_shipping_form</p>';
}

// Hook content before_order_notes
 
add_action( 'woocommerce_before_order_notes', 'hook_this_before_order_notes', 20 );
 
function hook_this_before_order_notes() {
    echo '<p class="hook">woocommerce_before_order_notes</p>';
}

// Hook content after_order_notes
 
add_action( 'woocommerce_after_order_notes', 'hook_this_after_order_notes', 20 );
 
function hook_this_after_order_notes() {
    echo '<p class="hook">woocommerce_after_order_notes</p>';
}

// Hook content checkout_after_customer_details
 
add_action( 'woocommerce_checkout_after_customer_details', 'hook_this_checkout_after_customer_details', 20 );
 
function hook_this_checkout_after_customer_details() {
    echo '<p class="hook">woocommerce_checkout_after_customer_details</p>';
}

// Hook content checkout_before_order_review
 
add_action( 'woocommerce_checkout_before_order_review', 'hook_this_checkout_before_order_review', 20 );
 
function hook_this_checkout_before_order_review() {
    echo '<p class="hook">woocommerce_checkout_before_order_review</p>';
}

// Hook content review_order_before_cart_contents
 
add_action( 'woocommerce_review_order_before_cart_contents', 'hook_this_review_order_before_cart_contents', 20 );
 
function hook_this_review_order_before_cart_contents() {
    echo '<p class="hook">woocommerce_review_order_before_cart_contents</p>';
}

// Hook content review_order_after_cart_contents
 
add_action( 'woocommerce_review_order_after_cart_contents', 'hook_this_review_order_after_cart_contents', 20 );
 
function hook_this_review_order_after_cart_contents() {
    echo '<p class="hook">woocommerce_review_order_after_cart_contents</p>';
}

// Hook content review_order_before_shipping
 
add_action( 'woocommerce_review_order_before_shipping', 'hook_this_review_order_before_shipping', 20 );
 
function hook_this_review_order_before_shipping() {
    echo '<p class="hook">woocommerce_review_order_before_shipping</p>';
}

// Hook content review_order_after_shipping
 
add_action( 'woocommerce_review_order_after_shipping', 'hook_this_review_order_after_shipping', 20 );
 
function hook_this_review_order_after_shipping() {
    echo '<p class="hook">woocommerce_review_order_after_shipping</p>';
}

// Hook content review_order_before_order_total
 
add_action( 'woocommerce_review_order_before_order_total', 'hook_this_review_order_before_order_total', 20 );
 
function hook_this_review_order_before_order_total() {
    echo '<p class="hook">woocommerce_review_order_before_order_total</p>';
}

// Hook content review_order_after_order_total
 
add_action( 'woocommerce_review_order_after_order_total', 'hook_this_review_order_after_order_total', 20 );
 
function hook_this_review_order_after_order_total() {
    echo '<p class="hook">woocommerce_review_order_after_order_total</p>';
}

// Hook content review_order_before_payment
 
add_action( 'woocommerce_review_order_before_payment', 'hook_this_review_order_before_payment', 20 );
 
function hook_this_review_order_before_payment() {
    echo '<p class="hook">woocommerce_review_order_before_payment</p>';
}

// Hook content review_order_before_submit
 
add_action( 'woocommerce_review_order_before_submit', 'hook_this_review_order_before_submit', 20 );
 
function hook_this_review_order_before_submit() {
    echo '<p class="hook">woocommerce_review_order_before_submit</p>';
}

// Hook content review_order_after_submit
 
add_action( 'woocommerce_review_order_after_submit', 'hook_this_review_order_after_submit', 20 );
 
function hook_this_review_order_after_submit() {
    echo '<p class="hook">woocommerce_review_order_after_submit</p>';
}

// Hook content review_order_after_payment
 
add_action( 'woocommerce_review_order_after_payment', 'hook_this_review_order_after_payment', 20 );
 
function hook_this_review_order_after_payment() {
    echo '<p class="hook">woocommerce_review_order_after_payment</p>';
}

// Hook content checkout_after_order_review
 
add_action( 'woocommerce_checkout_after_order_review', 'hook_this_checkout_after_order_review', 20 );
 
function hook_this_checkout_after_order_review() {
    echo '<p class="hook">woocommerce_checkout_after_order_review</p>';
}

// Hook content after_checkout_form
 
add_action( 'woocommerce_after_checkout_form', 'hook_this_after_checkout_form', 20 );
 
function hook_this_after_checkout_form() {
    echo '<p class="hook">woocommerce_after_checkout_form</p>';
}



// SINGLE PRODUCT

// woocommerce_before_single_product
 
add_action( 'woocommerce_before_single_product', 'hook_this_before_single_product', 20 );
 
function hook_this_before_single_product() {
    echo '<p class="hook">woocommerce_before_single_product</p>';
}

// Hook content before product summary
 
add_action( 'woocommerce_before_single_product_summary', 'hook_this_before_single_product_summary', 20 );
 
function hook_this_before_single_product_summary() {
    echo '<p class="hook">woocommerce_before_single_product_summary</p>';
}

// woocommerce_single_product_summary
 
add_action( 'woocommerce_single_product_summary', 'hook_this_single_product_summary', 20 );
 
function hook_this_single_product_summary() {
    echo '<p class="hook">woocommerce_single_product_summary</p>';
}

// Hook content before Add to Cart form
 
add_action( 'woocommerce_before_add_to_cart_form', 'hook_this_before_add_to_cart_form', 20 );
 
function hook_this_before_add_to_cart_form() {
    echo '<p class="hook">woocommerce_before_add_to_cart_form</p>';
}

// Hook content before Add to Cart Button
 
add_action( 'woocommerce_before_add_to_cart_button', 'hook_this_before_add_to_cart_button', 20 );
 
function hook_this_before_add_to_cart_button() {
    echo '<p class="hook">woocommerce_before_add_to_cart_button</p>';
}


// Hook content before the variations form
 
add_action( 'woocommerce_before_variations_form', 'hook_this_before_variations_form', 20 );
 
function hook_this_before_variations_form() {
    echo '<p class="hook">woocommerce_before_variations_form</p>';
}

// Hook content before_single_variation
 
add_action( 'woocommerce_before_single_variation', 'hook_this_before_single_variation', 20 );
 
function hook_this_before_single_variation() {
    echo '<p class="hook">woocommerce_before_single_variation</p>';
}

// Hook content single_variation
 
add_action( 'woocommerce_single_variation', 'hook_this_single_variation', 20 );
 
function hook_this_single_variation() {
    echo '<p class="hook">woocommerce_single_variation</p>';
}

// Hook content after single_variation
 
add_action( 'woocommerce_after_single_variation', 'hook_this_after_single_variation', 20 );
 
function hook_this_after_single_variation() {
    echo '<p class="hook">woocommerce_after_single_variation</p>';
}


// Hook content after_add_to_cart_button
 
add_action( 'woocommerce_after_add_to_cart_button', 'hook_this_after_add_to_cart_button', 20 );
 
function hook_this_after_add_to_cart_button() {
    echo '<p class="hook">woocommerce_after_add_to_cart_button</p>';
}

// Hook content after_variations_form
 
add_action( 'woocommerce_after_variations_form', 'hook_this_after_variations_form', 20 );
 
function hook_this_after_variations_form() {
    echo '<p class="hook">woocommerce_after_variations_form</p>';
}

// Hook content after_add_to_cart_form
 
add_action( 'woocommerce_after_add_to_cart_form', 'hook_this_after_add_to_cart_form', 20 );
 
function hook_this_after_add_to_cart_form() {
    echo '<p class="hook">woocommerce_after_add_to_cart_form</p>';
}

// Hook content product_meta_start
 
add_action( 'woocommerce_product_meta_start', 'hook_this_product_meta_start', 20 );
 
function hook_this_product_meta_start() {
    echo '<p class="hook">woocommerce_product_meta_start</p>';
}

// Hook content product_meta_end
 
add_action( 'woocommerce_product_meta_end', 'hook_this_product_meta_end', 20 );
 
function hook_this_product_meta_end() {
    echo '<p class="hook">woocommerce_product_meta_end</p>';
}

// Hook content product_meta_end
 
add_action( 'woocommerce_share', 'hook_this_share', 20 );
 
function hook_this_share() {
    echo '<p class="hook">woocommerce_share</p>';
}

// Hook content after_single_product_summary
 
add_action( 'woocommerce_after_single_product_summary', 'hook_this_after_single_product_summary', 20 );
 
function hook_this_after_single_product_summary() {
    echo '<p class="hook">woocommerce_after_single_product_summary</p>';
}

// Hook content after_single_product
 
add_action( 'woocommerce_after_single_product', 'hook_this_after_single_product', 20 );
 
function hook_this_after_single_product() {
    echo '<p class="hook">woocommerce_after_single_product</p>';
}

// Hook Shop

// Hook content above the Shop page
 
add_action( 'woocommerce_before_main_content', 'hook_this_before_main_content', 20 );
 
function hook_this_before_main_content() {
    echo '<p class="hook">woocommerce_before_main_content</p>';
}

// Hook content after description
 
add_action( 'woocommerce_archive_description', 'hook_this_archive_description', 20 );
 
function hook_this_archive_description() {
    echo '<p class="hook">woocommerce_archive_description</p>';
}

// Hook content before_shop_loop
 
add_action( 'woocommerce_before_shop_loop', 'hook_this_before_shop_loop', 20 );
 
function hook_this_before_shop_loop() {
    echo '<p class="hook">woocommerce_before_shop_loop</p>';
}

// Hook content above the product
 
add_action( 'woocommerce_before_shop_loop_item', 'hook_this_before_shop_loop_item', 20 );
 
function hook_this_before_shop_loop_item() {
    echo '<p class="hook">woocommerce_before_shop_loop_item</p>';
}

// Hook content above the product title
 
add_action( 'woocommerce_before_shop_loop_item_title', 'hook_this_before_shop_loop_item_title', 20 );
 
function hook_this_before_shop_loop_item_title() {
    echo '<p class="hook">woocommerce_before_shop_loop_item_title</p>';
}

// Hook content below the product title
 
add_action( 'woocommerce_after_shop_loop_item_title', 'hook_this_after_shop_loop_item_title', 20 );
 
function hook_this_after_shop_loop_item_title() {
    echo '<p class="hook">woocommerce_after_shop_loop_item_title</p>';
}

// Hook content after_shop_loop_item
 
add_action( 'woocommerce_after_shop_loop_item', 'hook_this_after_shop_loop_item', 20 );
 
function hook_this_after_shop_loop_item() {
    echo '<p class="hook">woocommerce_after_shop_loop_item</p>';
}

// Hook content after_shop_loop
 
add_action( 'woocommerce_after_shop_loop', 'hook_this_after_shop_loop', 20 );
 
function hook_this_after_shop_loop() {
    echo '<p class="hook">woocommerce_after_shop_loop</p>';
}

// Hook content after_main_content
 
add_action( 'woocommerce_after_main_content', 'hook_this_after_main_content', 20 );
 
function hook_this_after_main_content() {
    echo '<p class="hook">woocommerce_after_main_content</p>';
}