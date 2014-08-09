<?php /**
 * Template Name: Home Template - Blog
 *  */
?>
<?php get_header(); ?>
<div class="container" id="masonry_container">
		<?php
global $more;
$more = 0;	
	
$gallery_not = array(
'paged' =>   get_query_var( 'page' ),$query_string . '&order=ASC'
);
query_posts($gallery_not);
if ( have_posts() ) : while (have_posts()) : the_post();
		?>
<article <?php post_class('post four columns masonry_box masonry_box_mobile') ?>>
	<?php
	if (has_post_thumbnail()) {
		the_post_thumbnail('medium');
	}
 ?>
<header class="meta-description">
<?php
if (comments_open()) :
	echo '<p>';
	comments_popup_link(__('No comments yet', 'typo-o-graphy'), __('1 comment', 'typo-o-graphy'), __('% comments', 'typo-o-graphy'), 'comments-link', __('Comments are off for this post', 'typo-o-graphy'));
	echo '</p>';
endif;
?>	
<h3><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(sprintf(__('Permanent Link to %s', 'typo-o-graphy'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
	<?php typo_posted_on(); ?>
</header>
<div class="post-content">
	<?php
	if (has_post_format('video') || has_post_format('aside') || has_post_format('quote') || has_post_format('audio') || has_post_format('link') || has_post_format('chat')) :
		the_content();
	else :
		the_excerpt();
	endif;
 ?>
<?php wp_link_pages(array('before' => '<div class="page-link">' . __('<span>Pages:</span>', 'typo-o-graphy'), 'after' => '</div>')); ?>
</div>
</article>
		<?php endwhile; endif; ?>

</div>				

          <div class="container"><?php
    if (function_exists('wp_pagenavi')) {
        echo '<div class="sixteen columns">';
         wp_pagenavi();
        echo '</div>'; 
    } else {  typo_pagination();
    }
    ?></div>
<?php get_footer(); ?>