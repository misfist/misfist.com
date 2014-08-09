<?php
/**
 * Represents the view for the public-facing component of the plugin.
 *
 * This typically includes any information, if any, that is rendered to the
 * frontend of the theme when the plugin is activated.
 *
 * @package   Explanatory_Dictionary
 * @author    EXED internet (RJvD, BHdH) <service@exed.nl>
 * @license   GPL-2.0+
 * @link      http://www.exed.nl/
 * @copyright 2013  EXED internet  (email : service@exed.nl)
 */

$settings = $this->settings->get_settings_list();
$alphabet = $settings['_alphabet'];
$alphabet = explode( ' ', $alphabet );
$letterscheck = $settings['_usedletters'];
$letters = array();

if ( isset( $atts['letter'] ) ) {
	$letters = array( trim( strtoupper( $atts['letter'] ) ) );
} else if ( isset( $atts['letters'] ) ) {
	$letters = explode( ',', $atts['letters'] );
	foreach ( $letters as $key => $letter ) {
		$letters[ $key ] = trim( strtoupper( $letter ) );
	}
} else if ( isset( $_GET['explanatory_dictionary_alphabet_letter'] ) ) {
	$letters = array( trim( strtoupper( $_GET['explanatory_dictionary_alphabet_letter'] ) ) );
} else {
	$letters = $alphabet;
}

$dictionary_entries = $this->get_dictionary( $letters );

$counter = 1;
// TODO: Don't display the alphabet when shorcode had letter or letters

if( empty ( $letterscheck ) ){
?>
<div class="explanatory-dictionary-alphabet">
	<?php foreach ( $alphabet as $letter ) :?>
		<?php if ( $this->has_words_for_letter( $letter ) ) : ?>
			<?php if ( ! isset( $_GET['explanatory_dictionary_alphabet_letter'] ) || $letter != $_GET['explanatory_dictionary_alphabet_letter'] ) :?>
				<a href="<?php echo add_query_arg( 'explanatory_dictionary_alphabet_letter', $letter ); ?>"><?php echo $letter; ?></a>
			<?php else :?>
				<span class="explanatory-dictionary-letter-selected"><?php echo $letter;?></span>
			<?php endif;?>
		<?php else : ?>
			<?php echo $letter; ?>
		<?php endif;?>
		
		<?php if ( $counter < count( $alphabet ) ) :?>
			|
		<?php endif;?>
		<?php $counter++;?>
	<?php endforeach;?>
<?php }
if( ! empty ( $letterscheck ) ){
?>
<div class="explanatory-dictionary-alphabet">
	<?php foreach ( $alphabet as $letter ) :?>
		<?php if ( $this->has_words_for_letter( $letter ) ) : ?>
			<?php if ( ! isset( $_GET['explanatory_dictionary_alphabet_letter'] ) || $letter != $_GET['explanatory_dictionary_alphabet_letter'] ) :?>
|&nbsp;<a href="<?php echo add_query_arg( 'explanatory_dictionary_alphabet_letter', $letter ); ?>"><?php echo $letter; ?></a>
			<?php else :?>
				|&nbsp;<span class="explanatory-dictionary-letter-selected"><?php echo $letter;?></span>
			<?php endif;?>
		<?php else : ?>
			
		<?php endif;?>
		 
		<?php if ( $counter < count( $alphabet ) ) :?>
			
		<?php endif;?>
		<?php $counter++;?>
	<?php endforeach;?>
<?php } ?>
	
</div>
<?php if ( isset( $_GET['explanatory_dictionary_alphabet_letter'] ) ) :?>
	<a href="<?php echo remove_query_arg( 'explanatory_dictionary_alphabet_letter' ); ?>"><?php _e( 'Reset list', $this->plugin_slug );?></a>
<?php endif;?>
<div class="explanatory-dictionary-entries">
	<?php foreach ( $dictionary_entries as $entry ) : ?>
	
		<div class="explanatory-dictionary-entry">
			<span class="explanatory-dictionary-entry-word"><?php echo $entry->word; ?></span>&nbsp;-&nbsp;
			<span class="explanatory-dictionary-entry-explanation"><?php echo $entry->explanation; ?></span>
		</div>
		
	<?php endforeach;?>
</div>