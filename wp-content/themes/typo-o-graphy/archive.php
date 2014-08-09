<?php get_header(); ?>
<section class="container" id="wrapper">
	<?php if (is_day()) : ?>
	<h1 class="sixteen columns"><?php printf(__('Daily Archives: <span>%s</span>', 'typo-o-graphy'), get_the_date()); ?></h1>
	<?php elseif (is_month()) : ?>
	<h1 class="sixteen columns"><?php	printf(__('Monthly Archives: <span>%s</span>', 'typo-o-graphy'), get_the_date('F Y')); ?></h1>
	<?php elseif (is_year()) : ?>
	<h1 class="sixteen columns"><?php	printf(__('Yearly Archives: <span>%s</span>', 'typo-o-graphy'), get_the_date('Y')); ?></h1>
	<?php elseif (is_category()) : ?>
	<div class="sixteen columns">	
	<h1><?php	printf(__('Categotry Archives: <span>%s</span>', 'typo-o-graphy'), single_cat_title('', false)); ?></h1>
	<?php
		if (category_description())
			echo category_description();
 ?></div>
	<?php elseif (is_tag()) : ?>
	<div class="sixteen columns">
	<h1><?php	printf(__('Tag Archives: <span>%s</span>', 'typo-o-graphy'), single_tag_title('', false)); ?></h1>
    <?php
		if (tag_description())
			echo tag_description();
 ?>	</div>
    <?php elseif ( is_tax() ) : ?>
    <h1 class="sixteen columns"><?php single_term_title(); ?></h1>
	<?php echo term_description('', get_query_var('taxonomy')); ?>
	<?php elseif ( is_author() ) : ?>
		<?php $user_id = get_query_var('author'); ?>
			<div id="author-info" class="vcard sixteen columns">	
				<h1 class="fn n"><?php the_author_meta('display_name', $user_id); ?></h1>								
				<?php 
				if ( get_the_author_meta( 'description', $user_id  ) ) : ?>
				<?php echo get_avatar(get_the_author_meta('user_email', $user_id)); ?>	
				<p>
					<?php the_author_meta('description', $user_id); ?>
				</p>
				<?php endif; ?>
			</div> 
	<?php elseif ( is_post_type_archive() ) : ?>
    <h1 class="sixteen columns"><?php post_type_archive_title(); ?></h1> 	
	<?php elseif ( is_archive() ) : ?>
     <h1 class="sixteen columns"><?php _e('Archives', 'typo-o-graphy'); ?></h1>
    <?php endif; ?>

<div class="eleven columns">
		<?php
		if (have_posts()) :
			while (have_posts()) : the_post();
				get_template_part('loop', get_post_format());
			endwhile;  else :
			    get_template_part('loop', 'none');			
		endif;
		?>
</div> 
	<?php get_sidebar(); ?>
	<?php
	if (function_exists('wp_pagenavi')) {
		echo '<div class="sixteen columns">';
		 wp_pagenavi();
		echo '</div>'; 
	} else {  typo_pagination();
	}
	?>
</section>
<?php get_footer(); ?>
