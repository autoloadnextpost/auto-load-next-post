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

if ( ! function_exists( 'alnp_template_redirect' ) ) {
	/**
	 * When the 'alnp' endpoint is used on a singular post it forces
	 * the template redirect to retrieve only the post content.
	 *
	 * @since   1.0.0
	 * @version 1.6.0
	 * @global  WP_Query $wp_query - The object information defining the current request and determines what type of query it's dealing with. See https://codex.wordpress.org/Class_Reference/WP_Query
	 */
	function alnp_template_redirect() {
		global $wp_query;

		// If this is not a request for alnp or a singular object then bail.
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

if ( ! function_exists( 'auto_load_next_post_comments' ) ) {
	/**
	 * Adds the comments template after the post content.
	 *
	 * @since   1.4.8
	 * @version 1.5.4
	 */
	function auto_load_next_post_comments() {
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
	} // END auto_load_next_post_comments()
}

if ( ! function_exists( 'auto_load_next_post_navigation' ) ) {
	/**
	 * Adds the post navigation for the previous link only after the post content.
	 *
	 * @since   1.4.8
	 * @version 1.5.4
	 */
	function auto_load_next_post_navigation() {
	?>
	<nav class="navigation post-navigation" role="navigation">
		<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'auto-load-next-post' ) . '</span> %title' ); ?></span>
	</nav>
	<?php
	} // END auto_load_next_post_navigation()
}

