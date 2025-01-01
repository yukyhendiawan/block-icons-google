( function( $ ) {
	// Ajax notice.
	$( document ).on( 'click', '.notice-block-icons .notice-dismiss', function() {
		$.ajax( {
			url: blockIconsGoogleAdminLocalize.ajaxUrl,
			type: 'POST',
			data: {
				action: 'block_icons_action_dismiss_notice',
				mynonce: blockIconsGoogleAdminLocalize.ajaxNonce,
			},
			success( response ) {
				// console.log( 'Ajax success:', response );
			},
			error( error ) {
				// console.error( 'Ajax error:', error );
			},
		} );
	} );
}( jQuery ) );
