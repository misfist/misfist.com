<aside class="five columns sidebar">
	<?php	if ( is_active_sidebar( 'sidebar-widget-area' ) ) {
	?>
	<ul class="widget">
		<?php dynamic_sidebar('sidebar-widget-area');?>
	</ul>
	<?php } else {?>
	<ul class="widget">
		<li>
			<h3 class="widget-title"><?php _e('Categories', 'typo-o-graphy');?></h3>
			<ul>
				<?php wp_list_categories('show_count=0&title_li=&depth=0&show_last_update=1&use_desc_for_title=1');?>
			</ul>
		</li>
	</ul>
	<?php }?>
</aside>
