<?php

/**
 * Cart Hooks
 *
 */

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