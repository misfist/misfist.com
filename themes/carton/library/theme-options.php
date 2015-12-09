<?php
/**
 * Set up the default theme options
 *
 * @since 1.0.0
 */
function bavotasan_theme_options() {
	//delete_option( 'carton_theme_options' );
	$default_theme_options = array(
		'column_width' => '320',
		'sidebar_width' => '250',
		'display_author' => 'on',
		'display_date' => 'on',
		'display_comment_count' => 'on',
		'display_categories' => 'on',
	);

	return get_option( 'carton_theme_options', $default_theme_options );
}

class Bavotasan_Customizer {
	public function __construct() {
		add_action( 'admin_bar_menu', array( $this, 'admin_bar_menu' ), 1000 );
		add_action( 'customize_register', array( $this, 'customize_register' ) );
	}

	/**
	 * Add a 'customize' menu item to the admin bar
	 *
	 * This function is attached to the 'admin_bar_menu' action hook.
	 *
	 * @since 1.0.0
	 */
	public function admin_bar_menu( $wp_admin_bar ) {
	    if ( current_user_can( 'edit_theme_options' ) && is_admin_bar_showing() ) {
	    	$wp_admin_bar->add_node( array( 'parent' => 'bavotasan_toolbar', 'id' => 'customize_theme', 'title' => __( 'Theme Options', 'carton' ), 'href' => esc_url( admin_url( 'customize.php' ) ) ) );
			$wp_admin_bar->add_node( array( 'parent' => 'bavotasan_toolbar', 'id' => 'documentation_faqs', 'title' => __( 'Documentation & FAQs', 'carton' ), 'href' => 'https://themes.bavotasan.com/documentation', 'meta' => array( 'target' => '_blank' ) ) );
		}
	}

	/**
	 * Adds theme options to the Customizer screen
	 *
	 * This function is attached to the 'customize_register' action hook.
	 *
	 * @param	class $wp_customize
	 *
	 * @since 1.0.0
	 */
	public function customize_register( $wp_customize ) {
		$bavotasan_theme_options = bavotasan_theme_options();

		// Layout section panel
		$wp_customize->add_section( 'carton_layout', array(
			'title' => __( 'Layout', 'carton' ),
			'priority' => 35,
		) );

		$wp_customize->add_setting( 'carton_theme_options[column_width]', array(
			'default' => $bavotasan_theme_options['column_width'],
			'type' => 'option',
			'capability' => 'edit_theme_options',
		) );

		$wp_customize->add_control( 'carton_column_width', array(
			'label' => __( 'Column Width (px)', 'carton' ),
			'section' => 'carton_layout',
			'settings' => 'carton_theme_options[column_width]',
			'type' => 'text',
		) );

		$wp_customize->add_setting( 'carton_theme_options[sidebar_width]', array(
			'default' => $bavotasan_theme_options['sidebar_width'],
			'type' => 'option',
			'capability' => 'edit_theme_options',
		) );

		$wp_customize->add_control( 'carton_sidebar_width', array(
			'label' => __( 'Sidebar Width (px)', 'carton' ),
			'section' => 'carton_layout',
			'settings' => 'carton_theme_options[sidebar_width]',
			'type' => 'text',
		) );

		// Posts panel
		$wp_customize->add_section( 'bavotasan_posts', array(
			'title' => __( 'Posts', 'carton' ),
			'priority' => 40,
		) );


		$wp_customize->add_setting( 'carton_theme_options[display_categories]', array(
			'default' => $bavotasan_theme_options['display_categories'],
			'type' => 'option',
			'capability' => 'edit_theme_options',
		) );

		$wp_customize->add_control( 'carton_display_categories', array(
			'label' => __( 'Display Categories', 'carton' ),
			'section' => 'bavotasan_posts',
			'settings' => 'carton_theme_options[display_categories]',
			'type' => 'checkbox',
		) );

		$wp_customize->add_setting( 'carton_theme_options[display_author]', array(
			'default' => $bavotasan_theme_options['display_author'],
			'type' => 'option',
			'capability' => 'edit_theme_options',
		) );

		$wp_customize->add_control( 'carton_display_author', array(
			'label' => __( 'Display Author', 'carton' ),
			'section' => 'bavotasan_posts',
			'settings' => 'carton_theme_options[display_author]',
			'type' => 'checkbox',
		) );

		$wp_customize->add_setting( 'carton_theme_options[display_date]', array(
			'default' => $bavotasan_theme_options['display_date'],
			'type' => 'option',
			'capability' => 'edit_theme_options',
		) );

		$wp_customize->add_control( 'carton_display_date', array(
			'label' => __( 'Display Date', 'carton' ),
			'section' => 'bavotasan_posts',
			'settings' => 'carton_theme_options[display_date]',
			'type' => 'checkbox',
		) );

		$wp_customize->add_setting( 'carton_theme_options[display_comment_count]', array(
			'default' => $bavotasan_theme_options['display_comment_count'],
			'type' => 'option',
			'capability' => 'edit_theme_options',
		) );

		$wp_customize->add_control( 'carton_display_comment_count', array(
			'label' => __( 'Display Comment Count', 'carton' ),
			'section' => 'bavotasan_posts',
			'settings' => 'carton_theme_options[display_comment_count]',
			'type' => 'checkbox',
		) );
	}
}
$bavotasan_customizer = new Bavotasan_Customizer;

