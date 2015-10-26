<?php
/**
 * @package gridz
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php 
			if(is_single() || is_page())
				gridz_featured_image("full",false);
			else
				gridz_featured_image("full");
		?>
        <?php
            if(is_single() || is_page()): the_title('<h1 class="entry-title single-title">', '</h1>');
            else: the_title('<h1 class="entry-title"><a href="'.esc_url(get_permalink()).'" rel="bookmark">', '</a></h1>');
            endif;
        ?>
        <?php if(!is_page()): ?>
        <div class="entry-meta">
            <?php gridz_posted_on('M j, Y', '', __('By ','gridz')); ?>
            <?php gridz_comments_link(); ?>
            <?php gridz_utility_list(false,true,true,true,__('Posted in: ','gridz'), __('Tagged in: ','gridz')); ?>
        </div>
        <?php endif; ?>
    </header>
    <div class="entry-content">
        <?php if(is_single() || is_page()): ?>
            <?php the_content(__('Read more', 'gridz')); ?>
            <?php wp_link_pages(array('before' => '<div class="page-link">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>')); ?>
        <?php else: ?>
            <?php the_excerpt(); ?>
        <?php endif; ?>
    </div>
</article>
<?php if(is_single()): ?>
    <?php gridz_post_nav(); ?>
<?php endif; ?>