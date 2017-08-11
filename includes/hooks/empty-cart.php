<?php

/**
 * Empty Cart Hooks
 *
 */
// Hook content in the Empty Cart Page
 
add_action( 'woocommerce_cart_is_empty', 'hook_this_cart_is_empty', 20 );
 
function hook_this_cart_is_empty() {
    echo '<p class="hook">woocommerce_cart_is_empty</p>';
}