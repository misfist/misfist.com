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

if ( isset( $_POST['admin_edit_item'] ) && wp_verify_nonce( $_POST['admin_edit_item'], $this->get_nonce( 'edit-item' ) ) ) {
	$status = isset( $_POST['entry-status'] ) ? 1 : 0;
	$edited = $this->update_entry( $_POST['entry-id'], $_POST['entry-word'], $_POST['entry-synonyms'], $_POST['entry-explanation'], $status );
	
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
	$entry->status = ( ! empty ($_POST['entry-status'] ) ? "1" : "0" );
	$entry->id = $_POST['entry-id'];
	
} else {
	$entry = $this->get_entry( $_GET['item'] );
}

$current_page = admin_url( "admin.php?page=explanatory-dictionary&action=edit&item={$_GET['item']}" );
?>
<div class="wrap">

	<?php screen_icon(); ?>
	<h2><?php _e( 'Edit a new item', $this->plugin_slug ); ?></h2>
	<?php if ( !empty( $entry ) ) : ?>
		<?php if ( isset( $edited ) ) :?>
			<?php if ( is_string( $edited ) ) :?>
				<?php $this->admin_message( 
					$edited, 
					'error', 
					'<a href="' . admin_url( 'admin.php?page=explanatory-dictionary' ) . '">' . __( '&larr; Return to the overview', $this->plugin_slug) . '</a>' 
				);?>
			<?php elseif ( 1 === $edited || 0 === $edited ) : ?>
				<?php $this->admin_message( 
					__( 'The entry was updated', $this->plugin_slug ), 
					'updated', 
					'<a href="' . admin_url( 'admin.php?page=explanatory-dictionary' ) . '">' . __( '&larr; Return to the overview', $this->plugin_slug) . '</a>' 
				);?>
			<?php else :?>
				<?php $this->admin_message( 
					__( 'Error while updateing the entry', $this->plugin_slug ),
					'error', 
					'<a href="' . admin_url( 'admin.php?page=explanatory-dictionary' ) . '">' . __( '&larr; Return to the overview', $this->plugin_slug) . '</a>' 
				);?>
			<?php endif;?>
		<?php endif;?>
		
		<div id="poststuff">
			<form name="form0" method="post" action="<?php echo $current_page; ?>">
				<?php wp_nonce_field( $this->get_nonce( 'edit-item' ), 'admin_edit_item' ); ?>
				<table class="form-table">
					<tr>
						<th>
							<label for="entry-word"><?php _e( 'Word (word, expression, sentence)', $this->plugin_slug ); ?></label>
						</th>
						<td>
							<input type="text" id="entry-word" name="entry-word" value="<?php echo $entry->word;?>" size="30" />
							<br />
							<span class="description"><?php _e( '<strong>Required:</strong> The word expression, sentence', $this->plugin_slug ); ?></span>
						</td>
					</tr>
					<tr>
						<th>
							<label for="entry-synonyms"><?php _e( 'Synonyms and forms', $this->plugin_slug ); ?></label>
						</th>
						<td>
							<textarea cols="100" rows="5" id="entry-synonyms" name="entry-synonyms"><?php echo $this->synonyms_output( $entry->synonyms_and_forms );?></textarea>
							<br />
							<span class="description"><?php _e( '(optional) Separate by commas the words (words expressions, sentences) which has the same explanation.', $this->plugin_slug ); ?></span>
						</td>
					</tr>
					<tr>
						<th>
							<label for="entry-explanation"><?php _e( 'Explanation', $this->plugin_slug ); ?></label>
						</th>
						<td>
							<textarea cols="100" rows="5" id="entry-explanation" name="entry-explanation"><?php echo $entry->explanation;?></textarea>
							<br />
							<span class="description"><?php _e( "<strong>Required:</strong> The explanation for this word (words expression, sentence)", $this->plugin_slug ); ?></span>
						</td>
					</tr>
					<tr>
						<th>
							<label for="entry-status"><?php _e( 'Active', $this->plugin_slug ); ?></label>
						</th>
						<td>
							<input type="checkbox" id="entry-status" name="entry-status" value="1" <?php echo '1' === $entry->status ? 'checked="checked"' : '' ;?> />
							<br />
							<span class="description"><?php _e( 'When checked the entry is active', $this->plugin_slug ); ?></span>
						</td>
					</tr>
				</table><!-- .form-table -->
				<input type="hidden" value="<?php echo $entry->id;?>" name="entry-id" />
				<?php submit_button( __( 'Edit item', $this->plugin_slug ) ); ?>
			</form>
		</div><!-- #poststuff -->
	<?php else : ?>
		<?php $this->admin_message( 'No item was specified', 'error', '<a href="' . admin_url( 'admin.php?page=explanatory-dictionary' ) . '">' . __( '&larr; Return to the overview', $this->plugin_slug) . '</a>'  );?>
	<?php endif;?>
</div>