/* global alnp_settings_params */
;( function ( $, params ) {

	'use strict';

	var alnp_settings_scripts = {};

	$.fn.alnp_settings = function() {

		var $this   = $( this );
		var $form   = $( '.auto-load-next-post form' ),
				changed = false;

		// If already attached, unbind all listeners before reattaching.
		if ( typeof alnp_settings_params !== 'undefined' ) {
			$this.find( '*' ).off();
		}

		init: function() {
			// Ensure alnp_settings_params exists to continue.
			if ( typeof alnp_settings_params === 'undefined' ) {
				return false;
			}

			$form.on( 'input validate change', 'input, select, checkbox, radio', this.validate_field );

			$( 'input, number, email, textarea, select, checkbox, radio' ).change( function() {
				changed = true;
			});

			$( '.nav-tab-wrapper a' ).click( function() {
				if ( changed ) {
					window.onbeforeunload = function() {
						return params.i18n_nav_warning;
					};
				} else {
					window.onbeforeunload = '';
				}
			});

			$( '.submit :input' ).click( function() {
				window.onbeforeunload = '';
			});
		},

		select_all: function() {
			// Select all button
			$( '.auto-load-next-post' ).on( 'click', '.select_all', function() {
				$( this ).closest( 'td' ).find( 'select option' ).attr( 'selected', 'selected' );
				$( this ).closest( 'td' ).find( 'select' ).trigger( 'change' );
				return false;
			});

			// Select none button
			$( '.auto-load-next-post' ).on( 'click', '.select_none', function() {
				$( this ).closest( 'td' ).find( 'select option' ).removeAttr( 'selected' );
				$( this ).closest( 'td' ).find( 'select' ).trigger( 'change' );
				return false;
			});

			// Select2 enhanced select fields
			$( '.alnp-enhanced-select' ).select2({
				dir: params.is_rtl,
				minimumResultsForSearch: Infinity,
				placeholder: function() {
					$( this ).data('placeholder');
				}
			});

			$( '.alnp-enhanced-multiselect' ).select2({
				dir: params.is_rtl,
				multiple: true,
				placeholder: function() {
					$( this ).data('placeholder');
				}
			});
		},

		validate_field: function( e ) {
			var $this             = $( this ),
					$parent           = $this.closest( '.form-row' ),
					validated         = true,
					validate_required = $parent.is( '.validate-required' ),
					event_type        = e.type;

			if ( 'input' === event_type ) {
				$parent.removeClass( 'alnp-invalid alnp-invalid-required-field alnp-validated' );
			}

			if ( 'validate' === event_type || 'change' === event_type ) {

				if ( validate_required ) {
					if ( 'checkbox' === $this.attr( 'type' ) && ! $this.is( ':checked' ) ) {
						$parent.removeClass( 'alnp-validated' ).addClass( 'alnp-invalid alnp-invalid-required-field' );
						validated = false;
					} else if ( $this.val() === '' ) {
						$parent.removeClass( 'alnp-validated' ).addClass( 'alnp-invalid alnp-invalid-required-field' );
						validated = false;
					}
				}

				if ( validated ) {
					$parent.removeClass( 'alnp-invalid alnp-invalid-required-field alnp-invalid-email' ).addClass( 'alnp-validated' );
				}
			}
		};

		// Initialize Auto Load Next Post Settings.
		alnp_settings.init();

		// Select All
		alnp_settings.select_all();

		// Validate Field
		alnp_settings.validate_field();
	};

	// Run Auto Load Next Post Settings
	$(this).alnp_settings();

})( jQuery, alnp_settings_params );
