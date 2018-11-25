// Variables
var version             = auto_load_next_post_params.alnp_version;
var content_container   = auto_load_next_post_params.alnp_content_container;
var post_title_selector = auto_load_next_post_params.alnp_title_selector;
var nav_container       = auto_load_next_post_params.alnp_navigation_container;
var comments_container  = auto_load_next_post_params.alnp_comments_container;
var remove_comments     = auto_load_next_post_params.alnp_remove_comments;
var track_pageviews     = auto_load_next_post_params.alnp_google_analytics;
var is_customizer       = auto_load_next_post_params.alnp_is_customizer;
var event_on_load       = auto_load_next_post_params.alnp_event_on_load;
var event_on_entering   = auto_load_next_post_params.alnp_event_on_entering;
var post_title          = window.document.title;
var curr_url            = window.location.href;
var orig_curr_url       = window.location.href;
var post_count          = 0;
var post_url            = curr_url;
var overridden_post_url = '';
var stop_reading        = false;
var scroll_up           = false;
var article_container   = 'article';

jQuery( document ).ready( function($) {

	// Ensure auto_load_next_post_params exists to continue.
	if ( typeof auto_load_next_post_params === 'undefined' ) {
		return false;
	}

	// Ensure the main required selectors are set before continuing.
	if ( content_container.length < 0 ) {
		return false;
	}

	if ( post_title_selector.length < 0 ) {
		return false;
	}

	if ( nav_container.length < 0 ) {
		return false;
	}

	if ( $( 'article' ).length == 0 ) {
		article_container = 'div';
	}

	// Don't do anything if post was loaded looking for comments.
	if ( orig_curr_url.indexOf( '#comments' ) > -1 || orig_curr_url.match(/#comment-*([0-9]+)/) ) {
		return;
	}

	// Don't do anything if post was loaded to post a comment.
	if ( orig_curr_url.indexOf( '#respond' ) > -1 ) {
		return;
	}

	// Add a post divider.
	$( content_container ).prepend( '<hr style="height:0px;margin:0px;padding:0px;border:none;" data-powered-by="alnp" data-initial-post="true" data-title="' + post_title + '" data-url="' + orig_curr_url + '"/>' );

	// Mark the first article as the initial post.
	$( content_container ).find( article_container ).attr( 'data-initial-post', true );

	// Find the post ID of the initial loaded article.
	var initial_post_id = $( content_container ).find( article_container ).attr( 'id' );

	// Apply post ID to the first post divider if found.
	if ( typeof initial_post_id !== 'undefined' && initial_post_id.length > 0 ) {
		initial_post_id = initial_post_id.replace( 'post-', '' ); // Make sure that only the post ID remains.
		$( content_container ).find( 'article[data-initial-post]' ).prev().attr( 'data-post-id', initial_post_id );
	}

	// Remove Comments.
	if ( remove_comments === 'yes' ) {
		$( comments_container ).remove();
	}

	// Initialise scrollSpy
	scrollspy();

	/**
	 * Track pageviews with Google Analytics.
	 *
	 * It will first detect if Google Analytics is installed before
	 * attempting to send a pageview.
	 *
	 * The tracker detects both classic and universal tracking methods.
	 *
	 * Also supports Google Analytics by Monster Insights should it be used.
	 */
	$( 'body' ).on( 'alnp-post-changed', function( e, post_title, post_url, post_id, post_count, stop_reading ) {
		if ( track_pageviews != 'yes' ) {
			return;
		}

		// If we are previewing in the customizer then dont track.
		if ( is_customizer == 'yes' ) {
			return;
		}

		if ( typeof _gaq === 'undefined' && typeof ga === 'undefined' && typeof __gaTracker === 'undefined' ) {
			return;
		}

		// Clean Post URL before tracking.
		post_url = post_url.replace(/https?:\/\/[^\/]+/i, '');

		// This uses Google's classic Google Analytics tracking method.
		if ( typeof _gaq !== 'undefined' && _gaq !== null ) {
			_gaq.push(['_trackPageview', post_url]);
		}

		// This uses Google Analytics Universal Analytics tracking method.
		if ( typeof ga !== 'undefined' && ga !== null ) {
			ga( 'send', 'pageview', post_url );
		}

		// This uses Monster Insights method of tracking Google Analytics.
		if ( typeof __gaTracker !== 'undefined' && __gaTracker !== null ) {
			__gaTracker( 'send', 'pageview', post_url );
		}
	});

	// If the browser back button is pressed or the user scrolled up then change history state.
	$( 'body' ).on( 'mousewheel', function( e ) {
		scroll_up = e.originalEvent.wheelDelta > 0;
	});

	// Update the History ONLY if we are NOT in the customizer.
	if ( ! is_customizer ) {
		// Note: We are using statechange instead of popstate
		History.Adapter.bind( window, 'statechange', function() {
			var state = History.getState(); // Note: We are using History.getState() instead of event.state

			// If they returned back to the first post, then when you click the back button go to the url from which they came.
			if ( scroll_up ) {
				var states = History.savedStates;
				var prev_state_index = states.length - 2;
				var prev_state = states[prev_state_index];

				if ( prev_state.url === orig_curr_url ) {
					window.location = document.referrer;
					return;
				}
			}

			// If the previous URL does not match the current URL then go back.
			if ( state.url != curr_url ) {
				var previous_post = $( 'hr[data-url="' + state.url + '"]' ).next( article_container ).find( post_title_selector );

				// Is there a previous post?
				if ( previous_post.length > 0 ) {
					var previous_post_title = previous_post[0].dataset.title;

					History.pushState(null, previous_post_title, state.url);

					// Scroll to the top of the previous article.
					$( 'html, body' ).animate({ scrollTop: (previous_post.offset().top - 100) }, 1000, function() {
						$( 'body' ).trigger( 'alnp-previous-post', [ previous_post ] );
					});
				}
			}
		});
	}

	/**
	 * ScrollSpy.
	 *
	 * 1. Load a new post once the post comes near the end.
	 * 2. If a new post has loaded and comes into view, change the URL in the browser
	 *    address bar and the post title for history.
	 *
	 * This is done by looking for the post divider.
	 */
	function scrollspy() {
		// Do not enter once the initial post has loaded.
		if ( post_count > 0 ) {
			$( 'hr[data-powered-by="alnp"]' ).on( 'scrollSpy:enter', alnp_enter );
		}

		$( 'hr[data-powered-by="alnp"]' ).on( 'scrollSpy:exit', alnp_leave ); // Loads next post.
		$( 'hr[data-powered-by="alnp"]' ).scrollSpy();
	} // END scrollspy()

	// Trigger multiple events
	function triggerEvents(events, params) {
		if (typeof events !== 'string') return;

		var body = jQuery( 'body' );

		events = events.split(',');

		for (var i = 0; i < events.length; i++) {
			//support all browsers, "replace" instead of "trim"
			events[i] = events[i].replace(/^\s\s*/, '').replace(/\s\s*$/, '');
			body.trigger(events[i], params);
		}

		return this;
	}

	// Entering a post
	function alnp_enter() {
		var divider = $(this);

		$( 'body' ).trigger( 'alnp-enter', [ divider ] );

		triggerEvents(event_on_entering, [ divider ]);

		changePost( divider, 'enter' );
	} // END alnp_enter()

	// Leaving a post
	function alnp_leave() {
		var divider = $(this);

		$( 'body' ).trigger( 'alnp-leave', [ divider ] );

		changePost( divider, 'leave' );
	} // END alnp_leave()

	// Change Post
	function changePost( divider, $direction ) {
		var el           = $(divider);
		var this_url     = el.attr( 'data-url' );
		var this_title   = el.attr( 'data-title' );
		var this_post_id = el.attr( 'data-post-id' );
		var initial_post = el.attr( 'data-initial-post' );
		var offset       = el.offset();
		var scrollTop    = $( document ).scrollTop();

		// If exiting or entering from the top, then change the URL.
		if ( ( offset.top - scrollTop ) <= 200 && curr_url != this_url ) {
			curr_url = this_url;

			// Update the History ONLY if we are NOT in the customizer.
			if ( ! is_customizer ) {
				History.pushState(null, this_title, this_url);
			}

			$( 'body' ).trigger( 'alnp-post-changed', [ this_title, this_url, this_post_id, post_count, stop_reading, initial_post ] );
		}

		// Look for the next post to load if any when leaving previous post.
		if ( $direction == 'leave' ) {
			auto_load_next_post();
		}
	} // END changePost()

	/**
	 * This is the main function.
	 */
	function auto_load_next_post() {
		// If the user can not read any more then stop looking for new posts.
		if ( stop_reading ) {
			return;
		}

		// Reset the overridden post URL.
		overridden_post_url = '';

		// Grab the url for the next post in the post navigation.
		post_url = $( nav_container ).find( 'a[rel="prev"]').attr( 'href' );

		// If the post url returns nothing then try finding the alternative and set that as the next post.
		if ( !post_url ) {
			post_url = $( nav_container ).find( 'a[rel="previous"]').attr( 'href' );
		}

		// If we are in the customizer then clean the post url before fetching the post.
		if ( is_customizer == 'yes' ) {
			post_url = post_url.substring(0, post_url.indexOf("?"));
		}

		// Override the post url via a trigger.
		$( 'body' ).trigger( 'alnp-post-url', [ post_count, post_url ] );

		// If post URL is overridden then update post_url variable.
		if ( overridden_post_url ) {
			post_url = overridden_post_url;
		}

		// If the post navigation is not found then dont continue.
		if ( !post_url ) return;

		// Define next post URL to load.
		var np_url = '';

		// Check to see if pretty permalinks, if not then add alnp=1
		if ( post_url.indexOf( '?p=' ) > -1 ) {
			np_url = post_url + '&alnp=1';
		} else {
			var partial_endpoint = 'alnp/';

			if ( post_url.charAt(post_url.length - 1) != '/' )
				partial_endpoint = '/' + partial_endpoint;

			np_url = post_url + partial_endpoint;
		}

		// Remove the post navigation HTML once the next post has loaded.
		$( nav_container ).remove();

		$.get( np_url , function( data ) {
			var post = $( "<div>" + data + "</div>" );

			// Allows the post data to be modified before being appended.
			$( 'body' ).trigger( 'alnp-post-data', [ post ] );

			data = post.html(); // Returns the HTML data of the next post that was loaded.

			var post_divider = '<hr style="height:0px;margin:0px;padding:0px;border:none;" data-powered-by="alnp" data-initial-post="false" data-url="' + post_url + '"/>';
			var post_html    = $( post_divider + data );
			var post_title   = post_html.find( post_title_selector ); // Find the post title of the loaded article.
			var post_ID      = $( post ).find( article_container ).attr( 'id' ); // Find the post ID of the loaded article.
			var triggerParams = [ post_title.text(), post_url, post_ID, post_count ];

			if ( typeof post_ID !== typeof undefined && post_ID !== "" ) {
				post_ID = post_ID.replace( 'post-', '' ); // Make sure that only the post ID remains.
			}

			$( content_container ).append( post_html ); // Add next post.

			$( article_container + '[id="post-' + post_ID + '"]' ).attr( 'data-initial-post', false ); // Set article as not the initial post.

			// Remove Comments.
			if ( remove_comments === 'yes' ) {
				$( comments_container ).remove();
			}

			// Get the hidden "HR" element and add the missing post title and post id attributes.
			$( 'hr[data-url="' + post_url + '"]').attr( 'data-title', post_title.text() ).attr( 'data-post-id', post_ID );

			scrollspy(); // Need to set up ScrollSpy now that the new content has loaded.

			post_count = post_count+1; // Updates the post count.

			// Run an event once the post has loaded.
			$( 'body' ).trigger( 'alnp-post-loaded', triggerParams );

			// Trigger user defined events
			triggerEvents(event_on_load, triggerParams);
		});

	} // END auto_load_next_post()

});
