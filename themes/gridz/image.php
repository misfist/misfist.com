<?php
/**
 * @package gridz
 */
?>
<?php $metadata = wp_get_attachment_metadata(); ?>
<?php get_header(); ?>
<?php if($gridz_options['sidebar_layout'] == "left"): ?>
    <?php get_sidebar(); ?>
<?php endif; ?>
<div id="container">    
    <?php if(have_posts()): ?>
        <?php while(have_posts()): the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php gridz_featured_image("full"); ?>
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
                    <div class="entry-attachment">
                        <div class="post-attachment">
                            <?php gridz_the_attached_image(); ?>
                        </div>
                        <?php if(has_excerpt()) : ?>
                            <div class="entry-caption">
                                <?php the_excerpt(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php the_content(); ?>
                    <?php wp_link_pages(array('before' => '<div class="page_link">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>')); ?>
                </div>
            </article>
            <nav class="post-navigation">
                <?php previous_image_link(false, '<span class="genericon-previous"></span>'); ?>
                <?php next_image_link(false, '<span class="genericon-next"></span>'); ?>
            </nav>
            <?php comments_template(); ?>
        <?php endwhile; ?>        
    <?php else : ?>
        <?php get_template_part('content', 'none'); ?>
    <?php endif; ?>
</div>
<?php if($gridz_options['sidebar_layout'] == "right"): ?>
    <?php get_sidebar(); ?>
<?php endif; ?>
<?php get_footer(); ?>