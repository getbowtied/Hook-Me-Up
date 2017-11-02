( function( $ ) {

    'use strict';

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

    jQuery( document ).on( 'tinymce-editor-setup', function( event, editor ) {
        editor.settings.toolbar1 = 'insert,bold,italic,underline,blockquote,strikethrough,bullist,numlist,fullscreen';
        editor.settings.toolbar1 += ',alignleft,aligncenter,alignright,alignjustify,link,unlink,formatselect,forecolor,outdent,indent,undo,redo';
    });

} )( jQuery );