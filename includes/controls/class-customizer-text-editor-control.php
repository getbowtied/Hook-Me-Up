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

        wp_enqueue_script( 'tiny_mce' );

        wp_editor( $this->value(), $this->id, array(
          'textarea_name' => $this->id,
          '_content_editor_dfw' => false,
          'drag_drop_upload'    => true,
          'tabfocus_elements'   => 'content-html,save-post',
          'textarea_rows'       => 8,
          'default_editor'      => 'tinymce',
          'teeny'               => true,
          'tinymce'             => array(
            'resize'             => true,
            'wp_autoresize_on'   => true,
            'add_unload_trigger' => false,
          ),
        ) );

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