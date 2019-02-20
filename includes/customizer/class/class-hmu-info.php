<?php
/**
 * Info control class
 *
 * @package Customize_Info_Control
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	include ABSPATH . WPINC . '/class-wp-customize-control.php';
}

/**
 * Class WP_Customize_Info_Control
 */
class WP_Customize_Info_Control extends WP_Customize_Control {

	public $type = 'hmu-info';

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

		if ( ! empty( $args['info'] ) ) {
			$this->info = $args['info'];
		}
	}

	/**
	 * Render the control's content.
	 */
	public function render_content()
	{
		?>
		<span class="section_warning">
			<?php echo $this->info; ?>
		</span>
		<?php
	}

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {}
}