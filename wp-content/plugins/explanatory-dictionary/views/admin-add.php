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

if ( isset( $_POST['admin_new_item'] ) && wp_verify_nonce( $_POST['admin_new_item'], $this->get_nonce( 'new-item' ) ) ) {
	$added = $this->add_new_entry( $_POST['entry-word'], $_POST['entry-synonyms'], $_POST['entry-explanation'] );
	
	$array_synonyms = array();
	if( !empty( $_POST['entry-synonyms'] ) ) {
		$array_synonyms = explode(',', $_POST['entry-synonyms'] );
		array_walk( $array_synonyms, array( 'self' , 'trim' ) );
		$array_synonyms = array_unique( $array_synonyms );
	}
	
	$entry = new ArrayObject();
	$entry->word = $_POST['entry-word'];
	$entry->synonyms_and_forms = $array_synonyms;
	$entry->explanation = $_POST['entry-explanation'];
	//$entry->status = $_POST['entry-status'];
	//$entry->id = $_POST['entry-id'];
}

$current_page = admin_url( 'admin.php?page=explanatory-dictionary&action=add' );
?>
<div class="wrap">

	<?php screen_icon(); ?>
	<h2><?php _e( 'Add a new item', $this->plugin_slug ); ?></h2>
	<?php if ( isset( $added ) ) :?>
	
		<?php if ( isset( $added ) ) :?>
			<?php if ( is_string( $added ) ) :?>
				<?php $this->admin_message( 
					$added, 
					'error', 
					'<a href="' . admin_url( 'admin.php?page=explanatory-dictionary' ) . '">' . __( '&larr; Return to the overview', $this->plugin_slug) . '</a>' 
				);?>
			<?php elseif ( 1 === $added || 0 === $added ) : ?>
				<?php $this->admin_message( 
					__( 'Added the new entry', $this->plugin_slug ), 
					'updated', 
					'<a href="' . admin_url( 'admin.php?page=explanatory-dictionary' ) . '">' . __( '&larr; Return to the overview', $this->plugin_slug) . '</a>' 
				);?>
				<?php unset($entry);?>
			<?php else :?>
				<?php $this->admin_message( 
					__( 'Error while adding the new entry', $this->plugin_slug ),
					'error', 
					'<a href="' . admin_url( 'admin.php?page=explanatory-dictionary' ) . '">' . __( '&larr; Return to the overview', $this->plugin_slug) . '</a>' 
				);?>
			<?php endif;?>
		<?php endif;?>
	<?php endif;?>
	
	<div id="poststuff">
		<form name="form0" method="post" action="<?php echo $current_page; ?>">
			<?php wp_nonce_field( $this->get_nonce( 'new-item' ), 'admin_new_item' ); ?>
			<table class="form-table">
				<tr>
					<th>
						<label for="entry-word"><?php _e( 'Word (word, expression, sentence)', $this->plugin_slug ); ?></label>
					</th>
					<td>
						<input type="text" id="entry-word" name="entry-word" value="<?php echo isset( $entry ) ? $entry->word : '';?>" size="30" />
						<br />
						<span class="description"><?php _e( '<strong>Required:</strong> The word expression, sentence', $this->plugin_slug ); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label for="entry-synonyms"><?php _e( 'Synonyms and forms', $this->plugin_slug ); ?></label>
					</th>
					<td>
						<textarea cols="100" rows="5" id="entry-synonyms" name="entry-synonyms"><?php echo isset( $entry ) ? $this->synonyms_output( $entry->synonyms_and_forms ) : '';?></textarea>
						<br />
						<span class="description"><?php _e( '(optional) Separate by commas the words (words expressions, sentences) which has the same explanation.', $this->plugin_slug ); ?></span>
					</td>
				</tr>
				<tr>
					<th>
						<label for="entry-explanation"><?php _e( 'Explanation', $this->plugin_slug ); ?></label>
					</th>
					<td>
						<textarea cols="100" rows="5" id="entry-explanation" name="entry-explanation"><?php echo isset( $entry ) ? $entry->explanation : '';?></textarea>
						<br />
						<span class="description"><?php _e( "<strong>Required:</strong> The explanation for this word (words expression, sentence)", $this->plugin_slug ); ?></span>
					</td>
				</tr>
			</table><!-- .form-table -->
			<?php submit_button( __( 'Add item', $this->plugin_slug ) ); ?>
		</form>
	</div><!-- #poststuff -->
</div>