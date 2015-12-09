<?php get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'pin' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'pin' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'pin' ) ) . '</span>' );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'pin' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'pin' ) ) . '</span>' );
					else :
						echo "Archive : ";single_cat_title();
					endif;
				?></h1>
			</header><!-- .archive-header -->
<div id="col" style="width:100%;" class="column">
			<?php while ( have_posts() ) : the_post();get_template_part( 'content', get_post_format() );

			endwhile;?></div>
<?php pin_arc_nav( 'nav-below' );?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->
<script type="text/javascript">
jQuery( document ).ready( function( $ ) {
	$( '#col' ).masonry( { singleMode: true } );
} );
</script>

<?php get_footer(); ?>