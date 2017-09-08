<?php

/**
 * Class Hookmeup_Verify_Dependencies
 *
 * Checks that the WooCommerce plugin is installed
 * 
 */
class Hookmeup_Verify_Dependencies {

	function verify_woocommerce() {
	    if ( !is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	        deactivate_plugins( 'hookmeup/hookmeup.php' );
	        add_action( 'admin_notices', array( $this, 'woocommerce_not_installed_warning' ) );
	    }
	}

	function woocommerce_not_installed_warning() {
		?>
		<div class="message error woocommerce-admin-notice woocommerce-st-inactive woocommerce-not-configured">
			<p><?php esc_html_e( 'Hook Me Up requires WooCommerce plugin in order to work properly. Please finish the installation of WooCommerce first.', 'hookmeup' ); ?></p>
		</div>
		<?php
	}
}