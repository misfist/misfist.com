<div <?php  if ( comments_open() ) { ?> id="comments" <?php } ?>>
	<?php if ( post_password_required() ) :
	?>
	<p>
		<?php _e('This post is password protected. Enter the password to view any comments.', 'typo-o-graphy'); ?>
	</p>
</div>
<?php
return;
endif;
?>
<?php if ( have_comments() ) :
?>
<h3><?php printf(_n('One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'typo-o-graphy'), number_format_i18n(get_comments_number()), '<em>' . get_the_title() . '</em>'); ?></h3>
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through?
?>
<div class="wp-pagenavi">
	<?php paginate_comments_links(); ?>
</div>
<?php endif; ?>

<ol class="commentlist">
	<?php wp_list_comments(array('callback' => 'typo_custom_comments')); ?>
</ol>
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through?
?>
<div class="wp-pagenavi">
	<?php paginate_comments_links(); ?>
</div>
<?php endif; ?>

<?php else : if ( ! comments_open() ) : ?>
<p class="nocomments">
	<?php _e('Comments are closed.', 'typo-o-graphy'); ?>
</p>
<?php endif; ?>

<?php endif; ?>

<?php comment_form(); ?>

</div>
