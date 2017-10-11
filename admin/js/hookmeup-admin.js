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

})( jQuery );
