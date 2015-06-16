<?php
/**
 * Enqueue scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/assets/css/main.min.css
 *
 * Enqueue scripts in the following order:
 * 1. jquery-1.11.0.min.js via Google CDN
 * 2. /theme/assets/js/vendor/modernizr-2.7.0.min.js
 * 3. /theme/assets/js/main.min.js (in footer)
 */
function roots_scripts() {
  wp_enqueue_style('roots_main', get_template_directory_uri() . '/assets/css/app.css', false, '64c2848549e90cef42796141ccce4c3e');

  // jQuery is loaded using the same method from HTML5 Boilerplate:
  // Grab Google CDN's latest jQuery with a protocol relative URL; fallback to local if offline
  // It's kept in the header instead of footer to avoid conflicts with plugins.
  if (!is_admin() && current_theme_supports('jquery-cdn')) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', array(), null, false);
    add_filter('script_loader_src', 'roots_jquery_local_fallback', 10, 2);
  }

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_register_script('modernizr', get_template_directory_uri() . '/assets/js/vendor/modernizr-2.7.0.min.js', array(), null, false);
  wp_register_script('dataspark_scripts', get_template_directory_uri() . '/assets/js/main.js', array(), '0fc6af96786d8f267c8686338a34cd38', true);
  wp_register_script('dataspark_carousel', get_template_directory_uri() . '/assets/js/carousel.js', array('slick'), null, true);
  wp_register_script('picturefill', get_template_directory_uri() . '/assets/js/plugins/picturefill.min.js', array('jquery'), null, false);
  wp_register_script('dataspark_gmap', get_template_directory_uri() . '/assets/js/acf-google.js', array('jquery'), null, false);
  wp_register_script('slick', get_template_directory_uri() . '/assets/js/plugins/slick.min.js', array('jquery'), null, false);
  wp_register_script('fitvid', get_template_directory_uri() . '/assets/js/plugins/jquery.fitvids.js', array('jquery'), null, false);
  wp_register_script('flexnav', get_template_directory_uri() . '/assets/js/plugins/jquery.flexnav.min.js', array('jquery'), null, true);
  wp_register_script('waypoints', get_template_directory_uri() . '/assets/js/plugins/waypoints.min.js', array('jquery'), null, false);
  wp_register_script('picturefill', get_template_directory_uri() . '/assets/js/plugins/picturefill.min.js', array('jquery'), null, false);
  wp_register_script('rem', get_template_directory_uri() . '/assets/js/plugins/rem.min.js', array('jquery'), null, true);
  wp_register_script('respond', get_template_directory_uri() . '/assets/js/plugins/respond.js', array(), null, true);
  wp_register_script('smooth-scroll', get_template_directory_uri() . '/assets/js/smooth-scroll.js', array(), null, true);
  wp_register_script('addthis', '//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-547ea8c67314e281', array(), null, true);

  wp_enqueue_script('modernizr');
  wp_enqueue_script('jquery');
  wp_enqueue_script('dataspark_scripts');
  wp_enqueue_script('dataspark_carousel');

  wp_enqueue_script('slick');
  wp_enqueue_script('fitvid');
  wp_enqueue_script('flexnav');
  wp_enqueue_script('waypoints');
  wp_enqueue_script('picturefill');
  wp_enqueue_script('rem');
  //if(is_page('Contact us')):
	wp_enqueue_script( 'google_map', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', array(), '3', true );
	wp_enqueue_script('dataspark_gmap'); 
  //endif;
  wp_enqueue_script('respond');
  wp_enqueue_script('smooth-scroll');
  
  //if(is_single()):
	wp_enqueue_script( 'addthis_widget', 'http://s7.addthis.com/js/250/addthis_widget.js#pubid=urPubID', array('jquery'), "1.0.0", 'all' );
	wp_enqueue_script('addthis');
  //endif;

}
add_action('wp_enqueue_scripts', 'roots_scripts', 100);

// http://wordpress.stackexchange.com/a/12450
function roots_jquery_local_fallback($src, $handle = null) {
  static $add_jquery_fallback = false;

  if ($add_jquery_fallback) {
    echo '<script>window.jQuery || document.write(\'<script src="' . get_template_directory_uri() . '/assets/js/vendor/jquery-1.11.0.min.js"><\/script>\')</script>' . "\n";
    $add_jquery_fallback = false;
  }

  if ($handle === 'jquery') {
    $add_jquery_fallback = true;
  }

  return $src;
}
add_action('wp_head', 'roots_jquery_local_fallback');

function dataspark_footer_js() { ?>
  <script>
    $(".flexnav").flexNav({
      'animationSpeed': 250,
      'transitionOpacity': false
    });
  </script>
<?php
}
add_action('wp_footer', 'dataspark_footer_js', 20);


function roots_google_analytics() { ?>
<script>
  (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
  function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
  e=o.createElement(i);r=o.getElementsByTagName(i)[0];
  e.src='//www.google-analytics.com/analytics.js';
  r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
  ga('create','<?php echo GOOGLE_ANALYTICS_ID; ?>');ga('send','pageview');
</script>

<?php }
if (GOOGLE_ANALYTICS_ID && !current_user_can('manage_options')) {
  add_action('wp_footer', 'roots_google_analytics', 20);
}
