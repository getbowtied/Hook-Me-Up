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

	}, 1000);

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

})( jQuery );
