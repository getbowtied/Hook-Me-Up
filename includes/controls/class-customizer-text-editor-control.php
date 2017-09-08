<?php

if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * Class to create a custom tags control
 */
class Text_Editor_Custom_Control extends WP_Customize_Control {

  function __construct($manager, $id, $options) {

    parent::__construct($manager, $id, $options);

    global $textareas_initiated;
    $textareas_initiated = empty($textareas_initiated) ? 1 : $textareas_initiated + 1;
  }

  function render_content() {

    global $textareas_initiated, $textareas_rendered;
    $textareas_rendered = empty($textareas_rendered) ? 1 : $textareas_rendered + 1;

    $value = $this->value();
    ?>
      <label>
        <span class="customize-text_editor"><?php echo esc_html($this->label); ?></span>
        <input id="<?php echo $this->id ?>-link" class="wp-editor-area" type="hidden" <?php $this->link(); ?> value="<?php echo esc_textarea($value); ?>">
        <?php

          $settings = array(
            'textarea_name' => $this->id,
            'media_buttons' => true,
            'drag_drop_upload' => true,
            'teeny' => true,
            'quicktags' => true,
            'textarea_rows' => 5,
            // tinymce changes are linked to customizer
            'tinymce' => [
              'setup' => "function (editor) {
                var cb = function () {
                  var linkInput = document.getElementById('$this->id-link')
                  linkInput.value = editor.getContent()
                  linkInput.dispatchEvent(new Event('change'))
                }
                editor.on('Change', cb)
                editor.on('Undo', cb)
                editor.on('Redo', cb) }"
              ]
            );

          wp_editor( $this->value(), $this->id, $settings );    

          if( $textareas_initiated == $textareas_rendered ) {
            do_action( 'admin_footer' );
            do_action( 'admin_print_footer_scripts' );
          }
          
        ?>
      </label>
    <?php
  }
}
?>