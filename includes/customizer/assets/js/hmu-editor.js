( function( $ ) {

	"use strict";

	$( function() {

		var textareas = document.getElementsByClassName( 'customize-editor-control' );

		for ( var i = 0; i < textareas.length; i++ ) {
			var textarea, id, options;

			textarea = textareas[ i ];
			id = textarea.getAttribute( 'id' );
			options = textarea.getAttribute( 'data-editor' ) ? JSON.parse( textarea.getAttribute( 'data-editor' ) ) : {};

			wp.editor.initialize( id, options );
		}

		setInterval( function() {
			for ( var i = 0; i < textareas.length; i++ ) {
				var textarea, id, oldValue, newValue;

				textarea = textareas[ i ];
				id = textarea.getAttribute( 'id' );
				oldValue = textarea.value;
				newValue = wp.editor.getContent( id );

				if ( oldValue == newValue ) {
					continue;
				}

				textarea.value = newValue;
				$( textarea ).trigger( 'change' );
			}
		}, 500 );

		// Editor Settings
		$( document ).on( 'tinymce-editor-setup', function( event, editor ) {
			editor.settings.toolbar1 = 'bold,italic,underline,blockquote,strikethrough,bullist,numlist,charmap,fullscreen';
			editor.settings.toolbar1 += ',alignleft,aligncenter,alignright,alignjustify,link,unlink,formatselect,forecolor,backcolor,hr,outdent,indent,undo,redo';
		});

	});

})( jQuery );
