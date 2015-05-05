<?php
/**
 * Custom functions
 */
 
 /* Function to get image meta - http://wordpress.org/ideas/topic/functions-to-get-an-attachments-caption-title-alt-description */
function wp_get_attachment( $attachment_id ) {

	$attachment = get_post( $attachment_id );
	return array(
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
}
 

/**
 * @param string $imgID
 * @param string $url
 * @param string $size
 *
 * @return string
 */
function get_image_markup($imgID = '',$url = '',$size = 'full'){
  if(!empty($imgID) && is_numeric($imgID)) {
    if(!empty($url)) {
      $image = wp_get_attachment_image($imgID,$size);
      
      $image_small = wp_get_attachment_image_src($imgID, 'featured-small');
      $image_medium = wp_get_attachment_image_src($imgID, 'featured-medium');
      $image_large = wp_get_attachment_image_src($imgID, 'featured-large');
      
      return '<a href="'.$url.'" target="_blank">'. $image .'</a>';
    } else {
      return wp_get_attachment_image($imgID,$size);
    }
  }
}


/**
 * @param $imgID
 *
 * @return bool|string
 */
function get_image_url($imgID, $size='full'){
  if(!empty($imgID)) {
    $url = wp_get_attachment_image_src($imgID,$size);
    return  $url[0];
  }
}

/**
 * Track Google goals in Analytics
 */

function add_conversion_tracking_code($button, $form) {
	$dom = new DOMDocument();
	$dom->loadHTML($button);
	$input = $dom->getElementsByTagName('input')->item(0);
	if ($input->hasAttribute('onclick')) {
		$input->setAttribute("onclick","ga('send', 'event', { eventCategory: 'Request Form', eventAction: 'Request Submission', eventLabel: 'Form:'});".$input->getAttribute("onclick"));
	} else {
		$input->setAttribute("onclick","ga('send', 'event', { eventCategory: 'Request Form', eventAction: 'Request Submission', eventLabel: 'Form:'});");
	}
	return $dom->saveHtml();
}

add_filter( 'gform_submit_button_1', 'add_conversion_tracking_code', 10, 2);


// Custom image insertion for responsivePicture element
function responsive_insert_image($html, $id, $caption, $title, $align, $url, $size) {
	
	$alt = get_post_meta($id, '_wp_attachment_image_alt', true);
	$image_url = wp_get_attachment_image_src( $id, $size, false, false );
	
	if($caption) $figcation = '<figcaption>'.$caption.'</figcaption>';
	
	if($size == 'large') :
		$image_url_mobile = wp_get_attachment_image_src( $id, 'medium', false, false );
	
		$custom_insert = "<picture class='size-".$size." align".$align."'>";
		$custom_insert .= '<!--[if IE 9]><video style="display: none;"><![endif]-->
					<source srcset="'.$image_url[0].'" media="(min-width: 760px)">
				<!--[if IE 9]></video><![endif]-->';
		$custom_insert .= "<img src='".$image_url_mobile[0]."' alt='$alt' class='size-".$size."' />";
		$custom_insert .= $figcation;
		$custom_insert .= "</picture>";
	else: 
		$custom_insert = "<figure  class='size-".$size." align".$align."'> <img src='".$image_url[0]."' alt='".$alt."' class='size-".$size." $size' />".$figcation."</figure>";
	endif;
	
	return str_replace('<br>', "", $custom_insert); // <br> inserted by WP
}
add_filter( 'image_send_to_editor', 'responsive_insert_image', 10, 9 );

/**
 * @param string $text
 * @param string $url
 *
 * @return string
 */
function get_cta_link( $text = '', $url = '' ) {
  $output = '';
  if(!empty($url) && !empty($text)) {
    $output = '<a href="'. $url .'" class="cta_button">'. $text .'</a>';
  }
  return $output;
}

function get_cta_link_alt( $text = '', $url = '' ) {
  $output = '';
  if(!empty($url) && !empty($text)) {
    $output = '<a href="'. $url .'" class="cta_button cta_button_alt">'. $text .'</a>';
  }
  return $output;
}

function get_email_markup($email, $text='') {
  if(empty($text)) {
    $text = $email;
  }
  $email = explode('@', $email);
  $new_email = str_replace('.', 'DOT', $email[1]);
  $new_email = $email[0].'AT'.$new_email;
  return '<a href="mailto:'.$new_email.'" onclick="this.href=this.href.replace(/AT/,\'@\').replace(/DOT/,\'.\')">'.$text.'</a>';
}

/**
 * @param int $length
 *
 * @return int
 */
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function custom_excerpt_length( $length = 20) {
  return 20;
}

/**
 * @param $more
 *
 * @return string
 */
add_filter( 'excerpt_more', 'custom_excerpt_more' );
function custom_excerpt_more( $more ) {
	return '...';
}


/**
 * Applies page options to body class.
 *
 * @since 1.0.0
 *
 * @see get_field()
 * @link http://www.advancedcustomfields.com/resources/get_field/
 * @link http://codex.wordpress.org/Function_Reference/body_class
 *
 * @param array $classes An array of existing body classes.
 * @param array $classes An array of ammended body classes.
 */
add_filter( 'body_class', 'get_page_sidebar_classes' );
function get_page_sidebar_classes( $classes ) {

  if(get_field('lhs_sidebar')){
    $classes[] = 'left-sidebar';
  }
  if(get_field('rhs_sidebar')){
    $classes[] = 'right-sidebar';
  }
  if(is_single()){
    $classes[] = 'right-sidebar';
  }
  if(get_field('display_as_full_width')){
    $classes[] = 'full-width';
  }
  return $classes;
}


/**
 * @param $url
 *
 * @return string
 */

function get_video_thumb($url, $custom_image = '') {
  // Only for youtube
  if (strpos($url, 'youtu')!==FALSE) {
    $yid          = get_video_id( $url );
    if($custom_image) {
      $thumb_markup = '<div class="cover-image" data-vidid="' . $yid . '"><img src="'. $custom_image .'"></div>';
    } else {
      $thumb_markup = '<div class="cover-image" data-vidid="' . $yid . '"><img src="http://img.youtube.com/vi/' . $yid . '/maxresdefault.jpg"></div>';
    }
  } else if (strpos($url, 'vimeo')!==FALSE) {
    $vimeo_json = file_get_contents('http://vimeo.com/api/oembed.json?url='.$url);
    $obj = json_decode($vimeo_json);
    $vimid = $obj->video_id;
    $vimimage =  $obj->thumbnail_url;
    if($custom_image) {
      $thumb_markup = '<div class="cover-image" data-vidid="' . $vimid . '"><img src="'. $custom_image .'"></div>';
    } else {
      $thumb_markup = '<div class="cover-image" data-vidid="' . $vimid . '"><img src="'. $vimimage .'"></div>';
    }
  }
  return $thumb_markup;
}


/**
 * @param $url
 *
 * @return string
 */
function get_video_id($url) {
  // Only for youtube
  if (strpos($url, 'youtu')!==FALSE) {
    $id = preg_match( "#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches );
    $id = $matches[0];
  }
  if (strpos($url, 'vimeo')!==FALSE) {
    $vimeo_json = file_get_contents('http://vimeo.com/api/oembed.json?url='.$url);
    $obj = json_decode($vimeo_json);
    $id = $obj->video_id;
  }
  return $id;
}


/**
 * Filter that allows sets any argument provided in wp_oembed_get
 *
 * @param $html
 * @param $url
 * @param $args
 *
 * @return string
 */
add_filter('oembed_result','dataspark_oembed_result', 10, 3);
function dataspark_oembed_result($html, $url, $args) {
  // Only for youtube
  if (strpos($html, 'youtu')!==FALSE) {
    // Defaults - can be overridden when called with wp_oembed_get.
    $defaults = array(
      'showinfo' => '0',
      'autohide' => '1',
      'rel' => '0',
      'branding' => '0'
    );
    if($args) {
      $args = $args + $defaults;
    } else {
      $args = $defaults;
    }
    // Adding the Arguments
    preg_match('/src="([^"]+)"/', $html, $match);
    $url_args = $match[1];
    foreach($args as $param => $value) {
      $param = sanitize_text_field($param);
      $value = sanitize_text_field($value);
      $url_args = add_query_arg($param, $value, $url_args);
    }

    $html = '<iframe width="652" height="367" src="'.$url_args.'" frameborder="0" allowfullscreen></iframe>';

  }
  if (strpos($html, 'vimeo')!==FALSE) {
    $defaults = array(
      'badge' => '0'
    );
    if($args) {
      $args = $args + $defaults;
    } else {
      $args = $defaults;
    }
    preg_match('/src="([^"]+)"/', $html, $match);
    $url_args = $match[1];
    foreach($args as $param => $value) {
      $param = sanitize_text_field($param);
      $value = sanitize_text_field($value);
      $url_args = add_query_arg($param, $value, $url_args);
    }
    $html = '<iframe width="652" height="367" src="'.$url_args.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
  }
  return $html;
}


if( function_exists('acf_add_options_page') ) {

  acf_add_options_page(array(
    'page_title' 	=> 'Theme General Settings',
    'menu_title'	=> 'Theme Settings',
    'menu_slug' 	=> 'theme-general-settings',
    'capability'	=> 'edit_posts',
    'redirect'		=> false
  ));

  acf_add_options_sub_page(array(
    'page_title' 	=> 'Theme Header Settings',
    'menu_title'	=> 'Header',
    'parent_slug'	=> 'theme-general-settings',
  ));

  acf_add_options_sub_page(array(
    'page_title' 	=> 'Theme Footer Settings',
    'menu_title'	=> 'Footer',
    'parent_slug'	=> 'theme-general-settings',
  ));

}