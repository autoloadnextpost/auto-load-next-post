<?php
/**
 * Auto Load Next Post Core Functions
 *
 * General core functions available for both the front-end and admin.
 *
 * @since    1.0.0
 * @version  1.6.0
 * @author   Sébastien Dumont
 * @category Core
 * @package  Auto Load Next Post/Core/Functions
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
if ( ! function_exists( 'auto_load_next_post_template_redirect' ) ) {
	function auto_load_next_post_template_redirect() {
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
		$child_path    = get_stylesheet_directory() . '/' . AUTO_LOAD_NEXT_POST_TEMPLATE_PATH;
		$template_path = get_template_directory() . '/' . AUTO_LOAD_NEXT_POST_TEMPLATE_PATH;
		$default_path  = AUTO_LOAD_NEXT_POST_FILE_PATH;

		if ( file_exists( $child_path . 'content-alnp.php' ) ) {
			$template_redirect = $child_path . 'content-alnp.php';
		}
		else if( file_exists( $template_path . 'content-alnp.php') ) {
			$template_redirect = $template_path . 'content-alnp.php';
		}
		else if( file_exists( $default_path . '/templates/content-alnp.php' ) ) {
			$template_redirect = $default_path . '/templates/content-alnp.php';
		}

		$template_redirect = apply_filters( 'alnp_template_redirect', $template_redirect );

		include( $template_redirect );

		exit;
	} // END auto_load_next_post_template_redirect()
}
add_action( 'template_redirect', 'auto_load_next_post_template_redirect' );

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
add_action( 'alnp_load_after_content', 'auto_load_next_post_comments', 1, 5 );

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
add_action( 'alnp_load_after_content', 'auto_load_next_post_navigation', 1, 10 );

/**
 * Returns the permalink of a random page
 *
 * @since  1.5.0
 * @param  string $post_type - Default is post.
 * @return int|boolean
 */
if ( ! function_exists( 'alnp_get_random_page_permalink' ) ) {
	function alnp_get_random_page_permalink( $post_type = 'post' ) {
		$args = array(
			'post_type'      => $post_type,
			'post_status'    => 'publish',
			'orderby'        => 'rand',
			'posts_per_page' => 1
		);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) : $query->the_post();
				$id = get_the_ID();

				return get_permalink( $id );
			endwhile;
		}
		else {
			return false;
		}
	} // END alnp_get_random_page_permalink()
}

/**
 * This helps the plugin decide to load the JavaScript in the footer or not.
 * 
 * @since  1.5.7
 * @return boolean
 */
if ( ! function_exists( 'alnp_load_js_in_footer' ) ) {
	function alnp_load_js_in_footer() {
		$load_in_footer = get_option( 'auto_load_next_post_load_js_in_footer', false );

		if ( isset( $load_in_footer ) && $load_in_footer == 'yes' ) {
			return true;
		}

		return false;
	}
}

/**
 * These are the only screens Auto Load Next Post will focus 
 * on displaying notices or equeue scripts/styles.
 *
 * @since   1.5.11
 * @version 1.6.0
 * @return  array
 */
if ( ! function_exists( 'alnp_get_admin_screens' ) ) {
	function alnp_get_admin_screens() {
		return array(
			'dashboard',
			'plugins',
			'themes',
			'settings_page_auto-load-next-post'
		);
	}
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
			'components',
			'components/post',
			'components/page',
			'templates',
			'template-parts',
			'template-parts/post',
			'template-parts/page',
			'partials',
			'loop-templates'
		);
	}
}

/**
 * Gets a list of templates to look for.
 *
 * @since  1.6.0
 * @return array
 */
if ( ! function_exists( 'alnp_get_templates' ) ) {
	function alnp_get_templates( $post_type, $post_format ) {
		return array(
			alnp_template_location() . 'content-' . $post_type . '.php',
			alnp_template_location() . 'content-single.php',
			alnp_template_location() . 'content.php',
			alnp_template_location() . 'format-' . $post_format . '.php',
			alnp_template_location() . 'content' . $post_format . '.php'
		);
	}
}

/**
 * Scans through the active theme to look for the content to load.
 * If the content is not found then the fallback will be used.
 *
 * @since 1.6.0
 */
if ( ! function_exists( 'alnp_load_content' ) ) {
	function alnp_load_content( $post_type, $post_format ) {
		// Possible locations where the content files are found.
		$locations = alnp_get_locations();

		// Templates to look for based on the post that is loaded.
		$templates = alnp_get_templates( $post_type, $post_format );

		$content_found = false;

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

		$content_found = apply_filters( 'alnp_content_found', $content_found );

		// If content is found then load the template part.
		if ( $content_found ) {
			locate_template( $load_content, true, false );
		}
		else {
			do_action( 'alnp_load_content', $post_type );
		}
	}
}

/**
 * Load fallback template should no content file be found.
 *
 * @since 1.6.0
 */
if ( ! function_exists( 'alnp_load_fallback_content' ) ) {
	function alnp_load_fallback_content( $post_type ) {
		get_template_part( AUTO_LOAD_NEXT_POST_FILE_PATH . '/templates/content/content', $post_type );
	}
	add_action( 'alnp_load_content', 'alnp_load_fallback_content', 1, 10 );
}

/**
 * Adds the plugin version to the header.
 *
 * @since 1.6.0
 */
if ( ! function_exists( 'alnp_meta_version' ) ) {
	function alnp_meta_version() {
		echo '<meta name="generator" content="Auto Load Next Post ' . esc_attr( AUTO_LOAD_NEXT_POST_VERSION ) . '" />' . "\n";
	}
	add_action( 'wp_head', 'alnp_meta_version' );
}