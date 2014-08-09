<?php
// Default options values
$bartleby_options = array(
	'home_headline' => '',
	'bartleby_logo' => '',
	'social_bar' => true,
	'facebook_link' => '',
	'twitter_link' => '',
	'gplus_link' => '',
	'linkedin_link' => '',
	'github_link' => '',
	'pinterest_link' => '',
	'feed_link' => '',
	'footer_link' => true,
	'column_posts' => true
);
if ( is_admin() ) : // Load only if we are viewing an admin page
function bartleby_register_settings() {
	// Register settings and call sanitation functions
	register_setting( 'bartleby_theme_options', 'bartleby_options', 'bartleby_validate_options' );
}add_action( 'admin_init', 'bartleby_register_settings' );
function bartleby_theme_options() {
	// Add theme options page to the addmin menu
	add_theme_page( 'Theme Options', 'Theme Options', 'edit_theme_options', 'theme_options', 'bartleby_theme_options_page' );
}add_action( 'admin_menu', 'bartleby_theme_options' );
// Function to generate options page
function bartleby_theme_options_page() {
	global $bartleby_options, $bartleby_categories, $bartleby_layouts;
	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>
	<div class="wrap">
	<?php screen_icon(); echo "<h2>" . __( 'bartleby Theme Options', 'bartleby' ) . "</h2>";
	// This shows the page's name and an icon if one has been provided ?>
	<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated fade"><p><strong><?php esc_attr_e( 'Options saved' , 'bartleby' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>
	<form method="post" action="options.php">
	<?php $options = get_option( 'bartleby_options', $bartleby_options ); ?>
	
	<?php settings_fields( 'bartleby_theme_options' );
	/* This function outputs some hidden fields required by the form,
	including a nonce, a unique number used to ensure the form has been submitted from the admin page
	and not somewhere else, very important for security */ ?>
<table class="form-table">
<h3><?php esc_attr_e('Site Logo' , 'bartleby' ); ?></h3>
	<p><?php esc_attr_e('Enter the URL for your custom logo here.' , 'bartleby'); ?></p>
	<tr valign="top"><th scope="row"><label for="bartleby_logo">Custom Logo</label></th>
	<td>
	<input id="barlteby_logo" name="bartleby_options[bartleby_logo]" type="url" size="60" value="<?php esc_attr_e($options['bartleby_logo']); ?>" />
<label class="description" for="bartleby_options[bartleby_logo]"><?php esc_attr_e( 'Leave blank to use the site title', 'bartleby' ); ?></label>
	</td>
	</tr>
</table>
<table class="form-table">
<h3><?php esc_attr_e('Home Page Headline' , 'bartleby' ); ?></h3>
	<p><?php esc_attr_e('This headline will be displayed above the slider on the home page.' , 'bartleby'); ?></p>
	<tr valign="top"><th scope="row"><label for="home_headline">Home Page Headline</label></th>
	<td>
	<input id="home_headline" name="bartleby_options[home_headline]" type="text" size="40" value="<?php echo($options['home_headline']); ?>" />
	<label class="description" for="bartleby_options[home_headline]"><?php esc_attr_e( 'Leave blank to disable', 'bartleby' ); ?></label>
	</td>
	</tr>
</table>
<table class="form-table">
	<h3><?php esc_attr_e('Social Media Bar Settings' , 'bartleby' ); ?></h3>
	<p><?php esc_attr_e('Disable the bar if desired, or add your custom profile/page links.' , 'bartleby'); ?></p>
	<tr valign="top"><th scope="row">Social Media Bar</th>
	<td>
	<input type="checkbox" id="social_bar" name="bartleby_options[social_bar]" value="1" <?php checked( true, $options['social_bar'] ); ?> />
	<label for="social_bar">Check to use the social media bar. Leave URL fields blank to disable specific icons.</label>
	</td>
	</tr>
	<tr valign="top"><th scope="row"><label for="facebook_link">Facebook URL</label></th>
	<td>
<input id="facebook_link" name="bartleby_options[facebook_link]" type="url" size="60" value="<?php esc_attr_e($options['facebook_link']); ?>" />
</td>
	</tr>
<tr valign="top"><th scope="row"><label for="twitter_link">Twitter URL</label></th>
	<td>
	<input id="twitter_link" name="bartleby_options[twitter_link]" type="url" size="60" value="<?php esc_attr_e($options['twitter_link']); ?>" />
	</td>
	</tr>
<tr valign="top"><th scope="row"><label for="gplus_link">Google+ URL</label></th>
	<td>
	<input id="gplus_link" name="bartleby_options[gplus_link]" type="url" size="60" value="<?php esc_attr_e($options['gplus_link']); ?>" />
	</td>
	</tr>
<tr valign="top"><th scope="row"><label for="linkedin_link">LinkedIn URL</label></th>
	<td>
	<input id="linkedin_link" name="bartleby_options[linkedin_link]" type="url" size="60" value="<?php esc_attr_e($options['linkedin_link']); ?>" />
	</td>
	</tr>
<tr valign="top"><th scope="row"><label for="Github URL">Github URL</label></th>
	<td>
	<input id="github_link" name="bartleby_options[github_link]" type="url" size="60" value="<?php esc_attr_e($options['github_link']); ?>" />
	</td>
	</tr>
<tr valign="top"><th scope="row"><label for="Pinterest URL">Pinterest URL</label></th>
	<td>
	<input id="pinterest_link" name="bartleby_options[pinterest_link]" type="url" size="60" value="<?php esc_attr_e($options['pinterest_link']); ?>" />
	</td>
	</tr>
<tr valign="top"><th scope="row"><label for="RSS Feed URL">RSS Feed URL</label></th>
	<td>
	<input id="feed_link" name="bartleby_options[feed_link]" type="url" size="60" value="<?php esc_attr_e($options['feed_link']); ?>" />
	</td>
	</tr>
	</table>
<table class="form-table">
	<h3><?php esc_attr_e('Footer Link' , 'bartleby' ); ?></h3>
	<p><?php esc_attr_e('Disable the footer link.' , 'bartleby'); ?></p>
	<tr valign="top"><th scope="row">Footer Credit Link</th>
	<td>
	<input type="checkbox" id="footer_link" name="bartleby_options[footer_link]" value="1" <?php checked( true, $options['footer_link'] ); ?> />
	<label for="footer_link">De-select to remove the footer credit link.</label>
	</td>
	</tr>
</table>
<table class="form-table">
	<h3><?php esc_attr_e('Homepage Column Posts' , 'bartleby' ); ?></h3>
	<tr valign="top"><th scope="row">Column Post Layout</th>
	<td>
	<input type="checkbox" id="column_posts" name="bartleby_options[column_posts]" value="1" <?php checked( true, $options['column_posts'] ); ?> />
	<label for="column_posts">Uncheck to disable the home-page column post layout.</label>
	</td>
	</tr>
</table>
	<p class="submit"><input type="submit" class="button-primary" value="Save Options" /></p>
	</form>
<p>
<?php esc_attr_e('Thank you for using bartleby. A lot of time went into development. Donations small or large always appreciated.' , 'bartleby'); ?></p>
<form action="https://www.paypal.com/cgi-bin/webscr" target="_blank" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="QD8ECU2CY3N8J">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
<a href="http://www.edwardrjenkins.com/themes/bartleby/" target="_blank"><?php esc_attr_e('Bartleby Documentation' , 'bartleby' ); ?></a>
	</div>
	<?php
}
function bartleby_validate_options( $input ) {
	global $bartleby_options;
	$options = get_option( 'bartleby_options', $bartleby_options );
	$input['home_headline'] = esc_attr( $input['home_headline'] );
	$input['bartleby_logo'] = esc_url( $input['bartleby_logo'] );
	$input['facebook_link'] = esc_url( $input['facebook_link'] );
	$input['twitter_link'] = esc_url( $input['twitter_link'] );
	$input['gplus_link'] = esc_url( $input['gplus_link'] );
	$input['linkedin_link'] = esc_url( $input['linkedin_link'] );
	$input['github_link'] = esc_url( $input['github_link'] );
	$input['pinterest_link'] = esc_url( $input['pinterest_link'] );
	$input['feed_link'] = esc_url( $input['feed_link'] );
	if ( ! isset( $input['social_bar'] ) )
	$input['social_bar'] = null;
	if ( ! isset( $input['footer_link'] ) )
	$input['footer_link'] = null;
	if ( ! isset( $input['column_posts'] ) )
	$input['column_posts'] = null;
	return $input;
}
endif;  // EndIf is_admin()