<?php

function nextgen_optimizer_options_page() {

global $nggo_options;

ob_start();

?>
	
<div class="wrap">
<h2>NextGEN Gallery Optimizer</h2>


	<div class="nggo_premium_box">
		<h2>New!...NextGEN Gallery Optimizer <i>Premium!</i></h2>

		<h3 class="nggo_h3">Support for ALL TEN NextGEN shortcodes...</h3>
		
		<div>			
			<div style="float:left; margin: 10px 20px 5px 0; font-weight:bold;">		
				1. [nggallery id=x]<br />
				2. [slideshow id=x]<br />
				3. [album id=x]<br />
				4. [thumb id=x]<br />
				5. [singlepic id=x]<br />	
			</div>		

			<div style="float:left; margin: 10px 0 5px 0; font-weight:bold;">			
				6. [imagebrowser id=x]<br />
				7. [nggtags gallery|album=mytag]<br />	
				8. [random max=x]<br />
				9. [recent max=x]<br />
				10. [tagcloud]
			</div>		
		</div>
		
		<div class="clear"></div>

		<div style="float:left; margin-right:20px;">		
			<p>
				<b>+ Support for the [Show as slideshow] link</b><br />
				Load slideshow scripts...and ONLY after click-through.
			</p>

			<p>
				<b>+ Precision targeting for shortcode SUB-pages</b><br />
				Only load the scripts required on each and every view.
			</p>

			<p>
				<b>+ Removes NextGEN Gallery's version number</b><br />
				Less source code comment clutter behind every page.
			</p>
		</div>
		
		<div style="float:left;">
			<p>
				<b>+ Support for JW Image Rotator slideshows</b><br />
				Flash-based transitions display your image portfolio in style.
			</p>
		
			<p>
				<b>+ Support for AJAX pagination on [imagebrowser id=x]</b><br />
		 		Browse full-size images without page refreshes (requires Shutter).
			</p>
		
			<p>
				<b>+ Attractive browser resize effect for Fancybox.</b><br />
				Resizes Fancybox when the browser window is resized.
			</p>
		</div>

		<div class="clear"></div>

		<div class="nggo_premium_download">
			<?php echo '
			<form id="nggo_premium_download_form" action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input id="nggo_premium_input" type="hidden" name="cmd" value="_s-xclick">
			<input id="nggo_premium_input" type="hidden" name="hosted_button_id" value="4TRAS5FT9T234">
			<input id="nggo_premium_input" type="image" src="' . plugins_url( 'images/download-button.gif' , __FILE__) . '" width="150" height="26" border="0" name="submit" alt="PayPal — The safer, easier way to pay online.">
			<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
			</form>
			'; ?>		
		</div>
		
		<div class="nggo_small">
			*$15 donation required.<br />
			PayPal will automatically redirect you to the download page or click "Return to Helpful Media" on the confirmation screen.
		</div>

	</div> <!-- close nggo_premium_box -->



	<div class="nggo_box">	
		<form id="nggo_submit_options" method="post" action="options.php">
		<?php settings_fields('nextgen_optimizer_settings_group'); ?>
			
		<div class="nggo_inner">
		<h2><?php _e('Step 1:', 'nextgen_optimizer_domain'); ?></h2>
			
			<div class="nggo_select_style">
				<b>Select your NextGEN stylesheet:</b>
				<p>
					<?php $styles = array('','Black Minimalism Theme', 'Default Styles', 'Dkret3 Theme', 'Hovereffect Styles', 'K2 Theme', 'Shadow Effect', 'Shadow Effect with Description Text'); ?>
					<select name="nextgen_optimizer_settings[theme]" id="nextgen_optimizer_settings[theme]">
						<?php foreach($styles as $style) { ?>
							<?php if ($nggo_options['theme'] == $style) { $selected = 'selected="selected"'; } else { $selected = ''; } ?>
							<option value="<?php echo $style; ?>" <?php echo $selected; ?>><?php echo $style; ?></option>
						<?php } ?>
					</select>
				</p>
			</div>
			
			<div class="nggo_custom_style">
				<b>Or enter the path to a custom file:</b>
				<p><?php echo content_url() ?>/ <input id="nextgen_optimizer_settings[css]" name="nextgen_optimizer_settings[css]" type="text" size="35" value="<?php echo $nggo_options['css']; ?>"/></p>
			</div>
			
		</div>
			
	<div class="clear"></div>
			
		<div class="nggo_inner">
			<h2><?php _e('Step 2:', 'nggo_domain'); ?></h2>
			<input id="nextgen_optimizer_settings[fancybox]" name="nextgen_optimizer_settings[fancybox]" type="checkbox" value="1" <?php checked(1, $nggo_options['fancybox']); ?> />
			&nbsp;&nbsp;<b>Use <a href="http://fancybox.net" target="_blank">Fancybox</a> lightbox effect?</b>
		</div>

		<div class="nggo_inner">
			<h2><?php _e('Step 3:', 'nggop_domain'); ?></h2>
			<label>
				<input id="nextgen_optimizer_settings[jquery]" name="nextgen_optimizer_settings[jquery]" type="radio" value="wordpress" <?php checked(wordpress, $nggo_options['jquery']); ?> />
				&nbsp;&nbsp;<b>Use WordPress jQuery [greater compatibility]</b>&nbsp;&nbsp;&nbsp;&nbsp;
			</label>
			<label>
				<input id="nextgen_optimizer_settings[jquery]" name="nextgen_optimizer_settings[jquery]" type="radio" value="google" <?php checked(google, $nggo_options['jquery']); ?> />
				&nbsp;&nbsp;<b>Use Google-hosted jQuery [faster page loads]</b>
			</label>
		</div>

		<h2><?php _e('Step 4:', 'nextgen_optimizer_domain'); ?></h2>
		<input type="submit" class="button-primary" value="<?php _e('Save Options', 'nextgen_optimizer_domain'); ?>" />&nbsp;&nbsp;<b>Save your changes and enjoy!</b>&nbsp;
		Your gallery scripts and styles will now only load on posts with the [nggallery id=x] shortcode.

</div><!-- end .nggo_box -->		


	<div class="nggo_box">
		<h2><?php _e('Tips:', 'nggo_domain'); ?></h2>
		1. If Fancybox isn't working as it should, try deactivating other Fancybox/lightbox plugins which may be causing a conflict, 
		and try removing any duplicate Fancybox scripts hard-coded into your theme.<br /><br />
		
		2. Lightbox scripts such as Fancybox aren't generally compatible with minification/caching/combining plugins. 
		If you're using a plugin such as WP-Minify, be sure to list the already minified <b><?php echo plugins_url( 'fancybox/jquery.fancybox-'.NGGO_FANCYBOX_VERSION.'.pack.js' , __FILE__); ?></b>
		in its file exclusion options and clear the cache.
	</div>

	<!-- hidden fields for persistent settings in options array -->
	<input id="nextgen_optimizer_settings[version]" name="nextgen_optimizer_settings[version]" type="hidden" value="<?php echo $nggo_options['version']; ?>"/>
	<input id="nextgen_optimizer_settings[auto_fancybox_install]" name="nextgen_optimizer_settings[auto_fancybox_install]" type="hidden" value="<?php echo $nggo_options['auto_fancybox_install']; ?>"/>	
	<input id="nextgen_optimizer_settings[original_nextgen_thumbEffect]" name="nextgen_optimizer_settings[original_nextgen_thumbEffect]" type="hidden" value="<?php echo $nggo_options['original_nextgen_thumbEffect']; ?>"/>
	<input id="nextgen_optimizer_settings[original_nextgen_thumbCode]" name="nextgen_optimizer_settings[original_nextgen_thumbCode]" type="hidden" value="<?php echo htmlspecialchars($nggo_options['original_nextgen_thumbCode']); ?>"/>
	
</form>


	<div class="nggo_box">
		<h2>Support:</h2>
		Any questions or suggestions?<br />
		Please <a href='mailto:mark@markstechnologynews.com'>send me an email</a>, or leave a message at the <a href="http://wordpress.org/support/plugin/nextgen-gallery-optimizer">Support Forum</a>.
	</div>
		
</div><!-- end wrap -->



<?php
	echo ob_get_clean();
}