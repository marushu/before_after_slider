(function($){

	//$(window).on('load', function(){

		var winW = $( window ).width();
		var moveFlag = false;
		var sliderListCount = $( '.bxslider li' ).length;

		if ( winW > 799 && sliderListCount > 1 ) {
			var slider = $( '.bxslider' ).bxSlider({
				mode: 'fade',
				auto: true,
				autoHover: true,
				adaptiveHeight: false,
				tickerHover: true,
				useCSS: false,
				touchEnabled: false,
				oneToOneTouch: false,
				onSliderLoad: function ( currentIndex ) {

					var $slideElement = $( '.bxslider li' ).not( '.bx-clone' ).eq( currentIndex );
					var base = $slideElement.find('.ba-slider');
					if ( $slideElement.find( 'ba-slider' ) && moveFlag == false ) {
						var base = $slideElement.find('.ba-slider');
						var resize = base.find('.resize');
						var handle = base.find('.handle');
						resize.not(':animated').animate({
							width: '55%'
						}, 50, 'linear', function () {
							$(this).not(':animated').animate({
								width: '45%'
							});
							recovery($(this));
						});
						handle.not(':animated').animate({
							left: '55%'
						}, 50, 'linear', function () {
							$(this).not(':animated').animate({
								left: '45%'
							});
							recovery($(this));
						});
					}

					moveFlag = true;

				},
				onSlideAfter: function ( $slideElement, oldIndex, newIndex ) {
					slider.stopAuto();
					slider.startAuto();
					var base = $slideElement.find('.ba-slider');
					var resize = base.find('.resize');
					var handle = base.find('.handle');
					recovery_soon( resize );
					recovery_soon( handle );
				}
			});

		} else {

			var slider = $('.bxslider').bxSlider({
				auto: false,
				autoHover: true,
				adaptiveHeight: true,
				tickerHover: true,
				useCSS: false,
				touchEnabled: false,
				oneToOneTouch: false,
				onSliderLoad: function ( currentIndex ) {

					var $slideElement = $( '.bxslider li' ).not( '.bx-clone' ).eq( currentIndex );
					var base = $slideElement.find('.ba-slider');
					if ( $slideElement.find( 'ba-slider' ) && moveFlag == false ) {
						var base = $slideElement.find('.ba-slider');
						var resize = base.find('.resize');
						var handle = base.find('.handle');
						resize.not(':animated').animate({
							width: '55%'
						}, 50, 'linear', function () {
							$(this).not(':animated').animate({
								width: '45%'
							});
							recovery($(this));
						});
						handle.not(':animated').animate({
							left: '55%'
						}, 50, 'linear', function () {
							$(this).not(':animated').animate({
								left: '45%'
							});
							recovery($(this));
						});
					}

					moveFlag = true;

				},
				onSlideAfter: function ( $slideElement, oldIndex, newIndex ) {

					var base = $slideElement.find('.ba-slider');
					var resize = base.find('.resize');
					var handle = base.find('.handle');
					recovery_soon( resize );
					recovery_soon( handle );

				}

			});

		}
		$('.ba-slider').beforeAfter();
	//});

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

	function recovery_soon( elm ) {

		$( '.bxslider li' ).each( function ( e ) {

			var resizeTarget = $( this ).find( '.resize' );
			var handleTarget = $( this ).find( '.handle' );
			$( resizeTarget ).not( ':animated' ).animate({ width: '50%' });
			$( handleTarget ).not( ':animated' ).animate({ left: '50%' });
			$( resizeTarget ).removeAttr( 'style' );
			$( handleTarget ).removeAttr( 'style' );

		});

	}

})(jQuery);
