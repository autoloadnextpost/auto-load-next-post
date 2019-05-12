/* global alnp_pro_preview_params */
( function( $, params ) {

	$('.nav-tab-wrapper a').on('click', function(e) {
		var href = $(this).attr('href'),
			tab  = $(this).data('tab'),
			jc;

		if ( href == '#' ) {
			e.preventDefault();

			jc = $.dialog({
				icon: 'dashicons dashicons-info',
				title: params.i18n_coming_soon,
				content: '<p>' + params.i18n_coming_soon_content + '</p>',
				rtl: params.is_rtl,
				type: 'blue',
				draggable: false,
				boxWidth: '500px',
				useBootstrap: false,
			});

			if ( tab == 'comments' ) {
				setTimeout(function () {
					jc.setContentAppend( '<p>' + params.i18n_comments_content + '</p>' );
				}, 100);
			}

			if ( tab == 'load-and-scroll' ) {
				setTimeout(function () {
					jc.setContentAppend( '<p>' + params.i18n_load_scroll_content + '</p>' );
				}, 100);
			}

			if ( tab == 'restrictions' ) {
				setTimeout(function () {
					jc.setContentAppend( '<p>' + params.i18n_restrictions_content + '</p>' );
				}, 100);
			}

			if ( tab == 'query' ) {
				setTimeout(function () {
					jc.setContentAppend( '<p>' + params.i18n_query_content + '</p>' );
				}, 100);
			}

			if ( tab == 'license' ) {
				setTimeout(function () {
					jc.setContentAppend( '<p>' + params.i18n_license_content + '</p>' );
				}, 100);
			}
		}
	});

})( jQuery, alnp_pro_preview_params );
