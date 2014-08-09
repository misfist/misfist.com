=== Page Menu Editor ===
Contributors: sarahg111
Donate link: http://www.stuffbysarah.net/wordpress-plugins/#donate
Tags: pages, static, cms, sidebar, seo
Requires at least: 2.5
Tested up to: 3.8.1
Stable tag: 2.1.2

Allows you to customise the page link anchor text and title attribute output in wp_list_pages() or wp_page_menu().

== Description ==

This plugin gives you two additional inputs when Writing or Modifying a Static Page. One is for the page's menu label (anchor text), the other is for the title attribute within the link. By default there is no title attribute (as of 3.3). This plugin gives you more flexibility and will help to improve accessibility/usability.

== Installation ==

Installation Instructions:

1. Download the plugin and unzip it.
2. Put the 'page-menu-editor.php' file into your wp-content/plugins/ directory.
3. Go to the Plugins page in your WordPress Administration area and activate the Page Menu Editor.
4. Go to Write -> Page or Manage -> Pages and Edit an existing page.
5. The two new options will be displayed at the top of the Advanced options under 'Page Menu Editor'.

== Frequently Asked Questions ==

= What about if I don't want to set a custom menu label for a particular page? =

Just leave the menu label box blank and it will use the default value which is the same as the page header.

= I want the same value for my title attribute as my anchor text =

Okay, then either set the same value as your menu label or use %%menulabel%% so that it will always copy whatever the menu label is set to :)

= I want to use whatever the page title is of the page for my title attribute =

Use %%pagetitle%%

= What if I'm using custom nav menus? =

Then you don't need this plugin as you can control the anchor text and title attribute within those settings.


== Screenshots ==

1. Screenshot of the additional text fields

== Changelog ==

= 2.1.2 =

* Bug fixes that would throw up errors when WP_DEBUG was enabled (thanks Mark!)

= 2.1.1 =

* Bug fix for migration code that some experienced
* Bug fix for errors showing when label or attribute hadn't been set

= 2.1 =

* Rewritten the code to make it more efficient and extendable for the future.
* Added in an option to migrate settings over from the All In One SEO Pack due to requests.

= 2.0.5 =

* Added in a check for 3.3 which now doesn't have a title attribute by default

= 2.0.4 =

* Removed some unnecessary HTML comments causing spacing issues in MSIE

= 2.0.3 =

* Bug fix for the settings page link when the All in One SEO pack plugin is running.

= 2.0.2 =

* Fixed the code to work with the link_before and link_after parameters in wp_list_pages().

= 2.0.1 =

* Had to revert the code to work with link_before and link_after parameters as this was breaking with child menus

= 2.0 =

* Updated the admin in the add/edit Page to tidy it up
* Fixed the code to work with the link_before and link_after parameters in wp_list_pages().

= 1.9.1 =

* Fixed the insufficient permissions error
* Added two tags for the title attribute to save time on copying/writing content

= 1.9 =

* Fixed the error showing for some when upgrade page was loading

= 1.8 =

* Minor fixes

= 1.7 =

* Set the plugin priority to 1 as certain other menu plugins are getting their changes in first and preventing the plugin working.

= 1.6 =

* Added in a migration function to allow you to migrate your settings over to the new All in one SEO pack plugin (if you use it) as it now uses the same code.

= 1.5 =

* There is no 1.5 really, I just messed up the SVN update in the WP repository for version 1.4!

= 1.4 =

* Minor fixes plus stripping out the added backslashes

= 1.3 =

* Fixed an issue with version 1.2

= 1.2 =

* Have now combined the two boxes into one section. It now appears at the top of the Advanced Options.

= 1.1 =

* I realised you couldn't remove a label or attribute value once it had been set. This has now been rectified.

== Support ==

Support is provided at http://www.stuffbysarah.net/wordpress-plugins/page-menu-editor/