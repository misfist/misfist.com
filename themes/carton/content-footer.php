<?php
/**
 * The template for displaying article footers
 *
 * @since 1.0.0
 */
 ?>
	<footer class="entry">
	    <?php
	    if ( is_single() ) wp_link_pages( array( 'before' => '<p id="pages">' . __( 'Pages:', 'carton' ) ) );
	    edit_post_link( __( '(edit)', 'carton' ), '<p class="edit-link">', '</p>' );
		if ( is_single() ) the_tags( '<p class="tags"><span>' . __( 'Tags:', 'carton' ) . '</span>', ' ', '</p>' );
	    ?>
	</footer><!-- .entry -->