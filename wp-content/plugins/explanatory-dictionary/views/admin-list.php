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

$current_page = admin_url( 'admin.php?page=explanatory-dictionary' );

/* Get a count of all the entries available. */
$entries_count = $this->get_number_of_entries();

/* Get all of the active and inactive entries. */
$active_entries = $this->get_all_entries_by_status(1);

$inactive_entries = $this->get_all_entries_by_status(0);

/* Get a count of the active and inactive entries. */
$active_entries_count = count( $active_entries );
$inactive_entries_count = count( $inactive_entries );

/* If we're viewing 'active' or 'inactive' entries. */
if ( !empty( $_GET['entry_status'] ) && in_array( $_GET['entry_status'], array( 'active', 'inactive' ) ) ) {

	/* Get the role status ('active' or 'inactive'). */
	$entry_status = esc_attr( $_GET['entry_status'] );

	/* Set up the entries array. */
	$list_entries = ( ( 'active' == $entry_status ) ? $active_entries : $inactive_entries );

	/* Set the current page URL. */
	$current_page = admin_url( "admin.php?page=explanatory-dictionary&entry_status={$entry_status}" );
}

/* If viewing the regular role list table. */
else {

	/* Get the role status ('active' or 'inactive'). */
	$entry_status = 'all';

	/* Set up the entries array. */
	$list_entries = array_merge( $active_entries, $inactive_entries );

	/* Set the current page URL. */
	$current_page = $current_page = admin_url( 'admin.php?page=explanatory-dictionary' );
}

