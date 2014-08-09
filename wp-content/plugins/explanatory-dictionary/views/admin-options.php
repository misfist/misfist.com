<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   Explanatory_Dictionary
 * @author    EXED internet (RJvD, BHdH) <service@exed.nl>
 * @license   GPL-2.0+
 * @link      http://www.exed.nl/
 * @copyright 2013  EXED internet  (email : service@exed.nl)
 */
//require_once('../wp-content/plugins/wp-explanatory-dictionary/class-explanatory-dictionary.php'); 
$current_page = admin_url( 'admin.php?page=explanatory-dictionary-options' );

if ( isset( $_POST ) && ! empty( $_POST['settings'] ) ) {
	$class = '';
	
	if ( wp_verify_nonce( $_POST['admin_explanatory_dictionary_settings'], $this->get_nonce( 'explanatory-dictionary-settings' ) ) ) {
		
		
		if ( isset( $_POST['reset'] ) ) {
			$this->settings->reset_settings();
			$message = __( 'The settings have been reset', $this->plugin_slug );
		} else {
			$post_settings = $_POST['settings'];
			// TODO: Check if all sizes have a modifier (i.e. px, em)
			foreach ( $post_settings as $key => $post_setting ) {
				$post_settings[ $key ] = trim( esc_html( $post_setting ) );
			}
			
			if ( ! isset( $post_settings['_external_css_file'] ) ) {
				$post_settings['_external_css_file'] = 'no';
			}
			
			/* Check the settings for the word that has an explanation */
			if ( ! isset( $post_settings['_word_font_style'] ) ) {
				$post_settings['_word_font_style'] = 'normal';
			}
			
			if ( ! isset( $post_settings['_word_font_weight'] ) ) {
				$post_settings['_word_font_weight'] = 'normal';
			}
			
			if ( ! isset( $post_settings['_usedletters'] ) ) {
				$post_settings['_usedletters'] = '';
			} else {
				$post_settings['_alphabet'] = "A B C D E F G H I J K L M N O P Q R S T U V W X Y Z";
			}
			
			if ( ! isset( $post_settings['_word_text_decoration'] ) ) {
				$post_settings['_word_text_decoration'] = 'none';
			}
			
			/* Check the settings for the tooltip title */
			if ( ! isset( $post_settings['_title_font_style'] ) ) {
				$post_settings['_title_font_style'] = 'normal';
			}
			
			if ( ! isset( $post_settings['_title_font_weight'] ) ) {
				$post_settings['_title_font_weight'] = 'normal';
			}
			
			if ( ! isset( $post_settings['_title_text_decoration'] ) ) {
				$post_settings['_title_text_decoration'] = 'none';
			}
			
			if ( '' == $post_settings['_exclude'] ) {
				$post_settings['_exclude'] = '-1';
			}
			
			if ( '' == $post_settings['_limit'] ) {
				$post_settings['_limit'] = -1;
			}
			
			$colors_array = array(
				'_color',
				'_border_color',
				'_background',
				'_title_color',
				'_word_color',
			);
			foreach ( $colors_array as $color ) {
				$post_settings[ $color ] = '#' . trim( strip_tags( substr( $post_settings[ $color ], 0, 6 ) ) );
			}
			
			if ( $this->settings->update_settings( $post_settings ) ) {
				$message = __( 'The settings have been updated', $this->plugin_slug );
			}
		}
	} else {
		$message = __( 'There was an error verifying the post data', $this->plugin_slug );
		$class = 'error';
	}
}


$options = $this->settings->get_settings_list();

