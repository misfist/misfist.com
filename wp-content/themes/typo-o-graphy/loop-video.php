<article <?php post_class('post') ?>>
<div class="post-content">
	<?php the_content(__('Continue reading &rarr;', 'typo-o-graphy')); ?>
</div>
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
<a href="<?php echo get_post_format_link('video'); ?>"><?php _e( 'Video', 'typo-o-graphy' ); ?></a>
</header>
</article> 