if ( ! function_exists( 'alnp_get_locations' ) ) {
	/**
	 * Get list of locations as to where the content for the theme is located.
	 * The list is in the order to look for the templates that store the content.
	 *
	 * @since  1.6.0
	 * @return array
	 */
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

if ( ! function_exists( 'alnp_get_templates' ) ) {
	/**
	 * Get list of templates to look for.
	 *
	 * @since  1.6.0
	 * @param  string $post_type
	 * @param  string $post_format
	 * @return array
	 */
	function alnp_get_templates( $post_type = 'post', $post_format = '' ) {
		$get_standard = array(
			'content-single.php',
			'content-post.php',
			'content-' . $post_type . '.php',
			'content.php'
		);

		if ( ! empty( $post_format ) ) {
			$get_formats = array(
				'format-' . $post_format . '.php',
				'content' . $post_format . '.php'
			);

			return array_merge( $get_standard, $get_formats );
		}

		return $get_standard;
	} // END alnp_get_templates()
}

if ( ! function_exists( 'alnp_scan_directories' ) ) {
	/**
	 * Scans for the theme template directory depending on the post type requested and saves it.
	 *
	 * @since 1.6.0
	 * @param string $post_type
	 * @param string $post_format
	 */
	function alnp_scan_directories( $post_type = 'post', $post_format = '' ) {
		// Possible locations where the content files are found.
		$locations = alnp_get_locations();

		// Templates to look for based on the post that is loaded.
		$templates = alnp_get_templates( $post_type, $post_format );

		$content_found = false;

		// Scanning all possible locations.
		foreach( $locations as $location ) {
			// Scanning all possible templates within the locations.
			foreach( $templates as $template ) {
				// Remove forwardslash if location is the parent theme folder.
				if ( empty( $location ) ) {
					$location = str_replace('/', '', $location);
				}

				// If a template has been found then save it.
				if ( locate_template( $location . $template ) != '' && $content_found !== true ) {
					// Save template found.
					if ( ! empty( $post_format ) ) {
						update_option( 'auto_load_next_post_directory_post_' . $post_format, $location );
					} else {
						update_option( 'auto_load_next_post_directory_' . $post_type, $location );
					}

					$content_found = true;
				}
			}
		}
	} // END alnp_scan_directories()
}

if ( ! function_exists( 'alnp_get_template_directory' ) ) {
	/**
	 * Returns the template directory saved.
	 *
	 * @since  1.6.0
	 * @param  string $post_type
	 * @param  string $post_format
	 * @return string $template
	 */
	function alnp_get_template_directory( $post_type = 'post', $post_format = '' ) {
		if ( ! empty( $post_format ) ) {
			$template = get_option( 'auto_load_next_post_directory_post_' . $post_format );
		} else {
			$template = get_option( 'auto_load_next_post_directory_' . $post_type );
		}

		if ( !$template ) {
			return '';
		}

		return $template;
	} // END alnp_get_template_directory()
}

if ( ! function_exists( 'alnp_get_template' ) ) {
	/**
	 * Returns the template file saved.
	 *
	 * @since  1.6.0
	 * @param  string $post_type
	 * @param  string $post_format
	 * @return string $template
	*/
	function alnp_get_template( $post_type = 'post', $post_format = '' ) {
		if ( ! empty( $post_format ) ) {
			$template = get_option( 'auto_load_next_post_template_post_' . strtolower( $post_format ) );
		} else {
			$template = get_option( 'auto_load_next_post_template_' . strtolower( $post_type ) );
		}

		if ( !$template ) {
			return '';
		}

		return $template;
	} // END alnp_get_template()
}

if ( ! function_exists( 'alnp_find_template' ) ) {
	/**
	 * Scans through the active theme to look for the content to load.
	 * If the content is not found then the fallback will be used.
	 *
	 * @since  1.6.0
	 * @param  string $location
	 * @param  string $post_type
	 * @param  string $post_format
	 * @return array
	*/
	function alnp_find_template( $location = '', $post_type, $post_format ) {
		// Templates to look for based on the post that is loaded.
		$templates = alnp_get_templates( $post_type, $post_format );

		$found = false;

		// Scanning all possible templates within the set location.
		foreach( $templates as $template ) {
			// Remove forwardslash if location is the parent theme folder.
			if ( empty( $location ) ) {
				$location = str_replace('/', '', $location);
			}

			// If a template has been found then return it.
			if ( locate_template( $location . $template ) != '' && $found != true ) {
				$file = $location . $template;

				if ( ! empty( $post_format ) ) {
					update_option( 'auto_load_next_post_template_post_' . strtolower( $post_format ), $file );
				} else {
					update_option( 'auto_load_next_post_template_' . strtolower( $post_type ), $file );
				}
		
				$found = true;
			}
		}

		return array(
			'template' => $file,
			'found'    => $found
		);
	} // END alnp_find_template()
}

if ( ! function_exists( 'alnp_load_content' ) ) {
	/**
	 * Loads theme template set either by theme support or setup wizard.
	 * If the content is not found then a fallback template will be used.
	 *
	 * @since 1.6.0
	 * @param string $post_type
	 * @param string $post_format
	 */
	function alnp_load_content( $post_type, $post_format ) {
		// Returns template location for supported themes.
		$template_location = alnp_template_location();

		$content_found = false;

		// Check and return directory and template if already found.
		if ( empty( $template_location ) ) {
			$directory = alnp_get_template_directory( $post_type, $post_format );
		} else {
			$directory = $template_location;
		}

		$template = alnp_get_template( $post_type, $post_format );

		if ( ! empty( $directory ) && ! empty( $template ) ) {
			$template      = $directory . $template;
			$content_found = true;
		} else {
			// Possible locations where the content files are found.
			$locations = alnp_get_locations();

			// Scanning all possible locations.
			foreach( $locations as $location ) {
				$template      = alnp_find_template( $directory, $post_type, $post_format );
				$content_found = $template['found'];
			}
		}

		// Can be overridden.
		$content_found = apply_filters( 'alnp_content_found', $content_found );

		// Check if the user has forced the use of the fallback template.
		$use_fallback = get_option( 'auto_load_next_post_use_fallback' );

		// If content is found then load the template part.
		if ( $content_found && empty( $use_fallback ) ) {
			locate_template( $template, true, false );
		}
		else {
			do_action( 'alnp_load_content', $post_type );
		}
	} // END alnp_load_content()
}

if ( ! function_exists( 'alnp_load_fallback_content' ) ) {
	/**
	 * Load fallback template should no content file be found.
	 *
	 * @since 1.6.0
	 * @param string $post_type
	 */
	function alnp_load_fallback_content( $post_type ) {
		get_template_part( AUTO_LOAD_NEXT_POST_FILE_PATH . '/templates/content/content', $post_type );
	} // END alnp_load_fallback_content()
}
