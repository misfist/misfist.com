<div class="sixteen columns">
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
			<?php the_content(); ?>
			<?php wp_link_pages(array('before' => '<div class="page-link">' . __('<span>Pages:</span>', 'typo-o-graphy'), 'after' => '</div>')); ?>
		</div>
		<?php comments_template(); ?>
	</article>
	<?php endif; ?>
</div>