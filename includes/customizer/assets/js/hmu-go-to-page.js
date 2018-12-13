(function( $ ) {

	'use strict';

	var in_customizer = false;

    if ( typeof wp !== 'undefined' ) {
    	if ( typeof wp.customize !== 'undefined' ) {
        	in_customizer =  typeof wp.customize.section !== 'undefined' ? true : false;
        }
    }

    if ( in_customizer ) {

	    wp.customize.section( 'hookmeup_shop_section', function( section ) {
	        go_to_page( section, 'shop' );
	    } );

	    wp.customize.section( 'hookmeup_cart_section', function( section ) {
	        go_to_page( section, 'cart' );
	    } );

	    wp.customize.section( 'hookmeup_checkout_section', function( section ) {
	        go_to_page( section, 'checkout' );
	    } );

	    wp.customize.section( 'hookmeup_account_section', function( section ) {
	        go_to_page( section, 'account' );
	    } );

		wp.customize.section( 'hookmeup_product_section', function( section ) {
			go_to_page( section, 'product' );
	    } );

	    function go_to_page( section, page ) {

	    	section.expanded.bind( function( isExpanded ) {
	            if ( isExpanded ) {
	            	var data = {
	            		'action' : 'get_hmu_customize_section_url',
	            		'page'	 : page
	            	};

					jQuery.post( 'admin-ajax.php', data, function(response) {
						wp.customize.previewer.previewUrl.set(response);
					});		
	            }
	        } );
	    }
	}

})( jQuery );