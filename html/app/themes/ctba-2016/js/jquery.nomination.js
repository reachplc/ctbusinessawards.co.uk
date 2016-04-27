(function($) {

	$( document ).ready( function() {

		// Get all check boxes that are not checked
		var checkedValues = $('.cmb2-id-ctba-entries-2016-categories .cmb2-option:not(:checked)')
												 .map(function() {
														return this.value;
												 }).get();

		// Hide all categories not checked
		$.each( checkedValues, function( key, value ) {
			$( '#' + value ).attr( 'data-state', 'hidden' );
		});

		// checkbox clicked function
		$('.cmb2-id-ctba-entries-2016-categories .cmb2-checkbox-list input').click(function(){

			// Add visible class to selected checkbox
			$(this).parent('li').toggleClass('is_visible');

		  // get value from input box
		  var _catid = $(this).val();
			console.log('selected', _catid );

			// show question id from value checked
			if ( $(this).is(':checked') ) {
				$( '#' + _catid ).attr( 'data-state', 'visible' );
			}

			// hide question id from value unchecked
			if( ! $(this).is(':checked') ){
				$( '#' + _catid ).attr( 'data-state', 'hidden' );
			}

		});

	});

} )( jQuery );
