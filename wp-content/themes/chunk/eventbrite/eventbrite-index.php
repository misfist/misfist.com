<?php
/**
 * The template for displaying all Eventbrite events (index), and archives (sorted by organizer or venue).
 */

get_header(); ?>

	<div class="page-title">
		<h2 class="page-title">
			<?php the_title(); ?>
		</h2>
	</div>

	<div id="contents">
		<?php
			// Set up and call our Eventbrite query.
			$events = new Eventbrite_Query( apply_filters( 'eventbrite_query_args', array(
				// 'display_private' => false, // boolean
				// 'limit' => null,            // integer
				// 'organizer_id' => null,     // integer
				// 'p' => null,                // integer
				// 'post__not_in' => null,     // array of integers
				// 'venue_id' => null,         // integer
			) ) );

			if ( $events->have_posts() ) :
				while ( $events->have_posts() ) : $events->the_post(); ?>

					<div id="event-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-meta">
							<?php eventbrite_event_meta(); ?>

							<?php eventbrite_edit_post_link( __( 'Edit', 'eventbrite_api' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- .entry-meta -->

						<div class="main">
							<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

							<div class="entry-content">
								<?php eventbrite_ticket_form_widget(); ?>
							</div><!-- .entry-content -->
						</div><!-- .main -->
					</div><!-- #post-## -->

				<?php endwhile;

			else :
				// If no content, include the "No posts found" template.
				get_template_part( 'content', 'none' );

			endif;

			// Return $post to its rightful owner.
			wp_reset_postdata();
		?>
	</div><!-- #contents -->

	<div class="navigation">
		<?php eventbrite_paging_nav( $events ); ?>
	</div>

<?php get_footer(); ?>
