/* global alnp_scanner_params */
( function( $, params ) {

	var step                 = '',
		search_finished      = true,
		saving_results       = false,
		post,
		jc,
		rtl                  = params.is_rtl,
		request_url          = params.ajax_url,
		template_location    = '',
		found_selectors      = 0,
		selectors_undetected = 0,
		content_container    = '',
		post_title           = '',
		post_navigation      = '',
		comment_container    = '';

	if ( rtl == 'rtl' ) {
		rtl = true;
	} else {
		rtl = false;
	}

	// Scan theme
	$('a.scan-button').on('click', function(e) {
		step = $(this).data('step');

		e.preventDefault();

		// 1. Find template location.
		if ( step == 'template-location' ) {
			find_template_location();
		}

		// 2. Load a random post and scan theme selectors.
		if ( step == 'theme-selectors' ) {
			find_theme_selectors();
		}
	});

	// Copy to clipboard.
	$('div.found span.result code, span.location, span.post-tested').on('click', function(e) {
		var $temp = $("<input>");
		var $code = $(this).text();

		$("body").append($temp);
		$temp.val($code).select();
		document.execCommand("copy");
		$temp.remove();

		// Notify user the code has been copied.
		jc = $.dialog({
			icon: 'dashicons dashicons-info',
			title: params.i18n_copied,
			content: '<p><strong>' + $code + '</strong></p>',
			rtl: rtl,
			type: 'blue',
			draggable: false,
			closeIcon: false,
			boxWidth: '500px',
			useBootstrap: false,
		});

		setTimeout( function() {
			if ( jc.isOpen() ) {
				jc.close();
			}
		}, 2000);
	});

	// Rescan a.k.a reset
	$('button.rescan').on('click', function() {
		$(this).prop("disabled", true);

		// Reset variables.
		found_selectors = 0;
		post_navigation = '';
		search_finished = false;

		var loading = $.dialog({
			icon: 'dashicons dashicons-info',
			title: params.i18n_please_wait,
			content: '<p>' +params.i18n_loading_post + '</p>',
			rtl: rtl,
			type: 'blue',
			draggable: false,
			closeIcon: false,
			boxWidth: '500px',
			useBootstrap: false,
		});

		setTimeout( function() {
			loading.close(); // Close dialog.
		}, 4000 );

		scan_theme_selectors( 1000 );
	});

	// Find template location.
	function find_template_location() {
		var $data = {
			action: 'alnp_find_template_location',
		};

		// Show scanning bar.
		$('.enter .meter').show();

		$.get( request_url, $data, function( response ) {
			if ( ! response ) {
				return;
			}

			if ( response !== -1 ) {
				$('.enter .meter').removeClass('blue').removeClass('animate');
			} else {
				$('.enter .meter').removeClass('blue').addClass('red').removeClass('animate');
			}

			setTimeout( function() {
				$('h1').fadeOut().hide(); // Hide heading
				$('.box.enter').removeClass('show-box').fadeOut(); // Hide welcome
				$('.box.template-location-results').addClass('show-box').fadeIn(); // Show results
				step = $('.box').find('a.scan-button:visible').data('step'); // Find next step
	
				// Return results based on response.
				if ( response !== -1 ) {
					$('span.location').text( response );
					$('.template-location.debug-mode').show(); // Show template directory if debug mode was enabled.

					$('p.template-found').fadeIn().show();
				} else {
					$('p.no-template-found').fadeIn().show();
					$('a.button-doc').fadeIn().show();
				}
			}, 1400);
		});
	}

	// Find theme selectors.
	function find_theme_selectors() {
		// Show scanning bar
		$('.template-location-results .meter').show();

		scan_theme_selectors( 1400 );
	}

	function scan_theme_selectors( timeout ) {
		$.get( params.random_page, function( response ) {
			if ( ! response ) {
				return;
			}

			if ( response !== -1 ) {
				$('.template-location-results .meter').removeClass('blue').removeClass('animate');
			} else {
				$('.template-location-results .meter').removeClass('blue').addClass('red').removeClass('animate');
			}

			setTimeout( function() {
				search_finished = false;

				$('.box.template-location-results').removeClass('show-box').fadeOut();
				$('.box.theme-selector-results').addClass('show-box').fadeIn();

				if ( response !== -1 ) {
					post = $( "<div>" + response + "</div>" );
				}

				post = post.html(); // Set HTML data returned.

				if ( post != '' ) {
					jc = $.dialog({
						icon: 'dashicons dashicons-search',
						title: params.i18n_scanning_theme,
						content: '<p>' + params.i18n_scanning_theme_content + '</p>',
						rtl: rtl,
						type: 'orange',
						draggable: false,
						closeIcon: false,
						boxWidth: '500px',
						useBootstrap: false,
					});

					window.setTimeout(checkPendingRequest, 8000);

					$('span.post-tested').text( params.random_page );

					search_elements( 'alnp_get_container_selectors' );
					search_elements( 'alnp_get_title_selectors' );
					search_elements( 'alnp_get_post_navigation_selectors' );
					search_elements( 'alnp_get_comment_selectors' );

					$('button.rescan').prop("disabled", false);
				}
			}, timeout);
		});
	}

	// Searches the theme selectors by element requested.
	function search_elements( action ) {
		$.ajax({
			method: "GET",
			url: request_url + '?action=' + action,
			dataType: 'json',
			success: function( data ) {
				$(data).each( function( index, selector ) {
					var element = $(post).find(selector);

					// Check if element was found in post.
					if ( element.length > 0 ) {
						if ( action == 'alnp_get_container_selectors' && content_container == '' ) {
							$('.selectors').find('.container').removeClass('pending').addClass('found');
							$('.results-found').find('.container').addClass('found');
							$('.results-found').find('.container span.result').html('<code title="' + params.i18n_copy_title + '">' + selector + '</code>');
							content_container = selector;
							found_selectors = found_selectors+1;
						}

						if ( action == 'alnp_get_title_selectors' && post_title == '' ) {
							$('.selectors').find('.title').removeClass('pending').addClass('found');
							$('.results-found').find('.title').addClass('found');
							$('.results-found').find('.title span.result').html('<code title="' + params.i18n_copy_title + '">' + selector + '</code>');
							post_title = selector;
							found_selectors = found_selectors+1;
						}

						if ( action == 'alnp_get_post_navigation_selectors' && post_navigation == '' ) {
							$('.results-available').fadeIn('fast');
							$('.selectors').find('.navigation').removeClass('pending').addClass('found');
							$('.results-found').find('.navigation').addClass('found');
							$('.results-found').find('.navigation span.result').html('<code title="' + params.i18n_copy_title + '">' + selector + '</code>');
							post_navigation = selector;
							found_selectors = found_selectors+1;
						}

						if ( action == 'alnp_get_comment_selectors' && comment_container == '' ) {
							$('.selectors').find('.comments').removeClass('pending').addClass('found');
							$('.results-found').find('.comments').addClass('found');
							$('.results-found').find('.comments span.result').html('<code title="' + params.i18n_copy_title + '">' + selector + '</code>');
							comment_container = selector;
							found_selectors = found_selectors+1;
						}

						/*if ( found_selectors > 1 ) {
							$('.found-selectors').text(found_selectors);
						} else {
							jc.setContentAppend( '<p><span class="found-selectors">' + found_selectors + '</span> selector found!</p>' );
						}*/
					}
					else {
						if ( action == 'alnp_get_container_selectors' && content_container == '' ) {
							$('.results-found').find('.container').removeClass('pending').addClass('not-found');
							selectors_undetected = selectors_undetected+1;
						}

						if ( action == 'alnp_get_title_selectors' && post_title == '' ) {
							$('.results-found').find('.title').removeClass('pending').addClass('not-found');
							$('.results-found').find('.title span.result').html('Unable to detect a post title. <a href="https://github.com/autoloadnextpost/alnp-documentation/blob/master/en_US/post-title.md" class="help-tip" target="_blank" title="Click to view documenation on post title" aria-label="View documenation on post title">?</a>');
							selectors_undetected = selectors_undetected+1;
						}

						if ( action == 'alnp_get_post_navigation_selectors' && post_navigation == '' ) {
							$('.no-post-navigation').fadeIn('fast');
							$('.results-found').find('.navigation').removeClass('pending').addClass('not-found');
							$('.results-found').find('.navigation span.result').html('Unable to detect a post navigation. <a href="https://github.com/autoloadnextpost/alnp-documentation/blob/master/en_US/post-navigation.md" class="help-tip" target="_blank" title="Click to view documenation on post navigation" aria-label="View documenation on post navigation">?</a>');
							selectors_undetected = selectors_undetected+1;
						}

						if ( action == 'alnp_get_comment_selectors' && comment_container == '' ) {
							$('.results-found').find('.comments').removeClass('pending').addClass('not-found');
							selectors_undetected = selectors_undetected+1;
						}

					}

				});
			}
		});
	} // END search_elements()

	// Save setting
	function save_setting( setting, value ) {
		$.post( request_url, {
			action: 'alnp_set_setting',
			setting: setting,
			value: value,
		}).done( function( response ) {
			if ( ! response ) {
				console.log( 'No response!' );
				return;
			}

			console.log( 'Setting: ' + setting + ' saved!' );
		});
	}
	
	function checkPendingRequest() {
		if ( $.active > 0 ) {
			window.setTimeout(checkPendingRequest, 8000);
		}
		else {
			search_finished = true;
			saving_results  = true;
		}

		// Search is finished?
		if ( search_finished ) {
			$('.theme-selectors.debug-mode').show(); // Show results if debug mode was enabled.

			// Congratulate user.
			if ( found_selectors == 4 && selectors_undetected == 0 ) {
				$('.setup-complete').show();
				$('.rescan').hide(); // Hide scan again button.
			}

			// Warn user some selectors where not detected.
			if ( selectors_undetected > 1 ) {
				$('.theme-selectors-undetected').show();
			}

			// Check if any dialogs are open.
			if ( jc.isOpen() ) {
				if ( found_selectors < 4 && post_navigation == '' ) {
					jc.close(); // Close previous dialogs first.

					jc = $.dialog({
						icon: 'dashicons dashicons-warning',
						title: params.i18n_post_nav_missing,
						content: '<p>' + params.i18n_error_post_nav + '</p>',
						rtl: rtl,
						type: 'red',
						draggable: false,
						closeIcon: true,
						boxWidth: '500px',
						useBootstrap: false,
					});
				}
				else {
					jc.close(); // Close dialog.
				}
			}
		}

		// Are we saving?
		if ( saving_results ) {

			if ( found_selectors > 0 ) {
				if ( content_container != '' ) save_setting( 'content_container', content_container );
				if ( post_title != '' ) save_setting( 'title_selector', post_title );
				if ( post_navigation != '' ) save_setting( 'navigation_container', post_navigation );
				if ( comment_container != '' ) save_setting( 'comments_container', comment_container );

				// Check if any dialogs are open.
				/*if ( jc.isOpen() ) {
					jc.close(); // Close dialog.
				}*/
			}
		}
	}

})( jQuery, alnp_scanner_params );
