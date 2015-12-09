<?php get_header(); ?>

<div id="contentwrapper">
  <div id="content">
    <?php while ( have_posts() ) : the_post(); ?>
    <div <?php post_class(); ?>>
      <div class="postdate"> <?php echo get_the_date(); ?> </div>
      <h1 class="entry-title">
        <?php the_title(); ?>
      </h1>
      <div class="entry">
        <?php the_content(); ?>
        <?php echo get_the_tag_list('<p class="singletags">',' ','</p>'); ?>
        <?php comments_template(); ?>
        <?php wp_link_pages(array('before' => '<p><strong>'. __( 'Pages:', 'tiles' ) .'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
      </div>
    </div>
    <?php endwhile; // end of the loop. ?>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
