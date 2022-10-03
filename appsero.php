<?php


/**
 * Initialize the plugin tracker
 *
 * @return void
 */
function appsero_init_tracker_hookmeup() {

    if ( ! class_exists( 'Appsero\Client' ) ) {
      require_once __DIR__ . '/appsero/src/Client.php';
    }

    $client = new Appsero\Client( '778b0163-b90f-4f52-bb2d-1b5e92307795', 'HookMeUp – Additional Content for WooCommerce', __FILE__ );

    // Active insights
    $client->insights()->init();

}

appsero_init_tracker_hookmeup();
