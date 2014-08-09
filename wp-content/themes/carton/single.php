<?php get_header(); ?>

	<div id="primary">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>

			<div id="posts-pagination">
				<h3 class="screen-reader-text"><?php _e( 'Post navigation', 'carton' ); ?></h3>
				<?php if ( 'attachment' == get_post_type( get_the_ID() ) ) { ?>
					<div class="previous fl"><?php previous_image_link( false, __( '&larr; Previous Image', 'carton' ) ); ?></div>
					<div class="next fr"><?php next_image_link( false, __( 'Next Image &rarr;', 'carton' ) ); ?></div>
				<?php } else { ?>
					<div class="previous fl"><?php previous_post_link( '%link', __( '&larr; %title', 'carton' ) ); ?></div>
					<div class="next fr"><?php next_post_link( '%link', __( '%title &rarr;', 'carton' ) ); ?></div>
				<?php } ?>
			</div><!-- #posts-pagination -->

			<?php comments_template( '', true ); ?>

		<?php endwhile; // end of the loop. ?>

	</div><!-- #primary.c8 -->

<?php get_footer(); ?>