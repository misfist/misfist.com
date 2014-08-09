=== Recent Photos ===
Plugin Name: Recent Photos
Plugin URI: http://www.instruite.com/blog/2010/02/28/recent-photos-plugin/
Description: Recent Photos from the media library in the sidebar
Author: instruite
Author URI: http://www.instruite.com
Contributors: instruite
Donate link: http://www.instruite.com
Version: 0.0.2
Stable tag: 0.0.2
Tags: photos, widget, thickbox, sidebar
Requires at least: 2.9
Tested up to: 2.9.2

== Description ==
Recent Photos Plugin provides with a widget to display n numbers of recent photos from the media library in the sidebar.
The display can be customized through custom css or integrated in main style sheet file.
Also provides an option to use Thickbox (along with the patch code necessary for running thickbox)

Demosites:

[Operation with default theme](http://playground.instruite.com/ "Operation with Default wp theme")

[Customized Version](http://www.instruite.com/ "Example of how widget can be customized")  

Author info:

Follow me on [Twitter](http://twitter.com/instruite/ "Follow instruite on twitter") or become my Friend on [facebook](http://www.facebook.com/instruite/ "Instruite's Facebook page")

== Installation ==

= Requirements =
* PHP: 4.4.x or 5.x.x
* mySQL: 4.0, 4.1 or 5.x
* WordPress: 2.9 or newer

= Basic Installation =
* Plugin folder in the WordPress plugins folder must be `recent-photos`
* Upload folder `recent-photos` to the `/wp-content/plugins/` directory
* Activate the plugin through the 'Plugins' menu in WordPress
* Go to WP Admin > Appereance > Widgets and put the 'Recent Photos' widget in your sidebar
* Configure the options as per your requirements and wordpress installation 

= Upgrade Instructions =
* Just Click 'Upgrade Plugin Automatically' within the Wordpress Plugin Admin Area 
* Go to WP Admin > Appereance > Widgets and put the 'Recent Photos' widget in your sidebar
* Configure the options as per your requirements and wordpress installation (New option for Randomize should be there)

== Other Notes ==
= Configuration Options =
* Title: Title for the widget will be displayed as per your theme
* Number of the photos: Number of photos that will be displayed in the sidebar
* Randomize: Check to display photos in random order
* Browse Photo Link: Full link to your photos/gallery page
          Leave blank if you don't want to show the link.
* Use Thickbox: Enables/Disables the use of thickbox for this widget 
* Wordpress Path: Applicable only if Thickbox is enabled 
        This option is necessary to provide the patch for thickbox to correctly display thickbox related images
        (loadinganimation and close). If your wordpress installation is in a subdirectory provide the path for the same
        followed by a forward slash
        Eg. wordpress/ 
            When the WP installation is in 'wordpress' subdirectory
* Use Custom CSS: Enable/Disables the use of Custom CSS
* Custom CSS: For styling this plugin requires following CSS ids and classes to be defined 
                #recent_photos_envelope{margin:0 0 30px 0;}
                .recent_photo_image a {float:left;display:inline;margin:0 16px 15px 0;border:1px dashed #888;padding:5px}
                .recent_photo_image a:hover {border:1px dashed #000} 
              The above css code is default css provided with the plugin 
   
== Frequently Asked Questions ==

= How to integrate css code in your default style sheet? =
Copy the default css code into your style sheet 

    #recent_photos_envelope{margin:0 0 20px 0;}
    .recent_photo_image a {float:left;display:inline;margin:0 16px 15px 0;border:1px dashed #888;padding:5px}
    .recent_photo_image a:hover {border:1px dashed #000}
    #browsephotos{margin: 0 25px 10px 12px; float:right;}

Enable Use Custom CSS option in the widget admin 

Make sure Custom CSS code textarea is blank (Should contain no spaces also) 

== Screenshots ==

== Changelog ==
= 0.0.2 =
* Added option to randomize photos

= 0.0.1 =
* Initial Release

