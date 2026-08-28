<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'GBT_Extender_Theme_Updater' ) ) {

	/**
	 * Fallback theme updater for GetBowtied companion plugins.
	 * Detects the active theme slug from get_template().
	 * Active only when that theme does not ship its own updater.
	 */
	class GBT_Extender_Theme_Updater {

		/**
		 * Marker file relative to the parent theme root.
		 * Present on current GetBowtied themes that own update notices.
		 */
		const THEME_UPDATER_MARKER = 'dashboard/inc/classes/class-theme-update-notice.php';

		const UPDATE_URL_PATTERN = 'https://getbowtied.github.io/updates/themes/{slug}.json';

		const CACHE_TTL   = 12 * HOUR_IN_SECONDS;
		const FAILURE_TTL = HOUR_IN_SECONDS;

		/** Same transient key format as the theme dashboard (compatible dismissals). */
		const NOTIFICATION_TRANSIENT_PREFIX = 'gbt_notif_';
		const NOTIFICATION_DISMISS_DAYS     = 7;
		const NOTIFICATION_AJAX_ACTION      = 'gbt_extender_dismiss_theme_update_notice';
		const NOTIFICATION_NONCE_ACTION     = 'gbt_extender_dismiss_theme_update_notice';

		/** @var bool */
		private static $fallback_registered = false;
		private static $file_config = null;

		/** @var string|null Detected active supported theme slug, or '' if none. */
		private static $detected_slug = null;

		private static $trusted_hosts = array(
			'getbowtied.github.io',
			'github.com',
			'githubusercontent.com',
			'getbowtied.com',
			'getbowtied.net',
		);

		public static function init(): void {
			add_action( 'after_setup_theme', array( __CLASS__, 'maybe_register' ), 20 );
		}

		public static function maybe_register(): void {
			$slug = self::theme_slug();

			if ( $slug === '' ) {
				return;
			}

			// Current themes ship this file — leave updates to the theme / Freemius.
			if ( self::theme_has_builtin_updater() ) {
				return;
			}

			if ( self::$fallback_registered ) {
				return;
			}

			self::$fallback_registered = true;

			add_filter( 'site_transient_update_themes', array( __CLASS__, 'inject_update' ), 9999 );

			if ( is_admin() ) {
				add_action( 'admin_notices', array( __CLASS__, 'suppress_legacy_update_notices' ), 0 );
				add_action( 'admin_notices', array( __CLASS__, 'render_admin_notice' ) );
				add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_notice_assets' ) );
				add_action( 'wp_ajax_' . self::NOTIFICATION_AJAX_ACTION, array( __CLASS__, 'ajax_dismiss_notice' ) );
			}
		}

		/**
		 * True when the active parent theme includes the built-in updater file.
		 * File check only — never loads or calls theme classes (safe on any version).
		 */
		private static function theme_has_builtin_updater(): bool {
			if ( ! function_exists( 'get_template_directory' ) ) {
				return false;
			}

			$theme_dir = get_template_directory();

			if ( ! is_string( $theme_dir ) || $theme_dir === '' ) {
				return false;
			}

			$marker = trailingslashit( $theme_dir ) . self::THEME_UPDATER_MARKER;

			return file_exists( $marker );
		}

		/**
		 * @param object|false $transient
		 * @return object|false
		 */
		public static function inject_update( $transient ) {
			if ( ! is_object( $transient ) ) {
				return $transient;
			}

			// Safety net if the theme gained a built-in updater after this filter was registered.
			if ( self::theme_has_builtin_updater() ) {
				return $transient;
			}

			$slug = self::theme_slug();

			if ( $slug === '' ) {
				return $transient;
			}

			// Leave real packages alone (Freemius / another handler).
			// Replace legacy dashboard blocked:// entries so the free zip can install.
			if ( isset( $transient->response[ $slug ] ) ) {
				$existing = $transient->response[ $slug ];
				$package  = ( is_array( $existing ) && isset( $existing['package'] ) )
					? (string) $existing['package']
					: '';

				if ( ! self::is_blocked_package( $package ) ) {
					return $transient;
				}
			}

			$update = self::build_update( $slug );

			if ( ! $update ) {
				return $transient;
			}

			if ( ! isset( $transient->response ) || ! is_array( $transient->response ) ) {
				$transient->response = array();
			}

			$transient->response[ $slug ] = $update;

			return $transient;
		}

		/**
		 * Older dashboards (GBT_Theme_Updates) show a license/support-restricted notice.
		 * When this fallback owns updates, remove that notice so only the plugin notice remains.
		 */
		public static function suppress_legacy_update_notices(): void {
			if ( self::theme_has_builtin_updater() ) {
				return;
			}

			if ( ! class_exists( 'GBT_Theme_Updates', false ) ) {
				return;
			}

			global $wp_filter;

			if ( empty( $wp_filter['admin_notices'] ) || ! ( $wp_filter['admin_notices'] instanceof WP_Hook ) ) {
				return;
			}

			foreach ( $wp_filter['admin_notices']->callbacks as $priority => $callbacks ) {
				foreach ( $callbacks as $callback ) {
					$fn = $callback['function'];

					if (
						is_array( $fn )
						&& isset( $fn[0], $fn[1] )
						&& is_object( $fn[0] )
						&& $fn[0] instanceof GBT_Theme_Updates
						&& 'show_update_notice' === $fn[1]
					) {
						remove_action( 'admin_notices', $fn, (int) $priority );
					}
				}
			}
		}

		private static function is_blocked_package( string $package ): bool {
			return strpos( $package, 'blocked://' ) === 0;
		}

		public static function render_admin_notice(): void {
			if ( ! current_user_can( 'update_themes' ) ) {
				return;
			}

			if ( self::theme_has_builtin_updater() ) {
				return;
			}

			$slug = self::theme_slug();

			if ( $slug === '' ) {
				return;
			}

			$update = self::build_update( $slug );

			if ( ! $update ) {
				return;
			}

			$message_id = self::notice_message_id( $update );

			if ( self::is_notice_dismissed( $message_id ) ) {
				return;
			}

			$theme      = wp_get_theme( $slug );
			$theme_name = $theme->exists() ? $theme->get( 'Name' ) : $slug;
			$current    = self::get_installed_version( $slug );
			$update_url = admin_url( 'update-core.php#update-themes-table' );
			?>
			<div
				class="notice notice-info is-dismissible gbt-extender-theme-update-notice"
				data-message-id="<?php echo esc_attr( $message_id ); ?>"
				data-theme-slug="<?php echo esc_attr( $update['theme'] ); ?>"
			>
				<p style="display:flex;align-items:center;">
					<span class="dashicons dashicons-update" style="color:var(--wp-admin-theme-color);margin-right:8px;"></span>
					<span>
						<strong><?php echo esc_html( $theme_name ); ?> <?php echo esc_html( $update['new_version'] ); ?> is available.</strong>
						You&rsquo;re on <?php echo esc_html( $current ); ?>.
						<a href="<?php echo esc_url( $update_url ); ?>"><strong>Update now</strong></a> &mdash; includes new features and security fixes.
					</span>
				</p>
			</div>
			<?php
		}

		public static function enqueue_notice_assets(): void {
			if ( ! current_user_can( 'update_themes' ) ) {
				return;
			}

			if ( self::theme_has_builtin_updater() ) {
				return;
			}

			$slug = self::theme_slug();

			if ( $slug === '' ) {
				return;
			}

			$update = self::build_update( $slug );

			if ( ! $update || self::is_notice_dismissed( self::notice_message_id( $update ) ) ) {
				return;
			}

			wp_enqueue_script(
				'gbt-extender-theme-update-notice',
				plugins_url( 'js/notification-dismiss.js', __FILE__ ),
				array( 'jquery' ),
				'1.0',
				true
			);

			wp_localize_script(
				'gbt-extender-theme-update-notice',
				'gbtExtenderThemeUpdateNotice',
				array(
					'ajaxurl' => admin_url( 'admin-ajax.php' ),
					'action'  => self::NOTIFICATION_AJAX_ACTION,
					'nonce'   => wp_create_nonce( self::NOTIFICATION_NONCE_ACTION ),
				)
			);
		}

		public static function ajax_dismiss_notice(): void {
			check_ajax_referer( self::NOTIFICATION_NONCE_ACTION, 'nonce' );

			if ( ! current_user_can( 'edit_posts' ) ) {
				wp_send_json_error( 'Insufficient permissions' );
			}

			$message_id = isset( $_POST['message_id'] ) ? sanitize_text_field( wp_unslash( $_POST['message_id'] ) ) : '';

			if ( $message_id === '' ) {
				wp_send_json_error( 'Missing message ID' );
			}

			self::save_notice_dismissal( $message_id );

			wp_send_json_success( true );
		}

		private static function notice_message_id( array $update ): string {
			return 'theme_update_' . $update['theme'] . '_' . $update['new_version'];
		}

		private static function is_notice_dismissed( string $message_id ): bool {
			$user_id = get_current_user_id();

			return false !== get_transient( self::notification_transient_key( $user_id, $message_id ) );
		}

		private static function save_notice_dismissal( string $message_id ): bool {
			$user_id = get_current_user_id();

			return set_transient(
				self::notification_transient_key( $user_id, $message_id ),
				time(),
				self::NOTIFICATION_DISMISS_DAYS * DAY_IN_SECONDS
			);
		}

		private static function notification_transient_key( int $user_id, string $message_id ): string {
			return self::NOTIFICATION_TRANSIENT_PREFIX . $user_id . '_' . $message_id;
		}

		/**
		 * @return array{theme:string,new_version:string,url:string,package:string}|null
		 */
		private static function build_update( string $slug ) {
			$remote = self::get_remote_info();

			$remote_version    = isset( $remote['version'] ) ? (string) $remote['version'] : '';
			$download_url      = isset( $remote['download_url'] ) ? (string) $remote['download_url'] : '';
			$installed_version = self::get_installed_version( $slug );

			if ( $remote_version === '' || $download_url === '' ) {
				return null;
			}

			if ( ! version_compare( $remote_version, $installed_version, '>' ) ) {
				return null;
			}

			$details_url = ! empty( $remote['details_url'] )
				? (string) $remote['details_url']
				: self::details_url();

			return array(
				'theme'       => $slug,
				'new_version' => $remote_version,
				'url'         => $details_url,
				'package'     => $download_url,
			);
		}

		private static function get_installed_version( string $slug ): string {
			$theme = wp_get_theme( $slug );

			if ( ! $theme->exists() ) {
				return '';
			}

			return (string) $theme->get( 'Version' );
		}

		/**
		 * Extender-only cache — avoids pollution from the theme dashboard /info/ JSON.
		 *
		 * @return array{version?:string,details_url?:string,download_url?:string}
		 */
		private static function get_remote_info(): array {
			$cache_key = self::cache_key();
			$cached    = get_site_transient( $cache_key );

			// Any array is a hit — including [] failure cache (same as theme dashboard).
			if ( is_array( $cached ) ) {
				return $cached;
			}

			return self::fetch_and_cache( $cache_key );
		}

		/**
		 * @return array{version?:string,details_url?:string,download_url?:string}
		 */
		private static function fetch_and_cache( string $cache_key ): array {
			$update_url = self::update_url();

			if ( $update_url === '' || ! self::is_trusted_url( $update_url ) ) {
				set_site_transient( $cache_key, array(), self::FAILURE_TTL );
				return array();
			}

			$response = wp_safe_remote_get(
				$update_url,
				array(
					'timeout' => 8,
					'headers' => array( 'Accept' => 'application/json' ),
				)
			);

			if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) !== 200 ) {
				set_site_transient( $cache_key, array(), self::FAILURE_TTL );
				return array();
			}

			$body = json_decode( wp_remote_retrieve_body( $response ), true );

			if ( ! is_array( $body ) || empty( $body['version'] ) ) {
				set_site_transient( $cache_key, array(), self::FAILURE_TTL );
				return array();
			}

			$info = array(
				'version' => sanitize_text_field( (string) $body['version'] ),
			);

			if ( ! empty( $body['details_url'] ) ) {
				$info['details_url'] = esc_url_raw( (string) $body['details_url'] );
			}

			if ( ! empty( $body['download_url'] ) && self::is_trusted_url( (string) $body['download_url'] ) ) {
				$info['download_url'] = esc_url_raw( (string) $body['download_url'] );
			}

			// Incomplete payload (no installable package) — retry sooner than a full hit.
			$ttl = ! empty( $info['download_url'] ) ? self::CACHE_TTL : self::FAILURE_TTL;

			set_site_transient( $cache_key, $info, $ttl );

			return $info;
		}

		/**
		 * @return array{themes:array<string,array>}
		 */
		private static function get_file_config(): array {
			if ( null !== self::$file_config ) {
				return self::$file_config;
			}

			$file = include __DIR__ . '/config.php';
			$file = is_array( $file ) ? $file : array();

			$themes = isset( $file['themes'] ) && is_array( $file['themes'] ) ? $file['themes'] : array();

			self::$file_config = apply_filters(
				'gbt_extender_theme_updater_config',
				array(
					'themes' => $themes,
				)
			);

			if ( ! is_array( self::$file_config['themes'] ?? null ) ) {
				self::$file_config['themes'] = array();
			}

			return self::$file_config;
		}

		/**
		 * Active parent theme slug if it is in the supported list; otherwise ''.
		 */
		private static function theme_slug(): string {
			if ( null !== self::$detected_slug ) {
				return self::$detected_slug;
			}

			self::$detected_slug = '';

			if ( ! function_exists( 'get_template' ) ) {
				return self::$detected_slug;
			}

			$template = sanitize_key( (string) get_template() );

			if ( $template === '' ) {
				return self::$detected_slug;
			}

			$themes = self::get_file_config()['themes'];

			if ( isset( $themes[ $template ] ) && is_array( $themes[ $template ] ) ) {
				self::$detected_slug = $template;
			}

			return self::$detected_slug;
		}

		/**
		 * @return array{update_url?:string,details_url?:string}
		 */
		private static function theme_settings(): array {
			$slug   = self::theme_slug();
			$themes = self::get_file_config()['themes'];

			if ( $slug === '' || empty( $themes[ $slug ] ) || ! is_array( $themes[ $slug ] ) ) {
				return array();
			}

			return $themes[ $slug ];
		}

		private static function update_url(): string {
			$settings = self::theme_settings();

			if ( ! empty( $settings['update_url'] ) ) {
				return esc_url_raw( (string) $settings['update_url'] );
			}

			$slug = self::theme_slug();

			if ( $slug === '' ) {
				return '';
			}

			return esc_url_raw( str_replace( '{slug}', $slug, self::UPDATE_URL_PATTERN ) );
		}

		private static function details_url(): string {
			$settings = self::theme_settings();

			return ! empty( $settings['details_url'] )
				? esc_url_raw( (string) $settings['details_url'] )
				: '';
		}

		private static function cache_key(): string {
			return 'gbt_extender_theme_update_' . self::theme_slug();
		}

		private static function is_trusted_url( string $url ): bool {
			$host = wp_parse_url( $url, PHP_URL_HOST );

			if ( ! is_string( $host ) || $host === '' ) {
				return false;
			}

			$host = strtolower( $host );

			foreach ( self::$trusted_hosts as $allowed ) {
				if ( $host === $allowed ) {
					return true;
				}

				if ( substr( $host, -strlen( '.' . $allowed ) ) === '.' . $allowed ) {
					return true;
				}
			}

			return false;
		}
	}

	GBT_Extender_Theme_Updater::init();
}

