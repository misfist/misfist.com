<!DOCTYPE html>
<html <?php	language_attributes(); ?>>
	<head>
		<meta charset=<?php bloginfo('charset'); ?>" />
		<title><?php wp_title('|', true, 'right'); ?></title>	
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
<?php  wp_nav_menu(array('Secondary Navigation', 'theme_location' => 'secondary', 'container_class' => 'menu-secondary', 'menu_class' => 'container', 'fallback_cb' => false, 'depth' => 3)); ?>		
		<header id="header">
			<div class="container">	
<?php if ( function_exists( 'typo_header' ) )  typo_header(); ?>									
						<?php if ( is_active_sidebar( 'header-widget-area' )) :
						?>
						<div class="five columns">
							<ul class="widget">
								<?php dynamic_sidebar('header-widget-area'); ?>
							</ul>
						</div>
						<?php  endif ?>
					</div>
				</header>
<?php  wp_nav_menu(array('sort_column' => 'menu_order', 'Primary Navigation', 'theme_location' => 'primary', 'container' => 'nav','container_id' => 'nav', 'menu_class' => 'container', 'fallback_cb' => false)); ?>		