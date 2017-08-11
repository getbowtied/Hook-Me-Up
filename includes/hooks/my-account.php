<?php

/**
 * My Account Hooks
 *
 */

// Login / Hook content before the login form
 
add_action( 'woocommerce_before_customer_login_form', 'hook_this_before_customer_login_form', 20 );
 
function hook_this_before_customer_login_form() {
    echo '<p class="hook">woocommerce_before_customer_login_form</p>';
}