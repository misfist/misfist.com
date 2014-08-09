<div class="eleven columns">
	<?php if (have_posts()) : the_post();
	?>
	<article <?php post_class('post') ?>>
		<header class="meta-description">
			<?php typo_posted_on(); ?>
			<?php the_title('<h1>', '</h1>'); ?>
<?php
if (comments_open()) :
	echo '<p>';
	comments_popup_link(__('No comments yet', 'typo-o-graphy'), __('1 comment', 'typo-o-graphy'), __('% comments', 'typo-o-graphy'), 'comments-link', __('Comments are off for this post', 'typo-o-graphy'));
	echo '</p>';
endif;
?>			
			<?php  typo_posted_footer(); ?>
		</header>
		<div class="post-content">
			<?php 
				if ( has_post_thumbnail() && has_post_format( 'image' ) || has_post_format( 'audio' ) ):
				the_post_thumbnail('large');
				endif;
			?>
			<?php
                        if (!empty($post -> post_excerpt))
                        echo '<h2 class="post_excerpt">'.get_the_excerpt().'</h2>';
                        ?>
			<?php the_content(); ?>
			<?php wp_link_pages(array('before' => '<div class="page-link">' . __('<span>Pages:</span>', 'typo-o-graphy'), 'after' => '</div>')); ?>
					<?php
if ( get_the_author_meta( 'description' ) ) :
			?>
			<div id="author-info">

				<h3><a href="<?php esc_url(get_author_posts_url(get_the_author_meta('ID'))) ?>" rel="author"><?php the_author(); ?></a></h3>
				<?php	echo get_avatar(get_the_author_meta('user_email'));?>

				<p>
					<?php	the_author_meta('description');?> <br />
					<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>" rel="author"> <?php printf(__('View all posts by %s &rarr;', 'typo-o-graphy'), get_the_author());?></a>
				</p>
			</div>
			<?php	endif;?>		
		</div>
		<?php comments_template(); ?>
	</article>
	<?php endif; ?>
</div>
<?php get_sidebar(); ?>