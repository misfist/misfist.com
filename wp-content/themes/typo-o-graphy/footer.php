<div id="footer">
	<div class="container">
		<?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) :
		?>
		<div class="eight columns">
			<ul class="widget">
				<?php dynamic_sidebar('first-footer-widget-area');?>
			</ul>
		</div>
		<?php  endif?>
		<?php	if ( is_active_sidebar( 'third-footer-widget-area' ) ) :
		?>
		<div class="eight columns">
			<ul class="widget">
				<?php dynamic_sidebar('third-footer-widget-area');?>
			</ul>
		</div>
		<?php  endif?>
		<?php  wp_nav_menu(array('Footer Navigation', 'theme_location' => 'footer', 'container' => false, 'menu_id' => 'menufooter', 'menu_class' => 'twelve columns menufooter', 'fallback_cb' => 'typo_footer_menu', 'depth' => 1)); ?>
		
			<div id="author-website" class="four columns menufooter">
				<?php _e('Theme design by', 'typo-o-graphy');?> <?php if (is_home() || is_front_page()) {
				?><a href="<?php echo esc_url('http://blankcanvas.eu/');?>">Blank Canvas</a><?php } else {?>Blank Canvas<?php }?>
			</div>
	</div>
</div>
<?php wp_footer();?>
</body>
</html>