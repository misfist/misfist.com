<?php
/**
 * @package gridz
 */
?>
<?php get_header(); ?>
<?php if($gridz_options['sidebar_layout'] == "left"): ?>
    <?php get_sidebar(); ?>
<?php endif; ?>
<div id="container">
    <?php if(have_posts()): ?>
        <?php while(have_posts()): the_post(); ?>
            <?php get_template_part('content', get_post_format()); ?>
        <?php endwhile; ?>        
    <?php else : ?>
        <?php get_template_part('content', 'none'); ?>
    <?php endif; ?>
    <?php gridz_pagination(); ?>
</div>
<?php if($gridz_options['sidebar_layout'] == "right"): ?>
    <?php get_sidebar(); ?>
<?php endif; ?>
<?php get_footer(); ?>