<div id="sidebar-one">

	<?php if ( ! dynamic_sidebar( 'sidebar' ) ) : ?>

		<?php if ( current_user_can( 'edit_theme_options' ) ) { ?>
			<div class="alert"><?php printf( __( 'Add your own widgets by going to the %sWidgets admin page%s.', 'carton' ), '<a href="' . admin_url( 'widgets.php' ) . '">', '</a>' ); ?></div>
		<?php } ?>

		<aside id="meta" class="widget">
			<h3 class="widget-title"><?php _e( 'Meta', 'carton' ); ?></h3>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<?php wp_meta(); ?>
			</ul>
		</aside>

		<aside id="archives" class="widget">
			<h3 class="widget-title"><?php _e( 'Archives', 'carton' ); ?></h3>
			<ul>
				<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
			</ul>
		</aside>

	<?php endif; ?>

</div><!-- #sidebar-one -->