?>
<div class="wrap">

	<div class="icon32" id="icon-options-general"><br></div>
	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

	<!-- TODO: Provide markup for your options page here. -->
    
    <?php if ( isset( $message ) ) : ?>
		<?php $this->admin_message( $message, $class );?>
	<?php endif;?>
	<div>
		<form id="explanatory-dictionary-options" action="<?php echo esc_url( $current_page ); ?>" method="post">
			<?php wp_nonce_field( $this->get_nonce( 'explanatory-dictionary-settings' ), 'admin_explanatory_dictionary_settings' ); ?>
			<h3><?php _e( 'Tooltip Options', $this->plugin_slug );?></h3>
			<table class="form-table">
				<tr>
					<th scope="row">
						<label><?php _e( 'Shortcode', $this->plugin_slug ); ?></label>
					</th>
					<td>
						<input type="text"  class="regular-text" readonly="readonly" value="[explanatory-dictionary]" >
						<p class="description"><?php echo _e( 'Use this shortcode to display the plugin on your page', $this->plugin_slug ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="_external_css_file"><?php _e( 'External CSS file', $this->plugin_slug ); ?></label></th>
					<td>
						<input type="checkbox" value="yes" id="_external_css_file" name="settings[_external_css_file]" <?php echo ( 'yes' == esc_attr( $options['_external_css_file'] ) ? 'checked="checked"' : '' );?> />
						<p class="description"><?php echo _e( 'Check if you want to use an external css file. If external CSS file is checked, the style set in the "Explanatory Dictionary Options" will be ignored. To use the style set in "Explanatory Dictionary Options", uncheck this field.', $this->plugin_slug ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="_width"><?php _e( 'Tooltip Width', $this->plugin_slug ); ?></label></th>
					<td>
						<input type="text" class="regular-text" value="<?php echo esc_attr( $options['_width'] );?>" id="_width" name="settings[_width]" />
						<p class="description"><?php echo _e( 'This option sets the width (Example: 200px, 100em ...) of the explanation tooltip.', $this->plugin_slug ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="_border_size"><?php _e( 'Tooltip Border Size', $this->plugin_slug ); ?></label></th>
					<td>
						<input type="text" class="regular-text" value="<?php echo esc_attr( $options['_border_size'] );?>" id="_border_size" name="settings[_border_size]" />
						<p class="description"><?php echo _e( 'This option sets the border size (Example: 1px, 0.8pt, 0.2em ...) of the explanation tooltip.', $this->plugin_slug ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="_border_color"><?php _e( 'Tooltip Border Color', $this->plugin_slug ); ?></label></th>
					<td>
						<input type="text" class="regular-text color" value="<?php echo esc_attr( $options['_border_color'] );?>" id="_border_color" name="settings[_border_color]" />
						<p class="description"><?php echo _e( 'Click on the text field to set another border color.', $this->plugin_slug ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="_background"><?php _e( 'Tooltip Background Color', $this->plugin_slug ); ?></label></th>
					<td>
						<input type="text" class="regular-text color" value="<?php echo esc_attr( $options['_background'] );?>" id="_background" name="settings[_background]" />
						<p class="description"><?php echo _e( 'Click on the text field to set another color.', $this->plugin_slug ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="_border_radius"><?php _e( 'Tooltip Border Radius', $this->plugin_slug ); ?></label></th>
					<td>
						<input type="text" class="regular-text" value="<?php echo esc_attr( $options['_border_radius'] );?>" id="_border_radius" name="settings[_border_radius]" />
						<p class="description"><?php echo _e( 'This option sets the explanation tooltip border radius (Example: 5px, 2pt, 0.5em ...).', $this->plugin_slug ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="_exclude"><?php _e( 'Exclude', $this->plugin_slug ); ?></label></th>
					<td>
						<input type="text" class="regular-text" value="<?php echo ( '-1' != esc_attr( $options['_exclude'] ) ? esc_attr( $options['_exclude'] ) : '' );?>" id="_exclude" name="settings[_exclude]" />
						<p class="description"><?php echo _e( 'Write here (separate by commas) the pages or posts to exclude (Example: 1,10,25,77 ...).', $this->plugin_slug ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="_limit"><?php _e( 'Limit', $this->plugin_slug ); ?></label></th>
					<td>
						<input type="text" class="regular-text" value="<?php echo ( esc_attr( $options['_limit'] ) > 0 ? esc_attr( $options['_limit'] ) : '' );?>" id="_limit" name="settings[_limit]" />
						<p class="description"><?php echo _e( 'Write here the number of words (words expressions, sentences) for showing the tooltips per page or post or leave empty for all the words (words expressions, sentences).', $this->plugin_slug ); ?></p>
					</td>
				</tr>
			</table>
			<h3><?php _e( 'Tooltip Title Options', $this->plugin_slug );?></h3>
			<table class="form-table">
				<tr>
					<th scope="row"><label for="_title_font_size"><?php _e( 'Title Font Size', $this->plugin_slug ); ?></label></th>
					<td>
						<input type="text" class="regular-text" value="<?php echo esc_attr( $options['_title_font_size'] );?>" id="_title_font_size" name="settings[_title_font_size]" />
						<p class="description"><?php echo _e( 'This option sets the font size (Example: 15px, 10pt, 5em, 10% ...) of the explanation tooltip text.', $this->plugin_slug ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="_title_color"><?php _e( 'Title Text Color', $this->plugin_slug ); ?></label></th>
					<td>
						<input type="text" class="regular-text color" value="<?php echo esc_attr( $options['_title_color'] );?>" id="_title_color" name="settings[_title_color]" />
						<p class="description"><?php echo _e( 'Click on the text field to set another color.', $this->plugin_slug ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label><?php _e( 'Title Style', $this->plugin_slug ); ?></label></th>
					<td>
						<input type="checkbox" value="italic" name="settings[_title_font_style]" id="_title_font_style" <?php echo ( 'italic' == esc_attr( $options['_title_font_style'] ) ? 'checked="checked"' : '' );?> />
						<label for="_title_font_style">Italic</label>
						
						<input type="checkbox" value="bold" name="settings[_title_font_weight]" id="_title_font_weight" <?php echo ( 'bold' == esc_attr( $options['_title_font_weight'] ) ? 'checked="checked"' : '' );?> />
						<label for="_title_font_weight">Bold</label>
						
						<input type="checkbox" value="underline" name="settings[_title_text_decoration]" id="_title_font_decoration" <?php echo ( 'underline' == esc_attr( !empty($options['_title_font_decoration']) ) ? 'checked="checked"' : '' );?> />
						<label for="_title_font_decoration">Underline</label>
					</td>
				</tr>
			</table>
			<h3><?php _e( 'Tooltip Content Options', $this->plugin_slug );?></h3>
			<table class="form-table">
				
				<tr>
					<th scope="row"><label><?php _e( 'Content Text Align', $this->plugin_slug ); ?></label></th>
					<td>
						
						<input type="radio" name="settings[_text_align]" id="_text_align_left" value="left" <?php echo ( 'left' == esc_attr( $options['_text_align'] ) ? 'checked="checked"' : '' );?> />
						<label for="_text_align_left">Left</label>
						
						<input type="radio" name="settings[_text_align]" id="_text_align_right" value="right" <?php echo ( 'right' == esc_attr( $options['_text_align'] ) ? 'checked="checked"' : '' );?> />
						<label for="_text_align_right">Right</label>
						
						<input type="radio" name="settings[_text_align]" id="_text_align_justify" value="justify" <?php echo ( 'justify' == esc_attr( $options['_text_align'] ) ? 'checked="checked"' : '' );?> /> 
						<label for="_text_align_justify">Justify</label> 
						<p class="description"><?php echo _e( 'Select the align of explanation tooltip text.', $this->plugin_slug ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="_font_size"><?php _e( 'Content Font Size', $this->plugin_slug ); ?></label></th>
					<td>
						<input type="text" class="regular-text" value="<?php echo esc_attr( $options['_font_size'] );?>" id="_font_size" name="settings[_font_size]" />
						<p class="description"><?php echo _e( 'This option sets the font size (Example: 15px, 10pt, 5em, 10% ...) of the explanation tooltip text.', $this->plugin_slug ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="_color"><?php _e( 'Content Text Color', $this->plugin_slug ); ?></label></th>
					<td>
						<input type="text" class="regular-text color" value="<?php echo esc_attr( $options['_color'] );?>" id="_color" name="settings[_color]" />
						<p class="description"><?php echo _e( 'Click on the text field to set another color.', $this->plugin_slug ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="_padding"><?php _e( 'Content Padding', $this->plugin_slug ); ?></label></th>
					<td>
						<input type="text" class="regular-text" value="<?php echo esc_attr( $options['_padding'] );?>" id="_padding" name="settings[_padding]" />
						<p class="description"><?php echo _e( 'This option sets the explanation tooltip text padding (Example: 5px 10px, 2pt 5pt 3pt 6pt, 0.5em ...) from borders.', $this->plugin_slug ); ?></p>
					</td>
				</tr>
			</table>
			<h3><?php _e( 'Other Options', $this->plugin_slug );?></h3>
			<table class="form-table">
				<tr>
					<th scope="row"><label for="_word_color"><?php _e( 'Explaining Word (Words Expression, Sentence) Color', $this->plugin_slug ); ?></label></th>
					<td>
						<input type="text" class="regular-text color" value="<?php echo esc_attr( $options['_word_color'] );?>" id="_word_color" name="settings[_word_color]" />
						<p class="description"><?php echo _e( 'Click on the text field to set another color.', $this->plugin_slug ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label><?php _e( 'Explaining Word (Words Expression, Sentence) Style', $this->plugin_slug ); ?></label></th>
					<td>
						<input type="checkbox" value="italic" name="settings[_word_font_style]" id="_font_style" <?php echo ( 'italic' == esc_attr( $options['_word_font_style'] ) ? 'checked="checked"' : '' );?> />
						<label for="_font_style">Italic</label>
						
						<input type="checkbox" value="bold" name="settings[_word_font_weight]" id="_font_weight" <?php echo ( 'bold' == esc_attr( $options['_word_font_weight'] ) ? 'checked="checked"' : '' );?> />
						<label for="_font_weight">Bold</label>
						
						<input type="checkbox" value="underline" name="settings[_word_text_decoration]" id="_font_decoration" <?php echo ( 'underline' == esc_attr( $options['_word_text_decoration'] ) ? 'checked="checked"' : '' );?> />
						<label for="_font_decoration">Underline</label>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="_alphabet"><?php _e( 'Explanatory Dictionary Alphabet', $this->plugin_slug ); ?></label></th>
					<td>

						    <input type="text" class="regular-text" value="<?php if( !empty ( $options['_alphabet'] ) ) { echo esc_attr( $options['_alphabet'] ); } ?>" id="settings[_alphabet]" name="settings[_alphabet]" <?php if( !empty( $options['_usedletters'] ) ) { ?>readonly="readonly" style="background-color:#EDEDED;"<?php } ?>>
						    <p class="description"><?php echo _e( 'Write here (separate by spaces) the alphabet of your explanatory dictionary (Example: A B C D E F G ...).', $this->plugin_slug ); ?></p>

						   <input type="checkbox" value="true" id="usedletters" name="settings[_usedletters]" <?php if ( !empty ( $options['_usedletters'] ) ) echo "checked='checked'";  ?> >
						   <p class="description"><?php echo _e( 'If checked the unused letters will not be displayed.', $this->plugin_slug ); ?></p>        
					</td>
				</tr>
			</table>
			<p>
				<input type="submit" value="<?php _e( 'Reset', $this->plugin_slug );?>" class="button button-primary" id="reset" name="reset" onClick="return confirm('<?php _e( 'Are you sure you want to reset all settings to default?', $this->plugin_slug );?>');" />
				<input type="submit" value="<?php _e( 'Save', $this->plugin_slug );?>" class="button button-primary" id="submit" name="submit" />
			</p>
		</form>
	</div>
</div>