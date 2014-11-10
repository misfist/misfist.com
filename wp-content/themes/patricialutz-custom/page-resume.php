<?php
/**
 * template name: Resume
 * @package WordPress
 * @subpackage Chunk
 */

 get_header(); ?>

    <main id="contents">
        
        <?php
        $args = array(
            'orderby' => 'id',
            'order' => 'ASC'
        );
        // get all the categories from the database
        $cats = get_categories($args);

            // loop through the categries
            foreach ($cats as $cat) {
                // setup the cateogory ID
                $cat_id= $cat->term_id;
                // Make a header for the category ?>

                <section <?php post_class() ?> >
                    <aside class="entry-meta">
                        <h1><?php echo $cat->name ?></h1>
                    </aside>
            
                <?php
                // create a custom wordpress query
                query_posts("cat=$cat_id&post_per_page=100&orderby=date&order=DESC");
                // start the wordpress loop!
                if (have_posts()) : while (have_posts()) : the_post(); ?>

               <?php get_template_part( 'content', get_post_format() ); ?>

                <?php endwhile; endif; // done our wordpress loop. Will start again for each category ?>
            </section>
            <?php } // done the foreach statement ?>

    </main>
 
 <?php get_footer(); ?>