<?php
/**
 * @package WordPress
 * @subpackage Chunk
 */
?>

<div class="main">
    <?php // create our link now that the post is setup ?>
    <h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
    <div class="entry-content">
        <?php the_content(); ?>
    </div>
    <?php the_tags( '<span class="tag-links"><strong>' . __( 'Tagged', 'chunk' ) . '</strong> ', ', ', '</span>' ); ?>
</div>
