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
});
