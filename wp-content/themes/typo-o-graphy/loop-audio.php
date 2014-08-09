<article <?php post_class('post') ?>>
<div class="post-content">
	<?php
	if ( has_post_thumbnail()) {
		the_post_thumbnail('large');
	}
	?>	
<?php the_content(__('Continue reading &rarr;', 'typo-o-graphy')); ?>	
</div>
<header class="meta-description">	 
<?php typo_posted_on(); ?>
<?php
if (comments_open()) :
	echo '<p>';
	comments_popup_link(__('No comments yet', 'typo-o-graphy'), __('1 comment', 'typo-o-graphy'), __('% comments', 'typo-o-graphy'), 'comments-link', __('Comments are off for this post', 'typo-o-graphy'));
	echo '</p>';
endif;
?>
<a href="<?php echo get_post_format_link('audio'); ?>"><?php _e('Audio', 'typo-o-graphy'); ?></a>
</header>
</article> 