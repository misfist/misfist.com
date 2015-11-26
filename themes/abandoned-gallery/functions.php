<?php
/**
 * @package abandoned
 */
/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */

if(! function_exists( 'abandoned_enqueue_scripts' ) ) {

    function abandoned_enqueue_scripts() {

        $parent_style = 'gridz-style';

        wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );

        wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ) );
    }

    add_action( 'wp_enqueue_scripts', 'abandoned_enqueue_scripts' );
}


/**
 * Get first image for Image post type
 */

if(! function_exists( 'abandoned_first_image' ) ) {

    function abandoned_first_image($link = true, $class = 'entry-featured') {
      global $post, $posts;
      $first_img = '';
      ob_start();
      ob_end_clean();
      $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
      $first_img = ( $post->post_content ) ? $matches[1][0] : '';

      if(empty($first_img)) {
        $first_img = "";
      } else {
        if($link) $first_img = '<div class="'.$class.'"><a href="'.get_permalink().'"><img src="'.$first_img.'"/></a></div>';
        else $first_img = '<div class="'.$class.'"><img src="'.$first_img.'"/></div>';
      }
      return $first_img;
    }

}




/**
 * Custom header style
 */

if(! function_exists( 'abandoned_header_style' ) ) {

  function abandoned_header_style() {

    global $gridz_options;
    $text_color = trim(get_header_textcolor());
    $header_image = trim(get_header_image());
    if($text_color == "") $text_color = "ffffff";
    if($header_image != "") $header_img_style = 'background-image: url('.$header_image.'); background-repeat: repeat;';
    if(!display_header_text()) $text_style = 'display: none;';
    ?>
    <style type="text/css">
      #header { background-color: '#131313'; }
      #header .site-title { font-family: sans-serif; }
    </style>
    <?php

  }

}

?>