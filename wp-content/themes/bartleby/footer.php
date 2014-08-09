  <!-- Footer -->
  <?php global $bartleby_options; $bartleby_settings = get_option( 'bartleby_options', $bartleby_options ); ?>
  <footer>
<div class="row">
	<div class="sixteen columns">
	  <hr />
	  <div class="row">
		<div class="seven columns">
		<div id="colophon">
		  <small>&copy; <?php echo date('Y'); ?> - <?php bloginfo('name'); ?></small>
</div>
		</div>
		<div class="nine columns">
<nav id="footermenu" role="navigation"><?php wp_nav_menu( array( 'theme_location' => 'bottom-menu' ) ); ?></nav>
		</div>
	  </div>
	</div>
</div>
<?php if( $bartleby_settings['footer_link']) : ?>
<div class="row">
<div id="credit" class="sixteen columns">
<a href="http://www.edwardrjenkins.com/" rel="nofollow">
<?php esc_attr_e( 'Bartleby Theme by Edward R. Jenkins' , 'bartleby' ); ?>
</a>
</div>
</div>
<?php else: ?>
<div class="row">
<div id="credit" class="sixteen columns">
<?php esc_attr_e( 'Bartleby Theme by Edward R. Jenkins' , 'bartleby' ); ?>
</div>
</div>
<?php endif; ?>
</footer>
<?php wp_footer(); ?>
</body>
</html>
