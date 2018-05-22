<?php
/**
 * Auto Load Next Post Formatting
 *
 * @since    1.0.0
 * @version  1.4.10
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
 * Clean variables
 *
 * @since  1.0.0
 * @access public
 * @param  string $var
 * @return string
 */
function auto_load_next_post_clean($var) {
	return sanitize_text_field($var);
} // END auto_load_next_post_clean()

/**
 * Seconds to words.
 *
 * Forked from: https://github.com/thatplugincompany/login-designer/blob/master/includes/admin/class-login-designer-feedback.php
 *
 * @param string $seconds Seconds in time.
 */
function auto_load_next_post_seconds_to_words( $seconds ) {
	// Get the years.
	$years = ( intval( $seconds ) / YEAR_IN_SECONDS ) % 100;
	if ( $years > 1 ) {
		/* translators: Number of years */
		return sprintf( __( '%s years', 'auto-load-next-post' ), $years );
	} elseif ( $years > 0 ) {
		return __( 'a year', 'auto-load-next-post' );
	}

	// Get the weeks.
	$weeks = ( intval( $seconds ) / WEEK_IN_SECONDS ) % 52;
	if ( $weeks > 1 ) {
		/* translators: Number of weeks */
		return sprintf( __( '%s weeks', 'auto-load-next-post' ), $weeks );
	} elseif ( $weeks > 0 ) {
		return __( 'a week', 'auto-load-next-post' );
	}

	// Get the days.
	$days = ( intval( $seconds ) / DAY_IN_SECONDS ) % 7;
	if ( $days > 1 ) {
		/* translators: Number of days */
		return sprintf( __( '%s days', 'auto-load-next-post' ), $days );
	} elseif ( $days > 0 ) {
		return __( 'a day', 'auto-load-next-post' );
	}

	// Get the hours.
	$hours = ( intval( $seconds ) / HOUR_IN_SECONDS ) % 24;
	if ( $hours > 1 ) {
		/* translators: Number of hours */
		return sprintf( __( '%s hours', 'auto-load-next-post' ), $hours );
	} elseif ( $hours > 0 ) {
		return __( 'an hour', 'auto-load-next-post' );
	}

	// Get the minutes.
	$minutes = ( intval( $seconds ) / MINUTE_IN_SECONDS ) % 60;
	if ( $minutes > 1 ) {
		/* translators: Number of minutes */
		return sprintf( __( '%s minutes', 'auto-load-next-post' ), $minutes );
	} elseif ( $minutes > 0 ) {
		return __( 'a minute', 'auto-load-next-post' );
	}

	// Get the seconds.
	$seconds = intval( $seconds ) % 60;
	if ( $seconds > 1 ) {
		/* translators: Number of seconds */
		return sprintf( __( '%s seconds', 'auto-load-next-post' ), $seconds );
	} elseif ( $seconds > 0 ) {
		return __( 'a second', 'auto-load-next-post' );
	}
}
