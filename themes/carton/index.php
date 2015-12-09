<?php get_header(); ?>
<?php $bavotasan_theme_options = bavotasan_theme_options(); ?>

	<div id="primary">

		<?php if ( have_posts() ) : ?>

			<div id="boxes" class="js-masonry" data-masonry-options='{ "columnWidth": <?php echo $bavotasan_theme_options['column_width']; ?>, "itemSelector": ".masonry" }'>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

			</div>

			<?php bavotasan_content_nav(); ?>

		<?php endif; ?>

	</div><!-- #primary.c8 -->

<?php get_footer(); ?>