jQuery(function($) {

	"use strict";

	// ==============================================
	// Elementor
	// ==============================================

	var GBT_ELEMENTOR_BUTTON_UPGRADE_1 = '<a class="e-admin-top-bar__bar-button" data-info="' + gbt_elementor.aff_text + '" href="' + gbt_elementor.aff_link_prices + '" target="_blank" original-title="" rel="opener"><i class="e-admin-top-bar__bar-button-icon eicon-pro-icon"></i><h1 class="e-admin-top-bar__bar-button-title">' + gbt_elementor.aff_text + '</h1></a>';

	var GBT_ELEMENTOR_BUTTON_1 = '<span>&nbsp;</span><a href="' + gbt_elementor.aff_link_prices + '" target="_blank" class="button">' + gbt_elementor.aff_text + '</a>';
	var GBT_ELEMENTOR_BUTTON_2 = '<span>&nbsp;&nbsp;&nbsp;</span><a href="' + gbt_elementor.aff_link_prices + '" target="_blank" class="elementor-button elementor-button-default">' + gbt_elementor.aff_text + '</a>';
	var GBT_ELEMENTOR_BUTTON_3 = '<span>&nbsp;&nbsp;&nbsp;</span><a href="' + gbt_elementor.aff_link_prices + '" target="_blank">' + gbt_elementor.aff_text + '</a>';
	var GBT_ELEMENTOR_BUTTON_4 = '<a class="e-admin-top-bar__bar-button" data-info="' + gbt_elementor.aff_text + '" href="' + gbt_elementor.aff_link_prices + '" target="_blank" original-title="" rel="opener"><i class="e-admin-top-bar__bar-button-icon eicon-pro-icon"></i><h1 class="e-admin-top-bar__bar-button-title">' + gbt_elementor.aff_text + '</h1></a>';
	var GBT_ELEMENTOR_BUTTON_5 = '<span class="active_license"> | <a href="' + gbt_elementor.aff_link_prices + '">' + gbt_elementor.aff_text + '</a></span>';

	if (gbt_elementor.is_FREE) {

		$('tr[data-plugin="elementor/elementor.php"] .go_pro a').attr("href", gbt_elementor.aff_link_prices);
		$('tr[data-plugin="elementor/elementor.php"] .plugin-version-author-uri a:nth-child(1)').attr("href", gbt_elementor.aff_link_homepage);
		$('tr[data-plugin="elementor/elementor.php"] .plugin-version-author-uri a:nth-child(3)').attr("href", gbt_elementor.aff_link_docs);
		
		if (gbt_elementor.is_PRO) {
			
			// FREE and PRO

			if ( ( typeof elementorAdminTopBarConfig != 'undefined' ) && ( ! elementorAdminTopBarConfig.is_user_connected ) )
			{
				$(GBT_ELEMENTOR_BUTTON_1).appendTo($(".e-notice__actions"));
				$(GBT_ELEMENTOR_BUTTON_1).appendTo($(".elementor-box-action"));
				$(GBT_ELEMENTOR_BUTTON_2).appendTo($(".elementor-blank_state"));
				$(GBT_ELEMENTOR_BUTTON_4).appendTo($(".e-admin-top-bar__secondary-area"));
				$(GBT_ELEMENTOR_BUTTON_5).appendTo($('tr[data-plugin="elementor-pro/elementor-pro.php"] .row-actions'));
			}

			$(GBT_ELEMENTOR_BUTTON_3).appendTo($(".e-notice-bar__action"));

			$('tr[data-plugin="elementor-pro/elementor-pro.php"] .plugin-version-author-uri a:nth-child(1)').attr("href", gbt_elementor.aff_link_homepage);
			$('tr[data-plugin="elementor-pro/elementor-pro.php"] .plugin-version-author-uri a:nth-child(2)').attr("href", gbt_elementor.aff_link_homepage);

		} else {
			
			// FREE but not PRO

			$(".elementor-button-go-pro").attr("href", gbt_elementor.aff_link_prices);			

			$(GBT_ELEMENTOR_BUTTON_UPGRADE_1).appendTo($(".e-admin-top-bar__secondary-area"));

		}

	}

});