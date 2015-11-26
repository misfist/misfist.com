<?php
/**
 * @package gridz
 * Template Name: Fullwidth
 */
?>
<?php get_header(); ?>
<div id="container">    
    <?php if(have_posts()): ?>
        <?php while(have_posts()): the_post(); ?>
            <?php get_template_part('content', get_post_format()); ?>
            <?php comments_template(); ?>
        <?php endwhile; ?>        
    <?php else : ?>
        <?php get_template_part('content', 'none'); ?>
    <?php endif; ?>
</div>
<?php get_footer(); ?>