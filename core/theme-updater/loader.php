<?php
/**
 * Registers this plugin's theme updater copy. On plugins_loaded, the newest
 * library version among active companions is loaded once.
 *
 * Newer copies always win — including over older plugins that still direct-require
 * the legacy GBT_Extender_Theme_Updater class (those hooks are detached first).
 *
 * Bump $gbt_extender_theme_updater_version when updater logic changes.
 *
 * @package GetBowtied
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'gbt_extender_theme_updater_register' ) ) {

	/**
	 * @param string $version Updater library version (not the plugin version).
	 * @param string $file    Absolute path to class-gbt-extender-theme-updater.php.
	 */
	function gbt_extender_theme_updater_register( $version, $file ) {
		if ( ! isset( $GLOBALS['gbt_extender_theme_updater_candidates'] ) ) {
			$GLOBALS['gbt_extender_theme_updater_candidates'] = array();
			add_action( 'plugins_loaded', 'gbt_extender_theme_updater_boot', -99999 );
		}

		$GLOBALS['gbt_extender_theme_updater_candidates'][] = array(
			'version' => (string) $version,
			'file'    => $file,
		);
	}

	/**
	 * Strip hooks from legacy GBT_Extender_Theme_Updater (pre-loader direct require).
	 * PHP cannot redefine that class; we replace its behavior with *_Core instead.
	 */
	function gbt_extender_theme_updater_detach_legacy() {
		if ( ! class_exists( 'GBT_Extender_Theme_Updater', false ) ) {
			return;
		}

		global $wp_filter;

		if ( empty( $wp_filter ) || ! is_array( $wp_filter ) ) {
			return;
		}

		foreach ( $wp_filter as $hook_name => $hook ) {
			if ( ! is_object( $hook ) || empty( $hook->callbacks ) || ! is_array( $hook->callbacks ) ) {
				continue;
			}

			foreach ( $hook->callbacks as $priority => $callbacks ) {
				foreach ( (array) $callbacks as $callback ) {
					if ( empty( $callback['function'] ) || ! is_array( $callback['function'] ) ) {
						continue;
					}

					$fn     = $callback['function'];
					$target = $fn[0];
					$class  = is_object( $target ) ? get_class( $target ) : $target;

					if ( $class === 'GBT_Extender_Theme_Updater' ) {
						remove_filter( $hook_name, $fn, (int) $priority );
					}
				}
			}
		}
	}

	/**
	 * Load the highest-versioned updater implementation once.
	 */
	function gbt_extender_theme_updater_boot() {
		if ( ! empty( $GLOBALS['gbt_extender_theme_updater_booted'] ) ) {
			return;
		}

		$GLOBALS['gbt_extender_theme_updater_booted'] = true;

		if ( empty( $GLOBALS['gbt_extender_theme_updater_candidates'] ) || ! is_array( $GLOBALS['gbt_extender_theme_updater_candidates'] ) ) {
			return;
		}

		$winner = null;

		foreach ( $GLOBALS['gbt_extender_theme_updater_candidates'] as $candidate ) {
			if ( empty( $candidate['version'] ) || empty( $candidate['file'] ) ) {
				continue;
			}

			if ( null === $winner || version_compare( $candidate['version'], $winner['version'], '>' ) ) {
				$winner = $candidate;
			}
		}

		// Old companions may have already defined GBT_Extender_Theme_Updater — disarm them.
		gbt_extender_theme_updater_detach_legacy();

		if ( $winner && is_readable( $winner['file'] ) ) {
			require_once $winner['file'];
		}
	}
}

// Self-register this package copy (version lives here, not in the plugin bootstrap).
$gbt_extender_theme_updater_version = '1.2.0';

gbt_extender_theme_updater_register(
	$gbt_extender_theme_updater_version,
	__DIR__ . '/class-gbt-extender-theme-updater.php'
);
