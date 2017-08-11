<?php

/**
 * Checkout Hooks
 *
 */

$hooks = new Hookmeup_Hooks();
$checkout_hooks = $hooks->get_checkout_hooks();

foreach( $checkout_hooks as $checkout_hook) {

    $hook = $checkout_hook['hook'];

    add_action( $hook, function() use ($hook) {

        $option_toggle  = get_theme_mod($hook);
        $option_content = get_theme_mod($hook . '_editor');

        echo '<div id="' . $hook . '">'; 

        if( $option_toggle == true ) {
            if( $option_content ) { 
                echo $option_content;
            } else {
                echo '<p class="hook">' . $hook . '</p>';
            }
        } else {
            echo '<p class="hook">' . $hook . '</p>';
        }

        echo '</div>';

    }, 20 );
}