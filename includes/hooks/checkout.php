<?php

/**
 * Checkout Hooks
 *
 */

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