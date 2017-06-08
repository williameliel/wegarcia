=== Plugin Name ===
DsgnWrks Instagram Importer Debug

Contributors: jtsternberg
Plugin Name: DsgnWrks Instagram Importer Debug
Plugin URI: http://dsgnwrks.pro/plugins/dsgnwrks-instagram-importer-debug
Tags: instagram, import, backup, photo, photos, importer, debug
Author URI: http://about.me/jtsternberg
Author: Jtsternberg
Donate link: http://j.ustin.co/rYL89n
Requires at least: 3.1
Tested up to: 4.4
Stable tag: 0.1.6
Version: 0.1.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Extension to the "DsgnWrks Instagram Importer" plugin to allow for debugging info to be sent.

== Description ==

Occasionaly users will have errors with the Instagram Importer if the Instagram API has a hiccup or their instagram photo library is too large. This plugin allows me to help them by adding some debug options to the plugin admin panel.

--------------------------

Looking for the real plugin? Checkout the [DsgnWrks Instagram Importer](http://j.ustin.co/QbG3mQ). Feel free to [contribute to this plugin on github](http://j.ustin.co/QbQKpw).

== Installation ==

1. Upload the `zzz-dsgnwrks-instagram-importer-debug` directory to the `/wp-content/plugins/` directory.
2. Ensure the main plugin, [DsgnWrks Instagram Importer](http://j.ustin.co/QbG3mQ) is activated.
3. Activate the plugin through the 'Plugins' menu in WordPress.
4. Visit the plugin settings page (`/wp-admin/tools.php?page=dsgnwrks-instagram-importer-settings`) to enable debug options.

== Frequently Asked Questions ==

= ?? =
If you run into a problem or have a question, contact me ([contact form](http://j.ustin.co/scbo43) or [@jtsternberg on twitter](http://j.ustin.co/wUfBD3)). I'll add them here.


== Changelog ==

= 0.1.6 =
* Bug fix: was not properly deleting options when requested.

= 0.1.5 =
* Bug fix: Fix "Call to undefined method stdClass::get_option()" error.
* Updated: Plugin now requires version 1.3.7 of the DsgnWrks Instagram Importer to be installed.

= 0.1.4 =
* Bug fix: Update to work with new version of the instagram importer plugin.
* Updated: Plugin now requires version 1.3.6 of the DsgnWrks Instagram Importer to be installed.

= 0.1.3 =
* Bug fix: Remove deleta all filter before deactivating.

= 0.1.2 =
* Fixed: Admin notices hook name fixed.

= 0.1.1 =
* Updated: Added uinstall hook that deletes plugin option data when uninstalling plugin.
* Updated: Plugin now requires version 1.2.5 of the DsgnWrks Instagram Importer to be installed.
* Updated: Better error feedback.
* Updated: Plugin is automatically deactivated when using the "delete all settings and users" option.

= 0.1.0 =
* The beginning


== Upgrade Notice ==

= 0.1.6 =
* Bug fix: was not properly deleting options when requested.

= 0.1.5 =
* Bug fix: Fix "Call to undefined method stdClass::get_option()" error.
* Updated: Plugin now requires version 1.3.7 of the DsgnWrks Instagram Importer to be installed.

= 0.1.4 =
* Bug fix: Update to work with new version of the instagram importer plugin.
* Updated: Plugin now requires version 1.3.6 of the DsgnWrks Instagram Importer to be installed.

= 0.1.3 =
* Bug fix: Remove deleta all filter before deactivating.

= 0.1.2 =
* Fixed: Admin notices hook name fixed.

= 0.1.1 =
* Updated: Added uinstall hook that deletes plugin option data when uninstalling plugin.
* Updated: Plugin now requires version 1.2.5 of the DsgnWrks Instagram Importer to be installed.
* Updated: Better error feedback.
* Updated: Plugin is automatically deactivated when using the "delete all settings and users" option.

= 0.1.0 =
* The beginning
