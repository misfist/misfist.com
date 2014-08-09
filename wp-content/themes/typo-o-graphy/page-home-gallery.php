<?php /**
 * Template Name: Home Template - Blog, Gallery, About
 *  */
?>
<?php get_header(); ?>
<div class="container" id="masonry_container">
		<?php
global $more;
$more = 0;		
$gallery_not = array(
'paged' =>   get_query_var( 'page' ), 
'post__not_in'  => array('taxonomy' => 'post_format','terms' => array( 'post-format-gallery', 'post-format-image'),'field' => 'slug')
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
		<?php endwhile; endif; wp_reset_postdata(); ?>
</div>				

<div id="home_gallery">	
<h2><?php _e('Gallery', 'typo-o-graphy'); ?></h2>								
<ul class="container">	
<?php  
$gallery_query = array('posts_per_page' => 30,'tax_query' => array(array('taxonomy' => 'post_format','terms' => array( 'post-format-gallery', 'post-format-image'),'field' => 'slug')));
$the_query = new WP_Query( $gallery_query );
while ( $the_query->have_posts() ) : $the_query->the_post();
						?>
<li <?php post_class('three columns omega') ?>>
<?php if ( has_post_thumbnail()): ?>     
    <?php  the_post_thumbnail('thumbnail'); 
       else :
        $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image' ) );
        if ( $images ) :
        $total_images = count( $images );
        $image = array_shift( $images );
        $image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
    ?>
    <?php echo $image_img_tag;?>
<?php endif; ?>    
    <?php  endif;?>
<div class="cover">
<h3><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(sprintf(__('Permanent Link to %s', 'typo-o-graphy'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
</div>					 						    
</li>
<?php endwhile; ?>
</ul>
</div>

<?php  wp_reset_query(); ?>

<?php 
$content_home = get_the_content();
if ($content_home) {
if( have_posts() ): the_post();
		?>	
<div id="footerhome">
<div class="container">
<div class="sixteen columns">	
<?php 
	if (has_post_thumbnail()) {
		the_post_thumbnail('typo_single_post');
	}
	?>
</div>
<div class="eight columns offset-by-four">
 <?php the_content(); ?>
</div>
</div>
</div>

<?php endif; } ?>
<?php get_footer(); ?>