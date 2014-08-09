<article <?php post_class('post') ?>>
<header class="meta-description">
	<?php typo_posted_on(); ?>	
<h2><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(sprintf(__('Permanent Link to %s', 'typo-o-graphy'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
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
	if ( has_post_thumbnail()) {
		the_post_thumbnail('typo_single_post');
	}
	?>
	           <?php
                        if (!empty($post -> post_excerpt))
                        echo '<h3 class="post_excerpt">'.get_the_excerpt().'</h3>';
                        ?>
	<?php the_content(__('Continue reading &rarr;', 'typo-o-graphy')); ?>
	<?php wp_link_pages(array('before' => '<div class="page-link">' . __('<span>Pages:</span>', 'typo-o-graphy'), 'after' => '</div>')); ?>
</div>
<?php comments_template(); ?>
</article> 