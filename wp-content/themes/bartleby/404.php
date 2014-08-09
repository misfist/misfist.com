<?php get_header(); ?>
	<div class="row">
	<div class="sixteen columns">
	<div id="404-page">
		<article id="post-0" class="post error404 no-results not-found">
		<header class="entry-header">
		<h1 class="entry-title">
		<?php esc_attr_e( '404 - Oops. Page Not Found', '' ); ?>
		</h1>
		</header>
	<div class="eight columns">
		<p>
		<?php esc_attr_e( 'Hi. Your local 404 error page here.
		Sorry we had to meet. Maybe you can try searching.', '' ); ?>
		</p>
	</div>
	<div class="eight columns">
		<?php get_search_form(); ?>
	</div>
		</article><!-- #post-0 -->
	</div>
	</div>
<?php get_footer(); ?>
