<?php get_header(); ?>
<?php global $bartleby_options;
	$bartleby_settings = get_option( 'bartleby_options', $bartleby_options );
?>
	<header id="archive-header">
		<div class="row">
		<div class="sixteen columns">
		<h1 class="big-headline-left">
			<?php if ( is_day() ) : ?>
			<?php printf( __( 'Daily Archives: %s', 'bartleby' ), '<span>' . get_the_date() . '</span>' ); ?>
			<?php elseif ( is_month() ) : ?>
			<?php printf( __( 'Monthly Archives: %s', 'bartleby' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date 				format', '' ) ) . '</span>' ); ?>
			<?php elseif ( is_year() ) : ?>
			<?php printf( __( 'Yearly Archives: %s', '' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', '' ) 				) . '</span>' ); ?>
			<?php else : ?>
			<?php esc_attr_e( 'Blog Archives', '' ); ?>
			<?php endif; ?>
		</h1>
	</div>
	</div>
	</header>
		<div class="row">
		<div class="sixteen columns">
		<div class="twelve columns">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
		<h5 class="latest-title">
		<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
		<?php the_title(); ?>
		</a>
		</h5>
		<?php the_excerpt(); ?>
		</article>
		<?php endwhile; ?>
		</div>
	<?php get_sidebar(); ?>
		</div>
		</div>
	<?php endif; ?>
	<div class="row">
	<div class="ten columns centered">
	<section id="post-nav">
	<?php posts_nav_link(); ?>
	</section><!--End Navigation-->
	</div>
	</div>
<?php get_footer(); ?>
