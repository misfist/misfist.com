<?php
/*
Plugin Name: Recent Photos
Plugin URI: http://www.instruite.com/blog/2010/02/28/recent-photos-plugin/
Description: Recent Photos from the media library in the sidebar
Version: 0.0.2
Author: Hemant Nandrajog
Author URI: http://www.instruite.com
*/
/*  Copyright 2010  Hemant Nandrajog (email : recent-photos-plugin@instruite.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/* Main Widget Function */
function rp_widget($args)
{
  extract($args);
  global $rp_settings;
  //Get the options
  $rp_settings = get_option("rp_widget_option");
  
  // Add Thickbox if enabled
  if ($rp_settings['rp_thickbox'] == 'on') {
    //add_action('init',  wp_enqueue_script('scriptaculous') );
    add_thickbox();
    add_action('wp_footer', 'rp_inline_script');
    
  }
  
  //If number of attachments to be displayed is less than 1 make it default to 6
  if ($rp_settings['rp_number'] < 1) $rp_settings['rp_number'] = 6;
  
  if ($rp_settings['rp_custom_css'] == 'on') {
    if (!$rp_settings['rp_css'] == "") {
      echo "<style type='text/css'>";
      echo $rp_settings['rp_css'];
      echo "</style>";
    }
  } else { //inline default css
?>
  <style>
    #recent_photos_envelope{margin:0 0 20px 0;}
    .recent_photo_image a {float:left;display:inline;margin:0 16px 15px 0;border:1px dashed #888;padding:5px}
    .recent_photo_image a:hover {border:1px dashed #000}
    #browsephotos{margin: 0 25px 10px 12px; float:right;}
  </style>
<?php
  }
  echo $before_widget;
	echo $before_title . $rp_settings['rp_widget_title'] . $after_title; 
?>
  <div id="recent_photos_envelope">	
<?php
  global $wpdb;	
  $posts = get_posts(array(
			           //"showposts"=>-1,
			           //"what_to_show"=>"posts",
			           "post_status"=>"inherit",
			           "numberposts"=>$rp_settings['rp_number'],
			           "post_type"=>"attachment",
			           "post_mime_type"=>"image/jpeg,image/gif,image/jpg,image/png",
			           "orderby"=>"menu_order ASC, ID ASC"			           ));
	//Rev 0.0.2 - Adding Random feature 
	//Random feature if it is selected
  if ($rp_settings['rp_randomize'] == 'on') shuffle($posts);

	for($i = 0; $i < $rp_settings['rp_number'] ; $i++)
	 {
      $attachmentpost = $posts[$i];
      if($src = wp_get_attachment_thumb_url($attachmentpost->ID))
          {
            $attachment_title = get_the_title($attachmentpost->ID);
            $attachment_url = wp_get_attachment_url($attachmentpost->ID); 
            $id = $attachmentpost->ID;
        ?>
            <div class="recent_photo_image">
              <a class='thickbox' rel="recent_photos" href="<?php echo $attachment_url; ?>" title="<?php echo $attachment_title;  ?>">
                <img src="<?php echo $src; ?>" alt="<?php echo $attachment_title;  ?>" title="<?php echo $attachment_title;  ?>" height="75" width="75" />
              </a>
            </div>
    
    <?php 
				}
	 }
	 ?>
	     <br />
	 <?php 
      if (!$rp_settings['rp_browse_link'] == "") { ?>
        <a id="browsephotos" href="<?php echo $rp_settings['rp_browse_link'];?>"><span class="replace">Browse Photos</span></a>
    <?php  }
   ?>
	   </div>
	 <?php
	  echo $after_widget;
}

/* Function for administration of the widget */
function rp_widget_Admin() {
  $rp_settings = get_option("rp_widget_option");
	// check if options have been updated
	if (isset($_POST['update_rp_widget'])) {
		$rp_settings['rp_widget_title']= strip_tags(stripslashes($_POST['rp_widget_title']));
    $rp_settings['rp_number'] = strip_tags(stripslashes($_POST['rp_number']));
    //Rev 0.0.2 - Adding Random Feature
    $rp_settings['rp_randomize'] = strip_tags(stripslashes($_POST['rp_randomize']));
    $rp_settings['rp_browse_link'] = strip_tags(stripslashes($_POST['rp_browse_link']));
    $rp_settings['rp_thickbox'] = strip_tags(stripslashes($_POST['rp_thickbox']));
    $rp_settings['rp_thickbox_path'] = strip_tags(stripslashes($_POST['rp_thickbox_path']));
    $rp_settings['rp_custom_css'] = strip_tags(stripslashes($_POST['rp_custom_css']));
    $rp_settings['rp_css'] = strip_tags(stripslashes($_POST['rp_css']));
		update_option("rp_widget_option",$rp_settings);
	}
	echo '<p>
	      <label for="rp_widget_title"><strong>Title:</strong>
          <input  id="rp_widget_title" tabindex="1" name="rp_widget_title" type="text" size="15" value="'.$rp_settings['rp_widget_title'].'" />
        </label><br />
        <label for="rp_number"><strong>Number of Photos:</strong>
          <input  id="rp_number" name="rp_number" type="text" tabindex="2" size="3" value="'.$rp_settings['rp_number'].'" />
        </label><br />
        <label for="rp_randomize"><strong>Randomize:</strong>
          <input type="checkbox" tabindex="3"  name="rp_randomize" ';
            if ($rp_settings['rp_randomize'] == 'on') echo 'checked'; 
 echo '   />
        </label><br />
        <label for="rp_browse_link"><strong>Browse Photo Link:</strong><br />
          <input  id="rp_browse_link" name="rp_browse_link" type="text" tabindex="42" class="widefat" value="'.$rp_settings['rp_browse_link'].'" />
        </label><br />
        <label for="rp_thickbox"><strong>Use Thickbox:</strong>
          <input type="checkbox" tabindex="5"  name="rp_thickbox" ';
            if ($rp_settings['rp_thickbox'] == 'on') echo 'checked'; 
 echo '   />
        </label><br />
        <label for="rp_thickbox_path"><strong>Wordpress Path:</strong>
          <input  id="rp_thickbox_path" name="rp_thickbox_path" type="text" tabindex="6" size="15" value="'.$rp_settings['rp_thickbox_path'].'" />
          <br />
          See <a target="_blank" href="';
 echo       WP_PLUGIN_URL;
 echo       '/recent-photos/readme.txt">Readme.txt</a> for Details.
          <br />
        </label><br />
        <label for="rp_custom_css"><strong>Use Custom CSS:</strong>
          <input tabindex="7"  type="checkbox" name="rp_custom_css" ';
            if ($rp_settings['rp_custom_css'] == 'on') echo 'checked'; 
 echo '   />
        </label><br />
        <label for="rp_css"><strong>Custom CSS:</strong><br />
          <textarea name="rp_css" rows="5" cols="30" tabindex="8" >';
echo        $rp_settings['rp_css'];
echo    '</textarea>
          <br />
          See <a  target="_blank" href="';
 echo       WP_PLUGIN_URL;
 echo       '/recent-photos/readme.txt">Readme.txt</a> for Details.
          <br />
        </label><br />
      </p>';
	echo '<input type="hidden" id="update_rp_widget" name="update_rp_widget" value="1" />';
}

/**
	* Load inline scripts
	*
	* @param  none
	* @return void
**/

function rp_inline_script() {
  global $rp_settings;
  //Modification required for thickbox 
?>
<script type="text/javascript">
  var tb_pathToImage = "/<?php echo $rp_settings['rp_thickbox_path'] ?>wp-includes/js/thickbox/loadingAnimation.gif";
  var tb_closeImage = "/<?php echo $rp_settings['rp_thickbox_path'] ?>wp-includes/js/thickbox/tb-close.png";
</script>
<?php
}

function rp_enqueue_components() {
  wp_enqueue_script( $handle='thickbox', $deps=array('jquery'), $in_footer=false );
  wp_enqueue_style( 'thickbox' );
}

add_action('init', 'rp_enqueue_components');


register_sidebar_widget('Recent Photos', 'rp_widget');
register_widget_control('Recent Photos', 'rp_widget_Admin');
?>