<?php

/**
 * Shop Hooks
 *
 */

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