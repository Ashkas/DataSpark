/**
 * Created by dg on 23/10/14.
 */
$('.carousel').slick({
    dots: false,
    arrows: true,
    autoplay: true,
    pauseOnHover: false,
    draggable: true,
    speed: 200,
    autoplaySpeed: 6000,
    //appendDots: '.carousel-pager',
    onInit: function(slide, index){
        var speed = slide['options']['autoplaySpeed'];
        // Uncomment below to re-activate timing bar and set autoplay to true.
        // calcSpeed(speed);
        $('.carousel-pager').show();

    },
    onBeforeChange: function(slide, index) {
        // Reset with width of the loading bars.
        resetWidth();
    },
    onAfterChange: function(slide, index) {
        var speed = slide['options']['autoplaySpeed'];
        // Uncomment below to re-activate timing bar and set autoplay to true.
        // calcSpeed(speed)
    },
    customPaging: function(slider, i) {
        var tabTitle = $(slider.$slides[i]).find('.headline').data('tab-title');
        var number = i + 1;
        return '<p>'+tabTitle+'</p><div class="tab-'+ number +'" data-tab="'+i+'"><span class="load-bar" style="width:100%"></span></div>';
    },
/*
    responsive: [
        {
            // Doesn't include 15px sidebar therefore 768 - 15.
            breakpoint: 753,
            settings: {
                slidesToShow: $('.carousel .single-item').size(),
                dots: false,
                speed: 0,
                onInit: function(slide, index){

                  // Go to first slide.
                  function firstSlide() {
                    $('.carousel').slickGoTo(0);
                    $('.carousel-pager').hide();
                  }
                  // Have to delay slickGoTo as the slide
                  // isn't completely loaded on this callback function.
                  setTimeout(firstSlide, 100)
                  // Backup if first misses
                  setTimeout(firstSlide, 500)
                }
            }
        }
    ]
*/
});


function resetWidth() {
    $( ".carousel-pager .slick-dots li .load-bar").each(function(){
        $(this).stop().width(0);
    });
}
function calcSpeed(speed){
    $( ".carousel-pager .slick-dots li.slick-active .load-bar").stop().animate({ width: "100%" }, speed, "linear" );
}
//$('.carousel').hover(
//    function() {
//        // Pause Loading Animation
//        $('.carousel-pager li.slick-active .load-bar').stop();
//    }, function () {
//        var speed = $('.carousel').slickGetOption('autoplaySpeed');
//        // Reset - Tab timer.
//        $('.carousel-pager li.slick-active .load-bar').width('0');
//        calcSpeed(speed);
//    });

$('.carousel-pager .slick-dots li').click(
    function() {
        var isPaused = $('.carousel').slickGetOption('isPaused');
        if((isPaused == true) && ($(this).children('div').data('tab') == $('.carousel').slickGetOption('pausedSlide'))){
            $('.carousel').slickPlay().slickSetOption('isPaused', false);
            $('.carousel-pager li.slick-active .load-bar').stop().width('0');
            var speed = $('.carousel').slickGetOption('autoplaySpeed')
            calcSpeed(speed);
        } else {
            $('.carousel').slickPause().slickSetOption('isPaused', true);
            var slideID = $('.carousel').slickCurrentSlide();
            $('.carousel').slickSetOption('pausedSlide', slideID);
            $('.carousel-pager li.slick-active .load-bar').stop().width('100%');
        }
    });

/*
$('.client-carousel').slick({
  dots: false,
  slidesToShow: 3,
  slidesToScroll: 3,
  infinite: false,
  lazyLoad: 'ondemand',
  responsive: [
    {
      // Doesn't include 15px sidebar therefore 768 - 15.
      breakpoint: 753,
      settings: {
        arrows: false,
        slidesToShow: 3,
        slidesToScroll: 3,
        dots: true
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows:false,
        slidesToShow: 2,
        slidesToScroll: 2,
        dots: true
      }
    }
  ]
})
*/