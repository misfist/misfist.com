<?php get_header(); ?>
<?php $bavotasan_theme_options = bavotasan_theme_options(); ?>

	<section id="primary">

		<?php if ( have_posts() ) : ?>

			<header id="search-header">
				<h1 class="page-title"><?php
				global $wp_query;
			    $num = $wp_query->found_posts;
				printf( '%1$s "%2$s"',
				    $num . __( ' search results for', 'carton'),
				    get_search_query()
				);
				?></h1>
			</header><!-- #search-header -->

			<div id="boxes" class="js-masonry" data-masonry-options='{ "columnWidth": <?php echo $bavotasan_theme_options['column_width']; ?>, "itemSelector": ".masonry" }'>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

			</div>

			<?php bavotasan_content_nav(); ?>

		<?php else : ?>

			<article id="post-0" class="post error404 not-found">

		    	<header>
		    	   	<h1 class="post-title"><?php _e( 'Nothing found', 'carton' ); ?></h1>
		        </header>

		        <div class="entry">
		            <p><?php _e( 'No results were found for your search. Please try again.', 'carton' ); ?></p>
		        </div>

		    </article><!-- #post-0.post -->

		<?php endif; ?>

	</section><!-- #primary.c8 -->

<?php get_footer(); ?>