=== HookMeUp – Additional Content for WooCommerce ===
Contributors: getbowtied, vanesareinerth, traians, adrianlbs
Tags: hooks, theme, templates, woocommerce
Requires at least: 5.0
Tested up to: 5.8
Stable tag: 1.3.5
Requires PHP: 5.2.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
WC requires at least: 3.3.4
WC tested up to: 5.6.0

HookMeUp helps non-developers insert additional content in WooCommerce templates via **Appearance** > **Customize**. No coding required.

== Description ==

**HookMeUp** helps online store owners to customize WooCommerce templates without any coding knowledge. Insert custom content or even shortcodes in key areas of your store via **Appearance** > **Customize**.

The plugin was built to answer common questions such as:
How to add a banner above the shop page?

[youtube https://www.youtube.com/watch?v=Y8_u5AuX8_g]

HookMeUp will help you add additional content in the following WooCommerce templates:

- Shop & Categories (Archives)
- Single Product
- Cart
- Cart Widget
- Thank You Page
- Checkout
- Login / Register
- My Account


== Installation ==

The easiest way:
* In your WordPress admin dashboard navigate to the **Plugins** > **Add New**.
* Search for “HookMeUp”
* Click the “Install” button.

== Frequently Asked Questions ==

= Will HookMeUp work with my theme? =
Yes; HookMeUp should work with any WooCommerce compatible theme. Please note that themes may alter the original location of various WooCommerce hooks. If you run into any theme related issues you should reach out to theme author / theme support.

= Where can I report bugs or contribute to the project? =
Use the [HookMeUp GitHub Repository](https://github.com/getbowtied/Hook-Me-Up) to report issues or contribute to the plugin's development.

= Which WooCommerce templates can I customize? =

HookMeUp doesn't include the full list of [WooCommerce Hooks](https://docs.woocommerce.com/wc-apidocs/hook-docs.html) available, but the ones that make sense for common customizations.

**Archive Page**

- Before Main Content `woocommerce_before_main_content`
- Before Shop Loop `woocommerce_before_shop_loop`
- Before Shop Loop Item `woocommerce_before_shop_loop_item`
- Before Shop Loop Item Title `woocommerce_before_shop_loop_item_title`
- After Shop Loop Item Title `woocommerce_after_shop_loop_item_title`
- After Shop Loop Item `woocommerce_after_shop_loop_item`
- After Shop Loop `woocommerce_after_shop_loop`
- After Main Content `woocommerce_after_main_content`

**Single Product Page**

- Before Single Product `woocommerce_before_single_product`
- Single Product Summary `woocommerce_single_product_summary`
- Before Variations Form `woocommerce_before_variations_form`
- Before Add To Cart Form `woocommerce_before_add_to_cart_form`
- After Add To Cart Form `woocommerce_after_add_to_cart_form`
- Share `woocommerce_share`
- After Single Product `woocommerce_after_single_product`

**Cart Page**

- Before Cart `woocommerce_before_cart`
- Before Cart Table `woocommerce_before_cart_table`
- After Cart Table `woocommerce_after_cart_table`
- Before Cart Collaterals `woocommerce_before_cart_collaterals`
- Before Cart Totals `woocommerce_before_cart_totals`
- Before Shipping Calculator `woocommerce_before_shipping_calculator`
- After Shipping Calculator `woocommerce_after_shipping_calculator`
- Proceed To Checkout `woocommerce_proceed_to_checkout`
- After Cart Totals `woocommerce_after_cart_totals`
- After Cart `woocommerce_after_cart`
- Cart Is Empty `woocommerce_cart_is_empty`

**Cart Widget**

- Before Mini Cart `woocommerce_before_mini_cart`
- Mini Cart Contents `woocommerce_mini_cart_contents`
- Shopping Cart Buttons `woocommerce_widget_shopping_cart_buttons`
- After Mini Cart `woocommerce_after_mini_cart`

**Thank You Page**

- Thank You `woocommerce_thankyou`

**Checkout Page**

- Before Checkout Form `woocommerce_before_checkout_form`
- Before Checkout Billing Form `woocommerce_before_checkout_billing_form`
- After Checkout Registration Form `woocommerce_after_checkout_registration_form`
- After Checkout Billing Form `woocommerce_after_checkout_billing_form`
- Before Checkout Shipping Form `woocommerce_before_checkout_shipping_form`
- After Checkout Shipping Form `woocommerce_after_checkout_shipping_form`
- After Order Notes `woocommerce_after_order_notes`
- Before Order Review `woocommerce_checkout_before_order_review`
- Review Order - Before Payment `woocommerce_review_order_before_payment`
- Review Order - After Payment `woocommerce_review_order_after_payment`
- After Checkout Form `woocommerce_after_checkout_form`

**Login / Register**

- Before Customer Login Form `woocommerce_before_customer_login_form`
- Before Login Form `woocommerce_login_form_start`
- Before Login Submit Button `woocommerce_login_form`
- After Login Form `woocommerce_login_form_end`
- Before Register Form `woocommerce_register_form_start`
- Before Register Submit Button `woocommerce_register_form`
- After Register Form `woocommerce_register_form_end`
- After Customer Login Form `woocommerce_after_customer_login_form`

**My Account**

- Before Account Navigation `woocommerce_before_account_navigation`
- After Account Page Content `woocommerce_account_content`
- Account Dashboard `woocommerce_account_dashboard`

== Screenshots ==

1. Customizer Preview.


== Changelog ==

= 1.3.5 =
- Added Before Cart Collaterals Hook `woocommerce_before_cart_collaterals`
- Added Before Variations Form Hook `woocommerce_before_variations_form`
- Retested for compatibility with Wordpress 5.8 and WooCommerce 5.6.0

= 1.3.4 =
- Retested for compatibility with Wordpress 5.7.2 and WooCommerce 5.4.1

= 1.3.3 =
- Retested for compatibility with WooCommerce 4.9.1

= 1.3.2 =
- Retested for compatibility with Wordpress 5.6 and WooCommerce 4.8.0

= 1.3.1 =
- Retested for compatibility with Wordpress 5.5 and WooCommerce 4.4.0

= 1.3.0 =
- Small maintenance updates

= 1.2.9 =
- Retested for compatibility with Wordpress 5.4 and WooCommerce 4.0.1

= 1.2.8 =
- Retested for compatibility with WooCommerce 4.0.0

= 1.2.7 =
- Retested for compatibility with Wordpress 5.3.2 and WooCommerce 3.9.3

= 1.2.6 =
- Style improvements for customizer hook sections

= 1.2.5 =
- WordPress 5.3 compatibility updates
- WooCommerce 3.8.0 compatibility updates

= 1.2.4 =
- Fixed: Customizer settings are accessible to all logged in users with capability of edit theme options

= 1.2.3 =
- Retested for compatibility with Wordpress 5.2.2 and WooCommerce 3.6.4

= 1.2.2 =
- Fixed: Customizer live preview for 'Preview Available Hooks' options

= 1.2.1 =
- New hooks available for My Account Dashboard and Login/Register Page
- Fixed: Translation issues
- Fixed: Store and apply hooks to the site regardless of the active theme

= 1.2 =
- New hooks available for Cart Widget and Thank You Page
- Style improvements for customizer hook sections

= 1.1 =
- Rebuild Customizer using WordPress Customizer API
- Support for shortcodes

= 1.0.1 =
- Set customizer Hooks Preview option default to false

= 1.0 =
- Initial Version
