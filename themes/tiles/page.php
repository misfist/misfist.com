<?php get_header(); ?>

<div id="contentwrapper">
  <div id="content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="post" id="post-<?php the_ID(); ?>">
      <h1 class="entry-title">
        <?php the_title(); ?>
      </h1>
      <div class="entry">
        <?php the_content(); ?>
        <?php comments_template( '', true ); ?>
        <?php wp_link_pages(array('before' => '<p><strong>'. __( 'Pages:', 'tiles' ) .'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
      </div>
    </div>
    <?php endwhile; endif; ?>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
