=== Plugin Name ===
Contributors: (this should be a list of wordpress.org userid's)
Donate link: getbowtied.com
Tags: comments, spam
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Here is a short description of the plugin.  This should be no more than 150 characters.  No markup here.

== Description ==

Hook Me Up plugin helps you customize WooCommerce templates without altering the code.
Using this plugin, you are just a few clicks away from having your desired e-commerce website.
You can add and manage custom code anywhere in the WooCommerce template just using the Wordpress Customizer. It works with any theme as long as WooCommerce plugin is installed and activated.

List of WooCommerce Hooks that can be customized using Hook Me Up:

Archive Page

Before Main Content
Before Shop Loop
Before Shop Loop Item
Before Shop Loop Item Title
After Shop Loop Item Title
After Shop Loop Item
After Shop Loop
After Main Content

Cart Page

Before Cart
Before Cart Table
After Cart Table
Before Cart Totals
Before Shipping Calculator
After Shipping Calculator
Proceed To Checkout
After Cart Totals
After Cart
Cart Is Empty

Checkout Page

Before Checkout Form
Before Checkout Billing Form
After Checkout Registration Form
After Checkout Billing Form
Before Checkout Shipping Form
After Checkout Shipping Form
After Order Notes
Before Order Review
Review Order - Before Payment
Review Order - After Payment
After Checkout Form

Single Product Page

Before Single Product
Single Product Summary
Before Add To Cart Form
After Add To Cart Form
Share
After Single Product

Account Page

Before Customer Login Form


A few notes about the sections above:

*   "Contributors" is a comma separated list of wp.org/wp-plugins.org usernames
*   "Tags" is a comma separated list of tags that apply to the plugin
*   "Requires at least" is the lowest version that the plugin will work on
*   "Tested up to" is the highest version that you've *successfully used to test the plugin*. Note that it might work on
higher versions... this is just the highest one you've verified.
*   Stable tag should indicate the Subversion "tag" of the latest stable version, or "trunk," if you use `/trunk/` for
stable.

    Note that the `readme.txt` of the stable tag is the one that is considered the defining one for the plugin, so
if the `/trunk/readme.txt` file says that the stable tag is `4.3`, then it is `/tags/4.3/readme.txt` that'll be used
for displaying information about the plugin.  In this situation, the only thing considered from the trunk `readme.txt`
is the stable tag pointer.  Thus, if you develop in trunk, you can update the trunk `readme.txt` to reflect changes in
your in-development version, without having that information incorrectly disclosed about the current stable version
that lacks those changes -- as long as the trunk's `readme.txt` points to the correct stable tag.

    If no stable tag is provided, it is assumed that trunk is stable, but you should specify "trunk" if that's where
you put the stable version, in order to eliminate any doubt.

== Installation ==

The easiest way:
Go to the Plugins Menu in WordPress
Search for “Hook Me Up”
Click “Install”

Or this easy way:
Download the plugin archive using the above button
Go to the Plugins Menu in WordPress and click "Add New"
Click on "Upload Plugin" and upload your archive 
Click "Install Now"

The not so easy way:
Upload the hookmeup folder to the /wp-content/plugins/directory
Activate the plugin through the ‘Plugins’ menu in WordPress


== Frequently Asked Questions ==

= A question that someone might have =

An answer to that question.

= What about foo bar? =

Answer to foo bar dilemma.

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 1.0 =
* A change since the previous version.
* Another change.

= 0.5 =
* List versions from most recent at top to oldest at bottom.

== Upgrade Notice ==

= 1.0 =
Upgrade notices describe the reason a user should upgrade.  No more than 300 characters.

= 0.5 =
This version fixes a security related bug.  Upgrade immediately.

== Arbitrary section ==

You may provide arbitrary sections, in the same format as the ones above.  This may be of use for extremely complicated
plugins where more information needs to be conveyed that doesn't fit into the categories of "description" or
"installation."  Arbitrary sections will be shown below the built-in sections outlined above.

== A brief Markdown Example ==

Ordered list:

1. Some feature
1. Another feature
1. Something else about the plugin

Unordered list:

* something
* something else
* third thing

Here's a link to [WordPress](http://wordpress.org/ "Your favorite software") and one to [Markdown's Syntax Documentation][markdown syntax].
Titles are optional, naturally.

[markdown syntax]: http://daringfireball.net/projects/markdown/syntax
            "Markdown is what the parser uses to process much of the readme file"

Markdown uses email style notation for blockquotes and I've been told:
> Asterisks for *emphasis*. Double it up  for **strong**.

`<?php code(); // goes in backticks ?>`