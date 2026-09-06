<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'GBT_Extender_Theme_Updater_Core' ) ) {

	/**
	 * Fallback theme updater for GetBowtied companion plugins.
	 * Detects the active theme slug from get_template().
	 * Active only when that theme does not ship its own updater.
	 *
	 * Named *_Core so it can load even when an older companion already defined
	 * the legacy GBT_Extender_Theme_Updater class (hooks detached by loader).
	 */
	class GBT_Extender_Theme_Updater_Core {

		/**
		 * Marker file for current GetBowtied dashboards (GBT_Theme_Update_Notice).
		 * Used only when that class is not loaded (front-end / cron).
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

		/** Extender-only auto-update enable (does not use theme dashboard AJAX/JS). */
		const AUTO_UPDATE_AJAX_ACTION  = 'gbt_extender_enable_theme_auto_updates';
		const AUTO_UPDATE_NONCE_ACTION = 'gbt_extender_enable_theme_auto_updates';

		/** @var bool */
		private static $booted = false;

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
			if ( self::$booted ) {
				return;
			}
			self::$booted = true;

			/*
			 * Companion plugins may require this file during after_setup_theme.
			 * Re-hooking after_setup_theme can miss the current run — register immediately
			 * when that hook has already started, and always reinforce on init.
			 */
			if ( did_action( 'after_setup_theme' ) ) {
				self::maybe_register();
			} else {
				add_action( 'after_setup_theme', array( __CLASS__, 'maybe_register' ), 20 );
			}

			add_action( 'init', array( __CLASS__, 'maybe_register' ), 0 );
		}

		public static function maybe_register(): void {
			$slug = self::theme_slug();

			if ( $slug === '' ) {
				return;
			}

			// Current themes load GBT_Theme_Update_Notice — leave updates to the theme.
			if ( self::theme_has_builtin_updater() ) {
				return;
			}

			if ( self::$fallback_registered ) {
				// Theme may register GBT_Theme_Updates hooks later on the same init.
				self::suppress_legacy_update_notices();
				return;
			}

			self::$fallback_registered = true;

			add_filter( 'site_transient_update_themes', array( __CLASS__, 'inject_update' ), 9999 );
			// Drop legacy license gating so it cannot re-block after we inject.
			add_filter( 'site_transient_update_themes', array( __CLASS__, 'suppress_legacy_update_notices' ), 1000 );
			add_filter( 'upgrader_pre_download', array( __CLASS__, 'suppress_legacy_update_notices' ), 0 );

			if ( is_admin() ) {
				// Legacy GBT_Theme_Updates registers its notice on init (default 10).
				add_action( 'init', array( __CLASS__, 'suppress_legacy_update_notices' ), 100 );
				add_action( 'admin_init', array( __CLASS__, 'suppress_legacy_update_notices' ), 0 );
				add_action( 'admin_notices', array( __CLASS__, 'suppress_legacy_update_notices' ), -999 );
				add_action( 'admin_notices', array( __CLASS__, 'render_admin_notice' ), 1 );
				add_action( 'admin_enqueue_scripts', array( __CLASS__, 'suppress_legacy_update_notices' ), 0 );
				add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_notice_assets' ), 1 );
				add_action( 'wp_ajax_' . self::NOTIFICATION_AJAX_ACTION, array( __CLASS__, 'ajax_dismiss_notice' ) );
				add_action( 'wp_ajax_' . self::AUTO_UPDATE_AJAX_ACTION, array( __CLASS__, 'ajax_enable_auto_updates' ) );

				// If init already ran (or theme already hooked), strip immediately.
				self::suppress_legacy_update_notices();
			}
		}

		/**
		 * True when the active parent theme should own updates without the extender.
		 *
		 * Admin: trust live class (dashboard is loaded there).
		 * Front/cron: dashboard is not loaded — infer from files so current themes
		 * are not taken over during update checks outside admin.
		 */
		private static function theme_has_builtin_updater(): bool {
			if ( class_exists( 'GBT_Theme_Update_Notice', false ) ) {
				return true;
			}

			// In admin (or WP-CLI), the dashboard would have loaded the notice class
			// if this were a current theme. Absence means extender may own.
			if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
				return false;
			}

			return self::current_theme_files_indicate_builtin();
		}

		/**
		 * Front/cron fallback when dashboard classes are not loaded.
		 * Marker without legacy class-theme-updates.php = current theme package.
		 */
		private static function current_theme_files_indicate_builtin(): bool {
			if ( ! function_exists( 'get_template_directory' ) ) {
				return false;
			}

			$theme_dir = get_template_directory();

			if ( ! is_string( $theme_dir ) || $theme_dir === '' ) {
				return false;
			}

			$base = trailingslashit( $theme_dir );

			if ( ! file_exists( $base . self::THEME_UPDATER_MARKER ) ) {
				return false;
			}

			// Transitional installs may ship the marker alongside legacy updates.
			if ( file_exists( $base . 'dashboard/inc/classes/class-theme-updates.php' ) ) {
				return false;
			}

			return true;
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

			$update = self::build_update( $slug );

			if ( ! $update ) {
				return $transient;
			}

			if ( ! isset( $transient->response ) || ! is_array( $transient->response ) ) {
				$transient->response = array();
			}

			// When this fallback owns updates, always own this slug's entry —
			// overwrite blocked:// and license-gated packages from GBT_Theme_Updates.
			$transient->response[ $slug ] = $update;

			return $transient;
		}

		/**
		 * Older dashboards show license/support-restricted update notices and
		 * license-subscription nags. When this fallback owns updates, strip those
		 * hooks so only the plugin update notice remains.
		 * Safe as an action or filter callback; always returns $value unchanged for filters.
		 *
		 * @param mixed $value Filter value (passed through).
		 * @return mixed
		 */
		public static function suppress_legacy_update_notices( $value = null ) {
			if ( self::theme_has_builtin_updater() ) {
				return $value;
			}

			$hooks = array(
				'admin_notices',
				'all_admin_notices',
				'admin_enqueue_scripts',
				'site_transient_update_themes',
				'upgrader_pre_download',
			);

			foreach ( $hooks as $hook ) {
				self::remove_legacy_theme_callbacks( $hook );
			}

			return $value;
		}

		/**
		 * Hard-remove legacy theme dashboard callbacks from a hook (direct unset).
		 * Only runs when the extender owns updates (old / transitional themes).
		 */
		private static function remove_legacy_theme_callbacks( string $hook ): void {
			global $wp_filter;

			if ( empty( $wp_filter[ $hook ] ) || ! ( $wp_filter[ $hook ] instanceof WP_Hook ) ) {
				return;
			}

			$legacy = array(
				'GBT_Theme_Updates'                  => array(
					'show_update_notice',
					'enqueue_dismissal_script',
					'filter_theme_transient',
					'block_theme_download',
					'filter_update_result',
				),
				'GBT_License_Subscription_Checker'   => array(
					'check_license_and_display_notification',
					'enqueue_dismissal_script',
				),
			);

			foreach ( $wp_filter[ $hook ]->callbacks as $priority => $callbacks ) {
				foreach ( $callbacks as $id => $callback ) {
					$fn = $callback['function'] ?? null;

					if ( ! is_array( $fn ) || ! isset( $fn[0], $fn[1] ) || ! is_object( $fn[0] ) ) {
						continue;
					}

					$class = get_class( $fn[0] );

					if ( ! isset( $legacy[ $class ] ) ) {
						continue;
					}

					if ( ! in_array( $fn[1], $legacy[ $class ], true ) ) {
						continue;
					}

					// Unset in place — leave empty priority buckets so in-flight WP_Hook
					// iterations do not hit a missing priority key.
					unset( $wp_filter[ $hook ]->callbacks[ $priority ][ $id ] );
				}
			}
		}

		public static function render_admin_notice(): void {
			self::suppress_legacy_update_notices();

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
			$auto_on    = self::is_theme_auto_update_enabled( $slug );
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
						<?php if ( ! $auto_on ) : ?>
							<span
								class="gbt-extender-auto-update-wrap"
								data-enabling-text="<?php echo esc_attr__( 'Enabling auto-updates…', 'hookmeup' ); ?>"
								data-success-text="<?php echo esc_attr__( 'Auto-updates are enabled.', 'hookmeup' ); ?>"
							>
								<?php
								echo esc_html__( 'You may also', 'hookmeup' ) . ' ';
								printf(
									'<a href="#" class="gbt-extender-enable-auto-updates" data-theme="%1$s"><strong>%2$s</strong></a>',
									esc_attr( $slug ),
									esc_html__( 'enable automatic updates', 'hookmeup' )
								);
								echo ' ' . esc_html__( "so you won't be bothered again.", 'hookmeup' );
								?>
							</span>
						<?php endif; ?>
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

			if ( ! self::is_theme_auto_update_enabled( $slug ) ) {
				wp_enqueue_script(
					'gbt-extender-theme-auto-update',
					plugins_url( 'js/auto-update-enable.js', __FILE__ ),
					array( 'jquery' ),
					'1.0',
					true
				);

				wp_localize_script(
					'gbt-extender-theme-auto-update',
					'gbtExtenderThemeAutoUpdate',
					array(
						'ajaxurl' => admin_url( 'admin-ajax.php' ),
						'action'  => self::AUTO_UPDATE_AJAX_ACTION,
						'nonce'   => wp_create_nonce( self::AUTO_UPDATE_NONCE_ACTION ),
					)
				);
			}
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

		/**
		 * Enable WP core theme auto-updates for the active supported theme.
		 * Independent of the theme dashboard handler (different action/nonce/JS).
		 */
		public static function ajax_enable_auto_updates(): void {
			check_ajax_referer( self::AUTO_UPDATE_NONCE_ACTION, 'nonce' );

			if ( ! current_user_can( 'update_themes' ) ) {
				wp_send_json_error( 'Insufficient permissions' );
			}

			if ( self::theme_has_builtin_updater() ) {
				wp_send_json_error( 'Theme owns updates' );
			}

			$theme_slug = isset( $_POST['theme_slug'] ) ? sanitize_key( wp_unslash( $_POST['theme_slug'] ) ) : '';
			$current    = self::theme_slug();

			if ( $theme_slug === '' || $current === '' || $theme_slug !== $current ) {
				wp_send_json_error( 'Invalid theme' );
			}

			$auto_updates = get_option( 'auto_update_themes', array() );

			if ( ! is_array( $auto_updates ) ) {
				$auto_updates = array();
			}

			if ( in_array( $theme_slug, $auto_updates, true ) ) {
				wp_send_json_success(
					array(
						'message' => 'Auto-updates are already enabled.',
					)
				);
			}

			$auto_updates[] = $theme_slug;
			$auto_updates   = array_values( array_unique( $auto_updates ) );

			if ( ! update_option( 'auto_update_themes', $auto_updates ) ) {
				// update_option returns false when value is unchanged; re-check.
				if ( ! self::is_theme_auto_update_enabled( $theme_slug ) ) {
					wp_send_json_error( 'Failed to enable auto-updates' );
				}
			}

			wp_send_json_success(
				array(
					'message' => 'Auto-updates have been enabled.',
				)
			);
		}

		private static function is_theme_auto_update_enabled( string $slug ): bool {
			if ( $slug === '' ) {
				return false;
			}

			$auto_updates = get_option( 'auto_update_themes', array() );

			return is_array( $auto_updates ) && in_array( $slug, $auto_updates, true );
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

	GBT_Extender_Theme_Updater_Core::init();
}

