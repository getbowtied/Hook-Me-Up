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
class WP_Customize_Collapsible_Control extends WP_Customize_Control {

	public $type = 'collapsible';

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

		if ( ! empty( $args['slug'] ) ) {
			$this->slug = wp_json_encode( $args['slug'] );
		}
	}

	/**
	 * Render the control's content.
	 */
	public function render_content() {
		?>
		<div class="customizer-control-collapsible">
			<span class="<?php echo esc_html( $this->slug ); ?>"></span>

			<div class="tooltip-wrapper">
				<span class="tooltip-trigger" data-setting="<?php echo esc_html( $this->slug ); ?>_collapsible">
					<span class="dashicons dashicons-editor-help"></span>
				</span>
				<div class="tooltip-content hidden" data-setting="<?php echo esc_html( $this->slug ); ?>_collapsible"><?php echo esc_html( $this->slug ); ?></div>
			</div>

			<h3>
				<div class="enabled-hook"></div>
				<?php echo esc_html( $this->label ); ?>
			</h3>
		</div>
		<?php
	}

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		wp_enqueue_editor();
		wp_enqueue_script(
			'customize-control-collapsible',
			plugins_url( 'js/hmu-collapsible.js', dirname( __FILE__ ) ),
			array(),
			'1.0.0',
			true
		);
	}
}
