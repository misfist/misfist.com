<?php get_header();?>
<section class="container" id="wrapper">
	<nav class="wp-pagenavi sixteen columns">
		<div class="alignleft">
			<?php previous_post_link();?>
		</div>
		<div class="alignright">
			<?php next_post_link();?>
		</div>
	</nav>
	<?php get_template_part('content', get_post_format());?>
</section>
<?php get_footer();?>