<?php

/**
 * Single Product Hooks
 *
 */

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