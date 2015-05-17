// Variables
var content_container   = auto_load_next_post_params.alnp_content_container;
var nav_container       = auto_load_next_post_params.alnp_navigation_container;
var comments_container  = auto_load_next_post_params.alnp_comments_container;
var post_title_selector = auto_load_next_post_params.alnp_title_selector;
var curr_url            = window.location.href;

jQuery.noConflict();

jQuery( document ).ready(function() {
	// Don't do this if looking for comments
	if ( window.location.href.indexOf( '#comments' ) > -1 ) {
		return;
	}

  // It's up to you if you want to hide the comments. If the anwser is yes then the comments will be gone.
	console.log( 'Remove Comments: ' + auto_load_next_post_params.alnp_remove_comments );
	if ( auto_load_next_post_params.alnp_remove_comments === 'yes' ) {
		jQuery( comments_container ).remove(); // Remove Comments
	}

	// Add divider
	jQuery( content_container ).prepend( '<hr style="height: 0" class="post-divider" data-title="' + window.document.title + '" data-url="' + window.location.href + '"/>' );

	initialise_Scrollspy();

	initialise_History();
});

function initialise_Scrollspy() {
	// Spy on post-divider - changes the URL in browser location, loads new post 
	jQuery('.post-divider').on('scrollSpy:exit', changeURL ); 
	jQuery('.post-divider').on('scrollSpy:enter', changeURL );
	jQuery('.post-divider').scrollSpy();
}

function initialise_History() {
	// Bind to StateChange Event
	History.Adapter.bind(window,'statechange',function(){ // Note: We are using statechange instead of popstate
		var State = History.getState(); // Note: We are using History.getState() instead of event.state

		if ( State.url != curr_url ) {
			window.location.reload(State.url);
		}
	});
}

function changeURL() {
	var el         = jQuery(this);
	var this_url   = el.attr('data-url');
	var this_title = el.attr('data-title');
	var offset     = el.offset();
	var scrollTop  = jQuery(document).scrollTop();

	// If exiting or entering from top, change URL 
	if ( ( offset.top - scrollTop ) < 150 && curr_url != this_url) {
		curr_url = this_url;
		History.pushState(null, null, this_url);
		window.document.title = this_title;

		if( auto_load_next_post_params.alnp_google_analytics == 'yes' ) {
			console.log( 'Google Analytics Tracked' );
			update_google_analytics();
		}
	}

	auto_load_next_post();
}

function updategoogle_analytics() {
	if( typeof ga === 'undefined' ) {
		return;
	}

	ga('send', 'pageview', window.location.pathname);
}

function auto_load_next_post() {
	// Grab the url for the next post
	var post_url = jQuery('a[rel="prev"]').attr('href');

	console.log( 'Next Post URL: ' + post_url );

	if ( !post_url ) return;

	// Check to see if pretty permalinks, if not then add partial=1
	if ( post_url.indexOf( '?p=' ) > -1 ) {
		np_url = post_url + '&partial=1'
	} else {
		var partial_endpoint = 'partial/';

		if( post_url.charAt(post_url.length - 1) != '/')
			partial_endpoint = '/' + partial_endpoint;

		np_url = post_url + partial_endpoint;
	}

	// Remove the post navigation HTML once the next post has loaded.
	jQuery( nav_container ).remove();
	console.log( 'Post Navigation Removed!' );

	jQuery.get( np_url , function( data ) { 
		var post = jQuery("<div>" + data + "</div>");

		data = post.html(); // Return the HTML data of the next post that was loaded.

		var post_html  = jQuery( '<hr class="post-divider" data-url="' + post_url + '"/>' + data );
		var post_title = post_html.find( post_title_selector );

		console.log( 'Post Title: ' + post_title.text() ); // Console Log Post Title

		jQuery( content_container ).append( post_html ); // Add next post

		// get the HR element and add the data-title
		jQuery( 'hr[data-url="' + post_url + '"]').attr( 'data-title' , post_title.text() ).css( 'display', 'inline-block' );

		// need to set up ScrollSpy on new content
		initialise_Scrollspy();
	});

}