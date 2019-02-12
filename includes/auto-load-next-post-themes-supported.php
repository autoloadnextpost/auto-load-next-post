<?php
/**
 * Auto Load Next Post Themes Supported
 *
 * Handles all supported themes out of the box.
 *
 * @since    1.5.5
 * @author   Sébastien Dumont
 * @category Core
 * @package  Auto Load Next Post/Core/Functions
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function alnp_themes_supported() {
	return array( 
		'make', 
		'sydney', 
		'storefront', 
		'twentyten', 
		'twentyeleven', 
		'twentytwelve', 
		'twentythirteen', 
		'twentyfourteen', 
		'twentyfifteen', 
		'twentysixteen', 
		'twentyseventeen', 
		'twentynineteen', 
		'understrap', 
	);
} // END alnp_themes_supported()

/**
 * Include classes for theme support.
 *
 * @access  public
 * @since   1.5.0
 * @version 1.5.5
 */
function alnp_include_theme_support() {
	$themes_supported = alnp_themes_supported();

	if ( is_alnp_active_theme( $themes_supported ) ) {
		foreach( $themes_supported as $theme ) {
			if ( get_template() == $theme ) {
				include_once( dirname( __FILE__ ) . '/theme-support/class-alnp-' . $theme . '.php' );
			}
		}
	}

	include_once( dirname( __FILE__ ) . '/theme-support/class-alnp-theme-support.php' );
} // END alnp_include_theme_support()
