=== NextGEN Gallery Optimizer ===
Contributors: Mark Jeldi
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=YGS3ANA29BJ2W
Author URI: http://www.markstechnologynews.com
Plugin URI: http://www.markstechnologynews.com/2012/02/nextgen-gallery-optimizer-wordpress-plugin-helps-boost-your-sites-page-load-speed.html
Tags: nextgen gallery, nextgen, nextgen gallery optimizer, nextgen gallery plugins, nextgen gallery addons, nextgen gallery fancybox, fancybox, fancybox plugin, fancybox lightbox, fancybox for wordpress, wordpress fancybox, wordpress optimization
Requires at least: 3.1.2
Tested up to: 3.5
Stable tag: 1.1.2
License: GPLv2

Improves your site's page load speed by preventing NextGEN's scripts & css from loading on posts without galleries.

== Description ==

= NextGEN Gallery Optimizer =

Improves your site's page load speed by ensuring NextGEN Gallery's scripts and styles ONLY load on posts with the [nggallery id=x] shortcode.

It also includes and *automatically*-integrates the fantastic [Fancybox](http://fancybox.net) lightbox script, so now you can have gorgeous galleries AND a speedy site! *Requires [NextGEN Gallery](http://wordpress.org/extend/plugins/nextgen-gallery) 1.6.2 and up.

Please note: The basic version currently only supports the popular **[nggallery id=x]** shortcode and thus, will not load the extra scripts required for slideshows to function. If you require slideshow support, please consider downloading the [Premium version](http://www.markstechnologynews.com/nextgen-gallery-optimizer-premium)...

= NextGEN Gallery Optimizer *Premium* =

Builds on the basic version and adds support for ALL TEN of NextGen's shortcodes including **[nggallery id=x]**, **[slideshow id=x]**, **[album id=x]**, **[thumb id=x]**, **[singlepic id=x]**, **[imagebrowser id=x]**, **[nggtags gallery|album=mytag]**, **[random max=x]**, **[recent max=x]** and **[tagcloud]**.

It also adds support for the **[Show as slideshow]** link (loading slideshow scripts only after a user clicks-through), precision targeting for **shortcode SUB-pages** (ensuring we only load the scripts we need on each view), support for **JW Image Rotator** for stylish slideshows, support for **AJAX pagination on [imagebrowser id=x]** and now, features an attractive effect that **resizes Fancybox when the browser window is resized**.

This Premium version is available from the plugin settings page, [or can be downloaded here](http://www.markstechnologynews.com/nextgen-gallery-optimizer-premium).

If you have any questions, suggestions, ideas or feedback, please email me at mark@markstechnologynews.com

= Key features: =
1. Improves your WordPress page load speed!
2. Prevents NextGEN's scripts and styles from loading on posts without galleries.
3. Lets you easily install the Fancybox lightbox to display your images in style.


= NEW in Version 1.1.2: =
1. Tested compatible with WordPress 3.5 (Basic and Premium)
2. Latest Google-hosted jQuery 1.8.3 to match new WP version (Basic and Premium)
3. New admin notifications to assist with NextGEN installation (Basic and Premium)
4. Improvements to Optimizer's automatic Fancybox installation (Basic and Premium)

This release brings us up to date with WordPress 3.5, and features a number of additions and refinements to improve user experience. These include new admin notifications to assist users who don't have the required NextGEN Gallery plugin installed and activated, new step-by-step installation instructions via the WordPress admin (to ensure the correct file ownership and permissions are set), a streamlined settings page, and improvements to Optimizer's automatic Fancybox installation.


= NEW in Version 1.1.1: =
1. Dynamic messaging for admins on unsupported shortcodes (Basic)
2. Checks to ensure jQuery isn't being deregistered (Basic and Premium)
3. Includes blank index.php files for enhanced security (Basic and Premium)

This release aims to improve communication between Optimizer and end-users, including dynamic messaging for admins on unsupported shortcodes, and a clever regex that detects and alerts you if your theme (or child-theme) is deregistering jQuery...which causes Fancybox to break. Additionally, security is enhanced with the addition of blank index.php files in each folder, preventing bots from scanning your server's directory tree.


= NEW in Version 1.1 (first major release): =

1. Fancybox title now included in image height calculations (Basic and Premium)
2. New options: WordPress's included jQuery **or** go Google-hosted (Basic and Premium)
3. Support for the Thickbox effect (Basic and Premium)
4. Support for the Shutter effect (Basic and Premium)
5. Support for JW Image Rotator slideshow integration (Premium)
6. Support for AJAX pagination on [imagebrowser id=x] (reqs. Shutter) (Premium)
7. Fancybox gets extra fancy...auto-resizes when the browser is resized (Premium)

This first major release for Optimizer sees a number of new additions and features...
Fancybox now includes space for a single-line title in its image height calculations, vastly improving vertical alignment of the lightbox. Also, Optimizer now lets you choose between using WordPress's included jQuery (for greater compatibility), or the Google-hosted version (for faster page loads). Support for the Thickbox and Shutter effects has also been added thanks to user requests. 

On top of this, the Premium version now includes AJAX pagination when using Shutter on the [imagebrowser id=x] shortcode, supports the JW Image Rotator for slideshows and features a super-fancy, auto-resize function that *resizes Fancybox when the browser window is resized!*


= NEW in Version 1.0.8: =

1. Tested fully-compatible with WordPress 3.4 (Basic and Premium)
2. Improved compatibility with other plugins and themes (Basic and Premium)
3. Display fix for Fancybox when no title is available (Basic and Premium)
4. Latest jQuery 1.7.2 (Basic and Premium)

This version adds the jQuery.noConflict(); method for improved compatibility with plugins and themes using other javascript libraries/frameworks including script.aculo.us, Prototype and MooTools. It also includes a fix for Fancybox/NextGEN Gallery integration where a small white line would appear underneath the lightbox when no title was set.


= NEW in Version 1.0.7: =

1. Improved compatibility with other scripts and plugins. (Basic and Premium)
2. Minor bug fix in admin message. (Basic and Premium)

This version enhances compatibility with other plugins and includes a few minor improvements.


= NEW in Version 1.0.6: =

1. Fully-automated Fancybox installation! (Basic and Premium)


This version features completely automated Fancybox integration with NextGEN Gallery, so now you can be up and running even faster.


= NEW in Version 1.0.5: =

1. Precision matching with WordPress's built-in shortcode finder.
2. NextGEN Gallery Optimizer *Premium* (an optional upgrade for a small donation).


This version uses WordPress's native get_shortcode_regex() function for EXACT shortcode matching, ensuring scripts and styles don't load unexpectedly unless the FULL shortcode is present. If WordPress doesn't detect a shortcode, neither do we!

Also, this update introduces the new NextGEN Gallery Optimizer *Premium* version, which adds support for ALL TEN of NextGen's shortcodes, support for the [show as slideshow] link, the removal of NextGEN's version number comment and more.


= NEW in Version 1.0.4: =

1. Easier set up

This version automatically redirects first time users to the options page on activation and sets a default stylesheet for easier set up.


= NEW in Version 1.0.3: =

1. Optimized code for better compatibility and page load speed 
2. Improved settings page

This update results in faster page loads on gallery pages by avoiding duplicate scripts. It reduces the chance of conflicts with other plugins and makes setting up Fancybox even easier.


= NEW in Version 1.0.2: =

1. Support for WordPress Pages
2. Fancybox overlap fix
3. Fix for Fancybox not working in IE6 & IE8
4. Latest JQuery

This update lets you display galleries on both Posts AND Pages in style, but only load code when they're present.

It also fixes an issue where some page elements overlap Fancybox and prevent the close button from functioning (in particular the title text, header image and menu bar in Twenty Eleven).

It fixes the "Fancybox not working in IE6 & IE8" issue by automatically updating the Fancybox stylesheet to use the correct file paths, and we're now running Fancybox on  JQuery version 1.7.1, resulting in faster page loads where galleries are present.

== Installation ==

= Install NextGEN Gallery Optimizer: =

1. Download NextGEN Gallery Optimizer to your computer
2. Log into your WordPress admin
3. Click **Plugins --> Add New**
4. Click **Upload** (in the header)
5. Search your computer for **nextgen-gallery-optimizer.zip**
6. Click **Install Now**
7. Click **Activate Plugin**
8. Click **Settings --> NextGEN Optimizer** to complete installation.

* Note: If your computer automatically unzips your download, you'll need to re-compress it first.
* On Mac OSX: Ctrl+click the plugin folder --> Compress.
* On Windows: Right-click the plugin folder --> Send To --> Compressed (zipped) Folder.


= How do I set up a gallery? =

Firstly, you'll need a copy of NextGEN Gallery...
http://wordpress.org/extend/plugins/nextgen-gallery/

Once you've activated NextGEN Gallery on your plugins page, look for a "Gallery" tab at the bottom of your left sidebar in your WordPress admin.

1. Go to Gallery --> Add Gallery/Images
Click the "Add New Gallery" tab, enter a name for your gallery and click the "Add gallery" button.

2. Click the "Upload Images" tab, click the "Select Files" button and choose which images you want to upload from your computer, select the gallery you just created from the "in to" dropdown menu, and click the "Upload images" button to begin the transfer.

3. Finally, to insert your gallery, just create a new post or page (Posts --> Add New or Pages --> Add New), type the shortcode [nggallery id=1] into the editor, and click the "Publish" button on the right to save your changes. Note: The "1" in the shortcode should be the id number of the gallery you wish to display.

4. That's it! Navigate to the page you just created and your gallery should be live!

If you'd like to optimize this for speed, and add the Fancybox lightbox effect when you click on your gallery thumbnails, simply activate NextGEN Gallery Optimizer from your plugins page. With Optimizer enabled, your site will feel lighter and faster as it ensures the required scripts and styles only load on pages with galleries.


== Frequently Asked Questions ==

= General =
 
= Wait...my galleries are displaying in a vertical line! =

Please make sure you've selected a stylesheet on the (NextGEN Optimizer) settings page, and that you're using the [nggallery id=x] shortcode in your posts. This is the only supported shortcode in the basic version presently.

= Wait...my galleries are displaying properly, but my images load in a new window! =

If you're sure Fancybox is activated on Optimizer's settings page, and the lightbox still won't display using the "Use WordPress jQuery [greater compatibility]" setting, it is highly likely you have a conflict caused by two or more instances of jQuery loading on the same page. This is typically due to jQuery calls having been hard-coded into your theme.

Please inspect your theme files (the header.php and footer.php in particular) for lines including jquery.js or jquery.min.js and either comment them out, or remove them altogether.

Additionally, make sure you have wp_head(); in your theme's header.php file. It will usually be right before the closing </ head > tag, and is an essential hook for plugins such as Optimizer to be able to load the necessary scripts and styles.

= Help!...I can't see the NextGEN "Gallery" tab!!! =

1. Please make sure the "NextGEN Gallery" plugin is both installed and activated on your plugins page in the admin (it's a separate plugin available [here](http://wordpress.org/extend/plugins/nextgen-gallery/)). Once activated, the "Gallery" options tab should appear near the bottom of your left sidebar in the admin.

2. If you can't find the tab for your plugins page either, it's likely you're logged in as a user without administrative privileges. You can verify this by visiting http://www.yoursite.com/wp-admin/plugins.php.

= How do I set the Shutter or Thickbox effect? =

Firstly, you'll need to deactivate Fancybox on the Optimizer settings page and click "Save Options". After that, simply navigate to Gallery --> Options --> Effects, select your effect and click "Save Changes".

= Is this plugin compatible with minification/caching tools? =

Yes. However the small, already minified Fancybox script must be excluded from combining/minification or it won't function. This is true of any lightbox script.

For WP Minify, simply add /wp-content/plugins/nextgen-gallery-optimizer/fancybox/jquery.fancybox-1.3.4.pack.js in its js file exclusion options and clear the cache.

For W3 Total Cache, you'll need to select the "manual" minify option at Performance --> General Settings. After that, jump to Performance --> Minify where you can hand-pick the scripts and styles you want minified/combined (excluding Fancybox).

= What version of NextGEN Gallery is this plugin compatible with? =

Any version since 1.6.2


= Premium Version =
 
= Why won't my images click-through to a gallery on my [album id=x] shortcodes? =

It looks as though there may be a bug with one of NextGEN's settings. Go to Gallery --> Options --> Gallery Settings and make sure the first option "Deactivate gallery page link" is checked (as it is by default).

= I've just added a gallery to an album in NextGEN and I get a "Notice: Undefined property: stdClass::$gallery_ids" error message on my page. =

The drag-and-drop "Manage Albums" page in NextGEN does not auto-save like the WordPress widgets page. Click the "Update" button and your albums will display as they should.

= Help! My slideshows aren't working...they just show a rotating loading circle. =

Please go to GALLERY -> MANAGE GALLERY and select the gallery that's causing you trouble. Inside this gallery, ensure ALL image thumbnails are displaying and re-upload them if necessary. If they're missing, the "Path" field may have been changed, which will cause the slideshow to break.

Also, slideshows require two or more images in your galleries to function, else they'll break as above.

= How do I get regular pagination on NextGEN Album pages? =

By default, Album pages don't include pagination...but you can activate this feature by adding a custom field called "ngg_paged_Galleries" on the edit screen for your album page in the WordPress admin. The value of the custom field should be the number of albums you wish to display per page.

= Why doesn't Optimizer support NextGEN widgets? =

After spending weeks working on integrating this, I've discovered it's not presently possible in WordPress to:

1. Conditionally load the required scripts in the header AND

2. ONLY load them if the widget is actually present on the page.

Since both the Fancybox and the NextGEN slideshow scripts must be loaded in the head section of the page so they don't break, and since the whole point of this plugin is to NOT load scripts on every page, I've had to abandon this idea for the time being. If you know of a solution, do let me know and I'll add it in the next version!

= Why doesn't Premium support AJAX pagination on gallery pages? =

Apart from the [imagebrowser id=x] shortcode, I had hoped to add support for this on regular galleries and album galleries too, but unfortunately NextGEN's implementation to date is just too buggy, inconsistent and restrictive. For example...

1. You have to use the Shutter effect across your whole site.
2. It breaks the [Show as slideshow] links when activated.
3. It causes several error notices per page (visible in debug mode) read: massive error log.
4. It isn't coded to work at all on album main pages or on most shortcodes (UI inconsistency).

I've tried to iron out some of these issues myself, but to no avail. Hopefully the team at Photocrati will look into this for a future release.

= When I activate the JW Image Rotator in NextGEN Gallery, my slideshows only display a big black box! =

Before you can use JW Image Rotator, you'll need to [download it here](http://www.longtailvideo.com/players/jw-image-rotator), upload it to your wp-content/uploads folder and enter the FULL filepath to its imagerotator.swf file at Gallery --> Options --> Slideshow --> "Path to the Imagerotator (URL)".

Eg. http://sitename.com/wp-content/uploads/imagerotator/imagerotator.swf

Click "Save Changes" when you're done and you'll be all up and running.

**UPDATE: JW Image Rotator now comes bundled with NextGEN Gallery v1.9.9 and above, and requires no manual installation.**

= Why isn't Optimizer Premium detecting my Album gallery pages or the [Show as slideshow] links? =

This issue is likely caused by the "Activate permalinks" option at Gallery --> Options --> General Options, which changes NextGEN's URL structure for things such as the "Show as slideshow" and "Show picture list" links, as well as navigation through your Album pages. 

Optimizer Premium looks for NextGEN's default URL structure, which appends query string parameters to much of the navigation. With "Activate permalinks" switched on, these parameters are no longer present, which results in the plugin not recognizing where to add the necessary scripts for either Fancybox or slideshow functionality.

I'm currently working on a way to target these permalink URLs for a future version of the plugin, but for now, correcting the issue is as simple as navigating to Gallery --> Options --> General Options, switching off the "Activate permalinks" setting and clicking "Save Changes".



== Screenshots ==

1. NextGEN Gallery Optimizer settings page.


== Changelog ==

= V1.1.2 - 02/01/2013 =

* Added new checks to make sure NextGEN Gallery is both installed and activated. A new admin notification accompanies this to assist new users with downloading, activating and setting up NextGEN.

* Major improvements to Optimizer's automatic Fancybox installation. 1. Checks to make sure NextGEN Gallery is actually installed. 2. Automatically resets if the NextGEN database settings are deleted (so it can run again if reinstalled). 3. Now deactivates and restores former NextGEN Effects values when Optimizer's Fancybox option is switched off (as well as on plugin deactivation).

* Improved our "can't write css file" admin notification to include a small "how to" guide on changing file permissions, to assist users who are new to managing self-hosted sites.

* Replaced all upload instructions with a step-by-step guide to installing Optimizer via the WordPress admin. This method of installation is much faster than FTP, largely automated and most importantly, ensures the correct file ownership and permissions are set.

* Changed Google-hosted jQuery to version 1.8.3 to match the version now included in WordPress 3.5.

* Updated the Basic version's messaging in regards to the [Show as slideshow] text link for greater clarity.

* Removed the donate and hire me boxes from the Basic version's settings page, as some users had expressed annoyance.

* Explicitly defined database settings variables as globals so they're able to be used inside functions called on register_activation_hook().


= V1.1.1 - 08/11/2012 =

* Added a dynamic administrative message on the front-end for logged-in admins, which displays on posts/pages where unsupported shortcodes are being used. It's intended to inform admins about the Basic version's limitations in case they skipped the documentation, and highlight the Premium version's feature set in case it would be more appropriate for their requirements. [Basic only]

* Added a check to make sure jQuery isn't being deregistered in a user's theme, as it will break Fancybox. This regex runs on the plugins page and Optimizer's settings page in the admin, and looks for variants of "wp_deregister_script('jquery');" in the functions.php files of both the main active theme and the child theme (if present). If detected (and not re-registered with a CDN version), users are alerted via a message in the admin. [Basic and Premium]

* Added a blank index.php file inside each of Optimizer's folders to prevent Google from accessing and indexing the Apache directory tree. [Basic and Premium]


= V1.1 - 12/07/2012 =

* Added a conditional bottom margin in Fancybox's image height calculations to make room for single-line titles. By default, especially with large images, the titles would be squished against the bottom of the viewport.

* Added new options that allow users to choose between WordPress's included jQuery or Google-hosted jQuery. We used to just run the Google-hosted script, but as users have reported compatibility issues (even with the jQuery.noConflict(); method added in the last update) -- and that those issues have been resolved simply by using the built-in version instead -- I thought it would be best to make WordPress's jQuery the default and provide Google-hosted as an option.

* Added support for WordPress's native Thickbox lightbox integrated with NextGEN Gallery.

* Added support for NextGEN's built-in Shutter effect.

* Added support for NextGEN's JW Image Rotator assistant (Premium) after permission granted from the authors. Turns out we only needed to include WordPress's native swfobject.js on the slideshow shortcode (if activated at Gallery --> Options --> Slideshow --> "Enable flash slideshow"), and grab the file path to the user's downloaded imagerotator.swf file entered below that.

* Added support for NextGEN's AJAX pagination on the [imagebrowser id=x] shortcode (Premium). NextGEN also applies this to Gallery pages and Album gallery pages, but as I've outlined in the FAQ, the implementation is far too buggy, inconsistent and restrictive to add here. From a user interface perspective, it works rather well with imagebrowser (albeit, issuing notices), so I have added it in...but for the galleries, it's really not necessary. I'd say it's better to be without, than have it break the [Show as slideshow] links on the gallery pages.

* Added a function to Fancybox's scripts (Premium) to trigger an auto-resize when a user resizes their browser window. I've also added a slight delay for smooth animation and it looks great! Previously, the lightbox did center itself on window resize, but the image wouldn't rescale without first exiting and re-entering the lightbox.

* Changed three function names after adding support for Shutter and Thickbox (to be more descriptive and consistent).
1. nggo_load_fancybox is now nggo_load_fancybox_scripts
2. nggo_fancybox_style is now nggo_load_fancybox_styles
3. nggo_nextgen_style is now nggo_load_nextgen_styles

* Removed nggo_custom_style. Its functionality has been merged into nggo_load_nextgen_styles.

* Added version number to Optimizer's HTML comment to assist with support.

* Added a link to Premium in the plugin description.


= V1.0.8 - 18/06/2012 =

* Changed "compatible up to" version number after thorough testing on WordPress 3.4.

* Added the jQuery.noConflict(); method to improve compatibility with plugins and themes using other javascript libraries/frameworks including script.aculo.us, Prototype and MooTools.

* Fixed a Fancybox/NextGEN Gallery integration issue where a small white line would appear underneath the lightbox when no title was set.

* Recompiled jquery.fancybox-1.3.4.pack.js with Google Closure Compiler after above fix.

* Switched Google-hosted jQuery to the latest version (1.7.2).



= V1.0.7 - 29/05/2012 =

* Converted all jQuery "$" selectors in Fancybox's invocation code to "jQuery" to prevent conflicts with other plugins and scripts.

* Fixed a minor bug in the "file not writable" admin message whereby the filename was omitted.



= V1.0.6 - 04/04/2012 =

* Installation of Fancybox is now fully automated and set by default.
The plugin saves a copy of existing settings on the Gallery --> Options --> Effects page, then updates them with the Fancybox code so we don't have to enter it manually.
Any changes to this code are then overridden as long as the Fancybox option on the settings page is checked. This helps prevent accidental changes that would break integration. A safety switch, if you will.
There's also an admin message that prompts users to uncheck the Fancybox setting on the options page if they want to use another custom lightbox/effect.
On deactivation, Optimizer will attempt to restore the former values...but only if Fancybox is selected (don't want to write over newer custom values!)

* Removed installation instructions from the options pages as, well, we don't need them anymore.

* After discovering WordPress's auto-update downloads the full version of the plugin (not just the files that have changed), and with no way to redirect back to the plugin settings page from the upgrade page, I've set the Fancybox stylesheet regex to run on admin_init instead. Since we only want it to run once (on first activation and after auto-update), I've defined a version number in the code and added a "version" option to the settings array to check against.

* Added (if !defined()) to skip_load_scripts to avoid possible error messages when both basic and premium versions of the plugin are installed.

* Added extra fields to the options page for persistent plugin settings.



= V1.0.5 - 20/03/2012 =

* Replaced my shortcode regex with WordPress's native get_shortcode_regex() function for more precise matching.

* Added a pre-emptive fix to solve a common problem where jQuery dependent scripts (such as Fancybox and NextGEN's slideshow) break if jQuery doesn't load first. Added array('jquery') dependencies to wp_register_script calls (which forces jQuery to not only load when these scripts are called, but load first), as well as add_action priority values to influence their order.

* Launched my new NextGEN Gallery Optimizer *Premium* version which supports ALL TEN of NextGen's shortcodes, supports the [show as slideshow] link, adds targeting for shortcode sub-pages (eg. stylesheet only on album page / both styles and scripts (if selected) on album GALLERY pages) and adds the removal of NextGEN's version number comment.

* Added promotional box to the basic version's settings page.



= V1.0.4 - 18/03/2012 =

* Added an automatic redirect that sends first time users to the plugin options page on first activation.

* Added a one time welcome message on the redirect.

* Added a default setting for the stylesheet in case anyone forgets to set it.

* Added email contact to the settings page and main page at the plugin repository.

* Changed all instances of $nextgen_gallery_optimizer to a global $nggo_options variable for less cumbersome handling of 
database options.

* Moved the stylesheet dropdown if statements to scripts-and-styles.php to keep them together with their register and enqueue calls.



= V1.0.3 - 09/03/2012 =

* Replaced all hard-coded scripts and styles with WordPress's built-in wp_enqueue_scripts and wp_print_styles functions for better compatibility with other plugins.

* Added several instances of wp_deregister_script to pages we're serving jquery and jquery.fancybox.js on. This will prevent conflicts (and page load overhead) if any other installed plugins try to serve duplicate scripts.

* Added /wp-content/ url prefix to custom css input box on the settings page. Also made the Fancybox installation instructions clearer with larger text, a link to the NextGEN Effects page, and extra advice in the Tips section on plugin conflicts.



= V1.0.2 - 07/03/2012 =

* Added support for WordPress Pages

* Fixed an issue where some page elements overlap Fancybox and prevent the close button from functioning (in particular the title text, header image and menu bar in Twenty Eleven).

* Fixed a surprisingly common issue involving Fancybox not working in IE6 & IE8. My solution was to develop a regular expression that runs on the plugin options page ONLY to write the full urls Microsoft.AlphaImageLoader requires into the static Fancybox stylesheet. Much more efficient than some methods I've seen (such as dynamically rebuilding the stylesheet on every page view in php).

* Switched JQuery to the latest version 1.7.1 (Google hosted)



= V1.0.1 - 01/03/2012 =
* Resolved issue regarding upload to WordPress.org repository



= V1.0 - 28/02/2012 =
* Initial release on February 28th, 2012.



== Upgrade Notice ==
= Upgrade to V1.1.2 is recommended for a number of user experience improvements. =
= Upgrade to V1.1.1 is recommended for improved security and notifications. =
= Upgrade to V1.1.0 is recommended for several new features and improvements. =
= Upgrade to V1.0.8 is recommended for improved compatibility with other plugins and themes. =
= Upgrade to V1.0.7 is non-essential. Just a maintenance update. =
= Upgrade to V1.0.6 is recommended for a number of coding improvements. =
= Upgrade to V1.0.5 is recommended for more accurate shortcode detection. =
= Upgrade to V1.0.4 is non-essential. Adds features to assist new users in getting set up. =
= Upgrade to V1.0.3 recommended for improved compatibility with other plugins. =
= Upgrade to V1.0.2 recommended for cross-browser support. =