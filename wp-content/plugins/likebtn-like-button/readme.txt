=== LikeBtn Like Button ===
Contributors: likebtn
Donate link: http://likebtn.com
Tags: like button, vote, voting, rating, dislike
Requires at least: 2.8
Tested up to: 3.8
Stable tag: 1.8
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Like Button allows visitors to like and dislike pages, posts, custom post types and comments anonymously.

== Description ==

<strong><a href="http://likebtn.com" target="_blank" title="Like Button">LikeBtn.com</a></strong> - is the service providing a fully customizable like button widget for websites. The Like Button can be installed on any website for FREE. The service also offers a range of plans giving access to additional options and tools - see <a href="http://likebtn.com/en/#plans_pricing" target="_blank" title="Like Button Plans">Plans & Pricing</a>.

This plugin integrates the LikeBtn Like Button into your WordPress website to allow visitors to like and dislike pages, posts, custom post types and comments anonymously.

**Demo:** <a href="http://wordpress.likebtn.com/wordpress-like-button-plugin/" target="_blank" title="wordpress like button demo">http://wordpress.likebtn.com</a>

= Features =
* Allows visitors to like and dislike pages, posts, custom post types and comments anonymously.
* Visitors do not have to register or log in to use the Like Button.
* After liking visitors can share a link in social networks: Facebook, Twitter etc.
* Adds "Likes", "Dislikes" and "Likes minus dislikes" Custom Fields to posts and comments (PRO, VIP, ULTRA).
* Statistics on vote results (PRO, VIP, ULTRA).
* Shortcode to place the Like Button inside the post/page content: <code>[likebtn]</code>
* Shortcode to place a list of the most liked content inside the post/page using a shortcode (PRO, VIP, ULTRA): <code>[likebtn_most_liked]</code>
* Widget displaying most liked content (PRO, VIP, ULTRA).
* Customizable position and alignment.
* Can be displayed depending on the post view mode, format, category, ID.
* Appearance is controlled through CSS.
* Built-in styles.
* Built-in support for a number of languages.
* Allows to change all labels texts.
* Allows to collect donations using donate buttons in the popup.
* All <a href="http://likebtn.com/en/#settings" target="_blank" title="Like Button Settings">LikeBtn.com settings</a> are available.

== Installation ==

1. Upload `likebtn-like-button` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Configure the plugin in LikeBtn admin panel.

== Frequently Asked Questions ==

See also <a href="http://likebtn.com/en/faq" target="_blank" title="Like Button FAQ">LikeBtn FAQ</a>.

<strong>1. How can I place the Like Button inside the post/page content using a shortcode?</strong>

Use the following shortcode: `[likebtn]`

You can pass Like Button settings as parameters in the shortcode:
`[likebtn identifier="my_button_in_post" style="large"]`

If identifier parameter is not specified, post ID is used.


<strong>2. How can I display a list of the most liked content inside the post/page using a shortcode? (PRO, VIP, ULTRA)</strong>

Use the following shortcode:
`[likebtn_most_liked content_types="post,comment" title="Most liked posts and comments on my website" show_date="1" show_likes="0" show_dislikes="1" number="3"]`

Available content types: `post, page, attachment, revision, nav_menu_item, comment` and custom post types.


<strong>3. Identifier structure.</strong>

The `identifier` parameter in WordPress LikeBtn plugin has the following structure: **Post type** + **_** + **Post ID**

Examples:
<ul>
<li>post_1</li>
<li>page_7</li>
</ul>

So if you need to insert the LikeBtn HTML-code directly into WordPress post template, you can specify `identifier` parameter as follows:
`data-identifier="post_<?php the_ID()?>"`

<strong>4. Sort posts by likes.</strong>

After enabling synchronization WordPress Like Button plugin adds 3 custom fields to posts:
<ul>
<li>Likes</li>
<li>Dislikes</li>
<li>Likes minus dislikes</li>
</ul>

You can sort posts in WordPress by custom fields values using <a href="http://codex.wordpress.org/Function_Reference/query_posts" target="_blank">query_posts()</a> function. At first determine the template for inserting the code, it can be index.php, page.php, archive.php or any other depending on your needs and WordPress theme you are using. Then find the <a href="http://codex.wordpress.org/The_Loop" target="_blank">Loop</a> in the template. Finally insert the query_posts() function call above the Loop:
`<?php query_posts($query_string . '&meta_key=Likes&orderby=meta_value&order=DESC'); ?>
<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>
    <?php get_template_part( 'content', get_post_format() ); ?>
<?php endwhile; ?>`
In `meta_key` parameter specify one of the 3 custom fields provided by LikeBtn plugin. In `order` parameter specify the desired sort order: DESC (descending), ASC (ascending).

<strong>5. Using WordPress Like Button plugin in a Multisite network.</strong>

You can use LikeBtn plugin in a domain-based <a href="http://codex.wordpress.org/Create_A_Network" target="_blank">multisite networks</a> in which sites use subdomains. Using LikeBtn plugin in a path-based multisite networks in which on-demand sites use paths is not recommended for now, as vote results will intersect between sub-sites.

== Screenshots ==
1. Like Button
2. Plugin settings
3. Statistics
4. Most Liked Content Widget admin view
5. Most Liked Content Widget frontend view

== Changelog ==

= 1.8 =
* Added the feature allowing to change number of likes and dislikes in the admin
* Added Spanish language
* Added substract_dislikes to counter_type option
* Added single_number to counter_type option
* Added tooltip_enabled option
* Extended Help section

= 1.7 =
* Added TRIAL plan
* Added Website subdirectory option
* Added Allow to like and dislike at the same time option
* Added Turkish locale
* Fixed tabs URLs when website is located in the subfolder
* Added Show votes counter option
* Added Show information message when the button is restricted by the tariff plan option
* Added Use domain of the parent window option
* Added Text before donate buttons in the popup option
* Added Donate buttons to display in the popup option
* Added Order of the content in the popup option
* Added Hide popup when clicking outside option
* Added Popup HTML option
* Fixed conflict with WP HTTP Compression plugin
* Added HTML before and after options
* Added div wrapper around button
* Added Group identifier option
* Added Local domain option
* Extended Help section

= 1.6 =
* Fixed bug in sorting of the Most liked content widget
* Disabled synchronization for revisions
* Added user authorization option

= 1.5 =
* Import latest styles from LikeBtn.com in the background.
* Added JavaScript callback function serving as an event handler option.
* Added Show Like Button option.
* Added Reset likes and dislikes feature.

= 1.4 =
* Popup position options.
* Show copyright link in the share popup option.
* Popup style option.
* Time range option in Widget displaying most liked content.

= 1.3 =
* Synchronization test.
* Added shortcode to place a list of the most liked content inside the post/page using a shortcode.
* Added Reset button in Settings.
* Added auto disabling/enabling options depending on the plan selected.

= 1.2 =
* Synchronization of the vote results from LikeBtn.com into website database.
* Statistics on vote results.
* Most liked content widget.
* Added center alignment.
* Added shortcode to place the Like Button inside the post/page content.

= 1.1 =
* LikeBtn admin panel now available.

= 1.0 =
* LikeBtn Like Button plugin launched.

== Upgrade Notice ==

