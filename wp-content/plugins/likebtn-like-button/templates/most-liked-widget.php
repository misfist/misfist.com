<?php
/**
 * Most Liked Content tempplate
 */

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');
?>

<?php echo $before_widget; ?>

<?php if (!empty($title)):
	echo $before_title . $title . $after_title;
endif ?>

<?php if (count($post_loop) > 0): ?>
	<ul class="likebtn-mlw">
	<?php foreach ($post_loop as $post): ?>
		<li id="post-<?php echo $post['id'] ?>" class="likebtn-mlw-item" >
            <a href="<?php echo $post['link'] ?>" title="<?php echo $post['title'] ?>" rel="nofollow">
                <div class="likebtn-mlw-title">
                    <?php echo $post['title'] ?>

                    <?php if ($show_date && $post['date']): ?>
                        <span class="likebtn-mlw-date">[<?php echo date_i18n(get_option('date_format'), $post['date']) ?> ]</span>
                    <?php endif ?>

                    <?php if ($show_likes || $show_dislikes): ?>
                        <span class="likebtn-item-likes"><nobr>(
                    <?php endif ?>
                    <?php echo $show_likes ? $post['likes'] : ''; ?>
                    <?php if ($show_likes && $show_dislikes): ?>
                        /
                    <?php endif ?>
                    <?php echo $show_dislikes ? $post['dislikes'] : ''; ?>
                    <?php if ($show_likes || $show_dislikes): ?>
                        )</nobr></span>
                    <?php endif ?>
                </div>
                <?php echo $post['thumbnail_html'] ?>
                <?php if ($show_thumbnail && $post['type'] == LIKEBTN_LIKE_BUTTON_ENTITY_POST): ?>
                    <?php echo get_the_post_thumbnail($post['id'], "thumbnail", array('class' => 'likebtn-item-thumbnail')); ?>
                <?php elseif( 'image/' == substr( $post['post_mime_type'], 0, 6 ) ): ?>
                    <?php echo wp_get_attachment_image( $post['id'], "thumbnail", array('class' => 'likebtn-item-thumbnail') ); ?>
                <?php endif ?>
            </a>
            <?php if ($show_excerpt): ?>
                <div class="likebtn-mlw-excerpt"><?php echo $post['excerpt'] ?></div>
            <?php endif ?>

            <?php if ($show_thumbnail || $show_excerpt): ?>
                <br/>
            <?php endif ?>
		</li>
	<?php endforeach; ?>
	</ul>
<?php else: // No items ?>
	<div class="likebtn-mlw-no-items">
		<p><?php _e('No items liked yet.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></p>
	</div>
<?php
endif;

echo $after_widget; ?>
