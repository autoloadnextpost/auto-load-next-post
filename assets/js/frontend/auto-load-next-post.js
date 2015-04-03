// Variables
var content_container   = auto_load_next_post_params.alnp_content_container;
var nav_container       = auto_load_next_post_params.alnp_navigation_container;
var comments_container  = auto_load_next_post_params.alnp_comments_container;
var post_title_selector = auto_load_next_post_params.alnp_title_selector;
var curr_url            = window.location.href;

jQuery.noConflict();

jQuery(document).ready(function() {
	// Don't do this if looking for comments
	if ( window.location.href.indexOf( '#comments' ) > -1 ) {
		return;
	}

	jQuery(comments_container).hide(); // Hide Comments

	jQuery(content_container).addClass('first-post'); // Add this class to the first post loaded.

	jQuery("p.single__category a").addClass('partner-link');
	jQuery("p.single__category a img").addClass('partner-button');

	// Add divider
	jQuery(content_container).prepend('<hr style="height: 0" class="post-divider" data-title="' + window.document.title + '" data-url="' + window.location.href + '"/>');

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

		if( auto_load_next_post_params.google_analytics == 'yes' ) {
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
	jQuery(nav_container).remove();

	jQuery.get( np_url , function( data ) { 
		var post         = jQuery("<div>" + data + "</div>");
		var num_articles = jQuery('article').length; // Count how many posts have loaded in the DOM.

		// Add Google Ads if article number is reached.
		if ( num_articles == 1 ) {
			post.find('.single__body').before('<aside class="widget-bar"><div class="advr__skyscraper"><ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8098211232650010" data-ad-slot="4038539686" data-ad-format="auto"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script></div></aside>');
			post.find('.single__body').attr('style', null);
		}
		else if( num_articles == 3 ) {
			post.find('.single__body').before('<aside class="widget-bar"><div class="advr__skyscraper"><div id="div-gpt-ad-1423110015755-0"><script type="text/javascript">googletag.cmd.push(function() { googletag.display("div-gpt-ad-1423110015755-0"); });</script></div></div></aside>');
			post.find('.single__body').attr('style', null);
		}
		else if( num_articles == 4 ) {
			post.find('.single__body').before('<aside class="widget-bar"><div class="advr__skyscraper"><div id="div-gpt-ad-1423241757252-0"><script type="text/javascript">googletag.cmd.push(function() { googletag.display("div-gpt-ad-1423241757252-0"); });</script></div></div></aside>');
			post.find('.single__body').attr('style', null);
		}
		else if( num_articles == 2 || num_articles > 4 ) {
			post.find('.single__container').addClass('full__width');
		}

		data = post.html(); // Return the HTML data of the next post that was loaded.

		var post_html  = jQuery( '<hr class="post-divider" data-url="' + post_url + '"/>' + data );
		var post_title = post_html.find( post_title_selector );

		jQuery( 'div.new-content' ).replaceWith( post_html ); // Add next post

		// get the HR element and add the data-title
		jQuery('hr[data-url="' + post_url + '"]').attr( 'data-title' , post_title.text() );

		// need to set up ScrollSpy on new content
		initialise_Scrollspy();

		// Social Buzz
		/*jQuery(".sbTip").tipr({
			speed: 300,
			mode: "top"
		}), sbp_b0cbfa0(), sbp_c7ef48();

		var e = 1500;

		if ( window.sbSettings.counterup == 1 ) {
			jQuery(".sbcountup").counterUp({
				delay: 10,
				time: e
			})
		}*/
	});

}