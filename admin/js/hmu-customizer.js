(function( $ ) {

    'use strict';

    $( document ).ready( function( $ ) {

        // Collapse all collapsible controls.
        $( '.customize-control-collapsible' ).closest( 'li[id*="_collapsible"]' ).toggleClass( 'customize-control-collapsed' );
        $( '.customize-control-collapsible' ).closest( 'li[id*="_collapsible"]' ).nextUntil( 'li[id*="_collapsible"]' ).toggleClass( 'customize-control-hidden' );

        // Expand collapsible controls on click.
        $( '.customize-control-collapsible' ).click( function() {

            $(this).closest( 'li[id*="_collapsible"]' ).toggleClass( 'customize-control-collapsed' );
            $(this).closest( 'li[id*="_collapsible"]' ).nextUntil( 'li[id*="_collapsible"]' ).toggleClass( 'customize-control-hidden' );

            // Mark as enabled if editor has content
            var editor = $(this).find('span').attr('class') + '_editor';
            if( wp.customize(editor).get().length > 0) {
                $(this).find('div').addClass('enabled');
            } else {
                $(this).find('div').removeClass('enabled');
            }

        } );

        $( '.customize-control-collapsible' ).each( function() {
            var editor = $(this).find('span').attr('class') + '_editor';
            if( wp.customize(editor).get().length > 0) {
                $(this).find('div').addClass('enabled');
            }
        });
    });

    // Editor Settings
    $( document ).on( 'tinymce-editor-setup', function( event, editor ) {
        editor.settings.toolbar1 = 'bold,italic,underline,blockquote,strikethrough,bullist,numlist,charmap,fullscreen';
        editor.settings.toolbar1 += ',alignleft,aligncenter,alignright,alignjustify,link,unlink,formatselect,forecolor,backcolor,hr,outdent,indent,undo,redo';
    });

} )( jQuery );