<?php
/**
 * @package WordPress
 * @subpackage Chunk
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="initial-scale=1">

	<title><?php wp_title(); ?> <?php bloginfo( 'name' ); ?></title>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );

		wp_head();
	?>
</head>
<body <?php body_class(); ?>>

<div id="container">
	<script>
		jQuery(function(){
		 var shrinkHeader = 300;
		  jQuery(window).scroll(function() {
		    var scroll = getCurrentScroll();
		      if ( scroll >= shrinkHeader ) {
		           jQuery('.header').addClass('shrink');
		        }
		        else {
		            jQuery('.header').removeClass('shrink');
		        }
		  });
		function getCurrentScroll() {
		    return window.pageYOffset;
		    }
		});
	</script>
	<header id="header" class="header">
		<div class="wrap">
			<div class="social-links">
				<a target="_blank" href="http://www.linkedin.com/in/patricialutz"><i class="fa fa-linkedin-square"></i></a>
				<a onclick="window.print(); return false;" rel="nofollow" href="http://www.printfriendly.com/print?url=http%3A%2F%2Fpatricia-lutz.com%2F"><i class="fa fa-print"></i></a>
			</div>
			<h1 id="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div>
	</header>

	<div id="menu">
		<?php
			// Do we have a header image around?
			if ( '' != get_header_image() ) :
		?>
		<div id="header-image">
			<a href="<?php echo home_url( '/' ); ?>">
				<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
			</a>
		</div>
		<?php endif; ?>
		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
	</div>
	<?php if(function_exists('pf_show_link')){echo pf_show_link();} ?>
