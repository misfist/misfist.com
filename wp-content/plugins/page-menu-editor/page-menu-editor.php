<?php
/*
Plugin Name: Page Menu Editor
Plugin URI: http://www.stuffbysarah.net/wordpress-plugins/page-menu-editor/
Description: Allows you to customise the title attribute and menu label of each page link in wp_list_pages() or wp_page_menu().
Author: Sarah Anderson
Version: 2.1.2
Author URI: http://www.stuffbysarah.net/

This plugin is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License
as published by the Free Software Foundation, version 2. This plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU General Public License for more details.

If you choose to copy all or portions of this code you must follow the GNU GPL rules as outlined on http://wordpress.org/about/gpl/

With thanks to Mark Anderson for the debugging.
*/

class PageMenuEditor {
	var $version;

	function __construct() {
		$this->version = "2.1.2";
		add_action('init', array(&$this, 'plugin_update'),1);
		add_filter('wp_list_pages', array(&$this, 'filter_pages'), 1);

		add_action('edit_post', array(&$this, 'pme_update'));
		add_action('save_post', array(&$this, 'pme_update'));
		add_action('publish_post', array(&$this, 'pme_update'));

		/* Use the admin_menu action to define the custom boxes */
		add_action('admin_menu', array(&$this, 'add_custom_box'));
		add_action('admin_menu', array(&$this, 'options_menu'));
	}

	function plugin_update() {
		$theversion = get_option('dsa_pme_version');
		if (empty($theversion) || version_compare($theversion, '2.1.1') == -1) :
			$this->migrate('menulabel', 'title_attrib');
			update_option('dsa_pme_version', '2.1.2');
		endif;
	}

	/* the main wp_list_pages() filter */
	function callback($matches) {
		global $wpdb, $wp_version;

		if ($wp_version >= 3.3) $t = 4;
		else $t = 5;

		if ($matches[1] && !empty($matches[1])) $postID = $matches[1];

		if (empty($postID)) $postID = get_option("page_on_front");

		$menu_label = $title_attribute = "";
		// now identifier is the post ID
		@$pgmenueditor = get_post_meta($postID, 'dsa_pagemenueditor');
		if (!empty($pgmenueditor[0]) && count($pgmenueditor[0])) :
			$title_attribute = stripslashes($pgmenueditor[0]['title_attribute']);
			$menu_label = stripslashes($pgmenueditor[0]['menu_label']);
		endif;

		if (preg_match('@^<([^>]+)>([^<]+)<([^>]+)>$@is', $matches[$t], $anchort)) :
			$link_before = "<".$anchort[1].">";
			$link_after = "<".$anchort[3].">";
			$anchortxt = $anchort[2];
		else :
			$anchortxt = $matches[$t];
			$link_before = $link_after = "";
		endif;

		if (empty($menu_label)) $menu_label = $anchortxt;

		if ($title_attribute == "%%pagetitle%%") $title_attribute = get_the_title($postID);
		elseif ($title_attribute == "%%menulabel%%") $title_attribute = $menu_label;

		if (!empty($title_attribute)) :
			$filtered = '<li class="page_item page-item-'.$postID.$matches[2].'"><a href="'.$matches[3].'" title="'.$title_attribute.'">'.$link_before.$menu_label.$link_after.'</a>';
		else :
			$filtered = '<li class="page_item page-item-'.$postID.$matches[2].'"><a href="'.$matches[3].'">'.$link_before.$menu_label.$link_after.'</a>';
		endif;

		return $filtered;
	}

	function filter_pages($content) {
		global $wp_version;

		if ($wp_version >= 3.3)	$pattern = '@<li class="page_item page-item-(\d+)([^\"]*)"><a href=\"([^\"]+)">(.*?)</a>@is';
		else $pattern = '@<li class="page_item page-item-(\d+)([^\"]*)"><a href=\"([^\"]+)" title="([^\"]+)">(.*?)</a>@is';

		return preg_replace_callback($pattern, array($this, 'callback'), $content);
	}

	/* Adds a custom section to the "advanced" Post and Page edit screens */
	function add_custom_box() {
		if( function_exists( 'add_meta_box' ))
    		add_meta_box( 'pgmenueditor', 'Page Menu Editor', array(&$this, 'custom_box'), 'page', 'advanced', 'high' );
	}

	/* Prints the inner fields for the custom post/page section */
	function custom_box() {
		// Use nonce for verification
		echo '<input type="hidden" name="dsa_pme_noncename" id="dsa_pme_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__)).'" />';

		// The actual fields for data entry
		global $post;

		$pgmenueditor = get_post_meta($post->ID, 'dsa_pagemenueditor');
		@$title_attribute = stripslashes($pgmenueditor[0]['title_attribute']);
		@$menu_label = stripslashes($pgmenueditor[0]['menu_label']);
?>
        <div class="inside">
			<table class="form-table">
				<tr><th scope="row"><label for="menulabel">Page Menu Label: </label></th>
				<td>
					<input type="text" name="menulabel" value="<?php echo $menu_label ?>" id="menulabel" style="width: 90%" />
        			<p>Specify a menu label for the page link in the navigation.</p>
        		</td></tr>
				<tr><th><label for="title_attrib">Page Link Title Attribute: </label></th>
				<td>
					<input type="text" name="title_attrib" value="<?php echo $title_attribute ?>" id="title_attrib" style="width: 90%"  />
        			<p>Specify a title attribute for the page link in the navigation to help with usability and accessibility.</p>
        			<p><em>(Use %%pagetitle%% to use the page title or %%menulabel%% to use the menu label).</em></p>
        		</td></tr>
        	</table>
        </div>
<?php
	}

