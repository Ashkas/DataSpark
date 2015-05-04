<?php
/**
 * Roots initial setup and constants
 */
function roots_setup() {
  // Make theme available for translation
  load_theme_textdomain('roots', get_template_directory() . '/lang');

  // Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
  register_nav_menus(array(
    'primary_navigation' => __('Primary Navigation', 'roots'),
    'secondary_navigation' => __('Secondary Navigation', 'roots')
  ));

/* Control compression of files uploaded, set JPG compression to 70% */

add_filter( 'jpeg_quality', 'jpeg_full_quality' );
function jpeg_full_quality( $quality ) { return 70; }

  // Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
  add_theme_support('post-thumbnails');
  // set_post_thumbnail_size(150, 150, false);
  add_image_size('featured-small', 300, 194, array('center', 'center'));
  add_image_size('featured-medium', 500, 281, array('center', 'center'));
  add_image_size('featured-large', 900, 394, array('center', 'center'));
  
  add_image_size('insight-thumb', 250, 162, array('center', 'center')); 
  add_image_size('video-cover-thumb', 650, 355, array('center', 'center'));
  add_image_size('expert-profile', 180, 180, true ); // (cropped)
  add_image_size('large-wide', 1440, 350, array('center', 'center')); 
  add_image_size('large-wide-mobile', 560, 233, array('center', 'center')); 

  // Add post formats (http://codex.wordpress.org/Post_Formats)
  // add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

  // Tell the TinyMCE editor to use a custom stylesheet
  add_editor_style('/assets/css/editor-style.css');
}
add_action('after_setup_theme', 'roots_setup');
