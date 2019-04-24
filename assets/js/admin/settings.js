/* global alnp_settings_params */
( function( $, params ) {
	var changed       = false,
		need_help     = $('.need-help').data('tab'),
		help_tabs     = $('.contextual-help-tabs'),
		help_contents = $('.contextual-help-tabs-wrap'),
		panel         = $('#' + $('#screen-meta-links').find('.show-settings').attr('aria-controls') );

	$('input, number, email, textarea, select, checkbox, radio').change( function() {
		changed = true;
	});

	// Navigation tab - If clicked and any input had changed then warn the user they will lose those changes if they continue.
	$('.nav-tab-wrapper a').click( function() {
		if ( changed ) {
			window.onbeforeunload = function() {
				return params.i18n_nav_warning;
			};
		} else {
			window.onbeforeunload = '';
		}
	});

	// Clears any warnings previously set
	$('.submit :input').click( function(	) {
		window.onbeforeunload = '';
	});

	// Reset button - If pressed will warn the user that all settings will be reset if they continue.
	$('a.reset-settings').click( function() {
		window.onbeforeunload = function() {
			return params.i18n_reset_warning;
		};
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

	// Triggers the WordPress help screen to open.
	$('.trigger-help').click( function(e) {
		e.preventDefault();

		if ( !panel.length )
			return;

		if ( panel.is(':visible') ) {
			panel.slideUp('fast', function() {
				panel.parent().next().find('button').removeClass('screen-meta-active').attr('aria-expanded', false);
				panel.parent().hide();
			});

			$(document).trigger('screen:options:close');

			$('.need-help').removeClass('hide');
		}
		else {
			panel.parent().show();

			need_help = need_help.replace('-', '_');

			// If a help tab for the settings in view exists display content.
			if ( help_tabs.find('#tab-link-auto_load_next_post_' + need_help + '_tab').length > 0 ) {
				help_tabs.find('li').removeClass('active');
				help_contents.find('div').removeClass('active');

				help_tabs.find('#tab-link-auto_load_next_post_' + need_help + '_tab').addClass('active').show();
				help_contents.find('#tab-panel-auto_load_next_post_' + need_help + '_tab').addClass('active').show();
			}

			panel.slideDown('fast', function() {
				panel.focus();
				panel.parent().next().find('button').addClass('screen-meta-active').attr('aria-expanded', true);
			});

			$(document).trigger('screen:options:open');

			$('.need-help').addClass('hide');
		}
	});

	// Hides the help button if the screen panel was opened normally.
	$(document).on('screen:options:open', function() {
		$('.need-help').addClass('hide');
	});

	// Un-hide the help button if the screen panel was closed normally.
	$(document).on('screen:options:close', function() {
		$('.need-help').removeClass('hide');
	});
})( jQuery, alnp_settings_params );