	function pme_update($post_id) {
		// verify this came from the our screen and with proper authorization,
		// because save_post can be triggered at other times
		// Check its not an auto save
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
			return $post_id;

		// Check your data has been sent - this helps verify that we intend to process our metabox
		if (!isset($_POST['dsa_pme_noncename']))
			return $post_id;

		if (!wp_verify_nonce($_POST['dsa_pme_noncename'], plugin_basename(__FILE__)))
    		return $post_id;

		if ('page' == $_POST['post_type'] ) {
    		if (!current_user_can('edit_page', $post_id))
				return $post_id;
		} else {
			return $post_id;
		}

		$attribute = $_POST['title_attrib'];
		$label = $_POST['menulabel'];

		$pme_detail = array("menu_label" => $label, "title_attribute" => $attribute);

		update_post_meta($post_id, 'dsa_pagemenueditor', $pme_detail);
	}

	function options_menu() {
		add_options_page('Page Menu Editor', 'Page Menu Editor', 'update_plugins', 'pg-menu-editor-upgrade', array(&$this, 'options'));
	}

	/*
	 * Migrate function from the old system. Kept in for 2.1.1 as some issues cropped up for 2.1 for some users
	 * Thanks to Mark Anderson for spotting it and helping with the testing.
	 */
	function migrate($label, $attribute) {
		global $wpdb;
		$results = $wpdb->get_results("SELECT post_id, meta_key, meta_value FROM {$wpdb->postmeta} WHERE meta_key = '{$attribute}' OR meta_key = '{$label}' GROUP BY post_id");
		foreach ($results AS $result) :
            if ($result->meta_key == $attribute) :
                $check = $label;
                $title_attribute = $result->meta_value;
            else :
                $check = $attribute;
                @$menu_label = $result->meta_value;
            endif;
            $lbl = $wpdb->get_row("SELECT meta_value FROM {$wpdb->postmeta} WHERE meta_key = '{$check}' AND post_id = ".$result->post_id);
            if ($result->meta_key == $attribute) :
                $menu_label = $lbl->meta_value;
            else :
                @$title_attribute = $lbl->meta_value;
            endif;
			$details = array("menu_label" => $menu_label, "title_attribute" => $title_attribute);
			update_post_meta($result->post_id, 'dsa_pagemenueditor', $details);
			delete_post_meta($result->post_id, $attribute);
			delete_post_meta($result->post_id, $label);
		endforeach;

		return true;
	}

	function options() {

		if (isset($_POST['pta_migrate'])) :
			if ($this->migrate('_aioseop_menulabel', '_aioseop_titleatr')) :
				$msg = "The migration is complete.";
			else :
				$msg = "Error during the migration process, please try again.";
			endif;
			echo "<div class='fade'><p>The migration is complete.</p></div>\n";
		endif;

		?>
		<div class="wrap">
		<h2>Import Options</h2>

		<h3>All in One SEO Pack</h3>
		<p>If you currently have menu labels and title attributes set up using the All In One SEO Pack, you can migrate those
		settings over to use the Page Menu Editor Plugin.</p>
		<form id="ptamigrate" method="post" action="" class="form-table">
    		<div class="submit"><input type="submit" name="pta_migrate" value="Migrate Settings"/></div>
	    </form>

	    <h2>Donate</h2>

	    <p>If you want to say thanks then a link back or comment on my site to let me know you like a plugin is more
	    than enough. Alternatively you're welcome to make a donation to help with our soon to be born twins via PayPal! :)</p>

		<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<div>
		<input type="hidden" name="cmd" value="_donations" />
		<input type="hidden" name="business" value="sarah@aislinks.com" />
		<input type="hidden" name="item_name" value="WordPress Page Menu Editor Donation" />
		<input type="hidden" name="no_shipping" value="1" />
		<input type="hidden" name="cancel_return" value="http://www.stuffbysarah.net" />
		<input type="hidden" name="cn" value="Optional Comment" />
		<input type="hidden" name="currency_code" value="GBP" />
		<input type="hidden" name="tax" value="0" />
		<input type="hidden" name="lc" value="GB" />
		<input type="hidden" name="bn" value="PP-DonationsBF" />
		<input type="image" src="https://www.paypal.com/en_GB/i/btn/btn_donate_SM.gif" name="submit" alt="PayPal - The safer, easier way to pay online." />
		<img alt="" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1" />
		</div>
		</form>

    	</div>
<?php
	}
}

$pagemenueditor = new PageMenuEditor();