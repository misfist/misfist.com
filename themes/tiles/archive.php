<?php get_header(); ?>

<div id="contentwrapper">
  <div class="grid-wrap">
    <div class="grid swipe-right" id="grid">
      <?php query_posts( $query_string . '&posts_per_page=-1' ); ?>
      <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
      <li> <a href="<?php the_permalink() ?>" rel="bookmark">
        <?php if (has_post_thumbnail()) : ?>
        <?php the_post_thumbnail('tiles-blogthumb'); ?>
        <?php else : ?>
        <img src="<?php echo get_template_directory_uri(); ?>/images/dummy.png"/>
        <?php endif; ?>
        <h2 class="entry-title" id="post-<?php the_ID(); ?>">
          <?php the_title(); ?>
        </h2>
        </a> </li>
      <?php endwhile; ?>
      <?php else : ?>
      <h2 class="center">
        <?php _e( 'Not Found', 'tiles' ); ?>
      </h2>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
