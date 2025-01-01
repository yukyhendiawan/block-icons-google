( function() {
	const link = document.querySelectorAll(
		'.wrap .tabs .mycontainer .myrow .box-menu a'
	);
	const row = document.querySelectorAll( '.wrap .data-content' );

	link.forEach( function( item, index ) {
		link[ index ].addEventListener( 'click', function() {
			// Get id
			const getId = '.' + this.getAttribute( 'myid' );

			// Remove all class active link
			link.forEach( function( element ) {
				element.classList.remove( 'active' );
			} );

			// Active class link
			this.classList.add( 'active' );

			// Hide all data content
			row.forEach( function( element ) {
				element.classList.add( 'hide' );
				element.classList.remove( 'active' );
			} );

			// Show data content active current
			document
				.querySelector( getId + '.data-content' )
				.classList.remove( 'hide' );
			document
				.querySelector( getId + '.data-content' )
				.classList.add( 'active' );
		} );
	} );
}() );
