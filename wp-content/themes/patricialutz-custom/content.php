<?php
/**
 * @package WordPress
 * @subpackage Chunk
 */
?>

<article class="main">
	<h2 class="entry-title"><?php the_title(); ?></h2>
	<div class="entry-content">
		<?php wp_link_pages( array( 'before' => '<p class="page-link"><span>' . __( 'Pages:', 'chunk' ) . '</span>', 'after' => '</p>' ) ); ?>
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'chunk' ) ); ?>
	</div>
	<?php the_tags( '<span class="tag-links"><strong>' . __( 'Tagged', 'chunk' ) . '</strong> ', ', ', '</span>' ); ?>
</article>
