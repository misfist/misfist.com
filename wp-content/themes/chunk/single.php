<?php
/**
 * @package Chunk
 */

get_header(); ?>

	<div id="contents">
		<?php if ( have_posts() ) : ?>
			<?php the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>
		<?php else : ?>

		<div class="hentry error404">
			<div class="postbody text">
				<h1><?php _e( 'Nothing Found', 'chunk' ); ?></h1>
				<div class="content">
					<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'chunk' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .content -->
			</div><!-- .postbody -->
		</div>

		<?php endif; ?>
	</div><!-- #contents -->

	<div class="navigation">
		<div class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Previous post', 'chunk' ) ); ?></div>
		<div class="nav-next"><?php next_post_link( '%link', __( 'Next post <span class="meta-nav">&rarr;</span>', 'chunk' ) ); ?></div>
	</div>

<?php get_footer();
