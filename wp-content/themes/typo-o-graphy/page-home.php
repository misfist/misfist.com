<?php /**
 * Template Name: Home Template - Featured, Blog, About
 *  */
?>
<?php get_header(); ?>

<?php $sticky = get_option('sticky_posts');
 if($sticky) : ?>						
<div class="container" id="wrapper">						
<div class="sixteen columns">
<div id="container">
<div class="flexslider">
	<ul class="slides">					

<?php  
$args = array(
	'posts_per_page' => -1,
	'post__in'  => get_option( 'sticky_posts' ),
	'ignore_sticky_posts' => 1
);
$the_query = new WP_Query( $args );
while ( $the_query->have_posts() ) : $the_query->the_post();
						?>
					<li>	
			<?php 
if ( has_post_thumbnail()): ?>
								<h2><a href="<?php	the_permalink(); ?>" title="<?php	echo esc_attr(sprintf(__('Permanent Link to %s', 'typo-o-graphy'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php	the_title(); ?></a></h2>

<div class="eleven columns "><?php the_post_thumbnail('typo_single_post'); ?></div>
						<div class="four columns">
								<?php the_excerpt(); ?>		
						</div>
							<?php else : ?>
						<div class="eight columns offset-by-four no-image">
							<h2><a  href="<?php	the_permalink(); ?>" title="<?php	echo esc_attr(sprintf(__('Permanent Link to %s', 'typo-o-graphy'), the_title_attribute('echo=0'))); ?>" > 
								<?php the_title(); ?></a></h2>							 						    
							    <?php
								if (has_post_format('video') || has_post_format('aside') || has_post_format('quote') || has_post_format('audio')|| has_post_format('link')|| has_post_format('chat')) :
									the_content();
								else :
									the_excerpt();
								endif;
 ?>
 	<?php wp_link_pages(array('before' => '<div class="page-link">' . __('<span>Pages:</span>', 'typo-o-graphy'), 'after' => '</div>')); ?>
						</div>
							<?php endif; ?>
					</li>
<?php endwhile; ?>
					</ul>
	
			</div>
		</div>
	</div>
</div>
<?php wp_reset_postdata(); ?>	
<?php endif; ?>	

<div class="container" id="masonry_container">
		<?php
global $more;
$more = 0;		
$sticky = get_option( 'sticky_posts' );
$args=array(
'paged' =>   get_query_var( 'page' ),
'post__not_in' => $sticky
);
query_posts($args);
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
	<?php if (has_post_format('status'))  echo get_avatar( get_the_author_meta('ID') ); 
	if (has_post_format('video') || has_post_format('aside') || has_post_format('quote')) :
		the_content();
	else :
		the_excerpt();
	endif;
 ?>
</div>
</article>
		<?php endwhile; endif; ?>
</div>				

	<?php
	if (function_exists('wp_pagenavi')) {
		echo '<div class="container">';
		wp_pagenavi();
		echo '</div>';
	} else { echo '<div class="container">';
		typo_pagination();
		echo '</div>';
	}
	?>
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