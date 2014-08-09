<?php
function typo_custom_register($wp_customize){
    //  =============================
    //  = Color Link              =
    //  =============================
    $wp_customize->add_setting('typo_options[link_color]', array(
        'default'           => '#a90000',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_color', array(
        'label'    => __('Link Color', 'typo-o-graphy'),
        'section' => 'colors',
        'settings' => 'typo_options[link_color]'
    )));
    //  =============================
    //  = Logo            =
    //  =============================
    $wp_customize->add_setting('typo_options[link_logo]', array(
        'capability'        => 'edit_theme_options',
        'type'           => 'option'
    ));
    
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'link_logo', array(
        'label' => __('Logo', 'typo-o-graphy'),
        'section' => 'header_image',
        'settings' => 'typo_options[link_logo]'
    )));
    //  =============================
    //  = Header position            =
    //  =============================
    $wp_customize->add_setting('typo_options[header_position]', array(
        'capability'        => 'edit_theme_options',
        'default'        => 'Normal',
        'type'           => 'option'        
    ));
}
add_action('customize_register', 'typo_custom_register');
/**************************************************************************************************/
function typo_fonts_register($wp_customize){ 
    $wp_customize->add_section('typo_scheme', array(
        'title'    => __('Fonts', 'typo-o-graphy'),
        'priority' => 125,
    ));

    //  =============================
    //  = text font               =
    //  =============================
     $wp_customize->add_setting('typo_options[text_font]', array(
        'default'        => 'Georgia',
        'capability'     => 'edit_theme_options',
        'type'           => 'option'
    ));
    $wp_customize->add_control( 'txt_font', array(
        'settings' => 'typo_options[text_font]',
        'label'   =>  __('Select Text Font:', 'typo-o-graphy'),
        'section' => 'typo_scheme',
        'type'    => 'select',
		'choices' => array(
		'Times New Roman' => 'Times New Roman', 
		"Cambria" => "Cambria", 
		"Palatino Linotype" => "Palatino Linotype", 
		"Georgia" => "Georgia", 
		"Helvetica, Arial" => "Helvetica, Arial", 
		"Verdana" => "Verdana" 
		)	
    ));
    //  =============================
    //  = header font                =
    //  =============================
     $wp_customize->add_setting('typo_options[header_font]', array(
        'default'        => 'Georgia',
        'capability'     => 'edit_theme_options',
        'type'           => 'option'
    ));
    $wp_customize->add_control( 'header_font', array(
        'settings' => 'typo_options[header_font]',
        'label'   =>  __('Select Header Font:', 'typo-o-graphy'),
        'section' => 'typo_scheme',
        'type'    => 'select',
        'choices'    =>  array(
    'Times New Roman' => 'Times New Roman',
    'Cambria' => 'Cambria',
    'Palatino Linotype' => 'Palatino Linotype',
    'Georgia' => 'Georgia',
    'Helvetica, Arial' => 'Helvetica, Arial',
    'Verdana' => 'Verdana',
    'Open Sans' => 'Open Sans (Latin Extended, Cyrillic, Greek, Vietnamese)',
    'Droid Sans' => 'Droid Sans',
    'Droid Serif' => 'Droid Serif',
    'Oswald' => 'Oswald (Latin Extended)',
    'Ubuntu' => 'Ubuntu (Latin Extended, Cyrillic, Greek)',
    'PT Sans' => 'PT Sans (Latin Extended, Cyrillic)',
    'PT Serif' => 'PT Serif (Cyrillic)',
    'Arvo' => 'Arvo',
    'Lato' => 'Lato',
    'Source Sans Pro' => 'Source Sans Pro (Latin Extended)',
    'Signika' => 'Signika (Latin Extended)',
    'Vollkorn' => 'Vollkorn',
    'Old Standard TT' => 'Old Standard TT',
    'Cutive' => 'Cutive (Latin Extended)',
    'Amaranth' => 'Amaranth',
    'Merriweather' => 'Merriweather',
    'Abril Fatface' => 'Abril Fatface (Latin Extended)',
    'Sansita One' => 'Sansita One'
    )
    ));
    //  =============================
    //  = Select a language                =
    //  =============================
     $wp_customize->add_setting('typo_options[header_ext]', array(
        'default'        => 'Latin',
        'capability'     => 'edit_theme_options',
        'type'           => 'option'
    ));
    $wp_customize->add_control( 'header_ext', array(
        'settings' => 'typo_options[header_ext]',
        'label'   =>  __('Add language:', 'typo-o-graphy'),
        'section' => 'typo_scheme',
        'type'    => 'radio',
        'choices'    =>  array(
    'Latin' => 'Latin',
    'Cyrillic' => 'Cyrillic',
    'Greek' => 'Greek',
    'Vietnamese' => 'Vietnamese'
    )
    ));
}
add_action('customize_register', 'typo_fonts_register');
/**************************************************************************************************/
function typo_layout_register($wp_customize){
    
    $wp_customize->add_section('typo_layout', array(
        'title'    => __('Layout', 'typo-o-graphy'),
        'priority' => 123,
    ));
    //  =============================
    //  = color schema             =
    //  =============================
     $wp_customize->add_setting('typo_options[layout_color]', array(
        'default'        => 'Light',
        'capability'     => 'edit_theme_options',
        'type'           => 'option'
    ));
    $wp_customize->add_control( 'layout', array(
        'settings' => 'typo_options[layout_color]',
        'label'   =>  __('Select Color Scheme:', 'typo-o-graphy'),
        'section' => 'typo_layout',
        'type'    => 'radio',
		'choices' => array( "Light" => "Light", "Dark" => "Dark" ) 		
    ));
    //  =============================
    //  = lightbox            =
    //  =============================
     $wp_customize->add_setting('typo_options[layout_lightbox]', array(
        'default'        => 'example1',
        'capability'     => 'edit_theme_options',
        'type'           => 'option'
    ));
    $wp_customize->add_control( 'layout_lightbox', array(
        'settings' => 'typo_options[layout_lightbox]',
        'label'   =>  __('Select Lightbox Theme:', 'typo-o-graphy'),
        'section' => 'typo_layout',
        'type'    => 'radio',
		'choices' => array( 
		"disabled" => "Disabled", 
		"example1" => "Example 1", 
		"example2" => "Example 2", 
		"example3" => "Example 3", 
		"example4" => "Example 4", 
		"example5" => "Example 5" 
		) 		
    ));

}
add_action('customize_register', 'typo_layout_register');
/**************************************************************************************************/	
/**************************************************************************************************/
if ( ! function_exists( 'typo_header' ) ) :
function typo_header(){
$options = get_option('typo_options');
$header_logo = $options['link_logo'];

$typo_heading_tag = (is_home() || is_front_page()) ? 'h1' : 'h2';
?>
<?php if ( is_active_sidebar( 'header-widget-area' ) ) : ?><div class="eleven columns headerimg">
<?php else : ?><div class="sixteen columns headerimg"><?php endif; ?>
<?php if ($header_logo ) :
?>
<<?php echo $typo_heading_tag; ?>>
<a  href="<?php echo site_url(); ?>">
<img src="<?php echo esc_url($header_logo); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" />
</a>
</<?php	echo $typo_heading_tag; ?>>
<?php else : ?>
<<?php echo $typo_heading_tag; ?>>
<a href="<?php echo site_url(); ?>"><?php bloginfo('name'); ?></a>
</<?php echo $typo_heading_tag; ?>>
<?php endif; ?>
<?php $site_description = get_bloginfo( 'description' ); if ( $site_description ) {
?>
<h3 id="header-desc"><?php echo $site_description; ?></h3>
<?php } ?>
</div>
<?php
}
endif;
/**************************************************************************************************/
/**********
* @note: credit goes to TwentyTwelve theme.***********/
function typo_g_fonts() {
$options = get_option('typo_options');
$header_font = $options['header_font' ];
$header_ext = $options['header_ext' ];

if ( $header_ext !== _x( 'on', 'Font: on or off', 'typo-o-graphy' ) ) {
        
        if ( 'Latin' == $header_ext )
        $subsets = 'latin,latin-ext';
        elseif ( 'Cyrillic' == $header_ext )
            $subsets = 'latin,cyrillic,cyrillic-ext';
        elseif ( 'Greek' == $header_ext )
            $subsets = 'latin,greek,greek-ext';
        elseif ( 'Vietnamese' == $header_ext )
            $subsets = 'latin,vietnamese';

        $protocol = is_ssl() ? 'https' : 'http';

switch ($header_font) {
case 'Open Sans':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Open+Sans:400,400italic,700', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Droid Sans':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Droid+Sans:400,700', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Droid Serif':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Droid+Serif:400,700', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Oswald':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Oswald:400,700', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Ubuntu':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Ubuntu:400,700', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'PT Sans':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'PT+Sans', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'PT Serif':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'PT+Serif', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Arvo':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Arvo', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Lato':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Lato:400,700', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Source Sans Pro':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Source+Sans+Pro:400,700', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Signika':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Signika', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Vollkorn':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Volkhov:400,400italic', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Old Standard TT':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Old+Standard+TT:400,400italic', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Cutive':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Cutive', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Amaranth':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Amaranth', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Merriweather':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Merriweather', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Abril Fatface':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Abril+Fatface', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Sansita One':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Sansita+One', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
    }
}
}
add_action( 'wp_enqueue_scripts', 'typo_g_fonts' );
/**************************************************************************************************/
/**************************************************************************************************/
function typo_wp_head() {
    $options = get_option('typo_options');
    $color_link = $options['link_color'];
    $header_position = $options['header_position'];
    
    echo '<style>'; 
    if ( $color_link ) echo 'a { color: ' . $color_link . ' }';
    echo '</style>';
}
add_action('wp_head', 'typo_wp_head');
 /**************************************************************************************************/
    function typo_body_classes($classes) {
        $options = get_option('typo_options');
        $txt_font = $options['text_font'];
        $header_logo = $options['link_logo'];
        $header_font = $options['header_font'];
        
    if ($header_logo ) :
        $classes[] = 'logo';
    endif;
    
        switch ($txt_font) {
            case 'Times New Roman' :
                $classes[] = 'times-txt';
                break;
            case 'Palatino Linotype' :
                $classes[] = 'palatino-txt';
                break;
            case 'Verdana' :
                $classes[] = 'verdana-txt';
                break;
            case 'Helvetica, Arial' :
                $classes[] = 'helvetica-txt';
                break;
            case 'Cambria' :
                $classes[] = 'cambria-txt';
                break;
        }
   

        switch ($header_font) {
            case 'Times New Roman' :
                $classes[] = 'times-header';
                break;
            case 'Palatino Linotype' :
                $classes[] = 'palatino-header';
                break;
            case 'Verdana' :
                $classes[] = 'verdana-header';
                break;
            case 'Helvetica, Arial' :
                $classes[] = 'helvetica-header';
                break;
            case 'Cambria' :
                $classes[] = 'cambria-header';
                break;
            case 'Open Sans' :
                $classes[] = 'open-header';
                break;
            case 'Droid Sans' :
                $classes[] = 'droid-sans-header';
                break;
            case 'Droid Serif' :
                $classes[] = 'droid-serif-header';
                break;
            case 'Oswald' :
                $classes[] = 'oswald-header';
                break;
            case 'Ubuntu' :
                $classes[] = 'ubuntu-header';
                break;
            case 'PT Sans' :
                $classes[] = 'pt-sans-header';
                break;
            case 'PT Serif' :
                $classes[] = 'pt-serif-header';
                break;
            case 'Lato' :
                $classes[] = 'lato-header';
                break;
            case 'Source Sans Pro' :
                $classes[] = 'source-header';
                break;
            case 'Signika' :
                $classes[] = 'signika-header';
                break;
            case 'Arvo' :
                $classes[] = 'arvo-header';
                break;
            case 'Vollkorn' :
                $classes[] = 'vollkorn-header';
                break;
            case 'Old Standard TT' :
                $classes[] = 'old-header';
                break;
            case 'Cutive' :
                $classes[] = 'cutive-header';
                break;               
            case 'Amaranth' :
                $classes[] = 'amaranth-header';
                break;
            case 'Merriweather' :
                $classes[] = 'merriweather-header';
                break;             
            case 'Abril Fatface' :
                $classes[] = 'abril-header';
                break;
            case 'Sansita One' :
                $classes[] = 'sansita-header';
                break;               
        }
        return $classes;
    }

    add_filter('body_class', 'typo_body_classes'); 
    
/*********************/    
?>