(function( $ ) {

    'use strict';

    $( document ).ready( function( $ ) {

        // Collapse all collapsible controls.
        $( '.customize-control-collapsible' ).closest( 'li[id*="_collapsible"]' ).toggleClass( 'customize-control-collapsed' );
        $( '.customize-control-collapsible' ).closest( 'li[id*="_collapsible"]' ).nextUntil( 'li[id*="_collapsible"]' ).toggleClass( 'customize-control-hidden' );

        $( '.customize-control-collapsible' ).on('click', '.tooltip-wrapper', function(e) {
            e.stopPropagation();
            $(this).find('.tooltip-content').toggleClass('hidden');
        } );

        // Expand collapsible controls on click.
        $( '.customize-control-collapsible' ).click( function() {

            $(this).closest( 'li[id*="_collapsible"]' ).toggleClass( 'customize-control-collapsed' );
            $(this).closest( 'li[id*="_collapsible"]' ).nextUntil( 'li[id*="_collapsible"]' ).toggleClass( 'customize-control-hidden' );

            // Mark as enabled if editor has content
            var editor = $(this).find('span').attr('class') + '_editor';
            editor = editor.replace(/"/g, '');
            if( wp.customize.control(editor).setting.get().length > 0) {
                $(this).find('div').addClass('enabled');
            } else {
                $(this).find('div').removeClass('enabled');
            }

        } );

        $( '.customize-control-collapsible' ).each( function() {
            var editor = $(this).find('span').attr('class') + '_editor';
            editor = editor.replace(/"/g, '');
            if( wp.customize.control(editor).setting.get().length > 0) {
                $(this).find('div').addClass('enabled');
            }
        });
    });

} )( jQuery );