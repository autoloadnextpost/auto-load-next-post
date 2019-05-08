<?php
/**
 * Auto Load Next Post Template
 *
 * Functions for the templating system.
 *
 * @since    1.6.0
 * @author   Sébastien Dumont
 * @category Core
 * @package  Auto Load Next Post/Functions
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * When the 'alnp' endpoint is used on a singular post it forces
 * the template redirect to retrieve only the post content.
 *
 * @since   1.0.0
 * @version 1.6.0
 * @global  WP_Query $wp_query - The object information defining the current request and determines what type of query it's dealing with. See https://codex.wordpress.org/Class_Reference/WP_Query
 */
if ( ! function_exists( 'alnp_template_redirect' ) ) {
	function alnp_template_redirect() {
		global $wp_query;

		// If this is not a request for alnp or a singular object then bail
		if ( ! isset( $wp_query->query_vars['alnp'] ) || ! is_singular() ) {
			return;
		}

		/**
		 * Load the template file from the theme (child or parent) if one exists.
		 * If theme does not have a template file for Auto Load Next Post,
		 * the plugin will load a default template.
		 */
		$child_path        = get_stylesheet_directory() . '/' . AUTO_LOAD_NEXT_POST_TEMPLATE_PATH;
		$template_path     = get_template_directory() . '/' . AUTO_LOAD_NEXT_POST_TEMPLATE_PATH;
		$default_path      = AUTO_LOAD_NEXT_POST_FILE_PATH;
		$template_redirect = '';

		if ( file_exists( $child_path . 'content-alnp.php' ) ) {
			$template_redirect = $child_path . 'content-alnp.php';
		} else if ( file_exists( $template_path . 'content-alnp.php' ) ) {
			$template_redirect = $template_path . 'content-alnp.php';
		} else if ( file_exists( $default_path . '/templates/content-alnp.php' ) ) {
			$template_redirect = $default_path . '/templates/content-alnp.php';
		}

		$template_redirect = apply_filters( 'alnp_template_redirect', $template_redirect );

		include( $template_redirect );

		exit;
	} // END alnp_template_redirect()
}

/**
 * Adds the comments template after the post content.
 *
 * @since   1.4.8
 * @version 1.5.4
 */
if ( ! function_exists( 'auto_load_next_post_comments' ) ) {
	function auto_load_next_post_comments() {
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
	} // END auto_load_next_post_comments()
}

/**
 * Adds the post navigation for the previous link only after the post content.
 *
 * @since   1.4.8
 * @version 1.5.4
 */
if ( ! function_exists( 'auto_load_next_post_navigation' ) ) {
	function auto_load_next_post_navigation() {
	?>
	<nav class="navigation post-navigation" role="navigation">
		<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'auto-load-next-post' ) . '</span> %title' ); ?></span>
	</nav>
	<?php
	} // END auto_load_next_post_navigation()
}

/**
 * Gets a list of locations as to where the content for the theme is located.
 * The list is in the order to look for the templates that store the content.
 *
 * @since  1.6.0
 * @return array
 */
if ( ! function_exists( 'alnp_get_locations' ) ) {
	function alnp_get_locations() {
		return array(
			'', // Parent theme folder
			'components/',
			'components/post/',
			'components/page/',
			'template-parts/',
			'template-parts/content/',
			'template-parts/post/',
			'template-parts/page/',
			'templates/',
			'partials/',
			'loop-templates/'
		);
	} // END alnp_get_locations()
}

/**
 * Gets a list of templates to look for.
 *
 * @since  1.6.0
 * @param  string $post_type
 * @param  string $post_format
 * @return array
 */
if ( ! function_exists( 'alnp_get_templates' ) ) {
	function alnp_get_templates( $post_type = 'single', $post_format = '' ) {
		$get_standard = array(
			alnp_template_location() . 'content-single.php',
			alnp_template_location() . 'content-post.php',
			alnp_template_location() . 'content-' . $post_type . '.php',
			alnp_template_location() . 'content.php'
		);

		if ( ! empty( $post_format ) ) {
			$get_formats = array(
				alnp_template_location() . 'format-' . $post_format . '.php',
				alnp_template_location() . 'content' . $post_format . '.php'
			);

			return array_merge( $get_standard, $get_formats );
		}

		return $get_standard;
	} // END alnp_get_templates()
}

