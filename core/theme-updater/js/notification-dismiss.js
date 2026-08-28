(function ($) {
	'use strict';

	$(document).on(
		'click',
		'.gbt-extender-theme-update-notice .notice-dismiss, .gbt-extender-theme-update-notice .dismiss-notification',
		function (e) {
			if ($(this).is('a')) {
				e.preventDefault();
			}

			var $notification = $(this).closest('.gbt-extender-theme-update-notice');
			var messageId = $notification.data('message-id');
			var themeSlug = $notification.data('theme-slug');

			if (!messageId || !themeSlug || typeof gbtExtenderThemeUpdateNotice === 'undefined') {
				return;
			}

			$.ajax({
				url: gbtExtenderThemeUpdateNotice.ajaxurl,
				type: 'POST',
				data: {
					action: gbtExtenderThemeUpdateNotice.action,
					message_id: messageId,
					theme_slug: themeSlug,
					nonce: gbtExtenderThemeUpdateNotice.nonce,
				},
				success: function (response) {
					if (response.success) {
						$notification.fadeOut(300, function () {
							$(this).remove();
						});
					}
				},
			});
		}
	);
})(jQuery);
