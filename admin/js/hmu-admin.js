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

    //customizer editor settings
    jQuery( document ).on( 'tinymce-editor-setup', function( event, editor ) {
        editor.settings.toolbar1 = 'bold,italic,underline,blockquote,strikethrough,bullist,numlist,charmap,fullscreen';
        editor.settings.toolbar1 += ',alignleft,aligncenter,alignright,alignjustify,link,unlink,formatselect,forecolor,backcolor,hr,outdent,indent,undo,redo';
    });

} )( jQuery );