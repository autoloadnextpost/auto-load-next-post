jQuery(window).load(function(){

	// Edit prompt
	jQuery(function(){
		var changed = false;
		jQuery('input, checkbox').change(function(){
			changed = true;
		});
		jQuery('.nav-tab-wrapper a').click(function(){
			if (changed) {
				window.onbeforeunload = function() {
					return auto_load_next_post_settings_params.i18n_nav_warning;
				}
			}
			else {
				window.onbeforeunload = '';
			}
		});
		jQuery('.submit input').click(function(){
			window.onbeforeunload = '';
		});
	});

	// Chosen selects
	jQuery("select.chosen-select").chosen({
		width: '300px',
		disable_search_threshold: 5
	});

});