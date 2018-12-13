<?php

/**
 * Define the internationalization functionality
 *
 * @link       getbowtied.com
 * @since      1.0.0
 * @package    HMU
 * @subpackage HMU/includes
 * @author     GetBowtied
 */
class HookMeUp_i18n {


	/**
	 * Load the plugin text domain for translation.
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'hookmeup',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}
}
