<?php get_header(); ?>
<div class="row">
<div class="sixteen columns">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
<h5 class="latest-title">
<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h5>
<?php the_excerpt(); ?>
</article>
<?php endwhile; ?>
<div class="row">
<div class="ten columns centered">
<section id="post-nav" role="navigation">
<?php posts_nav_link(); ?>
</section><!--End Navigation-->
</div>
</div>
</div>
</div>
<?php else : ?>
	<h2 class="center"><?php esc_attr_e('Nothing is Here', 'bartleby'); ?></h2>
	<div class="entry-content">
	<p><?php esc_attr_e( 'Sorry, but we couldn\'t find what you we\'re looking for.', 'bartleby' ); ?></p>
	</div><!-- .entry-content -->
<?php endif; ?>
<?php get_footer(); ?>