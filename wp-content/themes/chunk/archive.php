<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Chunk
 */

get_header(); ?>

<div class="page-title">
	<h2 class="page-title">
		<?php
			if ( is_category() ) :
				printf( __( 'Category Archives: %s', 'chunk' ), '<span>' . single_cat_title( '', false ) . '</span>' );

			elseif ( is_tag() ) :
				printf( __( 'Tag Archives: %s', 'chunk' ), '<span>' . single_tag_title( '', false ) . '</span>' );

			elseif ( is_author() ) :
				/* Queue the first post, that way we know
				 * what author we're dealing with (if that is the case).
				*/
				the_post();
				printf( __( 'Author Archives: %s', 'chunk' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
				/* Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();

			elseif ( is_day() ) :
				printf( __( 'Daily Archives: %s', 'chunk' ), '<span>' . get_the_date() . '</span>' );

			elseif ( is_month() ) :
				printf( __( 'Monthly Archives: %s', 'chunk' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

			elseif ( is_year() ) :
				printf( __( 'Yearly Archives: %s', 'chunk' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

			elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
				_e( 'Asides', 'chunk' );

			elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
				_e( 'Images', 'chunk');

			elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
				_e( 'Videos', 'chunk' );

			elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
				_e( 'Quotes', 'chunk' );

			elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
				_e( 'Links', 'chunk' );

			else :
				_e( 'Archives', 'chunk' );

			endif;
		?>
	</h2>
</div>

<div id="contents">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>

		<?php endwhile; ?>
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
	<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'chunk' ) ); ?></div>
	<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'chunk' ) ); ?></div>
</div>

<?php get_footer(); ?>