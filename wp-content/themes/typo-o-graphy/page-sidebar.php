<?php /**
 * Template Name: Full width
 *  */
?>
<?php get_header(); ?>
<section class="container" id="wrapper">
	<article class="sixteen columns">
		<?php if (have_posts())  : the_post();
		?>
		<div <?php post_class('post') ?>>
			<div class="meta-description">
				<?php if ( is_front_page() ) {
				?>
				<?php the_title('<h2>', '</h2>'); ?>
				<?php } else { ?>
				<?php the_title('<h1>', '</h1>'); ?>
				<?php } ?>
			</div>
			<div class="post-content">
				<?php the_content(__('Continue reading &rarr;', 'typo-o-graphy')); ?>
				<?php wp_link_pages(array('before' => '<div class="page-link">' . __('<span>Pages:</span>', 'typo-o-graphy'), 'after' => '</div>')); ?>
				<?php edit_post_link(__('Edit This', 'typo-o-graphy')); ?>
			</div>
		<?php comments_template(); ?>
		</div>
		<?php endif; ?>
	</article>
</section>
<?php get_footer(); ?>