<?php wp_enqueue_script('jquery-ui-tabs'); ?>
<div class="wrap wp-linkedin">
	<h1><?php _e('LinkedIn Options', 'wp-linkedin'); ?></h1>

	<div id="main-container"><form method="POST" action="<?php echo $post_target ?>"><?php
		settings_fields($page_slug);
		global $wp_settings_sections, $wp_settings_fields;
		$sections = (array) $wp_settings_sections[$page_slug]; ?>
		<div id="sections" class="postbox-container metabox-holder"><?php
			// Output tabs first
			echo '<ul>';
			foreach ($sections as $section) {
				echo '<li><a href="#' . $section['id'] . '">' . $section['title'] . '</a></li>';
			}
			echo '</ul>';

			// Then output content
			foreach ($sections as $section) { ?>
				<div class="postbox" id="<?php echo $section['id']; ?>">
					<div class="inside">
					<?php if ($section['callback']) call_user_func($section['callback'], $section); ?>
					<table class="form-table">
					<?php do_settings_fields($page_slug, $section['id'] ); ?>
					</table>
					<?php submit_button(); ?>
					</div> <!-- .inside -->
				</div> <!-- .postbox --><?php
			} ?>
		</div> <!-- #sections -->
		<script type="text/javascript">jQuery(document).ready(function($) { $("#sections").tabs(); });</script>
	</form></div> <!-- #main-container -->

	<div id="side-container" class="postbox-container metabox-holder">
		<div class="postbox">
			<h3><span><?php _e('Do you like this Plugin?', 'wp-linkedin'); ?></span></h3>
			<div class="inside">
				<p><?php _e('Please consider a donation.', 'wp-linkedin'); ?></p>
				<div style="text-align:center">
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
					">
					<input type="image" src="https://www.paypalobjects.com/en_US/CH/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
					<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form>
				</div>
				<p><?php _e('We also need volunteers to translate that plugin into more languages.', 'wp-linkedin'); ?>
					<?php _e('If you wish to help then contact <a href="https://twitter.com/cvedovini">@cvedovini</a> on Twitter or use that <a href="http://vdvn.me/contact/">contact form</a>.', 'wp-linkedin'); ?></p>
			</div> <!-- .inside -->
		</div> <!-- .postbox -->
		<div>
			<a class="twitter-timeline" href="https://twitter.com/cvedovini" data-widget-id="377037845489139712">Tweets by @cvedovini</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
	</div> <!-- #side-container -->
</div>