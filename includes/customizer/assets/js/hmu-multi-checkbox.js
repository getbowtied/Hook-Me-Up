(function( $ ) {

	'use strict';

    $( function( $ ) {

    	$( '.customize-control-hmu-multi-checkbox' ).on( 'change', '.multi-checkbox-input', function() {
    			var checkbox_values = $( this ).parents( '.customize-control-hmu-multi-checkbox' ).find( '.multi-checkbox-input:checked' ).map(
    				function() {
    					return this.value;
    				}
    			).get().join( ',' );

    			$( this ).parents( '.customize-control-hmu-multi-checkbox' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
    		}
    	);
    });

})( jQuery );
