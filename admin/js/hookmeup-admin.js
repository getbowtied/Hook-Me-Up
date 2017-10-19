(function( $ ) {
	'use strict';

	setInterval(function(){
		if( jQuery('#customize-preview').children('iframe').length > 1 ) {
			jQuery( '.customize-control-kirki-editor .toggle-editor' ).addClass('btn-disabled');
			jQuery( '.customize-control-kirki-editor .customize-control-content' ).addClass('disabled');
		} else {
		    jQuery( '.customize-control-kirki-editor .toggle-editor' ).removeClass('btn-disabled');
		    jQuery( '.customize-control-kirki-editor .customize-control-content' ).removeClass('disabled');
		}

	}, 700);

	$(document).on('click', '.toggle-editor', function(){
		var buttons = document.getElementsByClassName('toggle-editor');

		for( var i = 0; i < buttons.length; i++ ) {
			if(buttons.item(i).innerHTML == 'Switch Editor') {
				(buttons.item(i)).className = 'button button-primary toggle-editor button-switch';
			} else if(buttons.item(i).innerHTML == 'Open Editor') {
				(buttons.item(i)).className = 'button button-primary toggle-editor button-open';
			} else if(buttons.item(i).innerHTML == 'Close Editor') {
				(buttons.item(i)).className = 'button button-primary toggle-editor button-close';
			}
		}
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

})( jQuery );
