=== Typekit Fonts for WordPress ===
Contributors: jamescollins, glenn-om4
Donate link: https://om4.com.au/plugins/#donate
Tags: typekit, fonts, font, design, wp, multisite, wpmu, css, snippet
Requires at least: 4.2
Tested up to: 4.6
Stable tag: 1.8.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Use a range of hundreds of high quality fonts on your WordPress website by integrating the Typekit font service into your WordPress website or blog.

== Description ==

Embed and use [Typekit](https://typekit.com/) fonts in your WordPress website without having to edit your theme!

Typekit offer a service that allows you to select from a range of hundreds of high quality fonts for your WordPress website. The fonts are applied using the font-face standard, so they are standards compliant, fully licensed and accessible.

To use this plugin you need to sign up with Typekit, install this plugin and then either configure some Typekit selectors or define your own CSS rules. Typekit selectors provide a quick and easy way to get fonts enabled on your site.  Using your own CSS rules (as explained in Typekit's Advanced tips) gives you more control and lets you access additional attributes such as font-weight. This plugin allows you to create your own CSS rules that use Typekit fonts without the need to edit/upload CSS style sheets. 

Detailed instructions are available on the plugin's settings page.

This plugin uses [Typekit's asynchronous embed code](http://blog.typekit.com/2015/08/04/new-embed-code-for-asynchronous-font-loading/), which doesn't block the rendering of the page while fonts are loading.

Compatible with WordPress Multisite.

**Available Languages**

* Japanese – 日本語 ( ja )

**Other Languages**

If you would like to translate this plugin into another language, [please visit the translate.wordpress.org site](https://translate.wordpress.org/projects/wp-plugins/typekit-fonts-for-wordpress). Thank you!

== Installation ==

Installation of this plugin is simple:

1. Download the plugin files and copy to your Plugins directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Go to the WordPress Dashboard, and use Settings, Typekit Fonts to enter the whole 2 lines of your Typekit embed code.
1. If you want to setup some CSS selectors like the examples shown in the Advanced link, enter your CSS rules in the plugin settings as well.

== Frequently Asked Questions ==

= Where can I get help? =

There are detailed instructions on the plugin's settings page. See screenshot #2 for more information.

= Is this plugin secure? =

Yes, see the plugin's description for more information.

= Which web browser(s) does Typekit support? =

Please see [this page](http://help.typekit.com/customer/portal/articles/6786-browser-and-os-support) for information on [Typekit web browser support](http://help.typekit.com/customer/portal/articles/6786-browser-and-os-support).

== Screenshots ==
1. Settings/configuration page
2. Detailed inline help

== Changelog ==

= 1.8.2 =
* WordPress 4.6 compatibility.
* Improved handling of the HTTP response when verifying a Typekit Kit URL.

= 1.8.1 =
* PHP7 compatibility (no more deprecated constructor warning).

= 1.8 =
* Use WordPress.org language packs for plugin translations.
* Improved compatibility with older PHP versions (no more pass by reference).
* Screenshot updates.
* Readme updates.

= 1.7.2 =
* Use Typekit's latest recommended embed code (which uses a https:// Typekit embed code URL for all sites).
* WordPress 4.3 compatibility.
* Change plugin's textdomain to match the plugin's folder name in preparation for translate.wordpress.org translations.

= 1.7.1 =
* WordPress 4.1 compatibility.
* Readme updates.

= 1.7 =
* Japanese language - thanks to ThemeBoy.
* Improved translation support.

= 1.6 =
* WordPress 3.8 compatibility.

= 1.5 =
* WordPress 3.5 compatibility.

= 1.4 =
* Use the new scheme-less typekit.net embed code format ( ﻿//use.typekit.net/xyz.js ).

= 1.3.1 =
* WordPress 3.4 compatibility.
* Clarify license as GPLv2 or later.

= 1.3 =
* WordPress 3.3 compatibility.

= 1.2 =
* Fix invalid HTML on settings page.
* Properly save/display settings.
* WordPress 3.2 compatibility.
* Translation/localization improvements.
* Fix localization deprecated notice (thanks to aradams for reporting).
* Store translation files in a /languages sub directory.

= 1.1 =
* WordPress 3.1 compatibility.

= 1.0.3 =
* Add support for HTTPS/SSL websites.
* WordPress 3.0.1 compatibility.

= 1.0.2 =
* Add instructions on how to use Typekit Kit Editor selectors.
* Add instructions on how to use font weights / styles. 

= 1.0.1 =
* WordPress 2.9 compatibility.
* Improve FAQ.

= 1.0.0 =
* Initial release.

== Upgrade Notice ==

= 1.8 =
* Support for translate.wordpress.org language packs.
* WordPress 4.3 (and 4.4) compatibility.

= 1.7 =
* Japanese language support.

= 1.5 =
* WordPress 3.5 compatibility.

= 1.4 =
* Adds support for Typekit's new embed code format.

= 1.3.1 =
* WordPress 3.4 compatibility, clarify license as GPLv2 or later.

= 1.3 =
* WordPress 3.3 compatibility.

= 1.2 =
* WordPress 3.2 compatibility, translation/localization improvements, invalid HTML fixes.

= 1.1 =
* WordPress 3.1 compatibility.