// Variables
var content_container   = auto_load_next_post_params.alnp_content_container;
var post_title_selector = auto_load_next_post_params.alnp_title_selector;
var nav_container       = auto_load_next_post_params.alnp_navigation_container;
var comments_container  = auto_load_next_post_params.alnp_comments_container;
var remove_comments     = auto_load_next_post_params.alnp_remove_comments;
var track_pageviews     = auto_load_next_post_params.alnp_google_analytics;
var curr_url            = window.location.href;

jQuery.noConflict();

jQuery( document ).ready( function() {
	// Don't do this if looking for comments.
	if ( window.location.href.indexOf( '#comments' ) > -1 ) {
		return;
	}

	// It's up to you if you want to hide the comments. If the answer is yes then the comments will be gone.
	if ( remove_comments === 'yes' ) {
		jQuery( comments_container ).remove(); // Remove Comments
		if ( jQuery( comments_container ).length <= 0 ) {
			console.log( 'Comments Removed' );
		}
	}

	// Add a divider
	jQuery( content_container ).prepend( '<hr style="height: 0" class="post-divider" data-title="' + window.document.title + '" data-url="' + window.location.href + '"/>' );

	// Initialise Scrollspy
	initialise_scrollspy();

	// Initialise History
	initialise_history();
}); // END document()

function initialise_scrollspy() {
	scrollspy();
} // END initialise_scrollspy()

function initialise_history() {
	history();
} // END initialise_history()

function scrollspy() {
	// Spy on post-divider - changes the URL in browser location, loads new post
	jQuery( '.post-divider').on( 'scrollSpy:exit', changeURL );
	jQuery( '.post-divider').on( 'scrollSpy:enter', changeURL );
	jQuery( '.post-divider').scrollSpy();
} // END scrollspy()

function history() {
	// Bind to StateChange Event
	History.Adapter.bind( window,'statechange', function() { // Note: We are using statechange instead of popstate
		var State = History.getState(); // Note: We are using History.getState() instead of event.state

		if ( State.url != curr_url ) {
			window.location.reload(State.url);
		}
	});
} // END history()

function changeURL() {
	var el         = jQuery(this);
	var this_url   = el.attr( 'data-url' );
	var this_title = el.attr( 'data-title' );
	var offset     = el.offset();
	var scrollTop  = jQuery(document).scrollTop();

	// If exiting or entering from top, change URL
	if ( ( offset.top - scrollTop ) < 150 && curr_url != this_url ) {
		curr_url = this_url;
		History.pushState(null, this_title, this_url);
		//window.document.title = this_title;

		// Are we tracking the page view?
		if ( track_pageviews == 'yes' ) {
			console.log( 'Google Analytics Tracking Enabled' );
			update_google_analytics();
		} // END if track_pageviews
	}

	// Look for the next post to load if any.
	auto_load_next_post();

} // END changeURL()

/**
 * This function tracks the page views using Google Analytics.
 *
 * It will first detect if Google Analytics is installed before
 * attempting to send a pageview.
 *
 * The tracker detects both classic and universal tracking methods.
 *
 * Also supports Google Analytics by Yoast should it be used.
 */
function update_google_analytics() {
	if ( typeof pageTracker === "undefined" && typeof _gaq === 'undefined' && typeof ga === 'undefined' && typeof __gaTracker === 'undefined' ) {
		console.error( 'Google Analytics was not found installed on your site!' );
		return;
	}

	var track_page_url = window.location.pathname;
	console.log( 'Track: ' + track_page_url );

	// This uses Asynchronous version of Google Analytics tracking method.
	if ( typeof pageTracker !== "undefined" && pageTracker !== null ) {
		console.log( 'Google Analytics is installed, but old.' );
		pageTracker._trackPageview( track_page_url );
	}

	// This uses Google's classic Google Analytics tracking method.
	if ( typeof _gaq !== 'undefined' && _gaq !== null ) {
		console.log( 'Google Analytics is installed. Yahoo!' );
		_gaq.push(['_trackPageview', track_page_url]);
	}

	// This uses Google Analytics Universal Analytics tracking method.
	if ( typeof ga !== 'undefined' && _ga !== null ) {
		console.log( 'Google Analytics Universal Analytics is installed. Yahoo!' );
		ga( 'send', 'pageview', track_page_url);
	}

	// This uses Yoast's method of tracking Google Analytics.
	if ( typeof __gaTracker !== 'undefined' && __gaTracker !== null ) {
		console.log( 'Google Analytics by Yoast is installed. Awesome!' );
		__gaTracker( 'send', 'pageview', track_page_url);
	}
} // END update_google_analytics()

/**
 * This is the main function.
 */
function auto_load_next_post() {
	// Grab the url for the next post
	var post_url = jQuery( 'a[rel="prev"]').attr( 'href' );

	// For some browsers, `post_url` is undefined; for others,
	// `post_url` is false. So we check for both possibilites.
	if ( typeof post_url !== typeof undefined && post_url !== false ) {
		console.log( 'Post URL was defined. All is good.' );
		console.log( 'Next Post URL: ' + post_url );
	} else {
		console.error( 'Post URL was not defined. Oh dear!' );
	}

	if ( !post_url ) return;

	// Check to see if pretty permalinks, if not then add partial=1
	if ( post_url.indexOf( '?p=' ) > -1 ) {
		np_url = post_url + '&partial=1'
	} else {
		var partial_endpoint = 'partial/';

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

		data = post.html(); // Return the HTML data of the next post that was loaded.

		var post_html  = jQuery( '<hr class="post-divider" data-url="' + post_url + '"/>' + data );
		var post_title = post_html.find( post_title_selector );

		console.log( 'Post Title: ' + post_title.text() ); // Console Log Post Title

		jQuery( content_container ).append( post_html ); // Add next post

		// get the HR element and add the data-title
		jQuery( 'hr[data-url="' + post_url + '"]').attr( 'data-title' , post_title.text() ).css( 'display', 'inline-block' );

		// need to set up ScrollSpy on new content
		scrollspy();

		// notify others
		jQuery( 'body').trigger( 'alnpNewPostLoaded' );
	});

} // END auto_load_next_post()
