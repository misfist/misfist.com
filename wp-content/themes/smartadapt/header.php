<!DOCTYPE html>
<!--[if lt IE 9]>
<html class="ie lt-ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php

    wp_head();
    ?>
</head>

<body <?php body_class(); ?>>
<?php smartadapt_lt_ie7_info(); //display info if IE lower than 7  ?>
<div class="top-bar-outer">
	<?php
	//fixed top bar option
	$fixed = smartadapt_option( 'smartadapt_fixed_topbar' );
	?>

<div id="top-bar" class="top-bar home-border<?php echo $fixed=='1'? ' fixed-top-bar':'' ?>">

	<div class="row">
		<div class="columns four mobile-one">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
				 title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
				 rel="home"
				 class="site-logo <?php echo ( strlen( smartadapt_option( 'smartadapt_logo' ) ) > 0 ) ? 'image-logo' : ''; ?>">
				<?php
				if ( strlen( smartadapt_option( 'smartadapt_logo' ) ) > 0 ) {
					?>
					<img src="<?php echo smartadapt_option( 'smartadapt_logo' ); ?>"
							 alt="<?php echo bloginfo( 'name' ); ?>" />
					<?php
				}
				else {
					bloginfo( 'name' );
				}
				?></a></div>


		<div class="columns twelve mobile-three">
			<!--falayout search menu-->
			<?php smartadapt_searchmenu(); //display search menu ?>

			<nav id="top-navigation" class="right hide-for-small">
				<?php wp_nav_menu( array( 'theme_location' => 'top_pages', 'menu_class' => 'top-menu' ) ); ?>
			</nav>

		</div>
	</div>
	<div class="row">
		<div class="columns sixteen toggle-area" id="toggle-search">
			<?php smartadapt_searchform(); //display toggle form search  ?>
		</div>

	</div>
</div>
</div>
<div id="wrapper" class="row">

	<?php
//if sidebar is one the left side
		if(check_position_of_component('sidebar', 'left', smartadapt_option( 'smartadapt_layout' )))
			get_sidebar();

	?>
	<div id="page" role="main" class="<?php echo get_class_of_component('page', smartadapt_option( 'smartadapt_layout' )) ?>">
		<?php
		smartadapt_header(); //display header info or header image


		?>
		<div id="main" class="row">
			<nav id="mobile-navigation" class="columns sixteen show-for-small" role="navigation">
				<?php


			//if layout has vertical menu
				if(smartadapt_option( 'smartadapt_layout' )!=3){
				//display mobile menu
				smartadapt_wp_nav_menu_select(
					array(
						'theme_location' => 'categories'
					)
				);
			}
				?>

			</nav>
<?php
//if menu is one the left side
			if(check_position_of_component('menu', 'left', smartadapt_option( 'smartadapt_layout' ))){
				get_template_part('section', 'menu');
}
?>
           



