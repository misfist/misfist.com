<article <?php post_class('post') ?>>
<div class="post-content">
<?php
	$args = array(
	'post_type' => 'attachment', 
	'numberposts' => -1, 
	'post_status' => null, 
	'post_parent' => $post -> ID
	);
$attachments = get_posts($args);
				if ($attachments) :
					echo '<div class="flexslider"><ul class="slides">';
					foreach ($attachments as $attachment) :
						echo '<li>';
						echo wp_get_attachment_image($attachment -> ID, 'large');
						echo '</li>';
					endforeach;
					echo '</ul></div>';
				endif;
?>		
<?php the_excerpt(__('Continue reading &rarr;', 'typo-o-graphy')); ?>
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
<a href="<?php echo get_post_format_link('gallery'); ?>"><?php _e( 'Gallery', 'typo-o-graphy' ); ?></a>
</header>
</article> 