<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=2.0, user-scalable=yes" />
<title>
<?php wp_title('|',true,'right'); ?>
</title>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="menu-wrap">
  <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'menu' ) ); ?>
  <button class="close-button" id="close-button">Close Menu</button>
</div>
<div id="container">
<div id="header">
  <div id="logo"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
    <?php if (get_theme_mod( 'logo_img' )) : ?>
    <img src="<?php echo esc_url (get_theme_mod( 'logo_img')); ?>">
    <?php else : ?>
    <h1 class="site-title">
      <?php bloginfo('name'); ?>
    </h1>
    <?php endif; ?>
    <div id="site-description">
      <?php bloginfo( 'description' ); ?>
    </div>
    </a> </div>
  <a class="menu-button" id="open-button"></a>
  <div id="mainmenu">
    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'mainnav' ) ); ?>
  </div>
  <div id="socialize">
    <?php if (get_theme_mod( 'googleplus_account' )) : ?>
    <a class="socialicon googleplusicon" href="<?php echo esc_url(get_theme_mod( 'googleplus_account')); ?>" target="blank"></a>
    <?php endif ?>
    <?php if (get_theme_mod( 'instagram_account' )) : ?>
    <a class="socialicon instagramicon" href="<?php echo esc_url(get_theme_mod( 'instagram_account')); ?>" target="blank"></a>
    <?php endif ?>
    <?php if (get_theme_mod( 'tumblr_account' )) : ?>
    <a class="socialicon tumblricon" href="<?php echo esc_url(get_theme_mod( 'tumblr_account')); ?>" target="blank"></a>
    <?php endif ?>
    <?php if (get_theme_mod( 'youtube_account' )) : ?>
    <a class="socialicon youtubeicon" href="<?php echo esc_url(get_theme_mod( 'youtube_account')); ?>" target="blank"></a>
    <?php endif ?>
    <?php if (get_theme_mod( 'vimeo_account' )) : ?>
    <a class="socialicon vimeoicon" href="<?php echo esc_url(get_theme_mod( 'vimeo_account')); ?>" target="blank"></a>
    <?php endif ?>
    <?php if (get_theme_mod( 'flickr_account' )) : ?>
    <a class="socialicon flickricon" href="<?php echo esc_url(get_theme_mod( 'flickr_account')); ?>" target="blank"></a>
    <?php endif ?>
    <?php if (get_theme_mod( 'pinterest_account' )) : ?>
    <a class="socialicon pinteresticon" href="<?php echo esc_url(get_theme_mod( 'pinterest_account')); ?>" target="blank"></a>
    <?php endif ?>
    <?php if (get_theme_mod( 'dribble_account' )) : ?>
    <a class="socialicon dribbleicon" href="<?php echo esc_url(get_theme_mod( 'dribble_account')); ?>" target="blank"></a>
    <?php endif ?>
    <?php if (get_theme_mod( 'linkedin_account' )) : ?>
    <a class="socialicon linkedinicon" href="<?php echo esc_url(get_theme_mod( 'linkedin_account')); ?>" target="blank"></a>
    <?php endif ?>
    <?php if (get_theme_mod( 'facebook_account' )) : ?>
    <a class="socialicon facebookicon" href="<?php echo esc_url(get_theme_mod( 'facebook_account')); ?>" target="blank"></a>
    <?php endif ?>
    <?php if (get_theme_mod( 'twitter_account' )) : ?>
    <a class="socialicon twittericon" href="<?php echo esc_url(get_theme_mod( 'twitter_account')); ?>" target="blank"></a>
    <?php endif ?>
  </div>
</div>
