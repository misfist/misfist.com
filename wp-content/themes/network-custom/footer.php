			<footer class="footer" role="contentinfo">

				<div id="inner-footer" class="wrap clearfix">

					<nav role="navigation">
						<?php bones_footer_links(); ?>
					</nav>
					<p class="source-org copyright">
						<?php if ( is_active_sidebar( 'copyleft' ) ) { ?>
							<?php dynamic_sidebar( 'copyleft' ); ?>
						<?php } ?>
					</p>

				</div>

			</footer>

		</div>

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>

	</body>

</html>
