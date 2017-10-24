(function( $ ) {

	'use strict';

	$(document).on('click', '.toggle-editor', function(){
		if( jQuery( '#customize-preview' ).hasClass( 'is-kirki-editor-open' ) ) {

			setInterval(function(){
				if( jQuery('#customize-preview').children('iframe').length > 1 ) {
					jQuery( '.customize-control-kirki-editor .toggle-editor' ).addClass('btn-disabled');
					jQuery( '.customize-control-kirki-editor .customize-control-content' ).addClass('disabled');
				} else {
				    jQuery( '.customize-control-kirki-editor .toggle-editor' ).removeClass('btn-disabled');
				    jQuery( '.customize-control-kirki-editor .customize-control-content' ).removeClass('disabled');
				}
				
			}, 700);
		}
	});

	$(document).on('click', '#customize-control-hookmeup_shop_section_select .select2', function(){
		$('.select2-results__options').addClass('hookmeup-select');
	});
	$(document).on('click', '#customize-control-hookmeup_cart_section_select .select2', function(){
		$('.select2-results__options').addClass('hookmeup-select');
	});
	$(document).on('click', '#customize-control-hookmeup_checkout_section_select .select2', function(){
		$('.select2-results__options').addClass('hookmeup-select');
	});
	$(document).on('click', '#customize-control-hookmeup_account_section_select .select2', function(){
		$('.select2-results__options').addClass('hookmeup-select');
	});
	$(document).on('click', '#customize-control-hookmeup_product_section_select .select2', function(){
		$('.select2-results__options').addClass('hookmeup-select');
	});

	$(document).on('click', '.customize-section-back', function(){
		close_editor();
	});

	$(document).on('change', '.customize-control-kirki-select select', function(){
		close_editor();
	});

	function close_editor() {

		var editorWrapper = jQuery( '#kirki_editor_pane' );
		editorWrapper.removeClass();
		editorWrapper.addClass( 'hide' );
		jQuery( '#customize-preview' ).removeClass( 'is-kirki-editor-open' );
		jQuery( '.customize-control-kirki-editor .toggle-editor' ).html( editorKirkiL10n['open-editor'] ).removeClass( 'button-close' );
	}

	if( typeof wp !== 'undefined' ) {

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
	            		'action' : 'get_url',
	            		'page'	 : page
	            	};

					jQuery.post( 'admin-ajax.php', data, function(response) {
						wp.customize.previewer.previewUrl.set(response.slice(0, -1));
					});		
	            }
	        } );
	    }
	}

})( jQuery );