/**
 * Prepare font CSS
 *
 * @param	string $font  The select font
 *
 * @since 1.0.0
 */
function bavotasan_prepare_font( $font ) {
	$font_family = ( 'Lato Light, sans-serif' == $font ) ? 'Lato' : $font;
	$font_family = ( 'Arvo Bold, serif' == $font ) ? 'Arvo' : $font_family;
	$font_weight = ( 'Lato Light, sans-serif' == $font ) ? 'font-weight: 300' : 'font-weight: normal';
	$font_weight = ( 'Lato, sans-serif' == $font ) ? 'font-weight: 400' : $font_weight;
	$font_weight = ( 'Lato Bold, sans-serif' == $font || 'Arvo Bold, serif' == $font ) ? 'font-weight: 900' : $font_weight;

	return 'font-family: ' . $font_family . '; ' . $font_weight;
}

if ( ! function_exists( 'bavotasan_websafe_fonts' ) ) :
/**
 * Array of websafe fonts
 *
 * @return	Array of fonts
 *
 * @since 1.0.0
 */
function bavotasan_websafe_fonts() {
    return array(
        'Arial, sans-serif' => 'Arial',
        '"Avant Garde", sans-serif' => 'Avant Garde',
        'Cambria, Georgia, serif' => 'Cambria',
        'Copse, sans-serif' => 'Copse',
        'Garamond, "Hoefler Text", Times New Roman, Times, serif' => 'Garamond',
        'Georgia, serif' => 'Georgia',
        '"Helvetica Neue", Helvetica, sans-serif' => 'Helvetica Neue',
        'Tahoma, Geneva, sans-serif' => 'Tahoma'
    );
}
endif;

if ( ! function_exists( 'bavotasan_google_fonts' ) ) :
/**
 * Array of Google Fonts
 *
 * @return	Array of fonts
 *
 * @since 1.0.0
 */
function bavotasan_google_fonts() {
    return array(
        'Arvo, serif' => 'Arvo *',
        'Arvo Bold, serif' => 'Arvo Bold *',
        'Copse, sans-serif' => 'Copse *',
        'Droid Sans, sans-serif' => 'Droid Sans *',
        'Droid Serif, serif' => 'Droid Serif *',
        'Exo, sans-serif' => 'Exo *',
        'Lato Light, sans-serif' => 'Lato Light *',
        'Lato, sans-serif' => 'Lato *',
        'Lato Bold, sans-serif' => 'Lato Bold *',
        'Lobster, cursive' => 'Lobster *',
        'Nobile, sans-serif' => 'Nobile *',
        'Open Sans, sans-serif' => 'Open Sans *',
        'Oswald, sans-serif' => 'Oswald *',
        'Pacifico, cursive' => 'Pacifico *',
        'Raleway, cursive' => 'Raleway *',
        'Rokkitt, serif' => 'Rokkit *',
        'Russo One, sans-serif' => 'Russo One *',
        'PT Sans, sans-serif' => 'PT Sans *',
        'Quicksand, sans-serif' => 'Quicksand *',
        'Quattrocento, serif' => 'Quattrocento *',
        'Ubuntu, sans-serif' => 'Ubuntu *',
        'Yanone Kaffeesatz, sans-serif' => 'Yanone Kaffeesatz *'
    );
}
endif;