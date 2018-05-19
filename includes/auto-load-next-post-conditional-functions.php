<?php
/**
 * Auto Load Next Post: Conditional Functions
 *
 * Functions for determining the current query/page,
 * theme support and if user agent is a bot.
 *
 * @since    1.0.0
 * @version  1.5.0
 * @author   Sébastien Dumont
 * @category Core
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'auto_load_next_post_is_ajax' ) ) {
	/**
	 * Returns true when the page is loaded via ajax.
	 *
	 * @access public
	 * @since  1.0.0
	 * @return bool
	 */
	function auto_load_next_post_is_ajax() {
		if ( defined( 'DOING_AJAX' ) ) {
			return true;
		}

		return( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) ? true : false;
	} // END auto_load_next_post_is_ajax
}

if ( ! function_exists( 'supports_alnp' ) ) {
	/**
	 * Returns true or false if Auto Load Next Post supports the theme.
	 *
	 * @access  public
	 * @since   1.4.3
	 * @version 1.4.10
	 * @return  boolean
	 */
	function supports_alnp() {
		/* WordPress core themes. */
		$core_themes = array(
			'twentyseventeen', 'twentysixteen', 'twentyfifteen', 'twentyfourteen', 'twentythirteen', 'twentytwelve', 'twentyten'
		);

		$other_themes = array(
			'storefront'
		);

		$supported_themes = array_merge( $core_themes, $other_themes );

		if ( in_array( get_option('template'), $supported_themes ) ) {
			return true;
		} else if ( current_theme_supports( 'auto-load-next-post' ) ) {
			return true;
		}

		return false;
	} // END supports_alnp()
}

if ( ! function_exists( 'alnp_template_location' ) ) {
	/**
	 * Filters the template location for get_template_part().
	 *
	 * @access  public
	 * @since   1.4.8
	 * @version 1.5.0
	 * @return  boolean
	 */
	function alnp_template_location() {
		$current_theme = get_option('template');

		switch( $current_theme ) {
			case 'twentyseventeen':
				$path = 'template-parts/post/';
				break;

			case 'twentysixteen':
				$path = 'template-parts/';
				break;

			default:
				$path = '';
				break;
		}

		return apply_filter( 'alnp_template_location', $path );
	} // END alnp_template_location()
}

if ( ! function_exists( 'is_alnp_pro_version_installed' ) ) {
	/**
	 * Detects if Auto Load Next Post Pro is installed.
	 *
	 * @access public
	 * @since  1.4.10
	 * @return boolean
	 */
	function is_alnp_pro_version_installed() {
		$active_plugins = (array) get_option( 'active_plugins', array() );

		if ( is_multisite() ) {
			$active_plugins = array_merge( $active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
		}

		return in_array( 'auto-load-next-post-pro/auto-load-next-post-pro.php', $active_plugins ) || array_key_exists( 'auto-load-next-post-pro/auto-load-next-post-pro.php', $active_plugins );
	}
}

/**
 * See if theme/s is activate or not.
 *
 * @since 1.5.0
 * @param string|array $theme Theme name or array of theme names to check.
 * @return boolean
 */
function is_alnp_active_theme( $theme ) {
	return is_array( $theme ) ? in_array( get_template(), $theme, true ) : get_template() === $theme;
}

/**
 * Returns true if Auto Load Next Post was supported in the theme.
 *
 * @since  1.5.0
 * @return boolean
 */
function is_alnp_supported() {
	$theme_support = current_theme_supports( 'auto-load-next-post' );
	$theme_support = is_array( $theme_support ) ? $theme_support[0] : false;

	if ( ! $theme_support ) {
		return false;
	}

	return true;
}

/**
 * Return "theme support" values from the current theme, if set.
 *
 * @since  1.5.0
 * @param  string $prop Name of prop (or key::subkey for arrays of props) if you want a specific value. Leave blank to get all props as an array.
 * @param  mixed  $default Optional value to return if the theme does not declare support for a prop.
 * @return mixed  Value of prop(s).
 */
function alnp_get_theme_support( $prop = '', $default = null ) {
	$theme_support = get_theme_support( 'auto-load-next-post' );
	$theme_support = is_array( $theme_support ) ? $theme_support[0] : false;

	if ( ! $theme_support ) {
		return $default;
	}

	if ( ! empty( $prop ) ) {
		$prop_stack = explode( '::', $prop );
		$prop_key   = array_shift( $prop_stack );

		if ( isset( $theme_support[ $prop_key ] ) ) {
			$value = $theme_support[ $prop_key ];

			if ( count( $prop_stack ) ) {
				foreach ( $prop_stack as $prop_key ) {
					if ( is_array( $value ) && isset( $value[ $prop_key ] ) ) {
						$value = $value[ $prop_key ];
					} else {
						$value = $default;
						break;
					}
				}
			}
		} else {
			$value = $default;
		}

		return $value;
	}

	return $theme_support;
}

/**
 * Was the current request made by a known bot?
 *
 * @since  1.5.0
 * @return boolean
 */
function alnp_is_bot() {
	$is_bot = alnp_is_bot_user_agent( $_SERVER['HTTP_USER_AGENT'] );

	return $is_bot;
}

/**
 * Is the given user-agent a known bot?
 *
 * @since  1.5.0
 * @param  string A user-agent string
 * @return boolean
 */
function alnp_is_bot_user_agent( $ua = null ) {
	if ( empty( $ua ) ) {
		return false;
	}

	$bot_agents = array(
		'alexa', 'altavista', 'ask jeeves', 'attentio', 'baiduspider', 'bingbot', 'chtml generic', 'crawler', 'fastmobilecrawl',
		'feedfetcher-google', 'firefly', 'froogle', 'gigabot', 'googlebot', 'googlebot-mobile', 'heritrix', 'httrack', 'ia_archiver', 'irlbot',
		'iescholar', 'infoseek', 'jumpbot', 'linkcheck', 'lycos', 'mediapartners', 'mediobot', 'motionbot', 'msnbot', 'mshots', 'openbot',
		'pss-webkit-request', 'pythumbnail', 'scooter', 'slurp', 'snapbot', 'spider', 'taptubot', 'technoratisnoop',
		'teoma', 'twiceler', 'yahooseeker', 'yahooysmcm', 'yammybot', 'ahrefsbot', 'pingdom.com_bot', 'kraken', 'yandexbot',
		'twitterbot', 'tweetmemebot', 'openhosebot', 'queryseekerspider', 'linkdexbot', 'grokkit-crawler',
		'livelapbot', 'germcrawler', 'domaintunocrawler', 'grapeshotcrawler', 'cloudflare-alwaysonline',
	);

	foreach ( $bot_agents as $bot_agent ) {
		if ( false !== stripos( $ua, $bot_agent ) ) {
			return true;
		}
	}

	return false;
}

if ( ! function_exists( 'alnp_get_post_type' ) ) {
	/**
	 * Returns the post type.
	 *
	 * @access public
	 * @since  1.4.12
	 * @return string
	 */
	function alnp_get_post_type() {
		$post_type = get_post_type();

		// If the post type is a post then return single instead.
		if ( $post_type == 'post' ) {
			return 'single';
		}

		return $post_type;
	}
}
