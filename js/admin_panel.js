( function( $ ) {

	$( '#acf-image_ba td:nth-child(4) input[type="text"]' ).attr({
		'readonly': true,
		'onclick': 'this.select()',
		'title': '選択部分をコピー( ctrl + c )して貼り付けたい部分へペーストします。'
	});

	$( '#acf-image_ba .acf-button, #acf-image_ba .acf-button-remove' ).on( 'click', function( event ) {

		var target = $( 'td:nth-child(4)' ).find( 'input[type="text"]' );
		var targetCount = $(target).length - 1;

		var addValue = '[ba_image num="' + targetCount + '"]';
		$( target ).eq( targetCount ).attr({
			'readonly': true,
			'value':  addValue,
			'onclick': 'this.select()',
			'title': '選択部分をコピー( ctrl + c )して貼り付けたい部分へペーストします。'
		});

		$( '#acf-image_ba .acf-button-remove' ).on( 'click', function( event ) {

			refresh( event );

		});

	});

	/**
	 * Sortable shortcode.
	 * @type {JQuery|HTMLElement}
	 */
	var targetElm = $( '#acf-image_ba tbody' );
	$(targetElm).attr( 'id', 'ba_sort' );

	$('#ba_sort').sortable({
		//start: function(event, ui) {
		//	console.log( 'スタート' );
		//},
		//change: function(event, ui) {
		//	console.log( 'チェンジ' );
		//},
		update: function( event, ui ) {

			var trCount = $( '#ba_sort tr' ).not( '.row-clone' ).length;
			for ( i = 0; i <= trCount; i++ ) {

				var updateTarget = $( '#ba_sort tr' ).eq( i -1 ).find( 'td:nth-child(4) input[type="text"]' );
				var addValue = '[ba_image num="' + ( i -1 ) + '"]';
				$( updateTarget ).attr({
					'value': addValue
				});

			}

		}

	});

	/**
	 * Renumbering when renove button click.
	 */
	$( '#acf-image_ba .acf-button-remove' ).on( 'click', function( event ) {

		refresh( event );

	});

	/**
	 * Renumbering field.
	 * @param event
	 */
	function refresh( event ) {

		var current = $( event.target ).closest( 'tr' );
		var startNum = $( current ).index();
		var trCounts = $( '#ba_sort tr' ).not( '.row-clone' ).length;
		for ( i = startNum; i <= ( trCounts - 1 ); i++ ) {

			var updateTarget = $( '#ba_sort tr' ).eq( i ).find( 'td:nth-child(4) input[type="text"]' );
			var addValue = '[ba_image num="' + ( i - 1 ) + '"]';
			$( updateTarget ).val( addValue );

		}

	}

})( jQuery );