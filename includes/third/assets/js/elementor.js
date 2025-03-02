jQuery(function($) {

	"use strict";

	/**
	 * Scans the DOM and prepends the tracking URL.
	 * Handles both initial page load and dynamically injected content.
	 */
	function gbtEnhanceElementorLinks() {
		// Process all anchor elements
		$('a').each(function() {
			var $link = $(this);
			var href = $link.attr('href');
			
			// Get tracking URL from global variable
			var trackingPrefix = gbt_elementor.gbt_elementor_prefix_aff_link;
			
			// Extract domain from tracking URL for duplicate prevention check
			var trackingDomain = '';
			if (trackingPrefix) {
				var urlParser = document.createElement('a');
				urlParser.href = trackingPrefix;
				trackingDomain = urlParser.hostname;
			}
			
			// Verify link is an Elementor URL that hasn't been processed yet
			if (href && href.indexOf('elementor.com') !== -1 && (!trackingDomain || href.indexOf(trackingDomain) === -1)) {
				// Apply the modified URL
				var newHref = trackingPrefix + href;
				$link.attr('href', newHref);
			}
		});
	}

	// Process existing links on page initialization
	gbtEnhanceElementorLinks();
	
	// Monitor DOM for dynamically added Elementor links
	if (window.MutationObserver) {
		// Implement debouncing to optimize performance
		var debouncedModifyLinks = (function() {
			var timer = null;
			return function() {
				clearTimeout(timer);
				timer = setTimeout(function() {
					gbtEnhanceElementorLinks();
				}, 300);
			};
		})();

		// Initialize mutation observer
		var observer = new MutationObserver(function(mutations) {
			if (mutations.length) {
				debouncedModifyLinks();
			}
		});

		// Configure observer to monitor the entire DOM tree
		observer.observe(document.body, {
			childList: true,    // Track element additions/removals
			subtree: true,      // Include all descendants
			attributes: false,  // Ignore attribute changes
			characterData: false // Ignore text content changes
		});
	}

});