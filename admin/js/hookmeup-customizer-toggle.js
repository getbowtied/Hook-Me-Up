jQuery(document).ready(function( $ ) {
	
	wp.customize.bind( 'ready', function() { 

		var customize = this; // Customize object alias.
		var toggleControls = [
			'shop_archives_description_settings',
			'shop_archives_before_main_content_settings',
			'shop_archives_before_shop_loop_settings',
			'shop_archives_before_shop_loop_item_settings',
			'shop_archives_before_shop_loop_item_title_settings',
			'shop_archives_after_shop_loop_item_title_settings',
			'shop_archives_after_shop_loop_item_settings',
			'shop_archives_after_shop_loop_settings',
			'shop_archives_after_main_content_settings',
			'single_product_before_single_product_settings',
			'single_product_before_single_product_summary_settings',
			'single_product_before_add_to_cart_form_settings',
			'single_product_before_add_to_cart_button_settings',
			'single_product_after_add_to_cart_button_settings',
			'single_product_after_add_to_cart_form_settings',
			'single_product_single_product_summary_settings',
			'single_product_product_meta_start_settings',
			'single_product_product_meta_end_settings',
			'single_product_share_settings',
			'single_product_after_single_product_summary_settings',
			'single_product_after_single_product_settings',
			'cart_before_cart_settings',
			'cart_after_cart_settings',
			'cart_before_cart_table_settings',
			'cart_before_cart_contents_settings',
			'cart_cart_contents_settings',
			'cart_after_cart_contents_settings',
			'cart_cart_coupon_settings',
			'cart_after_cart_table_settings',
			'cart_before_cart_totals_settings',
			'cart_cart_totals_before_order_total_settings',
			'cart_cart_totals_after_order_total_settings',
			'cart_proceed_to_checkout_settings',
			'cart_after_cart_totals_settings',
			'cart_cart_collaterals_settings',
			'cart_cart_is_empty_settings',
			'my_account_before_customer_login_form_settings'
		];
		$.each( toggleControls, function( index, control_name ) {
			customize( control_name, function( value ) {
				var controlTitle = customize.control( control_name ).container.find( '.customize-control-title' ); // Get control  title.
				// 1. On loading.
				controlTitle.toggleClass('disabled-control-title', !value.get() );
				// 2. Binding to value change.
				value.bind( function( to ) {
					controlTitle.toggleClass( 'disabled-control-title', !value.get() );
				} );
			} );
		} );
	} );
});