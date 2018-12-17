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

	public $type = 'hmu-collapsible';

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
			$this->slug = $args['slug'];
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
				<div class="enabled-hook">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
						<path class="svg-path" d="M12 6c3.31 0 6 2.69 6 6s-2.69 6-6 6-6-2.69-6-6 2.69-6 6-6m0-2c-4.42 0-8 3.58-8 8s3.58 8 8 8 8-3.58 8-8-3.58-8-8-8z"/>
						<circle class="svg-circle" cx="12" cy="12" r="8"/>
					</svg>
				</div>
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
			'customize-control-hmu-collapsible',
			plugins_url( 'assets/js/hmu-collapsible.js', dirname( __FILE__ ) ),
			array(),
			'1.2',
			true
		);
	}
}
