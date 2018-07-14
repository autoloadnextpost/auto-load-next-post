( function( wp, $ ) {
	"use strict";

	$( function () {
		// Bail if the Customizer isn't initialized
		if ( ! wp || ! wp.customize ) {
			return;
		}

		var api = wp.customize;

		api.preview.bind( 'active', function() {
			var $body = $( 'body' ),
					$has_body_class = false;

			if ( $body.hasClass( 'single-post' ) ) {
				$has_body_class = true;
			}

			api.preview.send( 'alnp_is_page_single', $has_body_class );
		} );
	} );

} )( window.wp, jQuery );
