/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can 
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function ($) {

// Use this variable to set up the common and page specific functions. If you 
// rename this variable, you will also need to rename the namespace below.
  var Roots = {
    // All pages
    common: {
      init: function () {
        // JavaScript to be fired on all pages

        // Responsive Videos
        $(".video").fitVids();

        // Load Video
        $(".cover-image").click(function() {
          var vidID = $(this).data('vidid');
          $("[data-vid-target='" + vidID + "'] iframe").each(function() {
            $(this).attr('src', $(this).attr('src') + '&autoplay=1');
          })
          $("div").find("[data-vid-target='" + vidID + "']").show();
          $(this).hide();
        });


        // Dropdown-menu
        $(".dropdown-menu").hover(
          function() {
            $(this).parent('li').children('.dropdown-toggle').addClass('active');
          },
          function () {
            $(this).parent('li').children('.dropdown-toggle').removeClass('active');
          }
        );

        $('.video-wrap .video').hide();
        $('.video-thumb').click(function() {
          $(this).hide();
          $(".video-wrap .video").show();
        });

        // Main navigation waypoint

        $('.waypoint').waypoint(function(direction) {

          var breakpoint = 768;
          var scrollbar = (window.innerWidth-$(window).width());

          if ($(window).width() + scrollbar > breakpoint) {
            if (direction == 'down') {
              $('header.banner').addClass('small');
              $('div.navigation').removeClass('stick');
            }
            if (direction == 'up') {
              $('header.banner').removeClass('small');
            }
          }
        });
        
         // CTA stick for mobile
        
        $('.waypoint').waypoint(function(direction) {

          var breakpoint = 760;
          var scrollbar = (window.innerWidth-$(window).width());

          if ($(window).width() + scrollbar < breakpoint) {
            if (direction == 'down') {
              $('div.navigation').addClass('stick');
            }
            if (direction == 'up') {
              $('div.navigation').removeClass('stick');
            }
          }
        });

        $('.menu-expand').click(function(){
          $('body').toggleClass('menu-small');
          $('header.banner').toggleClass('menu-active');
        });

      }
    },
    // Home page
    page_template_template_home_php: {
      init: function () {
      // JavaScript to be fired on the home page

      }
    },
    // About us page, note the change from about-us to about_us.
    about_us: {
      init: function () {
        // JavaScript to be fired on the about us page
      }
    }
  };

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function (func, funcname, args) {
      var namespace = Roots;
      funcname = (funcname === undefined) ? 'init' : funcname;
      if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function () {
      UTIL.fire('common');

      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function (i, classnm) {
        UTIL.fire(classnm);
      });
    }
  };

  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
