<?php get_header(); ?>

<div id="contentwrapper">
  <div id="content">
    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
    <div class="post">
      <div class="postdate"> <?php echo get_the_date(); ?> </div>
      <h2 class="entry-title" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark">
        <?php the_title(); ?>
        </a></h2>
      <div class="entry">
        <?php the_excerpt(); ?>
      </div>
      <div class="belowpost"><a class="more-link" href="<?php the_permalink(); ?>" >
        <?php _e( 'Read More', 'tiles' ); ?>
        </a></div>
    </div>
    <?php endwhile; ?>
    <?php if (function_exists("tiles_pagination")) { tiles_pagination($post->max_num_pages); } ?>
    <?php else : ?>
    <p class="center">
      <?php _e( 'No Posts Found.', 'tiles' ); ?>
    </p>
    <?php endif; ?>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
