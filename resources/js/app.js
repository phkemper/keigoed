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

	switch ( ROLE ) {
	case 'player':
		/*******************************************************************************
		 * 
		 * PLAYER SCRIPT
		 * 
		 *******************************************************************************/

		switch ( STAGE ) {
		case 'intro':
			$('#answers').hide();
			// Poll the server until the intro is over.
			pollServer();
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
	
	/**********************************************************************************
	 * 
	 * PLAYER INTERACTION
	 * 
	 **********************************************************************************/

	function pollServer() {
		var polling = setInterval(function() {
			$.ajax({
				url: '/play/' + QUIZID + '/poll/' + PLAYERID,
				timeout: 120000,
				type: 'GET',
				cache: false,
				success: function(data, textStatus, jqXHR) {
					switch ( data.stage ) {
					case 'question':
						$('#introtext').html(data.text);
						$('#introimage img').attr('src', data.image);
						$('#answer-a #answertext').html(data.answeratext);
						$('#answer-a #answerimage img').attr('src', data.answeraimage);
						$('#answer-b #answertext').html(data.answeratext);
						$('#answer-b #answerimage img').attr('src', data.answeraimage);
						if ( data.answerctext.lengt )
						{
							$('#answer-c #answertext').html(data.answerctext);
							$('#answer-c #answerimage img').attr('src', data.answercimage);
							$('#answer-d #answertext').html(data.answerdtext);
							$('#answer-d #answerimage img').attr('src', data.answerdimage);
							$('#answer-c').show();
							$('#answer-d').show();
						}
						else {
							$('#answer-c').hide();
							$('#answer-d').hide();
						}
						$('#answers').show();
						$('#intro').show();
						$('#leaderboard').hide();
						break;
					case 'explanation':
						break;
					case 'leaderboard':
						break;
					case 'outro':
						clearInterval(polling);
						break;
					}
				},
				error: function() {
					$('#introtext').html('ERROR');
					$('#introimage').hide();
					$('#leaderboard').hide();
					$('#intro').show();
				}
			});
		}, 1000);
	}
});