/* Sort the entries array into alphabetical order. */
ksort( $list_entries );
?>
<div class="wrap">

	<?php screen_icon(); ?>
	<h2>
		<?php echo esc_html( get_admin_page_title() ); ?>
		<a href="<?php echo $current_page . '&action=add'; ?>" class="add-new-h2"><?php _e( 'Add New', $this->plugin_slug );?></a>	
	</h2>

	<?php if ( isset( $message ) ) : ?>
		<?php $this->admin_message( $message, $class );?>
	<?php endif;?>
	
	<div id="poststuff">

		<form id="explanatory-dictionary" action="<?php echo $current_page; ?>" method="post">

			<?php wp_nonce_field( $this->get_nonce( 'list-dictionary' ) ); ?>

			<ul class="subsubsub">
				<li><a <?php if ( 'all' == $entry_status ) echo 'class="current"'; ?> href="<?php echo admin_url( esc_url( 'admin.php?page=explanatory-dictionary' ) ); ?>"><?php _e( 'All', $this->plugin_slug ); ?> <span class="count">(<span id="all_count"><?php echo $entries_count; ?></span>)</span></a> | </li>
				<li><a <?php if ( 'active' == $entry_status ) echo 'class="current"'; ?> href="<?php echo admin_url( esc_url( 'admin.php?page=explanatory-dictionary&amp;entry_status=active' ) ); ?>"><?php _e( 'Active', $this->plugin_slug ); ?> <span class="count">(<span id="active_count"><?php echo $active_entries_count; ?></span>)</span></a> | </li>
				<li><a <?php if ( 'inactive' == $entry_status ) echo 'class="current"'; ?> href="<?php echo admin_url( esc_url( 'admin.php?page=explanatory-dictionary&amp;entry_status=inactive' ) ); ?>"><?php _e( 'Inactive', $this->plugin_slug ); ?> <span class="count">(<span id="inactive_count"><?php echo $inactive_entries_count; ?></span>)</span></a></li>
			</ul><!-- .subsubsub -->

			<div class="tablenav">
					<div class="alignleft actions">
						<select name="bulk-action">
							<option value="" selected="selected"><?php _e( 'Bulk Actions', $this->plugin_slug ); ?></option>
							<option value="bulk-active"><?php _e( 'Set Active', $this->plugin_slug ); ?></option>
							<option value="bulk-inactive"><?php _e( 'Set Inactive', $this->plugin_slug ); ?></option>
							<option value="bulk-delete"><?php _e( 'Delete', $this->plugin_slug ); ?></option>
						</select>
						<?php submit_button( esc_attr__( 'Apply', $this->plugin_slug ), 'button-secondary action', 'entries-bulk-action', false ); ?>
					</div><!-- .alignleft .actions -->

				<div class='tablenav-pages one-page'>
					<!-- <span class="displaying-num"><?php printf( _n( '%s item', '%s items', count( 1 ), $this->plugin_slug ), count( 1 ) ); ?></span> -->
				</div>

				<br class="clear" />
			</div><!-- .tablenav -->

			<table class="widefat fixed" cellspacing="0">
				<thead>
					<tr>
						<th class='check-column'><input type='checkbox' /></th>
						<th class='name-column'><?php _e( 'Word (words expression, sentence)', $this->plugin_slug ); ?></th>
						<th><?php _e( 'Synonyms and forms', $this->plugin_slug ); ?></th>
						<th><?php _e( 'Explanation', $this->plugin_slug ); ?></th>
					</tr>
				</thead>

				<tfoot>
					<tr>
						<th class='check-column'><input type='checkbox' /></th>
						<th class='name-column'><?php _e( 'Word (words expression, sentence)', $this->plugin_slug ); ?></th>
						<th><?php _e( 'Synonyms and forms', $this->plugin_slug ); ?></th>
						<th><?php _e( 'Explanation', $this->plugin_slug ); ?></th>
					</tr>
				</tfoot>

				<tbody id="users" class="list:user user-list plugins">

				<?php foreach ( $list_entries as $key => $entry ) : ?>

					<tr valign="top" class="<?php echo ( isset( $active_entries[$key] ) ? 'active' : 'inactive' ); ?>">

						<th class="manage-column column-cb check-column">
							<input type="checkbox" name="entries[<?php echo esc_attr( $entry->id ); ?>]" id="<?php echo esc_attr( $entry->id ); ?>" value="<?php echo esc_attr( $entry->id ); ?>" />
						</th><!-- .manage-column .column-cb .check-column -->

						<td class="plugin-title">
							<?php $edit_url = admin_url( "admin.php?page=explanatory-dictionary&action=edit&item={$entry->id}" );?>
							<?php $delete_url = admin_url( "admin.php?page=explanatory-dictionary&action=delete&item={$entry->id}" );?>
							<a href="<?php echo esc_url( $edit_url ); ?>" title="<?php _e( 'Edit this etry', $this->plugin_slug ); ?>">
								<strong><?php echo esc_html( $entry->word ); ?></strong>
							</a>
							<div class="row-actions">
								<span class="edit">
									<a href="<?php echo esc_url( $edit_url ); ?>" title="<?php _e( 'Edit this etry', $this->plugin_slug ); ?>">
										<?php _e( 'Edit', $this->plugin_slug ); ?>
									</a>
								</span>&nbsp;|&nbsp;
								<span class="delete">
									<a class="delete" href="<?php echo esc_url( $delete_url ); ?>" title="<?php _e( 'Delete this etry', $this->plugin_slug ); ?>" onClick="return confirm('<?php _e( 'Are you sure you want to delete this entry', $this->plugin_slug );?>');">
										<?php _e( 'Delete', $this->plugin_slug ); ?>
									</a>
								</span> 
							</div><!-- .row-actions -->
						</td><!-- .plugin-title -->

						<td class="desc">
							<p><?php echo $this->synonyms_output( $entry->synonyms_and_forms ); ?></p>
						</td><!-- .desc -->

						<td class="desc">
							<p><?php echo esc_html( $entry->explanation ); ?></p>
						</td><!-- .desc -->

					</tr><!-- .active .inactive -->

				<?php endforeach; ?>

				</tbody><!-- #users .list:user .user-list .plugins -->

			</table><!-- .widefat .fixed -->

			<div class="tablenav">
					<div class="alignleft actions">
						<select name="bulk-action-2">
							<option value="" selected="selected"><?php _e( 'Bulk Actions', $this->plugin_slug ); ?></option>
							<option value="bulk-active"><?php _e( 'Set Active', $this->plugin_slug ); ?></option>
							<option value="bulk-inactive"><?php _e( 'Set Inactive', $this->plugin_slug ); ?></option>
							<option value="bulk-delete"><?php _e( 'Delete', $this->plugin_slug ); ?></option>
						</select>
						<?php submit_button( esc_attr__( 'Apply', $this->plugin_slug ), 'button-secondary action', 'entries-bulk-action-2', false ); ?>
					</div><!-- .alignleft .actions -->

				<div class='tablenav-pages one-page'>
					<!-- <span class="displaying-num"><?php printf( _n( '%s item', '%s items', count( 1 ), $this->plugin_slug ), count( 1 ) ); ?></span> -->
				</div>
				<br class="clear" />
			</div><!-- .tablenav -->
		</form><!-- #entries -->
	</div><!-- #poststuff -->
</div>