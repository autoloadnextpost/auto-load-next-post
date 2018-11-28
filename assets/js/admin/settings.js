/* global alnp_settings_params */
( function( $, params ) {
	$( function() {

		// Edit prompt
		$( function() {
			var changed = false;

			$('input, number, email, textarea, select, checkbox, radio').change( function() {
				changed = true;
			});

			$('.nav-tab-wrapper a').click( function() {
				if ( changed ) {
					window.onbeforeunload = function() {
						return params.i18n_nav_warning;
					};
				} else {
					window.onbeforeunload = '';
				}
			});

			$('.submit :input').click( function() {
				window.onbeforeunload = '';
			});
		});

		// Select all button
		$('.auto-load-next-post').on('click', '.select_all', function() {
			$(this).closest('td').find('select option').attr('selected', 'selected');
			$(this).closest('td').find('select').trigger('change');
			return false;
		});

		// Select none button
		$('.auto-load-next-post').on('click', '.select_none', function() {
			$(this).closest('td').find('select option').removeAttr('selected');
			$(this).closest('td').find('select').trigger('change');
			return false;
		});

		// Select2 enhanced select fields
		$('.alnp-enhanced-select').select2({
			dir: params.is_rtl,
			minimumResultsForSearch: Infinity,
			placeholder: function() {
				$(this).data('placeholder');
			}
		});

		$('.alnp-enhanced-multiselect').select2({
			dir: params.is_rtl,
			multiple: true,
			placeholder: function() {
				$(this).data('placeholder');
			}
		});

		$('.trigger-help').click( function(e) {
			e.preventDefault();

			var panel = $('#' + $('#screen-meta-links').find('.show-settings').attr('aria-controls') );

			if ( !panel.length )
				return;

			if ( panel.is(':visible') ) {
				panel.slideUp('fast', function() {
					panel.parent().next().find('button').removeClass( 'screen-meta-active' ).attr( 'aria-expanded', false );
					panel.parent().hide();
				});

				$(document).trigger('screen:options:close');

				$('.need-help').removeClass('hide');
			}
			else {
				panel.parent().show();

				panel.slideDown('fast', function() {
					panel.focus();
					panel.parent().next().find('button').addClass( 'screen-meta-active' ).attr( 'aria-expanded', true );
				});

				$(document).trigger('screen:options:open');

				$('.need-help').addClass('hide');
			}
		});

	});
})( jQuery, alnp_settings_params );
