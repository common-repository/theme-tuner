=== Theme Tuner ===
Contributors: choppedcode
Tags: theme, css
Requires at least: 2.1.7
Tested up to: 3.8.1
Stable tag: 1.1

Theme Tuner is a plugin that allows you to edit in real-time the look-and-feel of your site.

== Description ==

The Theme Tuner plugin allows to adjust in real-time your theme. You downloaded a theme that you like but aren't happy with the background color, simply click on the page and change the color. Or you're not happy with the font size in the header, simply click on the header and increase or decrease the font size.

It also includes a bunch of extensions which allow you to change the layout of your pages and posts by simply including a shortcode. A number of widgets are included as well that allow you to for example make it easier to navigate your site.
Easy to use to fine tune any Wordpress theme.

== Installation ==

1. Upload the `theme-tuner` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to the Settings > Theme Tuner page and turn the tuner on or off
4. To use the extensions and widgets, please consult the respective tabs

== Frequently Asked Questions ==

= Widgets area extension =

[theme-tuner:post_link x]
 
Displays a link to a post or page, where x is a post or page ID
 
[theme-tuner: widget-area]

This inserts a widget area at the chosen location. Currently only one widget area is possible.

= Three columns extension =

[theme-tuner: 3columns x y z]

Inserts 3 columns in the page and pulls the information from pages with id x, y and z respectively.

= Posts table extension =
[theme-tuner: posts_table x]

Creates a table of posts for posts with category name set to x. The columns contain respectively: ID, image, title, excerpt, custom fields.

= Sub pages widget =

The sub pages widget shows sibling pages of the current page.

== Upgrade notice ==

Upgrades are handled automatically. Simply upload the latest version, and that's it.

Before upgrading, make sure you back up your database first!

== Changelog ==

= 1.1 =
* Verified compatibility with Wordpress 3.8.1

= 1.0 =
* Verified compatibility with Wordpress 3.6.1

= 0.9 =
* Replaced remote logo by local file

= 0.8 =
* Added option to specify ID special field in Posts Table extension
* In Posts Table extension, excerpt displays now an empty field if no excerpt is defined
* Fixed security issue
* Verified compatibility with Wordpress 3.3.1

= 0.7 =
* Fixed issues with formatting of FAQs
* Added column classes for extension "table posts"
* Added new extension "post_link" that displays a page link
* Tested with Wordpress 3.1

= 0.6 =
* Fixed version numbering problem
* Corrected wrong link to Facebook page

= 0.4 =
* Added link to our Facebook fan page on the plugin control panel
* Added link to our Twitter account on the plugin control panel
* Added Paypal donation link on the plugin control panel
* Added link to our rate the plugin on Wordpress on the plugin control panel
* Added link to help information on the plugin control panel
* Verified compatibility with Wordpress 3.0.5

= 0.3 =
* Added miniposts extension
* Added posts table extension
* Added sub pages extension
* Added widget area extension

= 0.2 =
* Compatibility with WP 3.0.4
* Renamed plugin
* Updated installation instructions
* Reformatted field edit section

= 0.1 =
* Alpha release
