<?php
/**
 * @package gridz
 */
?>
<?php
if(post_password_required()) return;
?>
<div id="comments">
    <?php if(have_comments()): ?>
        <h2 class="comments-title"><?php printf(_nx('One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'gridz'), number_format_i18n(get_comments_number())); ?></h2>
        <?php if(get_comment_pages_count() > 1 && get_option('page_comments')): ?>
            <nav class="comment-navigation">
                <?php previous_comments_link('<span class="genericon-previous"></span>'); ?>
                <?php next_comments_link('<span class="genericon-next"></span>'); ?>
            </nav>
        <?php endif; ?>
        <ul class="comments-list"><?php wp_list_comments(array('callback'=>'gridz_comments')); ?></ul>
        <?php if(!comments_open() && get_comments_number()): ?>
            <p class="no-comments"><?php _e('Comments are closed', 'gridz'); ?></p>
        <?php endif; ?>
    <?php endif; ?>
    <?php comment_form(); ?>
</div>