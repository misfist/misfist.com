<article <?php post_class('post') ?>>
<div class="post-content">
	<?php if ( has_post_thumbnail()) :
	?>
	<a href="<?php the_permalink();?>"><?php the_post_thumbnail('large');?></a>
	<?php	 else :
		$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
		if ( $images ) :
		$total_images = count( $images );
		$image = array_shift( $images );
		$image_img_tag = wp_get_attachment_image( $image->ID, 'large' );
	?>
	<a href="<?php the_permalink();?>"><?php echo $image_img_tag;?></a>
	<?php  endif;   endif;?>
	<?php the_excerpt(__('Continue reading &rarr;', 'typo-o-graphy')); ?>
	<?php wp_link_pages(array('before' => '<div class="page-link">' . __('<span>Pages:</span>', 'typo-o-graphy'), 'after' => '</div>')); ?>
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
<a href="<?php echo get_post_format_link('image'); ?>"><?php _e( 'Image', 'typo-o-graphy' ); ?></a>
</header>
</article> 