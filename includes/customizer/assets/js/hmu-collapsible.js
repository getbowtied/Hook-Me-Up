(function( $ ) {

    'use strict';

    $( function() {

        // Collapse all collapsible controls.
        $( '.customize-control-hmu-collapsible' ).closest( 'li[id*="_collapsible"]' ).toggleClass( 'customize-control-collapsed' );
        $( '.customize-control-hmu-collapsible' ).closest( 'li[id*="_collapsible"]' ).nextUntil( 'li[id*="_collapsible"]' ).toggleClass( 'customize-control-hidden' );

        $( '.customize-control-hmu-collapsible' ).on('click', '.tooltip-wrapper', function(e) {
            e.stopPropagation();
            $(this).find('.tooltip-content').toggleClass('hidden');
        } );

        // Expand collapsible controls on click.
        $( '.customize-control-hmu-collapsible' ).click( function() {

            $(this).closest( 'li[id*="_collapsible"]' ).toggleClass( 'customize-control-collapsed' );
            $(this).closest( 'li[id*="_collapsible"]' ).nextUntil( 'li[id*="_collapsible"]' ).toggleClass( 'customize-control-hidden' );

            // Mark as enabled if editor has content
            var editor = 'hookmeup_' + $(this).find('span').attr('class') + '_editor';
            editor = editor.replace(/"/g, '');
            if( wp.customize.control(editor) && wp.customize.control(editor).setting.get().length > 0) {
                $(this).find('div').addClass('enabled');
            } else {
                $(this).find('div').removeClass('enabled');
            }

        } );

        $( '.customize-control-hmu-collapsible' ).each( function() {
            var editor = 'hookmeup_' + $(this).find('span').attr('class') + '_editor';
            editor = editor.replace(/"/g, '');
            if( wp.customize.control(editor) && wp.customize.control(editor).setting.get().length > 0) {
                $(this).find('div').addClass('enabled');
            }
        });
    });

} )( jQuery );
