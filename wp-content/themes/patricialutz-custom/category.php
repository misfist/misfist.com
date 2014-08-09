<?php
/**
 * template name: Posts by Category
 * @package WordPress
 * @subpackage Chunk
 */

 get_header(); ?>

    <div class="page-title">
        <h2>
            <?php
            $category = get_the_category(); 
            echo $category[0]->cat_name;
            ?>
        </h2>
    </div>

    <div id="contents">
        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

            <div class="entry-meta">
                <div class="date">
                    <?php
                    $category = get_the_category(); 
                    echo $category[0]->cat_name;
                    ?>
                </div>
            </div>
        
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <div class="main">
                    <?php // create our link now that the post is setup ?>
                    <h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
                    <div class="entry-content">
                    <?php the_content(); ?>
                    </div>
                    <?php the_tags( '<span class="tag-links"><strong>' . __( 'Tagged', 'chunk' ) . '</strong> ', ', ', '</span>' ); ?>
                </div>

                <?php endwhile; endif; // done our wordpress loop. Will start again for each category ?>
        </div>

    </div>
 
 <?php get_footer(); ?>