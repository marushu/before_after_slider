(function($){

  $(window).on('load', function(){
    var slider = $('.bxslider').bxSlider({
      auto: true,
      autoHover: true,
      adaptiveHeight: true,
      tickerHover: true,
      useCSS: false,
      onSliderLoad: function ( currentIndex ) {
        $('.ba-slider').css({
          display: 'block'
        });
      },
      onSlideAfter: function ( $slideElement, oldIndex, newIndex ) {
        if( $slideElement.find('ba-slider') ) {
          var base = $slideElement.find('.ba-slider');
          var resize = base.find('.resize');
          var handle = base.find('.handle');
          resize.not(':animated').animate({
            width: '55%'
          }, 50, 'linear', function(){
            $(this).not(':animated').animate({
              width: '45%'
            });
            recovery($(this));
          });
          handle.not(':animated').animate({
            left: '55%'
          }, 50, 'linear', function(){
            $(this).not(':animated').animate({
              left: '45%'
            });
            recovery($(this));
          });
        }
        slider.stopAuto();
        slider.startAuto();
      }
    });
    $('.ba-slider').beforeAfter();
  });

  function recovery ( elm ) {
    var checkClass = elm.attr('class');
    if ( checkClass === 'resize' ) {
      elm.not(':animated').animate({
        width: '50%'
      });
    } else {
      elm.not(':animated').animate({
        left: '50%'
      });
    }
  }

})(jQuery);
