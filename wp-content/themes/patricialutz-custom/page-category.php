<?php
/**
 * template name: Posts by Category
 * @package WordPress
 * @subpackage Chunk
 */

 get_header(); ?>

    <div class="page-title">
        <h2><?php the_title() ?></h2>
    </div>

    <div id="contents">
        
        <?php
        // get all the categories from the database
        $cats = get_categories('orderby=id');

            // loop through the categries
            foreach ($cats as $cat) {
                // setup the cateogory ID
                $cat_id= $cat->term_id;
                // Make a header for the category
                echo "<div ";
                echo post_class();
                echo ">";
                echo "<div class='entry-meta'>";
                echo "<div class='date'><h1>" .$cat->name. "</h1></div>";   
                echo "</div>";   
            
                // create a custom wordpress query
                query_posts("cat=$cat_id&post_per_page=100&orderby=date&order=DESC");
                // start the wordpress loop!
                if (have_posts()) : while (have_posts()) : the_post(); ?>

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
            <?php } // done the foreach statement ?>

        </div>
    </div>
 
 <?php get_footer(); ?>