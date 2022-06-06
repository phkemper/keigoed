$(document).ready(function(){
	/**
	 * Check PIN code size.
	 */
	$(document).on('keyup', '#pin', function() {
		var pin = $('#pin').val();
		$('#pinsubmit').prop('disabled', pin.length != 6);
		for ( var i = 0; i < pin.length; i++ ) {
			if ( pin.charCodeAt(i) < 48 || pin.charCodeAt(i) > 57 ) {
				$('#pinsubmit').prop('disabled', true);
			}
		}
	});

	switch ( MODE ) {
	case 'player':
		/*******************************************************************************
		 * 
		 * PLAYER SCRIPT
		 * 
		 *******************************************************************************/

		switch ( stage ) {
		case 'intro':
			$('#answers').hide();
			// Show intro details.
			$('#quiztext').html();
			$('#quizimage img').attr('src', );
			
			// Poll the server until the intro is over.
			break;
		case 'question':
			break;
		case 'explanation':
			break;
		case 'leaderboard':
			break;
		case 'outro':
			break;
		}
		break;
		
	case 'quizmaster':
		/*******************************************************************************
		 * 
		 * QUIZMASTER SCRIPT
		 * 
		 *******************************************************************************/

		switch ( STAGE ){
		case 'intro':
			break;
		case 'question':
			break;
		case 'explanation':
			break;
		case 'leaderboard':
			break;
		case 'outro':
			break;
		}
		break;
	}
	

});
