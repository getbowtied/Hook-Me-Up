(function ($) {
	'use strict';

	$(document).on('click', '.gbt-extender-enable-auto-updates', function (e) {
		e.preventDefault();
		e.stopPropagation();

		if (typeof gbtExtenderThemeAutoUpdate === 'undefined') {
			return;
		}

		var $link = $(this);
		var $wrap = $link.closest('.gbt-extender-auto-update-wrap');
		var themeSlug = $link.data('theme');
		var enablingText = $wrap.data('enabling-text') || 'Enabling auto-updates…';
		var successText = $wrap.data('success-text') || 'Auto-updates are enabled.';
		var originalHtml = $wrap.html();

		if (!themeSlug || $wrap.data('busy')) {
			return;
		}

		$wrap.data('busy', true);
		$wrap.text(enablingText);

		$.ajax({
			url: gbtExtenderThemeAutoUpdate.ajaxurl,
			type: 'POST',
			data: {
				action: gbtExtenderThemeAutoUpdate.action,
				theme_slug: themeSlug,
				nonce: gbtExtenderThemeAutoUpdate.nonce,
			},
			success: function (response) {
				if (response && response.success) {
					$wrap.text(successText);
					$wrap.removeData('busy');
					return;
				}

				$wrap.html(originalHtml);
				$wrap.removeData('busy');
			},
			error: function () {
				$wrap.html(originalHtml);
				$wrap.removeData('busy');
			},
		});
	});
})(jQuery);
