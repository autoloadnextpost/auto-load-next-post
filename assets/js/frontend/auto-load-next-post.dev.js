// Variables
var version             = auto_load_next_post_params.alnp_version;
var content_container   = auto_load_next_post_params.alnp_content_container;
var post_title_selector = auto_load_next_post_params.alnp_title_selector;
var nav_container       = auto_load_next_post_params.alnp_navigation_container;
var comments_container  = auto_load_next_post_params.alnp_comments_container;
var remove_comments     = auto_load_next_post_params.alnp_remove_comments;
var track_pageviews     = auto_load_next_post_params.alnp_google_analytics;
var is_customizer       = auto_load_next_post_params.alnp_is_customizer;
var post_title          = window.document.title;
var curr_url            = window.location.href;
var orig_curr_url       = window.location.href;
var post_count          = 0;
var stop_reading        = false;
var scroll_up           = false;
var article_container   = 'article';

jQuery.noConflict();

jQuery( document ).ready( function() {
	// Ensure auto_load_next_post_params exists to continue.
	if ( typeof auto_load_next_post_params === 'undefined' ) {
		return false;
	}

	// Ensure the main required selectors are set before continuing.
	if ( content_container.length < 0 ) {
		console.error( 'Auto Load Next Post requires that you set the content container selector.' );
		return false;
	}

	if ( post_title_selector.length < 0 ) {
		console.error( 'Auto Load Next Post requires that you set the post title selector.' );
		return false;
	}

	if ( nav_container.length < 0 ) {
		console.error( 'Auto Load Next Post requires that you set the post navigation container selector.' );
		return false;
	}

	if ( jQuery( 'article' ).length == 0 ) {
		console.log( 'HTML5 semantics for article has not been found. Setting compatible HTML semantic.' );
		article_container = 'div';
	}

	if ( is_customizer == 'yes' ) {
		console.log( 'You are previewing with the customizer.' );
	}

	console.log( 'Auto Load Next Post is version: ' + version );

	// Don't do anything if post was loaded looking for comments.
	if ( orig_curr_url.indexOf( '#comments' ) > -1 || orig_curr_url.match(/#comment-*([0-9]+)/) ) {
		console.log( 'Auto Load Next Post is disabled while loading a post to view comments' );
		return;
	}

	// Add a post divider.
	jQuery( content_container ).prepend( '<hr style="height:0px;margin:0px;padding:0px;border:none;" data-powered-by="alnp" data-initial-post="true" data-title="' + post_title + '" data-url="' + orig_curr_url + '"/>' );

	// Mark the first article as the initial post.
	jQuery( content_container ).find( article_container ).attr( 'data-initial-post', true );

	// Find the post ID of the initial loaded article.
	var initial_post_id = jQuery( content_container ).find( article_container ).attr( 'id' );

	// Apply post ID to the first post divider if found.
	if ( typeof initial_post_id !== 'undefined' && initial_post_id.length > 0 ) {
		initial_post_id = initial_post_id.replace( 'post-', '' ); // Make sure that only the post ID remains.
		console.log( 'Initial Post ID: ' + initial_post_id );
		jQuery( content_container ).find( 'article[data-initial-post]' ).prev().attr( 'data-post-id', initial_post_id );
	}

	console.log( 'Post Count: ' + post_count );

	// Remove Comments.
	if ( remove_comments === 'yes' ) {
		jQuery( comments_container ).remove();
		if ( jQuery( comments_container ).length <= 0 ) {
			console.log( 'Comments have been removed' );
		}
	}

	// Initialise scrollSpy
	scrollspy();

	jQuery( 'body' ).on( 'alnp-enter', function( e ) {
		console.log( 'Entering new post' );
	});

	jQuery( 'body' ).on( 'alnp-leaving', function( e ) {
		console.log( 'Leaving post' );
	});

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
	jQuery( 'body' ).on( 'alnp-post-changed', function( e, post_title, post_url, post_id, post_count, stop_reading ) {
		if ( track_pageviews != 'yes' ) {
			return;
		}

		// If we are previewing in the customizer then dont track.
		if ( is_customizer == 'yes' ) {
			console.log( 'Google Analytics tracking is disabled when previewing in the customizer.' );
			return;
		}

		console.log( 'Google Analytics tracking is enabled' );

		if ( typeof pageTracker === "undefined" && typeof _gaq === 'undefined' && typeof ga === 'undefined' && typeof __gaTracker === 'undefined' ) {
			console.error( 'Google Analytics was not found installed on your site!' );
			return;
		}

		console.log( 'Post URL before clean: ' + post_url );

		// Clean Post URL before tracking.
		post_url = post_url.replace(/https?:\/\/[^\/]+/i, '');

		console.log( 'Post URL after clean: ' + post_url );

		// This uses Asynchronous version of Google Analytics tracking method.
		if ( typeof pageTracker !== "undefined" && pageTracker !== null ) {
			console.log( 'Google Analytics is installed, but very old. Highly recommend upgrading GA!' );
			pageTracker._trackPageview( post_url );
		}

		// This uses Google's classic Google Analytics tracking method.
		if ( typeof _gaq !== 'undefined' && _gaq !== null ) {
			console.log( 'Google Analytics is installed but you are using a classic version. Recommend upgrading!' );
			_gaq.push(['_trackPageview', post_url]);
		}

		// This uses Google Analytics Universal Analytics tracking method.
		if ( typeof ga !== 'undefined' && ga !== null ) {
			console.log( 'Google Analytics Universal Analytics is installed. Yahoo!' );
			ga( 'send', 'pageview', post_url );
		}

		// This uses Monster Insights method of tracking Google Analytics.
		if ( typeof __gaTracker !== 'undefined' && __gaTracker !== null ) {
			console.log( 'Google Analytics by MonsterInsights is installed. Awesome!' );
			__gaTracker( 'send', 'pageview', post_url );
		}
	});

	// If the browser back button is pressed or the user scrolled up then change history state.
	jQuery( 'body' ).on( 'mousewheel', function( e ) {
		scroll_up = e.originalEvent.wheelDelta > 0;
	});

	// Update the History ONLY if we are NOT in the customizer.
	if ( ! is_customizer ) {
		// Note: We are using statechange instead of popstate
		History.Adapter.bind( window, 'statechange', function() {
			var state = History.getState(); // Note: We are using History.getState() instead of event.state

			console.log(state);

			// If they returned back to the first post, then when you click the back button go to the url from which they came.
			if ( scroll_up ) {
				var states = History.savedStates;
				var prev_state_index = states.length - 2;
				var prev_state = states[prev_state_index];

				console.log( 'Previous URL: ', prev_state.url );

				if ( prev_state.url === orig_curr_url ) {
					window.location = document.referrer;
					return;
				}
			}

			// If the previous URL does not match the current URL then go back.
			if ( state.url != curr_url ) {
				var previous_post = jQuery( 'hr[data-url="' + state.url + '"]' ).next( article_container ).find( post_title_selector );

				// Is there a previous post?
				if ( previous_post.length > 0 ) {
					var previous_post_title = previous_post[0].dataset.title;
					console.log( 'Previous Post: ' + previous_post_title );

					History.pushState(null, previous_post_title, state.url);

					// Scroll to the top of the previous article.
					jQuery( 'html, body' ).animate({ scrollTop: (previous_post.offset().top - 100) }, 1000, function() {
						jQuery( 'body' ).trigger( 'alnp-previous-post', [ previous_post ] );
					});
				}
			}
		});
	}

}); // END document()

/**
 * ScrollSpy.
 *
 * 1. Load a new post once the post comes near the end.
 * 2. If a new post has loaded and come into view, change the URL in the browser
 *    address bar and the post title for history.
 *
 * This is done by looking for the post divider.
 */
function scrollspy() {
	// Do not enter once the initial post has loaded.
	if ( post_count > 0 ) {
		jQuery( 'hr[data-powered-by="alnp"]' ).on( 'scrollSpy:enter', alnp_enter );
	}

	jQuery( 'hr[data-powered-by="alnp"]' ).on( 'scrollSpy:exit', alnp_leave ); // Loads next post.
	jQuery( 'hr[data-powered-by="alnp"]' ).scrollSpy();
} // END scrollspy()

// Entering a post
function alnp_enter() {
	var divider = jQuery(this);

	jQuery( 'body' ).trigger( 'alnp-enter', [ divider ] );

	changePost( divider, 'enter' );
} // END alnp_enter()

// Leaving a post
function alnp_leave() {
	var divider = jQuery(this);

	jQuery( 'body' ).trigger( 'alnp-leave', [ divider ] );

	changePost( divider, 'leave' );
} // END alnp_leave()

// Change Post
function changePost( divider, $direction ) {
	var el           = jQuery(divider);
	var this_url     = el.attr( 'data-url' );
	var this_title   = el.attr( 'data-title' );
	var this_post_id = el.attr( 'data-post-id' );
	var initial_post = el.attr( 'data-initial-post' );
	var offset       = el.offset();
	var scrollTop    = jQuery( document ).scrollTop();

	// If exiting or entering from the top, then change the URL.
	if ( ( offset.top - scrollTop ) <= 200 && curr_url != this_url ) {
		curr_url = this_url;

		// Update the History ONLY if we are NOT in the customizer.
		if ( ! is_customizer ) {
			History.pushState(null, this_title, this_url);
		}

		jQuery( 'body' ).trigger( 'alnp-post-changed', [ this_title, this_url, this_post_id, post_count, stop_reading, initial_post ] );
	}

	console.log( 'Direction: ' + $direction);

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

	// Grab the url for the next post in the post navigation.
	var post_url = jQuery( nav_container ).find( 'a[rel="prev"]').attr( 'href' );

	// If the post url returns nothing then try finding the alternative and set that as the next post.
	if ( !post_url ) {
		post_url = jQuery( nav_container ).find( 'a[rel="previous"]').attr( 'href' );
	}

	// If we are in the customizer then clean the post url before fetching the post.
	if ( is_customizer == 'yes' ) {
		post_url = post_url.substring(0, post_url.indexOf("?"));
	}

	// Override the post url via a trigger.
	jQuery( 'body' ).trigger( 'alnp-post-url', [ post_count, post_url ] );

	// For some browsers, `post_url` is undefined; for others,
	// `post_url` is false. So we check for both possibilites.
	if ( typeof post_url !== typeof undefined && post_url !== false ) {
		console.log( 'Post URL was defined. Next Post URL: ' + post_url );
	} else {
		console.error( 'Unable to find another post to load!' );
	}

	// If the post navigation is not found then dont continue.
	if ( !post_url ) return;

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
	jQuery( nav_container ).remove();
	if ( jQuery( nav_container ).length <= 0 ) {
		console.log( 'Post Navigation Removed!' );
	}

	jQuery.get( np_url , function( data ) {
		var post = jQuery( "<div>" + data + "</div>" );

		// Allows the post data to be modified before being appended.
		jQuery( 'body' ).trigger( 'alnp-post-data', [ post ] );

		data = post.html(); // Returns the HTML data of the next post that was loaded.

		var post_divider = '<hr style="height:0px;margin:0px;padding:0px;border:none;" data-powered-by="alnp" data-initial-post="false" data-url="' + post_url + '"/>';
		var post_html    = jQuery( post_divider + data );
		var post_title   = post_html.find( post_title_selector ); // Find the post title of the loaded article.
		var post_ID      = jQuery( post ).find( article_container ).attr( 'id' ); // Find the post ID of the loaded article.

		if ( typeof post_ID !== typeof undefined && post_ID !== "" ) {
			post_ID = post_ID.replace( 'post-', '' ); // Make sure that only the post ID remains.
			console.log( 'Post ID: ' + post_ID );
		} else {
			console.error( 'Post ID was not found.' );
		}

		// Check if the post title exists.
		if ( post_title.length > 0 ) {
			console.log( 'Post Title: ' + post_title.text() );
		} else {
			console.log( 'Post title was not found!' );
		}

		jQuery( content_container ).append( post_html ); // Add next post.

		jQuery( article_container + '[id="post-' + post_ID + '"]' ).attr( 'data-initial-post', false ); // Set article as not the initial post.

		// Remove Comments.
		if ( remove_comments === 'yes' ) {
			jQuery( comments_container ).remove();
			if ( jQuery( comments_container ).length <= 0 ) {
				console.log( 'Comments Removed' );
			}
		}

		// Get the hidden "HR" element and add the missing post title and post id attributes.
		jQuery( 'hr[data-url="' + post_url + '"]').attr( 'data-title', post_title.text() ).attr( 'data-post-id', post_ID );

		scrollspy(); // Need to set up ScrollSpy now that the new content has loaded.

		post_count = post_count+1; // Updates the post count.
		console.log( 'Post Count: ' + post_count );

		// Run an event once the post has loaded.
		jQuery( 'body' ).trigger( 'alnp-post-loaded', [ post_title.text(), post_url, post_ID, post_count ] );
	});

} // END auto_load_next_post()
