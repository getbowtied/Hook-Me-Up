<?php
/**
 * Editor control class
 *
 * @package Customize_Editor_Control
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	include ABSPATH . WPINC . '/class-wp-customize-control.php';
}

/**
 * Class WP_Customize_Editor_Control
 */
class WP_Customize_Editor_Control extends WP_Customize_Control {

	public $type = 'hmu-editor';

	/**
	 * Constructor.
	 *
	 * Supplied `$args` override class property defaults.
	 *
	 * If `$args['settings']` is not defined, use the $id as the setting ID.
	 *
	 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string               $id      Control ID.
	 * @param array                $args    Optional. Arguments to override class property defaults.
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );

		if ( ! empty( $args['editor_settings'] ) ) {
			$this->input_attrs['data-editor'] = wp_json_encode( $args['editor_settings'] );
		}
	}

	/**
	 * Render the control's content.
	 */
	public function render_content() {
		?>
		<label>
			<textarea class="customize-editor-control" id="customize-editor-control-<?php echo intval( $this->instance_number ); ?>" <?php $this->input_attrs(); ?> <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
		</label>
		<?php
	}

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		wp_enqueue_editor();
		wp_enqueue_script(
			'customize-control-hmu-editor',
			plugins_url( 'assets/js/hmu-editor.js', dirname( __FILE__ ) ),
			array(
				'editor',
			),
			'1.2',
			true
		);
	}
}