/**
 * Scans for the theme template depending on the post type requested and saves it.
 *
 * @since 1.6.0
 * @param string $post_type
 * @param string $post_format
 */
if ( ! function_exists( 'alnp_scan_template' ) ) {
	function alnp_scan_template( $post_type = 'single', $post_format = '' ) {
		// Possible locations where the content files are found.
		$locations = alnp_get_locations();

		// Templates to look for based on the post that is loaded.
		$templates = alnp_get_templates( $post_type, $post_format );

		$content_found = false;

		// Scanning all possible locations.
		foreach( $locations as $location ) {
			// Scanning all possible templates within the locations.
			foreach( $templates as $template ) {
				// If a template has been found then save it.
				if ( locate_template( $location . $template ) != '' && $content_found != true ) {
					$save_location = $location . $template;

					// Save template found.
					if ( ! empty( $post_format ) ) {
						add_option( 'auto_load_next_post_template_single_' . $post_format, $save_location );
					} else {
						add_option( 'auto_load_next_post_template_' . $post_type, $save_location );
					}

					$content_found = true;
				}
			}
		}
	} // END alnp_scan_template()
}

/**
 * Returns the template saved.
 *
 * @since  1.6.0
 * @param  string $post_type
 * @param  string $post_format
 * @return string $template
 */
if ( ! function_exists( 'alnp_get_template' ) ) {
	function alnp_get_template( $post_type = 'single', $post_format = '' ) {
		if ( ! empty( $post_format ) ) {
			$template = get_option( 'auto_load_next_post_template_single_' . $post_format );
		} else {
			$template = get_option( 'auto_load_next_post_template_' . $post_type );
		}

		return $template;
	} // END alnp_get_template()
}

/**
 * Scans through the active theme to look for the content to load.
 * If the content is not found then the fallback will be used.
 *
 * @since 1.6.0
 * @param string $post_type
 * @param string $post_format
 */
if ( ! function_exists( 'alnp_load_content' ) ) {
	function alnp_load_content( $post_type, $post_format ) {
		// Possible locations where the content files are found.
		$locations = alnp_get_locations();

		// Templates to look for based on the post that is loaded.
		$templates = alnp_get_templates( $post_type, $post_format );

		$content_found = false;

		// Check and return template if it was found already.
		$found_template = alnp_get_template( $post_type, $post_format );

		if ( ! empty( $found_template ) ) {
			$content_found = true;
			$load_content  = $found_template;
		} else {
			// Scanning all possible locations.
			foreach( $locations as $location ) {
				// Scanning all possible templates within the locations.
				foreach( $templates as $template ) {
					// If a template has been found then load it.
					if ( locate_template( $location . $template ) != '' && $content_found != true ) {
						$load_content  = $location . $template;
						$content_found = true;
					}
				}
			}
		}

		// Can be overridden.
		$content_found = apply_filters( 'alnp_content_found', $content_found );

		// Check if the user has forced the use of the fallback template.
		$use_fallback = get_option( 'auto_load_next_post_use_fallback' );

		// If content is found then load the template part.
		if ( $content_found && empty( $use_fallback ) ) {
			locate_template( $load_content, true, false );
		}
		else {
			do_action( 'alnp_load_content', $post_type );
		}
	} // END alnp_load_content()
}

/**
 * Load fallback template should no content file be found.
 *
 * @since 1.6.0
 * @param string $post_type
 */
if ( ! function_exists( 'alnp_load_fallback_content' ) ) {
	function alnp_load_fallback_content( $post_type ) {
		get_template_part( AUTO_LOAD_NEXT_POST_FILE_PATH . '/templates/content/content', $post_type );
	} // END alnp_load_fallback_content()
}
