<?php get_header();?>
<section class="container" id="wrapper">
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
	<?php get_sidebar();?>	
	<?php
	if (function_exists('wp_pagenavi')) {
		echo '<div class="sixteen columns">';
		 wp_pagenavi();
		echo '</div>'; 
	} else {  typo_pagination();
	}
	?>
</section>
<?php get_footer();?>
