<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class( 'basic' ); ?>>

	<div id="page" class="grid wfull">

		<div id="mobile-menu" class="clearfix">
			<a class="left-menu" href="#"><i class="icon-reorder"></i></a>
			<a class="mobile-title" href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			<a class="mobile-search" href="#"><i class="icon-search"></i></a>
		</div>
		<div id="drop-down-search"><?php get_search_form(); ?></div>

		<div id="main" class="row">

			<div id="secondary" role="complementary">

				<header id="header" role="banner">

					<div class="header-wrap">
						<h1 id="site-title"><a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
					</div>

					<?php
					if ( $header_image = get_header_image() ) :
						?>
						<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img id="header-img" src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" /></a>
						<?php
					endif;
					?>

					<nav id="site-navigation" role="navigation">
						<h3 class="screen-reader-text"><?php _e( 'Main menu', 'carton' ); ?></h3>
						<a class="screen-reader-text" href="#primary" title="<?php esc_attr_e( 'Skip to content', 'carton' ); ?>"><?php _e( 'Skip to content', 'carton' ); ?></a>
						<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
					</nav><!-- #site-navigation -->

				</header><!-- #header -->

				<?php get_sidebar(); ?>

			</div><!-- #secondary.widget-area -->