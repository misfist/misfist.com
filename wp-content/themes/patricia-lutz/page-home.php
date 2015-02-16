<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Patricia Lutz
 */

get_header(); ?>

<!--STICKER-->
<div id="sticker"></div>

<div id="wrapper">

	<?php get_template_part( 'section', 'bio' ); ?>

	<?php get_template_part( 'section', 'experience' ); ?>

	<?php get_template_part( 'section', 'skills' ); ?>

	<?php get_template_part( 'section', 'education' ); ?>

	<?php get_template_part( 'section', 'honors' ); ?>

	<?php get_template_part( 'section', 'recommendations' ); ?>

	<?php get_template_part( 'section', 'contact' ); ?>

</div><!--end wrapper-->

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
