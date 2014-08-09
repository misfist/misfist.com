<div class="<?php echo get_class_of_component('menu', smartadapt_option( 'smartadapt_layout' )) ?>">
<nav id="site-navigation" class="main-navigation hide-for-small" role="navigation">

<a class="assistive-text" href="#content"
		title="<?php esc_attr_e( 'Skip to content', 'smartadapt' ); ?>"><?php _e( 'Skip to content', 'smartadapt' ); ?></a>
	<?php
	//fixed menu option
	$fixed = smartadapt_option( 'smartadapt_menu_fixed' );
?>
<div class="nav-menu tabs vertical<?php echo $fixed=='1'? ' fixed-menu':'' ?>">
	<?php wp_nav_menu( array( 'theme_location' => 'categories', 'container' => false ) ); ?>
</div>
</nav>

<!-- #site-navigation -->
</div>